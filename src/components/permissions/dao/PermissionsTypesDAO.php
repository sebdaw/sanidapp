<?php
class PermissionsTypesDAO extends AbstractDAO{

    public function __construct(?DBConnection $connection=null, ?DBConnectionSettings $settings=null){
        parent::__construct(tablename:'sys_permissions_types',dtoname:'PermissionTypeDTO',connection:$connection,settings:$settings);
    }

    public function findByName(string $name, bool $disconnect=true) : ?PermissionType {
        $type = null;
        $dto = new PermissionTypeDTO();
        $dto->setName($name);
        $types = $this->findAll(dto:$dto,disconnect:$disconnect);
        $type = array_shift($types);
        return $type;
    }

    protected function order(string &$sql, int $order) : void {
        switch($order){
            default:
                $sql .= " ORDER BY name DESC ";
            }
    }

    public function mapToModel(array $data) : PermissionType {
        $id = $data['id'];
        $name = $data['name'];
        $description = $data['description'];
        $type = new PermissionType(id:$id,
                         name:$name,
                         description:$description);
        return $type;
    }
}
?>