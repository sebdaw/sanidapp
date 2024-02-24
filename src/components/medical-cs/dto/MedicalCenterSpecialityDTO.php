<?php
class MedicalCenterSpecialityDTO extends AbstractDTO {
    private Column $id;
    private Column $id_center;
    private Column $id_speciality;
    private Column $description;
    private Column $active;
    private Column $timestamp;
    private Column $id_user_updater;

    public function __construct(){
        $this->id = new Column(name:'id',type:'int');
        $this->id_center = new Column(name:'id_center',type:'int');
        $this->id_speciality = new Column(name:'id_speciality',type:'int');
        $this->description = new Column(name:'description',type:'string');
        $this->active = new Column(name:'active',type:'bool');
        $this->timestamp = new Column(name:'timestamp',type:'int');
        $this->id_user_updater = new Column(name:'id_user_updater',type:'int');
    }

    public function getId() : Column {
        return $this->id;
    }

    public function setId(int $id) : void {
        $this->id->setValue($id);
    }

    public function getIdCenter() : Column {
        return $this->id_center;
    }

    public function setIdCenter(int $id_center) : void {
        $this->id_center->setValue($id_center);
    }

    public function getIdSpecility() : Column {
        return $this->id_speciality;
    }

    public function setIdSpeciality(int $id_speciality) : void {
        $this->id_speciality->setValue($id_speciality);
    }

    public function getDescription() : Column {
        return $this->description;
    }

    public function setDescription(string $description) : void {
        $this->description->setValue($description);
    }

    public function isActive() : Column {
        return $this->active;
    }

    public function setActive(Column $active) : void {
        $this->active->setValue($active);
    }

    public function getTimestamp() : Column {
        return $this->timestamp;
    }

    public function setTimestamp(int $timestamp) : void {
        $this->timestamp->setValue($timestamp);
    }

    public function getIdUserUpdater() : Column  {
        return $this->id_user_updater;
    }

    public function setIdUserUdapter(int $id_user_updater) : void {
        $this->id_user_updater->setValue($id_user_updater);
    }

    public function getAll() : array {
        $columns = [];
        $columns[] = $this->getId();
        $columns[] = $this->getIdCenter();
        $columns[] = $this->getIdSpecility();
        $columns[] = $this->getDescription();
        $columns[] = $this->isActive();
        $columns[] = $this->getTimestamp();
        $columns[] = $this->getIdUserUpdater();
        return $columns;
    }
}
?>