<?php
class Town extends AbstractModel {
    private int $id;
    private string $name;
    private ?int $idProvince;

    public function __construct(int $id,
                                string $name,
                                ?int $idProvince){
        $this->setId($id);
        $this->setName($name);
        $this->setIdProvince($idProvince);
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

    public function getIdProvince() : ?int {
        return $this->idProvince;
    }

    public function setIdProvince(?int $idProvince) : void {
        $this->idProvince = $idProvince;
    }

    public function __toString() : string {
        //TODO
        return '';
    }
}
?>