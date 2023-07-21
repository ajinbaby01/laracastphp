<?php

class Validator
{

    const test = 0;

    public static function string($value, $min = 1, $max = INF)
    {
        $value = trim($value);

        return strlen($value) >= $min && strlen($value) <= $max;
    }

    public function email($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}

?>