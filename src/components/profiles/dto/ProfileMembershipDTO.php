<?php
class ProfileMembershipDTO extends AbstractDTO {
    private Column $id;
    private Column $idMedicalMembership;
    private Column $idProfile;
    private Column $idm;
    private Column $timestamp;
    private Column $idUpdater;

    public function __construct(){
        $this->id = new Column(name:'id',type:'int');
        $this->idMedicalMembership = new Column(name:'id_medical_membership',type:'int');
        $this->idProfile = new Column(name:'id_profile',type:'int');
        $this->idm = new Column(name:'idm',type:'string');
        $this->timestamp = new Column(name:'timestamp',type:'int');
        $this->idUpdater = new Column(name:'id_user_updater',type:'int');
    }

    public function getId() : Column {
        return $this->id;
    }

    public function setId(int $id) : void {
        $this->id->setValue($id);
    }

    public function getIdMedicalMembership() : Column {
        return $this->idMedicalMembership;
    }

    public function setIdMedicalMembership(?int $idMedicalMembership) : void {
        $this->idMedicalMembership->setValue($idMedicalMembership);
    }

    public function getIdProfile() : Column {
        return $this->idProfile;
    }

    public function setIdProfile(?int $idProfile) : void {
        $this->idProfile->setValue($idProfile);
    }

    public function getIdm() : Column {
        return $this->idm;
    }

    public function setIdm(string $idm) : void {
        $this->idm->setValue($idm);
    }

    public function getTimestamp() : Column {
        return $this->timestamp;
    }

    public function setTimestamp(int $timestamp) : void {
        $this->timestamp->setValue($timestamp);
    }

    public function getIdUpdater() : Column {
        return $this->idUpdater;
    }

    public function setIdUpdater(?int $idUpdater) : void {
        $this->idUpdater->setValue($idUpdater);
    }

    public function getAll() : array {
        $columns = [];
        $columns[] = $this->getId();
        $columns[] = $this->getIdMedicalMembership();
        $columns[] = $this->getIdProfile();
        $columns[] = $this->getIdm();
        $columns[] = $this->getTimestamp();
        $columns[] = $this->getIdUpdater();
        return $columns;
    }
}
?>