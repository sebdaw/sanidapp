<?php
class SectionPermissionDTO extends AbstractDTO {
    private Column $id;
    private Column $idType;
    private Column $idSection;

    public function __construct(){
        $this->id = new Column(name:'id',type:'int');
        $this->idType = new Column(name:'id_permission_type',type:'int');
        $this->idSection = new Column(name:'id_section',type:'int');
    }

    public function getId() : Column {
        return $this->id;
    }

    public function setId(?int $id) : void {
        $this->id->setValue($id);
    }

    public function getIdType() : Column {
        return $this->idType;
    }

    public function setIdType(?int $idType) : void {
        $this->idType->setValue($idType);
    }

    public function getIdSection() : Column {
        return $this->idSection;
    }

    public function setIdSection(?int $idSection) : void {
        $this->idSection->setValue($idSection);
    }

    public function getAll() : array {
        $columns = [];
        $columns[] = $this->getId();
        $columns[] = $this->getIdType();
        $columns[] = $this->getIdSection();
        return $columns;
    }
}
?>