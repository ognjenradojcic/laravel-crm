<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Dto\company\CompanyData;
use App\Http\Services\CompanyService;
use App\Models\Company;

class CompanyController extends Controller
{

    public function __construct(protected CompanyService $service)
    {
    }

    public function index(){

        $companies = $this -> service -> readAll();

        return view('company',[
            'companies' => $companies
        ]);
    }

    public function destroy($id){

        $this -> service -> delete($id);

        return redirect("/companies");

    }

    public function update($id){

        $companyData = CompanyData::from(request());

        $this -> service -> update($companyData, $id);

        return redirect("/companies");
    }

    public function store(){

        $companyData = CompanyData::from(request());

        $this -> service -> create($companyData);

        return redirect("/companies");
    }
}
