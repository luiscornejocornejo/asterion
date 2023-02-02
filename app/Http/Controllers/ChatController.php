<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\base;
use Illuminate\Support\Facades\DB;
use App\Models\masterreport;

class ChatController extends Controller
{
  //

  public function cambiarestado(Request $request)
  {

    $idticketestado = $request->idticketestado;
    $statos = $request->statos;
    $query = "update ost_ticket set status_id='" . $statos . "'   where ticket_id ='" . $idticketestado . "'";

    $aa = $this->conectar2(8);
    $actualizado = DB::connection('mysql2')->select($query);

    return redirect()
      ->back()
      ->with('success', 'Se modifico el status  correctamente!');
  }
  public function cambiartopic(Request $request)
  {

    $idticketestado = $request->idticketestado;
    $statos = $request->statos;
    $query = "update ost_ticket set topic_id='" . $statos . "'   where ticket_id ='" . $idticketestado . "'";

    $aa = $this->conectar2(8);
    $actualizado = DB::connection('mysql2')->select($query);

    return redirect()
      ->back()
      ->with('success', 'Se modifico el topic  correctamente!');
  }


  public function chatcreate(Request $request)
  {

   echo $idtickethistorial = $request->idtickethistorial;
   echo$notainterna = $request->notainterna;
    /*
    $query = "update ost_ticket set topic_id='" . $statos . "'   where ticket_id ='" . $idticketestado . "'";

    $aa = $this->conectar2(8);
    $actualizado = DB::connection('mysql2')->select($query);

    return redirect()
      ->back()
      ->with('success', 'Se modifico el topic  correctamente!');*/
  }
  
  public function cambiardepto(Request $request)
  {

    $idticketestado = $request->idticketestado;
    $statos = $request->statos;
    $query = "update ost_ticket set dept_id='" . $statos . "'   where ticket_id ='" . $idticketestado . "'";

    $aa = $this->conectar2(8);
    $actualizado = DB::connection('mysql2')->select($query);

    return redirect()
      ->back()
      ->with('success', 'Se modifico el depto  correctamente!');
  }
  public function index(Request $request)
  {

    $id = $request->id;
    $fields2 = $this->select2($id);
    $fields3 = $this->select2(77);
    $fields4 = $this->select2(78);
    $fields5 = $this->select2(79);
 
    return view('sienna/chat')
      ->with('estados', $fields3)
      ->with('deptos', $fields4)
      ->with('topics', $fields5)

      ->with('datos', $fields2);
  }


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
    echo   $host = $value->host;
    echo  $base = $value->base;
    echo  $usuario = $value->usuario;
    echo  $pass = $value->pass;
    echo  $port = $value->port;
    }
    config(['database.connections.mysql2.host' => $host]);
    config(['database.connections.mysql2.database' => $base]);
    config(['database.connections.mysql2.username' => $usuario]);
    config(['database.connections.mysql2.password' => $pass]);
    config(['database.connections.mysql2.port' => $port]);
  }
}
