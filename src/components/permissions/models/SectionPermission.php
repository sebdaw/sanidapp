<?php
class SectionPermission extends AbstractModel {
    private int $id;
    private ?int $idType;
    private ?int $idSection;

    public function __construct(int $id,
                                ?int $idType,
                                ?int $idSection){
        $this->setId($id);
        $this->setIdType($idType);
        $this->setIdSection($idSection);
    }

    public function getId() : int {
        return $this->id;
    }

    public function setId(int $id) : void {
        $this->id = $id;
    }

    public function getIdType() : ?int {
        return $this->idType;
    }

    public function setIdType(int $idType) : void {
        $this->idType = $idType;
    }

    public function getIdSection() : ?int {
        return $this->idSection;
    }

    public function setIdSection(?int $idSection) : void {
        $this->idSection = $idSection;
    }

    public function __toString() : string {
        //TODO:
        return '';
    }
}
?>