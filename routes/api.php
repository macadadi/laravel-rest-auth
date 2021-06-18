<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Auth\UserAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/register', [UserAuthController::class,'register']);
Route::post('/login', [UserAuthController::class,'login']);

//Route::apiResource('/employee', EmployeeController::class)->middleware('auth:api');



Route::middleware('auth:api')->group(function () {

    Route::get('/employee/index', [EmployeeController::class,'index']);
    Route::get('/employee/show/{employee}', [EmployeeController::class,'show']);
    Route::post('/employee/store', [EmployeeController::class,'store']);
    //Route::get('/employee/index', [EmployeeController::class,'index']);
    Route::post('/logout', [UserAuthController::class,'logout']);
});
