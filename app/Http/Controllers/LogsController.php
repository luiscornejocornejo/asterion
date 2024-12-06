<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscripcion;
use App\Eve;
use Illuminate\Support\Facades\DB;
use Redirect;
use Flash;
use App\Models\users;
use App\Models\graficos;
use App\Models\categoria;
use App\Models\siennaloginxenioo;
use Mail; 
use App\Models\logs;

use phpDocumentor\Reflection\PseudoTypes\False_;

class LogsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    public function url(){
        $url="";
        if (isset($_SERVER['HTTP_HOST'])) {
            $url = explode('.', $_SERVER['HTTP_HOST']);
        } elseif(isset($_SERVER['SERVER_NAME'])){
            $url =  array_shift($domainParts); 
        }
        return $url;
    }
    public function guardarlogs($accion){
        $logs=new logs();
        
        $logs->usuario=session('idusuario');
        $logs->url=$this->url();
        $logs->accion=$accion;
        $logs->ip=$this->get_client_ip();
        dd($logs->toArray());

        $dd=$logs->save();
        dd($dd);
        return "";
    }
}