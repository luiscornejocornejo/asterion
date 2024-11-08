<?php

namespace App\Console\Commands;

use App\Models\cronmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Models\empresa;
use App\Models\categoria;

class asignaciong extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'semanal:asignaciong';

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
        echo "entro asignacion";
        $CONE=$this->conectar();
        $queryoriginal="show databases";
        $resultados11 = DB::connection('mysql2')->select($queryoriginal);
        $os = array("sys","defaultdb", "information_schema", "mysql", "moldemaestro", "performance_schema", "sienna1","template","anterior","infitelecom");
        //dd($resultados11);

        foreach($resultados11 as $val){

             $Database=$val->Database; 
          //   dd($Database);
             if($Database=="infitelecom"){

                continue;
             }
            
            if (!in_array($Database, $os)) {
                echo $Database;
               
                $sale = $this->asignacion($Database);
            }
            

        }
      
        /*
        $os = array("infitelecom", "soporte", "demo", "sidecom", "amecom2", "ispgroup", "futurity", "wiredcom", "wiber", "gandalf", "onfiber",  "lotelcom", "fibercom", "cyminternet","airfibra","quierofibra");

        foreach($os as $val){

            echo $val;
            $sale = $this->asignacion($val);


        }*/

        return 0;
    }
  
    public function enhora($merchant,$area){
        // Configura la zona horaria a la hora local

       // $area=$request->area;

        //$emp=empresa::find(1);
        $query="select * from ".$merchant.".empresa where id=1";
        $resultados = DB::connection('mysql2')->select($query);

        foreach($resultados as $emp){
          echo   $zona=$emp->zona;

        }
        
        date_default_timezone_set($zona); // Reemplaza 'America/Buenos_Aires' con la zona horaria deseada

        // Obtiene la hora actual en formato de 24 horas
         $horaLocal = date('H');
         $diaSemana = date('l');
        //$cat=categoria::where('area','=',$area)->get();

        $query2="select * from ".$merchant.".categoria where area='".$area."'";
        $cat = DB::connection('mysql2')->select($query2);


        //echo "luis".$merchant;
        foreach($cat as $val){

         $fecha=$val->$diaSemana;

        }

        try {
        $fec=explode("-",$fecha);

        if(($horaLocal>=$fec[0]) and ($horaLocal<$fec[1])){
            return true;
        }else{

            return false;

        }

    } catch (\Throwable $th) {
        return false;
    }
        // Imprime la hora local


}
    public function asignacion($merchant)
    {

        $CONE=$this->conectar();
        $query="select *  from ".$merchant.".siennatickets
        where siennaestado not in('3','4')  
         and asignado='0'
        ";

        $resultados = DB::connection('mysql2')->select($query);
        //echo sizeof($resultados);
        $this->info(sizeof($resultados));
        foreach($resultados as $value){
          //  echo  $query3="update ".$merchant.".siennatickets set asignado='99999' where id=".$tick."";
            //$resultados3 = DB::connection('mysql2')->select($query3);
             $area=$value->siennadepto;
             $tick=$value->id;

             $enhora=$this->enhora($merchant,$area);
             if($enhora){
                $query2="select s.idusuario as uu,(select count(*) from ".$merchant.".siennatickets s2  
                where s2.asignado=s.idusuario and s2.siennaestado not in('3','4'))as cantidad from ".$merchant.".siennaloginxenioo s
                join ".$merchant.".users s3 on s3.id=s.idusuario 
                where
                s3.tickets=1 and 
                s.login=1 and s.areas =".$area." and date(now())=date(s.created_at) group by idusuario order by cantidad limit 1";
                $resultados2 = DB::connection('mysql2')->select($query2);

                $idusu=0;
                foreach($resultados2 as $value2){
    
                     $idusu=$value2->uu;
                }
    
                if($idusu<>0){
                     $query3="update ".$merchant.".siennatickets set asignado='".$idusu."',asignado_at=now(),asignado_t='suricata' where id=".$tick."";
                   $resultados3 = DB::connection('mysql2')->select($query3);

    
                }
             }else{
                  $query3="update ".$merchant.".siennatickets set asignado='99999' where id=".$tick."";
                $resultados3 = DB::connection('mysql2')->select($query3);
            }

           
        }
    }
            

    

    public function conectar()
    {
      
        config(['database.connections.mysql2.host' => 'db-mysql-sfo3-84622-do-user-4274947-0.b.db.ondigitalocean.com']);
        config(['database.connections.mysql2.port' => '25060']);

        config(['database.connections.mysql2.database' => 'infitelecom']);
        config(['database.connections.mysql2.username' => 'doadmin']);
        config(['database.connections.mysql2.password' => 'AVNS_WH2DodUlKTBZgYotOdO']);
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
