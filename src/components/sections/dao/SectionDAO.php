<?php
class SectionDAO extends AbstractDAO{

    public function __construct(?DBConnection $connection=null, ?DBConnectionSettings $settings=null){
        parent::__construct(tablename:'sys_sections',dtoname:'SectionDTO',connection:$connection,settings:$settings);
    }

    public function findByName(string $name, bool $disconnect=false) : ?Section {
        $section = null;
        $dto = new SectionDTO();
        $dto->setName($name);
        $sections = $this->findAll(dto:$dto,disconnect:$disconnect);
        $section = array_shift($sections);
        return $section;
    }

    public function sortSections(array $sections, bool $disconnect=false, bool $beginTransaction=true, bool $commit=true) : bool {
        usort($sections,function($a,$b){
            return $a->getOrder() - $b->getOrder();
        });
        $dto = new SectionDTO;
        $size = count($sections);
        if ($beginTransaction)
            $this->connection->beginTransaction();
        for($i=0;$i<$size;$i++){
            $position = $i+1;
            $dto->setId($sections[$i]->getId());
            $dto->setOrder($position);
            $dto->setTimestamp(time());
            $dto->setIdUpdater($_SESSION[ID_USER_SESSION]);
            if (!$this->update(dto:$dto,disconnect:$disconnect,beginTransaction:false,commit:false))
                return false;
        }
        if ($commit)
            $this->connection->commit();
        return true;
    }

    public function getHighestPosition(int $idBlock) : ?int {
        $sql = "SELECT MAX(position) FROM {$this->table} WHERE id_block=:id_block";
        $stm = $this->connection->prepare($sql);
        $stm->bindValue(':id_block',$idBlock);
        if ($stm->execute()){
            $results = $stm->fetch(PDO::FETCH_NUM);
            return array_shift($results);
        }
        return null;
    }

    public function findByPosition(int $position, int $idBlock) : ?Section {
        $dto = new SectionDTO;
        $dto->setOrder(order:$position);
        $dto->setIdBlock(idBlock:$idBlock);
        $sections = $this->findAll(dto:$dto);
        $section = array_shift($sections);
        return $section;
    }

    public function findByPath(string $path, bool $disconnect=false) : ?Section {
        $dto = new SectionDTO;
        $dto->setPath(path:$path);
        $results = $this->findAll(dto:$dto,disconnect:$disconnect);
        return array_shift($results);
    }

    protected function order(string &$sql, int $order) : void {
        switch($order){
            default:
                $sql .= " ORDER BY position ASC ";
            }
    }

    public function mapToModel(array $data) : Section {
        $id = $data['id'];
        $name = $data['name'];
        $icon = $data['icon'];
        $path = $data['path'];
        $idBlock = $data['id_block'];
        $order = $data['position'];
        $timestamp = $data['timestamp'];
        $idUpdater = $data['id_user_updater'];
        $section = new Section(id:$id,
                         name:$name,
                         icon:$icon,
                         path:$path,
                         idBlock:$idBlock,
                         order:$order,
                         timestamp:$timestamp,
                         idUpdater:$idUpdater);
        return $section;
    }
}
?>