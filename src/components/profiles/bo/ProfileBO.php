<?php
class ProfileBO {
    private ?Profile $profile = null;
    private array $memberships = [];

    public function getProfile() : ?Profile {
        return $this->profile;
    }

    public function setProfile(?Profile $profile) : void {
        $this->profile = $profile;
    }

    public function getMemberships() : array {
        return $this->memberships;
    }

    public function addMembership(MembershipBO $bo) : void {
        $this->memberships[] = $bo;
    }
}
?>