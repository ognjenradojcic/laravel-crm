<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Dto\company\CompanyData;
use App\Http\Services\CompanyService;
use App\Models\Client;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{


    public function __construct(protected CompanyService $service)
    {
    }

    public function index(){
        return $this->service->readAll();
    }

    public function show($id){
        return $this->service->readById($id);
    }

    public function store(CompanyData $companyData){

        $company = $this->service -> create($companyData);

        return response() -> json($company);
    }

    public function destroy($id){

        $this->service->delete($id);

        return response() -> json([
            'message' => "Company deleted"
        ]);
    }

    public function update(CompanyData $companyData, $id){

       $this->service->update($companyData, $id);

        return response() -> json([
            'message' => "Company updated"
        ]);
    }
}
