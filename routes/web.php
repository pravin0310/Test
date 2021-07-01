<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin/index');
})->name('dashboard');

Route::get('/emp',[UserController::class,'getemployee'])->name('emp');
Route::get('/emp1',[EmployeeController::class,'getemployee'])->name('emp1');

Route::middleware(['auth'])->group(function () {

    // user Route Here
    Route::get('/dashboard', [UserController::class, 'index'])->name('users.dashboard');
    Route::POST('/usersave', [UserController::class, 'store'])->name('users.store');
    Route::get('/getusesr', [UserController::class, 'show'])->name('user.getdata');
    Route::get('/deleteusesr', [UserController::class, 'destroy'])->name('user.destroy');
    // user Route Here End

    // Employee Route Here
    Route::POST('/employeesave', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('/getemployeeid', [EmployeeController::class, 'index'])->name('getemployeeid');
    Route::get('/getemployeedata', [EmployeeController::class, 'show'])->name('employee.getdata');
    Route::get('/deletemployee', [EmployeeController::class, 'destroy'])->name('employee.destroy');
    Route::POST('/importemployee', [EmployeeController::class, 'create'])->name('employee.import');

    // Employee Route Here End
    


});
