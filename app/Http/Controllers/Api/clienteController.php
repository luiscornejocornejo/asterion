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
use App\Models\t_ticketuser;

use Carbon\Carbon;

class clienteController extends Controller
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
    public function datostickets2(Request $request)
    {

        // $id = $request->id;
        $fields2 = $this->select2(114,$request->mail);
        //$fields3 = $this->select2(77);
        //$fields4 = $this->select2(78);
        // $fields5 = $this->select2(79);
        $return2 = json_encode($fields2);
        return $return2;
    }

    public function topics2(Request $request)
    {

        $querydatos = "select * from t_topic";
        $fields55 = DB::select($querydatos);
        $return2 = json_encode($fields55);
        return $return2;
    }

    public function departments2(Request $request)
    {

        $querydatos = "select * from t_departamentos";
        $fields55 = DB::select($querydatos);
        $return2 = json_encode($fields55);
        return $return2;
    }
    
    public function status2(Request $request)
    {

        $querydatos = "select * from t_estado";
        $fields55 = DB::select($querydatos);
        $return2 = json_encode($fields55);
        return $return2;
    }
    

    public function staff2(Request $request)
    {

        $querydatos = "select * from t_staff";
        $fields55 = DB::select($querydatos);
        $return2 = json_encode($fields55);
        return $return2;
    }
    
    public function extrahistorial2(Request $request)
    {
        $ticketid = $request->id;

        $querydatos = "select a.created_at as timestamp,ts.nombre as username,a.t_estado as name from t_bitacora a
        join t_staff ts on ts.id=a.t_staff 
        where a.t_tickets =" . $ticketid . "";
        $fields55 = DB::select($querydatos);
        $return2 = json_encode($fields55);
        return $return2;
    }

    public function bitacora(Request $request)
    {
        $fields3 = $this->conectar2(11);
        $ticketid = $request->id;
        $querydatos = "select * from t_bitacora  where t_tickets=" . $ticketid . "";
        $fields55 = DB::select($querydatos);
        $return2 = json_encode($fields55);
        return $return2;
    }

  
    public function crearticket(Request $request){



        //token validacion
        $tokentabla="limaperu";
        $token=$request->token;
        if ($tokentabla != $token) {
            $error = array("error token" => "error de credenciales");
            return json_encode($error);
        }


        //existe usuario


        

        //creacion de ticket
        $t_tickets=new t_tickets();
        $t_tickets->t_departamentos=$request->t_departamentos;
        $t_tickets->t_topic=$request->t_topic;
        if(isset($request->t_estado)){
            $t_tickets->t_estado=$request->t_estado;
        }else{
            $t_tickets->t_estado=1;
        }
        $t_tickets->t_source=$request->t_source;
        $t_tickets->t_prioridad=$request->t_prioridad;
        $t_tickets->t_staff=null;
        $t_tickets->save();
        $ticketidinsertado = $t_tickets->id;

        $t_estado= t_estado::find($t_tickets->t_estado);
        
        $t_bitacora=new t_bitacora();
        $t_bitacora->t_estado=$t_estado->nombre;
        $t_bitacora->t_staff=1;
        $t_bitacora->t_tickets=$ticketidinsertado;
        $t_bitacora->save();


        //datos extrasuser

        $t_ticketuser=new t_ticketuser();

        $t_ticketuser->cliente_id=$request->cliente_id;
        $t_ticketuser->mail=$request->mail;
        $t_ticketuser->telefono=$request->telefono;
        $t_ticketuser->latitud=$request->latitud;
        $t_ticketuser->longitud=$request->longitud;
        $t_ticketuser->plan_name=$request->plan_name;
        $t_ticketuser->whatsapp_nro=$request->whatsapp_nro;
        $t_ticketuser->ticket=$ticketidinsertado;
        $t_ticketuser->save();


        //devolucion
        $devo=array("ticket"=>$ticketidinsertado);
        $return2 = json_encode($devo);
        return $return2;



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
