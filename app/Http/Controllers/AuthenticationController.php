<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        if (!($token = auth()->attempt($credentials))) {
            return response()->json(["error" => "Unauthorized"], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(["message" => "Successfully logged out"]);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            "access_token" => $token,
            "token_type" => "bearer",
            "expires_in" => auth()->factory()->getTTL() * 60,
        ]);
    }
}
