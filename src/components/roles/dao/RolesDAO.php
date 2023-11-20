<?php
class RolesDAO extends AbstractDAO{

    public function __construct(?DBConnection $connection=null, ?DBConnectionSettings $settings=null){
        parent::__construct(tablename:'sys_roles',dtoname:'RoleDTO',connection:$connection,settings:$settings);
    }

    public function findByName(string $name, bool $disconnect=true) : ?Role {
        $role = null;
        $dto = new RoleDTO();
        $dto->setName($name);
        $roles = $this->findAll(dto:$dto,disconnect:$disconnect);
        $role = array_shift($roles);
        return $role;
    }

    protected function order(string &$sql, int $order) : void {
        switch($order){
            case 1:
                $sql .= " ORDER BY name ASC";
                break;
            default:
                $sql .= " ORDER BY id DESC ";
            }
    }

    public function mapToModel(array $data) : Role{
        $id = $data['id'];
        $name = $data['name'];
        $timestamp = $data['timestamp'];
        $idUpdater = $data['id_user_updater'];
        $role = new Role(id:$id,
                         name:$name,
                         timestamp:$timestamp,
                         idUpdater:$idUpdater);
        return $role;
    }
}
?>