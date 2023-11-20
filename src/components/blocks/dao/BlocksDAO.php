<?php
class BlocksDAO extends AbstractDAO{

    public function __construct(?DBConnection $connection=null, ?DBConnectionSettings $settings=null){
        parent::__construct(tablename:'sys_blocks',dtoname:'BlockDTO',connection:$connection,settings:$settings);
    }

    public function findByName(string $name, bool $disconnect=true) : ?Block {
        $block = null;
        $dto = new BlockDTO();
        $dto->setName($name);
        $blocks = $this->findAll(dto:$dto,disconnect:$disconnect);
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