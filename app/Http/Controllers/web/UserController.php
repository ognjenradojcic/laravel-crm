<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index(){

        $users = User::all();

        return view('users',[
            'users' => $users
        ]);
    }

    public function destroy($id){

        $user = User::findOrFail($id);

        $user -> delete();

        return redirect("/users");

    }

    public function update($id){

        request() -> validate([
            "name" => "required",
            "email" => "required|email",
        ]);

        $user = User::findOrFail($id);

        $user -> name = request('name');
        $user -> email = request('email');

        $role = $user -> getRoleNames() -> first();

        $user -> removeRole($role);
        $user -> assignRole(request('role'));

        $user -> save();

        return redirect("/users");
    }

    public function store(){

        $user = new User();

        request() -> validate([
            "name" => "required",
            "email" => "required|email",
            "password" => "required",
            "role" => "required"
        ]);

        $user -> name = request('name');
        $user -> email = request('email');
        $user -> password = Hash::make(request('password'));

        $user -> assignRole(request('role'));

        $user -> save();

        return redirect("/users");
    }
}
