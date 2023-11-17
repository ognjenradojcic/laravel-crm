<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiController extends Controller
{
    public function register(Request $request){

        $request -> validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|confirmed"
        ]);

        User::create([
            'name' => $request -> name,
            'email' => $request -> email,
            'password' => Hash::make($request -> password)
        ]);

        return response() -> json([
            "status" => true,
            "message" => "User registered successfully"
        ]);
    }

    public function login(Request $request){

        $request -> validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        $token = JWTAuth::attempt([
            "email" => $request->email,
            "password" => $request->password
        ]);

        if(!empty($token)){

            return response() -> json([
                "status" => true,
                "message" => "User logged successfully",
                "token" => $token
            ]);
        }

        return response()->json([
            "status" => false,
            "message" => "Invalid details"
        ]);
    }

    public function profile(){

        $userData = auth()->user();

        return response() -> json([
            "status" => true,
            "message" => "Profile data",
            "data" => $userData
        ]);
    }

    public function refreshToken(){

        $newToken = auth() -> refresh();

        return response() -> json([
                "status" => true,
                "message" => "New access token",
                "token" => $newToken
            ]);

    }

    public function logout(){
        auth() -> logout();

        return response()-> json([
            "status" => true,
            "message" => "User logged out successfully"
        ]);
    }
}
