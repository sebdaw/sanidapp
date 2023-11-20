<?php
class Province extends AbstractModel {
    private int $id;
    private string $name;
    private ?int $idCommunity;

    public function __construct(int $id,
                                string $name,
                                ?int $idCommunity){
        $this->setId($id);
        $this->setName($name);
        $this->setIdCommunity($idCommunity);
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

    public function getIdCommunity() : ?int {
        return $this->idCommunity;
    }

    public function setIdCommunity(?int $idCommunity) : void {
        $this->idCommunity = $idCommunity;
    }

    public function __toString() : string {
        //TODO
        return '';
    }
}
?>