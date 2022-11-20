<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AuthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function() {
    # method GET - Get all resource
    Route::get('/patients', [PatientController::class, 'index']);
    
    # method POST - Add resource
    Route::post('/patients', [PatientController::class, 'store']);
    
    # method GET - Get detail resource
    Route::get('/patients/{id}', [PatientController::class, 'show']);
    
    # method PUT - Edit resource
    Route::put('/patients/{id}', [PatientController::class, 'update']);
    
    # method DELETE - Delete resource
    Route::delete('/patients/{id}', [PatientController::class, 'destroy']);

    # method GET - Search resource by name
    Route::get('/patients/search/{name}', [PatientController::class, 'search']);

    # method GET - Get positive resource
    Route::get('/patients/status/positive', [PatientController::class, 'positive']);

    # method GET - Get recovered resource
    Route::get('/patients/status/recovered', [PatientController::class, 'recovered']);

    # method GET - Get dead resource
    Route::get('/patients/status/dead', [PatientController::class, 'dead']);
});

# Register dan Login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
