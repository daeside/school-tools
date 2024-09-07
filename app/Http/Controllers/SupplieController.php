<?php

namespace App\Http\Controllers;

use App\Models\Supplie;
use App\Models\SupplieImage;
use App\Models\User;

class SupplieController extends Controller
{
    public function index()
    {
        $supplie = new User();
        $all = $supplie->all()[0];
        var_dump($all->password);
        return null;
    }
}