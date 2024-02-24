<?php
class MedicalCenterWorkerDTO extends AbstractDTO {
    private Column $id;
    private Column $id_health_staff;
    private Column $id_center_speciality;
    private Column $id_job_position;
    private Column $active;
    private Column $from;
    private Column $to;
    private Column $timestamp;
    private Column $id_user_updater;

    public function __construct(){
        $this->id = new Column(name:'id',type:'int');
        $this->id_health_staff = new Column(name:'id_health_staff',type:'int');
        $this->id_center_speciality = new Column(name:'id_center_speciality',type:'int');
        $this->id_job_position = new Column(name:'id_job_position',type:'int');
        $this->active = new Column(name:'active',type:'bool');
        $this->from = new Column(name:'from',type:'int');
        $this->to = new Column(name:'to',type:'int');
        $this->timestamp = new Column(name:'timestamp',type:'int');
        $this->id_user_updater = new Column(name:'id_user_updater',type:'int');
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

    public function getIdCenterSpeciality() : Column {
        return $this->id_center_speciality;
    }

    public function setIdCenterSpeciality(int $id_center_speciality) : void {
        $this->id_center_speciality->setValue($id_center_speciality);
    }

    public function getIdJobPosition() : Column {
        return $this->id_job_position;
    }

    public function setIdJobPosition(int $id_job_position) : void {
        $this->id_job_position->setValue($id_job_position);
    }

    public function isActive() : Column {
        return $this->active;
    }

    public function setActive(bool $active) : void {
        $this->active->setValue($active);
    }

    public function getFrom() : Column {
        return $this->from;
    }

    public function setFrom(int $from) : void {
        $this->from->setValue($from);
    }

    public function getTo() : Column {
        return $this->to;
    }

    public function setTo(int $to) : void {
        $this->to->setValue($to);
    }

    public function getTimestamp() : Column {
        return $this->timestamp;
    }

    public function setTimestamp(int $timestamp) : void {
        $this->timestamp->setValue($timestamp);
    }

    public function getIdUserUpdater() : Column {
        return $this->id_user_updater;
    }

    public function setIdUserUpdater(int $id_user_updater) : void {
        $this->id_user_updater->setValue($id_user_updater);
    }

    public function getAll() : array {
        $columns = [];
        $columns[] = $this->getId();
        $columns[] = $this->getIdHealthStaff();
        $columns[] = $this->getIdCenterSpeciality();
        $columns[] = $this->getIdJobPosition();
        $columns[] = $this->isActive();
        $columns[] = $this->getFrom();
        $columns[] = $this->getTo();
        $columns[] = $this->getIdUserUpdater();
        $columns[] = $this->getTimestamp();
        return $columns;
    }
}
?>