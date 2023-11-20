<?php
abstract class AbstractDAO{
    protected readonly string $table;
    protected ?DBConnection $connection=null;
    protected ?string $dtoname = null;

    public function __construct(string $tablename, string $dtoname, ?DBConnection $connection=null, ?DBConnectionSettings $settings=null){
        $this->table = $tablename;
        $this->dtoname = $dtoname;
        $this->connection = is_null($connection)? new DBConnection(settings:$settings) : $connection;
    }

    public function getTablename() : string {
        return $this->table;
    }

    protected function getDBConnectionSettings() : ?DBConnectionSettings {
        if (!is_null($this->connection))
            return $this->connection->getSettings();
        return null;
    }

    protected function setDBConnectionSettings(DBConnectionSettings $settings) : void {
        // Cerramos la conexión actual si estuviese abierta, y conectamos otra vez con la configuración nueva
        if (!is_null($this->connection))
            $this->connection->disconnect();
        $this->connection = new DBConnection(settings:$settings);
    }

    /* ----------------------------------------------------------------------------------------------- */

    public function findById(int $id, bool $disconnect=false) : ?AbstractModel {
        $row = null;
        if ($id>0){
            $dto = new $this->dtoname;
            $dto->setId($id);
            $rows = $this->findAll(dto:$dto,disconnect:$disconnect);
            $row = array_shift($rows);
        }
        return $row;
    }

    public function findAll(?AbstractDTO $dto, int $order=0, int $page=1, int $pageSize=DEFAULT_PAGESIZE, bool $disconnect=false) : array {
        $results = [];
        try {
            if (!$this->connection->isConnected())
                $this->connection->connect();
            $conditions = [];
            $condition = null;
            if (!is_null($dto)){
                $columns = $dto->getAll();
                foreach($columns as $column){
                    if ($column->isset()){
                        if ($column->getType()=='date'){
                            $from = $column->getValue()['from'];
                            $to = $column->getValue()['to'];
                            if (!is_null($from))
                                $conditions[] = $column->getName() . " >= :from_" . $column->getName();
                            if (!is_null($to))
                                $conditions[] = $column->getName() . " <= :to_" . $column->getName();
                        }else{
                            $operator = is_null($column->getValue())? 'IS' : '=';
                            $conditions[] = $column->getName() . "{$operator} :" . $column->getName();
                        }
                    }
                }
                $condition = (count($conditions)>0)? " WHERE " . implode(' AND ',$conditions) : null;
            }
        
            $sql = "SELECT * FROM " . $this->getTablename() . " {$condition} ";

            $this->order($sql,$order);

            if ($page > 0){
                $offset = ($page - 1) * $pageSize;
                $limit = " LIMIT {$offset},{$pageSize} ";
                $sql .= $limit;
            }

            $pstm = $this->connection->prepare(sql:$sql);

            if (!is_null($condition)){
                foreach($columns as $column){
                    if (!$column->isset()) continue;
                    $name = $column->getName();
                    switch($column->getType()){
                    case 'bool':
                    case 'int':
                        $value = intval($column->getValue());
                        $pstm->bindValue(":{$name}",$value);
                        break;
                    case 'date':
                        $from = $column->getValue()['from'];
                        $to = $column->getValue()['to'];
                        if (!is_null($from))
                            $pstm->bindValue(":from_{$name}",intval($from));
                        if (!is_null($to))
                            $pstm->bindValue(":to_{$name}",intval($to));
                        break;
                    case 'float':
                        $value = floatval($column->getValue());
                        $pstm->bindValue(":{$name}",$value);
                        break;
                    default:
                        $value = $column->getValue();
                        $pstm->bindValue(":{$name}",$value);
                    }
                }
            }

            if ($pstm->execute()){
                $rows = $pstm->fetchAll(PDO::FETCH_ASSOC);
                foreach($rows as $row){
                    $results[] = $this->mapToModel($row);
                }
            }

            $pstm->closeCursor();
        }catch(Exception|Error $e){
            $results = [];
        }finally{
            if ($disconnect)
                $this->connection->disconnect();
        }
        return $results;
    }

    public function insert(AbstractDTO $dto, bool $disconnect=false, bool $beginTransaction=true, bool $commit=true) : ?int {
        $id = null;
        try{
            if (!$this->connection->isConnected())
                $this->connection->connect();
            $columns = $dto->getAll();
            $colnames = [];
            foreach($columns as $column){
                if ($column->isset())
                    $colnames[] = $column->getName();
            }
            $sql_columns = implode(',',$colnames);
            $placeholders = implode(',',array_map(function($n){return ":{$n}";},$colnames));
            $sql = "INSERT INTO " . $this->getTablename() . "({$sql_columns}) VALUES ({$placeholders})";

            if ($beginTransaction)
                $this->connection->beginTransaction();

            $pstm = $this->connection->prepare($sql);
            foreach($columns as $column){
                if ($column->isset()){
                    if ($column->getType() == 'date')
                        $pstm->bindValue(':' . $column->getName(),$column->getValue()['from']);
                    else
                        $pstm->bindValue(':' . $column->getName(),$column->getValue());
                }
            }

            if ($pstm->execute()){
                $id = $this->connection->getLastInsertId();
            }

            if ($commit)
                $this->connection->commit();
            $pstm->closeCursor();
        }catch(Exception|Error $e){
            $this->connection->rollback();
            $id = null;
        }finally{
            if ($disconnect)
                $this->connection->disconnect();
        }
        return $id;
    }

    public function update(AbstractDTO $dto, bool $disconnect=false, bool $beginTransaction=true, bool $commit=true) : int {
        $rowcount = 0;
        try{
            if (!$this->connection->isConnected())
                $this->connection->connect();
            $sql = "UPDATE " . $this->getTablename() . " SET ";

            $columns = $dto->getAll();
            $colnames = [];
            foreach($columns as $column){
                if ($column->isset() && ($column->getName() != 'id'))
                    $colnames[] = $column->getName();
            }

            $sql_columns = implode(',',array_map(function($n){return "{$n}=:{$n}";},$colnames));
            $sql .= " {$sql_columns} WHERE id=:id";
            
            if ($beginTransaction)
                $this->connection->beginTransaction();

            $pstm = $this->connection->prepare($sql);
            foreach($columns as $column){
                if ($column->isset()){
                    if ($column->getType()=='date')
                        $pstm->bindValue(':' . $column->getName(),$column->getValue()['from']);
                    else
                        $pstm->bindValue(':' . $column->getName(),$column->getValue());
                }
            }

            $pstm->execute();
            $rowcount = $pstm->rowCount();
            
            if ($commit)
                $this->connection->commit();
        
            $pstm->closeCursor();

        }catch(Exception|Error $e){
            $this->connection->rollback();
            $rowcount = 0;
        }finally{
            if ($disconnect)
                $this->connection->disconnect();
        }
        return $rowcount;
    }

    public function delete(int $id, bool $disconnect=false, bool $beginTransaction=true, bool $commit=true) : int {
        $rowcount = 0;
        try{
            if ($id<=0) return 0;
            $sql = "DELETE FROM " . $this->getTablename() . " WHERE id=:id";
            if ($beginTransaction)
                $this->connection->beginTransaction();

            $pstm = $this->connection->prepare($sql);
            $pstm->bindValue(':id',$id);
            
            $pstm->execute();
            $rowcount = $pstm->rowCount();

            if ($commit)
                $this->connection->commit();

            $pstm->closeCursor();
        }catch(Exception|Error $e){
            $this->connection->rollback();
            $rowcount = 0;
        }finally{
            if ($disconnect)
                $this->connection->disconnect();
        }
        return $rowcount;
    }




    abstract protected function order(string &$sql, int $order) : void;
    abstract public function mapToModel(array $data) : ?AbstractModel;
}
?>