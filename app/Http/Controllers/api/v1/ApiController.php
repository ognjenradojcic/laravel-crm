<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Dto\auth\UserLoginData;
use App\Http\Dto\auth\UserRegisterData;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiController extends Controller
{
    public function register(UserRegisterData $data){

        $user = User::create([
            'name' => $data -> name,
            'email' => $data -> email,
            'password' => Hash::make($data -> password)
        ]);

        $user -> assignRole("User");

        return response() -> json([
            "message" => "User registered successfully"
        ]);
    }

    public function login(UserLoginData $data){

        $token = JWTAuth::attempt([
            "email" => $data->email,
            "password" => $data->password
        ]);

        if(!empty($token)){
            return response() -> json([
                "message" => "User logged successfully",
                "token" => $token
            ]);
        }

        return response()->json([
            "message" => "Invalid details"
        ]);
    }

    public function profile(){

        $userData = auth()->user();

        return response() -> json([
            "message" => "Profile data",
            "data" => $userData
        ]);
    }

    public function refreshToken(){

        $newToken = auth() -> refresh();

        return response() -> json([
                "token" => $newToken
            ]);

    }

    public function logout(){
        auth() -> logout();

        return response()-> json([
            "message" => "User logged out successfully"
        ]);
    }
}
