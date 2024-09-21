<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function login()
    {
        $pageName = env('PAGE_NAME');
        return view('admin/login', compact('pageName'));
    }
}
