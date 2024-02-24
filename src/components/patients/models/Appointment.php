<?php
class Appointment extends AbstractModel {
    private int $id;
    private int $id_patient;
    private int $date;
    private int $id_worker;
    private int $id_center_speciality;
    private int $id_user_updater;
    private int $timestamp;

    public function __construct(int $id){
        $this->setId($id);
    }

    public function getId() : int {
        return $this->id;
    }

    public function setId(int $id) : void {
        $this->id = $id;
    }

    public function getIdPatient() : int {
        return $this->id_patient;
    }

    public function setIdPatient(int $id_patient) : void {
        $this->id_patient = $id_patient;
    }

    public function getDate() : int {
        return $this->date;
    }

    public function setDate(int $date) : void {
        $this->date = $date;
    }

    public function getIdWorker() : int {
        return $this->id_worker;
    }

    public function setIdWorker(int $id_worker) : void {
        $this->id_worker = $id_worker;
    }

    public function getIdCenterSpeciality() : int {
        return $this->id_center_speciality;
    }

    public function setIdCenterSpeciality(int $id_center_speciality) : void {
        $this->id_center_speciality = $id_center_speciality;
    }

    public function getTimestamp() : int {
        return $this->timestamp;
    }

    public function setTimestamp(int $timestamp) : void {
        $this->timestamp = $timestamp;
    }

    public function getIdUserUpdater() : int {
        return $this->id_user_updater;
    }

    public function setIdUserUpdater(int $id_user_updater) : void {
        $this->id_user_updater = $id_user_updater;
    }

    public function __toString(): string{
        //TODO:
        return '';
    }
}
?>