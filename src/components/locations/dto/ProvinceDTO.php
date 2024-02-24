<?php
class ProvinceDTO extends AbstractDTO {
    private Column $id;
    private Column $name;
    private Column $idCommunity;

    public function __construct(){
        $this->id = new Column(name:'id',type:'int');
        $this->name = new Column(name:'name',type:'string');
        $this->idCommunity = new Column(name:'id_community',type:'int');
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

    public function getIdCommunity() : Column {
        return $this->idCommunity;
    }

    public function setIdCommunity(?int $idCommunity) : void {
        $this->idCommunity->setValue($idCommunity);
    }

    public function getAll() : array {
        $columns = [];
        $columns[] = $this->getId();
        $columns[] = $this->getName();
        $columns[] = $this->getIdCommunity();
        return $columns;
    }
}
?>