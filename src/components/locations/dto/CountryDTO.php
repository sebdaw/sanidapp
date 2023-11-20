<?php
class CountryDTO extends AbstractDTO {
    private Column $id;
    private Column $nameES;
    private Column $nameEN;
    private Column $isoA2;

    public function __construct(){
        $this->id = new Column(name:'id',type:'int');
        $this->nameES = new Column(name:'nameES',type:'string');
        $this->nameEN = new Column(name:'nameEN',type:'string');
        $this->isoA2 = new Column(name:'isoA2',type:'string');
    }

    public function getId() : Column {
        return $this->id;
    }

    public function setId(?int $id) : void {
        $this->id->setValue($id);
    }

    public function getNameES() : Column {
        return $this->nameES;
    }

    public function setNameES(?string $nameES) : void {
        $this->nameES->setValue($nameES);
    }

    public function getNameEN() : ?Column {
        return $this->nameEN;
    }

    public function setNameEN(?string $nameEN) : void {
        $this->nameEN->setValue($nameEN);
    }

    public function getIsoA2() : Column {
        return $this->isoA2;
    }

    public function setIsoA2(?string $isoA2) : void {
        $this->isoA2->setValue($isoA2);
    }

    public function getAll() : array {
        $columns = [];
        $columns[] = $this->getId();
        $columns[] = $this->getNameES();
        $columns[] = $this->getNameEN();
        $columns[] = $this->getIsoA2();
        return $columns;
    }
}
?>