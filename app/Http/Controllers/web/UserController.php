<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Dto\user\CreateUserData;
use App\Http\Dto\user\UpdateUserData;
use App\Http\Services\UserService;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    public function __construct(protected UserService $service)
    {
    }

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

        $userData = UpdateUserData::from(request());

        $this->service->update($userData, $id);

        return redirect("/users");
    }

    public function store(){

        $userData = CreateUserData::from(request());

        $this->service->create($userData);

        return redirect("/users");
    }
}
