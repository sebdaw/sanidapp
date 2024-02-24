<?php
class MedicalCenterMediaDTO extends AbstractDTO {
    private Column $id;
    private Column $id_center;
    private Column $name;
    private Column $position;
    private Column $id_type;

    public function __construct(){
        $this->id = new Column(name:'id',type:'int');
        $this->id_center = new Column(name:'id_center',type:'int');
        $this->name = new Column(name:'name',type:'string');
        $this->position = new Column(name:'position',type:'int');
        $this->id_type = new Column(name:'id_type',type:'int');
    }

    public function getId() : Column {
        return $this->id;
    }

    public function setId(int $id) : void {
        $this->id->setValue($id);
    }

    public function getIdCenter() : Column {
        return $this->id_center;
    }

    public function setIdCenter(int $id_center) : void {
        $this->id->setValue($id_center);
    }

    public function getName() : Column {
        return $this->name;
    }

    public function setName(string $name) : void {
        $this->name->setValue($name);
    }

    public function getPosition() : Column {
        return $this->position;
    }

    public function setPosition(int $position) : void {
        $this->name->setValue($position);
    }

    public function getIdType() : Column {
        return $this->id_type;
    }

    public function setIdType(int $id_type) : void {
        $this->id->setValue($id_type);
    }

    public function getAll() : array {
        $columns = [];
        $columns[] = $this->getId();
        $columns[] = $this->getIdCenter();
        $columns[] = $this->getIdType();
        $columns[] = $this->getName();
        $columns[] = $this->getPosition();
        return $columns;
    }
}
?>