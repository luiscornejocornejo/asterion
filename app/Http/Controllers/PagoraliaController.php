<?php

namespace App\Http\Controllers;

use App\Models\pagoraliaconfig;
use App\Models\pagoraliaendpoint;
use App\Models\pagoraliaorder;
use App\Models\pagoraliaparametros;
use Illuminate\Http\Request;

class PagoraliaController extends Controller
{
    //

    public function template(){

        return response()->download(public_path('template.csv'));

    }
    public function subir()
    {
        return view("sienna/pagos"); //->with('servicios', $servicios);
    }
    private function limpiar($query)
    {
        $query = strtolower($query);
        $healthy = array("drop", "truncate", "insert", "update ");
        $yummy = array("", "", "", "");

        $query = str_replace($healthy, $yummy, $query);

        return $query;
    }
    public function procesar(Request $request)
    {

        $archivo = $request->file('file');
        $gestor = @fopen($archivo, "r");
        if ($gestor) {
            $cont = 0;
            while (($búfer = fgets($gestor, 4096)) !== false) {
                if ($cont == 0) {
                    $cont++;
                    continue;
                }

                $lista = explode(",", $búfer);
                //for($i=0;$i<sizeof($lista);$i++ ){

                $pago = new pagoraliaorder();
                $pago->CCreferenceCode = $this->limpiar($lista[0]);
                $pago->CCdescription = $this->limpiar($lista[1]);
                $pago->CCvalor = $this->limpiar($lista[2]);
                $pago->CcmerchantBuyerId = $this->limpiar($lista[3]);
                $pago->CCfirstName = $this->limpiar($lista[4]);
                $pago->CClastName = $this->limpiar($lista[5]);
                $pago->CCemailAddress = $this->limpiar($lista[6]);
                $pago->CCcontactPhone = $this->limpiar($lista[7]);
                $pago->CCdniNumber = $this->limpiar($lista[8]);
                $pago->CCstreet1 = $this->limpiar($lista[9]);
                $pago->CCstreet2 = $this->limpiar($lista[10]);
                $pago->CCcity = $this->limpiar($lista[11]);
                $pago->CCstate = $this->limpiar($lista[12]);
                $pago->CCpostalCode = $this->limpiar($lista[13]);
                $pago->CCphone = $this->limpiar($lista[14]);

                $pago->CCdocument_type = $this->limpiar($lista[15]);
                $pago->procesado = "n";
                $pago->fecha = date("Y-m-d");
                $pago->save();
                // echo $lista[$i];
                echo "<br>";

                // }
                $cont++;
            }
            if (!feof($gestor)) {
                echo "Error: fallo inesperado de fgets()\n";
            }
            fclose($gestor);
        }

        return redirect()
            ->back()
            ->with('success', 'Se cargo los pagos   correctamente!');
    }

    public function crontab()
    {

        $config = pagoraliaconfig::all();
        foreach ($config as $value) {
            $url = $value->url;
            $token = $value->token;

        }

        $parametros = pagoraliaparametros::where('endpoint', '=', '1')->get();
        $arrayparametro = array();
        foreach ($parametros as $value3) {
            $array = array(
                $value3->nombre => $value3->value,
            );

            array_push($arrayparametro, $array);

        }

        $datos = pagoraliaorder::where('procesado', '=', 'n')->get();

        if (sizeof($datos) > 0) {
            foreach ($datos as $value) {

                $endpoint = pagoraliaendpoint::where('id', '=', '1')->get();
                foreach ($endpoint as $value2) {

                    $datosjson = $value2->data;
                    $method = $value2->metodo;
                    $url2 = $url . $value2->nombre;
                }

                $datosjson = str_replace('CCreferenceCode', $value->CCreferenceCode, $datosjson);
                $datosjson = str_replace('CCdescription', $value->CCdescription, $datosjson);
                $datosjson = str_replace('CCvalor', $value->CCvalor, $datosjson);
                $datosjson = str_replace('CCmerchantBuyerId', $value->CCmerchantBuyerId, $datosjson);
                $datosjson = str_replace('CCfirstName', $value->CCfirstName, $datosjson);
                $datosjson = str_replace('CClastName', $value->CClastName, $datosjson);
                $datosjson = str_replace('CCemailAddress', $value->CCemailAddress, $datosjson);
                $datosjson = str_replace('CCcontactPhone', $value->CCcontactPhone, $datosjson);
                $datosjson = str_replace('CCdniNumber', $value->CCdniNumber, $datosjson);
                $datosjson = str_replace('CCstreet1', $value->CCstreet1, $datosjson);
                $datosjson = str_replace('CCstreet2', $value->CCstreet2, $datosjson);
                $datosjson = str_replace('CCcity', $value->CCcity, $datosjson);
                $datosjson = str_replace('CCstate', $value->CCstate, $datosjson);
                $datosjson = str_replace('CCpostalCode', $value->CCpostalCode, $datosjson);
                $datosjson = str_replace('CCphone', $value->CCphone, $datosjson);
                $datosjson = str_replace('CCdocument_type', strtoupper($value->CCdocument_type), $datosjson);

                $datosjson = str_replace('CCPAYERstreet1', $value->CCstreet1, $datosjson);
                $datosjson = str_replace('CCPAYERstreet2', $value->CCstreet2, $datosjson);
                $datosjson = str_replace('CCPAYERcity', $value->CCcity, $datosjson);
                $datosjson = str_replace('CCPAYERstate', $value->CCstate, $datosjson);
                $datosjson = str_replace('CCPAYERpostalCode', $value->CCpostalCode, $datosjson);
                $datosjson = str_replace('CCPAYERphone', $value->CCphone, $datosjson);
                $datosjson = str_replace('CCPAYERfirstName', $value->CCfirstName, $datosjson);
                $datosjson = str_replace('CCPAYERlastName', $value->CClastName, $datosjson);
                $datosjson = str_replace('CCPAYERemailAddress', $value->CCemailAddress, $datosjson);
                $datosjson = str_replace('CCPAYERcontactPhone', $value->CCcontactPhone, $datosjson);
                $datosjson = str_replace('CCPAYERdniNumber', strtoupper($value->CCdniNumber), $datosjson);
                $datosjson = str_replace('CCPAYERbirthdate', '', $datosjson);
                $datosjson = str_replace('MMlanguage', $arrayparametro[0]["MMlanguage"], $datosjson);
                $datosjson = str_replace('MMcurrency', $arrayparametro[1]["MMcurrency"], $datosjson);
                $datosjson = str_replace('MMcountry', $arrayparametro[2]["MMcountry"], $datosjson);
                $datosjson = str_replace('MMip', $arrayparametro[3]["MMip"], $datosjson);

                $datosjson2 = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $datosjson), true);

                $datosjson3 = json_encode($datosjson2);
var_dump($datosjson3);
                $error = json_last_error();

                $header = array();

                $header[] = 'Content-type: application/json';
                $header[] = 'Authorization: Bearer ' . $token;
                $resuktado = $this->curl($url2, $datosjson2, $method, $header);
                var_dump($resuktado);

                $idactualizar=$value->id;
                $actualizar=pagoraliaorder::find($idactualizar);
                $codigo="";
                if($resuktado[1]==200){
                    $codigo="p";
                }
                if($resuktado[1]==422){
                    $codigo="e1";
                }
                if($resuktado[1]==406){
                    $codigo="e2";
                }
                if($resuktado[1]==423){
                    $codigo="e3";
                }


                $actualizar->procesado=$codigo;
                $actualizar->save();
                echo "<br><br>";
            }

        }
        
        return redirect()
        ->back()
        ->with('success', 'Se proceso los pagos   correctamente!');

    }

    public function curl($url, $datosjson2, $method, $header)
    {
        $datosjson3 = json_encode($datosjson2);

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
            CURLOPT_POSTFIELDS => $datosjson3,
            CURLOPT_HTTPHEADER => $header,
        ));

        $result = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        return [$result, $httpCode];
    }
}
