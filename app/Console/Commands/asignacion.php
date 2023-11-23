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
  
    public function enhora($area){
        // Configura la zona horaria a la hora local

       // $area=$request->area;

        $emp=empresa::find(1);
        $zona=$emp->zona;
        
        date_default_timezone_set($zona); // Reemplaza 'America/Buenos_Aires' con la zona horaria deseada

        // Obtiene la hora actual en formato de 24 horas
        echo $horaLocal = date('H');
        echo $diaSemana = date('l');
        $cat=categoria::where('area','=',$area)->get();

        foreach($cat as $val){

        echo $fecha=$val->$diaSemana;

        }

        $fec=explode("-",$fecha);

        if(($horaLocal>$fec[0]) and ($horaLocal<$fec[1])){
            return true;
        }else{

            return false;

        }
        // Imprime la hora local


}
    public function asignacion()
    {
        $query="select *  from siennatickets
        where siennaestado not in('3','4')  
         and asignado='0'
        ";

        $resultados = DB::select($query);

        foreach($resultados as $value){

             $area=$value->siennadepto;
             $tick=$value->id;

             $enhora=$this->enhora($area);
             if($enhora){
                $query2="select idusuario,(select count(*) from siennatickets s2  
                where s2.asignado=s.idusuario and s2.siennaestado not in('3','4'))as cantidad from siennaloginxenioo s 
                where login=1 and areas =".$area." and date(now())=date(created_at) group by idusuario order by cantidad limit 1";
                $resultados2 = DB::select($query2);
                $idusu=0;
                echo "/r";
                foreach($resultados2 as $value2){
    
                     $idusu=$value2->idusuario;
                }
    
                if($idusu<>0){
                   echo  $query3="update siennatickets set asignado='".$idusu."' where id=".$tick."";
                   $resultados3 = DB::select($query3);
    
                }
             }else{
                echo  $query3="update siennatickets set asignado='99999' where id=".$tick."";
                $resultados3 = DB::select($query3);
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
