<?php

namespace App\Http\Controllers;

use App\Models\masterreport;
use Illuminate\Http\Request;
use App\Models\servicio;
use App\Models\base;
use App\Models\tipoparametro;
use Illuminate\Support\Facades\DB;

use Webklex\PHPIMAP\ClientManager;
use Webklex\PHPIMAP\Client;
class siennaController extends Controller
{
  //

 
  public function pruebamail(){


    //$mailbox = new PhpImap\Mailbox('{imap.gmail.com:995/imap/ssl}INBOX', 'support@suricata.la', 'Castillo1366+', __DIR__);
    $cm = new ClientManager('/var/www/laravel/config/imap.php');

    // or use an array of options instead
   // $cm = new ClientManager($options = []);
    
    /** @var \Webklex\PHPIMAP\Client $client */
    //$client = $cm->account('account_identifier');
    
    // or create a new instance manually
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
       
       $cam=$this->crearsoporte($nya);
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
    
    //Get all Mailboxes
    /** @var \Webklex\PHPIMAP\Support\FolderCollection $folders */
  
  }
  public function pruebadatabase(){

    $query="show databases";

    $resultados = DB::select($query);

    $listadono=array ('mysql','information_schema','performance_schema','sys','defaultdb','telesmart','anterior','betured');
    foreach($resultados as $val){

      echo $val->Database;
      if (in_array($val->Database, $listadono)) {
          continue;
      }

      // ALTER TABLE amecom2.siennacliente ADD ip varchar(100) NULL;
     //  ALTER TABLE amecom2.siennacliente ADD nodo varchar(100) NULL;
       
    // 
    
      //    INSERT INTO ".$val->Database.".siennavariables ( variable, espanol, portugues, ingles, siennapaginas) VALUES( 'boton3', 'logeados', 'logado', 'logged in', 1);

    echo   $query1="
   
    ALTER TABLE ".$val->Database.".salientesxenniolistado ADD created_at DATETIME NULL;


    
    
        
      
    
    
        
          
      

    
   

    


  

    




 
 

    
         ";
      // $query1="";
         try {
            $resultados1 = DB::select($query1);
         }
         catch(\Illuminate\Database\QueryException$ex){
          echo "no".$ex;
         }

    }



  }
  public function principal()
  {
    $servicios = servicio::all();
    return view("sienna/principal")->with('servicios', $servicios);
  }

  //vista general
  public function servicio(Request $request)
  {
    $id = $request->servicio;
    $datos = masterreport::where('servicio', '=', $id)->get();
    $servicios = servicio::all();
    return view("sienna/principal")
      ->with('datos', $datos)
      ->with('servicios', $servicios)
      ->with('id', $id);
  }

  public function siennamenu(Request $request)
  {
    $id = $request->id;
    $datos = masterreport::where('servicio', '=', $id)->get();
    $servicios = servicio::all();
    return view("sienna/siennamenu")
      ->with('datos', $datos)
      ->with('servicios', $servicios)
      ->with('id', $id);
  }

  //create
  public function serviciocreate(Request $request)
  {

    $id = $request->id;
    $servicio = servicio::where('id', '=', $id)->get();
    $bases = base::all();
    $tipoparametro = tipoparametro::all();

    return view('sienna/serviciocreate')
      ->with('tipoparametro', $tipoparametro)
      ->with('bases', $bases)
      ->with('idservicio', $id)
      ->with('servicio', $servicio);
  }

  public function serviciocreatepost(Request $request)
  {

    $master = new masterreport();

    $master->query = $this->limpiar($request->query2);
    $master->base = $this->limpiar($request->base);
    $master->nombre = $this->limpiar($request->nombre);
    $master->descripcion = $this->limpiar($request->descripcion);
    $master->crear = $this->limpiar($request->crear);
    $master->modificar = $this->limpiar($request->modificar);
    $master->eliminar = $this->limpiar($request->eliminar);
    $master->tabla = $this->limpiar($request->tabla);
    $master->servicio = $this->limpiar($request->idservicio);
    $master->dashboard = $this->limpiar($request->dashboard);
    if ($request->parametrostodos <> "") {
      $todos = $request->parametrostodos;
      $todos2 = substr($todos, 1);
      $separar = explode("|", $todos2);
      $para = "";
      $tipos = "";

      foreach ($separar as $value) {

        $separar2 = explode(",", $value);
        $para = $para . "," . $separar2[0];
        $tipos = $tipos . "," . $separar2[1];
      }
      $para = substr($para, 1);
      $tipos = substr($tipos, 1);
      $master->parametros = $para;
      $master->parametrosTipo = $tipos;
    } else {
      $master->parametros = "";
      $master->parametrosTipo = "";
    }


    $master->save();
    return redirect()
      ->back()
      ->with('success', 'Se creo el registro  correctamente!');
  }


  //update


  public function siennamodificarput(Request $request)
  {

    $id = $request->id;
    $bases = base::all();
    $tipoparametro = tipoparametro::all();
    $report = masterreport::where('id', '=', $id)->get();

    return view('sienna/servicioupdate')
      ->with('tipoparametro', $tipoparametro)
      ->with('bases', $bases)
      ->with('idreport', $id)
      ->with('report', $report);
  }

  public function siennamodificarput2(Request $request)
  {

    //$master = new masterreport();
    $master = masterreport::find($request->idreport);

    //$master->id =$request->idreport;
    $master->query = $this->limpiar($request->query2);
    $master->base = $this->limpiar($request->base);
    $master->nombre = $this->limpiar($request->nombre);
    $master->descripcion = $this->limpiar($request->descripcion);
    $master->crear = $this->limpiar($request->crear);
    $master->modificar = $this->limpiar($request->modificar);
    $master->eliminar = $this->limpiar($request->eliminar);
    $master->tabla = $this->limpiar($request->tabla);
    // $master->servicio = $this->limpiar($request->idservicio);
    $master->dashboard = $this->limpiar($request->dashboard);
    if ($request->parametrostodos <> "") {
      $todos = $request->parametrostodos;
      $todos2 = substr($todos, 1);
      $separar = explode("|", $todos2);
      $para = "";
      $tipos = "";

      foreach ($separar as $value) {

        $separar2 = explode(",", $value);
        $para = $para . "," . $separar2[0];
        $tipos = $tipos . "," . $separar2[1];
      }
      $para = substr($para, 1);
      $tipos = substr($tipos, 1);
      $master->parametros = $para;
      $master->parametrosTipo = $tipos;
    } else {
      $master->parametros = "";
      $master->parametrosTipo = "";
    }


    $master->save();
    return redirect()
      ->back()
      ->with('success', 'Se creo actualizo  correctamente!');
  }


  //abm
  public function siennaabm(Request $request)
  {
    $idreport = $request->id;
    //$datosget = $this->select2($idreport);
    $datosget = $this->select3($idreport,$request);

    $cabezeras = $this->cabezerasgraficos($datosget);
    $master = masterreport::find($idreport);
    $nombrereporte = $master->nombre;

    $registro = $this->extra($master->tabla, $master->base);

    return view('sienna/abm')->with('cabezeras', $cabezeras)
      ->with('resultados', $datosget)
      ->with('master', $master)
      ->with('nombrereporte', $nombrereporte)
      ->with('registro', $registro)
      ->with('idreport', $idreport);
  }

  public function siennacreate(Request $request)
  {
    $idreport = $request->report;
    $master = masterreport::find($idreport);
    //dd($master);
    $table = $master->tabla;
    $dbexterna = $master->base;

    $query = "SHOW FIELDS FROM " . $table;
    if ($dbexterna == 1) {
      $resultados = DB::select($query);
    } else {
      $prueba = $this->conectar($dbexterna);

      //si es distinta a 1 aa otra base
      $resultados = DB::connection('mysql2')->select($query);
    }
    $Fieldarray = array();
    $Typearray = array();
    $Nullarray = array();

    foreach ($resultados as $key => $value) {
      foreach ($value as $key2 => $value2) {


        if ($key2 == "Field") {
          array_push($Fieldarray, $value2);
        }
        if ($key2 == "Type") {
          array_push($Typearray, $value2);
        }
        if ($key2 == "Null") {
          array_push($Nullarray, $value2);
        }
      }
    }
    $link = "";
    return view('sienna/siennacreate')
      ->with('Nullarray', $Nullarray)
      ->with('Typearray', $Typearray)
      ->with('link', $link)
      ->with('table', $table)
      ->with('base', $dbexterna)
      ->with('Fieldarray', $Fieldarray)
      ->with('tablaa', $table);
  }

  public function siennacreatepost(Request $request)
  {

    $table = $request->table;
    $deexternareport = $request->deexternareport;

    $campos = "";
    $valores = "";
var_dump($request); die;
    foreach ($request as $key => $value) {

      if ($key == "request") {
        foreach ($value as $key2 => $value2) {

          //print($key2);
          if (($key2 <> "_token") and ($key2 <> "table") and ($key2 <> "deexternareport")) {
            //print($key2);
            $campos .= $key2 . ",";
            //print("<br>");

            //print($value2);
            
            if (is_array($value2)) {
              $vstr = "";
              foreach($value2 as $k => $v){
                $vstr .= $v.",";
              }
              $value2 = rtrim($vstr, ",");
            }

            if ($value2 == "on") {
              $value2 = "1";
            }
            if ($value2 == "off") {
              $value2 = "0";
            }
            if ($key2 == "logo") {
              echo $path = $request->file('logo')->store('public');
              $value2 = $path;
            }
            if ($key2 == "password") {
              $valores .= "md5('" . $value2 . "'),";
            } else {
              $valores .= "'" . $value2 . "',";
            }
            //print("<br>");
          }
        }
      }
      if ($key == "files") {
        foreach ($value as $key2 => $value2) {

          if ($key2 == "logo") {

            echo $path = $request->file('logo')->store('public');
            // $request->file('logo')->move(public_path(''), $filename);

            $value2 = $path;
            $campos .= $key2 . ",";
            $valores .= "'" . $value2 . "',";
          }
        }
      }
    }
    $campos = substr($campos, 0, -1);
    $valores = substr($valores, 0, -1);
    // $empre = session('idempresa');
    echo  $dato = "insert into " . $table . " (" . $campos . ") values (" . $valores . ")";


    if ($deexternareport == 1) {
      $resultados = DB::select($dato);
    } else {
      $prueba = $this->conectar($deexternareport);

      //si es distinta a 1 aa otra base
      $resultados = DB::connection('mysql2')->select($dato);
    }
    return redirect()
      ->back()
      ->with('success', 'Se creo el registro  correctamente!');
  }


  public function siennaabmmodificar(Request $request)
  {

    $idregisstro = $request->registro;
    $idreport = $request->idreport;
    $pk = $request->pk;
    $master = masterreport::find($idreport);
    $table = $master->tabla;
    $nombrereporte = $master->nombre;
    $dbexterna = $master->base;
    $queryupdate = "select * from " . $table . " where " . $pk . "=" . $idregisstro . "";
    $query = "SHOW FIELDS FROM " . $table;


    if ($dbexterna == 1) {
      $resultadosupdate = DB::select($queryupdate);
      $resultados = DB::select($query);
    } else {
      $prueba = $this->conectar($dbexterna);
      $resultadosupdate = DB::connection('mysql2')->select($queryupdate);
      $resultados = DB::connection('mysql2')->select($query);
    }

    $Fieldarray = array();
    $Typearray = array();
    $Nullarray = array();
    $Extraarray = array();
    foreach ($resultados as $key => $value) {
      foreach ($value as $key2 => $value2) {
        if ($key2 == "Field") {
          array_push($Fieldarray, $value2);
        }
        if ($key2 == "Type") {
          array_push($Typearray, $value2);
        }
        if ($key2 == "Null") {
          array_push($Nullarray, $value2);
        }
        if ($key2 == "Extra") {
          array_push($Extraarray, $value2);
        }
      }
    }

    return view('sienna/abmmodificar')
      ->with('Nullarray', $Nullarray)
      ->with('Typearray', $Typearray)
      ->with('Fieldarray', $Fieldarray)
      ->with('data', $resultadosupdate)
      ->with('extra', $Extraarray)
      ->with('pk', $pk)
      ->with('base', $dbexterna)
      ->with('nombrereporte', $nombrereporte)
      ->with('tablaa', $table);
  }

  public function siennaabmmodificarpost(Request $request)
  {

    $registro = $request->registro;
    $idreport = $request->idreport;
    $pk = $request->pk;
    $master = masterreport::find($idreport);
    //dd($master);
    $table = $master->tabla;
    $dbexterna = $master->base;

    $campos = "";
    $valores = "";
    foreach ($request as $key => $value) {

      if ($key == "request") {
        foreach ($value as $key2 => $value2) {

          if ($key2 <> "_token") {

            if (is_array($value2)) {
              $vstr = "";
              foreach($value2 as $k => $v){
                $vstr .= $v.",";
              }
              $value2 = rtrim($vstr, ",");
            }

            if ($value2 == "on") {
              $value2 = "1";
            }
            if ($value2 == "off") {
              $value2 = "0";
            }

            if ($key2 == "password") {
              if ($value2 <> "") {
                $campos .= $key2 . "=md5('" . $value2 . "'),";
              }
            } else {
              $campos .= $key2 . "='" . $value2 . "',";
            }
          }
        }
      }
      if ($key == "files") {
        foreach ($value as $key2 => $value2) {
          if ($key2 == "logo") {
            $path = $request->file('logo')->store('public');
            //dd($path);
            $value2 = $path;
            $campos .= $key2 . "='" . $value2 . "',";
            $valores .= "'" . $path . "',";
          }
        }
      }
    }
    $campos = substr($campos, 0, -1);


    $dato = "update " . $table . " set  " . $campos . "   where " . $pk . "='" . $registro . "'";
    // $resultadosupdate = DB::select($dato);
    if ($dbexterna == 1) {
      $resultados = DB::select($dato);
    } else {
      $prueba = $this->conectar($dbexterna);

      //si es distinta a 1 aa otra base
      $resultados = DB::connection('mysql2')->select($dato);
    }

    return redirect()
      ->back()
      ->with('success', 'Se Modifico el registro  correctamente!');
  }
  //graficos

  public function siennagraficos(Request $request)
  {

    $idgrafico = $request->id;
    return view('sienna/graficosform')->with('idgrafico', $idgrafico);
  }

  public function siennagraficospost(Request $request)
  {

    $idgrafico = $request->id;
    $graficos = $request->graficos;
    $datosget = $this->select2($idgrafico);
    $cabezeras = $this->cabezerasgraficos($datosget);


    return view('sienna/graficosform')->with('cabezeras', $cabezeras)
      ->with('datosget', $datosget)
      ->with('graficos', $graficos)
      ->with('idgrafico', $idgrafico);
  }


  //general

  function delete(Request $request)
  {


    $idregistro = $request->idregistro;
    $tabla = $request->tabla;
    $dbexterna = $request->dbexterna;
    $pk = $request->pk;

    $query = "delete from " . $tabla . " where " . $pk . "='" . $idregistro . "'";
    if ($dbexterna == 1) {

      $resultados = DB::select($query);
    } else {
      $prueba = $this->conectar($dbexterna);
      $resultadosfields = DB::connection('mysql2')->select($query);
    }

    return redirect()
      ->back()
      ->with('success', 'Se borro el registro  correctamente!');
  }
  function extra($tabla, $dbexterna)
  {


    $query = "SHOW FIELDS FROM " . $tabla . "  where Extra='auto_increment' ";
    if ($dbexterna == 1) {
      $resultadosfields = DB::select($query);
    } else {
      $prueba = $this->conectar($dbexterna);
      $resultadosfields = DB::connection('mysql2')->select($query);
    }

    $buscado = "";
    foreach ($resultadosfields as $value) {
      $buscado = $value->Field;
    }
    return $buscado;
  }
  function select2($id)
  {

    $resultados = masterreport::where('id', '=', $id)->get();
    foreach ($resultados as  $valuep) {
      $query2 = $valuep->query;
      $dbexterna = $valuep->base;
      $parametros = $valuep->parametros;

    }
    
    if ($dbexterna == 1) {
      $fields2 = DB::select($query2);
    } else {

      $prueba = $this->conectar($dbexterna);

      //si es distinta a 1 aa otra base
      $fields2 = DB::connection('mysql2')->select($query2);
    }
    return $fields2;
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

      $vueltas=explode(",",$parametros);
      $array=array("manuelita");
      $query2=$query;

      foreach($vueltas as $valuevuelta){


         $nombredelcampo = $valuevuelta;
         $valordelcampo = $request->$nombredelcampo;

         $clave = "@" . $nombredelcampo;

       try {
 
        // Hacemos algo
              if(in_array($nombredelcampo,$array)){
              }else{
                $query2 = str_replace($clave, $valordelcampo, $query2);
              array_push($array, $nombredelcampo);


              }
    
          } catch (\Throwable $e) {
          
              // Podemos hacer algo aquí si ocurre una excepción
          
          } 

      


      }
      return $query2;

      //varios parametros
    }

    return $query;
  }
  function select3($id, $request)
  {

    $resultados = masterreport::where('id', '=', $id)->get();
    foreach ($resultados as  $valuep) {
      $query2 = $valuep->query;
      $dbexterna = $valuep->base;
      $parametros = $valuep->parametros;
    }
    $query2 = $this->cambiarquery($parametros, $request, $query2);

    if ($dbexterna == 1) {
      $fields2 = DB::select($query2);
    } else {

      $prueba = $this->conectar($dbexterna);

      //si es distinta a 1 aa otra base
      $fields2 = DB::connection('mysql2')->select($query2);
    }
    return $fields2;
  }
  function cabezerasgraficos($datos)
  {

    $thearray = (array) $datos;
    $return = array();

    foreach ($thearray as $key => $value) {

      foreach ($value as $key2 => $value2) {

        array_push($return, $key2);
      }
    }
    $return = array_unique($return);

    return $return;
  }

  public function conectar($id)
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
    config(['database.connections.mysql2.port' => $port]);

    config(['database.connections.mysql2.database' => $base]);
    config(['database.connections.mysql2.username' => $usuario]);
    config(['database.connections.mysql2.password' => $pass]);
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
  private function limpiar($query)
  {
    $query = strtolower($query);
    $healthy = array("drop", "truncate", "insert", "  opdate ");
    $yummy   = array("", "", "", "");

    $query = str_replace($healthy, $yummy, $query);

    return $query;
  }

  //endpoint
  public function siennaendpoint(Request $request)
  {

    $idendpoint = $request->id;
    $datosget = $this->select2($idendpoint);
    $array = array("datos" => $datosget);
    $return2 = json_encode($array);
    return view('sienna/endpoint')
      ->with('datosget', $return2);
  }


  public function endpointentrantes(Request $request)
  {

    echo $idcliente = $request->idcliente;

    $query = "";
  }

  //email
  public function siennaemail(Request $request)
  {
    $idemail = $request->id;
    $datosget = $this->select2($idemail);
    $cabezeras = $this->cabezerasgraficos($datosget);


    return view('sienna/email')->with('cabezeras', $cabezeras)
      ->with('datosget', $datosget)
      ->with('idemail', $idemail);
  }

  //report

  public function siennareport(Request $request)
  {

  

$idreport = $request->id;
$master = masterreport::where('id', $idreport)->get();
foreach ($master as $value2) {
    $nombrereporte = $value2->nombre;
}
$datosget = $this->select3($idreport,$request);
$cabezeras = $this->cabezerasgraficos($datosget);

    return view('sienna/report')->with('cabezeras', $cabezeras)
      ->with('resultados', $datosget)
      ->with('nombrereporte', $nombrereporte)

      ->with('idreport', $idreport);
  }

  //form



  public function ticketsienna(Request $request)
  {
    $id = $request->id;
    $resultados = masterreport::where('id', '=', $id)->get();
    $return = array();
    foreach ($resultados as $value) {


      $pos3 = stripos($value->parametros, ",");
      if ($pos3 !== false) {
        $parametros = explode(",", $value->parametros);
        $parametrosTipo = explode(",", $value->parametrosTipo);

        for ($i = 0; $i < sizeof($parametros); $i++) {
          $tipopara = tipoparametro::find($parametrosTipo[$i]); //('id', '=', $id)->get();

          array_push($return, array($parametros[$i] => $tipopara->nombre));
        }
      } else {
        $tipopara = tipoparametro::find($value->parametrosTipo); //('id', '=', $id)->get();

        array_push($return, array($value->parametros => $tipopara->nombre));
      }
    }

    return view('sienna/ticketsienna')
      ->with('id', $id)
      ->with('vista', "0")

      ->with('resultados', $return);
  }
  public function ticketsiennapost(Request $request)
  {
    $id = $request->id;
    $resultados = masterreport::find($id);

    $queryoriginal = $resultados->query;
    $dbexterna = $resultados->base;

    $pos3 = stripos($resultados->parametros, ",");
    if ($pos3 !== false) {

      $separado = explode(",", $resultados->parametros);
      for ($i = 0; $i < sizeof($separado); $i++) {

        $variable = "@" . $separado[$i];
        $variable2 = $separado[$i];

        $valor = $request->$variable2;


        $queryoriginal = str_replace($variable, $valor, $queryoriginal);
      }
    } else {

      $variable = "@" . $resultados->parametros;

      $variable2 = $resultados->parametros;

      $valor = $request->$variable2;
      $queryoriginal = str_replace($variable, $valor, $queryoriginal);
    }

    //echo $queryoriginal;
    if ($dbexterna == 1) {
      $resultados = DB::select($queryoriginal);
    } else {
      $prueba = $this->conectar($dbexterna);

      //si es distinta a 1 aa otra base
      $resultados = DB::connection('mysql2')->select($queryoriginal);
    }

    //  var_export($resultados);
    $cabezeras = $this->cabezerasgraficos($resultados);





    $return = $this->siennaform2($id);


        
    $querydatos = "select * from t_staff";
    $t_staff = DB::select($querydatos);
    $querydatos = "select * from t_departamentos";
    $t_departamentos = DB::select($querydatos);
    $querydatos = "select * from t_topic";
    $t_topic = DB::select($querydatos);
    $querydatos = "select * from t_estado";
    $t_estado = DB::select($querydatos);

   echo  $querydatos = "select a.created_at as timestamp,ts.nombre as username,a.t_estado as name from t_bitacora a
    join t_staff ts on ts.id=a.t_staff 
    where a.t_tickets =" . $valor . "";
    $t_bitacora = DB::select($querydatos);



    if(sizeof($resultados)>0){
      
      $vista=1;}
      
      else {$vista=0;}
    return view('sienna/ticketsienna')
      ->with('id', $id)
      ->with('vista', $vista)
      ->with('datos', $resultados)
      ->with('t_staff', $t_staff)
      ->with('t_departamentos', $t_departamentos)
      ->with('t_topic', $t_topic)
      ->with('t_estado', $t_estado)
      ->with('t_bitacora', $t_bitacora)

      

      

      ->with('cabezeras', $cabezeras)
      ->with('resultados', $return);
  }

  public function siennaform(Request $request)
  {
    $id = $request->id;
    $resultados = masterreport::where('id', '=', $id)->get();
    $return = array();
    foreach ($resultados as $value) {


      $nombrereporte=$value->nombre;
      $descripcion=$value->descripcion;
      $pos3 = stripos($value->parametros, ",");
      if ($pos3 !== false) {
        $parametros = explode(",", $value->parametros);
        $parametrosTipo = explode(",", $value->parametrosTipo);

        for ($i = 0; $i < sizeof($parametros); $i++) {
          $tipopara = tipoparametro::find($parametrosTipo[$i]); //('id', '=', $id)->get();

          array_push($return, array($parametros[$i] => $tipopara->nombre));
        }
      } else {
        $tipopara = tipoparametro::find($value->parametrosTipo); //('id', '=', $id)->get();

        array_push($return, array($value->parametros => $tipopara->nombre));
      }
    }

    return view('sienna/form')
    ->with('id', $id)
    ->with('nombrereporte', $nombrereporte)
    ->with('descripcion', $descripcion)
    ->with('vista', "0")

      ->with('resultados', $return);
  }



  

  public function siennaform2($id)
  {
    $resultados = masterreport::where('id', '=', $id)->get();
    $return = array();
    foreach ($resultados as $value) {


      $pos3 = stripos($value->parametros, ",");
      if ($pos3 !== false) {
        $parametros = explode(",", $value->parametros);
        $parametrosTipo = explode(",", $value->parametrosTipo);

        for ($i = 0; $i < sizeof($parametros); $i++) {
          $tipopara = tipoparametro::find($parametrosTipo[$i]); //('id', '=', $id)->get();

          array_push($return, array($parametros[$i] => $tipopara->nombre));
        }
      } else {
        $tipopara = tipoparametro::find($value->parametrosTipo); //('id', '=', $id)->get();

        array_push($return, array($value->parametros => $tipopara->nombre));
      }
    }

    return  $return;
  }

  public function siennaformpost(Request $request)
  {
    $id = $request->id;
    $resultados = masterreport::find($id);

    $queryoriginal = $resultados->query;
    $dbexterna = $resultados->base;
    $nombrereporte=$resultados->nombre;
    $descripcion=$resultados->descripcion;
    $pos3 = stripos($resultados->parametros, ",");
    if ($pos3 !== false) {

      $separado = explode(",", $resultados->parametros);
      for ($i = 0; $i < sizeof($separado); $i++) {

        $variable = "@" . $separado[$i];
        $variable2 = $separado[$i];

        $valor = $request->$variable2;


        $queryoriginal = str_replace($variable, $valor, $queryoriginal);
      }
    } else {

      $variable = "@" . $resultados->parametros;

      $variable2 = $resultados->parametros;

      $valor = $request->$variable2;
      $queryoriginal = str_replace($variable, $valor, $queryoriginal);
    }

    //echo $queryoriginal;
    if ($dbexterna == 1) {
      $resultados = DB::select($queryoriginal);
    } else {
      $prueba = $this->conectar($dbexterna);

      //si es distinta a 1 aa otra base
      $resultados = DB::connection('mysql2')->select($queryoriginal);
    }

    //  var_export($resultados);
    $cabezeras = $this->cabezerasgraficos($resultados);

    $return = $this->siennaform2($id);
    return view('sienna/form')
      ->with('id', $id)
      ->with('vista', "1")
      ->with('nombrereporte', $nombrereporte)
    ->with('descripcion', $descripcion)
      ->with('datos', $resultados)
      ->with('cabezeras', $cabezeras)
      ->with('resultados', $return);
  }

  public function siennaformg(Request $request)
  {
    $id = $request->id;
    $resultados = masterreport::where('id', '=', $id)->get();
    $return = array();
    foreach ($resultados as $value) {


      $pos3 = stripos($value->parametros, ",");
      if ($pos3 !== false) {
        $parametros = explode(",", $value->parametros);
        $parametrosTipo = explode(",", $value->parametrosTipo);

        for ($i = 0; $i < sizeof($parametros); $i++) {
          $tipopara = tipoparametro::find($parametrosTipo[$i]); //('id', '=', $id)->get();

          array_push($return, array($parametros[$i] => $tipopara->nombre));
        }
      } else {
        $tipopara = tipoparametro::find($value->parametrosTipo); //('id', '=', $id)->get();

        array_push($return, array($value->parametros => $tipopara->nombre));
      }
    }

    return view('sienna/formg')
      ->with('id', $id)
      ->with('vista', "0")

      ->with('resultados', $return);
  }

  public function siennaformgpost(Request $request)
  {
    $id = $request->id;
    $resultados = masterreport::find($id);

    $queryoriginal = $resultados->query;
    $dbexterna = $resultados->base;

    $pos3 = stripos($resultados->parametros, ",");
    if ($pos3 !== false) {

      $separado = explode(",", $resultados->parametros);
      for ($i = 0; $i < sizeof($separado); $i++) {

        $variable = "@" . $separado[$i];
        $variable2 = $separado[$i];

        $valor = $request->$variable2;


        $queryoriginal = str_replace($variable, $valor, $queryoriginal);
      }
    } else {

      $variable = "@" . $resultados->parametros;

      $variable2 = $resultados->parametros;

      $valor = $request->$variable2;
      $queryoriginal = str_replace($variable, $valor, $queryoriginal);
    }

    //echo $queryoriginal;
    if ($dbexterna == 1) {
      $resultados = DB::select($queryoriginal);
    } else {
      $prueba = $this->conectar($dbexterna);

      //si es distinta a 1 aa otra base
      $resultados = DB::connection('mysql2')->select($queryoriginal);
    }

    //  var_export($resultados);
    $cabezeras = $this->cabezerasgraficos($resultados);

    $return = $this->siennaform2($id);
    return view('sienna/formg')
      ->with('id', $id)
      ->with('vista', "1")
      ->with('datos', $resultados)
      ->with('cabezeras', $cabezeras)
      ->with('resultados', $return);
  }

  public function siennaforme(Request $request)
  {
    $id = $request->id;
    $resultados = masterreport::where('id', '=', $id)->get();
    $return = array();
    foreach ($resultados as $value) {


      $pos3 = stripos($value->parametros, ",");
      if ($pos3 !== false) {
        $parametros = explode(",", $value->parametros);
        $parametrosTipo = explode(",", $value->parametrosTipo);

        for ($i = 0; $i < sizeof($parametros); $i++) {
          $tipopara = tipoparametro::find($parametrosTipo[$i]); //('id', '=', $id)->get();

          array_push($return, array($parametros[$i] => $tipopara->nombre));
        }
      } else {
        $tipopara = tipoparametro::find($value->parametrosTipo); //('id', '=', $id)->get();

        array_push($return, array($value->parametros => $tipopara->nombre));
      }
    }

    return view('sienna/forme')
      ->with('id', $id)
      ->with('vista', "0")

      ->with('resultados', $return);
  }


  public function siennaformepost(Request $request)
  {
    $id = $request->id;
    $resultados = masterreport::find($id);

    $queryoriginal = $resultados->query;
    $dbexterna = $resultados->base;

    $pos3 = stripos($resultados->parametros, ",");
    if ($pos3 !== false) {

      $separado = explode(",", $resultados->parametros);
      for ($i = 0; $i < sizeof($separado); $i++) {

        $variable = "@" . $separado[$i];
        $variable2 = $separado[$i];

        $valor = $request->$variable2;


        $queryoriginal = str_replace($variable, $valor, $queryoriginal);
      }
    } else {

      $variable = "@" . $resultados->parametros;

      $variable2 = $resultados->parametros;

      $valor = $request->$variable2;
      $queryoriginal = str_replace($variable, $valor, $queryoriginal);
    }

    //echo $queryoriginal;
    if ($dbexterna == 1) {
      $resultados = DB::select($queryoriginal);
    } else {
      $prueba = $this->conectar($dbexterna);

      //si es distinta a 1 aa otra base
      $resultados = DB::connection('mysql2')->select($queryoriginal);
    }

    //  var_export($resultados);
    $cabezeras = $this->cabezerasgraficos($resultados);

    $return = $this->siennaform2($id);
    $array = array("datos" => $resultados);
    $return2 = json_encode($array);
    return view('sienna/forme')
      ->with('id', $id)
      ->with('vista', "1")
      ->with('resultados', $return)
      ->with('datos2', $return2);
  }

  

  //end class
}
