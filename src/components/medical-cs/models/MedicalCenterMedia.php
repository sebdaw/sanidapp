<?php
class MedicalCenterMedia extends AbstractModel {
    private int $id;
    private int $id_center;
    private string $name;
    private int $position;
    private int $id_type;

    public function __construct(int $id, int $id_center,string $name, int $position, int $id_type){
        $this->setId($id);
        $this->setIdCenter($id_center);
        $this->setName($name);
        $this->setPosition($position);
        $this->setIdType($id_type);
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

    public function getName() : string {
        return $this->name;
    }

    public function setName(string $name) : void {
        $this->name = $name;
    }

    public function getPosition() : int {
        return $this->position;
    }

    public function setPosition(int $position) : void {
        $this->position = $position;
    }

    public function getIdType() : int {
        return $this->id_type;
    }

    public function setIdType(int $id_type) : void {
        $this->id_type = $id_type;
    }

    public function __toString(): string{
        //TODO:
        return '';
    }
}
?>