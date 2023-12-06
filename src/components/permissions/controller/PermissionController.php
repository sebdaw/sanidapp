<?php
class PermissionController {
    private ?UsersDAO $usdao = null;
    private ?BlocksDAO $bdao = null;
    private ?SectionDAO $sdao = null;
    private ?SectionsPermissionsDAO $spdao = null;
    private ?PermissionsTypesDAO $tdao = null;
    private ?RolesPermissionsDAO $rdao = null;
    private ?UsersPermissionsDAO $udao = null;

    public function __construct(?DBConnection $connection=null){
        $this->usdao = new UsersDAO(connection:$connection);
        $this->bdao = new BlocksDAO(connection:$connection);
        $this->sdao = new SectionDAO(connection:$connection);
        $this->spdao = new SectionsPermissionsDAO(connection:$connection);
        $this->tdao = new PermissionsTypesDAO(connection:$connection);
        $this->rdao = new RolesPermissionsDAO(connection:$connection);
        $this->udao = new UsersPermissionsDAO(connection:$connection);
    }
    
    public function hasAccessToBlock(int $idUser, int $idBlock) : bool {
        $block = $this->bdao->findById(id:$idBlock);
        if (is_null($block))
            return false;
        $block = (fn($n):Block=>$n)($block);
        $dto = new SectionDTO();
        $dto->setIdBlock(idBlock:$block->getId());
        $sections = $this->sdao->findAll(dto:$dto,page:ALL_PAGES);
        if (count($sections)==0)
            return false;
        foreach($sections as $section){
            $section = (fn($n):Section=>$n)($section);
            if ($this->hasPermission(idUser:$idUser,idSection:$section->getId(),idType:ACC))
                return true;
        }
        return false;
    }

    public function getAllPermissions(int $idUser) : array {
        $permissions = [];
        $sections = $this->sdao->findAll(dto:null,page:ALL_PAGES);
        foreach($sections as $section){
            if (!is_null($sectionPermissions = $this->getSectionPermissions(idUser:$idUser,idSection:$section->getId())))
                $permissions[] = $sectionPermissions;
        }
        return $permissions;
    }

    public function getSectionPermissions(int $idUser, int $idSection) : ?SectionPermissionsBO {
        $user = $this->usdao->findById(id:$idUser);
        if (is_null($user))
            return null;
        $user = (fn($obj):User=>$obj)($user);

        $section = $this->sdao->findById(id:$idSection);
        if (is_null($section))
            return null;
        $section = (fn($obj):Section=>$obj)($section);

        $block = $this->bdao->findById(id:$section->getIdBlock());
        if (is_null($block))
            return null;
        $block = (fn($obj):Block=>$obj)($block);

        $spbo = null;
        $sectionPermissions = $this->spdao->getSectionPermissions(idSection:$idSection);
        if (count($sectionPermissions)>0){
            $spbo = new SectionPermissionsBO;
            $spbo->setBlock($block);
            $spbo->setSection($section);
            $spbo->setUser($user);
            foreach($sectionPermissions as $sp){
                $pbo = new PermissionBO;
                $pbo->setSectionPermission(sp:$sp);
                $type = $this->tdao->findById(id:$sp->getIdType());
                $pbo->setType(type:$type);
                $rolePermission = $this->rdao->find(idRole:$user->getIdRole(),idSection:$idSection,idSPT:$sp->getId());
                $pbo->setRolePermission(rolePermission:$rolePermission);
                $userPermission = $this->udao->find(idUser:$idUser,idSection:$idSection,idSPT:$sp->getId());
                $pbo->setUserPermission(userPermission:$userPermission);
                $spbo->addPermission(permission:$pbo);
            }
        }

        return $spbo;
    }

    public function hasPermission(int $idUser, int $idSection, int $idType) : bool {
        $spbo = $this->getSectionPermissions(idUser:$idUser,idSection:$idSection);
        if (!is_null($spbo)){
            foreach($spbo->getPermissions() as $permission){
                if ($permission->getType()->getId() == $idType){
                    $rolePermission = $permission->getRolePermission();
                    $userPermission = $permission->getUserPermission();
                    if (is_null($userPermission) || is_null($userPermission->isEnabled()))
                        return $rolePermission->isEnabled();
                    return $userPermission->isEnabled();
                }
            }
        }
        return false;
    }
}
?>