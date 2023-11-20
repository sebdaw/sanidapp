<?php
class CommunityDTO extends AbstractDTO {
    private Column $id;
    private Column $name;
    private Column $idCountry;

    public function __construct(){
        $this->id = new Column(name:'id',type:'int');
        $this->name = new Column(name:'name',type:'string');
        $this->idCountry = new Column(name:'id_country',type:'int');
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

    public function getIdCountry() : Column {
        return $this->idCountry;
    }

    public function setIdCountry(?int $idCountry) : void {
        $this->idCountry->setValue($idCountry);
    }

    public function getAll() : array {
        $columns = [];
        $columns[] = $this->getId();
        $columns[] = $this->getName();
        $columns[] = $this->getIdCountry();
        return $columns;
    }
}
?>