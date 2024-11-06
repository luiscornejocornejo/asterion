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
use App\Models\prioridad;
use App\Models\siennatopic;
use App\Models\empresa;
use App\Models\siennatareas;
use App\Models\siennaintegracion;
use App\Models\siennagetdata;
use App\Models\salientesxennio;
use App\Models\salientesxenniolistado;
use App\Models\siennatareassegui;
use App\Models\estadotarea;
use App\Models\siennamail;
use App\Models\siennaderivados;

use Illuminate\Support\Str;


use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\File;


use Mail;

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
        $horaticket=$si2->created_at ;
        $asuntoticket=$si2->siennatopic ;
        $nyaticket=$si2->nya ;
        $si2->save();


        $us=users::find($usuarioticket);

        $se = new siennaseguimientos();
        $se->ticket = $idticketpedir;
        $se->tipo = "4";
        $se->descripcion = "asignado a: ".$us->last_name;
        $se->autor = $logeado;
        $se->save();


        $envialmail=$us->avisoemail;
        $domi=$this->dominio();
        if($envialmail==1){

            $emailusuario=$us->email;
            $nombreusuario=$us->nombre;
            $apellidousuario=$us->last_name;
            $numeroticket=$idticketpedir;
            $horaticket=$horaticket;
            $topusut=siennatopic::find($asuntoticket);
            $asuntoticket=$topusut->nombre;
            $nyaticket=$nyaticket;
            $subject="nuevo ticket";

            Mail::mailer('suricata')
                ->send('mailavisoticket', ["domi" => $domi,"nombreusuario" => $nombreusuario,"apellidousuario" => $apellidousuario,"numeroticket" => $numeroticket,"horaticket" => $horaticket,"asuntoticket" => $asuntoticket,"nyaticket" => $nyaticket], function ($msj) use ($subject,$emailusuario) {
            $msj->from("support@suricata.la", "soporte");
            $msj->subject($subject);
            $msj->to($emailusuario);
           
            });

            


        }



        return redirect()
            ->back()
            ->with('success', 'Se asigno  correctamente!');
    }


    public function cambiartopicsienna(Request $request)
    {

        $tik=$request->tik;
        $estado=$request->estado;
        //ticket update
        $si2 = siennatickets::find($tik);
        $antdepto=$si2->siennadepto;
        $anttopic=$si2->siennatopic ;
        $si2->siennatopic = $estado;
        $si2->save();

        $topant=siennatopic::find($anttopic);
        $topicnombreant=$topant->nombre;

        $top=siennatopic::find($estado);
        $topnombre=$top->nombre;
        $se=new siennaseguimientos();
        $se->ticket=$tik;
        $se->tipo="7";
        $se->descripcion=$topicnombreant." => ".$topnombre;
        $usulogear = session('nombreusuario');

        $se->autor=$usulogear;
        $se->save();
        

        return redirect()
        ->back()
        ->with('success', 'Se modifico  el topic  correctamente!');

    }

    public function prioridadsienna(Request $request){

        $idticketestadoprioridad = $request->idticketestadoprioridad;
        $statos = $request->statos;
        $idconv = $request->idconv;
        $idbot = $request->idbot;
        $user_id = $request->user_id;
         $bot_channel = $request->bot_channel;
        $logeado = $request->logeado;
        $si2 = siennatickets::find($idticketestadoprioridad);
        $prioant=$si2->prioridad ;
        $si2->prioridad = $statos;
        //$si2->asignado = 0;
        $si2->save();

        $prioant = prioridad::find($prioant);
        $nombreprioant=$prioant->nombre;

        $prioact = prioridad::find($statos);
        $nombreprioact=$prioact->nombre;

        $se = new siennaseguimientos();
        $se->ticket = $idticketestadoprioridad;
        $se->tipo = "8";
        $se->descripcion = $nombreprioant." => ".$nombreprioact ;
        $se->autor = $logeado;
        $se->save();
        return redirect()
        ->back()
        ->with('success', 'Se modifico la Prioridad  correctamente!');

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



    public function reabrirconversacion(Request $request){

        $tel2 = $request->tel;
        $url = $request->url;
        $ticket = $request->ticket;
        $logeado = $request->asignado;
        $urlprincipal2="https://suricata4.com.ar/api/broadcastconparametros?url=".$url."&tel2=".$tel2."&parametros=ticket&valores=".$ticket."&token=EDElDqlQf3RDP5EDK1pHhugV9M6aCXtwAm57SD0G5JYZjw7RxwZbbfdKMhWYdUUM";
                            
       // dd($urlprincipal2);
        $página_inicio = file_get_contents($urlprincipal2);

        $se = new siennaseguimientos();
        $se->ticket = $ticket;
        $se->tipo = "11";
        $se->descripcion = " reabrir conversacion:".$tel2 ;
        $se->autor = $logeado;
        $se->save();

        return redirect()
        ->back()
        ->with('success', 'Se reabrio  correctamente!');
    }


    public function cerrarall(Request $request){

         $ticketss=$request->tikall;
        $estado=4;
        $motivoc=1;

        $idbot=$request->idbot;
        $bot_channel="WhatsAppChannel";
        $sep=explode(",",$ticketss);
        foreach($sep as $val){

            if($val<>""){
                echo $val;
                $si2 = siennatickets::find($val);
                $estadoant=$si2->siennaestado;
                $conv=$si2->conversation_url;
                $si2->siennaestado=$estado;
                $si2->motivoc=$motivoc;
                $si2->t_cerrado=date("Y-m-d H:i:s");
                $si2->save();

                $estant=siennaestado::find($estadoant);
                $estnombreant=$estant->nombre;
        
        
                $est=siennaestado::find($estado);
                $estnombre=$est->nombre;
                $se=new siennaseguimientos();
                $se->ticket=$val;
                $se->tipo="2";
                $se->descripcion=$estnombreant." => ".$estnombre;
                $usulogear = session('nombreusuario');
        
                $se->autor=$usulogear;
                $se->save();

                $pp=$this->cerrarchat($idbot,$conv);



            }

        }
        return redirect()
        ->back()
        ->with('success', 'Se cerro  correctamente!');

    }

    public function cerrarchat($idbot,$idconv){

        $curl = curl_init();
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Cookie: xenioo-id=Bearer+ZlHPzQ0ZfubwcHXAjjXMG0hDlJI22S1S0dqgKs0H7O06PghfV3BRy6Wxmn7PLb6RUmfIXRXiijo5X8E7%2flsAUV24IzaB28PYO%2bw90fEOTrp8Hx0WQCQ%2btq69lwpWUZpCg0ga2p%2bQD%2bI9KFMrCB6Ht%2bJM4ZOuekNf%2bYWtUBQ%2bm1prYPb8nDXWuRnU6qgtzr7zInbdRjyNhsdg41gTr7AstZ3sLt2wAXQS%2ba8zSGYe1UZY7gvoYm%2fGKj6TbvAdWnO0WXTVkwnB1jhMbWDX38PYGt2jkNoaUXRWxncuQSxJRzUIBWuTJGju%2b7EZOaoK07cXNk%2bUPBMSV1Q9gV6Gzc8CkA%3d%3d',
        );
        $bot_channel="WhatsAppChannel";

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
                curl_close($curl);


    }

    
    public function prioridadsiennaall(Request $request){

        $ticketss=$request->ticketss;
       
       $statos=$request->statos;
       $logeado = $request->logeado;

       $sep=explode(",",$ticketss);
       foreach($sep as $val){

           if($val<>""){
            $si2 = siennatickets::find($val);
            $prioant=$si2->prioridad ;
            $si2->prioridad = $statos;
            //$si2->asignado = 0;
            $si2->save();
    
            $prioant = prioridad::find($prioant);
            $nombreprioant=$prioant->nombre;
    
            $prioact = prioridad::find($statos);
            $nombreprioact=$prioact->nombre;
    
            $se = new siennaseguimientos();
            $se->ticket = $val;
            $se->tipo = "8";
            $se->descripcion = $nombreprioant." => ".$nombreprioact ;
            $se->autor = $logeado;
            $se->save();



           }

       }
       return redirect()
       ->back()
       ->with('success', 'Se modifico  correctamente!');

   }

   public function eliminaragente(Request $request){

    $idagente=$request->idagente;

    $user=users::find($idagente);
    $user->delete();   
      return redirect()
    ->back()
    ->with('success', 'Se elimino el agente  correctamente!');

   }

   public function asignarall(Request $request)
    {
        $usuarioticket = $request->usuarioticket;
        $ticketss = $request->ticketss;
        $logeado = $request->logeado;
        $sep=explode(",",$ticketss);
        $domi=$this->dominio();

        foreach($sep as $val){

            if($val<>""){
                $si2 = siennatickets::find($val);
                $si2->asignado = $usuarioticket;
                $horaticket=$si2->created_at ;
                $asuntoticket=$si2->siennatopic ;
                $nyaticket=$si2->nya ;
                $si2->save();

                $se = new siennaseguimientos();
                $se->ticket = $val;
                $se->tipo = "4";
                $se->descripcion = "asignado ";
                $se->autor = $logeado;
                $se->save();
                $us=users::find($usuarioticket);

                $envialmail=$us->avisoemail;
                if($envialmail==1){

                    $emailusuario=$us->email;
                    $nombreusuario=$us->nombre;
                    $apellidousuario=$us->last_name;
                    $numeroticket=$val;
                    $horaticket=$horaticket;
                    $topusut=siennatopic::find($asuntoticket);
                    $asuntoticket=$topusut->nombre;
                    $nyaticket=$nyaticket;
                    $subject="nuevo ticket";

                    Mail::mailer('suricata')
                        ->send('mailavisoticket', ["domi" => $domi,"nombreusuario" => $nombreusuario,"apellidousuario" => $apellidousuario,"numeroticket" => $numeroticket,"horaticket" => $horaticket,"asuntoticket" => $asuntoticket,"nyaticket" => $nyaticket], function ($msj) use ($subject,$emailusuario) {
                    $msj->from("support@suricata.la", "soporte");
                    $msj->subject($subject);
                    $msj->to($emailusuario);
                
                    });
                 }

            }

        }

        

        return redirect()
            ->back()
            ->with('success', 'Se asigno  correctamente!');
    }

    public function crearticketsiennacliente(Request $request){

        $cliente=$request->number_client;
        $depto=$request->depto;
        $siennatopic=$request->topicos;
        $logeado=$request->logeado;

        $si = new siennatickets();
        $si->siennadepto = $depto;
        $si->cliente = $cliente;
        $si->nya = $cliente;
        $si->siennatopic = $siennatopic;
        $si->siennasource = "9";
        $si->siennaestado = "1";
        $si->asignado = "99999";
        $si->save();

       

        $se = new siennaseguimientos();
        $se->ticket = $si->id;
        $se->tipo = "1";
        $se->descripcion = "created";
        $se->autor = $logeado;
        $se->save();

        
        return redirect()
        ->back()
        ->with('success', 'Se asigno  correctamente!');

    }
    public function crearticketsiennanocliente(Request $request){
        $phone=$request->phone;
        $address=$request->address;
        $city=$request->city;
        $email=$request->email;
        $fullname=$request->fullname;
        $logeado=$request->logeado;

        $depto=$request->depto;
        $siennatopic=$request->topicos;

        $si = new siennatickets();
        $si->siennadepto = $depto;
        $si->siennatopic = $siennatopic;
        $si->siennasource = "9";
        $si->siennaestado = "1";

        $si->asignado = "99999";

        $si->cel = $phone;
        $si->nya = $fullname;
        $si->cliente = $address;
        $si->cliente = $city;
        $si->cliente = $email;

        $si->save();

        $se = new siennaseguimientos();
        $se->ticket = $si->id;
        $se->tipo = "1";
        $se->descripcion = "created";
        $se->autor = $logeado;;
        $se->save();
        $so = new siennacliente();
        $so->nya = $fullname;
        $so->email = $email;
        $so->cel = $phone;
        $so->address = $address." / ".$city;
        $so->save();


        return redirect()
        ->back()
        ->with('success', 'Se asigno  correctamente!');   
    
    }

    
    public function notificacionusers(Request $request)
    {

         $user_id=$request->user_id5;
        $statos=$request->statos;

        $si2 = users::find($user_id);
        $si2->avisoemail = $statos;
        $si2->save();
      
        return redirect()
        ->back()
        ->with('success', 'Se modifico  el registro  correctamente!');

    }

    
    public function tareas(Request $request)
    {
        $domi=$this->dominio();
        $query2="select * from ".$domi.".siennatareas";
        $tareas = DB::select($query2);


        $query3="select * from ".$domi.".users";
        $usersmerchant = DB::select($query3);
        //$tareas = siennatareas::all()->get();
        return view('sienna/tareas')
        ->with('usersmerchant', $usersmerchant)
        ->with('tareas', $tareas);
    }
    public function getdata(Request $request)
    {        $getdata=siennagetdata::all();


        return view('sienna/getdata')
        ->with('getdata', $getdata);
 
    }

    public function getdata2(Request $request)
    {
        $cliente=$request->cliente;
        $domi=$this->dominio();
        $numcli=$cliente;
        $inte=siennaintegracion::all();
        $getdata=siennagetdata::all();
       
       foreach($inte as $val){
            $urlinte=$val->version;
       }
        $urlinte2=$urlinte.$numcli;
       //dd($urlinte2);
        if (($datosonline = @file_get_contents($urlinte2)) === false) {
            $error = error_get_last();
            //echo "HTTP request failed. Error was: " . $error['message'];
            $urlinte2="";

      } else {
           // echo "Everything went better than expected";
      }
      return view('sienna/getdata')
      ->with('datosonline', $datosonline)
      ->with('getdata', $getdata);



    }

    public function newvalor(Request $request)
    {       
        
       echo  $valor=$request->valor;
       echo $icono=$request->icono;
       echo  $nombre=$request->nombre;
        
        $getdata=new siennagetdata();
        $getdata->valor=$valor;
        $getdata->icono=$icono;
        $getdata->nombre=$nombre;
        $getdata->save();


        return redirect()
        ->back()
        ->with('success', 'Se Agrego  el registro  correctamente!');
 
    }
    public function cambiopass(Request $request)
    {       
        
       echo  $newpass=$request->newpass;
       echo $user_idpass=$request->user_idpass;
        
        $usuario= users::find($user_idpass);
        $usuario->password=md5($newpass);
      
        $usuario->save();


        return redirect()
        ->back()
        ->with('success', 'Se Modifico  la password  correctamente!');
 
    }

    
    public function salientesb(Request $request)
    {       
        
            $listadopadre=salientesxennio::all();
            return view('sienna/salientesb')
            ->with('listadopadre', $listadopadre)
            ;
    }

    public function salientesc(Request $request)
    {       
        
            $listadopadre=salientesxennio::all();
            return view('sienna/salientesfacu')
            ->with('listadopadre', $listadopadre)
            ;
    }

    public function salientesbpost(Request $request)
    {       

        /*
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);*/

        // Obtener el archivo subido
       echo  $valores = $request->cantvalores;
       $template=$request->template;
       $sepa=explode(",",$valores);
       echo sizeof($sepa);
       echo "<br>";
        $logo = $request->file('logo')->store('public');

       // $path1 = $request->file('file')->store('public'); 
            $path=storage_path('app').'/'.$logo;  
            $data = Excel::toArray([], $path);


        foreach($data[0] as $val){
            $listado=new salientesxenniolistado();
            $listado->estado="n";
            $listado->salientesxennio=$template;
            $juntar="";
            echo "aca".sizeof($sepa);
            for($i=0;$i<sizeof($sepa);$i++){

                if($i==0){
                    $listado->cel=$val[$i];
                }else{
                    if(isset($val[$i])){
                        $juntar.= $val[$i].";";

                    }

                }
            }
            echo $juntar=substr($juntar,0,-1);
            $listado->valoresparametros=$juntar;
            $listado->save();
        }

        
            return redirect()
            ->back()
            ->with('success', 'Se Agrego correctamente !');
     
    }

    public function mistareas(Request $request)
    {   
       echo  $idusuario=session('idusuario');


       // $datos = siennatareas::where('estadotarea', '<>', '3', 'and')->where('users', '=', $idusuario)->get();
        $datos = siennatareas::leftJoin('estadotarea', 'siennatareas.estadotarea', '=', 'estadotarea.id')
        ->where('siennatareas.estadotarea', '<>', '3')
        ->where('siennatareas.users', '=', $idusuario)
        ->select('siennatareas.*', 'estadotarea.nombre as nomestado')
        ->get();
        return view('sienna/mistareas')
        ->with('mistareas', $datos);
    }

    public function tareassupervisor(Request $request)
    {   
      
     // $datos = siennatareas::where('estadotarea', '<>', '3', 'and')->where('users', '=', $idusuario)->get();
        $datos = siennatareas::leftJoin('estadotarea', 'siennatareas.estadotarea', '=', 'estadotarea.id')
        ->where('siennatareas.estadotarea', '<>', '3')
        ->select('siennatareas.*', 'estadotarea.nombre as nomestado')
        ->get();
        return view('sienna/supervisortareas')
        ->with('tareas', $datos);
    }

    public function ts(Request $request)
    {   
         $idtarea=$request->idtarea;

        //$datos2=siennatareas::find($idtarea);
       $datos2 = siennatareas::where('id', '=', $idtarea)->get();
       $datos3 = estadotarea::all();

        $datos = Siennatareassegui::leftJoin('users', 'users.id', '=', 'siennatareassegui.idusuario')
        ->where('siennatareassegui.siennatareas', '=', $idtarea)
        ->get(['siennatareassegui.cuerpo', 'siennatareassegui.siennatareas', 'siennatareassegui.tipo', 'siennatareassegui.autor', 'siennatareassegui.created_at', 'siennatareassegui.id', 'users.nombre', 'users.last_name']);
    
        return view('sienna/informaciontareasegui')
        ->with('resultadostareasegui', $datos)
        ->with('datos2', $datos2)
        ->with('datos3', $datos3)
        ->with('idtarea', $idtarea)
        ;
    }

    
    public function soporte(Request $request)
    {   
        $merchant=$this->dominio();

        $query ="select a.id,a.created_at,a.estadoconv,b.nombre as deptoname ,c.nombre as topicname from soporte.siennatickets as a 
        left join soporte.siennadepto b
        on b.id=a.siennadepto
        left join soporte.siennatopic c
        on c.id=a.siennatopic
        where a.siennaestado<>'4' and a.siennasource=10  and a.merchant='".$merchant."'";
        $tsoporte = DB::select($query);

        return view('sienna/soporte')
        ->with('tsoporte', $tsoporte)
       
        ;
    }
    public function soportec(Request $request)
    {   
        $merchant=$this->dominio();

        $query ="select a.id,a.created_at,a.estadoconv,b.nombre as deptoname ,c.nombre as topicname from soporte.siennatickets as a 
        left join soporte.siennadepto b
        on b.id=a.siennadepto
        left join soporte.siennatopic c
        on c.id=a.siennatopic
        where a.siennaestado='4' and a.siennasource=10  and a.merchant='".$merchant."'";
        $tsoporte = DB::select($query);

        return view('sienna/soportec')
        ->with('tsoporte', $tsoporte)
       
        ;
    }
    
    public function envios(Request $request)
    {   
        $merchant=$this->dominio();

        $query ="select * from salientesxennio ";
        $tsoporte = DB::select($query);

        return view('sienna/envios')
        ->with('tsoporte', $tsoporte)
       
        ;
    }
    
    public function enviolistado(Request $request)
    {   
        $merchant=$this->dominio();

        $id=$request->envio;
        $query ="select * from salientesxenniolistado  where salientesxennio='".$id."'";
        $tsoporte = DB::select($query);

        return view('sienna/envioslistado')
        ->with('tsoporte', $tsoporte)
       
        ;
    }


    
    /////////inicio de pagina
    public function getsaliente(Request $request)
    {   
        $merchant=$this->dominio();

       // $id=$request->envio;
        //$query ="select * from salientesxenniolistado  where salientesxennio='".$id."'";
        //$tsoporte = DB::select($query);
        $getdata=siennaintegracion::all();

        return view('sienna/getsaliente')
        ->with('busquedas', $getdata)

       
        ;
    }
    //getdata busuqeda
    public function getsaliente2(Request $request)
    {
        $cliente=$request->cliente;
        $domi=$this->dominio();
        $numcli=$cliente;
        $typeSearch=$request->typeSearch;
        $inte=siennaintegracion::where('id', '=', $typeSearch)->get();
        $getdata=siennagetdata::all();
        $query3="select * from siennadepto";
        $siennadeptosgenericos = DB::select($query3);
       foreach($inte as $val){
            $urlinte=$val->version;
       }
        $urlinte2=$urlinte.$numcli;
        $curl = curl_init();
      
        // Set headers for the cURL request
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Cookie: xenioo-id=Bearer+ZlHPzQ0ZfubwcHXAjjXMG0hDlJI22S1S0dqgKs0H7O06PghfV3BRy6Wxmn7PLb6RUmfIXRXiijo5X8E7%2flsAUV24IzaB28PYO%2bw90fEOTrp8Hx0WQCQ%2btq69lwpWUZpCg0ga2p%2bQD%2bI9KFMrCB6Ht%2bJM4ZOuekNf%2bYWtUBQ%2bm1prYPb8nDXWuRnU6qgtzr7zInbdRjyNhsdg41gTr7AstZ3sLt2wAXQS%2ba8zSGYe1UZY7gvoYm%2fGKj6TbvAdWnO0WXTVkwnB1jhMbWDX38PYGt2jkNoaUXRWxncuQSxJRzUIBWuTJGju%2b7EZOaoK07cXNk%2bUPBMSV1Q9gV6Gzc8CkA%3d%3d',
        );
     
        // Set options for the cURL request
        $options = array(
            CURLOPT_URL => $urlinte2,
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
        $response = curl_exec($curl);
        // Close the cURL resource
        curl_close($curl);

/*
        var_dump($urlinte2);
        if (($datosonline = @file_get_contents($urlinte2)) === false) {
            dd($datosonline);

            //echo "HTTP request failed. Error was: " . $error['message'];
            $urlinte2="";

      } else {
        $error = error_get_last();
        dd($error );
        echo "aca2";
    }*/
      $getdata222=siennaintegracion::all();
      return view('sienna/getsaliente')
      ->with('datosonline', $response)
      ->with('cliente', $cliente)
      ->with('busquedas', $getdata222)

      ->with('siennadeptosgenericos', $siennadeptosgenericos)
      ->with('getdata', $getdata);



    }
    
    public function extrastickets(Request $request)
    {   
        $merchant=$this->dominio();

       // $id=$request->envio;
        $query ="select * from extras ";
        $tsoporte = DB::select($query);

        return view('sienna/extrastickets')
        ->with('tsoporte', $tsoporte)
        ;
    }
    
    public function pruebatelefonia(Request $request)
    {   
       

        return view('sienna/pruebatelefonia')
        ;
    }

    public function extrastickets2(Request $request)
    {   
        $merchant=$this->dominio();

        $pseudo=$request->pseudo;
        $view=$request->view;
        $id=$request->envio;
        $query ="select * from extras ";
        $tsoporte = DB::select($query);

        return view('sienna/extrastickets')
        ->with('tsoporte', $tsoporte)
        ;
    }

    //datos del user
    public function datosusuario($usu){

            $user=users::find($usu);
            return $user;
    }
    // creacion de ticket en soporte dle lado del cliente
    public function createticketsoporte(Request $request)
    {       
        
       echo  $department=$request->department;
       echo $reason=$request->reason;
       echo $textticket=$request->textticket;
       echo $textticket=$request->textticket;
       $merchant=$this->dominio();

       echo  $idusuario=session('idusuario');
       $nombreusuario=$this->datosusuario($idusuario);
       $datosuser=$nombreusuario->last_name;
      // $base=12;
      //$fields3 = $this->conectar2($base);
       $idnewticket = DB::reconnect('mysql')->table("soporte.siennatickets")->insertGetId([
        'siennadepto' => $department,
        'extra1' => "",
        'extra2' => "",
        'extra3' => "",
        'cliente' => $merchant,
        'siennatopic' => $reason,
        'cedula' => "",
        'siennaestado' => 1,
        'siennasource' => 10,
        'cel' => "",
        'nya' => $merchant,
        'asignado' => 99999,
        'prioridad' => 3,
        'estadoconv' => 1,
        
        'user_id' => "",
        'conversation_url' => "",
        'merchant' => $merchant,
        'created_at' =>  \Carbon\Carbon::now(),
        'updated_at' =>  \Carbon\Carbon::now(),
        ]);;

        $idnewseguimiento = DB::reconnect('mysql')->table("soporte.siennaseguimientos")->insertGetId([
            'ticket' => $idnewticket,
            'tipo' => '1',
            'descripcion' => 'created',
            'autor' => 'sistema',
            'created_at' =>  \Carbon\Carbon::now(),
            'updated_at' =>  \Carbon\Carbon::now(),
  
            ]);;


            
            $idnewsconv = DB::reconnect('mysql')->table("soporte.siennasuricata")->insertGetId([
                'siennatickets' => $idnewticket,
                'tipo' => '1',
                'cuerpo' => $textticket,
                'autor' => 0,
                'idusuario' => $datosuser,

                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' =>  \Carbon\Carbon::now(),
      
                ]);;
      
       if (isset($request->evicence)) {
            $logo = $request->file('evicence');
           // dd($logo);
          //  $content = file_get_contents($url);
    
    
            $archi=Str::of($logo)->basename();
            $ruta="soporte/suricata";
            $logo= Storage::disk('do')->put($ruta, $logo);
            $idnewsconv = DB::reconnect('mysql')->table("soporte.siennasuricata")->insertGetId([
                'siennatickets' => $idnewticket,
                'tipo' => '2',
                'cuerpo' => $logo,
                'autor' => 0,
                'idusuario' => $datosuser,

                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' =>  \Carbon\Carbon::now(),
      
                ]);;
       
       }
       $buscarcliente=$this->buscarcliente($merchant);


       ///nuevo




        if($buscarcliente){
            //update
            $tickets = DB::reconnect('mysql')->table("soporte.siennacliente")
            ->where('cliente', $merchant)
            ->update(['nya' => $merchant]);
        }else{
          //insert
          

          $idnewcliente = DB::reconnect('mysql')->table("soporte.siennacliente")->insertGetId([
            'cliente' => $merchant,
            'nya' => $merchant,
            
            'created_at' =>  \Carbon\Carbon::now(),
            'updated_at' =>  \Carbon\Carbon::now(),

            ]);;
        }

      
      
       ///fin
        return redirect()
        ->back()
        ->with('success', 'Se Agrego   correctamente!');
 
    }

    public function buscarcliente($cliente){
        $cuantos=0;
        $query="select count(*) as cuantos from soporte.siennacliente where cliente='".$cliente."'";
        $sal = DB::reconnect('mysql')->select($query); 
        foreach($sal as $val){
            $cuantos=$val->cuantos;
        }
    
        if($cuantos==0){
          return false;
    
        }else{
          return true;
    
        }
      }
    //insert de nuevo registro del lado de soporte

    public function createticketsoporte2(Request $request)
    {       
        
       echo  $idnewticket=$request->idnewticket;
       $query="update soporte.siennatickets set estadoconv='3'  where id='".$idnewticket."'";
       $resultados5 = DB::select($query);
       echo $reason=$request->reason;
       echo $textticket=$request->descripcion;
       $merchant=$this->dominio();
       echo  $idusuario=session('idusuario');  
       $nombreusuario=$this->datosusuario($idusuario); 
       $datosuser=$nombreusuario->last_name;
    
            $idnewsconv = DB::reconnect('mysql')->table("soporte.siennasuricata")->insertGetId([
                'siennatickets' => $idnewticket,
                'tipo' => '1',
                'cuerpo' => $textticket,
                'autor' => 1,
                'idusuario' => $datosuser,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' =>  \Carbon\Carbon::now(),
      
                ]);;
      
       if (isset($request->evicence)) {
            $logo = $request->file('evicence');
           // dd($logo);
          //  $content = file_get_contents($url);
    
    
            $archi=Str::of($logo)->basename();
            $ruta="soporte/suricata";
            $logo= Storage::disk('do')->put($ruta, $logo);
            $idnewsconv = DB::reconnect('mysql')->table("soporte.siennasuricata")->insertGetId([
                'siennatickets' => $idnewticket,
                'tipo' => '2',
                'cuerpo' => $logo,
                'autor' => 1,
                'idusuario' => $datosuser,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' =>  \Carbon\Carbon::now(),
      
                ]);;
       
       }
      
        return redirect()
        ->back()
        ->with('success', 'Se Agrego   correctamente!');
 
    }

    //view de tickets del lado del cliente en soporte
    public function createticketsoportecliente(Request $request)
    {   
        $merchant=$this->dominio();

        $ticket=$request->ticket;
       
        $query ="select * from soporte.siennasuricata where siennatickets='".$ticket."' ";
        $tsoporte = DB::select($query);

        return view('sienna/soportecliente')
        ->with('tsoporte', $tsoporte)
        ;
    }

    //insert de nuevo registro del lado del cliente
    public function createticketsoportecliente2(Request $request)
    {       
        
       echo  $idnewticket=$request->idnewticket;
       $query="update soporte.siennatickets set estadoconv='1'  where id='".$idnewticket."'";
       $resultados5 = DB::select($query);
       echo $reason=$request->reason;
       echo $textticket=$request->descripcion;
       $merchant=$this->dominio();
       echo  $idusuario=session('idusuario');   
       $nombreusuario=$this->datosusuario($idusuario); 
       $datosuser=$nombreusuario->last_name;    
            $idnewsconv = DB::reconnect('mysql')->table("soporte.siennasuricata")->insertGetId([
                'siennatickets' => $idnewticket,
                'tipo' => '1',
                'cuerpo' => $textticket,
                'autor' => 0,
                'idusuario' => $datosuser,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' =>  \Carbon\Carbon::now(),
      
                ]);;
      
       if (isset($request->evicence)) {
            $logo = $request->file('evicence');
           // dd($logo);
          //  $content = file_get_contents($url);
    
    
            $archi=Str::of($logo)->basename();
            $ruta="soporte/suricata";
            $logo= Storage::disk('do')->put($ruta, $logo);
            $idnewsconv = DB::reconnect('mysql')->table("soporte.siennasuricata")->insertGetId([
                'siennatickets' => $idnewticket,
                'tipo' => '2',
                'cuerpo' => $logo,
                'autor' => 0,
                'idusuario' => $datosuser,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' =>  \Carbon\Carbon::now(),
      
                ]);;
       
       }
      
        return redirect()
        ->back()
        ->with('success', 'Se Agrego   correctamente!');
 
    }
    public function nuevost(Request $request)
    {       
        
       echo  $idtarea=$request->idtarea;
       echo $des=$request->descripcion;
       echo $texttask=$request->logo;
      
       echo  $idusuario=session('idusuario');

       
       
      
       $logo="";
       if ($request->hasFile('logo')) {
        $ta=new siennatareassegui();

        $logo = $request->file('logo')->store('public');
        $ta->tipo=1;
        $ta->autor=1;
        $ta->siennatareas=$idtarea;
        $ta->cuerpo=$logo;
        $ta->idusuario=$idusuario;
        $ta->save();

       }
       if($request->descripcion){
        $ta=new siennatareassegui();

        $ta->tipo=0;
        $ta->autor=1;
        $ta->siennatareas=$idtarea;
        $ta->cuerpo=$request->descripcion;
        $ta->idusuario=$idusuario;
        $ta->save();

       }
  
        return redirect()
        ->back()
        ->with('success', 'Se Agrego   correctamente!');
 
    }

    public function creartarea(Request $request)
    {       
        
       echo  $tick=$request->ticketid;
       echo $user=$request->agent;
       echo $texttask=$request->texttask;
       echo $nombre=$request->titulo;
       echo $fecha=$request->fecha;
       $merchant=$this->dominio();

      

       $ta=new siennatareas();
       $ta->nombre=$nombre;
       $ta->descripcion=$texttask;
       $ta->users=$user;
       $ta->siennatickets=$tick;
       $ta->estadotarea=1;
       $ta->visto=0;
       $ta->fechalimite=$fecha;
       $ta->save();
     
        return redirect()
        ->back()
        ->with('success', 'Se Agrego correctamente!');
 
    }

    
    public function actualizartarea(Request $request)
    {
        echo $idtarea = $request->idtarea;
        echo $idestadotarea = $request->estadotarea;

        $si2 = siennatareas::find($idtarea);
        $si2->estadotarea = $idestadotarea;
        $si2->save();

        return redirect()

        ->back()
        ->with('success', 'Se modificó correctamente el estado de la tarea!');
    }

    //crear tickets getdata
    public function crearticketsiennaclientegetdata(Request $request){

        $cliente=$request->number_client;
        $phone=$request->phone_client;
        $depto=$request->depto;
        $siennatopic=$request->topicos;
        $logeado=$request->logeado;

        $si = new siennatickets();
        $si->siennadepto = $depto;
        $si->cliente = $cliente;
        $si->nya = $cliente;
        $si->cel = $phone;
        $si->siennatopic = $siennatopic;
        $si->siennasource = "11";
        $si->siennaestado = "1";
        $si->asignado = "99999";
        $tik=$si->save();

       

        $se = new siennaseguimientos();
        $se->ticket = $si->id;
        $se->tipo = "1";
        $se->descripcion = "created";
        $se->autor = $logeado;
        $se->save();  

        $se2 = new siennaseguimientos();
        $se2->ticket = $si->id;
        $se2->tipo = "2";
        $se2->descripcion = $request->textticket;
        $se2->autor = $logeado;
        $se2->save();
        $id = $si->id;

        if (isset($request->evicence)) {
            $logo = $request->file('evicence');
           // dd($logo);
          //  $content = file_get_contents($url);
    
    
            $archi=Str::of($logo)->basename();
            $domi=$this->dominio();

            $ruta=$domi."/interno";

            $logo= Storage::disk('do')->put($ruta, $logo);
            $se2 = new siennaseguimientos();
            $se2->ticket = $si->id;
            $se2->logo = $logo;
            $se2->tipo = "9";
            $se2->descripcion = "ENVIADO";
            $se2->autor = $logeado;
            $se2->save();
       
       }

        $button = '<button onclick="sal(`'. $id .'`,`'. $phone .'`)" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#create-ticket-modal-2"><i class="mdi mdi-whatsapp"></i> Enviar Whatsapp</button>';

        return redirect()
        ->back()
        ->with('success', 'Se creó el ticket ' . $id . ' ' . $button);

    }


    
    public function getsalienteticket(Request $request){

        $valores=$request->ticketid;
        $phone=$request->phone;
        $parametros="ticket_id";
        
        //$url="https://publicapi.xenioo.com/broadcasts/5LqtdyZuO2Fw2XNl8lwTuCD6ykjnCvPM/FxhDb5zEOAHq2R75lduIyfCqpVGICso1yHHyA9SsHFt3L84cdqBZ5knZlqN5oh1W/direct";
        $emp=empresa::all();
        foreach($emp as $vale){
            $url=$vale->urlchatticketmanual;

        }
        $t=$this->getsalienteticket2($parametros,$valores,$url,$phone);
        return redirect()
        ->back()
        ->with('success', 'Saliente enviado ' );

    }
    public function getsalienteticket2($parametros,$valores,$url,$tel2){

        $curl = curl_init();
      
        // Set headers for the cURL request
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Cookie: xenioo-id=Bearer+ZlHPzQ0ZfubwcHXAjjXMG0hDlJI22S1S0dqgKs0H7O06PghfV3BRy6Wxmn7PLb6RUmfIXRXiijo5X8E7%2flsAUV24IzaB28PYO%2bw90fEOTrp8Hx0WQCQ%2btq69lwpWUZpCg0ga2p%2bQD%2bI9KFMrCB6Ht%2bJM4ZOuekNf%2bYWtUBQ%2bm1prYPb8nDXWuRnU6qgtzr7zInbdRjyNhsdg41gTr7AstZ3sLt2wAXQS%2ba8zSGYe1UZY7gvoYm%2fGKj6TbvAdWnO0WXTVkwnB1jhMbWDX38PYGt2jkNoaUXRWxncuQSxJRzUIBWuTJGju%2b7EZOaoK07cXNk%2bUPBMSV1Q9gV6Gzc8CkA%3d%3d',
        );
     
            echo  $url="https://suricata4.com.ar/api/broadcastconparametros?token=EDElDqlQf3RDP5EDK1pHhugV9M6aCXtwAm57SD0G5JYZjw7RxwZbbfdKMhWYdUUM&parametros=".$parametros."&valores=".$valores."&url=".$url."&tel2=".$tel2;
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
  
       var_dump($response);   
        // Close the cURL resource
        curl_close($curl);
    }


    
    public function mandarmailnuevo(Request $request){

      echo  $texto=$request->comentarios;
      echo "<br>";
      echo   $for=$request->mailaeviar;
      echo "<br>";

      echo $cc=$request->cc;      
      echo "<br>";


     // echo   $for="kayser95@hotmail.com";
      echo "<br>";

      $ticket=$request->ticket;
      echo "<br>";

     echo  $subject=$request->subject;
     echo "<br>";

      if (isset($request->logo)) {
        $rutasimagenes="<br> Archivos Adjuntos:<br>";
        $cont = 1;
        foreach($request->logo as $image) {
          $path = $image->getClientOriginalName();
         echo  $name = time() . '-' . $path;
         echo "<br>";
         $domi=$this->dominio();
         $ruta=$domi."/mail";
         
         $logo= Storage::disk('do')->put($ruta, $image);
         $rutasimagenes.="<a href='https://sienamedia.sfo3.digitaloceanspaces.com/".$logo."'>Adjunto {$cont} </a><br>";
         $se2 = new siennaseguimientos();
         $se2->ticket = $ticket;
         $se2->logo = $logo;
         $se2->tipo = "9";
         $se2->descripcion = "https://sienamedia.sfo3.digitaloceanspaces.com/".$logo;
         $se2->autor = "yo";
         $se2->save();
         
         /*
         $gallery = new GalleryImage();
         $gallery->image = $image->storeAs('public/gallery-images', $name);
         $gallery->gallery_id = $request->gallery_id;
         $gallery->save();*/
         $cont++;   
        }

        $texto.=$rutasimagenes;
      }

      
      Mail::mailer('suricata')
                ->send('mailsienna', ["fields2" => $texto], function ($msj) use ($subject,$for, $cc) {
            $msj->from("support@suricata.la", "soporte");
            $msj->subject($subject);
            $msj->to($for);
            if($cc!=null){
                $msj->cc($cc);

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
        return redirect()
        ->back()
        ->with('success', 'Email enviado ' );

        


    }
    


    public function userprofile(Request $request){

          $cliente=$request->cliente;
        //$datos2 = siennatickets::where('cliente', '=', $cliente)->get();

        $datos2 = siennatickets::leftJoin('siennadepto', 'siennadepto.id', '=', 'siennatickets.siennadepto')
        ->leftJoin('siennatopic', 'siennatopic.id', '=', 'siennatickets.siennatopic')
        ->leftJoin('siennaestado', 'siennaestado.id', '=', 'siennatickets.siennaestado')
        ->leftJoin('csat', 'csat.ticket', '=', 'siennatickets.id')
        ->where('siennatickets.cliente', '=', $cliente)
        ->get(['siennatickets.id', 'siennadepto.nombre as departamento', 'siennatopic.nombre as motivo', 'siennaestado.nombre as estado', 'siennatickets.created_at as inicio', 'siennatickets.t_cerrado as cerrado', 'csat.csat', 'siennatickets.id']);
    

        $datos3 = siennacliente::where('cliente', '=', $cliente)->get();
        $domi=$this->dominio();
        $query2="SELECT AVG(csat) AS promedio_csat
FROM ".$domi.".csat
WHERE ticket IN (
    SELECT id
    FROM siennatickets
    WHERE cliente = '".$cliente."'
);";
        $csats = DB::select($query2);
        $prome=0;
        foreach($csats as $val){
            $prome=$val->promedio_csat;

        }
        
        return view('sienna/userprofile')
        ->with('cliente', $cliente)
        ->with('prome', $prome)
        ->with('tickets', $datos2)
        ->with('datoscliente', $datos3)
        ;
    }


    public function llamadobroadcast(Request $request){

        $tel=$request->tel;
        $url=$request->url;
       
        $curl = curl_init();
        // Prepare data array with account key, bot key, and account secret
       
        // Set headers for the cURL request
        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Cookie: xenioo-id=Bearer+ZlHPzQ0ZfubwcHXAjjXMG0hDlJI22S1S0dqgKs0H7O06PghfV3BRy6Wxmn7PLb6RUmfIXRXiijo5X8E7%2flsAUV24IzaB28PYO%2bw90fEOTrp8Hx0WQCQ%2btq69lwpWUZpCg0ga2p%2bQD%2bI9KFMrCB6Ht%2bJM4ZOuekNf%2bYWtUBQ%2bm1prYPb8nDXWuRnU6qgtzr7zInbdRjyNhsdg41gTr7AstZ3sLt2wAXQS%2ba8zSGYe1UZY7gvoYm%2fGKj6TbvAdWnO0WXTVkwnB1jhMbWDX38PYGt2jkNoaUXRWxncuQSxJRzUIBWuTJGju%2b7EZOaoK07cXNk%2bUPBMSV1Q9gV6Gzc8CkA%3d%3d',
        );
     
           //  $url="https://suricata4.com.ar/api/closechat?token=EDElDqlQf3RDP5EDK1pHhugV9M6aCXtwAm57SD0G5JYZjw7RxwZbbfdKMhWYdUUM&idbot=".$idbot."&idconv=".$idconv."&bot_channel=".$bot_channel;
         $url2="https://suricata4.com.ar/api/broadcast?token=EDElDqlQf3RDP5EDK1pHhugV9M6aCXtwAm57SD0G5JYZjw7RxwZbbfdKMhWYdUUM&url=".$url."&tel2=".$tel."";
      //dd($url2);
         // urlpri"https://suricata4.com.ar/api/broadcast?url="+url+"&tel2="+tel2+"&token=EDElDqlQf3RDP5EDK1pHhugV9M6aCXtwAm57SD0G5JYZjw7RxwZbbfdKMhWYdUUM";
 
        // Set options for the cURL request
        $options = array(
            CURLOPT_URL => $url2,
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
        $response = curl_exec($curl);
  
      // dd($response);   
        // Close the cURL resource
        curl_close($curl);
        return redirect()
        ->back()
        ->with('success', 'Enviado ' );
    }


    
    public function ctusers(Request $request)
    {

         $user_id=$request->user_idct;
        $statos=$request->statos;

        $si2 = users::find($user_id);
        $si2->ct = $statos;
        $si2->save();
      
        return redirect()
        ->back()
        ->with('success', 'Se modifico  el registro  correctamente!');

    }

    

    public function derivarpost(Request $request)
    {

        $idticketpedir = $request->idticketpedir;
        $usuarioticket = $request->usuarioticket;
        $logeado = $request->logeado;
        $si2 = siennatickets::find($idticketpedir);
        $si2->asignado = $usuarioticket;
        $horaticket=$si2->created_at ;
        $asuntoticket=$si2->siennatopic ;
        $nyaticket=$si2->nya ;
        $si2->save();


        $us=users::find($usuarioticket);

        $se = new siennaseguimientos();
        $se->ticket = $idticketpedir;
        $se->tipo = "13";
        $se->descripcion = "Derivo a: ".$us->last_name;
        $se->autor = $logeado;
        $se->save();

        $sd = new siennaderivados();
        $sd->ticket = $idticketpedir;
        $sd->supervisor = $us->last_name;
        $sd->autor = $logeado;
        $sd->agente = $logeado;
        $sd->save();
        return redirect()
            ->back()
            ->with('success', 'Se asigno  correctamente!');
    }


    

    public function abminternos(Request $request)
    {
        /*
        $domi=$this->dominio();
        $query2="select * from ".$domi.".siennatareas";
        $tareas = DB::select($query2);


        $query3="select * from ".$domi.".users";
        $usersmerchant = DB::select($query3);
        //$tareas = siennatareas::all()->get();
        return view('sienna/tareas')
        ->with('usersmerchant', $usersmerchant)
        ->with('tareas', $tareas);

        $cliente=1003;
        $nodes=array();
        return view('sienna/abminternos')
        ->with('cliente', $cliente)
        ->with('nodes', $nodes);

        */

        $domi=$this->dominio();
        $query="select * from ".$domi.".siennainternos";
        $sint = DB::select($query);
        $master=(object)[];
        $master->id = 1;
        $master->crear = 1;
        $master->modificar = 1;
        $master->eliminar = 1;
        return view('sienna/abminternos')
        ->with('internos', $sint)
        ->with('master', $master);

    }


    
    public function tagsall(Request $request)
    {

        echo $tags = implode(', ', $request->operacion);
        $usuarioticket = $request->usuarioticket;
        $ticketss = $request->idtickettags;
        $logeado = $request->logeado;
        $sep=explode(",",$ticketss);
        echo $domi=$this->dominio();

        foreach($sep as $val){

            if($val<>""){
                $si2 = siennatickets::find($val);
                $si2->tags = $tags;
                $si2->save();

                $se = new siennaseguimientos();
                $se->ticket = $val;
                $se->tipo = "15";
                $se->descripcion = "tag ";
                $se->autor = $logeado;
                $se->save();
               

            }

        }

        

        return redirect()
            ->back()
            ->with('success', 'Se asigno tags correctamente!');
    }

    public function tags(Request $request)
    {

        $tags = implode(', ', $request->operacion);
        $usuarioticket = $request->usuarioticket;
        $ticketss = $request->idtickettag;
        $logeado = $request->logeado;
        $si2 = siennatickets::find($ticketss);
        $si2->tags = $tags;
        $si2->save();

        $se = new siennaseguimientos();
        $se->ticket = $ticketss;
        $se->tipo = "15";
        $se->descripcion = "tag ";
        $se->autor = $logeado;
        $se->save();
   
        return redirect()
            ->back()
            ->with('success', 'Se asigno tags correctamente!');
    }

    
    public function habilitadousers(Request $request)
    {

         $user_id=$request->user_idhb;
        $statos=$request->statos;
   
        $si2 = users::find($user_id);
        $si2->habilitado = $statos;
        $si2->save();
      
        return redirect()
        ->back()
        ->with('success', 'Se modifico  el registro  correctamente!');

    }

    

    public function pagoraliaorden(Request $request)
    {

         $invoice=$request->invoice;
         $descripcion=$request->descripcion;
         $monto=$request->monto;
         $cliente=$request->cliente;
         $nombre=$request->nombre;
         $apellido=$request->apellido;
         $domi=$this->dominio();
        $query="select * from ".$domi.".siennapagoralia where habilitado='1'";
        $sint = DB::select($query);

        foreach($sint as $val){
            $token=$val->token;
            $url=$val->url;
            $moneda=$val->moneda;
        }
         //curl
         $method="POST";
         $datosjson2='{
                        "isUnique":true,
                        "descripcion":"'.$descripcion.'",
                        "cliente":"'.$cliente.'",
                        "nombre":"'.$nombre.'",
                        "apellido":"'.$apellido.'",
                        "monto":'.$monto.',
                        "moneda":"'.$moneda.'"
                        }';
         $header[] = 'Content-type: application/json';
                $header[] = 'Authorization: Bearer ' . $token;
                $resuktado = $this->curl($url, $datosjson2, $method, $header);
        $si2->save();
      
        return redirect()
        ->back()
        ->with('success', 'Se creo  el registro  correctamente!');

    }
    public function curl($url, $datosjson2, $method, $header)
    {
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
            CURLOPT_POSTFIELDS => $datosjson2,
            CURLOPT_HTTPHEADER => $header,
        ));

        $result = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        return [$result, $httpCode];
    }
}