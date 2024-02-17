<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
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

Route::post('login',[AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::resource('employees', EmployeeController::class)->except(['create', 'edit']);

    Route::get('employees-highest-salary',[EmployeeController::class, 'highestSalary']);

    Route::post('logout',[AuthController::class, 'logout']);
});

