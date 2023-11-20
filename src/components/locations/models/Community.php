<?php
class Community extends AbstractModel {
    private int $id;
    private string $name;
    private ?int $idCountry;

    public function __construct(int $id,
                                string $name,
                                ?int $idCountry){
        $this->setId($id);
        $this->setName($name);
        $this->setIdCountry($idCountry);
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

    public function getIdCountry() : ?int {
        return $this->idCountry;
    }

    public function setIdCountry(?int $idCountry) : void {
        $this->idCountry = $idCountry;
    }

    public function __toString() : string {
        //TODO
        return '';
    }
}
?>