<?php
class MembershipBO {
    private ?MedicalMembership $medicalMembership = null;
    private ?ProfileMembership $profileMembership = null;

    public function getMedicalMembership() : ?MedicalMembership {
        return $this->medicalMembership;
    }

    public function setMedicalMembership(?MedicalMembership $medicalMembership) : void {
        $this->medicalMembership = $medicalMembership;
    }

    public function getProfileMembership() : ?ProfileMembership {
        return $this->profileMembership;
    }

    public function setProfileMembership(?ProfileMembership $profileMembership) : void {
        $this->profileMembership = $profileMembership;
    }
}
?>