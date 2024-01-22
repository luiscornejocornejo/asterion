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
    
        $listadono=array ('mysql','information_schema','performance_schema','sys','defaultdb','telesmart','anterior','infitelecom');
        foreach($resultados as $val){
    
          echo $val->Database;
          if (in_array($val->Database, $listadono)) {
              continue;
          }
        echo   $val->Database;
       
            //$resultados1 = DB::select($query1);
    
        }
    }



}