<?php
class SectionsPermissionsDAO extends AbstractDAO{

    public function __construct(?DBConnection $connection=null, ?DBConnectionSettings $settings=null){
        parent::__construct(tablename:'sys_permissions_types_sections',dtoname:'SectionPermissionDTO',connection:$connection,settings:$settings);
    }

    protected function order(string &$sql, int $order) : void {
        switch($order){
            default:
                $sql .= " ORDER BY id_permission_type DESC ";
            }
    }

    public function getSectionPermissions(int $idSection,bool $disconnect=false) : array {
        $dto = new SectionPermissionDTO();
        $dto->setIdSection($idSection);
        return $this->findAll(dto:$dto,page:ALL_PAGES,disconnect:$disconnect);
    }

    public function getSectionPermission(int $idSection, int $idType, bool $disconnect=false) : ?SectionPermission {
        $dto = new SectionPermissionDTO;
        $dto->setIdSection(idSection:$idSection);
        $dto->setIdType(idType:$idType);
        $results = $this->findAll(dto:$dto,page:ALL_PAGES,disconnect:$disconnect);
        return array_shift($results);
    }

    public function mapToModel(array $data) : SectionPermission {
        $id = $data['id'];
        $idType = $data['id_permission_type'];
        $idSection = $data['id_section'];
        $sp = new SectionPermission(id:$id,
                         idType:$idType,
                         idSection:$idSection);
        return $sp;
    }
}
?>