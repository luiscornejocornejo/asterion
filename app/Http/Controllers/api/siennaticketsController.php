<?php

namespace App\Http\Controllers\api;

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
use App\Models\siennadepto;
use App\Models\siennaestado;
use App\Models\empresa;
use App\Models\categoria;
use Illuminate\Support\Facades\Artisan;

class siennaticketsController extends Controller
{


    public function crearusuario(Request $request)
    {
        $token = $request->token;
        if ($token <> "EDElDqlQf3RDP5EDK1pHhugV9M6aCXtwAm57SD0G5JYZjw7RxwZbbfdKMhWYdUUM") {
            return "token invalido";
        }

        $nombre = $request->nombre;
        $categoria = $request->categoria;
        $apellido = $request->apellido;
        $mail = $request->mail;
        $email_suricata = $request->email_suricata;

        $pass = md5($request->pass);
        users::query()->updateOrCreate([
            'id' => 0
        ], [
            'nombre' => $nombre,
            'categoria' => $categoria,
            'last_name' => $apellido,
            'email' => $mail,
            'password' => $pass,
            'type_dni' => 1,
            'dni' => '123456789',
            'cuit' => '123456789',
            'framegender' => '1',
            'email_suricata' => $email_suricata,
            'framecountry' => '1',
            'active' => '1',
            'birthdate' => '203-10-12',


        ]);
    }
    public function select2($id, $mail)
    {

        $resultados = masterreport::where('id', '=', $id)->get();
        foreach ($resultados as $valuep) {
            $query2 = $valuep->query;
            $dbexterna = $valuep->base;
            $parametros = $valuep->parametros;
        }
        if ($parametros == "logeo") {

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


            $query = $this->cambiarquery($parametros, $request, $query);
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
                $parametros = $value2->parametros;
                $query = $this->cambiarquery($parametros, $request, $query);
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

    function verificarSubcadena($cadena, $subcadena)
    {
        if (strpos($cadena, $subcadena) !== false) {
            return true;
        } else {
            return false;
        }
    }

    public function tickessienna(Request $request)
    {
        $conversation_id = $request->conversation_id;
        $merchant = $request->merchant;

        if ($this->verificarSubcadena($conversation_id, "+")) {
        } else {
            $conversation_id = "+" . $conversation_id;
        }

        $query = "select * from siennacliente where conversation_id='" . $conversation_id . "'";
        $resultados = DB::select($query);
        $return2 = json_encode($resultados, true);


        $query2 = "select * from siennatickets where conversation_id='" . $conversation_id . "' and siennaestado<>4";
        $resultados2 = DB::select($query2);

        $idcustomer = "";
        foreach ($resultados as $val) {
            $idcustomer = $val->cliente;
        }

        $query4 = "select * from siennaintegracion";
        $resultados4 = DB::select($query4);
        foreach ($resultados4 as $val2) {

            $inte = $val2->nombre;
        }


        $prueba = $this->conectar(14);
        $query3 = "select * from " . $inte . ".ws_cliente where nombre='" . $merchant . "'";
        $datos = DB::connection('mysql2')->select($query3);
        $url = "";
        $tokensienna = "";
        foreach ($datos as $val) {

            $url = $val->headerlogin;
            $tokensienna = $val->tokensienna;
            $campo = $val->headerendpoint;
        }

        if ($url <> "") {
            $campos = explode(",", $campo);
            if ($idcustomer <> "") {
                $dat = file_get_contents("https://" . $merchant . "." . $url . "/api/ws?token=" . $tokensienna . "&" . $campos[0] . "=" . $idcustomer); //7461023535
                $dat = json_decode($dat);
            } else {

               // $dat = file_get_contents("https://" . $merchant . "." . $url . "/api/ws?token=" . $tokensienna . "&" . $campos[2] . "=" . $conversation_id); //7461023535
                //$dat = json_decode($dat);
            }
        } else {
            $dat = "";
        }


        return response()->json(['cliente' => $resultados, 'tickets' => $resultados2, 'dat' => $dat]);
    }

    public function tickessienna2(Request $request)
    {
        $cel = $request->cel;
        $merchant = $request->merchant;

        if ($this->verificarSubcadena($cel, "+")) {
        } else {
            $cel = "+" . $cel;
        }

        $query = "select * from siennacliente where cel='" . $cel . "'";
        $resultados = DB::select($query);
        $return2 = json_encode($resultados, true);


        $query2 = "select * from siennatickets where cel='" . $cel . "' and siennaestado<>4";
        $resultados2 = DB::select($query2);

        $idcustomer = "";
        foreach ($resultados as $val) {
         echo    $idcustomer = $val->cliente;
        }

        $query4 = "select * from siennaintegracion";
        $resultados4 = DB::select($query4);
        foreach ($resultados4 as $val2) {

            $inte = $val2->nombre;
        }


        $prueba = $this->conectar(14);
         $query3 = "select * from " . $inte . ".ws_cliente where nombre='" . $merchant . "'";
        $datos = DB::connection('mysql2')->select($query3);
        $url = "";
        $tokensienna = "";
        foreach ($datos as $val) {

            $url = $val->headerlogin;
            $tokensienna = $val->tokensienna;
            $campo = $val->headerendpoint;
        }

        if ($url <> "") {
            $campos = explode(",", $campo);
            if ($idcustomer <> "") {
                $dat = file_get_contents("https://" . $merchant . "." . $url . "/api/ws?token=" . $tokensienna . "&" . $campos[0] . "=" . $idcustomer); //7461023535
                $dat = json_decode($dat);
            } else {

                $dat = file_get_contents("https://" . $merchant . "." . $url . "/api/ws?token=" . $tokensienna . "&" . $campos[2] . "=" . $cel); //7461023535
                $dat = json_decode($dat);
            }
        } else {
            $dat = "";
        }


        return response()->json(['cliente' => $resultados, 'tickets' => $resultados2, 'dat' => $dat]);
    }
    public function tickessienna3(Request $request)
    {
        $clientid = $request->clientid;
        $merchant = $request->merchant;

        

        $query = "select * from siennacliente where cliente='" . $clientid . "'";
        $resultados = DB::select($query);
        $return2 = json_encode($resultados, true);


        $query2 = "select * from siennatickets where cliente='" . $clientid . "' and siennaestado<>4";
        $resultados2 = DB::select($query2);

        $idcustomer = "";
        foreach ($resultados as $val) {
            $idcustomer = $val->cliente;
        }

        $query4 = "select * from siennaintegracion";
        $resultados4 = DB::select($query4);
        foreach ($resultados4 as $val2) {

            $inte = $val2->nombre;
        }


        $prueba = $this->conectar(14);
        $query3 = "select * from " . $inte . ".ws_cliente where nombre='" . $merchant . "'";
        $datos = DB::connection('mysql2')->select($query3);
        $url = "";
        $tokensienna = "";
        foreach ($datos as $val) {

            $url = $val->headerlogin;
            $tokensienna = $val->tokensienna;
            $campo = $val->headerendpoint;
        }

        if ($url <> "") {
            $campos = explode(",", $campo);
            if ($idcustomer <> "") {
                $dat = file_get_contents("https://" . $merchant . "." . $url . "/api/ws?token=" . $tokensienna . "&" . $campos[0] . "=" . $clientid); //7461023535
                $dat = json_decode($dat);
            } else {

               // $dat = file_get_contents("https://" . $merchant . "." . $url . "/api/ws?token=" . $tokensienna . "&" . $campos[0] . "=" . $clientid); //7461023535
                //$dat = json_decode($dat);
            }
        } else {
            $dat = "";
        }


        return response()->json(['cliente' => $resultados, 'tickets' => $resultados2, 'dat' => $dat]);
    }
    public function maxid(Request $request)
    {
        $idusuario = $request->idusuario;
        $areas = $request->area;

        $query = "select *,a.conversation_id,a.user_id,
        b.nombre as depto,b.id as iddepto,d.nombre topicnombre,a.created_at as creado,
        a.id as ticketid,c.nombre estadoname,d.nombre topicname,a.cel numerocel,a.asignado from siennatickets a
        left join siennadepto b on b.id=a.siennadepto 
        left join  siennaestado c on c.id=a.siennaestado

        left join  siennatopic d on d.id=a.siennatopic
        where a.siennaestado not in('3','4')  
         and a.asignado='" . $idusuario . "' 

         union 

         select *,a.conversation_id,a.user_id,
        b.nombre as depto,b.id as iddepto,d.nombre topicnombre,a.created_at as creado,

        a.id as ticketid,c.nombre estadoname,d.nombre topicname,a.cel numerocel,a.asignado from siennatickets a
        left join siennadepto b on b.id=a.siennadepto 
        left join  siennaestado c on c.id=a.siennaestado

        left join  siennatopic d on d.id=a.siennatopic
        where a.siennaestado not in('3','4')  
         and a.asignado='99999'
         and a.siennadepto='" . $areas . "'

         order by ticketid desc
        ";

        $resultados = DB::select($query);
        return $resultados;
    }
    
    public function cerrados(Request $request)
    {
        

        $ini=$request->inicio;
        $fin=$request->fin;
       
        $query = "select *,a.conversation_id,a.user_id,
        b.nombre as depto,b.id as iddepto,d.nombre topicnombre,
        a.id as ticketid,c.nombre estadoname,d.nombre topicname,a.cel numerocel,a.asignado from siennatickets a
        left join siennadepto b on b.id=a.siennadepto 
        left join  siennaestado c on c.id=a.siennaestado

        left join  siennatopic d on d.id=a.siennatopic
        where a.siennaestado  in('4')  
        and
      
         created_at>='".$ini." 00:00:00' and created_at<='".$fin." 23:59:59'
         

       

         order by ticketid desc
        ";

        $resultados = DB::select($query);
        return $resultados;
    }
    public function datoscliente(Request $request)
    {
        $cliente = $request->cliente;

        $query="select * from siennacliente where cliente='".$cliente."'";
        $resultados = DB::select($query);
        return $resultados;
    }
    public function maxid2(Request $request)
    {
        $idusuario = $request->idusuario;
        $areas = $request->area;

        $query = "select *,a.conversation_id,a.user_id,concat(e.nombre,' ',e.last_name) as nombreagente,
        b.nombre as depto,b.id as iddepto,d.nombre topicnombre,a.created_at as creado,
        a.id as ticketid,c.nombre estadoname,d.nombre topicname,a.cel numerocel,a.asignado from siennatickets a
        left join siennadepto b on b.id=a.siennadepto 
        left join  siennaestado c on c.id=a.siennaestado
        left join  siennatopic d on d.id=a.siennatopic
        left join  users e on e.id=a.asignado
        where a.siennaestado not in('3','4')  
         

         union 

         select *,a.conversation_id,a.user_id,concat(e.nombre,' ',e.last_name) as nombreagente,
        b.nombre as depto,b.id as iddepto,d.nombre topicnombre,a.created_at as creado,

        a.id as ticketid,c.nombre estadoname,d.nombre topicname,a.cel numerocel,a.asignado from siennatickets a
        left join siennadepto b on b.id=a.siennadepto 
        left join  siennaestado c on c.id=a.siennaestado
        left join  siennatopic d on d.id=a.siennatopic

        left join  users e on e.id=a.asignado
        where a.siennaestado not in('3','4')  
         

         order by ticketid desc
        ";

        $resultados = DB::select($query);
        return $resultados;
    }
    public function creartickessienna(Request $request)
    {
        $cel = $request->cel;
        $siennadepto = $request->siennadepto;
        $nya = $request->nya;
        $siennaestado = $request->siennaestado;
        $cedula = $request->cedula;
        $siennasource = $request->siennasource;
        $conversation_url = $request->conversation_url;
        $conversation_id = $request->conversation_id;
        $cedula = $request->cedula;
        $email = $request->email;
        $user_id = $request->user_id;
        $cliente = $request->cliente;
        $siennatopic = $request->siennatopic;

        $deuda = $request->deuda;
        $s_status = $request->s_status;
        $a_status = $request->a_status;
        $address = $request->address;





        $si = new siennatickets();
        $si->siennadepto = $siennadepto;
        $si->cliente = $cliente;
        $si->siennatopic = $siennatopic;
        $si->cedula = $cedula;
        $si->siennaestado = $siennaestado;
        $si->siennasource = $siennasource;
        $si->cel = $cel;
        $si->nya = $nya;
        $si->asignado = 0;


        //$user_id=str_replace("+","",$user_id);  
        //$conversation_id=str_replace("+","",$conversation_id);
        $si->user_id = $user_id;
        $si->conversation_url = $conversation_url;
        $si->conversation_id = $conversation_id;

        $si->save();

        $se = new siennaseguimientos();
        $se->ticket = $si->id;
        $se->tipo = "1";
        $se->descripcion = "created";
        $se->autor = "sistema";
        $se->save();

        if ($siennadepto == 3) {
            $usuarioventa = 0;
            $querylogica = "select idusuario,(select count(*) from siennatickets s2  
            where s2.asignado=s.idusuario and s2.siennaestado not in('8','9'))as cantidad from siennaloginxenioo s 
            where login=1 and categoria =11 and date(now())=date(created_at) group by idusuario order by cantidad asc limit 1";
            $resultados4 = DB::select($querylogica);
            foreach ($resultados4 as $val) {

                $usuarioventa = $val->idusuario;
            }
            $asig = siennatickets::find($si->id);
            $asig->asignado = $usuarioventa;
            $asig->save();
        }



        $sc = new siennacliente();
        if ($cliente <> '') {

            $sc->cliente = $cliente;
        } else {

            $sc->cliente = "";
        }
        $sc->conversation_id = $conversation_id;
        $sc->nya = $nya;
        $sc->email = $email;
        $sc->cel = $cel;
        $sc->cedula = $cedula;
        $sc->deuda = $deuda;
        $sc->s_status = $s_status;
        $sc->a_status = $a_status;
        $sc->address = $address;
        try {
            $sc->save();
        } catch (\Illuminate\Database\QueryException $ex) {
            //echo "existe".$ex;
        }


        return $si->id;
        //return response()->json(['cliente' => $return2]);

    }
    public function tickessiennaseguimientos(Request $request)
    {
        $ticket = $request->ticket;
        $resultados = "";
        $query = "select * from siennaseguimientos where ticket='" . $ticket . "'";
        $resultados = DB::select($query);


        $return2 = json_encode($resultados);

        return response()->json(['pp' => $resultados]);
    }

    public function topicxdepto(Request $request)
    {
        $depto = $request->depto;
        $resultados = "";
        $query = "select * from siennatopic where siennadepto='" . $depto . "'";
        $resultados = DB::select($query);
        return $resultados;
    }

    public function tickessiennaapi(Request $request)
    {

        $operator = $request->operator;
        //dd($operator);
        $conversation_id = urlencode($request->conversation_id);
        $bot_channel = "telegram";

        $query = "select *,b.nombre nombreestado,c.nombre nombredepto,a.user_id,
            a.id ticketid,d.nombre siennatopicnombre,a.nya nya from siennatickets a 
            left join siennaestado b on b.id=a.siennaestado
            left join siennadepto c on c.id=a.siennadepto
            left join siennatopic d on d.id=a.siennatopic
            where a.conversation_id='" . $conversation_id . "' and a.siennaestado<>4";


        $resultados = DB::select($query);
        if (sizeof($resultados) == 0) {
            $query = "select *,b.nombre nombreestado,c.nombre nombredepto,a.user_id,
            a.id ticketid,d.nombre siennatopicnombre,a.nya nya from siennatickets a 
            left join siennaestado b on b.id=a.siennaestado
            left join siennadepto c on c.id=a.siennadepto
            left join siennatopic d on d.id=a.siennatopic
            where a.conversation_id='+" . $conversation_id . "' and a.siennaestado<>4";
            $resultados = DB::select($query);
            $bot_channel = "WhatsAppChannel";
        }
        $ticketprincipal = "";
        foreach ($resultados as $val) {

            $ticketprincipal = $val->ticketid;
        }

        $querysiennaestado = "select * from siennaestado  ";
        $resultadossiennaestado = DB::select($querysiennaestado);

        $querysiennatopic = "select * from siennatopic";
        $resultadossiennatopic = DB::select($querysiennatopic);


        $querysiennadepto = "select * from siennadepto ";
        $resultadossiennadepto = DB::select($querysiennadepto);



        $queryq = "select * from siennaseguimientos where ticket='" . $ticketprincipal . "'";
        $resultadosq = DB::select($queryq);


        $staff = array();
        $merchat = "";
        $datosticketsviejos = array();
        return view("sienna/Ticketdatosxennio")
            ->with('ticket', $resultados)
            ->with('deptos', $resultadossiennadepto)
            ->with('staff', $staff)
            ->with('ost_ticket_status', $resultadossiennaestado)
            ->with('topics', $resultadossiennatopic)
            ->with('merchant', $merchat)
            ->with('bot_channel', $bot_channel)
            ->with('seguimientos', $resultadosq)
            ->with('datosticketsviejos', $datosticketsviejos)
            ->with('operator', $operator)
            ->with('id', $conversation_id);
    }


    public function statussiennaxdepto(Request $request)
    {

        $depto = $request->depto;

        $estados = siennaestado::whereIn('area', ['0', $depto])->get();
        return $estados;
    }

    public function listadoseguimientos(Request $request)
    {

        $ticket = $request->ticket;

        $estados = siennaseguimientos::where('ticket', $ticket)->get();
        return $estados;
    }

    public function cambiarstatussienna(Request $request)
    {

        echo   $idticketestado = $request->idticketestado;
        echo   $statos = $request->statos;
        echo   $idconv = $request->idconv;
        echo   $idbot = $request->idbot;
        echo   $bot_channel = $request->bot_channel;


        $si2 = siennatickets::find($idticketestado);
        $si2->siennaestado = $statos;
        $si2->save();

        if ($statos == 4) {

            $url = "https://suricata4.com.ar/api/closechat";
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

            $url = "https://suricata4.com.ar/api/closechat?token=EDElDqlQf3RDP5EDK1pHhugV9M6aCXtwAm57SD0G5JYZjw7RxwZbbfdKMhWYdUUM&idbot=" . $idbot . "&idconv=" . $idconv . "&bot_channel=" . $bot_channel;
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
    public function cambiartopicsienna(Request $request)
    {

        echo   $idtickettopic = $request->idtickettopic;
        echo   $statos = $request->statos;


        $si2 = siennatickets::find($idtickettopic);
        $si2->siennatopic = $statos;
        $si2->save();
        return redirect()
            ->back()
            ->with('success', 'Se modifico el topic  correctamente!');
    }


    public function cambiardeptosienna(Request $request)
    {

        echo   $idticketdepto = $request->idticketdepto;
        echo   $statos = $request->statos;

        echo   $idconv = $request->idconv;
        echo   $idbot = $request->idbot;
        $user_id = $request->user_id;
        //$user_id=str_replace("+","",$user_id);
        echo   $bot_channel = $request->bot_channel;

        $si2 = siennatickets::find($idticketdepto);
        $si2->siennadepto = $statos;
        $si2->asignado = 0;
        $si2->save();





        $depto = siennadepto::find($statos);

        $behaviour = $depto->behaviour;
        $interaction = $depto->interaction;


        $curl = curl_init();

        // Prepare data array with account key, bot key, and account secret

        // Set headers for the cURL request
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Cookie: xenioo-id=Bearer+ZlHPzQ0ZfubwcHXAjjXMG0hDlJI22S1S0dqgKs0H7O06PghfV3BRy6Wxmn7PLb6RUmfIXRXiijo5X8E7%2flsAUV24IzaB28PYO%2bw90fEOTrp8Hx0WQCQ%2btq69lwpWUZpCg0ga2p%2bQD%2bI9KFMrCB6Ht%2bJM4ZOuekNf%2bYWtUBQ%2bm1prYPb8nDXWuRnU6qgtzr7zInbdRjyNhsdg41gTr7AstZ3sLt2wAXQS%2ba8zSGYe1UZY7gvoYm%2fGKj6TbvAdWnO0WXTVkwnB1jhMbWDX38PYGt2jkNoaUXRWxncuQSxJRzUIBWuTJGju%2b7EZOaoK07cXNk%2bUPBMSV1Q9gV6Gzc8CkA%3d%3d',
        );

        echo  $url = "https://suricata4.com.ar/api/Behaviour?token=EDElDqlQf3RDP5EDK1pHhugV9M6aCXtwAm57SD0G5JYZjw7RxwZbbfdKMhWYdUUM&idbot=" . $idbot . "&idconv=" . $idconv . "&behaviour=" . $behaviour . "&interaction=" . $interaction . "&user_id=" . $user_id . "&bot_channel=" . $bot_channel;
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



        return redirect()
            ->back()
            ->with('success', 'Se modifico el departamento  correctamente!');
    }
    public function cambiardeptosienna2(Request $request)
    {

        echo   $idticketdepto = $request->idticketdepto;
        echo   $statos = $request->statos;

        echo   $idconv = $request->idconv;
        echo   $idbot = $request->idbot;
        $user_id = $request->user_id;
        //$user_id=str_replace("+","",$user_id);
        echo   $bot_channel = $request->bot_channel;
        $logeado = $request->logeado;
        $si2 = siennatickets::find($idticketdepto);
        $si2->siennadepto = $statos;
        $si2->asignado = 0;
        $si2->save();





        $depto = siennadepto::find($statos);

        $behaviour = $depto->behaviour;
        $interaction = $depto->interaction;
        $nombrearea = $depto->nombre;


        $se = new siennaseguimientos();
        $se->ticket = $idticketdepto;
        $se->tipo = "3";
        $se->descripcion = "modificar area:" . $nombrearea;
        $se->autor = $logeado;
        $se->save();

        $curl = curl_init();

        // Prepare data array with account key, bot key, and account secret

        // Set headers for the cURL request
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Cookie: xenioo-id=Bearer+ZlHPzQ0ZfubwcHXAjjXMG0hDlJI22S1S0dqgKs0H7O06PghfV3BRy6Wxmn7PLb6RUmfIXRXiijo5X8E7%2flsAUV24IzaB28PYO%2bw90fEOTrp8Hx0WQCQ%2btq69lwpWUZpCg0ga2p%2bQD%2bI9KFMrCB6Ht%2bJM4ZOuekNf%2bYWtUBQ%2bm1prYPb8nDXWuRnU6qgtzr7zInbdRjyNhsdg41gTr7AstZ3sLt2wAXQS%2ba8zSGYe1UZY7gvoYm%2fGKj6TbvAdWnO0WXTVkwnB1jhMbWDX38PYGt2jkNoaUXRWxncuQSxJRzUIBWuTJGju%2b7EZOaoK07cXNk%2bUPBMSV1Q9gV6Gzc8CkA%3d%3d',
        );

        echo  $url = "https://suricata4.com.ar/api/Behaviour?token=EDElDqlQf3RDP5EDK1pHhugV9M6aCXtwAm57SD0G5JYZjw7RxwZbbfdKMhWYdUUM&idbot=" . $idbot . "&idconv=" . $idconv . "&behaviour=" . $behaviour . "&interaction=" . $interaction . "&user_id=" . $user_id . "&bot_channel=" . $bot_channel;
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



        return redirect()
            ->back()
            ->with('success', 'Se modifico el departamento  correctamente!');
    }
    public function pedir2(Request $request)
    {

        echo   $idticketpedir = $request->idticketpedir;

        echo   $usuarioticket = $request->usuarioticket;


        $logeado = $request->logeado;
        $si2 = siennatickets::find($idticketpedir);
        $si2->asignado = $usuarioticket;
        $si2->save();



        $se = new siennaseguimientos();
        $se->ticket = $idticketpedir;
        $se->tipo = "4";
        $se->descripcion = "asignarse ";
        $se->autor = $logeado;
        $se->save();



        return redirect()
            ->back()
            ->with('success', 'Se asigno  correctamente!');
    }
    public function pedir(Request $request)
    {

        echo   $idticketpedir = $request->idticketpedir;

        echo   $usuarioticket = $request->usuarioticket;


        $logeado = $request->logeado;
        $si2 = siennatickets::find($idticketpedir);
        $si2->asignado = $usuarioticket;
        $si2->save();



        $se = new siennaseguimientos();
        $se->ticket = $idticketpedir;
        $se->tipo = "4";
        $se->descripcion = "asignarse ";
        $se->autor = $logeado;
        $se->save();



        return redirect()
            ->back()
            ->with('success', 'Se asigno  correctamente!');
    }

    public function siennacrearseguimiento2(Request $request)
    {

        echo   $ticket = $request->idticketseguimiento;
        echo   $descripcion = $request->comentario;
        echo   $logeado = $request->logeado;


        if (isset($request->logo)) {
            $logo = $request->file('logo')->store('public');
        } else {
            $logo = "";
        }

        $se = new siennaseguimientos();
        $se->ticket = $ticket;
        $se->descripcion = $descripcion;
        $se->logo = $logo;
        $se->tipo = "5";
        $se->autor = $logeado;
        $se->save();

        return redirect()
            ->back()
            ->with('success', 'Se asigno  correctamente!');
    }
    public function siennacrearseguimiento(Request $request)
    {

        echo   $ticket = $request->ticket;
        echo   $descripcion = $request->descripcion;
        if (isset($request->logo)) {
            $logo = $request->file('logo')->store('public');
        } else {
            $logo = "";
        }

        $se = new siennaseguimientos();
        $se->ticket = $ticket;
        $se->descripcion = $descripcion;
        $se->logo = $logo;
        $se->tipo = "5";
        $se->autor = "api";
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


    public function enhora(Request $request)
    {
        // Configura la zona horaria a la hora local

        $area = $request->area;

        $emp = empresa::find(1);
        $zona = $emp->zona;

        date_default_timezone_set($zona); // Reemplaza 'America/Buenos_Aires' con la zona horaria deseada

        // Obtiene la hora actual en formato de 24 horas
        echo $horaLocal = date('H');
        echo $diaSemana = date('l');
        $cat = categoria::where('area', '=', $area)->get();

        foreach ($cat as $val) {

            echo $fecha = $val->$diaSemana;
        }

        $fec = explode("-", $fecha);

        if (($horaLocal > $fec[0]) and ($horaLocal < $fec[1])) {
            return "en horario";
        } else {

            return "fuera de horario";
        }
        // Imprime la hora local


    }

    public function ticketsviejo(Request $request)
    {
        $cel = $request->cel;
        $resultados = "";
        $query = "select * from siennatickets where cel='" . $cel . "' and siennaestado='4'";
        $resultados = DB::select($query);
        return $resultados;
    }

    public function nodos(Request $request)
    {
        $nombre = $request->nombre;
        $resultados = "";
        $query = "select * from nodos where nombre='" . $nombre . "' ";
        $resultados = DB::select($query);
        return $resultados;
    }
    public function quispe(Request $request){

        Artisan::call("ma:mailtickets");
    }

    public function dominio(){
        $subdomain_tmp = 'localhost';
        if (isset($_SERVER['HTTP_HOST'])) {
            $domainParts = explode('.', $_SERVER['HTTP_HOST']);
            $subdomain_tmp =  array_shift($domainParts);
        } elseif(isset($_SERVER['SERVER_NAME'])){
            $domainParts = explode('.', $_SERVER['SERVER_NAME']);
            $subdomain_tmp =  array_shift($domainParts);
            
        }
        return $subdomain_tmp;
    }
    public function getdata(Request $request)
    {

       echo $idcustomer=$request->cliente;
        $merchant =$this->dominio();            echo "<br>";

        echo  $query4 = "select * from ".$merchant.".siennaintegracion";            echo "<br>";

        $resultados4 = DB::select($query4);
        foreach ($resultados4 as $val2) {

            echo "<br>";
            echo   $inte = $val2->nombre;
        }


        $prueba = $this->conectar(14);
        $query3 = "select * from " . $inte . ".ws_cliente where nombre='" . $merchant . "'";
        $datos = DB::connection('mysql2')->select($query3);
        $url = "";
        $tokensienna = "";
        foreach ($datos as $val) {
            echo "<br>";

          echo   $url = $val->headerlogin;            echo "<br>";

          echo  $tokensienna = $val->tokensienna;            echo "<br>";

          echo  $campo = $val->headerendpoint;            echo "<br>";

        }

        if ($url <> "") {
            $campos = explode(",", $campo);
            echo $urlfinal="https://" . $merchant . "." . $url . "/api/ws?token=" . $tokensienna . "&" . $campos[0] . "=" . $idcustomer;
            if ($idcustomer <> "") {
                $dat = file_get_contents($urlfinal); //7461023535
                $dat = json_decode($dat);
            } else {

               // $dat = file_get_contents("https://" . $merchant . "." . $url . "/api/ws?token=" . $tokensienna . "&" . $campos[0] . "=" . $clientid); //7461023535
                //$dat = json_decode($dat);
            }
        } else {
            $dat = "";
        }


        return response()->json($dat);
    }
    
}
