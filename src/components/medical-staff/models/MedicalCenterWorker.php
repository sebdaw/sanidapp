<?php
class MedicalCenterWorker extends AbstractModel {
    private int $id;
    private int $id_health_staff;
    private int $id_center_speciality;
    private int $id_job_position;
    private bool $active;
    private int $from;
    private int $to;
    private int $timestamp;
    private int $id_user_updater;

    public function __construct(int $id, int $id_health_staff, int $id_center_speciality, int $id_job_position, bool $active, int $from, int $to, int $timestamp, int $id_user_updater){
        $this->setId($id);
        $this->setIdHealthStaff($id_health_staff);
        $this->setIdCenterSpeciality($id_center_speciality);
        $this->setIdJobPosition($id_job_position);
        $this->setActive($active);
        $this->setFrom($from);
        $this->setTo($to);
        $this->setTimestamp($timestamp);
        $this->setIdUserUpdater($id_user_updater);
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

    public function getIdCenterSpeciality() : int {
        return $this->id_center_speciality;
    }

    public function setIdCenterSpeciality(int $id_center_speciality) : void {
        $this->id_center_speciality = $id_center_speciality;
    }

    public function getIdJobPosition() : int {
        return $this->id_job_position;
    }

    public function setIdJobPosition(int $id_job_position) : void {
        $this->id_job_position = $id_job_position;
    }

    public function isActive() : bool {
        return $this->active;
    }

    public function setActive(bool $active) : void {
        $this->active = $active;
    }

    public function getFrom() : int {
        return $this->from;
    }

    public function setFrom(int $from) : void {
        $this->from = $from;
    }

    public function getTo() : int {
        return $this->to;
    }

    public function setTo(int $to) : void {
        $this->to = $to;
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