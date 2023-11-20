<?php
class Role extends AbstractModel{
    private int $id;
    private string $name;
    private int $timestamp;
    private ?int $idUpdater;

    public function __construct(int $id,
                                string $name,
                                int $timestamp,
                                ?int $idUpdater){
        $this->setId($id);
        $this->setName($name);
        $this->setTimestamp($timestamp);
        $this->setIdUpdater($idUpdater);
    }

    public function getId() : int {
        return $this->id;
    }

    public function setId(int $id) : void {
        $this->id = $id;
    }

    public function getName() : string {
        return $this->name;
    }

    public function setName(string $name) : void {
        $this->name = $name;
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

    public function __toString() : string{
        //TODO:
        return '';
    }
}
?>