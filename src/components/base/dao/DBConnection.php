<?php
class DBConnection {
    private ?PDO $pdo = null;
    private DBConnectionSettings $settings;

    public function __construct(?DBConnectionSettings $settings=null){
        $this->settings = is_null($settings)? new DBConnectionSettings : $settings;
        $this->connect();
    }

    public function getSettings() : DBConnectionSettings{
        return $this->settings;
    }

    public function connect() : bool{
        try {
            if (!$this->isConnected()){           
                $this->pdo = new PDO($this->settings->getDsn(),$this->settings->getUsername(),$this->settings->getPassword());
                return true;
            }
        }catch (PDOException $pdoe){
        }
        return false;
    }

    public function disconnect(){
        $this->pdo = null;
    }

    public function isConnected() : bool {
        return !is_null($this->pdo);
    }

    public function inTransaction() : bool {
        return ($this->isConnected() && $this->pdo->inTransaction());
    }

    public function getLastInsertId() : mixed {
        return $this->pdo->lastInsertId();
    }

    public function beginTransaction() : bool{
        if (!$this->isConnected())
            return false;
        return $this->pdo->beginTransaction();
    }

    public function commit() : bool {
        return ($this->inTransaction() && $this->pdo->commit());
    }

    public function rollback() : bool {
        return ($this->inTransaction() && $this->pdo->rollback());
    }

    public function prepare(string $sql, array $options=[]) : PDOStatement|false{
        return $this->pdo->prepare(query:$sql,options:$options);
    }

}
?>