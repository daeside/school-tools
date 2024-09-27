<?php

namespace App\Commons;

class Validator
{

    public static function getQuerySize(?String $value): string
    {
        if ($value != null && trim($value) != '' && is_numeric($value) && $value != '0') {
            return $value;
        }
        return '1';
    }
}
