<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Dto\client\ClientData;
use App\Models\Client;
use App\Models\Company;

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

        request() -> validate([
            "name" => "required",
            "email" => "required|email",
            "number" => "required",
            "address" => "required",
            "industry" => "required",
            "company_id" => "required"
        ]);

        $client = Client::findOrFail($id);

        $client -> name = request('name');
        $client -> email = request('email');
        $client -> number = request('number');
        $client -> address = request('address');
        $client -> industry = request('industry');
        $client -> company_id = request('company_id');

        $client -> save();

        return redirect("/clients");
    }

    public function store(){

        $clientData = ClientData::from(request());

        Client::create($clientData -> toArray());

        return redirect("/clients");
    }
}
