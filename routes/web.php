<?php

use App\Http\Controllers\web\ClientController;
use App\Http\Controllers\web\HomeController;
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

Route::get('/clients', [ClientController::class, 'index'])-> middleware('auth');
Route::post('/clients', [ClientController::class, 'store'])-> middleware('auth');
Route::delete('/clients/{id}', [ClientController::class, 'destroy'])-> middleware('auth');
Route::put('/clients/{id}', [ClientController::class, 'update'])-> middleware('auth');
