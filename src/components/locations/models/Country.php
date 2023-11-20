<?php
class Country extends AbstractModel {
    private int $id;
    private string $nameES;
    private string $nameEN;
    private string $isoA2;

    public function __construct(int $id,
                                string $nameES,
                                string $nameEN,
                                string $isoA2){
        $this->setId($id);
        $this->setNameES($nameES);
        $this->setNameEN($nameEN);
        $this->setIsoA2($isoA2);
    }

    public function getId() : int {
        return $this->id;
    }

    public function setId(int $id) : void {
        $this->id = $id;
    }

    public function getNameES() : string {
        return $this->nameES;
    }

    public function setNameES(string $nameES) : void {
        $this->nameES = $nameES;
    }

    public function getNameEN() : string {
        return $this->nameEN;
    }

    public function setNameEN(string $nameEN) : void {
        $this->nameEN = $nameEN;
    }

    public function getIsoA2() : string {
        return $this->isoA2;
    }

    public function setIsoA2(string $isoA2) : void {
        $this->isoA2 = $isoA2;
    }

    public function __toString() : string {
        //TODO
        return '';
    }
}
?>