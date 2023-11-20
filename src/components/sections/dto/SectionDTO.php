<?php
class SectionDTO extends AbstractDTO{
    private Column $id;
    private Column $name;
    private Column $icon;
    private Column $path;
    private Column $idBlock;
    private Column $order;
    private Column $timestamp;
    private Column $idUpdater;

    public function __construct(){
        $this->id = new Column(name:'id',type:'int');
        $this->name = new Column(name:'name',type:'string');
        $this->icon = new Column(name:'icon',type:'string');
        $this->path = new Column(name:'path',type:'string');
        $this->idBlock = new Column(name:'id_block',type:'string');
        $this->order = new Column(name:'position',type:'int');
        $this->timestamp = new Column(name:'timestamp',type:'int');
        $this->idUpdater = new Column(name:'id_user_updater',type:'int');
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

    public function getIcon() : Column {
        return $this->icon;
    }

    public function setIcon(string $icon) : void {
        $this->icon->setValue($icon);
    }

    public function getPath() : Column {
        return $this->path;
    }

    public function setPath(string $path) : void {
        $this->path->setValue($path);
    }

    public function getIdBlock() : Column {
        return $this->idBlock;
    }
    
    public function setIdBlock(int $idBlock) : void {
        $this->idBlock->setValue($idBlock);
    }

    public function getOrder() : Column {
        return $this->order;
    }

    public function setOrder(int $order) : void {
        $this->order->setValue($order);
    }

    public function getTimestamp() : Column {
        return $this->timestamp;
    }

    public function setTimestamp(?int $timestamp) : void {
        $this->timestamp->setValue($timestamp);
    }

    public function getIdUpdater() : Column {
        return $this->idUpdater;
    }

    public function setIdUpdater(?int $idUpdater) : void {
        $this->idUpdater->setValue($idUpdater);
    }

    public function getAll() : array {
        $columns = [];
        $columns[] = $this->getId();
        $columns[] = $this->getName();
        $columns[] = $this->getIcon();
        $columns[] = $this->getPath();
        $columns[] = $this->getIdBlock();
        $columns[] = $this->getOrder();
        $columns[] = $this->getTimestamp();
        $columns[] = $this->getIdUpdater();
        return $columns;
    }
}
?>