<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscripcion;
use App\Eve;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\PDO;
use Redirect;
use Flash;
use phpDocumentor\Reflection\PseudoTypes\False_;
use Illuminate\Support\File;




class CevicheController extends Controller
{



  public function delete(Request $request)

  {
    $idregistro = $request->idregistro;
    $tabla = $request->tabla;
    echo $query = "delete from " . $tabla . " where id='" . $idregistro . "'";
    $resultados = DB::select($query);

    return redirect()
      ->back()
      ->with('success', 'Se borro el registro  correctamente!');
  }
  public function borrarevento(Request $request)

  {
    //var_dump($request);

    $idregistro = $request->genero;
    var_dump($idregistro);
    echo $tabla = $request->tabla;
    foreach ($idregistro as $selected) {

      echo $selected . "</br>"; // Imprime resultados
      $query = "delete from " . $tabla . " where id='" . $selected . "'";
      $resultados = DB::select($query);
    }

    // $query = "delete from " . $tabla . " where id='" . $idregistro . "'";
    // $resultados = DB::select($query);
    return redirect()
      ->back()
      ->with('success', 'Se borro el registro  correctamente!');
  }
  public function principal()

  {
    $query = "select * from masterreport";
    $resultados = DB::select($query);

    return view('sienna/ceviche')->with('resultados', $resultados);
  }

  public function tienepermisos(Request $request)

  {
    $idmasterreport = $request->id;
    $idusuario =  session('idusuario');
    //dd($idmasterreport);
    echo $query = "SELECT count(*) as cuantos FROM permisos_ceviche 
       where idreporte='" . $idmasterreport . "'  and idusuario='" . $idusuario . "'";
    $resultados = DB::select($query);
    $tiene = 0;
    foreach ($resultados as $resultado) {
      $tiene = $resultado->cuantos;
    }
    if ($tiene == 0) {
      return view('frame/ceviche_permisos_no');
    } else {
      return true;
    }
  }
  public function permisos(Request $request)

  {
    $idmasterreport = $request->id;

    //dd($idmasterreport);
    $query = "SELECT b.name,b.last_name,a.id FROM permisos_ceviche a
      join users b on
      b.id=a.idusuario
       where a.idreporte='" . $idmasterreport . "'";
    $resultados = DB::select($query);
    return view('frame/ceviche_permisos')
      ->with('idmasterreport', $idmasterreport)
      ->with('resultados', $resultados);
  }

  public function permisosnuevocrear(Request $request)

  {

    $listadeusuarios = $request->usuarios;
    $idmasterreport = $request->idmaster;
    foreach ($listadeusuarios as $value) {


      $query = "insert into permisos_ceviche (idusuario,idreporte) values (" . $value . "," . $idmasterreport . ")";

      $resultados = DB::select($query);
    }

    return redirect()
      ->back()
      ->with('success', 'Se asigno el reporte a los usuarios correctamente!');
  }
  public function permisosnuevo(Request $request)

  {
    $idmasterreport = $request->id;

    //dd($idmasterreport);
    $query = "select * from users where id not in (select idusuario from permisos_ceviche where  idreporte='" . $idmasterreport . "' ) ";
    $resultados = DB::select($query);
    return view('frame/ceviche_permisosnuevo')
      ->with('idmasterreport', $idmasterreport)
      ->with('resultados', $resultados);
  }

  public function empresa($query)
  {

    $query = strtolower($query);
    $buscartabla = "from";
    $separar = explode("from", $query);
    $separar2 = explode(" ", $separar[1]);


    if ($separar2[1] = "masterreport") {

      return $query;
    }



    $cadena_buscada   = 'where ';
    $posicion_coincidencia = strpos($query, $cadena_buscada);



    //se puede hacer la comparacion con 'false' o 'true' y los comparadores '===' o '!=='
    if ($posicion_coincidencia === false) {
      $query2 = $query . " where " . $separar2[1] . ".empresa='" . session('idempresa') . "'";
    } else {

      $separado = explode("where", $query);

      $query2 = $separado[0] . "  where " . $separar2[1] . ".empresa='" . session('idempresa') . "' and  " . $separado[1];
    }
    echo $query2;
    return $query2;
  }
  public function viewpost(Request $request)
  {

    $link = "";
    $formulario = true;
    $id = $request->get('id');
    $query = "select * from masterreport where id='" . $id . "'";
    $resultados = DB::select($query);
    $cabezeras = array();
    foreach ($resultados as  $valuep) {
      $query2 = $valuep->query;
      $crear = $valuep->crear;
      $modificar = $valuep->modificar;
      $eliminar = $valuep->eliminar;
      $nombre = $valuep->nombre;
      $descripcion = $valuep->descripcion;
      $permisos = $valuep->permisos;
      $tabla = $valuep->tabla;
      $parametros = $valuep->parametros;
      $parametrosTipo = $valuep->parametrosTipo;
      $altaexterna = $valuep->altaexterna;
      $dbexterna = $valuep->base;
    }
    foreach ($request as $key => $value) {

      if ($key == "request") {
        foreach ($value as $key2 => $value2) {

          if ($key2 <> "_token") {
            $clave = "@" . $key2;
            $query2 = str_replace($clave, $value2, $query2);
          }
        }
      }
    }

    if ($dbexterna == 1) {
      $query3 = $query2 . " limit 1";
      $resultados2 = DB::select($query3);

      foreach ($resultados2 as  $valuep) {
        foreach ($valuep as $key => $value) {
          array_push($cabezeras, $key);
        }
      }
      # dd($cabezeras);
      $resultados3 = DB::select($query2);
    } else {
      $prueba = $this->conectar($dbexterna);

      $query3 = $query2 . " limit 1";
      //si es distinta a 1 aa otra base
      $resultados2 = DB::connection('mysql2')->select($query3);

      foreach ($resultados2 as  $valuep) {
        foreach ($valuep as $key => $value) {
          array_push($cabezeras, $key);
        }
      }
      # dd($cabezeras);

      // $query2 = $this->empresa($query2);

      // $resultados3 = DB::select($query2);
      $resultados3 = DB::connection('mysql2')->select($query2);
    }
    return view('sienna/cevicheview')->with('resultados', $resultados3)
      ->with('cabezeras', $cabezeras)
      ->with('crear', $crear)
      ->with('modificar', $modificar)
      ->with('nombre', $nombre)
      ->with('descripcion', $descripcion)
      ->with('permisos', $permisos)
      ->with('tabla', $tabla)
      ->with('link', $link)
      ->with('altaexterna', $altaexterna)

      ->with('eliminar', $eliminar)
      ->with('parametrosTipo', $parametrosTipo)
      ->with('parametros', $parametros)
      ->with('formulario', $formulario)
      ->with('idreporte', $id);
  }


  public function putPermanentEnv($key, $value)
  {
    $path = app()->environmentFilePath();
    $escaped = preg_quote('=' . env($key), '/');

    file_put_contents($path, preg_replace(
      "/^{$key}{$escaped}/m",
      "{$key}={$value}",
      file_get_contents($path)
    ));
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
    config(['database.connections.mysql2.port' => $port]);

    config(['database.connections.mysql2.database' => $base]);
    config(['database.connections.mysql2.username' => $usuario]);
    config(['database.connections.mysql2.password' => $pass]);
  }

  public function autoimcrement($tabla,$dbexterna){

    $query = "SHOW FIELDS FROM " . $tabla;
    if ($dbexterna == 1) {
    $resultadosfields = DB::select($query);
    }else{

      $resultadosfields = DB::connection('mysql2')->select($query);

    }
    $Extraarray= array();
    $Fieldarray = array();

    $indice=0;
    foreach ($resultadosfields as $key => $value) {
      foreach ($value as $key2 => $value2) {
        if ($key2 == "Field") {
          array_push($Fieldarray, $value2);
        }
        if ($key2 == "Extra") {
          if($value2=="auto_increment"){
            echo "indice:";
            echo $indice;
            $valorbuscado=$indice;
            echo "<br><br>";


            array_push($Extraarray, $value2);
            break;
          }
        
        }
      }
      $indice++;
    }

    var_dump(sizeof($Extraarray));
    echo "<br><br>";
    var_dump($Fieldarray[$valorbuscado]);
  }
  public function view(Request $request)

  {

    $link = "";
    $id = $request->id;
    $query = "select * from masterreport where id='" . $id . "'";
    $resultados = DB::select($query);
    $cabezeras = array();
    foreach ($resultados as  $valuep) {
      $query2 = $valuep->query;
      $crear = $valuep->crear;
      // $graficos = $valuep->graficos;
      $modificar = $valuep->modificar;
      $eliminar = $valuep->eliminar;
      $nombre = $valuep->nombre;
      $descripcion = $valuep->descripcion;
    //  $permisos = $valuep->permisos;
      $tabla = $valuep->tabla;
      $parametros = $valuep->parametros;
      $parametrosTipo = $valuep->parametrosTipo;
     // echo  $altaexterna = $valuep->altaexterna;
      echo $dbexterna = $valuep->base;
    }


    if ($parametros <> "") {
      $formulario = true;
      foreach ($request as $key => $value) {


        if ($key == "request") {
          if (sizeof($value) > 1) {
            foreach ($value as $key2 => $value2) {

              if ($key2 <> "id") {

                $nuevoquery = str_replace("@" . $key2 . "", $value2, $query2);
                $link = $key2 . "=" . $value2;
              }
            }
            $query2 = $nuevoquery;
            $formulario = false;
          } else {

            return view('sienna/cevicheviewform')
              ->with('parametrosTipo', $parametrosTipo)
              ->with('parametros', $parametros);
          }
        }
      }
    } else {

      $formulario = false;
    }


    if ($dbexterna == 1) {
      echo "entro local";

      $query3 = $query2 . " limit 1";
      //si es distinta a 1 aa otra base
      $resultados2 = DB::select($query3);

      foreach ($resultados2 as  $valuep) {
        foreach ($valuep as $key => $value) {
          array_push($cabezeras, $key);
        }
      }
      # dd($cabezeras);

     // $query2 = $this->empresa($query2);

      $resultados3 = DB::select($query2);
     
    //  $this->autoimcrement($tabla,$dbexterna);
    } else {
      echo "entro externa";
      $prueba = $this->conectar($dbexterna);

      $query3 = $query2 . " limit 1";
      //si es distinta a 1 aa otra base
      $resultados2 = DB::connection('mysql2')->select($query3);

      foreach ($resultados2 as  $valuep) {
        foreach ($valuep as $key => $value) {
          array_push($cabezeras, $key);
        }
      }
      # dd($cabezeras);

     // $query2 = $this->empresa($query2);

      // $resultados3 = DB::select($query2);
      $resultados3 = DB::connection('mysql2')->select($query2);
     /// $this->autoimcrement($tabla,$dbexterna);


    }

  

   return view('sienna/cevicheview')->with('resultados', $resultados3)
      ->with('cabezeras', $cabezeras)
      ->with('crear', $crear)
      ->with('modificar', $modificar)
      ->with('nombre', $nombre)
      ->with('descripcion', $descripcion)
      ->with('tabla', $tabla)
      ->with('eliminar', $eliminar)
      ->with('formulario', $formulario)

      ->with('link', $link)
      ->with('idreporte', $id);
  }
  public function nuevo_post(Request $request)
  {


    $table = $request->table;
    $campos = "";
    $valores = "";
    foreach ($request as $key => $value) {

      if ($key == "request") {
        foreach ($value as $key2 => $value2) {

          print($key2);
          if (($key2 <> "_token") and ($key2 <> "table")) {
            print($key2);
            $campos .= $key2 . ",";
            print("<br>");

            print($value2);
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
            print("<br>");
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

    $resultados = DB::select($dato);

    return redirect()
      ->back()
      ->with('success', 'Se creo el registro  correctamente!');
  }
  public function nuevo(Request $request)
  {
    //dd($request);
    $table = $request->table;
    $link = "";
    foreach ($request as $key => $value) {
      if ($key == "request") {
        if (sizeof($value) > 1) {
          foreach ($value as $key2 => $value2) {
            if ($key2 <> "table") {
              echo $link = $key2 . "=" . $value2;
            }
          }
        }
      }
    }
    //
    $query = "SHOW FIELDS FROM " . $table;
    $resultados = DB::select($query);
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

    return view('sienna/nuevo')
      ->with('Nullarray', $Nullarray)
      ->with('Typearray', $Typearray)
      ->with('link', $link)
      ->with('table', $table)
      ->with('Fieldarray', $Fieldarray)
      ->with('tablaa', $table);
  }

  public function table($id)
  {


    $query = "select * from masterreport where id='" . $id . "'";
    $resultados = DB::select($query);
    $cabezeras = array();
    foreach ($resultados as  $valuep) {

      $tabla = $valuep->tabla;
    }
    return $tabla;
  }
  public function modificar_post(Request $request)
  {

    $id = $request->id;
    $reporte = $request->reporte;
    $table = $this->table($reporte);
    $campos = "";
    $valores = "";
    print("<br>");
    foreach ($request as $key => $value) {

      if ($key == "request") {
        foreach ($value as $key2 => $value2) {

          if ($key2 <> "_token") {


            print($value2);
            if ($value2 == "on") {
              $value2 = "1";
            }
            if ($value2 == "off") {
              $value2 = "0";
            }
            print($key2);

            if ($key2 == "password") {

              if ($value2 <> "") {

                $campos .= $key2 . "=md5('" . $value2 . "'),";
              }
            } else {

              $campos .= $key2 . "='" . $value2 . "',";
            }

            print("<br>");
          }
        }
      }
      if ($key == "files") {
        foreach ($value as $key2 => $value2) {

          if ($key2 == "logo") {

            echo $path = $request->file('logo')->store('public');
            //dd($path);
            $value2 = $path;
            $campos .= $key2 . "='" . $value2 . "',";
            $valores .= "'" . $path . "',";
          }
        }
      }
    }
    $campos = substr($campos, 0, -1);


    $dato = "update " . $table . " set  " . $campos . "   where id='" . $id . "'";
    echo $dato;
    $resultadosupdate = DB::select($dato);
    return redirect()
      ->back()
      ->with('success', 'Se Modifico el registro  correctamente!');
  }
  public function modificar(Request $request)
  {
    $id = $request->reporte;
    $idregistro = $request->id;
    $query = "select * from masterreport where id='" . $id . "'";
    $resultados = DB::select($query);
    $cabezeras = array();
    foreach ($resultados as  $valuep) {
      $query2 = $valuep->query;
      $crear = $valuep->crear;
      $modificar = $valuep->modificar;
      $eliminar = $valuep->eliminar;
      $nombre = $valuep->nombre;
      $descripcion = $valuep->descripcion;
      $table = $valuep->tabla;
      $parametros = $valuep->parametros;
      $parametrosTipo = $valuep->parametrosTipo;
    }

    echo $queryupdate = "select * from " . $table . " where id=" . $idregistro . "";
    $resultadosupdate = DB::select($queryupdate);
    //dd($resultadosupdate);
    $query = "SHOW FIELDS FROM " . $table;
    $resultados = DB::select($query);
    $Fieldarray = array();
    $Typearray = array();
    $Nullarray = array();
    $Extraarray= array();
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


    return view('sienna/modificar')
      ->with('Nullarray', $Nullarray)
      ->with('Typearray', $Typearray)
      ->with('Fieldarray', $Fieldarray)
      ->with('data', $resultadosupdate)
      ->with('extra', $Extraarray)
      ->with('tablaa', $table);
  }













  public function datos()
  {
    $query = "select * from usuario where rolpdi in('1','9')";
    $resultados = DB::select($query);

    return view('das_entornos/rolpdi2')->with('resultados', $resultados);
  }
  public function update(Request $request)
  {
    $dni = $request->dni;
    $rolpdi = $request->rolpdi;
    echo $query = "update usuario set rolpdi='" . $rolpdi . "'  where dni='" . $dni . "'";
    $resultados = DB::update($query);

    $query2 = "select * from usuario where rolpdi in('1','9')";
    $resultados2 = DB::select($query2);

    return view('das_entornos/rolpdi2')->with('resultados', $resultados2);
  }
  public function exportar($query)
  {
    $resultados = DB::select($query);
    $columns = $this->cabezeras($resultados);
    //csv
    $fileName = 'Logs.csv';
    $headers = array(
      "Content-type"        => "text/csv",
      "Content-Disposition" => "attachment; filename=$fileName",
      "Pragma"              => "no-cache",
      "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
      "Expires"             => "0"
    );
    $callback = function () use ($resultados, $columns) {
      $file = fopen('php://output', 'w');
      fputcsv($file, $columns);
      $delimiter = ",";
      foreach ($resultados as $valor) {
        $array_list = array();
        foreach ($columns as $valor2) {
          array_push($array_list, $valor->$valor2);
        }
        fputcsv($file, $array_list, $delimiter);
      }

      fclose($file);
    };
    return response()->stream($callback, 200, $headers);
  }


  public   function cabezeras($datos)
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

  public function graficosform(Request $request)
  {

    $idgrafico = $request->id;

    return view('sienna/graficosform')->with('idgrafico', $idgrafico);
  }

  public function graficos(Request $request)
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

  public function graficosiframe(Request $request)
  {

    $idgrafico = $request->id;
    $graficos = $request->graficos;
    $datosget = $this->select2($idgrafico);
    $cabezeras = $this->cabezerasgraficos($datosget);



    return view('sienna/graficosiframe')->with('cabezeras', $cabezeras)
      ->with('datosget', $datosget)
      ->with('graficos', $graficos)
      ->with('idgrafico', $idgrafico);
  }

  function select2($id)
  {

    $query = "select * from masterreport where id='" . $id . "'";
    $resultados = DB::select($query);
    $cabezeras = array();
    foreach ($resultados as  $valuep) {
      $query2 = $valuep->query;
      $dbexterna = $valuep->base;
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
}
