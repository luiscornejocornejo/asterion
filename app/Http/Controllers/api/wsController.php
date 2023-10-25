<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\base;
use App\Models\endpoint;
use App\Models\enpointnombre;
use App\Models\masterreport;
use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\siennatickets;
use App\Models\siennaseguimientos;
use App\Models\siennacliente;

class wsController extends Controller
{


    public function crearusuario(Request $request)
    {
        $token=$request->token;
        if($token<>"EDElDqlQf3RDP5EDK1pHhugV9M6aCXtwAm57SD0G5JYZjw7RxwZbbfdKMhWYdUUM"){
            return "token invalido";
        }

        $nombre=$request->nombre;
        $categoria=$request->categoria;
        $apellido=$request->apellido;
        $mail=$request->mail;
        $email_suricata=$request->email_suricata;

        $pass=md5($request->pass);
        users::query()->updateOrCreate([
            'id' => 0
        ], [
            'nombre' => $nombre,
            'categoria' => $categoria,
            'last_name' => $apellido,
            'email' => $mail,
            'password' => $pass,
            'type_dni' => 1,
            'dni' =>'123456789',
            'cuit' =>'123456789',
            'framegender' =>'1',
            'email_suricata' =>$email_suricata,
            'framecountry' =>'1',
            'active' =>'1',
            'birthdate' =>'203-10-12',
           
            
            ]);
        
       
    }
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
                 $query = $value2->query;
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
    public function ws2(Request $request)
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
              $parametros=$value2->parametros;
              $query=$this->cambiarquery($parametros, $request, $query);
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
        $return2 = json_encode($datos);

        return response()->json(['pp' => $datos]);
        return $datos;
    }


    public function tickessienna(Request $request){
        $conversation_id=$request->conversation_id;
        $merchant=$request->merchant;
        //$inte=$request->inte;
        $cel ="";
        $query = "select * from siennacliente where cel='" . $cel . "'";
        $resultados = DB::select($query);
        $return2 = json_encode($resultados,true);
        $query2 = "select * from siennatickets where conversation_id='" . $conversation_id . "' and siennaestado=1";
        $resultados2 = DB::select($query2);



        $query4 = "select * from siennaintegracion";
        $resultados4 = DB::select($query4);
        foreach($resultados4 as $val2){

            $inte=$val2->nombre;
        }


        $prueba = $this->conectar(14);
        //si es distinta a 1 aa otra base
         $query3="select * from ".$inte.".ws_cliente where nombre='".$merchant."'";
        $datos = DB::connection('mysql2')->select($query3);
        $url="";
        $tokensienna="";
        foreach($datos as $val){

            $url=$val->headerlogin;
            $tokensienna=$val->tokensienna;
        }

        if($url<>""){
            $dat=file_get_contents("https://".$merchant.".".$url."/api/ws?token=".$tokensienna."&telefono=".$cel);//7461023535
            $dat=json_decode($dat);
        }else{
            $dat="";
        }

       
        return response()->json(['cliente' => $resultados,'tickets' => $resultados2,'dat' => $dat]);

    }
    public function creartickessienna(Request $request){
        $cel=$request->cel;
        $siennadepto=$request->siennadepto;
        $nya=$request->nya;
        $siennaestado=$request->siennaestado;
        $cedula=$request->cedula;
        $siennasource=$request->siennasource;
        $conversation_url=$request->conversation_url;
        $conversation_id=$request->conversation_id;
        
        $cliente=$request->cliente;

       $si=new siennatickets();
       $si->siennadepto=$siennadepto;
       $si->cliente=$cliente;
       $si->siennatopic=1;
       $si->cedula=$cedula;
       $si->siennaestado=$siennaestado;
       $si->siennasource=$siennasource;
       $si->cel=$cel;
       $si->nya=$nya;
       $si->conversation_url=$conversation_url;
       $si->conversation_id=$conversation_id;

        $si->save();

        $se=new siennaseguimientos();
        $se->ticket=$si->id;
        $se->autor="sistema";
        $se->save();


            $sc=new siennacliente();
            if($cliente<>''){

            $sc->cliente=$cliente;
            }else{

                $sc->cliente="";

            }
            $sc->conversation_id=$conversation_id;
            $sc->nya=$nya;
            try {
                $sc->save();

            } catch (\Illuminate\Database\QueryException$ex) {
                //echo "existe".$ex;
            }
            
       
        return $si->id;
        //return response()->json(['cliente' => $return2]);

    }
    public function tickessiennaseguimientos(Request $request){
        $ticket=$request->ticket;
        $resultados="";
        $query="select * from siennaseguimientos where ticket='" . $ticket . "'";
        $resultados = DB::select($query);
     

        $return2 = json_encode($resultados);

        return response()->json(['pp' => $resultados]);

    }
    

    public function tickessiennaapi(Request $request){

        $conversation_id=$request->conversation_id;


         $query="select *,b.nombre nombreestado,c.nombre nombredepto,
        a.id ticketid,d.nombre siennatopicnombre,a.nya nya from siennatickets a 
        left join siennaestado b on b.id=a.siennaestado
        left join siennadepto c on c.id=a.siennadepto
        left join siennatopic d on d.id=a.siennatopic
        where a.conversation_id='".$conversation_id."' and a.siennaestado<>4";
        $resultados = DB::select($query);
        $ticketprincipal="";
        foreach($resultados as $val){

            $ticketprincipal=$val->ticketid;
        }

        $querysiennaestado="select * from siennaestado  ";
        $resultadossiennaestado = DB::select($querysiennaestado);

        $querysiennatopic="select * from siennatopic";
        $resultadossiennatopic = DB::select($querysiennatopic);


        $querysiennadepto="select * from siennadepto ";
        $resultadossiennadepto = DB::select($querysiennadepto);



        $queryq="select * from siennaseguimientos where ticket='" . $ticketprincipal . "'";
        $resultadosq = DB::select($queryq);


        $staff=array();
        $merchat="";
        $datosticketsviejos=array();
        return view("sienna/Ticketdatosxennio")
        ->with('ticket', $resultados)
        ->with('deptos', $resultadossiennadepto)
        ->with('staff', $staff)
        ->with('ost_ticket_status', $resultadossiennaestado)
        ->with('topics', $resultadossiennatopic)
        ->with('merchant', $merchat)
        ->with('seguimientos', $resultadosq)
        ->with('datosticketsviejos', $datosticketsviejos)
        ->with('id', $conversation_id);

    }

    public function cambiarstatussienna(Request $request){

      echo   $idticketestado=$request->idticketestado;
      echo   $statos=$request->statos;
      echo   $idconv=$request->idconv;
      echo   $idbot=$request->idbot;
      

      $si2 = siennatickets::find($idticketestado);
      $si2->siennaestado=$statos;
      $si2->save();

      if($statos==4){

        $url="https://suricata4..com.ar/api/closechat";
        $curl = curl_init();

        // Prepare data array with account key, bot key, and account secret
        $data = array(
            "token" => "EDElDqlQf3RDP5EDK1pHhugV9M6aCXtwAm57SD0G5JYZjw7RxwZbbfdKMhWYdUUM",
            "idbot" => $idbot,
            "idconv" => $idconv
        );
  
        // Set headers for the cURL request
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Cookie: xenioo-id=Bearer+ZlHPzQ0ZfubwcHXAjjXMG0hDlJI22S1S0dqgKs0H7O06PghfV3BRy6Wxmn7PLb6RUmfIXRXiijo5X8E7%2flsAUV24IzaB28PYO%2bw90fEOTrp8Hx0WQCQ%2btq69lwpWUZpCg0ga2p%2bQD%2bI9KFMrCB6Ht%2bJM4ZOuekNf%2bYWtUBQ%2bm1prYPb8nDXWuRnU6qgtzr7zInbdRjyNhsdg41gTr7AstZ3sLt2wAXQS%2ba8zSGYe1UZY7gvoYm%2fGKj6TbvAdWnO0WXTVkwnB1jhMbWDX38PYGt2jkNoaUXRWxncuQSxJRzUIBWuTJGju%2b7EZOaoK07cXNk%2bUPBMSV1Q9gV6Gzc8CkA%3d%3d',
        );
     
            $url="https://suricata4.com.ar/api/closechat?token=EDElDqlQf3RDP5EDK1pHhugV9M6aCXtwAm57SD0G5JYZjw7RxwZbbfdKMhWYdUUM&idbot=".$idbot."&idconv=".$idconv;
        // Set options for the cURL request
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => $headers,
        );
  
        // Set the options for cURL resource
        curl_setopt_array($curl, $options);
  
        // Execute the cURL request
        $response = curl_exec($curl);
  
        //dd($response);   
        // Close the cURL resource
        curl_close($curl);

      }
      return redirect()
      ->back()
      ->with('success', 'Se modifico el estado  correctamente!');

    }
    public function cambiartopicsienna(Request $request){

        echo   $idtickettopic=$request->idtickettopic;
        echo   $statos=$request->statos;
  
  
        $si2 = siennatickets::find($idtickettopic);
        $si2->siennatopic=$statos;
        $si2->save();
        return redirect()
        ->back()
        ->with('success', 'Se modifico el topic  correctamente!');
  
      }
    

      public function cambiardeptosienna(Request $request){

        echo   $idticketdepto=$request->idticketdepto;
        echo   $statos=$request->statos;
  
  
        $si2 = siennatickets::find($idticketdepto);
        $si2->siennadepto=$statos;
        $si2->save();
        return redirect()
        ->back()
        ->with('success', 'Se modifico el departamento  correctamente!');
  
      }

      public function siennacrearseguimiento(Request $request){

        echo   $ticket=$request->ticket;
        echo   $descripcion=$request->descripcion;
        if (isset($request->logo)) {
            $logo = $request->file('logo')->store('public');

        }else{
            $logo ="";
        }

        $se=new siennaseguimientos();
        $se->ticket=$ticket;
        $se->descripcion=$descripcion;
        $se->logo=$logo;
        $se->autor="api";
        $se->save();



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
