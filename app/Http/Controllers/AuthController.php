<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commons\Rules;
use Exception;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Carbon\Carbon;

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
                'expiresIn' => $this->getExpiresIn()
            ]);
        } catch (Exception $ex) {
            return $this->handleException($request, $ex);
        }
    }

    private function getExpiresIn(): string
    {
        $expiration = JWTAuth::factory()->getTTL() * 60;
        return Carbon::now()->addSeconds($expiration)->setTimezone('UTC')->toIso8601String();
    }
}
