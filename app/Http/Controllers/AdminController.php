<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Commons\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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
            $this->setTokenInSession($request);
            return redirect()->route('admin.buys');
        }
        return back()->withErrors([
            'error' => 'Invalid user or password',
        ]);
    }

    private function setTokenInSession(Request $request)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post(url('api/auth'), [
            'user' => $request->input('user'),
            'password' => $request->input('password')
        ]);
        $data = $response->json();
        session(['token' => $data['token']]);
    }

    public function doLogout()
    {
        session()->forget('token');
        Auth::logout();
        return redirect()->route('login');
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
