<?php
class PermissionTypeDTO extends AbstractDTO {
    private Column $id;
    private Column $name;
    private Column $description;

    public function __construct(){
        $this->id = new Column(name:'id',type:'int');
        $this->name = new Column(name:'name',type:'string');
        $this->description = new Column(name:'description',type:'string');
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

    public function getDescription() : Column {
        return $this->description;
    }

    public function setDescription(?string $description) : void {
        $this->description->setValue($description);
    }

    public function getAll() : array {
        $columns = [];
        $columns[] = $this->getId();
        $columns[] = $this->getName();
        $columns[] = $this->getDescription();
        return $columns;
    }
}
?>