<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Dto\client\ClientData;
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

    public function store(ClientData $data){
        $client = Client::create([
            "name" => $data -> name,
            "email" => $data -> email,
            "number" => $data -> number,
            "address" => $data -> address,
            "industry" => $data -> industry,
            "company_id" => $data -> company_id,
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

    public function update(ClientData $data, $id){

        $client = Client::findOrFail($id);

        $client->name = $data -> name;
        $client->email = $data -> email;
        $client->number = $data -> number;
        $client->address = $data -> address;
        $client->industry = $data -> industry;
        $client->company_id = $data -> company_id;

        $client -> save();

        return response() -> json([
            'message' => "Client updated"
        ]);
    }
}
