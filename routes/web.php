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



Route::get('/datos','App\Http\Controllers\TicketdatosController@datos');
 


Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/mm', function () {
    return view('sienna/mm');

});
Route::get('/recuperar', function () {
    return view('sienna/password');

});
Route::post('/recuperar','App\Http\Controllers\LoginController@recuperar');
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
    Route::get('/siennai','App\Http\Controllers\siennaController@principal')->middleware('adminsienna');
    Route::get('/pruebamail','App\Http\Controllers\siennaController@pruebamail');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::group(['middleware' => ['auth', 'web']], function() {
Route::get('/home', function () {
       return view('/home');
   });

   Route::get('/dashboard2', function () {
    return view('/dashboard2');
});
   Route::get('/ttt', function () {
    return view('/sienna/tt');
});
Route::get('/estado', function () {
    return view('/sienna/estado');
});


Route::get('/logeado', function () {
    return view('/sienna/logeado');
});


Route::post('/siennai','App\Http\Controllers\siennaController@servicio')->middleware('adminsienna');
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
Route::get('/siennaformg','App\Http\Controllers\siennaController@siennaformg');
Route::post('/siennaformg','App\Http\Controllers\siennaController@siennaformgpost');
Route::get('/siennaforme','App\Http\Controllers\siennaController@siennaforme');
Route::post('/siennaforme','App\Http\Controllers\siennaController@siennaformepost');
Route::get('/siennaabm','App\Http\Controllers\siennaController@siennaabm');
Route::post('/eliminarregistro','App\Http\Controllers\siennaController@delete'); 
Route::get('/pruebadatabase','App\Http\Controllers\siennaController@pruebadatabase');
Route::get('/ticketsienna','App\Http\Controllers\siennaController@ticketsienna');
Route::post('/ticketsienna','App\Http\Controllers\siennaController@ticketsiennapost');
Route::get('/endpointentrantes','App\Http\Controllers\siennaController@endpointentrantes');
Route::get('/profile','App\Http\Controllers\LoginController@profile');
Route::post('/actualizardatos','App\Http\Controllers\LoginController@actualizardatos');
Route::get('/dash', 'App\Http\Controllers\Dashboard2Controller@dashboardgeneric');
Route::post('/dash', 'App\Http\Controllers\Dashboard2Controller@dashboardgeneric2');
Route::get('/surveys', 'App\Http\Controllers\Dashboard2Controller@dashboardSurveyGeneric');
Route::post('/surveys', 'App\Http\Controllers\Dashboard2Controller@dashboardSurveyGeneric2');
Route::get('/dashreport', 'App\Http\Controllers\Dashboard2Controller@reportDashboard');
Route::post('/dashreport', 'App\Http\Controllers\Dashboard2Controller@getTickets');
Route::get('/principal', function () {
    return view('/sienna/dashboard/tab');
});

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

//crear db u .env
Route::get('/creardb','App\Http\Controllers\TicketdatosController@creardb')->middleware('adminsienna');

Route::post('/creardb','App\Http\Controllers\TicketdatosController@creardbpost')->middleware('adminsienna');
//Route::get('/conversations  ','App\Http\Controllers\TicketdatosController@suricata');
//Route::get('/conversations2  ','App\Http\Controllers\TicketdatosController@suricata2');
//Route::get('/conversationsfacu  ','App\Http\Controllers\TicketdatosController@suricatafacu');
Route::get('/salientes  ','App\Http\Controllers\SalientesController@salientes');
Route::post('/salientes  ','App\Http\Controllers\SalientesController@salientespost');
Route::get('/template','App\Http\Controllers\SalientesController@template'); 


Route::get('/ticketssienna  ','App\Http\Controllers\TicketdatosController@ticketssienna');
Route::post('/siennaestado  ','App\Http\Controllers\TicketdatosController@siennaestado');
Route::post('/siennacliente  ','App\Http\Controllers\TicketdatosController@siennacliente');
Route::post('/siennacrearseguimiento  ','App\Http\Controllers\TicketdatosController@siennacrearseguimiento');
Route::get('/siennacrearusuarios','App\Http\Controllers\TicketdatosController@siennacrearusuarios');
Route::post('/siennacrearusuarios','App\Http\Controllers\TicketdatosController@siennacrearusuariospost');
Route::get('/ventas','App\Http\Controllers\TicketdatosController@ventas');
Route::post('/ventasstatus','App\Http\Controllers\TicketdatosController@ventasstatus');
Route::get('/cerrados','App\Http\Controllers\TicketdatosController@cerrados');
Route::post('/cerrados','App\Http\Controllers\TicketdatosController@cerradospost');

Route::get('/gpt', function () {
    return view('/sienna/gpt');
});


//solo sienna
Route::get('/operator','App\Http\Controllers\TicketdatosController@operator');
Route::get('/operator2','App\Http\Controllers\TicketdatosController@operator2');
Route::get('/agentes','App\Http\Controllers\TicketdatosController@agentes')->middleware('supervisorsienna');
Route::get('/empresadatos','App\Http\Controllers\TicketdatosController@empresadatos')->middleware('supervisorsienna');
Route::post('/empresadatos','App\Http\Controllers\TicketdatosController@empresadatos2');
Route::post('/topiccambiar','App\Http\Controllers\TicketdatosController@topiccambiar');
Route::post('/rolusers','App\Http\Controllers\TicketdatosController@rolusers');
Route::post('/areasusers','App\Http\Controllers\TicketdatosController@areasusers');
Route::post('/ticketusers','App\Http\Controllers\TicketdatosController@ticketusers');
Route::post('/newusers','App\Http\Controllers\TicketdatosController@newusers');
Route::get('/viewtickets','App\Http\Controllers\TicketdatosController@supervisor');
Route::get('/viewtickets2','App\Http\Controllers\TicketdatosController@supervisor2');
Route::get('/nodes','App\Http\Controllers\TicketdatosController@nodes');
Route::post('/nodes','App\Http\Controllers\TicketdatosController@nodespost');
Route::get('/subirclientes','App\Http\Controllers\TicketdatosController@subirclientes');
Route::get('/linknetclientes','App\Http\Controllers\TicketdatosController@linknetclientes');

Route::post('/subirclientes','App\Http\Controllers\TicketdatosController@subirclientespost');
Route::get('/busquedaavanzada','App\Http\Controllers\TicketdatosController@busquedaavanzada');
Route::get('/ticketunico','App\Http\Controllers\TicketdatosController@ticketunico');
Route::get('/ticketunico2','App\Http\Controllers\TicketdatosController@ticketunico2');


//sienna y osticket
Route::get('/tickets  ','App\Http\Controllers\TicketdatosController@osttickets');



//sienna cloud tickets

Route::post('/cambiardeptosiennacloud','App\Http\Controllers\cloudtickets@cambiardeptosienna');
Route::post('/cambiarestadosienna','App\Http\Controllers\cloudtickets@cambiarestadosienna');
Route::post('/asignara','App\Http\Controllers\cloudtickets@asignara');
Route::post('/cambiartopicsienna','App\Http\Controllers\cloudtickets@cambiartopicsienna');
Route::post('/prioridadsienna','App\Http\Controllers\cloudtickets@prioridadsienna');
Route::post('/reabrirconversacion','App\Http\Controllers\cloudtickets@reabrirconversacion');
Route::post('/cerrarall','App\Http\Controllers\cloudtickets@cerrarall');
Route::post('/prioridadsiennaall','App\Http\Controllers\cloudtickets@prioridadsiennaall');
Route::post('/eliminaragente','App\Http\Controllers\cloudtickets@eliminaragente');
Route::post('/asignarall','App\Http\Controllers\cloudtickets@asignarall');
Route::post('/tagsall','App\Http\Controllers\cloudtickets@tagsall');
Route::post('/tags','App\Http\Controllers\cloudtickets@tags');

Route::post('/crearticketsiennaclientegetdata','App\Http\Controllers\cloudtickets@crearticketsiennaclientegetdata');

Route::post('/crearticketsiennacliente','App\Http\Controllers\cloudtickets@crearticketsiennacliente');
Route::post('/crearticketsiennanocliente','App\Http\Controllers\cloudtickets@crearticketsiennanocliente');
Route::post('/notificacionusers','App\Http\Controllers\cloudtickets@notificacionusers');
Route::post('/habilitadousers','App\Http\Controllers\cloudtickets@habilitadousers');
Route::post('/cambiopass','App\Http\Controllers\cloudtickets@cambiopass');

Route::get('/salientesb','App\Http\Controllers\cloudtickets@salientesb')->middleware('supervisorsienna');
Route::post('/salientesb','App\Http\Controllers\cloudtickets@salientesbpost');
Route::get('/tareas','App\Http\Controllers\cloudtickets@tareas');
Route::get('/getdata','App\Http\Controllers\cloudtickets@getdata');
Route::post('/getdata','App\Http\Controllers\cloudtickets@getdata2');
Route::post('/valore','App\Http\Controllers\cloudtickets@newvalor');
Route::post('/creartarea','App\Http\Controllers\cloudtickets@creartarea');
Route::get('/mistareas','App\Http\Controllers\cloudtickets@mistareas');
Route::get('/ts','App\Http\Controllers\cloudtickets@ts');
Route::get('/soporte','App\Http\Controllers\cloudtickets@soporte');
Route::get('/soportec','App\Http\Controllers\cloudtickets@soportec');
Route::get('/envios','App\Http\Controllers\cloudtickets@envios');
Route::get('/enviolistado','App\Http\Controllers\cloudtickets@enviolistado');
Route::get('/tareas','App\Http\Controllers\cloudtickets@tareassupervisor');

Route::post('/actualizartarea','App\Http\Controllers\cloudtickets@actualizartarea');

Route::post('/nuevost','App\Http\Controllers\cloudtickets@nuevost');
Route::post('/mandarmailnuevo','App\Http\Controllers\cloudtickets@mandarmailnuevo');


Route::get('/salientesc','App\Http\Controllers\cloudtickets@salientesc')->middleware('supervisorsienna');
Route::get('/extrastickets','App\Http\Controllers\cloudtickets@extrastickets')->middleware('adminsienna');
Route::post('/extrastickets','App\Http\Controllers\cloudtickets@extrastickets2')->middleware('adminsienna');
Route::post('/createticketsoporte','App\Http\Controllers\cloudtickets@createticketsoporte')->middleware('supervisorsienna');
Route::post('/createticketsoporte2','App\Http\Controllers\cloudtickets@createticketsoporte2')->middleware('supervisorsienna');
Route::get('/createticketsoportecliente','App\Http\Controllers\cloudtickets@createticketsoportecliente')->middleware('supervisorsienna');
Route::post('/createticketsoportecliente','App\Http\Controllers\cloudtickets@createticketsoportecliente2')->middleware('supervisorsienna');
Route::get('/getsaliente','App\Http\Controllers\cloudtickets@getsaliente');
Route::post('/getsaliente','App\Http\Controllers\cloudtickets@getsaliente2');
Route::post('/getsalienteticket','App\Http\Controllers\cloudtickets@getsalienteticket');

Route::get('/pruebatelefonia','App\Http\Controllers\cloudtickets@pruebatelefonia');
Route::get('/userprofile','App\Http\Controllers\cloudtickets@userprofile');

Route::post('/llamadobroadcast','App\Http\Controllers\cloudtickets@llamadobroadcast');

Route::post('/ctusers','App\Http\Controllers\cloudtickets@ctusers');
Route::post('/derivar','App\Http\Controllers\cloudtickets@derivarpost');
Route::get('/abminternos','App\Http\Controllers\cloudtickets@abminternos');

Route::get('/cl', function () {
    return view('/sienna/cl');
});

Route::get('/wisprosaliente', function () {
    return view('/sienna/salienteWispro');
});

Route::get('/userprofile2', function () {
    return view('/sienna/userprofile');
});
});
//});


Route::get('/salir','App\Http\Controllers\ChauController@logout');
Route::get('/usuarios','UsersController@list');
Route::get('/denied', ['as' => 'denied', function() {
    return view('denied');
}]);

Route::fallback(function () {
    return view('404');
 });
