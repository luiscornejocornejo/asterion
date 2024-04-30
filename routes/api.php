<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\wsController;
use App\Http\Controllers\Api\cappi2022Controller;
use App\Http\Controllers\Api\clienteController;
use App\Http\Controllers\Api\crearticketController;
use App\Http\Controllers\api\siennaticketsController;
use App\Http\Controllers\api\ostController;




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

/*
Route::get('/datostickets2/{mail}', [clienteController::class, 'datostickets2']);
Route::get('/topics2', [clienteController::class, 'topics2']);
Route::get('/departments2', [clienteController::class, 'departments2']);
Route::get('/status2', [clienteController::class, 'status2']);
Route::get('/staff2', [clienteController::class, 'staff2']);
Route::get('/extrahistorial2/{id}',[clienteController::class, 'extrahistorial2']);

Route::post('/crearticket', [clienteController::class, 'crearticket']);

Route::get('/crearticketos', [crearticketController::class, 'crearticketenos']);

*/

Route::get('/ws', [wsController::class, 'ws']);
Route::get('/ws2', [wsController::class, 'ws2']);
Route::get('/tickessienna', [siennaticketsController::class, 'tickessienna']);//busqueda por conversacioid
Route::get('/tickessienna2', [siennaticketsController::class, 'tickessienna2']);//busqyeda por celular
Route::get('/tickessienna3', [siennaticketsController::class, 'tickessienna3']);//busqueda por numero de cliente
Route::get('/tickessiennaseguimientos', [siennaticketsController::class, 'tickessiennaseguimientos']);
Route::post('/creartickessienna', [siennaticketsController::class, 'creartickessienna']);
Route::get('/creartickessiennacharlie', [siennaticketsController::class, 'creartickessiennacharlie']);


Route::post('/mandarmail', [siennaticketsController::class, 'mandarmail']);
Route::get('/motic', [siennaticketsController::class, 'motic']);



Route::get('/tickessiennaapi', [siennaticketsController::class, 'tickessiennaapi']);
Route::post('/cambiarstatussienna', [siennaticketsController::class, 'cambiarstatussienna']);
Route::post('/cambiartopicsienna', [siennaticketsController::class, 'cambiartopicsienna']);
Route::post('/cambiardeptosienna', [siennaticketsController::class, 'cambiardeptosienna']);
Route::post('/cambiardeptosienna2', [siennaticketsController::class, 'cambiardeptosienna2']);
Route::post('/siennacrearseguimiento', [siennaticketsController::class, 'siennacrearseguimiento']);
Route::get('/statussiennaxdepto', [siennaticketsController::class, 'statussiennaxdepto']);
Route::get('/topicxdepto', [siennaticketsController::class, 'topicxdepto']);
Route::get('/deptos', [siennaticketsController::class, 'deptos']);
Route::get('/maxid', [siennaticketsController::class, 'maxid']);
Route::get('/maxid2', [siennaticketsController::class, 'maxid2']);
Route::get('/datoscliente', [siennaticketsController::class, 'datoscliente']);
Route::get('/cerrados', [siennaticketsController::class, 'cerrados']);
Route::get('/quispe', [siennaticketsController::class, 'quispe']);
Route::get('/nodos', [siennaticketsController::class, 'nodos']);
Route::get('/getdata', [siennaticketsController::class, 'getdata']);
Route::get('/difhora', [siennaticketsController::class, 'difhora']);
Route::get('/zone', [siennaticketsController::class, 'zona']);
Route::post('/prioridad', [siennaticketsController::class, 'prioridad']);



Route::get('/enhora', [siennaticketsController::class, 'enhora']);
Route::post('/pedir', [siennaticketsController::class, 'pedir']);
Route::post('/pedir2', [siennaticketsController::class, 'pedir2']);
Route::get('/listadoseguimientos', [siennaticketsController::class, 'listadoseguimientos']);
Route::get('/siennasource', [siennaticketsController::class, 'siennasource']);
Route::post('/siennacrearseguimiento2', [siennaticketsController::class, 'siennacrearseguimiento2']);
Route::get('/ticketsviejo', [siennaticketsController::class, 'ticketsviejo']);
Route::get('/crearusuario', [siennaticketsController::class, 'crearusuario']);
Route::get('/cerradoscant', [siennaticketsController::class, 'cerradoscant']);
Route::get('/abiertoscant', [siennaticketsController::class, 'abiertoscant']);
Route::get('/ticketxdepto', [siennaticketsController::class, 'ticketxdepto']);
Route::get('/historico', [siennaticketsController::class, 'historico']);
Route::get('/prueba', [siennaticketsController::class, 'prueba']);






/*

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
*/

Route::get('/generico','App\Http\Controllers\api\pasajeController@pasaje');
Route::get('/especifico','App\Http\Controllers\api\pasajeController@especifico');
Route::get('/datosextras','App\Http\Controllers\api\ticketController@principal');





//Route::apiResource('cappi2022', App\Http\Controllers\api\cappi2022Controller::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
