<?php

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

Route::get('/', function () {
    return view('welcome');
}) ;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/pmu', [App\Http\Controllers\PmuController::class, 'index'])->name('pmu');
Route::post('/pmu', [App\Http\Controllers\PmuController::class, 'save'])->name('savepmu');
Route::get('/change',[App\Http\Controllers\PmuController::class,'change'])->name('change');
Route::post('/change/password',[App\Http\Controllers\PmuController::class,'storePassword'])->name('password.change');
//contracts
Route::get('/contract', [App\Http\Controllers\ContractController ::class, 'index'])->name('contract');
Route::get('/get_contract', [App\Http\Controllers\ContractController ::class, 'create'])->name('contract.create');
Route::post('/save_contract', [App\Http\Controllers\ContractController ::class, 'store'])->name('contract.store');
Route::get('/show_contract', [App\Http\Controllers\ContractController ::class, 'show'])->name('contract.show');
Route::get('/edit_contract/{id}', [App\Http\Controllers\ContractController ::class, 'edit'])->name('contract.edit');
Route::post('contract/{id}',[App\Http\Controllers\ContractController::class,'update'])->name('contract.update');
Route::get('/sendsms',[App\Http\Controllers\ContractController::class,'send'])->name('send');
