<?php

namespace App\Console\Commands;

use App\Models\cronmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
//use Mail;
use App\Models\siennaseguimientossoporte;
use App\Models\siennaticketssoporte;
use Webklex\PHPIMAP\ClientManager;

class mailtickets 
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ma:mailtickets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'mailtickets';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        echo "entro mail";
        $entra=$this->pruebamail();
    }
    public function pruebamail(){


        $cm = new ClientManager('/var/www/laravel/config/imap.php');
        /** @var \Webklex\PHPIMAP\Client $client */
        $client = $cm->make([
            'host'          => 'imap.gmail.com',
            'port'          => 993,
            'encryption'    => 'ssl',
            'validate_cert' => false,
            'username'      => 'support@suricata.la',
            'password'      => 'Castillo1366+',
            'protocol'      => 'imap'
        ]);
        
        //Connect to the IMAP Server
    
        try {
          $client->connect();
          $folderluis=$client->getFolderByName("INBOX");
          $messages=$folderluis->query()->all()->get();
          //dd($messages);
          $vueltas=0;
          foreach ($messages as $message) {
            $nya="";
             $asunto=$message->getSubject();
    
            $llegando=$message->getHeader()->getAttributes()["from"];
            $thearray = (array) $llegando;
            $prefix = chr(0).'*'.chr(0);
            $nn="values";
            $lle= (array)$thearray[$prefix.$nn][0];
           echo $mailenvia=$lle["mail"];
             $cuerpo=$message->getHTMLBody();
            if($cuerpo==""){
               $cuerpo=$message->getTextBody();
    
            }
        
    
            $nya=$asunto."<br>".$cuerpo;
           //crear ticket en sienna

           
        $si = new siennaticketssoporte();
        $si->siennadepto = "1";
        $si->cliente = "";
        $si->siennatopic = "2";
        $si->cedula = "";
        $si->siennaestado = "1";
        $si->siennasource = "7";
        $si->cel = "";
        $si->nya = $mailenvia;
        $si->asignado = 0;
        $si->user_id = "";
        $si->conversation_url = "";
        $si->conversation_id = "";
        $si->save();
       

        $se = new siennaseguimientossoporte();
        $se->ticket = $si->id;
        $se->tipo = "6";
        $se->descripcion = $nya;
        $se->autor = "sistema";
        try {
            $se->save();
        } catch (\Illuminate\Database\QueryException $ex) {
            $message22 = $message->move($folder_path = "noleidos");

            continue;
        }

        $message22 = $message->move($folder_path = "luisleidos");
           $vueltas++;
           if($vueltas==100){
            break;
            
           }
    
          }
          $client->disconnect();
         
        } catch (\Throwable $th) {
          print_r($th);
        }
        
       
    }
   

}

$casa=new mailtickets();
$devo=$casa->handle();