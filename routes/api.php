<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\wsController;
use App\Http\Controllers\Api\cappi2022Controller;

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
Route::get('/ws','App\Http\Controllers\api\wsController@ws');
//Route::get('/datostickets','App\Http\Controllers\api\wsController@datostickets');
Route::get('/datostickets', [wsController::class, 'datostickets']);
Route::get('/extrasmail/{id}',[wsController::class, 'extrasmail']);
Route::get('/extraswhatapp/{id}',[wsController::class, 'extraswhatapp']);
Route::get('/extrahistorial/{id}',[wsController::class, 'extrahistorial']);

Route::get('/cappi2022', [cappi2022Controller::class, 'crear']);


Route::get('/generico','App\Http\Controllers\api\pasajeController@pasaje');
Route::get('/especifico','App\Http\Controllers\api\pasajeController@especifico');
Route::get('/datosextras','App\Http\Controllers\api\ticketController@principal');



//Route::apiResource('cappi2022', App\Http\Controllers\api\cappi2022Controller::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});