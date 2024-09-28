<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Commons\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function login()
    {
        $pageName = env('PAGE_NAME');
        return view('admin/login', compact('pageName'));
    }

    public function doLogin(Request $request)
    {
        $validated = $request->validate(Rules::LOGIN_RULES);
        if (Auth::attempt($request->only('user', 'password'))) {
            return redirect()->intended('admin/supplies');
        }
        return back()->withErrors([
            'user' => 'Invalid user or password',
        ]);
    }

    public function doLogout()
    {
        Auth::logout();
        return redirect()->route('custom.login');
    }

    public function supplies(Request $request)
    {
        /*$pageName = env('PAGE_NAME');
        return view('admin/login', compact('pageName'));*/
        return 12;
    }
}
