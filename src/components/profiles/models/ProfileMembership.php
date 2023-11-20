<?php
class ProfileMembership extends AbstractModel {
    private int $id;
    private ?int $idMedicalMembership;
    private ?int $idProfile;
    private string $idm;
    private int $timestamp;
    private ?int $idUpdater;

    public function __construct(int $id, ?int $idMedicalMembership, ?int $idProfile, string $idm, int $timestamp, ?int $idUpdater){
        $this->setId($id);
        $this->setIdMedicalMembership($idMedicalMembership);
        $this->setIdProfile($idProfile);
        $this->setIdm($idm);
        $this->setTimestamp($timestamp);
        $this->setIdUpdater($idUpdater);
    }

    public function getId() : int {
        return $this->id;
    }

    public function setId(int $id) : void {
        $this->id = $id;
    }

    public function getIdMedicalMembership() : ?int {
        return $this->idMedicalMembership;
    }

    public function setIdMedicalMembership(?int $idMedicalMembership) : void {
        $this->idMedicalMembership = $idMedicalMembership;
    }

    public function getIdProfile() : ?int {
        return $this->idProfile;
    }

    public function setIdProfile(?int $idProfile) : void {
        $this->idProfile = $idProfile;
    }

    public function getIdm() : string {
        return $this->idm;
    }

    public function setIdm(string $idm) : void {
        $this->idm = $idm;
    }

    public function getTimestamp() : array {
        return Date::getDate($this->timestamp);
    }

    public function setTimestamp(int $timestamp) : void {
        $this->timestamp = $timestamp;
    }

    public function getIdUpdater() : ?int {
        return $this->idUpdater;
    }

    public function setIdUpdater(?int $idUpdater) : void {
        $this->idUpdater = $idUpdater;
    }

    public function __toString(): string{
        //TODO:
        return '';
    }
}
?>