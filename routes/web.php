<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\JornadasController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/mm', function () {
    return view('sienna/mm');

});
Route::get('/registro', function () {
    return view('sienna/registro');

});
Route::get('/', function () {

     $idusuario=session()->has('idusuario');
if($idusuario){
    return view('/home');
    
}else{

    return view('sienna/login');
}
    
});
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    var_dump($exitCode);
    // return what you want
});
Route::post('/login','App\Http\Controllers\LoginController@index');
Route::group(['middleware' => ['reportes']], function() {

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::group(['middleware' => ['auth', 'web']], function() {
Route::get('/home', function () {
       return view('/home');
   });
   Route::get('/ttt', function () {
    return view('/sienna/tt');
});
Route::get('/estado', function () {
    return view('/sienna/estado');
});
Route::get('/sienna','App\Http\Controllers\siennaController@principal')->middleware('adminsienna');
Route::post('/sienna','App\Http\Controllers\siennaController@servicio')->middleware('adminsienna');
Route::get('/serviciocreate','App\Http\Controllers\siennaController@serviciocreate')->middleware('adminsienna');
Route::post('/serviciocreate','App\Http\Controllers\siennaController@serviciocreatepost')->middleware('adminsienna');
Route::get('/siennamodificar','App\Http\Controllers\siennaController@siennamodificarput')->middleware('adminsienna');
Route::post('/siennamodificar','App\Http\Controllers\siennaController@siennamodificarput2')->middleware('adminsienna');
Route::get('/siennacreate','App\Http\Controllers\siennaController@siennacreate');
Route::post('/siennacreate','App\Http\Controllers\siennaController@siennacreatepost');
Route::get('/siennamenu','App\Http\Controllers\siennaController@siennamenu');
Route::get('/siennaabmmodificar','App\Http\Controllers\siennaController@siennaabmmodificar');
Route::post('/siennaabmmodificar','App\Http\Controllers\siennaController@siennaabmmodificarpost');


Route::get('/siennagraficos','App\Http\Controllers\siennaController@siennagraficos');
Route::post('/siennagraficos','App\Http\Controllers\siennaController@siennagraficospost'); 
Route::get('/siennaendpoint','App\Http\Controllers\siennaController@siennaendpoint');
Route::get('/siennaemail','App\Http\Controllers\siennaController@siennaemail');
Route::get('/siennareport','App\Http\Controllers\siennaController@siennareport');
Route::get('/siennaform','App\Http\Controllers\siennaController@siennaform');
Route::post('/siennaform','App\Http\Controllers\siennaController@siennaformpost');

Route::get('/ticketsienna','App\Http\Controllers\siennaController@ticketsienna');
Route::post('/ticketsienna','App\Http\Controllers\siennaController@ticketsiennapost');




Route::get('/siennaformg','App\Http\Controllers\siennaController@siennaformg');
Route::post('/siennaformg','App\Http\Controllers\siennaController@siennaformgpost');
Route::get('/siennaforme','App\Http\Controllers\siennaController@siennaforme');
Route::post('/siennaforme','App\Http\Controllers\siennaController@siennaformepost');

Route::get('/siennaabm','App\Http\Controllers\siennaController@siennaabm');
Route::post('/eliminarregistro','App\Http\Controllers\siennaController@delete'); 

Route::get('/endpointentrantes','App\Http\Controllers\siennaController@endpointentrantes');
Route::get('/profile','App\Http\Controllers\LoginController@profile');
Route::post('/actualizardatos','App\Http\Controllers\LoginController@actualizardatos');

Route::get('/chatsienna','App\Http\Controllers\ChatsiennaController@index');

Route::get('/chatsiennacrear','App\Http\Controllers\ChatsiennaController@creardb');



Route::get('/chat','App\Http\Controllers\ChatController@index');
Route::post('/chatcambiarestado','App\Http\Controllers\ChatController@cambiarestado');
Route::post('/chatcambiardeptos','App\Http\Controllers\ChatController@cambiardepto');
Route::post('/chatcambiartopic','App\Http\Controllers\ChatController@cambiartopic');
Route::post('/chatasignar','App\Http\Controllers\ChatController@asignar');

////////sienna chat


Route::post('/chatcambiarestado2','App\Http\Controllers\ChatsiennaController@cambiarestado2');
Route::post('/chatcambiardeptos2','App\Http\Controllers\ChatsiennaController@cambiardepto2');
Route::post('/chatcambiartopic2','App\Http\Controllers\ChatsiennaController@cambiartopic2');
Route::post('/chatasignar2','App\Http\Controllers\ChatsiennaController@chatasignar2');



///////fin sienna chat
Route::post('/chatcreate','App\Http\Controllers\ChatController@chatcreate');




Route::get('/datosextras/{ticketid}', 'App\Http\Controllers\ticketController@principal');
Route::get('/canttikets/{count}', 'App\Http\Controllers\ticketController@count');
Route::get('/listadetickets', 'App\Http\Controllers\ticketController@listadetickets');


Route::get('/pdfcontratos','App\Http\Controllers\JornadasController@pdfcontratos'); 
Route::get('/pdfrelease','App\Http\Controllers\JornadasController@pdfrelease'); 



//pagoralia

Route::get('/pagos','App\Http\Controllers\PagoraliaController@subir'); 
Route::post('/pagos','App\Http\Controllers\PagoraliaController@procesar'); 
Route::get('/crontab','App\Http\Controllers\PagoraliaController@crontab'); 
Route::get('/template','App\Http\Controllers\PagoraliaController@template'); 

// end pagoralia


Route::get('/ceviche','App\Http\Controllers\CevicheController@principal');

Route::get('/create','App\Http\Controllers\CevicheController@nuevo');
Route::post('/create','App\Http\Controllers\CevicheController@nuevo_post');
Route::get('/modificar','App\Http\Controllers\CevicheController@modificar');
Route::post('/modificar','App\Http\Controllers\CevicheController@modificar_post');
Route::get('/ceviche_modificar','App\Http\Controllers\CevicheController@modificar'); 
Route::get('/ceviche_eliminar','App\Http\Controllers\CevicheController@eliminar'); 
Route::get('/ceviche_view','App\Http\Controllers\CevicheController@view'); 
Route::get('/ceviche_grafico','App\Http\Controllers\CevicheController@graficosform'); 
Route::post('/ceviche_grafico','App\Http\Controllers\CevicheController@graficos'); 

Route::get('/ceviche_grafico_iframe','App\Http\Controllers\CevicheController@graficosiframe'); 

Route::get('/contrato_view','App\Http\Controllers\ContratoController@view'); 
Route::post('/eliminar','App\Http\Controllers\CevicheController@delete'); 
Route::post('/eliminar2','App\Http\Controllers\CevicheController@borrarevento'); 


Route::get('/dashboard','App\Http\Controllers\Dashboard2Controller@view'); 
Route::post('/dashboard','App\Http\Controllers\Dashboard2Controller@viewpost'); 

Route::get('/cronmail','App\Http\Controllers\Dashboard2Controller@cronmail'); 
Route::get('/calendario','App\Http\Controllers\calendarioController@calendario'); 


//front xennio

//Route::get('/datos','App\Http\Controllers\TicketdatosController@datos');

Route::get('/datos/', array(
    'before'=>'forcehttps',
    'uses' => 'App\Http\Controllers\TicketdatosController@datos')
  );

 

});
//});


Route::get('/salir','App\Http\Controllers\ChauController@logout');
Route::get('/usuarios','UsersController@list');
Route::get('/denied', ['as' => 'denied', function() {
    return view('denied');
}]);
