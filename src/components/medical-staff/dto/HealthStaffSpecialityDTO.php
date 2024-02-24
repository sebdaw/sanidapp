<?php
class HealthStaffSpecialityDTO extends AbstractDTO {
    private Column $id;
    private Column $id_health_staff;
    private Column $id_speciality;
    private Column $date;
    private Column $id_user_updater;
    private Column $timestamp;

    public function __construct(){
        $this->id = new Column(name:'id',type:'int');
        $this->id_health_staff = new Column(name:'id_health_staff',type:'int');
        $this->id_speciality = new Column(name:'id_speciality',type:'int');
        $this->date = new Column(name:'date',type:'int');
        $this->id_user_updater = new Column(name:'id_user_updater',type:'int');
        $this->timestamp = new Column(name:'timestamp',type:'int');
    }

    public function getId() : Column {
        return $this->id;
    }

    public function setId(int $id) : void {
        $this->id->setValue($id);
    }

    public function getIdHealthStaff() : Column {
        return $this->id_health_staff;
    }

    public function setIdHealthStaff(int $id_health_staff) : void {
        $this->id_health_staff->setValue($id_health_staff);
    }

    public function getIdSpeciality() : Column {
        return $this->id_speciality;
    }

    public function setIdSpeciality(int $id_speciality) : void {
        $this->id_speciality->setValue($id_speciality);
    }

    public function getDate() : Column {
        return $this->date;
    }

    public function setDate(int $id_speciality) : void {
        $this->id_speciality->setValue($id_speciality);
    }

    public function getIdUserUpdater() : Column {
        return $this->id_user_updater;
    }

    public function setIdUserUpdater(int $id_user_updater) : void {
        $this->id_user_updater->setValue($id_user_updater);
    }

    public function getTimestamp() : Column {
        return $this->timestamp;
    }

    public function setTimestamp(int $timestamp) : void {
        $this->timestamp->setValue($timestamp);
    }

    public function getAll() : array {
        $columns = [];
        $columns[] = $this->getId();
        $columns[] = $this->getIdHealthStaff();
        $columns[] = $this->getIdSpeciality();
        $columns[] = $this->getdate();
        $columns[] = $this->getIdUserUpdater();
        $columns[] = $this->getTimestamp();
        return $columns;
    }
}
?>