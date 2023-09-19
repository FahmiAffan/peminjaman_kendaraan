<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PemesananController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Auth
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('logout',   [AuthController::class, 'logout']);
});
Route::post('/register', [AuthController::class, "register"]);
Route::post('/login', [AuthController::class, "login"]);

//Data
Route::resource('/kendaraan', KendaraanController::class);
Route::resource('/pemesanan', PemesananController::class);


Route::put('/updatePersetujuan/{id}', [PemesananController::class, "updatePersetujuan"]);

Route::get('/export', [ExportController::class, "export"]);
