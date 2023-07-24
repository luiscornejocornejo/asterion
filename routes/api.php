<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\wsController;
use App\Http\Controllers\Api\cappi2022Controller;
use App\Http\Controllers\Api\clienteController;
use App\Http\Controllers\Api\crearticketController;




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


Route::get('/datostickets2/{mail}', [clienteController::class, 'datostickets2']);
Route::get('/topics2', [clienteController::class, 'topics2']);
Route::get('/departments2', [clienteController::class, 'departments2']);
Route::get('/status2', [clienteController::class, 'status2']);
Route::get('/staff2', [clienteController::class, 'staff2']);
Route::get('/extrahistorial2/{id}',[clienteController::class, 'extrahistorial2']);

Route::post('/crearticket', [clienteController::class, 'crearticket']);

Route::get('/crearticketos', [crearticketController::class, 'crearticketenos']);



Route::get('/ws', [wsController::class, 'ws']);




//Route::get('/ws','App\Http\Controllers\api\wsController@ws');
//Route::get('/datostickets','App\Http\Controllers\api\wsController@datostickets');
Route::get('/datostickets/{mail}', [wsController::class, 'datostickets']);
Route::get('/topics', [wsController::class, 'topics']);
Route::get('/ost_ticket_status', [wsController::class, 'ost_ticket_status']);
Route::get('/departments', [wsController::class, 'departments']);
Route::get('/staff', [wsController::class, 'staff']);



Route::get('/extrasmail/{id}',[wsController::class, 'extrasmail']);
Route::get('/extraswhatapp/{id}',[wsController::class, 'extraswhatapp']);
Route::get('/extrahistorial/{id}',[wsController::class, 'extrahistorial']);
Route::get('/extrasuser/{user_id}',[wsController::class, 'extrasuser']);


Route::get('/cappi2022', [cappi2022Controller::class, 'crear']);


Route::get('/generico','App\Http\Controllers\api\pasajeController@pasaje');
Route::get('/especifico','App\Http\Controllers\api\pasajeController@especifico');
Route::get('/datosextras','App\Http\Controllers\api\ticketController@principal');



Route::post('/crearusuario','App\Http\Controllers\api\wsController@crearusuario');


//Route::apiResource('cappi2022', App\Http\Controllers\api\cappi2022Controller::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
