<?php
class User extends AbstractModel {
    private int $id;
    private string $username;
    private string $password;
    private bool $active;
    private bool $deleted;
    private ?int $idRole;
    private int $date;
    private int $timestamp;
    private ?int $idUpdater;

    public function __construct(int $id,
                                string $username,
                                string $password,
                                bool $active,
                                bool $deleted,
                                ?int $idRole,
                                ?int $date,
                                int $timestamp,
                                int $idUpdater){
        $this->setId($id);
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setActive($active);
        $this->setDeleted($deleted);
        $this->setIdRole($idRole);
        $this->setDate($date);
        $this->setTimestamp($timestamp);
        $this->setIdUpdater($idUpdater);
    }

    public function getId() : int {
        return $this->id;
    }

    public function setId(int $id) : void {
        $this->id = $id;
    }

    public function getUsername() : string {
        return $this->username;
    }

    public function setUsername(string $username) : void {
        $this->username = $username;
    }

    public function getPassword() : string {
        return $this->password;
    }

    public function setPassword(string $password) : void {
        $this->password = $password;
    }

    public function isActive() : bool {
        return $this->active;
    }

    public function setActive(bool $active) : void {
        $this->active = $active;
    }

    public function isDeleted() : bool {
        return $this->deleted;
    }

    public function setDeleted(bool $deleted) : void {
        $this->deleted = $deleted;
    }

    public function getIdRole() : ?int {
        return $this->idRole;
    }

    public function setIdRole(int $idRole) : void {
        $this->idRole = $idRole;
    }

    public function getDate() : array{
        return Date::getDate($this->date);
    }

    public function setDate(?int $timestamp) : void{
        $this->date = $timestamp;
    }

    public function getTimestamp() : array {
        return Date::getDate($this->timestamp);
    }

    public function setTimestamp(int $timestamp) : void {
        $this->timestamp = $timestamp;
    }

    public function getIdUpdater() : ?int {
        return $this->idUpdater;
    }

    public function setIdUpdater(?int $idUpdater) : void {
        $this->idUpdater = $idUpdater;
    }

    public function __toString() : string {
        //TODO:
        return '';
    }
}
?>