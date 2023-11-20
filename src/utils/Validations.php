<?php
class Validations {
    public static function isInteger(mixed $num) : bool {
        //TODO: validar rango de enteros
        if (!is_numeric($num))
            return false;
        $num = intval($num);
        return ($num==floor($num));
    }

    public static function isFloat(mixed $num) : bool {
        return is_numeric($num) && !static::isInteger($num);
    }
}
?>