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

    public function store(ClientData $clientData){

        $client = Client::create($clientData -> toArray());

        return response() -> json($client);
    }

    public function destroy($id){
        $client = Client::findOrFail($id);

        $client -> delete();

        return response() -> json([
            'message' => "Client deleted"
        ]);
    }

    public function update(ClientData $clientData, $id){

        $client = Client::findOrFail($id);

        $client -> update($clientData -> toArray());

        return response() -> json([
            'message' => "Client updated"
        ]);
    }
}
