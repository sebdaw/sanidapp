<?php
class RolesPermissionsDAO extends AbstractDAO{

    public function __construct(?DBConnection $connection=null, ?DBConnectionSettings $settings=null){
        parent::__construct(tablename:'sys_roles_permissions',dtoname:'RolePermissionDTO',connection:$connection,settings:$settings);
    }

    protected function order(string &$sql, int $order) : void {
        switch($order){
            default:
                $sql .= " ORDER BY id ASC ";
            }
    }

    public function find(int $idRole, int $idSection, int $idSPT, bool $disconnect=false) : ?RolePermission {
        $dto = new RolePermissionDTO();
        $dto->setIdRole(idRole:$idRole);
        $dto->setIdSection(idSection:$idSection);
        $dto->setIdType(idType:$idSPT);
        $rows = $this->findAll(dto:$dto, disconnect:$disconnect);
        return array_shift($rows);
    }

    public function mapToModel(array $data) : RolePermission {
        $id = $data['id'];
        $idType = $data['id_type'];
        $idRole = $data['id_role'];
        $idSection = $data['id_section'];
        $enabled = $data['enabled'];
        $timestamp = $data['timestamp'];
        $idUpdater = $data['id_user_updater'];
        $rp = new RolePermission(id:$id,
                         idType:$idType,
                         idRole:$idRole,
                         idSection:$idSection,
                         enabled:$enabled,
                         timestamp:$timestamp,
                         idUpdater:$idUpdater);
        return $rp;
    }
}
?>