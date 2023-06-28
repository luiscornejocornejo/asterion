<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscripcion;
use App\Eve;
use App\Models\categoria;
use App\Models\dashboard;
use App\Models\graficos;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\PDO;
use Redirect;
use Flash;
use phpDocumentor\Reflection\PseudoTypes\False_;
use Illuminate\Support\File;
use App\Models\cronmail;
use App\Models\masterreport;
use Mail;
class TicketdatosController extends Controller
{
    //

    public function datos(Request $request)
    {

        return view("sienna/Ticketdatos")

    }
    public function view(Request $request)
    {
        $query = "SELECT a.id,a.nombre,b.nombre as servicio FROM `masterreport` a
        join servicio b on
        b.id=a.servicio
        where a.dashboard =1";
        $resultados = DB::select($query);

        $categorias = categoria::all();
        $graficos = graficos::all();

        return view("sienna/dashboard")
            ->with('servicio', $graficos)
            ->with('reporte', $resultados)
            ->with('categorias', $categorias);
    }

    public function viewpost(Request $request)
    {

        $das = new dashboard;
        $das->titulo = $request->titulo;
        $das->subtitulo = $request->subtitulo;
        $das->masterreport = $request->reporte;
        $das->tipo = $request->tipo;
        $das->categoria = $request->categoria;
        $das->save();

        return redirect()
            ->back()
            ->with('success', 'Se Agrego al dashboard  correctamente!');
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
        }
        config(['database.connections.mysql2.host' => $host]);
        config(['database.connections.mysql2.database' => $base]);
        config(['database.connections.mysql2.username' => $usuario]);
        config(['database.connections.mysql2.password' => $pass]);
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
    public function cronmail()
    {

        date_default_timezone_set("America/Argentina/Buenos_Aires");
      echo  $hora = date('H:i:00');
     echo    $fecha = date('Y-m-d');
        $datos = cronmail::where('estado', '=', '0', 'and')->where('fecha', '=', $fecha, 'and')->where('hora', '=', $hora)->get();
        if (sizeof($datos) > 0) {
            foreach ($datos as $value) {
                
                $datoreporte = masterreport::where('id', '=', $value->idreporte)->get();
                var_dump($datoreporte);
                foreach ($datoreporte as $value2) {
                    echo $base = $value2->base;
                    echo $query = $value2->query;
                    echo "<br>1";
                    echo "<br>";
                }
                if ($base == 0) {
                        $fields2 = DB::select($query);
                        $cabezeras=$this->cabezerasgraficos($fields2 );
                        var_dump($fields2);
                        $subject = $value->asunto;
                        $for = "kayser1712@gmail.com";
                        Mail::send('mail',["fields2"=>$fields2,'cabezeras'=>$cabezeras], function($msj) use($subject,$for){
                            $msj->from("prueba@siennasystem.com","luis");
                            $msj->subject($subject);
                            $msj->to($for);
                        });
                } else {

                        $prueba = $this->conectar($base);
                        //si es distinta a 1 aa otra base
                        $fields2 = DB::connection('mysql2')->select($query);
                        $cabezeras=$this->cabezerasgraficos($fields2 );

                        var_dump($fields2);
                        $subject = $value->asunto;
                        $for = "kayser1712@gmail.com";
                        Mail::send('mail',["fields2"=>$fields2,'cabezeras'=>$cabezeras], function($msj) use($subject,$for){
                            $msj->from("prueba@siennasystem.com","luis");
                            $msj->subject($subject);
                            $msj->to($for);
                        });
                    }
            }
               
        }
  
    }
}
