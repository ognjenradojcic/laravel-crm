<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Client;

class ClientController extends Controller
{

    public function index(){

        $clients = Client::all();

        return view('client',[
            'clients' => $clients
        ]);
    }

    public function destroy($id){

        $client = Client::findOrFail($id);

        $client -> delete();

        return redirect("/clients");

    }

    public function update($id){

        request() -> validate([
            "name" => "required",
            "email" => "required|email",
            "number" => "required",
            "address" => "required",
            "industry" => "required",
        ]);

        $client = Client::findOrFail($id);

        $client -> name = request('name');
        $client -> email = request('email');
        $client -> number = request('number');
        $client -> address = request('address');
        $client -> industry = request('industry');

        $client -> save();

        return redirect("/clients");
    }

    public function store(){

        $client = new Client();

        request() -> validate([
            "name" => "required",
            "email" => "required|email",
            "number" => "required",
            "address" => "required",
            "industry" => "required",
        ]);

        $client -> name = request('name');
        $client -> email = request('email');
        $client -> number = request('number');
        $client -> address = request('address');
        $client -> industry = request('industry');

        $client -> save();

        return redirect("/clients");
    }
}
