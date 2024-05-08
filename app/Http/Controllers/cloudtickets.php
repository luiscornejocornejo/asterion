<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\masterreport;
use App\Models\base;
use App\Models\enpointnombre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;
use App\Models\endpoint;
use App\Models\users;
use App\Models\siennasource;
use App\Models\siennatickets;
use App\Models\siennaseguimientos;
use App\Models\siennacliente;
use App\Models\siennadepto;
use App\Models\siennaestado;
use App\Models\siennatopic;
use App\Models\empresa;

class cloudtickets extends Controller
{

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


    public function cambiardeptosienna(Request $request)
    {

        $idticketdepto = $request->idticketdepto;
        $statos = $request->statos;
        $idconv = $request->idconv;
        $idbot = $request->idbot;
        $logeado = $request->logeado;
        $user_id = $request->user_id;
        $bot_channel = $request->bot_channel;


        //ticket update
        $si2 = siennatickets::find($idticketdepto);
        $antdepto=$si2->siennadepto;
        $si2->siennadepto = $statos;
        $si2->asignado = 0;
        $si2->save();

        //depto find
        $depto = siennadepto::find($statos);
        $behaviour = $depto->behaviour;
        $interaction = $depto->interaction;
        $nombrearea = $depto->nombre;
        //depto ant find
        $deptoant = siennadepto::find($antdepto);
        //seguimientos
        $se = new siennaseguimientos();
        $se->ticket = $idticketdepto;
        $se->tipo = "3";
        $se->descripcion = $deptoant->nombre." =>" . $nombrearea;
        $se->autor = $logeado;
        $se->save();
        //xennio
        $rr=$this->cambiardeptosxennio($idbot,$idconv,$behaviour,$interaction,$bot_channel,$user_id);
        return redirect()
            ->back()
            ->with('success', 'Se modifico el departamento  correctamente!');
    }

    public function cambiardeptosxennio($idbot,$idconv,$behaviour,$interaction,$bot_channel,$user_id)
    {
        $curl = curl_init();

        // Prepare data array with account key, bot key, and account secret

        // Set headers for the cURL request
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Cookie: xenioo-id=Bearer+ZlHPzQ0ZfubwcHXAjjXMG0hDlJI22S1S0dqgKs0H7O06PghfV3BRy6Wxmn7PLb6RUmfIXRXiijo5X8E7%2flsAUV24IzaB28PYO%2bw90fEOTrp8Hx0WQCQ%2btq69lwpWUZpCg0ga2p%2bQD%2bI9KFMrCB6Ht%2bJM4ZOuekNf%2bYWtUBQ%2bm1prYPb8nDXWuRnU6qgtzr7zInbdRjyNhsdg41gTr7AstZ3sLt2wAXQS%2ba8zSGYe1UZY7gvoYm%2fGKj6TbvAdWnO0WXTVkwnB1jhMbWDX38PYGt2jkNoaUXRWxncuQSxJRzUIBWuTJGju%2b7EZOaoK07cXNk%2bUPBMSV1Q9gV6Gzc8CkA%3d%3d',
        );
        $url = "https://suricata4.com.ar/api/Behaviour?token=EDElDqlQf3RDP5EDK1pHhugV9M6aCXtwAm57SD0G5JYZjw7RxwZbbfdKMhWYdUUM&idbot=" . $idbot . "&idconv=" . $idconv . "&behaviour=" . $behaviour . "&interaction=" . $interaction . "&user_id=" . $user_id . "&bot_channel=" . $bot_channel;
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
        curl_close($curl);

    }


    public function cambiarestadosienna(Request $request)
    {


        $tik=$request->tik;
        $estado=$request->estado;
        $motivoc=$request->motivoc;

        $idbot=$request->idbot;
        $idconv=$request->idconv;
        $bot_channel="WhatsAppChannel";

        $si2 = siennatickets::find($tik);
        $estadoant=$si2->siennaestado;

        $si2->siennaestado=$estado;
        $si2->save();

        $estant=siennaestado::find($estadoant);
        $estnombreant=$estant->nombre;

        $est=siennaestado::find($estado);
        $estnombre=$est->nombre;
        $se=new siennaseguimientos();
        $se->ticket=$tik;
        $se->tipo="2";
        $se->descripcion=$estnombreant." => ".$estnombre;
        $usulogear = session('nombreusuario');

        $se->autor=$usulogear;
        $se->save();

        return redirect() 
        ->back() 
        ->with('success', 'Se Cambio status correctamente');
    }

    public function asignara(Request $request)
    {

        $idticketpedir = $request->idticketpedir;

        $usuarioticket = $request->usuarioticket;


        $logeado = $request->logeado;
        $si2 = siennatickets::find($idticketpedir);
        $si2->asignado = $usuarioticket;
        $si2->save();


        $us=users::find($usuarioticket);

        $se = new siennaseguimientos();
        $se->ticket = $idticketpedir;
        $se->tipo = "4";
        $se->descripcion = "asignado a: ".$us->last_name;
        $se->autor = $logeado;
        $se->save();



        return redirect()
            ->back()
            ->with('success', 'Se asigno  correctamente!');
    }

    public function cambiarestadoxennio(){

        $url="https://suricata4.com.ar/api/closechat";
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
         
                 $url="https://suricata4.com.ar/api/closechat?token=EDElDqlQf3RDP5EDK1pHhugV9M6aCXtwAm57SD0G5JYZjw7RxwZbbfdKMhWYdUUM&idbot=".$idbot."&idconv=".$idconv."&bot_channel=".$bot_channel;
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
}