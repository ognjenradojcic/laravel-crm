<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;


class ClientController extends Controller
{
    public function index(){
        return Client::all();
    }

    public function show($id){
        return Client::findOrFail($id);
    }

    public function store(Request $request){
        $request->validate([
            "name" => "required",
            "email" => "required|email",
            "number" => "required",
            "address" => "required",
            "industry" => "required",
            "company_id" => "required"
        ]);

        $client = Client::create([
            "name" => $request -> name,
            "email" => $request -> email,
            "number" => $request -> number,
            "address" => $request -> address,
            "industry" => $request -> industry,
            "company_id" => $request -> company_id,
        ]);

        return response() -> json($client);
    }

    public function destroy($id){
        $client = Client::findOrFail($id);

        $client -> delete();

        return response() -> json([
            'message' => "Client deleted"
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            "name" => "required",
            "email" => "required|email",
            "number" => "required",
            "address" => "required",
            "industry" => "required",
            "company_id" => "required"
        ]);

        $client = Client::findOrFail($id);

        $client->name = $request -> name;
        $client->email = $request -> email;
        $client->number = $request -> number;
        $client->address = $request -> address;
        $client->industry = $request -> industry;
        $client->company_id = $request -> company_id;

        $client -> save();

        return response() -> json([
            'message' => "Client updated"
        ]);
    }
}
