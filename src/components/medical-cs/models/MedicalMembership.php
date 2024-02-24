<?php
class MedicalMembership extends AbstractModel {
    private int $id;
    private string $name;

    public function __construct(int $id, string $name){
        $this->setId($id);
        $this->setName($name);
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

    public function __toString(): string{
        //TODO:
        return '';
    }
}
?>