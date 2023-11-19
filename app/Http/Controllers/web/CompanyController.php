<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Dto\company\CompanyData;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index(){

        $companies = Company::all();

        return view('company',[
            'companies' => $companies
        ]);
    }

    public function destroy($id){

        $company = Company::findOrFail($id);

        $company -> delete();

        return redirect("/companies");

    }

    public function update($id){

        $companyData = CompanyData::from(request());

        $company = Company::findOrFail($id);

        $company -> update($companyData -> toArray());

        return redirect("/companies");
    }

    public function store(){

        $companyData = CompanyData::from(request());

        Company::create($companyData -> toArray());

        return redirect("/companies");
    }
}
