<?php

namespace App\Console\Commands;

use App\Models\cronmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Models\empresa;
use App\Models\siennaticketssoporte;
use Webklex\PHPIMAP\ClientManager;
use Webklex\PHPIMAP\Client;
class mailtickets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'semanal:mailtickets';

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
            echo $asunto=$message->getSubject();
            echo "<hr>";
    
            $llegando=$message->getHeader()->getAttributes()["from"];
            $thearray = (array) $llegando;
            $prefix = chr(0).'*'.chr(0);
            $nn="values";
            $lle= (array)$thearray[$prefix.$nn][0];
            $mailenvia=$lle["mail"];
    
          
            echo "<hr>";
            echo $cuerpo=$message->getHTMLBody();
             
            echo "<hr>";
            if($cuerpo==""){
              echo $cuerpo=$message->getTextBody();
    
            }
        
    
            echo "<hr>";
            $nya=$mailenvia."<br>".$asunto."<br>".$cuerpo;
           //crear ticket en sienna

           
        $si = new siennaticketssoporte();
        $si->siennadepto = "1";
        $si->cliente = "";
        $si->siennatopic = "2";
        $si->cedula = "";
        $si->siennaestado = "1";
        $si->siennasource = "7";
        $si->cel = "";
        $si->nya = $asunto;
        $si->asignado = 0;
        $si->user_id = "";
        $si->conversation_url = "";
        $si->conversation_id = "";
        $si->save();
/*
        $se = new siennaseguimientos();
        $se->ticket = $si->id;
        $se->tipo = "6";
        $se->descripcion = $nya;
        $se->autor = "sistema";
        $se->save();

           $querye="INSERT INTO soporte.siennatickets ( siennadepto, cliente, siennatopic, siennaestado, siennasource, created_at, updated_at, t_cerrado, cel, nya, conversation_url, conversation_id, cedula, user_id, asignado)
            VALUES( 1, '', 1, 1, '3', now(), now(), now(), '0', '".$nya."', '', '', '', '', 0);";
            $resultados1 = DB::select($querye);*/
            //$message = $message->move($folder_path = "luisleidos");
           $vueltas++;
           if($vueltas==5){
            break;
            //
           }
    
          }
          $client->disconnect();
         
        } catch (\Throwable $th) {
          print_r($th);
        }
        
       
    }
    /*
        public function crearsoporte($nya){
            echo $nya ;
                $curl = curl_init();
        
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://soporte.suricata.cloud/api/creartickessienna',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>'{
                "cel":"1",
                "token":"2233344",
                "siennadepto":"1",
                "siennatopic":"1",
                "siennasource":"1",
                "nya":"'.$nya.'",
                "conversation_url":"1",
                "conversation_id":"1",
                "siennaestado":"1",
                "a_status":"1",
                "s_status":"1",
                "cliente":"1"
                }',
                    CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                    ),
                ));
        
                $response = curl_exec($curl);
                echo $response;
        
                curl_close($curl);
        
        }
    */

}