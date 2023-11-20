<?php

namespace App\Http\Services;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function readAll(): Collection
    {
        return User::all();
    }

    public function update($userData, $id){

        $user = User::findOrFail($id);

        $user -> name = $userData -> name;
        $user -> email = $userData -> email;

        $role = $user -> getRoleNames() -> first();

        $user -> removeRole($role);
        $user -> assignRole(request('role'));

        $user -> save();

    }

    public function delete($id){
        $user = User::findOrFail($id);

        $user -> delete();
    }

    public function create($userData){
        $user = User::create([
            "name" => $userData -> name,
            "email" => $userData -> email,
            "password" => Hash::make($userData -> password),
        ]);

        $user -> assignRole($userData -> role);

        return $user;
    }
}
