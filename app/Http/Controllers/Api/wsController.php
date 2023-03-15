<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\base;
use App\Models\endpoint;
use App\Models\enpointnombre;
use App\Models\masterreport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class wsController extends Controller
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
    public function datostickets(Request $request)
    {

        // $id = $request->id;
        $fields2 = $this->select2(75,$request->mail);
        //$fields3 = $this->select2(77);
        //$fields4 = $this->select2(78);
        // $fields5 = $this->select2(79);
        $return2 = json_encode($fields2);
        return $return2;
    }
    public function extrasmail(Request $request)
    {
        $fields3 = $this->conectar2(11);
        $ticketid = $request->id;
        $query66 = "SELECT body FROM ost_thread_entry WHERE thread_id= (SELECT id FROM ost_thread where object_id=" . $ticketid . ")";
        $fields66 = DB::reconnect('mysql2')->select($query66);
        $return2 = json_encode($fields66);
        return $return2;

    }

    public function extrasuser(Request $request)
    {
        $fields3 = $this->conectar2(11);
        $user_id = $request->user_id;
        $query66 = "select * from ost_user__cdata where user_id=" . $user_id . "";
        $fields66 = DB::reconnect('mysql2')->select($query66);
        $return2 = json_encode($fields66);
        return $return2;

    }
     
    public function extraswhatapp(Request $request)
    {
        $fields3 = $this->conectar2(11);
        $ticketid = $request->id;
        $querydatos = "select f.chat_link,f.extra1_ticket,f.extra2_ticket,f.subject, c.priority_desc as priority
        
        from ost_ticket a
       left join   ost_ticket__cdata f
       on f.ticket_id=a.ticket_id
       left join ost_ticket_priority c on f.priority = c.priority_id 

       where a.ticket_id=" . $ticketid;
        $fields55 = DB::reconnect('mysql2')->select($querydatos);

        $return = array();
        foreach ($fields55 as $value) {
            $return = array("chat_link" => $value->chat_link);
        }

        $return2 = json_encode($fields55);
        return $return2;
    }

    public function extrahistorial(Request $request)
    {
        $fields3 = $this->conectar2(11);
        $ticketid = $request->id;
        $querydatos = "select b.name,a.username,a.timestamp,a.data from ost_thread_event a
    left join ost_event b on b.id=a.event_id
    where a.thread_id=(select id from ost_thread where object_id=" . $ticketid . ")
    order by a.id asc";
        $fields55 = DB::reconnect('mysql2')->select($querydatos);
        $return2 = json_encode($fields55);
        return $return2;
    }

    public function topics(Request $request)
    {

        $fields3 = $this->conectar2(11);
        $querydatos = "select topic_id,topic from ost_help_topic";
        $fields55 = DB::reconnect('mysql2')->select($querydatos);
        $return2 = json_encode($fields55);
        return $return2;
    }

    public function departments(Request $request)
    {

        $fields3 = $this->conectar2(11);
        $querydatos = "select id,name  from ost_department";
        $fields55 = DB::reconnect('mysql2')->select($querydatos);
        $return2 = json_encode($fields55);
        return $return2;
    }
    public function ost_ticket_status(Request $request)
    {

        $fields3 = $this->conectar2(11);
        $querydatos = "select id,name from ost_ticket_status";
        $fields55 = DB::reconnect('mysql2')->select($querydatos);
        $return2 = json_encode($fields55);
        return $return2;
    }

    public function staff(Request $request)
    {

        $fields3 = $this->conectar2(11);
        $querydatos = "select staff_id as id,concat(firstname, ' ', lastname) as name from ost_staff";
        $fields55 = DB::reconnect('mysql2')->select($querydatos);
        $return2 = json_encode($fields55);
        return $return2;
    }


    function cambiarquery($parametros, $request, $query)
    {
  
  
      if ($parametros == "") {
        return $query;
      }
  
      $posicion_coincidencia = strpos($parametros, ",");
      //se puede hacer la comparacion con 'false' o 'true' y los comparadores '===' o '!=='
      if ($posicion_coincidencia === false) {
        //un solo parametro
        $nombredelcampo = $parametros;
        $valordelcampo = $request->$nombredelcampo;
        $clave = "@" . $nombredelcampo;
        $query2 = str_replace($clave, $valordelcampo, $query);
        return $query2;
      } else {
        //varios parametros
      }
  
      return $query;
    }

    public function ws(Request $request)
    {

        $ws = $request->ws;
        $token = $request->token;
        $return0 = array();
        $endpoint = endpoint::where('enpointnombre', '=', $ws)->get();
        foreach ($endpoint as $value) {
            $idreport = $value->masterreport;
            $nombre = $value->nombre;
            //$buscar = $value->ws;
            $buscandotoken = enpointnombre::where('id', '=', $ws)->get();
            foreach ($buscandotoken as $valor) {
                $tokentabla = $valor->token;
                if ($tokentabla != $token) {
                    $error = array("error token" => "error de credenciales");
                    return json_encode($error);
                }
            }
            $master = masterreport::where('id', $idreport)->get();
            foreach ($master as $value2) {
              echo   $query = $value2->query;
                $dbexterna = $value2->base;
                $parametros = $value2->parametros;
            }


            $query=$this->cambiarquery($parametros, $request, $query);
            if ($dbexterna == 1) {
                $datos = DB::select($query);
            } else {
                $prueba = $this->conectar($dbexterna);
                //si es distinta a 1 aa otra base
                $datos = DB::connection('mysql2')->select($query);
            }
            $return = array($nombre => $datos);
            array_push($return0, $return);
            unset($return);
        }
        $return2 = json_encode($return0);
        return $return2;
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
