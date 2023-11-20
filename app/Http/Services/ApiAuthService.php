<?php

namespace App\Http\Services;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiAuthService
{
    public function login($userLoginData){
        return JWTAuth::attempt([
            "email" => $userLoginData->email,
            "password" => $userLoginData->password
        ]);
    }

    public function register($userRegisterData){
        $user = User::create([
            'name' => $userRegisterData -> name,
            'email' => $userRegisterData -> email,
            'password' => Hash::make($userRegisterData -> password)
        ]);

        $user -> assignRole("User");
    }
}
