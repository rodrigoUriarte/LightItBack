<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\HistoricDiagnosisController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

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


Route::group([
    'middleware' => ['auth:sanctum'],
], function(){
//Route::post('/getToken', [ApiController::class, 'getToken']);
    Route::get('/getSymptoms', [ApiController::class, 'getSymptoms']);
    Route::get('/getDiagnostics', [ApiController::class, 'getDiagnostics']);
    Route::get('/getHistoricDiagnostics', [HistoricDiagnosisController::class, 'index']);
    Route::patch('/confirm_diagnosis/{historic_diagnosis}', [HistoricDiagnosisController::class, 'update']);
});

Route::get('/service/alive', [ServiceController::class, 'alive']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
