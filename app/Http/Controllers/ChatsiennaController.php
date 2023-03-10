<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\base;
use Illuminate\Support\Facades\DB;
use App\Models\masterreport;

use App\Models\t_bitacora;
use App\Models\t_staff;



class ChatsiennaController extends Controller
{
  //

  public function cambiarestado(Request $request)
  {

    $idticketestado = $request->idticketestado;
    $statos = $request->statos;
    $query = "update ost_ticket set status_id='" . $statos . "'   where ticket_id ='" . $idticketestado . "'";

    $aa = $this->conectar2(11);
    $actualizado = DB::connection('mysql2')->select($query);

    return redirect()
      ->back()
      ->with('success', 'Se modifico el status  correctamente!');
  }
  public function cambiartopic2(Request $request)
  {

    $idticketestado = $request->idticketestado;
    $statos = $request->statos;
     $query = "update t_tickets set t_topic='" . $statos . "'   where id ='" . $idticketestado . "'";

     $fields55 = DB::select($query);
     $this->bitacoracreate("cambio de topic",$idticketestado);
    return redirect()
      ->back()
      ->with('success', 'Se modifico el topic  correctamente!');
  }


  public function cambiardepto2(Request $request)
  {

    $idticketestado = $request->idticketestado;
    $statos = $request->statos;
     $query = "update t_tickets set t_departamentos='" . $statos . "'   where id ='" . $idticketestado . "'";

     $fields55 = DB::select($query);

    return redirect()
      ->back()
      ->with('success', 'Se modifico el depto  correctamente!');
  }

  public function bitacoracreate($estado,$ticket)
  {

    $userid=session('idusuario');
    $datoreporte = t_staff::where('user', '=', $userid)->get();
               
                foreach ($datoreporte as $value2) {
                     $staff = $value2->id;
                  
                }
    $query = "INSERT INTO t_bitacora (t_estado, t_staff, t_tickets, fecha) VALUES(".$estado.", ".$staff.", ".$ticket.", 'now()')";

      $fields55 = DB::select($query);

  }
  


  public function asignar(Request $request)
  {

    $idticketestado = $request->idticketestado;
    $statos = $request->statos;
    $query = "update ost_ticket set staff_id='" . $statos . "'   where ticket_id ='" . $idticketestado . "'";

    $aa = $this->conectar2(11);
    $actualizado = DB::connection('mysql2')->select($query);

    return redirect()
      ->back()
      ->with('success', 'Se modifico el depto  correctamente!');
  }
  public function index(Request $request)
  {

     $id = $request->id;
    $fields2 = $this->select2($id);
   return view('sienna/chatsienna')
      ->with('datos', $fields2);
  }


  function select2($id)
  {

    $resultados = masterreport::where('id', '=', $id)->get();
    foreach ($resultados as  $valuep) {
      $query2 = $valuep->query;
      $dbexterna = $valuep->base;
      $parametros = $valuep->parametros;
    }
   
    if($parametros=="logeo"){

      $valordelcampo = session('email');
      $clave = "@" . $parametros;
      $query2 = str_replace($clave, $valordelcampo, $query2);
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
      if($nombredelcampo=="logeo"){

        $valordelcampo = session('email');
        $clave = "@" . $nombredelcampo;
        $query2 = str_replace($clave, $valordelcampo, $query);
      }
      return $query2;
    } else {
      //varios parametros
    }

    return $query;
  }
}
