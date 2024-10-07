<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Commons\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function login()
    {
        return view('admin/login');
    }

    public function doLogin(Request $request)
    {
        $validated = $request->validate(Rules::LOGIN_RULES);
        if (Auth::attempt($request->only('user', 'password'))) {
            return redirect()->route('admin.buys');
        }
        return back()->withErrors([
            'error' => 'Invalid user or password',
        ]);
    }

    public function doLogout()
    {
        Auth::logout();
        return redirect()->route('custom.login');
    }

    public function buys()
    {
        return view('admin/buys');
    }

    public function supplies()
    {
        return view('admin/supplies');
    }

    public function supplie($id)
    {
        return view('admin/supplie', ['id' => $id]);
    }
}
