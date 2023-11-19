<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
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

        $company = Company::findOrFail($id);

        $this->saveCompany($company);

        return redirect("/companies");
    }

    public function store(){

        $company = new Company();

        $this->saveCompany($company);

        return redirect("/companies");
    }

    /**
     * @param Company $company
     * @return void
     */
    public function saveCompany(Company $company): void
    {
        request()->validate([
            "name" => "required",
            "email" => "required|email",
            "number" => "required",
            "address" => "required",
            "industry" => "required",
            "eid" => "required"
        ]);

        $company->name = request('name');
        $company->email = request('email');
        $company->number = request('number');
        $company->address = request('address');
        $company->industry = request('industry');
        $company->eid = request('eid');

        $company->save();
    }
}
