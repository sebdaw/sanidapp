<?php
class Validations {
    public static function isInteger(mixed $num, bool $strict=false) : bool {
        if (!is_numeric($num))
            return false;
        if ($strict)
            return intval($num)==floor($num);
        else
            return ($num==floor($num));
    }

    public static function isFloat(mixed $num) : bool {
        return is_numeric($num) && !static::isInteger($num);
    }

    public static function isNumericArray(array $arr) : bool {
        $keys = array_filter(array_keys($arr),function($n){
            return !static::isInteger($n);
        });
        return empty($keys);
    }
}
?>