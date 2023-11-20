<?php
class Section extends AbstractModel{
    private int $id;
    private string $name;
    private string $icon;
    private string $path;
    private ?int $idBlock;
    private ?int $order;
    private int $timestamp;
    private ?int $idUpdater;

    public function __construct(int $id,
                                string $name,
                                string $icon,
                                string $path,
                                ?int $idBlock,
                                ?int $order,
                                int $timestamp,
                                ?int $idUpdater){
        $this->setId($id);
        $this->setName($name);
        $this->setIcon($icon);
        $this->setPath($path);
        $this->setIdBlock($idBlock);
        $this->setOrder($order);
        $this->setTimestamp($timestamp);
        $this->setIdUpdater($idUpdater);
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

    public function getIcon() : string {
        return $this->icon;
    }

    public function setIcon(string $icon) : void {
        $this->icon = $icon;
    }

    public function getPath() : string {
        return $this->path;
    }

    public function setPath(string $path) : void {
        $this->path = $path;
    }

    public function getIdBlock() : ?int {
        return $this->idBlock;
    }

    public function setIdBlock(int $idBlock) : void {
        $this->idBlock = $idBlock;
    }

    public function getOrder() : ?int {
        return $this->order;
    }

    public function setOrder(?int $order) : void {
        $this->order = $order;
    }

    public function getTimestamp() : array {
        return Date::getDate($this->timestamp);
    }

    public function setTimestamp(int $timestamp) : void {
        $this->timestamp = $timestamp;
    }

    public function getIdUpdater() : ?int {
        return $this->idUpdater;
    }

    public function setIdUpdater(?int $idUpdater) : void {
        $this->idUpdater = $idUpdater;
    }

    public function __toString(){
        //TODO
        return '';
    }
}
?>