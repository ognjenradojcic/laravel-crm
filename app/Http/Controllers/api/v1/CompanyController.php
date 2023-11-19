<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
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

    public function store(Request $request){
        $request->validate([
            "name" => "required",
            "email" => "required|email",
            "number" => "required",
            "address" => "required",
            "industry" => "required",
            "eid" => "required"
        ]);

        $company = Company::create([
            "name" => $request -> name,
            "email" => $request -> email,
            "number" => $request -> number,
            "address" => $request -> address,
            "industry" => $request -> industry,
            "eid" => $request -> eid,
        ]);

        return response() -> json($company);
    }

    public function destroy($id){
        $company = Company::findOrFail($id);

        $company -> delete();

        return response() -> json([
            'message' => "Company deleted"
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            "name" => "required",
            "email" => "required|email",
            "number" => "required",
            "address" => "required",
            "industry" => "required",
            "eid" => "required"
        ]);

        $company = Company::findOrFail($id);

        $company->name = $request -> name;
        $company->email = $request -> email;
        $company->number = $request -> number;
        $company->address = $request -> address;
        $company->industry = $request -> industry;
        $company->eid = $request -> eid;

        $company -> save();

        return response() -> json([
            'message' => "Company updated"
        ]);
    }
}
