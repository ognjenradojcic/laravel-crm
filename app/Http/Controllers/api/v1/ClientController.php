<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Dto\client\ClientData;
use App\Http\Services\ClientService;
use App\Models\Client;
use Illuminate\Http\Request;


class ClientController extends Controller
{


    public function __construct(protected ClientService $service)
    {
    }

    public function index(){
        return $this->service->readAll();
    }

    public function show($id){
        return $this->service->readById($id);
    }

    public function store(ClientData $clientData){

        $client = $this->service->create($clientData);

        return response() -> json($client);
    }

    public function destroy($id){

        $this->service->delete($id);

        return response() -> json([
            'message' => "Client deleted"
        ]);
    }

    public function update(ClientData $clientData, $id){

        $this->service->update($clientData, $id);

        return response() -> json([
            'message' => "Client updated"
        ]);
    }
}
