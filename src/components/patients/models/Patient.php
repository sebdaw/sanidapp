<?php
class Patient extends AbstractModel {
    private int $id;
    private int $id_profile;
    private int $id_worker;
    private int $timestamp;
    private int $id_user_updater;

    public function __construct(int $id, int $id_profile, int $id_worker, int $timestamp, int $id_user_updater){
        $this->setId($id);
        $this->setIdProfile($id_profile);
        $this->setIdWorker($id_worker);
        $this->setTimestamp($timestamp);
        $this->setIdUserUpdater($id_user_updater);
    }

    public function getId() : int {
        return $this->id;
    }

    public function setId(int $id) : void {
        $this->id = $id;
    }

    public function getIdProfile() : int {
        return $this->id_profile;
    }

    public function setIdProfile(int $id_profile) : void {
        $this->id_profile = $id_profile;
    }

    public function getIdWorker() : int {
        return $this->id_worker;
    }

    public function setIdWorker(int $id_worker) : void {
        $this->id_worker = $id_worker;
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