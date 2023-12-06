<?php
class BlocksDAO extends AbstractDAO{

    public function __construct(?DBConnection $connection=null, ?DBConnectionSettings $settings=null){
        parent::__construct(tablename:'sys_blocks',dtoname:'BlockDTO',connection:$connection,settings:$settings);
    }

    public function get(int $id, bool $disconnect=false) : ?Block {
        $dto = new BlockDTO;
        $dto->setId($id);
        $results = $this->getAll(dto:$dto,disconnect:$disconnect);
        return array_shift($results);
    }

    public function getAll(?AbstractDTO $dto, int $order=0, int $page=1, int $pageSize=DEFAULT_PAGESIZE, bool $disconnect=false) : array {
        $blocks = $this->findAll(dto:$dto,order:$order,page:$page,pageSize:$pageSize,disconnect:$disconnect);
        $size = count($blocks);
        for ($i=0;$i<$size;$i++){
            $blocks[$i] = (fn($n):Block=>$n)($blocks[$i]);
            $idBlock = $blocks[$i]->getId();
            $sql = "SELECT COUNT(id) FROM sys_sections WHERE id_block=:id_block";
            $stm = $this->connection->prepare($sql);
            $stm->bindValue(':id_block',$idBlock);
            if ($stm->execute()){
                $tmp = $stm->fetch(PDO::FETCH_NUM);
                $num = array_shift($tmp);
                $blocks[$i]->setNumSections($num);
            }
        }
        return $blocks;
    }

    public function sortBlocks(array $blocks, bool $disconnect=false, bool $beginTransaction=true, bool $commit=true) : bool {
        usort($blocks,function($a,$b){
            return $a->getOrder() - $b->getOrder();
        });
        $dto = new BlockDTO;
        $size = count($blocks);
        if ($beginTransaction)
            $this->connection->beginTransaction();
        for($i=0;$i<$size;$i++){
            $position = $i+1;
            $dto->setId($blocks[$i]->getId());
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

    public function findByName(string $name, bool $disconnect=false) : ?Block {
        $block = null;
        $dto = new BlockDTO();
        $dto->setName($name);
        $blocks = $this->findAll(dto:$dto,disconnect:$disconnect);
        $block = array_shift($blocks);
        return $block;
    }

    public function getHighestPosition() : ?int {
        $sql = "SELECT MAX(position) FROM {$this->table}";
        $stm = $this->connection->prepare($sql);
        if ($stm->execute()){
            $results = $stm->fetch(PDO::FETCH_NUM);
            return array_shift($results);
        }
        return null;
    }

    public function findByPosition(int $position) : ?Block {
        $dto = new BlockDTO;
        $dto->setOrder(order:$position);
        $blocks = $this->findAll(dto:$dto);
        $block = array_shift($blocks);
        return $block;
    }

    protected function order(string &$sql, int $order) : void {
        switch($order){
            default:
                $sql .= " ORDER BY position ASC ";
            }
    }

    public function mapToModel(array $data) : Block {
        $id = $data['id'];
        $name = $data['name'];
        $order = $data['position'];
        $timestamp = $data['timestamp'];
        $idUpdater = $data['id_user_updater'];
         $block = new Block(id:$id,
                         name:$name,
                         order:$order,
                         timestamp:$timestamp,
                         idUpdater:$idUpdater);
        return $block;
    }
}
?>