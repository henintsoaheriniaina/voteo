<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'email|required',
            'password' => 'string|required',
        ]);

        $user = User::where('email', $fields['email'])->first();
        if (!$user || !$user->matchPass($fields['password'])) {
            return response([
                "errors" => [
                    "email" => ["Bad credentials"],
                    "password" => ["Bad credentials"]
                ],
            ], 401);
        }

        $token = $user->createToken($user->name)->plainTextToken;

        return response([
            "user" => $user,
            "token" => $token,
        ], 201);
    }
    public function register(Request $request)
    {

        $fields = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create($fields);
        $token = $user->createToken($user->name)->plainTextToken;

        return response([
            "user" => $user,
            "token" => $token,
        ], 201);
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response(["message" => "Logged out successfully"]);
    }
}
