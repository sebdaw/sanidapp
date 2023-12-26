<?php
class SectionPermissionsBO {
    private ?User $user = null;
    private ?Block $block = null;
    private ?Section $section = null;
    private array $permissions = [];

    public function __construct(?User $user=null, ?Block $block=null, ?Section $section=null){
        $this->setUser($user);
        $this->setBlock($block);
        $this->setSection($section);
    }

    public function getUser() : ?User {
        return $this->user;
    }

    public function setUser(?User $user) : void {
        $this->user = $user;
    }

    public function getBlock() : ?Block {
        return $this->block;
    }

    public function setBlock(?Block $block) : void {
        $this->block = $block;
    }

    public function getSection() : ?Section {
        return $this->section;
    }

    public function setSection(?Section $section) : void {
        $this->section = $section;
    }

    public function getPermissions() : array {
        return $this->permissions;
    }

    public function addPermission(PermissionBO $permission) : void {
        if (!$this->validatePermission($permission))
            return;
        $this->permissions[] = $permission;
    }

    public function getRolePermission(int $id) : ?PermissionBO {
        foreach($this->permissions as $permission){
            $rp = $permission->getRolePermission();
            if (!is_null($rp) && ($id == $rp->getId())){
                return $permission;
            }
        }
        return null;
    }

    public function getPermissionByType(string $name) : ?PermissionBO {
        foreach($this->permissions as $permission){
            $type = $permission->getType();
            if ($type->getName() == mb_strtolower($name)){
                return $permission;
            }
        }
        return null;
    }

    public function getPermissionByIdType(int $idType) : ?PermissionBO {
        foreach($this->permissions as $permission){
            $type = $permission->getType();
            if ($type->getId() == $idType){
                return $permission;
            }
        }
        return null;
    }

    public function supportsType(int $idType) : bool {
        foreach($this->permissions as $permission){
            $type = $permission->getType();
            if ($type->getId() == $idType)
                return true;
        }
        return false;
    }
 
    public function hasPermission(string $name) : bool {
        if (is_null($permission = $this->getPermissionByType(name:$name)))
            return false;
        $userPermission = $permission->getUserPermission();
        $rolePermission = $permission->getRolePermission();

        if (is_null($userPermission) || is_null($userPermission->isEnabled()))
            return $rolePermission->isEnabled();
        return $userPermission->isEnabled();
    }

    public function checkPermission(int $idType) : bool {
        if (is_null($permission = $this->getPermissionByIdType($idType)))
            return false;
        $userPermission = $permission->getUserPermission();
        $rolePermission = $permission->getRolePermission();

        if (is_null($userPermission) || is_null($userPermission->isEnabled()))
            return !is_null($rolePermission) && $rolePermission->isEnabled();
        return $userPermission->isEnabled();
    }

    private function validatePermission(PermissionBO $permission) : bool {
        $type = $permission->getType();
        if (is_null($type))
            return false;
        // $rolePermission = $permission->getRolePermission();
        // if (is_null($rolePermission))
            // return false;
        // if ($this->section->getId()!=$rolePermission->getIdSection())
        //     return false;
        return true;
    }
}
?>