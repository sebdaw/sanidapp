<?php
class HealthStaffSpeciality extends AbstractModel {
    private int $id;
    private int $id_health_staff;
    private int $id_speciality;
    private int $date;
    private int $id_user_updater;
    private int $timestamp;

    public function __construct(int $id, int $id_health_staff, int $id_speciality, int $date, int $id_user_updater, int $timestamp){
        $this->setId($id);
        $this->setIdHealthStaff($id_health_staff);
        $this->setIdSpeciality($id_speciality);
        $this->setDate($date);
        $this->setIdUserUpdater($id_user_updater);
        $this->setTimestamp($timestamp);
    }

    public function getId() : int {
        return $this->id;
    }

    public function setId(int $id) : void {
        $this->id = $id;
    }

    public function getIdHealthStaff() : int {
        return $this->id_health_staff;
    }

    public function setIdHealthStaff(int $id_health_staff) : void {
        $this->id_health_staff = $id_health_staff;
    }

    public function getIdSpeciality() : int {
        return $this->id_speciality;
    }

    public function setIdSpeciality(int $id_speciality) : void {
        $this->id_speciality = $id_speciality;
    }

    public function getDate() : int {
        return $this->date;
    }

    public function setDate(int $id_speciality) : void {
        $this->id_speciality = $id_speciality;
    }

    public function getIdUserUpdater() : int {
        return $this->id_user_updater;
    }

    public function setIdUserUpdater(int $id_user_updater) : void {
        $this->id_user_updater = $id_user_updater;
    }

    public function getTimestamp() : int {
        return $this->timestamp;
    }

    public function setTimestamp(int $timestamp) : void {
        $this->timestamp = $timestamp;
    }

    public function __toString(): string{
        //TODO:
        return '';
    }
}
?>