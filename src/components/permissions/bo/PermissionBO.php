<?php
class PermissionBO {
    private ?SectionPermission $sp = null;
    private ?PermissionType $type=null;
    private ?RolePermission $rolePermission=null;
    private ?UserPermission $userPermission=null;

    public function getSectionPermission() : ?SectionPermission {
        return $this->sp;
    }

    public function setSectionPermission(?SectionPermission $sp) : void {
        $this->sp = $sp;
    }

    public function getType() : ?PermissionType {
        return $this->type;
    }

    public function setType(?PermissionType $type) : void {
        $this->type = $type;
    }

    public function getRolePermission() : ?RolePermission {
        return $this->rolePermission;
    }

    public function setRolePermission(?RolePermission $rolePermission) : void {
        $this->rolePermission = $rolePermission;
    }

    public function getUserPermission() : ?UserPermission {
        return $this->userPermission;
    }

    public function setUserPermission(?UserPermission $userPermission) : void {
        $this->userPermission = $userPermission;
    }
}
?>