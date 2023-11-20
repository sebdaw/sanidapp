<?php
class UsersPermissionsDAO extends AbstractDAO{

    public function __construct(?DBConnection $connection=null, ?DBConnectionSettings $settings=null){
        parent::__construct(tablename:'sys_users_permissions',dtoname:'UserPermissionDTO',connection:$connection,settings:$settings);
    }

    protected function order(string &$sql, int $order) : void {
        switch($order){
            default:
                $sql .= " ORDER BY id ASC ";
            }
    }

    public function find(int $idUser, int $idSection, int $idSPT, bool $disconnect=false) : ?UserPermission {
        $dto = new UserPermissionDTO;
        $dto->setIdUser(idUser:$idUser);
        $dto->setIdSection(idSection:$idSection);
        $dto->setIdType(idType:$idSPT);
        $rows = $this->findAll(dto:$dto,disconnect:$disconnect);
        return array_shift($rows);
    }

    public function mapToModel(array $data) : UserPermission {
        $id = $data['id'];
        $idType = $data['id_type'];
        $idUser = $data['id_user'];
        $idSection = $data['id_section'];
        $enabled = $data['enabled'];
        $timestamp = $data['timestamp'];
        $idUpdater = $data['id_user_updater'];
        $up = new UserPermission(id:$id,
                         idType:$idType,
                         idUser:$idUser,
                         idSection:$idSection,
                         enabled:$enabled,
                         timestamp:$timestamp,
                         idUpdater:$idUpdater);
        return $up;
    }
}
?>