<?php
class AppointmentDTO extends AbstractDTO {
    private Column $id;
    private Column $id_patient;
    private Column $id_worker;
    private Column $date;
    private Column $id_center_speciality;
    private Column $timestamp;
    private Column $id_user_updater;

    public function __construct(){
        $this->id = new Column(name:'id',type:'int');
        $this->id_patient = new Column(name:'id_patient',type:'int');
        $this->id_worker = new Column(name:'id_worker',type:'int');
        $this->id_center_speciality = new Column(name:'id_center_speciality',type:'int');
        $this->date = new Column(name:'date',type:'date');
        $this->timestamp = new Column(name:'timestamp',type:'int');
        $this->id_user_updater = new Column(name:'id_user_updater',type:'int');
    }

    public function getId() : Column {
        return $this->id;
    }

    public function setId(int $id) : void {
        $this->id->setValue($id);
    }

    public function getIdPatient() : Column {
        return $this->id_patient;
    }

    public function setIdPatient(int $id_patient) : void {
        $this->id_patient->setValue($id_patient);
    }

    public function getIdWorker() : Column {
        return $this->id_worker;
    }

    public function setIdWorker(int $id_worker) : void {
        $this->id_worker->setValue($id_worker);
    }

    public function getIdCenterSpeciality() : Column {
        return $this->id_center_speciality;
    }

    public function setIdCenterSpeciality(int $id_center_speciality) : void {
        $this->id_center_speciality->setValue($id_center_speciality);
    }

    public function getDate() : Column {
        return $this->date;
    }

    public function setDate(int $date) : void {
        $this->date->setValue($date);
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
        $columns[] = $this->getIdPatient();
        $columns[] = $this->getIdWorker();
        $columns[] = $this->getIdCenterSpeciality();
        $columns[] = $this->getdate();
        $columns[] = $this->getTimestamp();
        $columns[] = $this->getIdUserUpdater();
        return $columns;
    }
}
?>