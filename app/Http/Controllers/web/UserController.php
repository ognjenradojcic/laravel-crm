<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\User;

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

        //todo ADD password updating

        $user = User::findOrFail($id);

        $user -> name = request('name');
        $user -> email = request('email');

        $user -> save();

        return redirect("/users");
    }

    public function store(){

        $user = new User();

        request() -> validate([
            "name" => "required",
            "email" => "required|email",

        ]);

        $user -> name = request('name');
        $user -> email = request('email');

        $user -> save();

        return redirect("/users");
    }
}
