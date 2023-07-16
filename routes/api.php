<?php

use App\Http\Controllers\AppliancesController;
use App\Http\Controllers\MarkingsController;
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

Route::apiResource('/appliances', AppliancesController::class);
Route::get('/appliances/search/{name}', [AppliancesController::class, 'showByName']);
Route::get('/appliances/marking/{marking}', [AppliancesController::class, 'showByMarking']);
