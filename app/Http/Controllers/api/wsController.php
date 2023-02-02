<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\masterreport;
use App\Models\endpoint;
use App\Models\enpointnombre;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\base;

class wsController extends Controller
{



  function select2($id)
  {

    $resultados = masterreport::where('id', '=', $id)->get();
    foreach ($resultados as  $valuep) {
      $query2 = $valuep->query;
      $dbexterna = $valuep->base;
    }
    if ($dbexterna == 1) {
      $fields2 = DB::select($query2);
    } else {

      $prueba = $this->conectar2($dbexterna);

      //si es distinta a 1 aa otra base
      $fields2 = DB::connection('mysql2')->select($query2);
    }
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
  public function datostickets()
  {

    echo "entro";
    // $id = $request->id;
    $fields2 = $this->select2(75);
    $fields3 = $this->select2(77);
    $fields4 = $this->select2(78);
    $fields5 = $this->select2(79);
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
  public function extraswhatapp(Request $request)
  {
    $fields3 = $this->conectar2(11);
    $ticketid = $request->id;
    $querydatos = "select f.chat_link from ost_ticket a 
       left join   ost_ticket__cdata f
       on f.ticket_id=a.ticket_id
       where a.ticket_id=" . $ticketid;
    $fields55 = DB::reconnect('mysql2')->select($querydatos);
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
  
  public function ws(Request $request)
  {

    $ws = $request->ws;
    $token = $request->token;
    $return0 = array();
    $endpoint = endpoint::where('enpointnombre', '=',  $ws)->get();
    foreach ($endpoint as $value) {
      $idreport = $value->masterreport;
      $nombre = $value->nombre;
      //$buscar = $value->ws;
      $buscandotoken = enpointnombre::where('id', '=',  $ws)->get();
      foreach ($buscandotoken as $valor) {
        $tokentabla = $valor->token;
        if ($tokentabla <> $token) {
          $error = array("error token" => "error de credenciales");
          return json_encode($error);
        }
      }
      $master = masterreport::where('id', $idreport)->get();
      foreach ($master as $value2) {
        $query = $value2->query;
        $dbexterna = $value2->base;
      }
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
