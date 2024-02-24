<?php
class MedicalMembershipDTO extends AbstractDTO {
    private Column $id;
    private Column $name;

    public function __construct(){
        $this->id = new Column(name:'id',type:'int');
        $this->name = new Column(name:'name',type:'string');
    }

    public function getId() : Column {
        return $this->id;
    }

    public function setId(int $id) : void {
        $this->id->setValue($id);
    }

    public function getName() : Column {
        return $this->name;
    }

    public function setName(string $name) : void {
        $this->name->setValue($name);
    }

    public function getAll() : array {
        $columns = [];
        $columns[] = $this->getId();
        $columns[] = $this->getName();
        return $columns;
    }
}
?>