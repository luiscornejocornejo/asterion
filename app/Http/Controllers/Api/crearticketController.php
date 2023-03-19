<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\base;
use App\Models\masterreport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class crearticketController extends Controller
{

    public function select2($id, $mail)
    {

        $resultados = masterreport::where('id', '=', $id)->get();
        foreach ($resultados as $valuep) {
            $query2 = $valuep->query;
            $dbexterna = $valuep->base;
            $parametros = $valuep->parametros;
        }
        if ($parametros == "logeo") {

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

    public function existe($email)
    {
        $query = "select user_id from homero_os.ost_user_email  where address='" . $email . "'";
        $fields3 = $this->conectar2(11);
        $fields55 = DB::reconnect('mysql2')->select($query);
        $user_id = 0;
        foreach ($fields55 as $value) {
            $user_id = $value->user_id;
        }
        return $user_id;
    }
    public function crearticketenos(Request $request)
    {

        //extras ticket
        $priority = $request->priority;
        $subject = $request->subject;
        $xen_chatid = $request->xen_chatid;
        $chat_status = $request->chat_status;
        $chat_link = $request->chat_link;
        $body = "<iframe src=" . $chat_link . "    width=100% height=400></iframe>";

        //extras user

        $clientid = $request->clientid;
        $nameuser = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $plan_name = $request->plan_name;
        $whatsapp_nro=$request->whatsapp_nro;
        

        //ticket
        $topic_id = $request->topic_id;
        $source = $request->source; //="instagram";
        $name = $request->name; //="Bachata";
        $email = $request->email; //="17host.com";
        $request->emailcustomer; //="cliente17@suricata.la";
        $idcustomer = $request->idcustomer; //= "17";
        $phone = $request->phone; //= "1123123132";
        $conversation_id = $request->conversation_id; //= "pruebaloca 17";
        $subject = $request->subject;
        $ip = $request->ip;
        $dept_id = $request->dept_id;

        
        $title = $request->title;
        $message = $request->message;
        $conversation_share_url = $request->conversation_share_url;


        $status_id = $request->status_id;

        $user_id = $this->existe($request->email);
        if ($user_id == 0) {
            echo "crear usuario";

        } else {

            $maxnumber=$this->maxnumber();
            $tt = $this->insertarTicket($user_id, $topic_id, $status_id, $source, $subject, $body,$maxnumber,$dept_id,$ip);
            $maxid = $this->maxid();
            $tt2 = $this->insertarTicketextra($maxid, $priority, $subject, $xen_chatid, $chat_status, $chat_link);
            $tt3=$this->updateusernuevo($user_id, $clientid, $nameuser, $email, $phone, $whatsapp_nro,$plan_name);
            $maxidhilo = $this->maxidhilo();
            $tt4=$this->insertarTicketsystem($maxid, $user_id, $source, $title, $body,$maxidhilo);


        }

    }
    public function maxid()
    {
        $query = "select max(ticket_id) as max from homero_os.ost_ticket ";
        $fields3 = $this->conectar2(11);
        $fields55 = DB::reconnect('mysql2')->select($query);
        $max = 0;
        foreach ($fields55 as $value) {
            $max = $value->max;
        }
        return $max;
    }

    public function maxnumber()
    {
        $query = "select  LPAD(max(number)+1 , 6, '0') as number from homero_os.ost_ticket ";
        $fields3 = $this->conectar2(11);
        $fields55 = DB::reconnect('mysql2')->select($query);
        $number = 0;
        foreach ($fields55 as $value) {
            $number = $value->number;
        }
        return $number;
    }

    public function maxidhilo()
    {

        $query = "select max(id) as max from homero_os.ost_thread ";

        $fields3 = $this->conectar2(11);
        $fields55 = DB::reconnect('mysql2')->select($query);
        $max = 0;
        foreach ($fields55 as $value) {

            $max = $value->max;
        }

        return $max;

    }

    public function insertarTicketsystem($maxid, $user_id, $source, $title, $body,$maxidhilo)

    {
        echo $query4 = "INSERT INTO homero_os.ost_thread (object_id, object_type, extra, lastresponse, lastmessage, created)
        VALUES(" . $maxid . ", 'T', '', null, now(), now());
       ";

         $fields55 = DB::reconnect('mysql2')->select($query4);

       echo "<br><br>";
       echo $query5 = "INSERT INTO homero_os.ost_thread_entry (pid, thread_id, staff_id, user_id, `type`, flags, poster, editor, editor_type, source, title, body, format, ip_address, extra, recipients, created, updated)

       VALUES(0, " . $maxidhilo . ",0, '" . $user_id . "',  'M', 0, '', 0, '', '" . $source . "', '" . $title . "', '" . $body . "', 'html', '', '', '', now(), now());
       ";

       $fields55 = DB::reconnect('mysql2')->select($query5);


    }
    public function insertarTicketextra($maxid, $priority, $subject, $xen_chatid, $chat_status, $chat_link)

    {
        echo $query2 = "INSERT INTO homero_os.ost_ticket__cdata (ticket_id, priority, subject, xen_chatid, chat_status, chat_link, extra1_ticket, extra2_ticket, plan_name, lat, `long`)


        VALUES(" . $maxid . ", '".$priority."', '".$subject."', '".$xen_chatid."', '".$chat_status."', '".$chat_link."', '', '', '', '', '');
           ";
       echo "<br><br>";

        $fields55 = DB::reconnect('mysql2')->select($query2);


    }
    public function insertarTicket($user_id, $topic_id, $status_id, $source, $title, $body,$maxnumber,$dept_id,$ip)
    {

        echo $queryinsert = " INSERT INTO homero_os.ost_ticket
    (ticket_pid, `number`, user_id, user_email_id, status_id, dept_id, sla_id, topic_id, staff_id, team_id, email_id, lock_id, flags, sort, ip_address, source, source_extra, isoverdue, isanswered, duedate, est_duedate, reopened, closed, lastupdate, created, updated, user_data_json)
     VALUES(null, '".$maxnumber."','" . $user_id . "', 0, " . $status_id . ", ".$dept_id.", 0, 0, " . $topic_id . ", 0, 0, 0, 0, 0, '', '".$ip."', '" . $source . "', 0, 0, null,  now(), null, null, now(), now(), now(), '');
       ";
        echo "<br><br>";

        $fields3 = $this->conectar2(11);
        //   $fields55 = DB::reconnect('mysql2')->select($queryinsert);
        sleep(2);

      

     

        echo "<br><br>";

       
    }

    public function tieneticket(Request $request)
    {
        $return = false;

        return $return;
    }


    public function updateusernuevo($user_id, $clientid, $name, $email, $phone, $whatsapp_nro,$plan_name)

    {
        $query3 = "UPDATE homero_os.ost_user__cdata SET clientid='".$clientid."',
         name='".$name."', email='".$email."', phone='".$phone."', whatsapp_nro='".$whatsapp_nro."',
          plan_name='".$plan_name."'  WHERE user_id=" . $user_id . "";

     
       $fields55 = DB::reconnect('mysql2')->select($query3);
    }


    public function insertarusernuevo($user_id, $clientid, $name, $email, $phone, $whatsapp_nro)

    {

        $query3 = "INSERT INTO homero_os.ost_user__cdata (user_id, clientid, name, email, phone, whatsapp_nro, plan_name, lat, `long`, extra1, extra2)

        VALUES('" . $user_id . "', '', '', '', '', '', '', '', '', '', '');
       ";
       $fields55 = DB::reconnect('mysql2')->select($query3);
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
