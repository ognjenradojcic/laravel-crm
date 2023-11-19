<?php

use App\Http\Controllers\web\ClientController;
use App\Http\Controllers\web\CompanyController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\UserController;
use App\Models\Company;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home') -> middleware('auth');

//Clients routes
Route::get('/clients', [ClientController::class, 'index'])-> middleware('auth');
Route::group(['middleware' => ['role:Admin|Super-Admin']], function () {
    Route::post('/clients', [ClientController::class, 'store'])->middleware('auth');
    Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->middleware('auth');
    Route::put('/clients/{id}', [ClientController::class, 'update'])->middleware('auth');
});

//Companies routes
Route::get('/companies', [CompanyController::class, 'index'])-> middleware('auth');
Route::group(['middleware' => ['role:Admin|Super-Admin']], function () {
    Route::post('/companies', [CompanyController::class, 'store'])->middleware('auth');
    Route::delete('/companies/{id}', [CompanyController::class, 'destroy'])->middleware('auth');
    Route::put('/companies/{id}', [CompanyController::class, 'update'])->middleware('auth');
});

//Users routes
Route::group(['middleware' => ['role:Super-Admin']], function () {
    Route::get('/users', [UserController::class, 'index'])-> middleware('auth');
    Route::post('/users', [UserController::class, 'store'])->middleware('auth');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->middleware('auth');
    Route::put('/users/{id}', [UserController::class, 'update'])->middleware('auth');
});

