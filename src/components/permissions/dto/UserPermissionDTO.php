<?php
class UserPermissionDTO extends AbstractDTO {
    private Column $id;
    private Column $idType;
    private Column $idUser;
    private Column $idSection;
    private Column $enabled;
    private Column $timestamp;
    private Column $idUpdater;

    public function __construct(){
        $this->id = new Column(name:'id',type:'int');
        $this->idType = new Column(name:'id_type',type:'int');
        $this->idUser = new Column(name:'id_user',type:'int');
        $this->idSection = new Column(name:'id_section',type:'int');
        $this->enabled = new Column(name:'enabled',type:'bool');
        $this->timestamp = new Column(name:'timestamp',type:'int');
        $this->idUpdater = new Column(name:'id_user_updater',type:'int');
    }

    public function getId() : Column {
        return $this->id;
    }

    public function setId(?int $id) : void {
        $this->id->setValue($id);
    }

    public function getIdType() : Column {
        return $this->idType;
    }

    public function setIdType(?int $idType) : void {
        $this->idType->setValue($idType);
    }

    public function getIdUser() : Column {
        return $this->idUser;
    }

    public function setIdUser(?int $idUser) : void {
        $this->idUser->setValue($idUser);
    }

    public function getIdSection() : Column {
        return $this->idSection;
    }

    public function setIdSection(?int $idSection) : void {
        $this->idSection->setValue($idSection);
    }

    public function isEnabled() : Column {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled) : void {
        $this->enabled->setValue($enabled);
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
        $columns[] = $this->getIdType();
        $columns[] = $this->getIdUser();
        $columns[] = $this->getIdSection();
        $columns[] = $this->isEnabled();
        $columns[] = $this->getTimestamp();
        $columns[] = $this->getIdUpdater();

        return $columns;
    }
}
?>