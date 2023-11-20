<?php
class Column {
    private string $name;
    private string $type;
    private ?Field $field = null;

    public function __construct(string $name, string $type){
        $this->setName($name);
        $this->setType($type);
    }

    public function getName() : string {
        return $this->name;
    }

    public function setName(string $name) : void {
        $this->name = $name;
    }

    public function getType() : string {
        return $this->type;
    }

    public function setType(string $type) : void {
        $this->type = $type;
    }

    public function isset() : bool {
        return !is_null($this->field);
    }

    public function getValue() : mixed {
        return $this->isset()? $this->field->getValue() : null;
    }

    public function setValue(mixed $value) : void {
        $this->field = new Field($value);
    }
}
?>