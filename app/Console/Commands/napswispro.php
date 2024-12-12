<?php

namespace App\Console\Commands;

use App\Models\cronmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Models\empresa;
use App\Models\categoria;

class napswispro extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'semanal:napswispro';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'asignacion napswispro';

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
         $query1="select count(*) as cuantos from ".$val->Database.".siennaintegracion where nombre='wispro' ";
       
            $resultados1 = DB::select($query1);

            foreach($resultados1 as $val2){
                if($val2->cuantos>0){
                    echo $val2->cuantos;

                    $prueba = $this->conectar(14);
                     echo   $query3 = "select * from wispro.ws_cliente where nombre='" . $val->Database . "'";
                    $datos = DB::connection('mysql2')->select($query3);
                   // var_dump($datos);
                    $url = "";
                    $tokensienna = "";
                   
                    foreach ($datos as $val) {

                        echo  $url = $val->headerlogin;
                        $tokensienna = $val->tokensienna;
                        $campo = $val->headerendpoint; 
                        $merchant = $val->nombre;
                        echo $query111="truncate " . $merchant . ".naps";
                       $resultados111 = DB::select($query111);

                        echo "https://" . $merchant . "." . $url . "/api/naps";
                        
                        if ($url <> "") {
                            $urlfinal="https://" . $merchant . "." . $url . "/api/naps?token=".$tokensienna;
                            $dat = file_get_contents($urlfinal); //7461023535
                            $dat = json_decode($dat);
                           // var_dump($dat);
                            foreach($dat->data as $nodoval){
                               // var_dump($nodoval);
                                $nombre=$nodoval->name;
                                $lat=$nodoval->latitude;
                                $log=$nodoval->longitude;
                                $direcion=$nodoval->id;
                                $ciudad=$nodoval->details."  capacity:(".$nodoval->capacity.")";
                                $idget=$nodoval->id;
                                $mensaje="";
                                $estadonodo=1;
                            
                            echo   $query11="INSERT INTO " . $merchant . ".naps ( nombre, lat, log, direcion, ciudad, idget, mensaje, estadonodo) 
                                VALUES('".$nombre."', '".$lat."', '".$log."', '".$direcion."', '".$ciudad."', ".$idget.", '".$mensaje."', ".$estadonodo.")
                                ON DUPLICATE KEY UPDATE nombre='".$nombre."', lat='".$lat."', log='".$log."', direcion='".$direcion."', ciudad='".$ciudad."'";
                                $resultados11 = DB::select($query11);

                            }
                        } else {
                        $dat = "";
                        }
                    }
                }else{

                    echo "no hay<br><br>";
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