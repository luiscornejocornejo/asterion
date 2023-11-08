<?php

namespace App\Console\Commands;

use App\Models\cronmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Mail;

class asignacion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'semanal:asignacion';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = ' asignacion';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        echo "entro";
        $sale = $this->asignacion();

        return 0;
    }
  
    public function asignacion()
    {
        $query="select *  from siennatickets
        where siennaestado not in('3','4')  
         and asignado='0'
        ";

        $resultados = DB::select($query);

        foreach($resultados as $value){

            echo $area=$value->siennadepto;
            echo $tick=$value->id;

           echo  $query2="select idusuario,(select count(*) from siennatickets s2  
            where s2.asignado=s.idusuario and s2.siennaestado not in('3','4'))as cantidad from siennaloginxenioo s 
            where login=1 and areas =".$area." and date(now())=date(created_at) group by idusuario order by cantidad limit 1";
            $resultados2 = DB::select($query2);
            $idusu=0;
            echo "/n/r";
            foreach($resultados2 as $value2){

                echo $idusu=$value->idusuario;
            }

            if($idusu<>0){
               echo  $query3="update siennaticket set asginado='".$idusu."' where id=".$tik."";
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
        config(['database.connections.mysql2.port' => $port]);

        config(['database.connections.mysql2.database' => $base]);
        config(['database.connections.mysql2.username' => $usuario]);
        config(['database.connections.mysql2.password' => $pass]);
    }

    public function conectar2($id)
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
        config(['database.connections.mysql3.host' => $host]);
        config(['database.connections.mysql3.port' => $port]);

        config(['database.connections.mysql3.database' => $base]);
        config(['database.connections.mysql3.username' => $usuario]);
        config(['database.connections.mysql3.password' => $pass]);
    }
}
