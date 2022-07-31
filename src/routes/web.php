<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/',[\App\Http\Controllers\employeeController::class,'index'])->name('empleados');
Route::get('create_employee',[\App\Http\Controllers\employeeController::class,'create'])->name('create');
Route::post('create_employee.store',[\App\Http\Controllers\employeeController::class,'store'])->name('store');
Route::get('edit_employee/{id}',[\App\Http\Controllers\employeeController::class,'edit']);
Route::post('edit_employee.update',[\App\Http\Controllers\employeeController::class,'update'])->name('update');
Route::get('delete_employee/{id}',[\App\Http\Controllers\employeeController::class,'delete']);

