<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Dto\client\ClientData;
use App\Http\Services\ClientService;
use App\Http\Services\CompanyService;
use App\Models\Client;
use App\Models\Company;
use Illuminate\Support\Facades\Log;
use Monolog\Level;

class ClientController extends Controller
{


    public function __construct(protected ClientService $service, protected CompanyService $companyService)
    {
    }

    public function index(){

        $clients = $this -> service -> readAll();

        $companies = $this -> companyService -> readAll();

        return view('client',[
            'clients' => $clients,
            'companies' => $companies
        ]);
    }

    public function destroy($id){

        $this -> service -> delete($id);

        return redirect("/clients");

    }

    public function update($id){

        $clientData = ClientData::from(request());

        $this -> service -> update($clientData, $id);

        return redirect("/clients");
    }

    public function store(){

        $clientData = ClientData::from(request());

        $this -> service -> create($clientData);

        return redirect("/clients");
    }
}
