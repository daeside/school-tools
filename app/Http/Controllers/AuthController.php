<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commons\Rules;
use Exception;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function auth(Request $request)
    {
        try {
            $validated = $request->validate(Rules::LOGIN_RULES);
            if (!$token = JWTAuth::attempt($request->only('user', 'password'))) {
                return response()->json([
                    'error' => 'Invalid user or password'
                ], Response::HTTP_UNAUTHORIZED);
            }
            return response()->json([
                'token' => $token,
                'expiresInSeconds' => config('jwt.ttl') * 60
            ]);
        } catch (Exception $ex) {
            return $this->handleException($request, $ex);
        }
    }
}
