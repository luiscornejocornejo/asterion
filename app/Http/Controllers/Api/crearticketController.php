<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\base;
use App\Models\endpoint;
use App\Models\enpointnombre;
use App\Models\masterreport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\t_tickets;
use App\Models\t_bitacora;
use App\Models\t_estado;

use Carbon\Carbon;

class crearticketController extends Controller
{

    public function select2($id,$mail)
    {

        $resultados = masterreport::where('id', '=', $id)->get();
        foreach ($resultados as $valuep) {
            $query2 = $valuep->query;
            $dbexterna = $valuep->base;
            $parametros = $valuep->parametros;
        }
        if($parametros=="logeo"){

          $valordelcampo = $mail;
          $clave = "@" . $parametros;
          $query2 = str_replace($clave, $valordelcampo, $query2);
        }
       // echo $query2;
        if ($dbexterna == 1) {
            $fields2 = DB::select($query2);
        } else {

            $prueba = $this->conectar2($dbexterna);

            //si es distinta a 1 aa otra base
            $fields2 = DB::connection('mysql2')->select($query2);
        }
       // var_dump($fields2);
        return $fields2;
    }
    public static function conectar2($id)
    {

        $resultados = base::where('id', '=', $id)->get();
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
    public function crearticketenos(Request $request)
    {

         $user_id=$this->existe($request->email);
         if($user_id==0){
            echo "crear usuario";

         }else{

            

            $topic_id= 6;

            $alert= true;
            $autorespond= true;
            $source="instagram";
            $name="Bachata";
            $email="17host.com";
            $emailcustomer="cliente17@suricata.la";
            $idcustomer= "17";
            $phone= "1123123132";
            $conversation_id= "pruebaloca 17";
            $subject="tema canal";
            $chat_link="https://meerkat.xenioo.com/wshare/41C27038C14B45FEAB5D597EEA317C38";
            $ip= "123.211.233.123";
            $message="mensaje";
            $conversation_share_url="https://meerkat.xenioo";

            $status_id=1;
          $tt=$this->insertarTicket($user_id,$topic_id,$status_id,$source);

         }



    }
    public function maxid(){


        $query="        select max(ticket_id) as max from homero_os.ost_ticket ";
           
       
           $fields3 = $this->conectar2(11);
           $fields55 = DB::reconnect('mysql2')->select($query);
           $max=0;
           foreach($fields55 as $value){
   
               $max=$value->max;
           }
       
           return $max;
   
       }

    public function insertarTicket($user_id,$topic_id,$status_id,$source){


    echo   $queryinsert= " INSERT INTO homero_os.ost_ticket 
    (ticket_pid, `number`, user_id, user_email_id, status_id, dept_id, sla_id, topic_id, staff_id, team_id, email_id, lock_id, flags, sort, ip_address, source, source_extra, isoverdue, isanswered, duedate, est_duedate, reopened, closed, lastupdate, created, updated, user_data_json)
     VALUES(null, '000091','".$user_id."', 0, ".$status_id.", 0, 0, 0, ".$topic_id.", 0, 0, 0, 0, 0, '', 'Other', '".$source."', 0, 0, null,  now(), null, null, now(), now(), now(), '');
       ";
    echo "<br><br>";

    $fields3 = $this->conectar2(11);
    $fields55 = DB::reconnect('mysql2')->select($queryinsert);
     $maxid=$this->maxid();

        echo  $query2="INSERT INTO homero_os.ost_ticket__cdata (ticket_id, priority, subject, xen_chatid, chat_status, chat_link, extra1_ticket, extra2_ticket, plan_name, lat, `long`)
        

        sleep(2);
         VALUES(".$maxid.", '', '', '', '', '', '', '', '', '', '');
            ";
                echo "<br><br>";

                $fields55 = DB::reconnect('mysql2')->select($query2);

         $query3="INSERT INTO homero_os.ost_user__cdata (user_id, clientid, name, email, phone, whatsapp_nro, plan_name, lat, `long`, extra1, extra2)
            
             VALUES('".$user_id."', '', '', '', '', '', '', '', '', '', '');
            ";
            $fields55 = DB::reconnect('mysql2')->select($query3);

echo "<br><br>";



        echo $query4="INSERT INTO homero_os.ost_thread (object_id, object_type, extra, lastresponse, lastmessage, created) VALUES(0, '', '', '', '', '');
        ";
    echo "<br><br>";

        echo $query5="INSERT INTO homero_os.ost_thread_entry (pid, thread_id, staff_id, user_id, `type`, flags, poster, editor, editor_type, source, title, body, format, ip_address, extra, recipients, created, updated) 
        
        VALUES(0, 0, '".$user_id."', 0, '', 0, '', 0, '', '', '', '', 'html', '', '', '', '', '');
        ";
    }

    public function existe($email)
    {

        $query="select user_id from homero_os.ost_user_email  where address='".$email."'";
    
        $fields3 = $this->conectar2(11);
        $fields55 = DB::reconnect('mysql2')->select($query);
        $user_id=0;
        foreach($fields55 as $value){

            $user_id=$value->user_id;
        }
    
        return $user_id;
    }

    public function tieneticket(Request $request)
    {
        $return=false;
    
      return $return;
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
