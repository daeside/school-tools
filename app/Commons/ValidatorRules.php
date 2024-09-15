<?php

namespace App\Commons;

class ValidatorRules
{

    private static $supplieRules = [
        'name' => 'required|string|max:100',
        'description' => 'required|string',
        'grade' => 'required|integer|min:1|max:6',
        'price' => 'required|numeric',
        'images' => 'required|array',
        'images.*.url' => 'required|string|max:100',
    ];

    public static function supplie(): array
    {
        return self::$supplieRules;
    }
}
