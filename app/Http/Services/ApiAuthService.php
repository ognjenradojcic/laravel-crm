<?php

namespace App\Http\Services;

use App\Models\Client;
use Illuminate\Database\Eloquent\Collection;

class ApiAuthService
{
    public function readAll(): Collection
    {
        return Client::all();
    }

    public function readById($id){
        return Client::findOrFail($id);
    }


    public function update($clientData, $id){
        $client = Client::findOrFail($id);
        $client -> update($clientData -> toArray());
    }

    public function delete($id){
        $client = Client::findOrFail($id);

        $client -> delete();
    }

    public function create($clientData){
        return Client::create($clientData -> toArray());
    }
}
