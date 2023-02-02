<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\masterreport;
use App\Models\base;
use App\Models\enpointnombre;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;

class ticketController extends Controller
{


  public function principal($ticketid)
  {
    $body3 = '';
    $query44 = "select b.name,a.username,a.timestamp,a.data from ost_thread_event a 
        left join ost_event b on b.id=a.event_id
        where a.thread_id=(select id from ost_thread where object_id=" . $ticketid . ")
        order by a.id asc";
    $fields3 = $this->conectar2(8);
    $fields44 = DB::reconnect('mysql2')->select($query44);
    foreach ($fields44 as $valor) {
 
      $fe=$this->fecha($valor->timestamp);
      $body3 .=  '<li class="clearfix">
      <div class="chat-avatar">
         
          <i>' . $fe . '</i>
      </div>
      <div class="conversation-text">
          <div class="ctext-wrap">
              <i>' . $valor->name . '</i>
              <p>
              ' . $valor->username . '
              </p>
          </div>
      </div>
  
  </li>';
   }


    $querydatos = "select a.source,f.chat_link from ost_ticket a 
        left join   ost_ticket__cdata f
        on f.ticket_id=a.ticket_id

        where a.ticket_id=" . $ticketid;
    $fields55 = DB::reconnect('mysql2')->select($querydatos);
    foreach ($fields55 as $valor) {
      $source = $valor->source;
      $chat_link = $valor->chat_link;
    }
    if ($source == "Email") {
      $query66 = "SELECT body FROM ost_thread_entry WHERE thread_id= (SELECT id FROM ost_thread where object_id=" . $ticketid . ")";
      $fields66 = DB::reconnect('mysql2')->select($query66);
      $bosymail = "";
      foreach ($fields66 as $value66) {
        $bosymail .= $value66->body;
      }
      $body3 .= "ratonplasticosincolor<div style='height:1200px;width:500px;'>" . $bosymail . "</div>";
    } else {

      $body3 .= "ratonplasticosincolor<div style='height:1200px;width:700px;'><iframe style='height:1200px;width: 700px;' frameborder='0' allowfullscreen src=" . $chat_link . "><iframe></div>";
    }


    return $body3; //json_encode($arraydedatos);

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

  public function fecha($date){
    $initdate = new DateTime($date);
    $diffdate = $initdate->diff(new DateTime());
  
    if($diffdate->d < 1){
      if($diffdate->h < 1)
        return 'Hace '.$diffdate->i.' minuto(s)';
      else
      return 'Hace '.$diffdate->h.' hora(s)';
    }
    else if($diffdate->d < 2){
      if($diffdate->h < 23){
        $fdate = DateTime::createFromFormat("Y-m-d H:i:s", $date);
        $hrs = $fdate->format('H:i');
        return 'Ayer a las '.$hrs;	
      }
      else{
        return 'Hace '.$diffdate->h.' hora(s)';
      }
    }
    else{
      $fdate = DateTime::createFromFormat("Y-m-d H:i:s", $date);
      $dt = $fdate->format('d-m-Y H:i');
      return $dt;		
    }



  }
  public function listadetickets()
  {

    $query="select chat_status,ticket_id from ost_ticket__cdata where ticket_id in(select ticket_id from ost_ticket where status_id<>3)";
   $fields3 = $this->conectar2(8);
    $fields44 = DB::reconnect('mysql2')->select($query);
    $return="";
    foreach ($fields44 as $value) {

      $chat=$value->chat_status;
      if($chat==0){
          $return.=$value->ticket_id.",green|";
      }elseif($chat=="1"){
        $return.=$value->ticket_id.",red|";
      }else{
        $return.=$value->ticket_id.",white|";
      }
    }

    return $return;

  }
  
  public function count($count)
  {

    $query55 = "select count(*) as cuantos from ost_ticket where status_id<>3";
    $fields3 = $this->conectar2(8);

    $fields44 = DB::reconnect('mysql2')->select($query55);
    foreach ($fields44 as $value) {

      $cuantos = $value->cuantos;
    }
    if ($cuantos > $count) {

      $dife = $cuantos - $count;
      $alert = '<div class="alert alert-success alert-dismissible fade
                            show" role="alert">
            
            <button cllass="btn btn-success" onClick="window.location.reload();">tienes ' . $dife . ' ticket nuevos</button>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
      return $alert;

      $id = 75;
      $resultados = masterreport::where('id', '=', $id)->get();
      foreach ($resultados as  $valuep) {
        $query2 = $valuep->query;
        $dbexterna = $valuep->base;
        $parametros = $valuep->parametros;
      }
      if ($dbexterna == 1) {
        $fields2 = DB::select($query2);
      } else {

        $prueba = $this->conectar2($dbexterna);

        //si es distinta a 1 aa otra base
        $fields2 = DB::reconnect('mysql2')->select($query2);
      }

      //aca

      $regreso = "";
      foreach ($fields2 as $value) {


        $regreso .= ' <li class="unread">
              <a>
                  <div class="d-flex align-items-start">
                      <div class="flex-shrink-0 user-img online align-self-center me-3">
                          <div class="avatar-sm align-self-center">

                              <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                  <input type="checkbox" name="listado[]" value="' . $value->ticket_id . '">
                              </span>
                          </div>
                          <span class="user-status"></span>
                      </div>';

        $regreso .= "  <div class=flex-grow-1 overflow-hidden onClick=datos('" . $value->depto . "','" . $value->nombreusuario . "','" . $value->topic . "','" . $value->status_id . "','" . $value->source . "','" . $value->ticket_id . ")>
                          <h5 class=text-truncate font-size-14 mb-1>" . $value->topic . "</h5>
                          <p class=text-truncate mb-0>" . $value->nombreusuario . "</p>
                          <p class=text-truncate mb-0>" . $value->number . "</p>

                      </div>

                      <div class=flex-shrink-0>
                          <div class=font-size-11>
                              <p class=text-truncate mb-0>" . $value->lastupdate . "</p>

                              <br>
                              <p class=text-truncate mb-0>Asignado a:</p>

                              <p class=text-truncate mb-0>" . $value->depto . $value->depto . "</p>
                          </div>
                      </div>

                  </div>
              </a>
          </li>";
      }

      //alla
      return $regreso;
    }
    return $count;
  }
}
