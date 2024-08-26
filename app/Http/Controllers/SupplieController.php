<?php

namespace App\Http\Controllers;

use App\Models\Supplie;
use App\Models\User;

class SupplieController extends Controller
{
    public function index()
    {
        $supplie = new Supplie();
        $all = $supplie->all()[0];
        var_dump($all);
        return null;
    }
}