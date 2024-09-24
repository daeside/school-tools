<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function login()
    {
        $pageName = env('PAGE_NAME');
        return view('admin/login', compact('pageName'));
    }

    public function doLogin(Request $request)
    {
        return $request;
        //return redirect()->action([AdminController::class, 'supplies']);
    }

    public function supplies(Request $request)
    {
        /*$pageName = env('PAGE_NAME');
        return view('admin/login', compact('pageName'));*/
        return 12;
    }
}
