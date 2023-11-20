<?php
class SectionDAO extends AbstractDAO{

    public function __construct(?DBConnection $connection=null, ?DBConnectionSettings $settings=null){
        parent::__construct(tablename:'sys_sections',dtoname:'SectionDTO',connection:$connection,settings:$settings);
    }

    public function findByName(string $name, bool $disconnect=true) : ?Section {
        $section = null;
        $dto = new SectionDTO();
        $dto->setName($name);
        $sections = $this->findAll(dto:$dto,disconnect:$disconnect);
        $section = array_shift($sections);
        return $section;
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