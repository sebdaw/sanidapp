<?php
class MedicalCenterSpeciality extends AbstractModel {
    private int $id;
    private int $id_center;
    private int $id_speciality;
    private string $description;
    private bool $active;
    private int $timestamp;
    private int $id_user_updater;

    public function __construct(int $id, int $id_center, int $id_speciality, string $description, bool $active, int $timestamp, int $id_user_updater){
        $this->setId($id);
        $this->setIdCenter($id_center);
        $this->setIdSpeciality($id_speciality);
        $this->setDescription($description);
        $this->setActive($active);
        $this->setTimestamp($timestamp);
        $this->setIdUserUdapter($id_user_updater);
    }

    public function getId() : int {
        return $this->id;
    }

    public function setId(int $id) : void {
        $this->id = $id;
    }

    public function getIdCenter() : int {
        return $this->id_center;
    }

    public function setIdCenter(int $id_center) : void {
        $this->id_center = $id_center;
    }

    public function getIdSpecility() : int {
        return $this->id_speciality;
    }

    public function setIdSpeciality(int $id_speciality) : void {
        $this->id_speciality = $id_speciality;
    }

    public function getDescription() : string {
        return $this->description;
    }

    public function setDescription(string $description) : void {
        $this->description = $description;
    }

    public function isActive() : int {
        return $this->active;
    }

    public function setActive(bool $active) : void {
        $this->active = $active;
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

    public function setIdUserUdapter(int $id_user_updater) : void {
        $this->id_user_updater = $id_user_updater;
    }

    public function __toString(): string{
        //TODO:
        return '';
    }
}
?>