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

    public function doLogin()
    {
        return redirect()->action([AdminController::class, 'supplies']);
    }

    public function supplies()
    {
        /*$pageName = env('PAGE_NAME');
        return view('admin/login', compact('pageName'));*/
        return 12;
    }
}
