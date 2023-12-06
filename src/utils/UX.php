<?php
class UX {
    public static function combo(string $name, array $options=[], mixed $selectedOption=-1, array $properties=[], ?array $defaultOption = [-1,'']) : string {
        $_properties = @implode(' ',$properties);
        $tag = "<select name='{$name}' id='{$name}' {$_properties}>";
        if (!is_null($defaultOption))
            array_unshift($options,$defaultOption);

        foreach($options as $option){
            $selected = $option[0]==$selectedOption? 'selected' : null;
            $tag .= "<option value='{$option[0]}' {$selected}>{$option[1]}</option>";
        }
        $tag .= "</select>";
        return $tag;
    }
}
?>