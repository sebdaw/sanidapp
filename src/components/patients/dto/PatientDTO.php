<?php
class PatientDTO extends AbstractDTO {
    private Column $id;
    private Column $id_profile;
    private Column $id_worker;
    private Column $timestamp;
    private Column $id_user_updater;

    public function __construct(){
        $this->id = new Column(name:'id',type:'int');
        $this->id_profile = new Column(name:'id_profile',type:'int');
        $this->id_worker = new Column(name:'id_worker',type:'int');
        $this->timestamp = new Column(name:'timestamp',type:'int');
        $this->id_user_updater = new Column(name:'id_user_updater',type:'int');
    }

    public function getId() : Column {
        return $this->id;
    }

    public function setId(int $id) : void {
        $this->id->setValue($id);
    }

    public function getIdProfile() : Column {
        return $this->id_profile;
    }

    public function setIdProfile(int $id_profile) : void {
        $this->id_profile->setValue($id_profile);
    }

    public function getIdWorker() : Column {
        return $this->id_worker;
    }

    public function setIdWorker(int $id_worker) : void {
        $this->id_worker->setValue($id_worker);
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
        $columns[] = $this->getIdProfile();
        $columns[] = $this->getIdWorker();
        $columns[] = $this->getTimestamp();
        $columns[] = $this->getIdUserUpdater();
        return $columns;
    }
}
?>