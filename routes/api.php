<?php


use App\Http\Controllers\api\v1\ApiController;
use App\Http\Controllers\api\v1\ClientController;
use App\Http\Controllers\api\v1\CompanyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\api\v1'], function (){

    Route::post("register", [ApiController::class, "register"]);
    Route::post("login", [ApiController::class, "login"]);


    Route::group([
        "middleware" => ["auth:api"]
    ], function(){
        Route::get("profile", [ApiController::class, "profile"]);
        Route::get("refresh", [ApiController::class, "refreshToken"]);
        Route::get("logout", [ApiController::class, "logout"]);

        //Clients
        Route::get('clients', [ClientController::class, "index"]);
        Route::get('clients/{id}', [ClientController::class, "show"]);

        Route::group(['middleware' => ['role:Admin|Super-Admin']], function () {
            Route::post('clients', [ClientController::class, "store"]);
            Route::delete('clients/{id}', [ClientController::class, "destroy"]);
            Route::put('clients/{id}', [ClientController::class, "update"]);
        });

        //Companies
        Route::get('companies', [CompanyController::class, "index"]);
        Route::get('companies/{id}', [CompanyController::class, "show"]);

        Route::group(['middleware' => ['role:Admin|Super-Admin']], function () {
            Route::post('companies', [CompanyController::class, "store"]);
            Route::delete('companies/{id}', [CompanyController::class, "destroy"]);
            Route::put('companies/{id}', [CompanyController::class, "update"]);
        });
    });
});

Route::fallback(function(){
    return response()->json(['message' => 'Not Found!'], 404);
});
