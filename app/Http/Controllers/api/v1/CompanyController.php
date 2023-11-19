<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Dto\company\CompanyData;
use App\Models\Client;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(){
        return Company::all();
    }

    public function show($id){
        return Company::findOrFail($id);
    }

    public function store(CompanyData $companyData){

        $company = Company::create($companyData -> toArray());

        return response() -> json($company);
    }

    public function destroy($id){
        $company = Company::findOrFail($id);

        $company -> delete();

        return response() -> json([
            'message' => "Company deleted"
        ]);
    }

    public function update(CompanyData $companyData, $id){

        $company = Company::findOrFail($id);

        $company -> update($companyData -> toArray());

        return response() -> json([
            'message' => "Company updated"
        ]);
    }
}
