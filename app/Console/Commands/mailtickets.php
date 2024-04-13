<?php

namespace App\Console\Commands;

use App\Models\cronmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Models\siennaseguimientossoporte;
use App\Models\siennaticketssoporte;
use Webklex\PHPIMAP\ClientManager;
use Webklex\PHPIMAP\Client;
use Webklex\IMAP\Commands\ImapIdleCommand;

use Webklex\PHPIMAP\Message;
class mailtickets  extends Command
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
       $entra=$this->traermail();
    }


    public function traermail(){

        $cm = new ClientManager('/var/www/laravel/config/imap.php');
        var_dump($cm);
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

        echo "entre";
        $client->connect();
        $folderluis=$client->getFolderByName("INBOX");
        //$folderluis=$client->getFolderByName("luisleidos");
       // dd($folderluis);
        $messages=$folderluis->query()->all()->get();
        foreach ($messages as $message) {
            $nya=""; 
         echo    $asunto=$message->getSubject();
    
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
            $topic="2";
            if(trim($mailenvia)=="reports@suricata.la"){
                $topic="14";

            }
            if(trim($mailenvia)=="noreply@xenioo.com"){
                $topic="15";

            }
            $mailenvia=trim($mailenvia);
            $nya=$asunto."<br>".$cuerpo;
            $tiketid=$this->guardarticket($topic,$mailenvia);
            $seguiid=$this->guardarseguimiento($tiketid,$nya);
            $mov=$this->mover($message);
            $vueltas++;
            if($vueltas==3){
                break; 
            }
        }
        $client->disconnect();
    }

    public function guardarticket($topic,$mailenvia){
        $si = new siennaticketssoporte();
        $si->siennadepto = "1";
        $si->cliente = "";
        $si->siennatopic =$topic;
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
        return $si->id;
    }
    public function guardarseguimiento($tiketid,$nya){
        $se = new siennaseguimientossoporte();
        $se->ticket = $tiketid;
        $se->tipo = "6";
        $se->descripcion = $nya;
        $se->autor = "sistema";
        $se->save();
      
    }

    public function mover($message){
        $message22 = $message->move($folder_path = "luisleidos");
    }
    public function pruebamail(){


       
        
        //Connect to the IMAP Server
        echo "entre";

        try {
          
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
        
            
           //crear ticket en sienna

           
            
       

            

            
            $vueltas++;
            if($vueltas==10){
                break; 
            }
    
          }
          $client->disconnect();
         
        } catch (\Throwable $th) {
            echo "entre";

          print_r($th);
        }
        
       
    }
   

}