<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\base;
use App\Models\endpoint;
use App\Models\enpointnombre;
use App\Models\masterreport;
use App\Models\users;
use App\Models\siennasource;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\siennatickets;
use App\Models\siennaseguimientos;
use App\Models\siennacliente;
use App\Models\siennadepto;
use App\Models\siennaestado;
use App\Models\siennatopic;
use App\Models\siennamail;
use App\Models\empresa;
use App\Models\categoria;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\siennaintegracion;
use App\Models\siennagetdata;
use App\Models\logintelefonia;

use Mail;

class siennaticketsController extends Controller
{

    public function prueba(){
        $content="prueba 1";
    
        $url="https://store.xenioo.com/fs/600fdfe1-d560-4df8-b505-63a48c9a2e41/fb_4_697594.pdf";
      
       $content = file_get_contents($url);
    
    
       $archi=Str::of($url)->basename();
       $rr= Storage::disk('do')->put('seguimientos/'.$archi, $content);
       dd($rr);
      }

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

        
        $dat = "";

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


        try{
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
        }
        catch (\Throwable $e) {
          
            // Podemos hacer algo aquí si ocurre una excepción
            $dat = "";
        } 
       


        return response()->json(['cliente' => $resultados, 'tickets' => $resultados2, 'dat' => $dat]);
    }
    public function maxid(Request $request)
    {
        $idusuario = $request->idusuario;
        $areas = $request->area;
        $merchant=$this->dominio();

        $pos = strpos($areas, ",");

            // Nótese el uso de ===. Puesto que == simple no funcionará como se espera
            // porque la posición de 'a' está en el 1° (primer) caracter.
            if ($pos === false) {
                $final="'".$areas."'";
               // echo "La cadena '$findme' no fue encontrada en la cadena '$mystring'";
            } else {
                
                $sepa=explode(",",$areas);
                $final="";
                foreach($sepa as $val){
                    $final.="'".$val."',";
                }
                $final=substr($final,0,-1);
            }
         $query = "select *,a.conversation_id,a.user_id,
        b.nombre as depto,b.id as iddepto,d.nombre topicnombre,convertirTiempo(a.created_at)  as creado,
        a.id as ticketid,c.nombre estadoname,d.nombre topicname,a.cel numerocel,a.asignado,e.nombre as pri,e.id as prid
        from ".$merchant.".siennatickets a
        left join ".$merchant.".siennadepto b on b.id=a.siennadepto 
        left join  ".$merchant.".siennaestado c on c.id=a.siennaestado

        left join  ".$merchant.".siennatopic d on d.id=a.siennatopic
        left join  ".$merchant.".prioridad e on e.id=a.prioridad
        where a.siennaestado not in('3','4')  
         and a.asignado='" . $idusuario . "' 

         union 

         select *,a.conversation_id,a.user_id,
        b.nombre as depto,b.id as iddepto,d.nombre topicnombre,convertirTiempo(a.created_at)  as creado,

        a.id as ticketid,c.nombre estadoname,d.nombre topicname,a.cel numerocel,a.asignado ,e.nombre as pri,e.id as prid
        from ".$merchant.".siennatickets a
        left join ".$merchant.".siennadepto b on b.id=a.siennadepto 
        left join  ".$merchant.".siennaestado c on c.id=a.siennaestado

        left join  ".$merchant.".siennatopic d on d.id=a.siennatopic
        left join  ".$merchant.".prioridad e on e.id=a.prioridad

        where a.siennaestado not in('3','4')  
         and a.asignado='99999'
         and a.siennadepto in (" . $final . ")

         order by ticketid desc
        ";
 
        $resultados = DB::select($query);
        return $resultados;
    }
    

    public function maxidjuntos(Request $request)
    {
        $idusuario = $request->idusuario;
        $empresa = $request->empresa;
        if($idusuario==1){
            $query2="select * from users where id='".$idusuario."'";
        }else{
            $query2="select * from users where id='".$idusuario."'";

        }
        $resultados2 = DB::select($query2);
        foreach($resultados2 as $val2){

            $areas=$val2->deptosuser;
            $tipousers=$val2->tipousers;
        }

        $merchant=$this->dominio();

        $pos = strpos($areas, ",");

            // Nótese el uso de ===. Puesto que == simple no funcionará como se espera
            // porque la posición de 'a' está en el 1° (primer) caracter.
            if ($pos === false) {
                $final="'".$areas."'";
               // echo "La cadena '$findme' no fue encontrada en la cadena '$mystring'";
            } else {
                
                $sepa=explode(",",$areas);
                $final="";
                foreach($sepa as $val){
                    $final.="'".$val."',";
                }
                $final=substr($final,0,-1);
            }
            
            if($tipousers==3){
                $query = "select *,a.created_at as fn,
                convertirTiempo(a.created_at) as nuevotiempo,d.sla,a.conversation_id,a.user_id,concat(e.nombre,' ',e.last_name) as nombreagente,
                b.nombre as depto,b.id as iddepto,d.nombre topicnombre,convertirTiempo(a.created_at) as creado,
                a.id as ticketid,c.nombre estadoname,d.nombre topicname,a.cel numerocel,a.asignado,f.nombre as pri ,f.id prid
                from ".$merchant.".siennatickets a
                left join ".$merchant.".siennadepto b on b.id=a.siennadepto 
                left join  ".$merchant.".siennaestado c on c.id=a.siennaestado
                left join  ".$merchant.".siennatopic d on d.id=a.siennatopic
                left join  ".$merchant.".users e on e.id=a.asignado
                left join  ".$merchant.".prioridad f on f.id=a.prioridad
               
        
                where a.siennaestado not in('3','4')  
                          and a.asignado='" . $idusuario . "' 

        
                 union 
        
                 select *,a.created_at as fn,
                 convertirTiempo(a.created_at) as nuevotiempo,
                 d.sla,a.conversation_id,a.user_id,concat(e.nombre,' ',e.last_name) as nombreagente,
                    b.nombre as depto,b.id as iddepto,d.nombre topicnombre,convertirTiempo(a.created_at)  as creado,
        
                    a.id as ticketid,c.nombre estadoname,d.nombre topicname,a.cel numerocel,a.asignado ,f.nombre as pri ,f.id prid
                    from ".$merchant.".siennatickets a
                    left join ".$merchant.".siennadepto b on b.id=a.siennadepto 
                    left join  ".$merchant.".siennaestado c on c.id=a.siennaestado
                    left join  ".$merchant.".siennatopic d on d.id=a.siennatopic
        
                    left join  ".$merchant.".users e on e.id=a.asignado
                    left join  ".$merchant.".prioridad f on f.id=a.prioridad
            
                    where a.siennaestado not in('3','4')  
                    and
                    a.asignado='99999' 
                    and a.siennadepto in (" . $final . ") 
                            order by ticketid desc
                    ";

                $querynu = "
                SELECT 
                    a.id AS ticketid,
                    a.created_at AS fn,
                    convertirTiempo(a.created_at) AS nuevotiempo,
                    d.sla,
                    a.conversation_id,
                    a.user_id,
                    CONCAT(e.nombre, ' ', e.last_name) AS nombreagente,
                    b.nombre AS depto,
                    b.id AS iddepto,
                    d.nombre AS topicnombre,
                    convertirTiempo(a.created_at) AS creado,
                    c.nombre AS estadoname,
                    d.nombre AS topicname,
                    a.cel AS numerocel,
                    a.asignado,
                    f.nombre AS pri,
                    f.id AS prid
                FROM 
                    ".$merchant.".siennatickets a
                LEFT JOIN ".$merchant.".siennadepto b ON b.id = a.siennadepto 
                LEFT JOIN ".$merchant.".siennaestado c ON c.id = a.siennaestado
                LEFT JOIN ".$merchant.".siennatopic d ON d.id = a.siennatopic
                LEFT JOIN ".$merchant.".users e ON e.id = a.asignado
                LEFT JOIN ".$merchant.".prioridad f ON f.id = a.prioridad
                WHERE 
                    a.siennaestado NOT IN ('3', '4') 
               
                    AND (
                        a.asignado = '".$idusuario."' 
                        OR (a.asignado = '99999' AND a.siennadepto IN (".$final."))
                    )
                ORDER BY 
                    ticketid DESC";
                
            }
            /*
            if ($tipousers == 3) {
                $query = "
                    SELECT *,
                        a.id AS ticketid,
                        a.created_at AS fn,
                        convertirTiempo(a.created_at) AS nuevotiempo,
                        d.sla,
                        a.conversation_id,
                        a.user_id,
                        CONCAT(e.nombre, ' ', e.last_name) AS nombreagente,
                        b.nombre AS depto,
                        b.id AS iddepto,
                        d.nombre AS topicnombre,
                        convertirTiempo(a.created_at) AS creado,
                        c.nombre AS estadoname,
                        d.nombre AS topicname,
                        a.cel AS numerocel,
                        a.asignado,
                        f.nombre AS pri,
                        f.id AS prid
                    FROM 
                        ${merchant}.siennatickets a
                    LEFT JOIN ${merchant}.siennadepto b ON b.id = a.siennadepto 
                    LEFT JOIN ${merchant}.siennaestado c ON c.id = a.siennaestado
                    LEFT JOIN ${merchant}.siennatopic d ON d.id = a.siennatopic
                    LEFT JOIN ${merchant}.users e ON e.id = a.asignado
                    LEFT JOIN ${merchant}.prioridad f ON f.id = a.prioridad
                    WHERE 
                        a.siennaestado NOT IN ('3', '4') 
                        AND a.empresa = ${empresa}
                        AND (
                            a.asignado = '${idusuario}' 
                            OR (a.asignado = '99999' AND a.siennadepto IN (${final}))
                        )
                    ORDER BY 
                        ticketid DESC;
                ";
            }
           
            if($tipousers == 2) {
                $query = "
                    SELECT a.*,
                        a.id AS ticketid,
                        a.created_at AS fn,
                        convertirTiempo(a.created_at) AS nuevotiempo,
                        d.sla,
                        a.conversation_id,
                        a.user_id,
                        CONCAT(e.nombre, ' ', e.last_name) AS nombreagente,
                        b.nombre AS depto,
                        b.id AS iddepto,
                        d.nombre AS topicnombre,
                        convertirTiempo(a.created_at) AS creado,
                        c.nombre AS estadoname,
                        d.nombre AS topicname,
                        a.cel AS numerocel,
                        a.asignado,
                        f.nombre AS pri,
                        f.id AS prid
                    FROM 
                        `{$merchant}`.siennatickets a
                    LEFT JOIN `{$merchant}`.siennadepto b ON b.id = a.siennadepto
                    LEFT JOIN `{$merchant}`.siennaestado c ON c.id = a.siennaestado
                    LEFT JOIN `{$merchant}`.siennatopic d ON d.id = a.siennatopic
                    LEFT JOIN `{$merchant}`.users e ON e.id = a.asignado
                    LEFT JOIN `{$merchant}`.prioridad f ON f.id = a.prioridad
                    WHERE 
                        a.siennaestado NOT IN ('3', '4') 
                        AND a.empresa = {$empresa}
                        AND (
                            a.asignado = '{$idusuario}' 
                            OR a.siennadepto IN ({$final})
                        )
                    ORDER BY 
                        ticketid DESC;
                ";
            
                $querynu = $query; // Reutilizamos la misma consulta si no hay diferencias.
            }
            */
            else{

                  $query = "select *,a.created_at as fn,
                convertirTiempo(a.created_at) as nuevotiempo,
                d.sla,a.conversation_id,a.user_id,concat(e.nombre,' ',e.last_name) as nombreagente,
                b.nombre as depto,b.id as iddepto,d.nombre topicnombre,convertirTiempo(a.created_at) as creado,
                a.id as ticketid,c.nombre estadoname,d.nombre topicname,a.cel numerocel,a.asignado,f.nombre as pri ,f.id prid
                from ".$merchant.".siennatickets a
                left join ".$merchant.".siennadepto b on b.id=a.siennadepto 
                left join  ".$merchant.".siennaestado c on c.id=a.siennaestado
                left join  ".$merchant.".siennatopic d on d.id=a.siennatopic
                left join  ".$merchant.".users e on e.id=a.asignado
                left join  ".$merchant.".prioridad f on f.id=a.prioridad
        
                where a.siennaestado not in('3','4')  
                 and a.asignado='" . $idusuario . "'
                 union 
        
                 select *,a.created_at as fn,
                 convertirTiempo(a.created_at) as nuevotiempo,d.sla,
                 
                 a.conversation_id,a.user_id,concat(e.nombre,' ',e.last_name) as nombreagente,
                b.nombre as depto,b.id as iddepto,d.nombre topicnombre,convertirTiempo(a.created_at)  as creado,
        
                a.id as ticketid,c.nombre estadoname,d.nombre topicname,a.cel numerocel,a.asignado ,f.nombre as pri ,f.id prid
                from ".$merchant.".siennatickets a
                left join ".$merchant.".siennadepto b on b.id=a.siennadepto 
                left join  ".$merchant.".siennaestado c on c.id=a.siennaestado
                left join  ".$merchant.".siennatopic d on d.id=a.siennatopic
        
                left join  ".$merchant.".users e on e.id=a.asignado
                left join  ".$merchant.".prioridad f on f.id=a.prioridad
        
                where a.siennaestado not in('3','4')  
                and a.siennadepto in (" . $final . ")
                 order by ticketid desc
                ";

                $querynu="
                                SELECT 
                    a.id AS ticketid,
                    a.created_at AS fn,
                    convertirTiempo(a.created_at) AS nuevotiempo,
                    d.sla,
                    a.conversation_id,
                    a.user_id,
                    CONCAT(e.nombre, ' ', e.last_name) AS nombreagente,
                    b.nombre AS depto,
                    b.id AS iddepto,
                    d.nombre AS topicnombre,
                    convertirTiempo(a.created_at) AS creado,
                    c.nombre AS estadoname,
                    d.nombre AS topicname,
                    a.cel AS numerocel,
                    a.asignado,
                    f.nombre AS pri,
                    f.id AS prid
                FROM 
                    `{$merchant}`.siennatickets a
                LEFT JOIN `{$merchant}`.siennadepto b ON b.id = a.siennadepto
                LEFT JOIN `{$merchant}`.siennaestado c ON c.id = a.siennaestado
                LEFT JOIN `{$merchant}`.siennatopic d ON d.id = a.siennatopic
                LEFT JOIN `{$merchant}`.users e ON e.id = a.asignado
                LEFT JOIN `{$merchant}`.prioridad f ON f.id = a.prioridad
                WHERE 
                    a.siennaestado NOT IN ('3', '4') 
                    AND a.empresa = {$empresa}
                    AND (
                        a.asignado = '{$idusuario}' 
                        OR a.siennadepto IN ({$final})
                    )
                ORDER BY 
                    ticketid DESC;
                ";

            }

            if($tipousers==1){
                $query = "select *,a.created_at as fn,
                convertirTiempo(a.created_at) as nuevotiempo,d.sla,a.cliente as cliente,a.conversation_id,a.user_id,concat(e.nombre,' ',e.last_name) as nombreagente,
                b.nombre as depto,b.id as iddepto,d.nombre topicnombre,convertirTiempo(a.created_at) as creado,
                a.id as ticketid,c.nombre estadoname,d.nombre topicname,a.cel numerocel,a.asignado,f.nombre as pri ,f.id prid
                from ".$merchant.".siennatickets a
                left join ".$merchant.".siennadepto b on b.id=a.siennadepto 
                left join  ".$merchant.".siennaestado c on c.id=a.siennaestado
                left join  ".$merchant.".siennatopic d on d.id=a.siennatopic
                left join  ".$merchant.".users e on e.id=a.asignado
                left join  ".$merchant.".prioridad f on f.id=a.prioridad
        
                where a.siennaestado not in('3','4')  
                order by ticketid desc
                ";

            }
 
        $resultados = DB::select($query);
        return $resultados;
    }
    public function cerrados(Request $request)
    {
        

        $ini=$request->inicio;
        $fin=$request->fin;
        $empresa=$request->empresa;
         $zona=$this->zona();
       
        $query = "select *,a.conversation_id,a.user_id,a.descripciondelcierre, 
        CONVERT_TZ(created_at, '+00:00', '".$zona.":00') as created_at2,
        CONVERT_TZ(t_cerrado, '+00:00', '".$zona.":00') as t_cerrado2,
        b.nombre as depto,b.id as iddepto,d.nombre topicnombre,
        (select concat(nombre,' ',last_name) as elasignado 
        from users where id=a.asignado) as elasignado,
        a.id as ticketid,c.nombre estadoname,d.nombre topicname,a.cel numerocel,a.asignado from siennatickets a
        left join siennadepto b on b.id=a.siennadepto 
        left join  siennaestado c on c.id=a.siennaestado

        left join  siennatopic d on d.id=a.siennatopic
        where a.siennaestado  in('4')  
     
        and
        CONVERT_TZ(created_at, '+00:00', '".$zona.":00') >='".$ini." 00:00:00'
         and 
         CONVERT_TZ(created_at, '+00:00', '".$zona.":00') <='".$fin." 23:59:59'
         
      
         

       

         order by ticketid desc
        ";
      
        $resultados = DB::select($query);
        return $resultados;
    }

    public function zona(){
        $merchant=$this->dominio();
        $query="select * from ".$merchant.".empresa ";
        $resultados = DB::select($query);
        $zone="";
        foreach($resultados as $val){
            $zone=$val->zona;

        }
        $horas=file_get_contents('https://ispgroup.suricata.cloud/api/difhora?zona='.$zone);
        return $horas;
    }
    public function datoscliente(Request $request)
    {
        $cliente = $request->cliente;
        if($cliente<>"{{idcustomer}}"){
             $query="select * from siennacliente where cliente='".$cliente."'";
            $resultados = DB::select($query);
            return $resultados;
        }else{
            return "";
        }

        
    }
    public function maxid2(Request $request)
    {
        $idusuario = $request->idusuario;
        $areas = $request->area;
        $merchant=$this->dominio();


        $query = "select *,a.conversation_id,a.user_id,concat(e.nombre,' ',e.last_name) as nombreagente,
        b.nombre as depto,b.id as iddepto,d.nombre topicnombre,convertirTiempo(a.created_at) as creado,
        a.id as ticketid,c.nombre estadoname,d.nombre topicname,a.cel numerocel,a.asignado,f.nombre as pri ,f.id prid
        from ".$merchant.".siennatickets a
        left join ".$merchant.".siennadepto b on b.id=a.siennadepto 
        left join  ".$merchant.".siennaestado c on c.id=a.siennaestado
        left join  ".$merchant.".siennatopic d on d.id=a.siennatopic
        left join  ".$merchant.".users e on e.id=a.asignado
        left join  ".$merchant.".prioridad f on f.id=a.prioridad

        where a.siennaestado not in('3','4')  
         

         union 

         select *,a.conversation_id,a.user_id,concat(e.nombre,' ',e.last_name) as nombreagente,
        b.nombre as depto,b.id as iddepto,d.nombre topicnombre,convertirTiempo(a.created_at)  as creado,

        a.id as ticketid,c.nombre estadoname,d.nombre topicname,a.cel numerocel,a.asignado ,f.nombre as pri ,f.id prid
        from ".$merchant.".siennatickets a
        left join ".$merchant.".siennadepto b on b.id=a.siennadepto 
        left join  ".$merchant.".siennaestado c on c.id=a.siennaestado
        left join  ".$merchant.".siennatopic d on d.id=a.siennatopic

        left join  ".$merchant.".users e on e.id=a.asignado
        left join  ".$merchant.".prioridad f on f.id=a.prioridad

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
        $extra1 = $request->extra1;
        $extra2 = $request->extra2;
        $extra3 = $request->extra3;
       
        if(isset($request->ostickettopic)){
            $ostickettopic=$request->ostickettopic;
            $resultados222 = siennatopic::where('ostickettopic', '=', $ostickettopic)->get();
            foreach ($resultados222 as $valuep) {
                $siennatopic = $valuep->id;
                
            }
          
        }else{
            $siennatopic = $request->siennatopic;

        }

        $deuda = $request->deuda;
        $s_status = $request->s_status;
        $a_status = $request->a_status;
        $address = $request->address;
        $ip = $request->ip;
        $nodo = $request->nodo;
        $asignado=0;
        if($request->siennasource=='5'){
            $asignado=99999;
        }

        $siebotchanel=siennasource::find($siennasource);
        $bot_channel=$siebotchanel->nombre;





        $si = new siennatickets();
        $si->siennadepto = $siennadepto;
        $si->extra1 = $extra1;
        $si->extra2 = $extra2;
        $si->extra3 = $extra3;
        
        $si->cliente = $cliente;
        $si->siennatopic = $siennatopic;
        $si->cedula = $cedula;
        $si->siennaestado = $siennaestado;
        $si->siennasource = $siennasource;
        $si->cel = $cel;
        $si->nya = $nya;
        $si->asignado = $asignado;
        if(isset($request->prioridad)){
            $si->prioridad= $request->prioridad;
        }
        if(isset($request->extras)){
            $si->extras= $request->extras;
        }
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
        $sc->ip = $ip;
        $sc->nodo = $nodo;
        try {
            $sc->save();
        } catch (\Illuminate\Database\QueryException $ex) {
           // echo "existe".$ex;
        }
        $merchant=$this->dominio();
        
        if($siennaestado==4){

            $url="https://suricata4.com.ar/api/closechat";
            $curl = curl_init();
            $data = array(
                "token" => "EDElDqlQf3RDP5EDK1pHhugV9M6aCXtwAm57SD0G5JYZjw7RxwZbbfdKMhWYdUUM",
                "idbot" => $merchant,
                "idconv" => $conversation_id            
            );
      
            // Set headers for the cURL request
            $headers = array(
                'Accept: application/json',
                'Content-Type: application/json',
                'Cookie: xenioo-id=Bearer+ZlHPzQ0ZfubwcHXAjjXMG0hDlJI22S1S0dqgKs0H7O06PghfV3BRy6Wxmn7PLb6RUmfIXRXiijo5X8E7%2flsAUV24IzaB28PYO%2bw90fEOTrp8Hx0WQCQ%2btq69lwpWUZpCg0ga2p%2bQD%2bI9KFMrCB6Ht%2bJM4ZOuekNf%2bYWtUBQ%2bm1prYPb8nDXWuRnU6qgtzr7zInbdRjyNhsdg41gTr7AstZ3sLt2wAXQS%2ba8zSGYe1UZY7gvoYm%2fGKj6TbvAdWnO0WXTVkwnB1jhMbWDX38PYGt2jkNoaUXRWxncuQSxJRzUIBWuTJGju%2b7EZOaoK07cXNk%2bUPBMSV1Q9gV6Gzc8CkA%3d%3d',
            );
         
                  $url="https://suricata4.com.ar/api/closechat?token=EDElDqlQf3RDP5EDK1pHhugV9M6aCXtwAm57SD0G5JYZjw7RxwZbbfdKMhWYdUUM&idbot=".$merchant."&idconv=".$conversation_id."&bot_channel=".$bot_channel;
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
      
          // dd($response);   
            // Close the cURL resource
            curl_close($curl);
    
        }


      


        return $si->id;
        //return response()->json(['cliente' => $return2]);

    }

    
    public function telefonia(Request $request){
        $necesito=$request->ip;

         $urlprin="https://suricata99.llamadaip.org/firewall/iptables-varios2.php?ip=".$necesito."&estado=ON";

        // Set headers for the cURL request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Return data inplace of echoing on screen
        curl_setopt($ch, CURLOPT_URL, $urlprin);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // Skip SSL Verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // Skip SSL Verification
        $rsData = curl_exec($ch);
        curl_close($ch); 
        //dd($rsData);
        $merchant=$this->dominio();

        $logintelefonia =new logintelefonia();
        $logintelefonia->user=0;
        $logintelefonia->ip=$necesito;
        $logintelefonia->estado=1;
        $logintelefonia->merchant=$merchant;
        $logintelefonia->save();

        return $rsData ;
    }

    public function notelefonia(Request $request){
        $necesito=$request->ip;

         $urlprin="https://suricata99.llamadaip.org/firewall/iptables-varios2.php?ip=".$necesito."&estado=OFF";

        // Set headers for the cURL request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Return data inplace of echoing on screen
        curl_setopt($ch, CURLOPT_URL, $urlprin);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // Skip SSL Verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // Skip SSL Verification
        $rsData = curl_exec($ch);
        curl_close($ch); 
        //dd($rsData);
        $merchant=$this->dominio();

        $logintelefonia =new logintelefonia();
        $logintelefonia->user=0;
        $logintelefonia->ip=$necesito;
        $logintelefonia->estado=1;
        $logintelefonia->merchant=$merchant;
        $logintelefonia->save();

        return $rsData ;
    }
    public function valida($cliente,$merchant){
        $valida=0;

        $query="select id from ".$merchant.".siennatickets where cliente='".$cliente."'  and siennaestado<>'4'";
        $resultados = DB::select($query);

        foreach($resultados as $val){
            $valida=$val->id;
        }

        return $valida;
    }
    public function validadepto($cliente,$merchant,$ostt){
        $valida=0;

       
        $resultados222 = siennatopic::where('ostickettopic', '=', $ostt)->get();
        foreach ($resultados222 as $valuep) {
            $siennatopic = $valuep->id;
            $siennadepto = $valuep->siennadepto;
            
        }
        
        $query="select id from ".$merchant.".siennatickets 
        where cliente='".$cliente."' 
        and siennadepto='".$siennadepto."'
        and siennaestado<>'4'";
        $resultados = DB::select($query);

        foreach($resultados as $val){
            $valida=$val->id;
        }

    

        return $valida;
    }
    public function creartickessiennacharlie2(Request $request)
    {

        echo "aca";
    }
    public function creartickessiennacharlie(Request $request)
    {
        $cel = $request->cel;//callid
        $tel = $request->tel;//telcontacto
        $siennaestado = $request->siennaestado;
        $siennasource = "5";
        $cliente = $request->cliente;
        $nya = $request->nya;
        $merchant = $request->merchant;
        if(isset($request->cedula)){
            $cedula=$request->cedula;
        }else{
            $cedula="";
        }
        $valida = $this->valida($cliente,$merchant);//telcontacto
        if($valida>0){

            return '{"error":"true","ticket":"'.$valida.'"}';
        }
        if($request->ostickettopic<>""){
            $ostickettopic=$request->ostickettopic;
            $resultados222 = siennatopic::where('ostickettopic', '=', $ostickettopic)->get();
            foreach ($resultados222 as $valuep) {
                $siennatopic = $valuep->id;
                $siennadepto = $valuep->siennadepto;
                
                
            }
          
        }else{
              $siennatopic = $request->siennatopic;
            $resultados222 = siennatopic::where('id', '=', $siennatopic)->get();
        // dd($resultados222);
            foreach ($resultados222 as $valuep) {
                $siennatopic = $valuep->id;
                $siennadepto = $valuep->siennadepto;
            }

        }

        $asignado=0;
      

        $siebotchanel=siennasource::find($siennasource);
        $bot_channel=$siebotchanel->nombre;





        $si = new siennatickets();
        $si->siennadepto = $siennadepto;
        $si->cliente = $cliente;
        $si->nya = $nya;
        $si->cedula = $cedula;
        $si->siennatopic = $siennatopic;
        $si->siennaestado = $siennaestado;
        $si->siennasource = $siennasource;
        $si->asignado = "99999";
        $si->cel = $cel;
        $si->tel = $tel;
        
        if(isset($request->prioridad)){
            $si->prioridad= $request->prioridad;
        }
        if(isset($request->extras)){
            $si->extras= $request->extras;
        }
       
        ///getdata
        $si->save();

        $se = new siennaseguimientos();
        $se->ticket = $si->id;
        $se->tipo = "1";
        $se->descripcion = "created";
        $se->autor = "sistema";
        $se->save();

       



        $sc = new siennacliente();
        if ($cliente <> '') {

            $sc->cliente = $cliente;
        } else {

            $sc->cliente = "";
        }
        $sc->cel = $cel;
        $sc->nya = $nya;
    
        try {
            $sc->save();
        } catch (\Illuminate\Database\QueryException $ex) {
           // echo "existe".$ex;
        }
        $merchant=$this->dominio();
        
        if($siennaestado==40){

            $url="https://suricata4.com.ar/api/closechat";
            $curl = curl_init();
            $data = array(
                "token" => "EDElDqlQf3RDP5EDK1pHhugV9M6aCXtwAm57SD0G5JYZjw7RxwZbbfdKMhWYdUUM",
                "idbot" => $merchant,
                "idconv" => $conversation_id            
            );
      
            // Set headers for the cURL request
            $headers = array(
                'Accept: application/json',
                'Content-Type: application/json',
                'Cookie: xenioo-id=Bearer+ZlHPzQ0ZfubwcHXAjjXMG0hDlJI22S1S0dqgKs0H7O06PghfV3BRy6Wxmn7PLb6RUmfIXRXiijo5X8E7%2flsAUV24IzaB28PYO%2bw90fEOTrp8Hx0WQCQ%2btq69lwpWUZpCg0ga2p%2bQD%2bI9KFMrCB6Ht%2bJM4ZOuekNf%2bYWtUBQ%2bm1prYPb8nDXWuRnU6qgtzr7zInbdRjyNhsdg41gTr7AstZ3sLt2wAXQS%2ba8zSGYe1UZY7gvoYm%2fGKj6TbvAdWnO0WXTVkwnB1jhMbWDX38PYGt2jkNoaUXRWxncuQSxJRzUIBWuTJGju%2b7EZOaoK07cXNk%2bUPBMSV1Q9gV6Gzc8CkA%3d%3d',
            );
         
                  $url="https://suricata4.com.ar/api/closechat?token=EDElDqlQf3RDP5EDK1pHhugV9M6aCXtwAm57SD0G5JYZjw7RxwZbbfdKMhWYdUUM&idbot=".$merchant."&idconv=".$conversation_id."&bot_channel=".$bot_channel;
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
      
          // dd($response);   
            // Close the cURL resource
            curl_close($curl);
    
        }


      

        //return '{"error":"false","ticket":"11"}';
        return '{"error":"false","ticket":"'.$si->id.'"}';

        //return response()->json(['cliente' => $return2]);

    }

    public function creartickessiennacharliedepto(Request $request)
    {
        $cel = $request->cel;//callid
        $tel = $request->tel;//telcontacto
        $siennaestado = $request->siennaestado;
        $siennasource = "5";
        $cliente = $request->cliente;
        $nya = $request->nya;
        if(isset($request->cedula)){
            $cedula = $request->cedula;

        }else{
            $cedula = "2";

        }
        $merchant = $request->merchant;
        if($request->ostickettopic<>""){

            $consulta=$request->ostickettopic;

        }else{
            $consulta = $request->siennatopic;

        }

        $valida = $this->validadepto($cliente,$merchant,$consulta);//telcontacto
        if($valida>0){

            return '{"error":"true","ticket":"'.$valida.'"}';
        }
        if($request->ostickettopic<>""){
            $ostickettopic=$request->ostickettopic;
            $resultados222 = siennatopic::where('ostickettopic', '=', $ostickettopic)->get();
            foreach ($resultados222 as $valuep) {
                $siennatopic = $valuep->id;
                $siennadepto = $valuep->siennadepto;
                
                
            }
          
        }else{
              $siennatopic = $request->siennatopic;
            $resultados222 = siennatopic::where('id', '=', $siennatopic)->get();
        // dd($resultados222);
            foreach ($resultados222 as $valuep) {
                $siennatopic = $valuep->id;
                $siennadepto = $valuep->siennadepto;
            }

        }

        $asignado=0;
      

        $siebotchanel=siennasource::find($siennasource);
        $bot_channel=$siebotchanel->nombre;





        $si = new siennatickets();
        $si->siennadepto = $siennadepto;
        $si->cliente = $cliente;
        $si->nya = $nya;
        $si->cedula = $cedula;
        $si->siennatopic = $siennatopic;
        $si->siennaestado = $siennaestado;
        $si->siennasource = $siennasource;
        $si->asignado = "99999";
        $si->cel = $cel;
        $si->tel = $tel;
        
        if(isset($request->prioridad)){
            $si->prioridad= $request->prioridad;
        }
        if(isset($request->extras)){
            $si->extras= $request->extras;
        }
       

        $si->save();

        $se = new siennaseguimientos();
        $se->ticket = $si->id;
        $se->tipo = "1";
        $se->descripcion = "created";
        $se->autor = "sistema";
        $se->save();

       



        $sc = new siennacliente();
        if ($cliente <> '') {

            $sc->cliente = $cliente;
        } else {

            $sc->cliente = "";
        }
        $sc->cel = $cel;
        $sc->nya = $nya;
    
        try {
            $sc->save();
        } catch (\Illuminate\Database\QueryException $ex) {
           // echo "existe".$ex;
        }
        $merchant=$this->dominio();
        
        if($siennaestado==40){

            $url="https://suricata4.com.ar/api/closechat";
            $curl = curl_init();
            $data = array(
                "token" => "EDElDqlQf3RDP5EDK1pHhugV9M6aCXtwAm57SD0G5JYZjw7RxwZbbfdKMhWYdUUM",
                "idbot" => $merchant,
                "idconv" => $conversation_id            
            );
      
            // Set headers for the cURL request
            $headers = array(
                'Accept: application/json',
                'Content-Type: application/json',
                'Cookie: xenioo-id=Bearer+ZlHPzQ0ZfubwcHXAjjXMG0hDlJI22S1S0dqgKs0H7O06PghfV3BRy6Wxmn7PLb6RUmfIXRXiijo5X8E7%2flsAUV24IzaB28PYO%2bw90fEOTrp8Hx0WQCQ%2btq69lwpWUZpCg0ga2p%2bQD%2bI9KFMrCB6Ht%2bJM4ZOuekNf%2bYWtUBQ%2bm1prYPb8nDXWuRnU6qgtzr7zInbdRjyNhsdg41gTr7AstZ3sLt2wAXQS%2ba8zSGYe1UZY7gvoYm%2fGKj6TbvAdWnO0WXTVkwnB1jhMbWDX38PYGt2jkNoaUXRWxncuQSxJRzUIBWuTJGju%2b7EZOaoK07cXNk%2bUPBMSV1Q9gV6Gzc8CkA%3d%3d',
            );
         
                  $url="https://suricata4.com.ar/api/closechat?token=EDElDqlQf3RDP5EDK1pHhugV9M6aCXtwAm57SD0G5JYZjw7RxwZbbfdKMhWYdUUM&idbot=".$merchant."&idconv=".$conversation_id."&bot_channel=".$bot_channel;
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
      
          // dd($response);   
            // Close the cURL resource
            curl_close($curl);
    
        }


      

        //return '{"error":"false","ticket":"11"}';
        return '{"error":"false","ticket":"'.$si->id.'"}';

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
    public function deptos(Request $request)
    {
        $depto = $request->depto;
        $resultados = "";
        $query = "select s.id,s.nombre,   a.Monday,a.Tuesday,a.Wednesday ,a.Thursday ,a.Friday ,a.Saturday ,a.Sunday  from categoria a join siennadepto s  on
        a.area =s.id ";
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
        $antdepto=$si2->siennadepto;
        $si2->siennadepto = $statos;
        $si2->asignado = 0;
        $si2->save();





        $depto = siennadepto::find($statos);

        $behaviour = $depto->behaviour;
        $interaction = $depto->interaction;
        $nombrearea = $depto->nombre;

        $deptoant = siennadepto::find($antdepto);

        $se = new siennaseguimientos();
        $se->ticket = $idticketdepto;
        $se->tipo = "3";
        $se->descripcion = $deptoant->nombre." =>" . $nombrearea;
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
    public function cambiardeptosienna20(Request $request)
    {

        echo   $ticketss = $request->ticketss;
        echo   $statos = $request->statos;

        $idconv = $request->idconv;
        $idbot = $request->idbot;
        $user_id = $request->user_id;
        $bot_channel = $request->bot_channel;
        $logeado = $request->logeado;

        $sep=explode(",",$ticketss);
        foreach($sep as $val){

            if($val<>""){

                $si2 = siennatickets::find($val);
                $antdepto=$si2->siennadepto;
                $si2->siennadepto = $statos;
                $si2->asignado = 0;
                $si2->save();

                $deptoant = siennadepto::find($antdepto);
                $depto = siennadepto::find($statos);

                $behaviour = $depto->behaviour;
                $interaction = $depto->interaction;
                $nombrearea = $depto->nombre;

                $se = new siennaseguimientos();
                $se->ticket = $val;
                $se->tipo = "3";
                $se->descripcion = $deptoant->nombre." =>" . $nombrearea;
                $se->autor = $logeado;
                $se->save();

            }
        }

       

        return redirect()
            ->back()
            ->with('success', 'Se modifico el departamento  correctamente!');
    }
    public function cambiardeptosienna202(Request $request)
    {

        echo   $ticketss = $request->ticketss;
        echo   $statos = $request->statos;

        $idconv = $request->idconv;
        $idbot = $request->idbot;
        $user_id = $request->user_id;
        $bot_channel = $request->bot_channel;
        $logeado = $request->logeado;

       

                $si2 = siennatickets::find($ticketss);
                $antdepto=$si2->siennadepto;
                $si2->siennadepto = $statos;
                //$si2->asignado = 0;
                $si2->save();

                $deptoant = siennadepto::find($antdepto);
                $depto = siennadepto::find($statos);

                $behaviour = $depto->behaviour;
                $interaction = $depto->interaction;
                $nombrearea = $depto->nombre;

                $se = new siennaseguimientos();
                $se->ticket = $ticketss;
                $se->tipo = "3";
                $se->descripcion = $deptoant->nombre." =>" . $nombrearea;
                $se->autor = $logeado;
                $se->save();

            
        

       

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

    public function pedir20(Request $request)
    {

        //echo   $idticketpedir = $request->idticketpedir;

        echo   $usuarioticket = $request->usuarioticket;

        echo   $ticketss = $request->ticketss;
        $logeado = $request->logeado;

        $sep=explode(",",$ticketss);
        foreach($sep as $val){

            if($val<>""){
                $si2 = siennatickets::find($val);
                $si2->asignado = $usuarioticket;
                $si2->save();

                $se = new siennaseguimientos();
                $se->ticket = $val;
                $se->tipo = "4";
                $se->descripcion = "asignado ";
                $se->autor = $logeado;
                $se->save();

            }

        }


        


        



        



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

        $merchant=$this->dominio();
        if (isset($request->logo)) {
            $logo = $request->file('logo');
           // dd($logo);
          //  $content = file_get_contents($url);
    
    
            $archi=Str::of($logo)->basename();
            $ruta=$merchant."/seguimientos";
            $logo= Storage::disk('do')->put($ruta, $logo);
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

        $idcustomer=$request->cliente;
        $merchant =$this->dominio();            echo "<br>";

          $query4 = "select * from ".$merchant.".siennaintegracion";            echo "<br>";

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

             $url = $val->headerlogin;            echo "<br>";

            $tokensienna = $val->tokensienna;            echo "<br>";

            $campo = $val->headerendpoint;            echo "<br>";

        }

        if ($url <> "") {
            $campos = explode(",", $campo);
             $urlfinal="https://" . $merchant . "." . $url . "/api/ws?token=" . $tokensienna . "&" . $campos[0] . "=" . $idcustomer;
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


    
    public function siennasource(Request $request)
    {
       
        $resultados = "";
        $query = "select * from siennasource  ";
        $resultados = DB::select($query);
        return $resultados;
    }

    public function cerradoscant(Request $request)
    {
        $ini=$request->ini;
        $fin=$request->fin;
        $resultados = "";
        $dom=$this->dominio();
         $query = "select count(*) as cantidadtickets2  from ".$dom.".siennatickets where siennaestado=4 and
        created_at>='".$ini." 00:00:00' and created_at<='".$fin." 23:59:59'  ";
        $resultados = DB::select($query);
        return $resultados;
    }

    
    public function abiertoscant2(Request $request)
    {
        $ini=$request->ini;
        $fin=$request->fin;
        $resultados = "";
        $dom=$this->dominio();
         $query = "select count(*) as cantidadtickets2  from ".$dom.".siennatickets where siennaestado<>4   ";
        $resultados = DB::select($query);
        return $resultados;
    }
    


    ///dashboard del dia
    public function ticketxdepto(Request $request)
    {
   
        $resultados = "";
        $dom=$this->dominio();
        $query="select count(*) as cant ,s.nombre  as name
        from ".$dom.".siennatickets a 
        join ".$dom.".siennadepto s 
        on s.id=a.siennadepto 
        where siennaestado<>4
   
         group by siennadepto";
        $resultados = DB::select($query);
        return $resultados;
    }
    public function ticketxestado(Request $request)
    {
   
        $resultados = "";
        $dom=$this->dominio();
        $query="select count(*) as cant ,s.nombre  as name
        from ".$dom.".siennatickets a 
        join ".$dom.".siennaestado s 
        on s.id=a.siennaestado
        where siennaestado<>4
   
         group by siennaestado";
        $resultados = DB::select($query);
        return $resultados;
    }
    public function ticketxtopic(Request $request)
    {
   
        $resultados = "";
        $dom=$this->dominio();
        $query="select count(*) as cant ,s.nombre  as name
        from ".$dom.".siennatickets a 
        join ".$dom.".siennatopic s 
        on s.id=a.siennatopic
        where siennaestado<>4
   
         group by siennatopic";
        $resultados = DB::select($query);
        return $resultados;
    }
    public function ticketxcanal(Request $request)
    {
   
        $resultados = "";
        $dom=$this->dominio();
        $query="select count(*) as cant ,s.nombre  as name
        from ".$dom.".siennatickets a 
        join ".$dom.".siennasource s 
        on s.id=a.siennasource
        where siennaestado<>4
   
         group by siennasource";
        $resultados = DB::select($query);
        return $resultados;
    }
    
    public function ticketxagente(Request $request)
    {
   
        $resultados = "";
        $dom=$this->dominio();
        $query="select count(*) as cant ,s.nombre  as name
        from ".$dom.".siennatickets a 
        join ".$dom.".users s 
        on s.id=a.asignado
        where siennaestado<>4
   
         group by asignado";
        $resultados = DB::select($query);
        return $resultados;
    }

    ///reportes por fecha

    public function ticketxdeptofecha(Request $request)
    {
        $ini=$request->ini;
        $fin=$request->fin;
        $resultados = "";
        $dom=$this->dominio();
        $query="select count(*) as cant ,s.nombre  as name
        from ".$dom.".siennatickets a 
        join ".$dom.".siennadepto s 
        on s.id=a.siennadepto 
        where 
        a.created_at>='".$ini." 00:00:00' and a.created_at<='".$fin." 23:59:59'
   
         group by siennadepto";
        $resultados = DB::select($query);
        return $resultados;
    }
    public function ticketxestadofecha(Request $request)
    {
        $ini=$request->ini;
        $fin=$request->fin;
        $resultados = "";
        $dom=$this->dominio();
        $query="select count(*) as cant ,s.nombre  as name
        from ".$dom.".siennatickets a 
        join ".$dom.".siennaestado s 
        on s.id=a.siennaestado
        where 
        a.created_at>='".$ini." 00:00:00' and a.created_at<='".$fin." 23:59:59'
   
         group by siennaestado";
        $resultados = DB::select($query);
        return $resultados;
    }
    public function ticketxtopicfecha(Request $request)
    {
        $ini=$request->ini;
        $fin=$request->fin;
        $resultados = "";
        $dom=$this->dominio();
        $query="select count(*) as cant ,s.nombre  as name
        from ".$dom.".siennatickets a 
        join ".$dom.".siennatopic s 
        on s.id=a.siennatopic
        where 
        a.created_at>='".$ini." 00:00:00' and a.created_at<='".$fin." 23:59:59'
   
         group by siennatopic";
        $resultados = DB::select($query);
        return $resultados;
    }
    public function ticketxcanalfecha(Request $request)
    {
        $ini=$request->ini;
        $fin=$request->fin;
        $resultados = "";
        $dom=$this->dominio();
        $query="select count(*) as cant ,s.nombre  as name
        from ".$dom.".siennatickets a 
        join ".$dom.".siennasource s 
        on s.id=a.siennasource
        where 
        a.created_at>='".$ini." 00:00:00' and a.created_at<='".$fin." 23:59:59'
   
         group by siennasource";
        $resultados = DB::select($query);
        return $resultados;
    }
    
    public function ticketxagentefecha(Request $request)
    {
        $ini=$request->ini;
        $fin=$request->fin;
        $resultados = "";
        $dom=$this->dominio();
        $query="select count(*) as cant ,s.nombre  as name
        from ".$dom.".siennatickets a 
        join ".$dom.".users s 
        on s.id=a.asignado
        where 
        a.created_at>='".$ini." 00:00:00' and a.created_at<='".$fin." 23:59:59'
   
         group by asignado";
        $resultados = DB::select($query);
        return $resultados;
    }


    
    public function ticketxmotivocfecha(Request $request)
    {
        $ini=$request->ini;
        $fin=$request->fin;
        $resultados = "";
        $dom=$this->dominio();
        $query="select count(*) as cant ,s.nombre  as name
        from ".$dom.".siennatickets a 
        join ".$dom.".motivoc s 
        on s.id=a.motivoc
        where 
        a.created_at>='".$ini." 00:00:00' and a.created_at<='".$fin." 23:59:59'
   
         group by motivoc";
        $resultados = DB::select($query);
        return $resultados;
    }


    public function logeados(Request $request)
    {
        
        $resultados = "";
        $dom=$this->dominio();
        $query="        
        select concat(u.nombre,' ',u.last_name) as usu,s2.nombre as area ,t.nombre as tipo,convertirTiempo(s.created_at) as  inicio 
         from ".$dom.".siennaloginxenioo s
        join ".$dom.".users u on u.id=s.idusuario 
        join ".$dom.".siennadepto s2 on s2.id =s.areas 
        join ".$dom.".tipousers t on t.id=u.tipousers 
        where s.login =1 and u.tipousers <>'1'
        order by s2.nombre desc";
        $resultados = DB::select($query);
        return $resultados;
    }
    
    public function preguntas(Request $request)
    {
        
        $resultados = "";
        $dom=$this->dominio();
        $tipo=$request->tipo;
        $token=$request->token;
        if($token<>"35PTuqhHKY1mfMfDbcuXJ2Qvwfwmr2MttDF93ZQb00GhIIRZ13OPd8l0TMmS20bj"){
            return "token incorrecto";
        }
        $query="        
        select *
         from ".$dom.".csatp where nombre='".$tipo."'";
        $resultados = DB::select($query);
        return $resultados;
    }
    public function preguntas2(Request $request)
    {
        
        $resultados = "";
        $dom=$this->dominio();
        $tipo=$request->tipo;
        $r1=$request->r1;
        $r2=$request->r2;
        $r3=$request->r3;
        $ticket=$request->ticket;
        $token=$request->token;
        if($token<>"35PTuqhHKY1mfMfDbcuXJ2Qvwfwmr2MttDF93ZQb00GhIIRZ13OPd8l0TMmS20bj"){
            return "token incorrecto";
        }
        $query="        
        INSERT INTO ".$dom.".csat ( nombre, r1, r2, r3, csat, ticket, userid) VALUES('".$tipo."', ".$r1.", ".$r2.", ".$r3.", '', '".$ticket."', '')";
        $resultados = DB::select($query);
        return $resultados;
    }
    public function ctx(Request $request){


        $tok=$request->token;
        $dom=$request->dom;
         $query="select * from ".$dom.".siennainternos  where token='".$tok."'";
        $resultados = DB::select($query);
        $return="";
        foreach($resultados as $value){
            $display=$value->display;
            $pass=$value->pass;
            $realm=$value->realm;
            $interno=$value->interno;
            $ws=$value->ws;

        }
        if(isset($display)){
           // echo $display;
            return response()->json(['User' => $interno, 'Pass' => $pass, 'Realm' => $realm, 'Display' => $display, 'WSServer' => $ws]);

        }else{
           // echo "ne";
            return response()->json(['error' => "token incorrecto"]);

        }
      

    }

    //fin de reportes por fecha


    public function historico(Request $request)
    {
        $cliente=$request->cliente;
        $resultados = "";
        $dom=$this->dominio();
        $query="select *,b.nombre nombreestado,c.nombre nombredepto,a.user_id, a.id as ticketid,
        a.id ticketid,d.nombre siennatopicnombre,a.nya nya from ".$dom.".siennatickets a 
        left join ".$dom.".siennaestado b on b.id=a.siennaestado
        left join ".$dom.".siennadepto c on c.id=a.siennadepto
        left join ".$dom.".siennatopic d on d.id=a.siennatopic
        where cliente='".$cliente."'
        order by a.id desc
        ";
        $resultados = DB::select($query);
        return $resultados;
    }


    public function difhora(Request $request){

         $zona=$request->zona;
       
        $fecha1 = Carbon::create(Carbon::now($zona) );
        $fecha11=$fecha1->format('Y-m-d H:i:s');
    
        $fecha2 = Carbon::create(Carbon::now('UTC'));
       $fecha22=$fecha2->format('Y-m-d H:i:s');
  

     $fecha111 = Carbon::parse($fecha11);
     $fecha222 = Carbon::parse($fecha22);
     
     // Calcular la diferencia entre las fechas en horas
     if($fecha111> $fecha222){
        $diferencia = $fecha222->diffInHours($fecha111);
     }else{
      
        $diferencia = $fecha111->diffInHours($fecha222);
        $diferencia =$diferencia *-1;
     }
     
     return $diferencia;
     // Imprimir la diferencia en horas


     }
     public function prioridad(Request $request){

        echo   $idticketestadoprioridad = $request->idticketestadoprioridad;
        echo "<br>";
        echo   $statos = $request->statos;
        echo "<br>";
           $idconv = $request->idconv;
           $idbot = $request->idbot;
        $user_id = $request->user_id;
        //$user_id=str_replace("+","",$user_id);
           $bot_channel = $request->bot_channel;
        $logeado = $request->logeado;
        $si2 = siennatickets::find($idticketestadoprioridad);
        $si2->prioridad = $statos;
       // $si2->asignado = 0;
        $si2->save();
        echo "<br>";
        $se = new siennaseguimientos();
        $se->ticket = $idticketestadoprioridad;
        $se->tipo = "9";
        $se->descripcion = "modificar prioridad:" ;
        $se->autor = $logeado;
        $se->save();
        return redirect()
        ->back()
        ->with('success', 'Se modifico la Prioridad  correctamente!');

     }
     
     public function mandarmail(Request $request){

          $mail=$request->mail;
          $cc=$request->cc;
          $cc2="";
          if (strpos($cc, ',') !== false) {
            $sep=explode(",",$cc);
            foreach($sep as $val){
                if($val<>''){
                     $cc2.=$val.",";
                }
            }
            $cc3= substr($cc2,0,-1);

        }else{
            $cc3=$cc;

        }

        //echo $cc3;
         

        $texto=$request->texto;
        $texto = preg_replace('/<input\b[^>]*\bdata-formula="e=mc\^2"[^>]*>/', '', $texto);

        $ticket=$request->ticket;
        $merchant=$request->merchant;
        $subject=$request->subject;
        $for=$mail;
        //"kayser95@hotmail.com";
       // $cc=array('kayser1712@gmail.com','luis.cornejo@suricata.la');


        Mail::mailer('suricata')
                ->send('mailsienna', ["fields2" => $texto], function ($msj) use ($subject,$for, $cc3) {
            $msj->from("support@suricata.la", "soporte");
            $msj->subject($subject);
            $msj->to($for);
            if($cc3!=null){
                $msj->cc($cc3);

            }
        });


        $si2 = new siennamail();
        $si2->siennatickets = $ticket;

        $si2->cuerpo = $texto;
        $si2->autor =1;
        $si2->from ="support@suricata.la";
        $si2->save();

        $si3 = siennatickets::find($ticket);
        $si3->estadoconv =0;
        $si3->save();
        return $ticket;
     }
     public function motic(Request $request){

        $siennadepto=$request->depto;
        $dom=$this->dominio();
       
         $query="select *  from ".$dom.".motivoc 
        where ((siennadepto='".$siennadepto."')  or(siennadepto='0'))
        "; 
        $resultados = DB::select($query);
        return $resultados;
        
     }
     
     
     public function estadoconv(Request $request){

        $tick=$request->tick;
        $dom=$this->dominio();
       
         $query="select *  from ".$dom.".siennatickets  where id='".$tick."'"; 
        $resultados = DB::select($query);
        $ec=0;
        foreach($resultados as $val){
            $ec=$val->estadoconv;

        }
        return $ec;
        
     }
     
     public function estadoconv2(Request $request){

        $conversation_id=$request->conversation_id;
        $dom=$this->dominio();
       
        // $query="select *  from ".$dom.".siennatickets  where id='".$tick."'"; 

         $query="select tipo from conversations_".$dom." ca where ca.conversationsid ='".$conversation_id."'
         and tipo in ('0','1')
         order by ca.created_at  desc
         limit 1";
        

         //si es distinta a 1 aa otra base
         $fields2 = DB::connection('pgsql')->select($query); 
                $ec=0;
        foreach($resultados as $val){
            $ec=$val->tipo;

        }
        return $ec;
        
     }
     
     public function getdata2(Request $request){

        $cliente=$request->cliente;
        $domi=$this->dominio();
        $numcli=$cliente;
        $inte=siennaintegracion::all();
        $getdata=siennagetdata::all();
       
       foreach($inte as $val){
        $urlinte=$val->version;
        $nom=$val->nombre;
    }
        $urlinte2=$urlinte.$numcli;
      
        if (($datosonline = @file_get_contents($urlinte2)) === false) {
            $error = error_get_last();
            //echo "HTTP request failed. Error was: " . $error['message'];
            $urlinte2="";

      } else {
           // echo "Everything went better than expected";
      }
  //   echo $datosonline;
   // dd("hola");
     $array_data = json_decode($datosonline, true);
     if($nom="mikrowisp"){
        $return=array();
        $data = json_decode($datosonline);

        // Acceder al campo national_id
        foreach($getdata as $val){
            $nombre=$val->nombre;
            $icono=$val->icono;
           $valor=$val->valor;

           $valor=str_replace(".","->",$valor);
           $keys = explode("->", $valor);

           // Variable temporal para iterar a través del objeto
           $result = $data;
           
           foreach ($keys as $key) {
               // Verificar que el nivel actual exista en el objeto para evitar errores
               if (isset($result->$key)) {
                   $result = $result->$key;
               } else {
                   // Si el nivel no existe, establece null y detén la búsqueda
                   $result = null;
                   break;
               }
           }
           $arraydatos=array("nombre"=>$nombre,"icono"=>$icono,"valor"=>$result);
           array_push($return,$arraydatos);
        }
        return $return;

     }
     $return=array();
     //print_r($array_data);
      foreach($getdata as $val){
          $nombre=$val->nombre;
          $icono=$val->icono;
         $valor=$val->valor;

        if (strpos($valor, '.') !== false) {
            $separado=explode(".",$valor);
            $valordevuelto = $array_data[$separado[0]][0][$separado[1]];

        } else {
            $valordevuelto = $array_data[$valor];
        }
        // Obtener el valor de la clave 'tax_residence'
        $arraydatos=array("nombre"=>$nombre,"icono"=>$icono,"valor"=>$valordevuelto);
        array_push($return,$arraydatos);
      }
     // dd($return);
        return $return;
     }

     
     public function buscarvalor($array, $valor) {
        foreach ($array as $key => $value) {
            if ($value === $valor) {
                return true;
            } elseif (is_array($value)) {
                if ($this->buscarvalor($value, $valor)) {
                    return true;
                }
            }
        }
        return false;
    }

    
    public function tokennn(Request $request){

        $idusuario=$request->idusuario;
        $dom=$this->dominio();
       
        // $query="select *  from ".$dom.".siennatickets  where id='".$tick."'"; 

         $query="select token from siennainternos ca where ca.users ='".$idusuario."'";
         $resultados = DB::select($query);
         $tok="";
         foreach($resultados as $val){
            $tok=$val->token;

         }

        return $tok;
        
     }

     public function actasignado(Request $request){

        $idusuario=$request->idusuario;
        $idticket=$request->idticket;
        $datos=siennatickets::find($idticket);
        $datos->asignado=$idusuario;
        $datos->save();

     }

     
     public function creariclass(Request $request){

        $tokensienna=$request->tokensienna;
        $dom=$request->dom;
        $cliente=$request->cliente;
        $nodo=$request->nodo;
        $tipo=$request->tipo;
        $detalle=$request->detalle;
        $nameCustomer=$request->nameCustomer;
        $contactPhone=$request->contactPhone;
        $mobilePhone=$request->mobilePhone;
        $email=$request->email;
        $address=$request->address;
        $neighborhood=$request->neighborhood;
        $city=$request->city;
        $state=$request->state;
        $country=$request->country;
        $latitude=$request->latitude;
        $longitude=$request->longitude;

        $now = Carbon::now();
        $fe=$now->format('Y-m-d H:i:s');
        $codeSO=$cliente."_".$fe;
        $url="https://".$dom.".suricata-custom.com.ar/api/iclass_create_so?token=".$tokensienna."";
       
        $url.="&iclassNode=".$nodo."&longitude=".$longitude."&latitude=".$latitude."&country=".$country."&state=".$state."&city=".$city."&neighborhood=".$neighborhood."&address=".$address."&email=".$email."&mobilePhone=".$mobilePhone."&contactPhone=".$contactPhone."&nameCustomer=".$nameCustomer."&idCustomer=".$cliente."&description=".$detalle."&typeSO=".$tipo."&codeSO=".$codeSO."";
        echo $url;
       // dd($request);
        $curl = curl_init();

        // Set headers for the cURL request
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Cookie: xenioo-id=Bearer+ZlHPzQ0ZfubwcHXAjjXMG0hDlJI22S1S0dqgKs0H7O06PghfV3BRy6Wxmn7PLb6RUmfIXRXiijo5X8E7%2flsAUV24IzaB28PYO%2bw90fEOTrp8Hx0WQCQ%2btq69lwpWUZpCg0ga2p%2bQD%2bI9KFMrCB6Ht%2bJM4ZOuekNf%2bYWtUBQ%2bm1prYPb8nDXWuRnU6qgtzr7zInbdRjyNhsdg41gTr7AstZ3sLt2wAXQS%2ba8zSGYe1UZY7gvoYm%2fGKj6TbvAdWnO0WXTVkwnB1jhMbWDX38PYGt2jkNoaUXRWxncuQSxJRzUIBWuTJGju%2b7EZOaoK07cXNk%2bUPBMSV1Q9gV6Gzc8CkA%3d%3d',
        );
     
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
        // Close the cURL resource
        curl_close($curl);
        $rrr="res:".$response;
        return redirect()->back()->with('success', $rrr );
 
 
    }
     public function crearispcube(Request $request){

       
        echo $idconnection=$request->conexion;
        echo $idcategory=$request->categoria;
        echo $subject=$request->detalle;

        echo $idcustomer=$request->cliente;
        echo $dom=$request->dom;
        echo $tokensienna=$request->tokensienna;
 
        echo $url="https://".$dom.".suricata2.com.ar/api/ct?token=".$tokensienna."";
        $curl = curl_init();
       
        $url.="&subject=".$subject."&idcustomer=".$idcustomer."&idconnection=".$idconnection."&idcategory=".$idcategory."";

        // Set headers for the cURL request
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Cookie: xenioo-id=Bearer+ZlHPzQ0ZfubwcHXAjjXMG0hDlJI22S1S0dqgKs0H7O06PghfV3BRy6Wxmn7PLb6RUmfIXRXiijo5X8E7%2flsAUV24IzaB28PYO%2bw90fEOTrp8Hx0WQCQ%2btq69lwpWUZpCg0ga2p%2bQD%2bI9KFMrCB6Ht%2bJM4ZOuekNf%2bYWtUBQ%2bm1prYPb8nDXWuRnU6qgtzr7zInbdRjyNhsdg41gTr7AstZ3sLt2wAXQS%2ba8zSGYe1UZY7gvoYm%2fGKj6TbvAdWnO0WXTVkwnB1jhMbWDX38PYGt2jkNoaUXRWxncuQSxJRzUIBWuTJGju%2b7EZOaoK07cXNk%2bUPBMSV1Q9gV6Gzc8CkA%3d%3d',
        );
     
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
        echo $response = curl_exec($curl); 
        // Close the cURL resource
        curl_close($curl);
        return   redirect()->back();
 
 
    }
     public function crearmikrowisp(Request $request){

        echo $asunto=$request->asunto;
        echo $agendado=$request->agendado;
        echo $fecha=$request->fecha;
        echo $turno=$request->turno;
        echo $depto=$request->depto;
        echo $contenido=$request->contenido;

        echo $cliente=$request->cliente;
        echo $dom=$request->dom;
        echo $tokensienna=$request->tokensienna;
 
        echo $url="https://".$dom.".suricata-mikrowisp.com.ar/api/crearticket?token=".$tokensienna."";
        $curl = curl_init();
       
        $url.="&asunto=".$asunto."&turno=".$turno."&depto=".$depto."&agendado=".$agendado."&fecha=".$fecha."&cliente=".$cliente."&contenido=".$contenido."";
  
        // Set headers for the cURL request
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Cookie: xenioo-id=Bearer+ZlHPzQ0ZfubwcHXAjjXMG0hDlJI22S1S0dqgKs0H7O06PghfV3BRy6Wxmn7PLb6RUmfIXRXiijo5X8E7%2flsAUV24IzaB28PYO%2bw90fEOTrp8Hx0WQCQ%2btq69lwpWUZpCg0ga2p%2bQD%2bI9KFMrCB6Ht%2bJM4ZOuekNf%2bYWtUBQ%2bm1prYPb8nDXWuRnU6qgtzr7zInbdRjyNhsdg41gTr7AstZ3sLt2wAXQS%2ba8zSGYe1UZY7gvoYm%2fGKj6TbvAdWnO0WXTVkwnB1jhMbWDX38PYGt2jkNoaUXRWxncuQSxJRzUIBWuTJGju%2b7EZOaoK07cXNk%2bUPBMSV1Q9gV6Gzc8CkA%3d%3d',
        );
     
        // Set options for the cURL request
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => $headers,
        );
        // Set the options for cURL resource
        curl_setopt_array($curl, $options);
        // Execute the cURL request
        echo $response = curl_exec($curl); 
        // Close the cURL resource
        curl_close($curl);
        return   redirect()->back();
 
 
    }
 
     public function crearispkipper(Request $request){

       echo $usuarios=$request->usuarios;
       echo $prioridad=$request->prioridad;
       echo $subcategoria=$request->subcategoria;
       echo $cliente=$request->cliente;
       echo $detalle=$request->detalle;
       echo $dom=$request->dom;
       echo $tokensienna=$request->tokensienna;

       $url="https://".$dom.".suricata-ispkeeper.com.ar/api/creart2?token=".$tokensienna."";
       $curl = curl_init();
       $data = array(
           "usuario" => $usuarios,
           "prioridad" => $prioridad,            
           "subcategoria" => $subcategoria,            
           "cliente" => $cliente,            
           "detalle" => $detalle,           
           "estado" => "1"            
       );
       $url.="&usuario=".$usuarios."&prioridad=".$prioridad."&subcategoria=".$subcategoria."&cliente=".$cliente."&detalle=".$detalle."";
 
       // Set headers for the cURL request
       $headers = array(
           'Accept: application/json',
           'Content-Type: application/json',
           'Cookie: xenioo-id=Bearer+ZlHPzQ0ZfubwcHXAjjXMG0hDlJI22S1S0dqgKs0H7O06PghfV3BRy6Wxmn7PLb6RUmfIXRXiijo5X8E7%2flsAUV24IzaB28PYO%2bw90fEOTrp8Hx0WQCQ%2btq69lwpWUZpCg0ga2p%2bQD%2bI9KFMrCB6Ht%2bJM4ZOuekNf%2bYWtUBQ%2bm1prYPb8nDXWuRnU6qgtzr7zInbdRjyNhsdg41gTr7AstZ3sLt2wAXQS%2ba8zSGYe1UZY7gvoYm%2fGKj6TbvAdWnO0WXTVkwnB1jhMbWDX38PYGt2jkNoaUXRWxncuQSxJRzUIBWuTJGju%2b7EZOaoK07cXNk%2bUPBMSV1Q9gV6Gzc8CkA%3d%3d',
       );
    
       // Set options for the cURL request
       $options = array(
           CURLOPT_URL => $url,
           CURLOPT_RETURNTRANSFER => true,
           CURLOPT_ENCODING => '',
           CURLOPT_MAXREDIRS => 10,
           CURLOPT_TIMEOUT => 0,
           CURLOPT_FOLLOWLOCATION => true,
           CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
           CURLOPT_CUSTOMREQUEST => 'GET',
           CURLOPT_HTTPHEADER => $headers,
       );
       // Set the options for cURL resource
       curl_setopt_array($curl, $options);
       // Execute the cURL request
       echo $response = curl_exec($curl); 
       // Close the cURL resource
       curl_close($curl);
       return   redirect()->back();


     }

     
     public function creariwisp(Request $request){

       
        echo $tipo=$request->tipo;
        echo $idcategory=$request->categoria;
        echo $subject=$request->detalle;

        echo $idcustomer=$request->cliente;
        echo $dom=$request->dom;
        echo $tokensienna=$request->tokensienna;
 
        echo $url="https://".$dom.".suricata-iwisp.com.ar/api/newticket?token=".$tokensienna."";
        $curl = curl_init();
       
        $url.="&detalle=".$subject."&idcliente=".$idcustomer."&tipo=".$tipo."&idcategoria=".$idcategory."";

        // Set headers for the cURL request
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Cookie: xenioo-id=Bearer+ZlHPzQ0ZfubwcHXAjjXMG0hDlJI22S1S0dqgKs0H7O06PghfV3BRy6Wxmn7PLb6RUmfIXRXiijo5X8E7%2flsAUV24IzaB28PYO%2bw90fEOTrp8Hx0WQCQ%2btq69lwpWUZpCg0ga2p%2bQD%2bI9KFMrCB6Ht%2bJM4ZOuekNf%2bYWtUBQ%2bm1prYPb8nDXWuRnU6qgtzr7zInbdRjyNhsdg41gTr7AstZ3sLt2wAXQS%2ba8zSGYe1UZY7gvoYm%2fGKj6TbvAdWnO0WXTVkwnB1jhMbWDX38PYGt2jkNoaUXRWxncuQSxJRzUIBWuTJGju%2b7EZOaoK07cXNk%2bUPBMSV1Q9gV6Gzc8CkA%3d%3d',
        );
     
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
        echo $response = curl_exec($curl); 
        // Close the cURL resource
        curl_close($curl);
        return   redirect()->back();
 
 
    }

    
    public function creariwispleads(Request $request){

       
        echo $nombre=$request->nombre;
        echo $apellido=$request->apellido;
        echo $domicilio=$request->domicilio;
        echo $cel=$request->cel;
        echo $email=$request->email;
        echo $localidad=$request->localidad;
        echo $detalle=$request->detalle;
        echo $tipo=$request->tipo;

        echo $dom=$request->dom;
        echo $tokensienna=$request->tokensienna;
 
        echo $url="https://".$dom.".suricata-iwisp.com.ar/api/newlead?token=".$tokensienna."";
        $curl = curl_init();
  
        $url.="&nombre=".$nombre."&apellido=".$apellido."&tipo=".$tipo."&domicilio=".$domicilio."&celular=".$cel."&email=".$email."&idlocalidad=".$localidad."";

        // Set headers for the cURL request
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Cookie: xenioo-id=Bearer+ZlHPzQ0ZfubwcHXAjjXMG0hDlJI22S1S0dqgKs0H7O06PghfV3BRy6Wxmn7PLb6RUmfIXRXiijo5X8E7%2flsAUV24IzaB28PYO%2bw90fEOTrp8Hx0WQCQ%2btq69lwpWUZpCg0ga2p%2bQD%2bI9KFMrCB6Ht%2bJM4ZOuekNf%2bYWtUBQ%2bm1prYPb8nDXWuRnU6qgtzr7zInbdRjyNhsdg41gTr7AstZ3sLt2wAXQS%2ba8zSGYe1UZY7gvoYm%2fGKj6TbvAdWnO0WXTVkwnB1jhMbWDX38PYGt2jkNoaUXRWxncuQSxJRzUIBWuTJGju%2b7EZOaoK07cXNk%2bUPBMSV1Q9gV6Gzc8CkA%3d%3d',
        );
     
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
        echo $response = curl_exec($curl); 
        // Close the cURL resource
        curl_close($curl);
        return   redirect()->back();
 
 
    }
     
     public function siennaservicios(Request $request){

        $dom=$this->dominio();
       
        // $query="select *  from ".$dom.".siennatickets  where id='".$tick."'"; 

         $query="select * from sienna_suricata_servicios  ";
         $resultados = DB::select($query);
       

        return $resultados;
        
     }

     public function siennadeptos(Request $request){

        $dom=$this->dominio();
       
        // $query="select *  from ".$dom.".siennatickets  where id='".$tick."'"; 

         $query="select * from siennadepto  ";
         $resultados = DB::select($query);
       

        return $resultados;
        
     }


     public function creartickessiennacharlienew(Request $request)
     {
        /*
        echo "hola";
        if ($request->isJson()) {
            return response()->json(['json_detected' => $request->json()->all()]);
        } else {
            return response()->json(['error' => 'JSON not detected']);
        }*/
        
         $cel = $request->input('cel');//callid
         $tel = $request->input('tel');//telcontacto
         $siennaestado = $request->input('siennaestado');
         $siennasource = "5";
         $cliente =$request->input('cliente');
         $nya = $request->input('nya');
          $merchant =$request->input('merchant') ;
     
         
         if(isset($request->cedula)){
             $cedula=$request->cedula;
         }else{
             $cedula="";
         }
         $valida = $this->valida($cliente,$merchant);//telcontacto
         if($valida>0){
 
             return '{"error":"true","ticket":"'.$valida.'"}';
         }
         if($request->ostickettopic<>""){
             $ostickettopic=$request->ostickettopic;
             $resultados222 = siennatopic::where('ostickettopic', '=', $ostickettopic)->get();
             foreach ($resultados222 as $valuep) {
                 $siennatopic = $valuep->id;
                 $siennadepto = $valuep->siennadepto;
                 $phone_tranfer = $valuep->phone_tranfer;
                 
                   
             }
           
         }else{
               $siennatopic = $request->siennatopic;
             $resultados222 = siennatopic::where('id', '=', $siennatopic)->get();
         // dd($resultados222);
             foreach ($resultados222 as $valuep) {
                 $siennatopic = $valuep->id;
                 $siennadepto = $valuep->siennadepto;
                 $phone_tranfer = $valuep->phone_tranfer;

             }
 
         }
 
         $asignado=0;
       
 
         $siebotchanel=siennasource::find($siennasource);
         $bot_channel=$siebotchanel->nombre;


         $siedep=siennadepto::find($siennadepto);
         $phone_queue=$siedep->phone_queue;
 
 
         $si = new siennatickets();
         $si->siennadepto = $siennadepto;
         $si->cliente = $cliente;
         $si->nya = $nya;
         $si->cedula = $cedula;
         $si->siennatopic = $siennatopic;
         $si->siennaestado = $siennaestado;
         $si->siennasource = $siennasource;
         $si->asignado = "99999";
         $si->cel = $cel;
         $si->tel = $tel;
         
         if(isset($request->prioridad)){
             $si->prioridad= $request->prioridad;
         }
         if(isset($request->extras)){
             $si->extras= $request->extras;
         }
        
         ///getdata
         $si->save();
 
         $se = new siennaseguimientos();
         $se->ticket = $si->id;
         $se->tipo = "1";
         $se->descripcion = "created";
         $se->autor = "sistema";
         $se->save();
 
        
 
 
 
         $sc = new siennacliente();
         if ($cliente <> '') {
 
             $sc->cliente = $cliente;
         } else {
 
             $sc->cliente = "";
         }
         $sc->cel = $cel;
         $sc->nya = $nya;
     
         try {
             $sc->save();
         } catch (\Illuminate\Database\QueryException $ex) {
            // echo "existe".$ex;
         }
         $merchant=$this->dominio();
         $enhora=$this->enhora2($merchant,$siennadepto);
         //return '{"error":"false","ticket":"11"}';
         return '{"error":"false","ticket":"'.$si->id.'","phone_tranfer":"'.$phone_tranfer.'","phone_queue":"'.$phone_queue.'","phone_intime":"'.$enhora.'"}';
 
         //return response()->json(['cliente' => $return2]);
 
     }

     public function enhora2($merchant,$area){
        // Configura la zona horaria a la hora local

       // $area=$request->area;

        //$emp=empresa::find(1);
        $query="select * from ".$merchant.".empresa where id=1";
        $resultados = DB::select($query);

        foreach($resultados as $emp){
             $zona=$emp->zona;

        }
        
        date_default_timezone_set($zona); // Reemplaza 'America/Buenos_Aires' con la zona horaria deseada

        // Obtiene la hora actual en formato de 24 horas
         $horaLocal = date('H');
         $diaSemana = date('l');
        //$cat=categoria::where('area','=',$area)->get();

        $query2="select * from ".$merchant.".categoria where area='".$area."'";
        $cat = DB::select($query2);


        //echo "luis".$merchant;
        foreach($cat as $val){

         $fecha=$val->$diaSemana;

        }

        try {
        $fec=explode("-",$fecha);
       
        if(($horaLocal>=$fec[0]) and ($horaLocal<$fec[1])){
            
            return true;
        }else{

            return false;

        }

        } catch (\Throwable $th) {
            return false;
        }
            // Imprime la hora local


    }
     
}
