<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\controllers\PatientController;
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


Route::post('/login', [AuthController::class, 'login']);

Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/patients', [PatientController::class, 'index']);
    Route::post('/patients', [PatientController::class, 'store']);

    Route::get('/patients/{id}', [PatientController::class, 'show']);
    
    Route::put('/patients/{id}', [PatientController::class, 'update']);
    
    Route::delete('/patients/{id}', [PatientController::class, 'destroy']);
    
    Route::get('/patients/search/{name}', [PatientController::class, 'search']);

    Route::get('/patients/status/positive', [PatientController::class, 'positive']);
    
    Route::get('/patients/status/recovered', [PatientController::class, 'recovered']);

    Route::get('/patients/status/dead', [PatientController::class, 'dead']);
});
    
