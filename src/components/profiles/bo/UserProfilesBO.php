<?php
class UserProfilesBO {
    private ?User $user = null;
    private ?Role $role = null;
    private array $profiles = [];

    public function __construct(?User $user = null, ?Role $role = null, array $profiles=[]){
        $this->setUser($user);
        $this->setRole($role);
        $this->setProfiles($profiles);
    }

    public function getUser() : ?User {
        return $this->user;
    }

    public function setUser(?User $user) : void {
        $this->user = $user;
    }

    public function getRole() : ?Role {
        return $this->role;
    }

    public function setRole(?Role $role) : void {
        $this->role = $role;
    }

    public function getProfiles() : array {
        return $this->profiles;
    }

    public function setProfiles(array $profiles) : void {
        foreach($profiles as $profile){
            $this->addProfile(bo:$profile);
        }
    }

    public function addProfile(ProfileBO $bo) : void {
        //TODO: validar 
        $this->profiles[] = $bo;
    }
}
?>