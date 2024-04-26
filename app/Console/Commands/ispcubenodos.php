<?php

namespace App\Console\Commands;

use App\Models\cronmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Models\empresa;
use App\Models\categoria;

class ispcubenodos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'semanal:nodos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'asignacion';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $query="show databases";

        $resultados = DB::select($query);
    
        $listadono=array ('mysql','information_schema','performance_schema','sys','defaultdb','telesmart','anterior');
        foreach($resultados as $val){
    
          //echo $val->Database;
          if (in_array($val->Database, $listadono)) {
              continue;
          }
         $query1="select count(*) as cuantos from ".$val->Database.".siennaintegracion where nombre='ispcube2' ";
       
            $resultados1 = DB::select($query1);

            foreach($resultados1 as $val2){
                if($val2->cuantos>0){
                    echo $val2->cuantos;

                    $prueba = $this->conectar(14);
                 echo   $query3 = "select * from ispcube2.ws_cliente where nombre='" . $val->Database . "'";
                    $datos = DB::connection('mysql2')->select($query3);
                   // var_dump($datos);
                    $url = "";
                    $tokensienna = "";
                    foreach ($datos as $val) {

                        echo  $url = $val->headerlogin;
                        $tokensienna = $val->tokensienna;
                        $campo = $val->headerendpoint;
                        $merchant = $val->nombre;
                    

                        echo "https://" . $merchant . "." . $url . "/api/nd";
                        if ($url <> "") {
                        
                            if($merchant=="giles"){
                                    $urlfinal="http://" . $merchant . "." . $url . "/api/nd";
                            }else{
                                $urlfinal="https://" . $merchant . "." . $url . "/api/nd";

                            }
                            $dat = file_get_contents($urlfinal); //7461023535
                            $dat = json_decode($dat);
                           // var_dump($dat);
                            foreach($dat as $nodoval){

                                $nombre=$nodoval->code;
                                $lat=$nodoval->lat;
                                $log=$nodoval->lng;
                                $direcion=$nodoval->address;
                                $ciudad=$nodoval->comment;
                                $idget=$nodoval->id;
                                $mensaje="";
                                $estadonodo=1;
                            
                              echo   $query11="INSERT INTO " . $merchant . ".nodos ( nombre, lat, log, direcion, ciudad, idget, mensaje, estadonodo) 
                                VALUES('".$nombre."', '".$lat."', '".$log."', '".$direcion."', '".$ciudad."', ".$idget.", '".$mensaje."', ".$estadonodo.")
                                ON DUPLICATE KEY UPDATE nombre='".$nombre."', lat='".$lat."', log='".$log."', direcion='".$direcion."', ciudad='".$ciudad."'";
                                $resultados11 = DB::select($query11);

                            }
                        } else {
                        $dat = "";
                        }
                    }
                }
                

            }
    
        }
    }


    public function conectar($id)
    {
        $query = "SELECT * FROM `base`    where id='" . $id . "'";
        $resultados = DB::select($query);
        foreach ($resultados as $value) {
            $host = $value->host;
            $base = $value->base;
            $usuario = $value->usuario;
            $pass = $value->pass;
            $port = $value->port;
        }
        config(['database.connections.mysql2.host' => $host]);
        config(['database.connections.mysql2.database' => $base]);
        config(['database.connections.mysql2.username' => $usuario]);
        config(['database.connections.mysql2.password' => $pass]);
        config(['database.connections.mysql2.port' => $port]);
    }



}