<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Redirect;
class Reportes 
{
    
    public function handle($request, Closure $next)
    {


        $idusuario=session()->has('idusuario');
        //echo $idusuario;
        if($idusuario){
            return $next($request);
/*
                   //Url a la que se le dará acceso en las peticiones
      ->header("Access-Control-Allow-Origin", "https://test.siennasystem.com")
      //Métodos que a los que se da acceso
      ->header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE")
      //Headers de la petición
      ->header("Access-Control-Allow-Headers", "X-Requested-With, Content-Type, X-Token-Auth, Authorization"); 
  */
        }else{
            return Redirect::to(env('APP_URL'));

           // return Redirect::to("https://test.siennasystem.com/");
        }


        /*
        $idmasterreport = $request->id;
        $idusuario=  session('idusuario'); 
        //dd($idmasterreport);
        echo $query = "SELECT * FROM permisos_ceviche 
           where idreporte='" . $idmasterreport . "'  and idusuario='".$idusuario."'";
                $resultadosedicion = DB::select($query);
                if(sizeof($resultadosedicion)>0){
                    echo sizeof($resultadosedicion);
                        $pdidirector=1;
                        return $next($request);

                }else{
                        redirect()->route('denied');


                }*/

                return Redirect::to("https://test.siennasystem.com/");



    }
   
}
