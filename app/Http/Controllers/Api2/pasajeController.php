<?php

namespace App\Http\Controllers\Api2;

use App\Http\Controllers\Controller;
use App\Models\masterreport;
use App\Models\ws_methodo;
use App\Models\ws_cliente;
use App\Models\ws_endpoint;
use App\Models\ws_integracion;
use App\Models\ws_principal_endpoint;
use App\Models\ws_principal;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class pasajeController extends Controller
{


    public function curl($url, $data, $headertipo, $method, $headerlogin, $headerendpoint)
    {

        if ($headertipo == 0) {
            //token
            $separado = explode(",", trim($headerlogin));
            $header = $separado; //json_decode($headerlogin,true) ;
        } else {
            //query
            $separado = explode(",", trim($headerendpoint));

            $header = $separado;
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => $header,
        ));

        $result = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        return [$result, $httpCode];
    }
    public function logearse($user, $pass, $urilogin, $parametros, $urlprincipal, $headerlogin, $headerendpoint)
    {
        $sepa = explode(",", $parametros);
        $url = $urlprincipal . $urilogin;
        $data = array(
            $sepa[0] => $user,
            $sepa[1] => $pass
        );
        $datos = json_encode($data);
        $method = "POST";
        $resultado = $this->curl($url, $datos, 0, $method, $headerlogin, $headerendpoint);
        $token = $resultado[0];
        $decotoken = json_decode($token);
        return $decotoken->token;
    }

    public function generico($tokenapp, $urlprincipal, $uri, $headerendpoint, $methodo, $datos)
    {
        $url = $urlprincipal . $uri;
        $methodo;
        $headerlogin = "";
        $headerendpoint = str_replace("tokenvariable", $tokenapp, $headerendpoint);
        $resultado = $this->curl($url, $datos, 1, $methodo, $headerlogin, $headerendpoint);

        return $resultado[0];
    }
    public function pasaje(Request $request)
    {

        //datos request
        $ws = $request->ws;
        $token = $request->token;
        $return = "";
        //datos ws principal
        $principal = ws_principal::find($ws);
        $tokentabla = $principal->token;
        $principal->ws;
        $clienteaa = $principal->ws_cliente;

        if ($tokentabla <> $token) {
            $error = array("error token" => "error de credenciales");
            return $error;
        }
        $datoscliente = ws_cliente::find($clienteaa);
        $datoscliente->idcliente;
        $urlprincipal = $datoscliente->url;
        $apikey=$datoscliente->apikey;
        $apikeyname=$datoscliente->apikeyname;
        $headerlogin = $datoscliente->headerlogin;
        $headerendpoint = $datoscliente->headerendpoint;

        $listadoendpoint = ws_principal_endpoint::where('ws_principal', '=',  $ws)->get();
        foreach ($listadoendpoint as $value) {

            $datosendpoint = ws_endpoint::find($value->ws_endpoint);
            $methodoid = $datosendpoint->ws_methodo;
            $datosmethodo = ws_methodo::find($methodoid);
            $methodo = $datosmethodo->nombre;
            $datosintegracion = ws_integracion::find($datosendpoint->ws_integracion);
            $seguridad = $datosintegracion->seguridad;

            if ($seguridad == 2) {
                $tokenapp = $this->logearse($datoscliente->user, $datoscliente->pass, $datoscliente->urilogin, $datoscliente->parametros, $urlprincipal, $headerlogin, $headerendpoint);
            } else {
                $tokenapp = $datoscliente->token;
            }

            $dat="";
            $return .= $this->generico($tokenapp, $urlprincipal, $datosendpoint->uri, $headerendpoint, $methodo,$dat);
        }

      
        return $return;
    }


    //especifico
    public function especifico(Request $request)
    {

        //datos request
        $ws = $request->ws;
        $token = $request->token;
       // $cliente = $request->cliente;
        $return = "";
        //datos ws principal
        $principal = ws_principal::find($ws);
        $tokentabla = $principal->token;

        $clienteaa = $principal->ws_cliente;
        //dd($clienteaa);

        $principal->ws;
        if ($tokentabla <> $token) {
            $error = array("error token" => "error de credenciales");
        return $error ;
        }
        $datoscliente = ws_cliente::find($clienteaa);
        $datoscliente->idcliente;
        $urlprincipal = $datoscliente->url;
        $apikey=$datoscliente->apikey;
        $apikeyname=$datoscliente->apikeyname;

        $headerlogin = $datoscliente->headerlogin;
        $headerendpoint = $datoscliente->headerendpoint;

        $listadoendpoint = ws_principal_endpoint::where('ws_principal', '=',  $ws)->get();
        foreach ($listadoendpoint as $value) {

            $datosendpoint = ws_endpoint::find($value->ws_endpoint);
            $methodoid = $datosendpoint->ws_methodo;
            $datosmethodo = ws_methodo::find($methodoid);
            $methodo = $datosmethodo->nombre;
            $datosintegracion = ws_integracion::find($datosendpoint->ws_integracion);
            $seguridad = $datosintegracion->seguridad;

            if ($seguridad == 2) {

                $tokenapp = $this->logearse($datoscliente->user, $datoscliente->pass, $datoscliente->urilogin, $datoscliente->parametros, $urlprincipal, $headerlogin, $headerendpoint);
            } else {
                $tokenapp = $datoscliente->token;
            }

            $tipoendpoint = $datosendpoint->tipo;
            $parametros = $datosendpoint->parametros;
            $posicion_coincidencia = strpos($parametros, ",");

            if ($tipoendpoint == 1) {
                //ws con parametro en la uri
                $datossolouno = '';

                $urinuevo = $datosendpoint->uri . $request->$parametros;
                $return .= $this->generico($tokenapp, $urlprincipal, $urinuevo, $headerendpoint, $methodo, $datossolouno);
            }elseif($tipoendpoint == 3){

                if ($posicion_coincidencia === false) {
                    //ws con un solo parametro
                    $datossolouno = '';
                    $urinuevo = $datosendpoint->uri;
                    $return .= $this->generico($tokenapp, $urlprincipal, $urinuevo, $headerendpoint, $methodo, $datossolouno);
                } else {
                    //ws con varios parametros
                    $para = explode(",", $parametros);
                    $datos2 = "";
                    for ($i = 0; $i < sizeof($para); $i++) {
                        $nombredelcampo = $para[$i];
                        $valordelcampo = $request->$nombredelcampo;
                        $datos2 .= '"' . $nombredelcampo . '":"' . $valordelcampo . '",';
                    }

                    $datos3 = substr($datos2, 0, -1);
                    $datos4 = "{" . $datos3 . "}";
                    $urinuevo = $datosendpoint->uri;
                    $return .= $this->apikey($apikey, $urlprincipal, $urinuevo, $headerendpoint, $methodo, $datos4);
                }

            } else {
                if ($posicion_coincidencia === false) {
                    //ws con un solo parametro
                    $datossolouno = '';
                    $urinuevo = $datosendpoint->uri;
                    $return .= $this->generico($tokenapp, $urlprincipal, $urinuevo, $headerendpoint, $methodo, $datossolouno);
                } else {
                    //ws con varios parametros
                    $para = explode(",", $parametros);
                    $datos2 = "";
                    for ($i = 0; $i < sizeof($para); $i++) {
                        $nombredelcampo = $para[$i];
                        $valordelcampo = $request->$nombredelcampo;
                        $datos2 .= '"' . $nombredelcampo . '":"' . $valordelcampo . '",';
                    }

                    $datos3 = substr($datos2, 0, -1);
                    $datos4 = "{" . $datos3 . ",}";
                    $urinuevo = $datosendpoint->uri;
                    $return .= $this->generico($tokenapp, $urlprincipal, $urinuevo, $headerendpoint, $methodo, $datos4);
                }
            }
        }
        return $return;
    }

    public function apikey($apikey, $urlprincipal, $urinuevo, $headerendpoint, $methodo, $datos4)
    {


        $url = $urlprincipal . $urlprincipal;
        $headerlogin = "";
        //$headerendpoint = str_replace("tokenvariable", $tokenapp, $headerendpoint);
        $resultado = $this->curl2($url, $datos4, 1, $methodo, $headerlogin, $headerendpoint);

        return $resultado[0];
    }
}
