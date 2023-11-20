<?php
class TownDTO extends AbstractDTO {
    private Column $id;
    private Column $name;
    private Column $idProvince;

    public function __construct(){
        $this->id = new Column(name:'id',type:'int');
        $this->name = new Column(name:'name',type:'string');
        $this->idProvince = new Column(name:'id_province',type:'int');
    }

    public function getId() : Column {
        return $this->id;
    }

    public function setId(?int $id) : void {
        $this->id->setValue($id);
    }

    public function getName() : Column {
        return $this->name;
    }

    public function setName(?string $name) : void {
        $this->name->setValue($name);
    }

    public function getIdProvince() : Column {
        return $this->idProvince;
    }

    public function setIdProvince(?int $idProvince) : void {
        $this->idProvince->setValue($idProvince);
    }

    public function getAll() : array {
        $columns = [];
        $columns[] = $this->getId();
        $columns[] = $this->getName();
        $columns[] = $this->getIdProvince();
        return $columns;
    }
}
?>