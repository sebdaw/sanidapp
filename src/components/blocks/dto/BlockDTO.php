<?php
class BlockDTO extends AbstractDTO{
    private Column $id;
    private Column $name;
    private Column $order;
    private Column $timestamp;
    private Column $idUpdater;

    public function __construct(){
        $this->id = new Column(name:'id',type:'int');
        $this->name = new Column(name:'name',type:'string');
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
        $columns[] = $this->getOrder();
        $columns[] = $this->getTimestamp();
        $columns[] = $this->getIdUpdater();
        return $columns;
    }
}
?>