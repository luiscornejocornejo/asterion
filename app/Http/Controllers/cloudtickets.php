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
        $si2->asignado = 0;
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
        $urlprincipal2="https://suricata4.com.ar/api/broadcast?url=".$url."&tel2=".$tel2."&token=EDElDqlQf3RDP5EDK1pHhugV9M6aCXtwAm57SD0G5JYZjw7RxwZbbfdKMhWYdUUM";
                            
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
            $si2->asignado = 0;
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
        $tareas = siennatareas::all()->get();
        return view('sienna/tareas')
        ->with('tareas', $tareas);
    }
}