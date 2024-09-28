<?php

namespace App\Commons;

class Rules
{
    public const SUPPLIE_RULES = [
        'name' => 'required|string|max:100',
        'description' => 'required|string',
        'grade' => 'required|integer|min:1|max:6',
        'price' => 'required|numeric',
        'images' => 'required|array',
        'images.*.url' => 'required|string|max:100',
    ];

    public const USER_RULES = [
        'user' => 'required|string|max:30|unique:users',
        'email' => 'required|string|email|max:50',
        'password' => 'required|string|confirmed|max:50',
    ];

    public const LOGIN_RULES = [
        'user' => 'required|string|max:30',
        'password' => 'required|string|max:50',
    ];
}
