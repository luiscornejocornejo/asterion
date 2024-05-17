<?php

namespace App\Console\Commands;

use App\Models\cronmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Models\empresa;
use App\Models\categoria;

class limpiezacloud extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'semanal:limpiezacloud';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'limpiezacloud';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        echo "entro limpieza";
        $CONE=$this->conectar();
        $queryoriginal="show databases";
        $resultados11 = DB::connection('mysql2')->select($queryoriginal);
        $os = array("sys","defaultdb", "information_schema", "mysql", "moldemaestro", "performance_schema", "sienna1", "telesmart", "template","anterior","infitelecom");

        foreach($resultados11 as $val){

             $Database=$val->Database; 
             if($Database=="infitelecom"){

                continue;
             }
             if($Database=="futurity"){

                continue;
             }
            
            if (!in_array($Database, $os)) {
                echo $Database;
                echo "<br>";
                $sale = $this->limpieza($Database);
            }
            

        }
      

        return 0;
    }


    public function limpieza($merchant){

        $CONE=$this->conectar();
        $query="
                insert into ".$merchant.".siennaticketsc 
                select * from ".$merchant.".siennatickets s where siennaestado ='4' and s.t_cerrado < DATE_SUB(CURRENT_DATE(), INTERVAL 3 MONTH);
     
        ";

        $query="select count(*) as cuantos from ".$merchant.".siennaticketsc ";
        try {
            $resultados = DB::connection('mysql2')->select($query);
            foreach($resultados as $val){
                echo $val->cuantos;
            }
            echo sizeof($resultados);
                          }
         catch(\Illuminate\Database\QueryException$ex){
          echo "no".$ex;
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


}