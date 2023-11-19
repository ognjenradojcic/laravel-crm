<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Dto\client\ClientData;
use App\Models\Client;
use App\Models\Company;
use Illuminate\Support\Facades\Log;
use Monolog\Level;

class ClientController extends Controller
{

    public function index(){

        $clients = Client::all();

        $companies = Company::all();

        return view('client',[
            'clients' => $clients,
            'companies' => $companies
        ]);
    }

    public function destroy($id){

        $client = Client::findOrFail($id);

        $client -> delete();

        return redirect("/clients");

    }

    public function update($id){

        $clientData = ClientData::from(request());

        $client = Client::findOrFail($id);

        $client -> update($clientData -> toArray());

        return redirect("/clients");
    }

    public function store(){

        $clientData = ClientData::from(request());

        Client::create($clientData -> toArray());

        return redirect("/clients");
    }
}
