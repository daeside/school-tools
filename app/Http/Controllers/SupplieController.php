<?php

namespace App\Http\Controllers;

use App\Models\Supplie;
use App\Models\SupplieImage;
use App\Models\User;

class SupplieController extends Controller
{
    public function index()
    {
        $supplie = new Supplie();
        $all = $supplie->all()->first();//->id();
        var_dump($all->supplieImages[1]->url);
        return null;
    }
}