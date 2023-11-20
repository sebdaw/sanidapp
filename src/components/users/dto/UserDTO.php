<?php
class UserDTO extends AbstractDTO{
    private Column $id;
    private Column $username;
    private Column $password;
    private Column $active;
    private Column $deleted;
    private Column $idRole;
    private Column $date;
    private Column $timestamp;
    private Column $idUpdater;

    public function __construct(){
        $this->id = new Column(name:'id',type:'int');
        $this->username = new Column(name:'username',type:'string');
        $this->password = new Column(name:'password',type:'string');
        $this->active = new Column(name:'active',type:'bool');
        $this->deleted = new Column(name:'deleted',type:'bool');
        $this->idRole = new Column(name:'id_role',type:'int');
        $this->date = new Column(name:'date',type:'date');
        $this->timestamp = new Column(name:'timestamp',type:'int');
        $this->idUpdater = new Column(name:'id_user_updater',type:'int');
    }

    public function getId() : Column {
        return $this->id;
    }

    public function setId(?int $id) : void {
        $this->id->setValue($id);
    }

    public function getUsername() : Column {
        return $this->username;
    }

    public function setUsername(?string $username) : void {
        $this->username->setValue($username);
    }

    public function getPassword() : Column {
        return $this->password;
    }

    public function setPassword(?string $password) : void {
        $this->password->setValue($password);
    }

    public function isActive() : Column {
        return $this->active;
    }

    public function setActive(?bool $active) : void {
        $this->active->setValue($active);
    }

    public function isDeleted() : Column {
        return $this->deleted;
    }

    public function setDeleted(?bool $deleted) : void {
        $this->deleted->setValue($deleted);
    }

    public function getIdRole() : Column {
        return $this->idRole;
    }

    public function setIdRole(?int $idRole) : void {
        $this->idRole->setValue($idRole);
    }

    public function getDate() : Column {
        return $this->date;
    }

    public function setDate(?int $from, ?int $to=null) : void{
        $value = [
            'from' => $from,
            'to' => $to
        ];
        $this->date->setValue($value);
    }

    public function getTimestamp() : Column {
        return $this->timestamp;
    }

    public function setTimestamp(?int $timestamp) : void {
        $this->timestamp->setValue($timestamp);
    }

    public function getIdUpdater() : Column {
        return $this->idUpdater;
    }

    public function setIdUpdater(?int $idUpdater) : void {
        $this->idUpdater->setValue($idUpdater);
    }

    public function getAll() : array {
        $columns = [];
        $columns[] = $this->getId();
        $columns[] = $this->getUsername();
        $columns[] = $this->getPassword();
        $columns[] = $this->isActive();
        $columns[] = $this->isDeleted();
        $columns[] = $this->getIdRole();
        $columns[] = $this->getDate();
        $columns[] = $this->getTimestamp();
        $columns[] = $this->getIdUpdater();
        return $columns;
    }
}
?>