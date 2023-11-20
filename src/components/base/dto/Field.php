<?php
class Field {
    private mixed $value = null;

    public function __construct(mixed $value){
        $this->setValue($value);
    }

    public function getValue() : mixed {
        return $this->value;
    }

    public function setValue(mixed $value) : void {
        $this->value = $value;
    }
}
?>