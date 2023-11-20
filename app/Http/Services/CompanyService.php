<?php

namespace App\Http\Services;

use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;

class CompanyService
{
    public function readAll(): Collection
    {
        return Company::all();
    }

    public function readById($id){
        return Company::findOrFail($id);
    }

    public function update($companyData, $id){
        $company = Company::findOrFail($id);
        $company -> update($companyData -> toArray());
    }

    public function delete($id){
        $company = Company::findOrFail($id);

        $company -> delete();
    }

    public function create($companyData){
        return Company::create($companyData -> toArray());
    }
}
