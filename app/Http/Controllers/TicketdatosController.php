<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscripcion;
use App\Eve;
use App\Models\categoria;
use App\Models\collectorBot;
use App\Models\dashboard;
use App\Models\graficos;
use App\Models\users;
use App\Models\estadonodo;
use App\Models\linknetclientes;

use App\Models\nodos;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\PDO;
use Redirect;
use Flash;
use phpDocumentor\Reflection\PseudoTypes\False_;
use Illuminate\Support\File;
use App\Models\cronmail;
use App\Models\masterreport;
use Mail;
use Illuminate\Support\Facades\Storage;
use App\Models\siennatickets;
use App\Models\siennaloginxenioo;
use App\Models\siennaseguimientos;
use App\Models\siennaestado;
use App\Models\empresa;
use App\Models\prioridad;
use App\Models\siennaintegracion;
use App\Models\motivoc;
use App\Http\Controllers\LogsController;

class TicketdatosController extends Controller
{
    //

    public function datos(Request $request)
    {

        $id=$request->conversation_id;

        $base=14;
        $prueba = $this->conectar($base);
         
         $querycrear="select * from fastnet_os.ost_ticket__cdata where trim(xen_chatid)=trim('".$id."') ";
        $basesdb = DB::connection('mysql2')->select($querycrear);

        $ticket="";
        foreach($basesdb as $value){
            $ticket=$value->ticket_id;
        }
        return view("sienna/Ticketdatos")
        ->with('ticket', $basesdb)
        ->with('id', $id);

    }

    public function creardb(Request $request){

        return view('sienna/creardb');

    }

    public function suricata(Request $request){

    
        $url =  session('urlxennio');
        return view('sienna/suricata')->with('url', $url);

    }



    //nuevo
    public function datossuricata( $email,$AccountAPIKey,$BotAPIKey,$BotAPISecret,$url)
    {
        
       // echo $email;
        $curl = curl_init();

                    curl_setopt_array($curl, array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 10,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>'{
                        "AccountAPIKey":"'.$AccountAPIKey.'",
                        "BotAPIKey":"'.$BotAPIKey.'",
                        "BotAPISecret":"'.$BotAPISecret.'",
                        "Email":"'.$email.'", 
                         "EnableEmbedding":true

                    }',
                    CURLOPT_HTTPHEADER => array(
                        'Accept: application/json',
                        'Content-Type: application/json'
                    ),
                    ));

                    $response = curl_exec($curl);

                    curl_close($curl);
                    
                    return $response;
        
    }
    public function precon(){

        $subdomain_tmp = 'localhost';
        if (isset($_SERVER['HTTP_HOST'])) {
            $domainParts = explode('.', $_SERVER['HTTP_HOST']);
            $subdomain_tmp =  array_shift($domainParts);
        } elseif(isset($_SERVER['SERVER_NAME'])){
            $domainParts = explode('.', $_SERVER['SERVER_NAME']);
            $subdomain_tmp =  array_shift($domainParts);
            
        }

        $queryoriginal="select * from sienna_creado where nombre='".$subdomain_tmp."' ";
        $resultados = DB::connection('mysql3')->select($queryoriginal);
        foreach($resultados as $val){

            $AccountAPIKey=$val->AccountAPIKey;                   

            $BotAPIKey=$val->BotAPIKey;                  

            $BotAPISecret=$val->BotAPISecret;                  

            $saliente=$val->individual;                    
            $version=$val->version;                    

                    if($version==1){
                        $url='https://meerkat.xenioo.com/authorization/sso';

                    }else{
                        $url='https://publicapi.xenioo.com/sso/authorize';
                        }

            session(['saliente' => $saliente]);
        }

        
        $email_suricata =  session('email_suricata');

        $hh= $this->datossuricata($email_suricata,$AccountAPIKey,$BotAPIKey,$BotAPISecret,$url);
        $res=json_decode($hh, true);
        //dd($res);
        if($res<>''){
                    if( $url=='https://publicapi.xenioo.com/sso/authorize'){

                         $urlfinal=$res['Data']['Home'];
                         $urlfinal.="/conversation";
                         $url=$urlfinal;
                    }else{
                        $url=$res['Home']."/conversation";
                    }
                    session(['urlxennio' => $url]);

                   // return Redirect::to('/conversations2');
                }else{

                    echo "no login";
        }
    }
    public function suricata2(Request $request){

    
        $dat=$this->precon();
        $url =  session('urlxennio');
        

        
        return view('sienna/suricata2')->with('url', $url);

    }

    public function suricatafacu(Request $request){

    
        $dat=$this->precon();
        $url =  session('urlxennio');
        
        return view('sienna/facusinheader')->with('url', $url);

    }
    public function osttickets(){


        $subdomain_tmp = 'localhost';
        if (isset($_SERVER['HTTP_HOST'])) {
            $domainParts = explode('.', $_SERVER['HTTP_HOST']);
            $subdomain_tmp =  array_shift($domainParts);
        } elseif(isset($_SERVER['SERVER_NAME'])){
            $domainParts = explode('.', $_SERVER['SERVER_NAME']);
            $subdomain_tmp =  array_shift($domainParts);
            
        }
        $emaillogeo =  session('email');

       echo  $url4="https://suricata1.com.ar/api/tickets2?maillogeo=".$emaillogeo."&merchat=".$subdomain_tmp ;
        $data="";
        $method="GET";
        $estados=$this->curlnuevo($url4, $data, $method);

      

        return view('sienna/osttickets')->with('datos', $estados); 
  

    }


    ////////siennatickets
    public function ticketssienna(){


        $subdomain_tmp = 'localhost';
        if (isset($_SERVER['HTTP_HOST'])) {
            $domainParts = explode('.', $_SERVER['HTTP_HOST']);
            $subdomain_tmp =  array_shift($domainParts);
        } elseif(isset($_SERVER['SERVER_NAME'])){
            $domainParts = explode('.', $_SERVER['SERVER_NAME']);
            $subdomain_tmp =  array_shift($domainParts);
            
        }
        $emaillogeo =  session('email');

        $idusuario =  session('idusuario');

        $query="select *,
        b.nombre as depto,a.id as ticketid,c.nombre estadoname,d.nombre topicname,a.cel numerocel from siennatickets a
        left join siennadepto b on b.id=a.siennadepto 
        left join  siennaestado c on c.id=a.siennaestado
        left join  siennatopic d on d.id=a.siennatopic
        where a.siennadepto in (select siennadepto from siennadeptouser where users =".$idusuario.")
        and a.siennaestado<>4
        ";
        $query="select *,a.conversation_id,a.user_id,
        b.nombre as depto,a.id as ticketid,c.nombre estadoname,d.nombre topicname,a.cel numerocel from siennatickets a
        left join siennadepto b on b.id=a.siennadepto 
        left join  siennaestado c on c.id=a.siennaestado
        left join  siennatopic d on d.id=a.siennatopic
        where 
         a.siennaestado<>4
        ";

        $query2="select * from siennaestado";
        $resultados = DB::select($query);
        $resultados2 = DB::select($query2);

        $querydeptos="select * from siennadepto";
        $resultadosdeptos = DB::select($querydeptos);

        return view('sienna/ticketssienna')->with('datos', $resultados)
        ->with('siennaestado', $resultados2)->with('subdomain_tmp', $subdomain_tmp)
        ->with('deptos', $resultadosdeptos);
  

    }

    public function siennaestado(Request $request){

        
        $idticketestado=$request->idticketestado;
        $statos=$request->statos;
        $queryupdate="update siennatickets set siennaestado='".$statos."' where id='".$idticketestado."'";
        $resultados = DB::select($queryupdate);
        return redirect()
        ->back()
        ->with('success', 'Se Modifico el estado Correctamente');
    }
    public function siennacliente(Request $request){

        
        $idticketcliente=$request->idticketcliente;
        $cliente=$request->cliente;
       


        $ban=0;
        $queryselect="select * from siennatickets  where id='".$idticketcliente."' ";
        $resultadosselect  = DB::select($queryselect);

        foreach($resultadosselect  as $val){

            $nya=$val->nya;
            $cel=$val->cel;
        }



        try {

            $queryinsert="INSERT INTO siennacliente (cliente, nya, cel) VALUES('".$cliente."', '".$nya."', '".$cel."')";
        $resultadosinsert = DB::select($queryinsert);
        } catch (\Illuminate\Database\QueryException$ex) {
            echo $ex;
            $ban=1;
        }

            if( $ban==0){
                $queryupdate="update siennatickets set cliente='".$cliente."' where id='".$idticketcliente."'";
                $resultados = DB::select($queryupdate);
                $res="Se Modifico el cliente Correctamente";
                
            }else{

                $res="No Se Modifico el cliente Correctamente";

            }
        

        return redirect()
        ->back()
        ->with('success', $res);
    }

    public function siennacrearseguimiento(Request $request){

        
        $descripcion=$request->descripcion;
        $ticket=$request->ticket;


        if (isset($request->logo)) {
                $logo = $request->file('logo')->store('public');

            }else{
                $logo ="";
            }
         
            $creador= session('nombreusuario');

            $queryinsert="INSERT INTO siennaseguimientos (ticket, logo, descripcion, autor, create_at) VALUES(".$ticket.", '".$logo."', '".$descripcion."', '".$creador."', now());
            ";
            $resultados = DB::select($queryinsert);

             $texto="seguimiento creado exitosamente";
              return redirect()->back()->with('success', $texto);

    }


    public function siennacrearusuarios(Request $request){


        $query="select * from siennadepto";
        $resultados = DB::select($query);

        return view('sienna/siennacrearusuarios')->with("deptos",$resultados); 

   
    }

    public function empresadatos2(Request $request)
    {

        $zona=$request->zonahoraria;
        $frecuencia=$request->frecuencia;
        $reabrir=$request->reabrir;
        $mail=$request->mail;
        $user=$request->user;
        $password=$request->password;
        $integracion=$request->integracion;
        $botfrontdesk=$request->botfrontdesk;
        $local=$request->local;
        $urlmetabase=$request->urlmetabase;
        $urlchatticketmanual=$request->urlchatticketmanual;
        
        $query="update empresa set urlchatticketmanual='".$urlchatticketmanual."',urlmetabase='".$urlmetabase."',local='".$local."',botfrontdesk='".$botfrontdesk."',user='".$user."',password='".$password."',mail='".$mail."',zona='".$zona."',frecuencia='".$frecuencia."',reabrir='".$reabrir."' where id='1'";
        $resultados5 = DB::select($query);

        $query2="update siennaintegracion set nombre='".$integracion."'";
        $resultados52 = DB::select($query2);

        return redirect()
        ->back()
        ->with('success', 'Se modifico  el registro  correctamente!');

    }

    
    
    

    

 
    


    
    
    
    public function topiccambiar(Request $request)
    {

        $tik=$request->tik;
        $estado=$request->estado;
        $query="update siennatickets set siennatopic='".$estado."'  where id='".$tik."'";
        $resultados5 = DB::select($query);
        return redirect()
        ->back()
        ->with('success', 'Se modifico  el registro  correctamente!');

    }

    
    public function empresadatos(Request $request)
    {

        $subdomain_tmp = 'localhost';
        if (isset($_SERVER['HTTP_HOST'])) {
            $domainParts = explode('.', $_SERVER['HTTP_HOST']);
            $subdomain_tmp =  array_shift($domainParts);
        } elseif(isset($_SERVER['SERVER_NAME'])){
            $domainParts = explode('.', $_SERVER['SERVER_NAME']);
            $subdomain_tmp =  array_shift($domainParts);
            
        }
        $idusuario=session('idusuario');
     
        $query5="select * from empresa";
        $resultados5 = DB::select($query5);
        
        $query6="select * from zonahoraria";
        $resultados6 = DB::select($query6);
        $query7="select * from siennaintegraciones";
        $resultados7 = DB::select($query7);

        $query8="select nombre from siennaintegracion";
        $resultados8 = DB::select($query8);
        foreach($resultados8 as $val){
            $inte=$val->nombre;
        }
        
            return view('sienna/empresa')
            ->with('subdomain_tmp', $subdomain_tmp)
            ->with("zonahoraria",$resultados6)
            ->with("integraciones",$resultados7)
            ->with("inte",$inte)
            ->with("empresa",$resultados5); 

    }
    
    public function agentes(Request $request)
    {

        $subdomain_tmp = 'localhost';
        if (isset($_SERVER['HTTP_HOST'])) {
            $domainParts = explode('.', $_SERVER['HTTP_HOST']);
            $subdomain_tmp =  array_shift($domainParts);
        } elseif(isset($_SERVER['SERVER_NAME'])){
            $domainParts = explode('.', $_SERVER['SERVER_NAME']);
            $subdomain_tmp =  array_shift($domainParts);
            
        }
        $idusuario=session('idusuario');
        $empresa=session('empresa');
     
        $query5="select * ,b.nombre as tipousuario,a.id idusu,a.nombre nom from users a
        join tipousers b on a.tipousers=b.id
        where tipousers<>'1' and a.empresa='".$empresa."' ";

       
        $resultados5 = DB::select($query5);
        $query3="select * from siennadepto";
        $resultados3 = DB::select($query3);

            return view('sienna/agentes')
            ->with('subdomain_tmp', $subdomain_tmp)
            ->with('deptos', $resultados3)
            ->with("agentes",$resultados5); 

    }
    
    public function operator(Request $request)
    {

        $subdomain_tmp = 'localhost';
        if (isset($_SERVER['HTTP_HOST'])) {
            $domainParts = explode('.', $_SERVER['HTTP_HOST']);
            $subdomain_tmp =  array_shift($domainParts);
        } elseif(isset($_SERVER['SERVER_NAME'])){
            $domainParts = explode('.', $_SERVER['SERVER_NAME']);
            $subdomain_tmp =  array_shift($domainParts);
            
        }
        $idusuario=session('idusuario');
        $areas=session('areas');
        $query="select *,a.conversation_id,a.user_id,
        b.nombre as depto,b.id as iddepto,
        a.id as ticketid,c.nombre estadoname,d.nombre topicname,a.cel numerocel,a.asignado from siennatickets a
        left join siennadepto b on b.id=a.siennadepto 
        left join  siennaestado c on c.id=a.siennaestado
        left join  siennatopic d on d.id=a.siennatopic
        where a.siennaestado not in('3','4')  
         and a.asignado='".$idusuario."' 

         union 

         select *,a.conversation_id,a.user_id,
        b.nombre as depto,b.id as iddepto,
        a.id as ticketid,c.nombre estadoname,d.nombre topicname,a.cel numerocel,a.asignado from siennatickets a
        left join siennadepto b on b.id=a.siennadepto 
        left join  siennaestado c on c.id=a.siennaestado
        left join  siennatopic d on d.id=a.siennatopic
        where a.siennaestado not in('3','4')  
         and a.asignado='99999'
         and a.siennadepto='".$areas."'
        ";


        $queryempresa="select * from empresa";
        $resultadosempresa = DB::select($queryempresa);
        foreach($resultadosempresa as $val){
            $frecuencia=$val->frecuencia;
        }
        session(['frecuencia' => $frecuencia]);

        $resultados = DB::select($query);

        $maxid=0; 
        foreach($resultados as $val){
                            
            $maxid=$val->ticketid;
            
        }

       echo  session(['maxid' => $maxid]);

        $query2="select * from siennaestado";
        $resultados2 = DB::select($query2);

        $query3="select * from siennadepto";
        $resultados3 = DB::select($query3);
        
        $query4="select * from siennasource";
        $resultados4 = DB::select($query4);


        $query5="select * from iconostipo";
        $resultados5 = DB::select($query5);
            return view('sienna/operator')
            ->with('subdomain_tmp', $subdomain_tmp)
            ->with("tickets",$resultados)
            ->with("maxid",$maxid)
            ->with("deptos",$resultados3)
            ->with("iconos",$resultados5)
            ->with("source",$resultados4)
            ->with("estados",$resultados2); 

    }
    

    public function busquedaavanzada(Request $request)
    {

        $subdomain_tmp = 'localhost';
        if (isset($_SERVER['HTTP_HOST'])) {
            $domainParts = explode('.', $_SERVER['HTTP_HOST']);
            $subdomain_tmp =  array_shift($domainParts);
        } elseif(isset($_SERVER['SERVER_NAME'])){
            $domainParts = explode('.', $_SERVER['SERVER_NAME']);
            $subdomain_tmp =  array_shift($domainParts);
            
        }
        $idusuario=session('idusuario');
        $areas=session('areas');
        $query="select *,a.conversation_id,a.user_id,
        b.nombre as depto,b.id as iddepto,
        a.id as ticketid,c.nombre estadoname,d.nombre topicname,a.cel numerocel,a.asignado from siennatickets a
        left join siennadepto b on b.id=a.siennadepto 
        left join  siennaestado c on c.id=a.siennaestado
        left join  siennatopic d on d.id=a.siennatopic
        where a.siennaestado not in('3','4')  
         and a.asignado='".$idusuario."' 

         union 

         select *,a.conversation_id,a.user_id,
        b.nombre as depto,b.id as iddepto,
        a.id as ticketid,c.nombre estadoname,d.nombre topicname,a.cel numerocel,a.asignado from siennatickets a
        left join siennadepto b on b.id=a.siennadepto 
        left join  siennaestado c on c.id=a.siennaestado
        left join  siennatopic d on d.id=a.siennatopic
        where a.siennaestado not in('3','4')  
         and a.asignado='99999'
         and a.siennadepto='".$areas."'
        ";


        $queryempresa="select * from empresa";
        $resultadosempresa = DB::select($queryempresa);
        foreach($resultadosempresa as $val){
            $frecuencia=$val->frecuencia;
        }
        session(['frecuencia' => $frecuencia]);

        $resultados = DB::select($query);

        $maxid=0; 
        foreach($resultados as $val){
                            
            $maxid=$val->ticketid;
            
        }

       echo  session(['maxid' => $maxid]);

        $query2="select * from siennaestado";
        $resultados2 = DB::select($query2);

        $query3="select * from siennadepto";
        $resultados3 = DB::select($query3);
        
        $query4="select * from siennasource";
        $resultados4 = DB::select($query4);


        $query5="select * from iconostipo";
        $resultados5 = DB::select($query5);
            return view('sienna/busquedaavanzada')
            ->with('subdomain_tmp', $subdomain_tmp)
            ->with("tickets",$resultados)
            ->with("maxid",$maxid)
            ->with("deptos",$resultados3)
            ->with("iconos",$resultados5)
            ->with("source",$resultados4)
            ->with("estados",$resultados2); 

    }
    public function supervisor(Request $request)
    {

        $subdomain_tmp = 'localhost';
        if (isset($_SERVER['HTTP_HOST'])) {
            $domainParts = explode('.', $_SERVER['HTTP_HOST']);
            $subdomain_tmp =  array_shift($domainParts);
        } elseif(isset($_SERVER['SERVER_NAME'])){
            $domainParts = explode('.', $_SERVER['SERVER_NAME']);
            $subdomain_tmp =  array_shift($domainParts);
            
        }
        $idusuario=session('idusuario');
        $areas=session('areas');
        $query="select *,a.conversation_id,a.user_id,
        b.nombre as depto,b.id as iddepto,
        a.id as ticketid,c.nombre estadoname,d.nombre topicname,a.cel numerocel,a.asignado from siennatickets a
        left join siennadepto b on b.id=a.siennadepto 
        left join  siennaestado c on c.id=a.siennaestado
        left join  siennatopic d on d.id=a.siennatopic
        where a.siennaestado not in('3','4')  
         and a.asignado='".$idusuario."' 

         union 

         select *,a.conversation_id,a.user_id,
        b.nombre as depto,b.id as iddepto,
        a.id as ticketid,c.nombre estadoname,d.nombre topicname,a.cel numerocel,a.asignado from siennatickets a
        left join siennadepto b on b.id=a.siennadepto 
        left join  siennaestado c on c.id=a.siennaestado
        left join  siennatopic d on d.id=a.siennatopic
        where a.siennaestado not in('3','4')  
         and a.asignado='99999'
         and a.siennadepto='".$areas."'
        ";


        $queryempresa="select * from empresa";
        $resultadosempresa = DB::select($queryempresa);
        foreach($resultadosempresa as $val){
            $frecuencia=$val->frecuencia;
        }
        session(['frecuencia' => $frecuencia]);

        $resultados = DB::select($query);

        $maxid=0; 
        foreach($resultados as $val){
                            
            $maxid=$val->ticketid;
            
        }

       echo  session(['maxid' => $maxid]);

        $query2="select * from siennaestado";
        $resultados2 = DB::select($query2);

        $query3="select * from siennadepto";
        $resultados3 = DB::select($query3);

        $queryextras="select * from extras where view='1'";
        $resultadosextras = DB::select($queryextras);

        
        $query4="select * from siennasource";
        $resultados4 = DB::select($query4);
        $queryusers="select * from users where tipousers in ('2','3')";
        $resultadosusers = DB::select($queryusers);

        $query5="select * from iconostipo";
        $resultados5 = DB::select($query5);
        $query6="select * from prioridad";
        $resultados6 = DB::select($query6);

        $query7="select * from siennatags";
        $resultados7 = DB::select($query7);

            return view('sienna/supervisor')
            ->with('subdomain_tmp', $subdomain_tmp)
            ->with("tickets",$resultados)
            ->with("maxid",$maxid)
            ->with("prioridades",$resultados6)
            ->with("siennatags",$resultados7)
            ->with("deptos",$resultados3)
            ->with("iconos",$resultados5)
            ->with("source",$resultados4)
            ->with("usersmerchant",$resultadosusers)
            ->with("resultadosextras",$resultadosextras)

            
            ->with("estados",$resultados2); 

    }
    public function supervisor2(Request $request)
    {

        $subdomain_tmp = 'localhost';
        if (isset($_SERVER['HTTP_HOST'])) {
            $domainParts = explode('.', $_SERVER['HTTP_HOST']);
            $subdomain_tmp =  array_shift($domainParts);
        } elseif(isset($_SERVER['SERVER_NAME'])){
            $domainParts = explode('.', $_SERVER['SERVER_NAME']);
            $subdomain_tmp =  array_shift($domainParts);
            
        }
        $idusuario=session('idusuario');
        $areas=session('areas');
        $query="select *,a.conversation_id,a.user_id,
        b.nombre as depto,b.id as iddepto,
        a.id as ticketid,c.nombre estadoname,d.nombre topicname,a.cel numerocel,a.asignado from siennatickets a
        left join siennadepto b on b.id=a.siennadepto 
        left join  siennaestado c on c.id=a.siennaestado
        left join  siennatopic d on d.id=a.siennatopic
        where a.siennaestado not in('3','4')  
         and a.asignado='".$idusuario."' 

         union 

         select *,a.conversation_id,a.user_id,
        b.nombre as depto,b.id as iddepto,
        a.id as ticketid,c.nombre estadoname,d.nombre topicname,a.cel numerocel,a.asignado from siennatickets a
        left join siennadepto b on b.id=a.siennadepto 
        left join  siennaestado c on c.id=a.siennaestado
        left join  siennatopic d on d.id=a.siennatopic
        where a.siennaestado not in('3','4')  
         and a.asignado='99999'
         and a.siennadepto='".$areas."'
        ";


        $queryempresa="select * from empresa";
        $resultadosempresa = DB::select($queryempresa);
        foreach($resultadosempresa as $val){
            $frecuencia=$val->frecuencia;
        }
        session(['frecuencia' => $frecuencia]);

        $resultados = DB::select($query);

        $maxid=0; 
        foreach($resultados as $val){
                            
            $maxid=$val->ticketid;
            
        }

       echo  session(['maxid' => $maxid]);

        $query2="select * from siennaestado";
        $resultados2 = DB::select($query2);

        $query3="select * from siennadepto";
        $resultados3 = DB::select($query3);

        $queryextras="select * from extras where view='1'";
        $resultadosextras = DB::select($queryextras);

        
        $query4="select * from siennasource";
        $resultados4 = DB::select($query4);
        $queryusers="select * from users where tipousers in ('2','3')";
        $resultadosusers = DB::select($queryusers);

        $query5="select * from iconostipo";
        $resultados5 = DB::select($query5);
        $query6="select * from prioridad";
        $resultados6 = DB::select($query6);

        $query7="select * from siennatags";
        $resultados7 = DB::select($query7);

            return view('sienna/supervisor2')
            ->with('subdomain_tmp', $subdomain_tmp)
            ->with("tickets",$resultados)
            ->with("maxid",$maxid)
            ->with("prioridades",$resultados6)
            ->with("siennatags",$resultados7)
            ->with("deptos",$resultados3)
            ->with("iconos",$resultados5)
            ->with("source",$resultados4)
            ->with("usersmerchant",$resultadosusers)
            ->with("resultadosextras",$resultadosextras)

            
            ->with("estados",$resultados2); 

    }
    public function operator2(Request $request)
    {

        $subdomain_tmp = 'localhost';
        if (isset($_SERVER['HTTP_HOST'])) {
            $domainParts = explode('.', $_SERVER['HTTP_HOST']);
            $subdomain_tmp =  array_shift($domainParts);
        } elseif(isset($_SERVER['SERVER_NAME'])){
            $domainParts = explode('.', $_SERVER['SERVER_NAME']);
            $subdomain_tmp =  array_shift($domainParts);
            
        }
        $idusuario=session('idusuario');
        $query="select *,a.conversation_id,a.user_id,
        b.nombre as depto,b.id as iddepto,
        a.id as ticketid,c.nombre estadoname,d.nombre topicname,a.cel numerocel from siennatickets a
        left join siennadepto b on b.id=a.siennadepto 
        left join  siennaestado c on c.id=a.siennaestado
        left join  siennatopic d on d.id=a.siennatopic
        where a.siennaestado not in('3','4')  
         and a.asignado='".$idusuario."'
        ";

        $resultados = DB::select($query);
        $query2="select * from siennaestado";
        $resultados2 = DB::select($query2);

        $query3="select * from siennadepto";
        $resultados3 = DB::select($query3);

        $query4="select * from iconostipo";
        $resultados4 = DB::select($query4);
        
            return view('sienna/operator2')
            ->with('subdomain_tmp', $subdomain_tmp)
            ->with("tickets",$resultados)
            ->with("deptos",$resultados3)
            ->with("iconos",$resultados4)
            ->with("estados",$resultados2); 

    }

    public function llamadobroadcast($url,$tel){

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
            CURLOPT_TIMEOUT => 30,
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
    }
    public function ventasstatus(Request $request)
    {


        echo   $tik=$request->tik;
        echo   $estado=$request->estado;
        echo   $source=$request->source;
        echo   $motivoc=$request->motivoc;
        echo   $descp=$request->descp;
        
        $idbot=$request->idbot;
        $idconv=$request->idconv;
        $userId=$request->userId;
        $bot_channel=$request->bot_channel;
        $subdomain_tmp = 'localhost';
        if (isset($_SERVER['HTTP_HOST'])) {
            $domainParts = explode('.', $_SERVER['HTTP_HOST']);
            $subdomain_tmp =  array_shift($domainParts);
        } elseif(isset($_SERVER['SERVER_NAME'])){
            $domainParts = explode('.', $_SERVER['SERVER_NAME']);
            $subdomain_tmp =  array_shift($domainParts);
            
        }
        if($estado==4){

           
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
         
                 //$url="https://suricata4.com.ar/api/closechat?token=EDElDqlQf3RDP5EDK1pHhugV9M6aCXtwAm57SD0G5JYZjw7RxwZbbfdKMhWYdUUM&idbot=".$idbot."&idconv=".$idconv."&bot_channel=".$bot_channel."&merchant=".$subdomain_tmp;
                 $url="https://suricata4.com.ar/api/closechat?token=EDElDqlQf3RDP5EDK1pHhugV9M6aCXtwAm57SD0G5JYZjw7RxwZbbfdKMhWYdUUM&idbot=".$idbot."&idconv=".$idconv;
                 echo   $url="https://suricata4.com.ar/api/closechat?token=EDElDqlQf3RDP5EDK1pHhugV9M6aCXtwAm57SD0G5JYZjw7RxwZbbfdKMhWYdUUM&idbot=".$idbot."&idconv=".$idconv."&bot_channel=".$source;
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
            //dd($url);
            //sleep(30);
            //if($subdomain_tmp =="soporte"){
               
                $moti=motivoc::find($motivoc);
                try {
                    if (!isset($moti->url)) {
                        echo $motivoc;
                       // throw new Exception("La propiedad 'url' no existe en el objeto.");
                    }
                    $urlbroad = $moti->url;
                    echo "La URL es: $urlbroad";
                } catch (Exception $e) {
                    echo 'Error: ' . $e->getMessage();
                    $urlbroad="0";
                }

                $si44 = siennatickets::find($tik);
                $telbroad=$si44->cel;
                
                //$telbroad="+5491160480646";
                if($urlbroad<>"0"){
                    echo "entra";

                    if($telbroad<>""){
                        //

                        $tt=$this->llamadobroadcast($urlbroad,$telbroad);
                    }
                }
           // }
    
        }
        //dd($tik);
        $si2 = siennatickets::find($tik);
        $estadoant=$si2->siennaestado;

        $si2->siennaestado=$estado;
        $si2->cerrador_ticket = $userId;
        $si2->descripciondelcierre= $descp;
        if($estado==4){

            if($source<>'7'){
                $si2->cliente=$request->client_number;

            }
            $si2->motivoc=$request->motivoc;

            $si2->t_cerrado=date("Y-m-d H:i:s");
            
        }
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


        $subdomain_tmp = 'localhost';
        if (isset($_SERVER['HTTP_HOST'])) {
            $domainParts = explode('.', $_SERVER['HTTP_HOST']);
            $subdomain_tmp =  array_shift($domainParts);
        } elseif(isset($_SERVER['SERVER_NAME'])){
            $domainParts = explode('.', $_SERVER['SERVER_NAME']);
            $subdomain_tmp =  array_shift($domainParts);
            
        }
        $query="select *,a.conversation_id,a.user_id,
        b.nombre as depto,a.id as ticketid,c.nombre estadoname,d.nombre topicname,a.cel numerocel from siennatickets a
        left join siennadepto b on b.id=a.siennadepto 
        left join  siennaestadosventas c on c.id=a.siennaestado
        left join  siennatopic d on d.id=a.siennatopic
        where 
         a.siennaestado<>4 and a.siennadepto=3
        ";

        $resultados = DB::select($query);
        $query2="select * from siennaestadosventas";
        $resultados2 = DB::select($query2);
            return view('sienna/ventas')
            ->with('subdomain_tmp', $subdomain_tmp)
            ->with("tickets",$resultados)->with("estados",$resultados2); 

    }
    public function ventas(Request $request)
    {

        $subdomain_tmp = 'localhost';
        if (isset($_SERVER['HTTP_HOST'])) {
            $domainParts = explode('.', $_SERVER['HTTP_HOST']);
            $subdomain_tmp =  array_shift($domainParts);
        } elseif(isset($_SERVER['SERVER_NAME'])){
            $domainParts = explode('.', $_SERVER['SERVER_NAME']);
            $subdomain_tmp =  array_shift($domainParts);
            
        }
        $idusuario=session('idusuario');
        $query="select *,a.conversation_id,a.user_id,
        b.nombre as depto,a.id as ticketid,c.nombre estadoname,d.nombre topicname,a.cel numerocel from siennatickets a
        left join siennadepto b on b.id=a.siennadepto 
        left join  siennaestadosventas c on c.id=a.siennaestado
        left join  siennatopic d on d.id=a.siennatopic
        where a.siennaestado not in('8','9') and 
         a.siennadepto=3
         and a.asignado='".$idusuario."'
        ";

        $resultados = DB::select($query);
        $query2="select * from siennaestadosventas";
        $resultados2 = DB::select($query2);

            return view('sienna/ventas')
            ->with('subdomain_tmp', $subdomain_tmp)
            ->with("tickets",$resultados)->with("estados",$resultados2); 

    }


    
    public function cerrados(Request $request)
    {

        $subdomain_tmp = 'localhost';
        if (isset($_SERVER['HTTP_HOST'])) {
            $domainParts = explode('.', $_SERVER['HTTP_HOST']);
            $subdomain_tmp =  array_shift($domainParts);
        } elseif(isset($_SERVER['SERVER_NAME'])){
            $domainParts = explode('.', $_SERVER['SERVER_NAME']);
            $subdomain_tmp =  array_shift($domainParts);
            
        }
        $query2="select * from siennaestado";
        $resultados2 = DB::select($query2);

        $query3="select * from siennadepto";
        $resultados3 = DB::select($query3);
        
        $query4="select * from siennasource";
        $resultados4 = DB::select($query4);


        $query5="select * from iconostipo";
        $resultados5 = DB::select($query5);

            return view('sienna/cerrados')
            ->with('subdomain_tmp', $subdomain_tmp)
            
            ->with("deptos",$resultados3)
            ->with("iconos",$resultados5)
            ->with("source",$resultados4)
            ->with("estados",$resultados2); 

    }

    
  




    public function siennacrearusuariospost(Request $request){

     
        
        $grupossso=$request->grupossso;
        $mailsso=$request->nombre.$request->apellido."@suricata.la";
        $grup="";
        foreach($grupossso as $val){

          $grup.=$val.";";
        }

        $grup=substr($grup,0,-1);
        var_dump($grup);
        // dd($mailsso);
        if (isset($_SERVER['HTTP_HOST'])) {
            $domainParts = explode('.', $_SERVER['HTTP_HOST']);
            $subdomain_tmp =  array_shift($domainParts);
        } elseif(isset($_SERVER['SERVER_NAME'])){
            $domainParts = explode('.', $_SERVER['SERVER_NAME']);
            $subdomain_tmp =  array_shift($domainParts);
            
        }

        $url="http://146.190.115.238/api/createuser?token=EDElDqlQf3RDP5EDK1pHhugV9M6aCXtwAm57SD0G5JYZjw7RxwZbbfdKMhWYdUUM&botid=".$subdomain_tmp."&grupo=".$grup."&tipo=".$request->tipo."&email=".$mailsso.""; 
       //dd($url);
 
       $curl = curl_init();

       curl_setopt_array($curl, array(
         CURLOPT_URL => $url,
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_ENCODING => '',
         CURLOPT_MAXREDIRS => 10,
         CURLOPT_TIMEOUT => 0,
         CURLOPT_FOLLOWLOCATION => true,
         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         CURLOPT_CUSTOMREQUEST => 'GET',
     
       ));
       echo "<br><br>";
        echo $response = curl_exec($curl);

        curl_close($curl);
 


        $us=new users();
        $us->nombre=$request->nombre;
        $us->last_name=$request->apellido;
        $us->email=$request->maill;

        if($request->tipo=="supervisor"){
            $cat=10;
        }
        if($request->tipo=="ventas"){
            $cat=11;
        }
        if($request->tipo=="agente"){
            $cat=9;
        }
      
        $us->categoria=$cat;
        $us->password=md5($request->pass);
        $us->email_suricata=$mailsso;
        $us->save();
        
       return redirect() 
        ->back() 
        ->with('success', 'Se Creo  correctamente! el usuario');

    }
    
    ////////fin sienna tickets
    public function curlnuevo($url, $data, $method)
    {

        var_dump($data);

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
            CURLOPT_HTTPHEADER => array(
               "Content-Type: application/json",
               "Accept: application/json",
             
           ),
        ));

        $result = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        return [$result, $httpCode];
    }

    
    //hasta

    public function creardbpost(Request $request)
    {

        $dbcrear=$request->db;
        $contents = Storage::disk('sftp')->get('subdomains_config/.redlam');
        $contents2= str_replace("redlam", $dbcrear, $contents);
        $path2=Storage::disk('sftp')->put('subdomains_config/.'.$dbcrear, $contents2);
        $ftp_files = Storage::disk('sftp')->files('subdomains_config');

        $dbcrear=$request->db;
       // $token=$request->token;    
        $base = 13;
        $prueba = $this->conectar($base);
        $querycrear="CREATE DATABASE  `".$dbcrear."`; ";
        $basesdb = DB::connection('mysql2')->select($querycrear);

        $query = "SHOW  TABLES";
        $basesdb = DB::connection('mysql2')->select($query);
        foreach($basesdb as $key=>$value){

           
            foreach($value as  $value2){


                 $querygeneral="CREATE TABLE  `".$dbcrear."`.".$value2." LIKE sienna1.".$value2." ";
               
               try {

                     $actualizarorder = DB::connection('mysql2')->select($querygeneral);

                     } 
                catch (\Illuminate\Database\QueryException$ex) {
                        continue;
                     }

            }

        }


        foreach($basesdb as $key=>$value){

           
            foreach($value as  $value2){


                 $querygeneral2="INSERT  `".$dbcrear."`.".$value2." SELECT *
                 FROM sienna1.".$value2." ";
               
               try {

                     $actualizarorder = DB::connection('mysql2')->select($querygeneral2);

                     } 
                catch (\Illuminate\Database\QueryException$ex) {
                        continue;
                     }

            }

        }

        echo "ok";

        return redirect()
        ->back()
        ->with('success', 'Se Creo  correctamente! el cliente')
        ->with('lista', $ftp_files)  ;

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
    public function nodes(Request $request)
    {
        $query = "SELECT *,a.idget as iddelerp,b.nombre as nombredelestadonodo,a.nombre as nombredelnodo,a.id idnodo  FROM `nodos` a join estadonodo b
        on  b.id=a.estadonodo";
        $nodes = DB::select($query);

     $listnodos=estadonodo::all();

        return view("sienna/nodes")
            ->with('nodes', $nodes)
            ->with('listnodos', $listnodos)
          ;
    }
    public function nodespost(Request $request)
    {


        $message=$request->message;
        $estado=$request->estado;
        $lista=$request->lista;

        foreach($lista as $value){

            $no = nodos::find($value);
            $no->mensaje=$message;
            $no->estadonodo=$estado;
            $no->save();
            
        }
        return redirect()
        ->back()
        ->with('success', 'Se Modifico el estado Correctamente');
    }

   
    public function subirclientes(Request $request)
    {
        $entireTable = linknetclientes::all();
        return view("sienna/subirclientes") ->with('entireTable', $entireTable);

    }

    public function subirclientespost(Request $request)
    {


        //
       
        linknetclientes::truncate();

        $archivo = $request->file('file');
        $gestor = @fopen($archivo, "r");
        $errores=array();
        if ($gestor) {
            $cont = 0;
            while (($búfer = fgets($gestor, 4096)) !== false) {
                if ($cont == 0) {
                    $cont++;
                    continue;
                }  

                $lista = explode(";", $búfer);
                $linknetclientes = new linknetclientes();

                 $codigo = $this->limpiar2($lista[0]);
                 $documento = $this->limpiar2($lista[1]);
                 $nombre = $this->limpiar2($lista[2]);
                 $apellido = $this->limpiar2($lista[3]);
                 $domicilio = $this->limpiar2($lista[4]);
                 $telefono = $this->limpiar2($lista[5]);
                 $email = $this->limpiar2($lista[6]);
                 $servicios = $this->limpiar2($lista[7]);
                 $plan = $this->limpiar2($lista[8]);
                 $nodo = $this->limpiar2($lista[9]);
                 $complejo = $this->limpiar2($lista[10]);
                 $empresa = $this->limpiar2($lista[11]);
                 $saldo_mes = $this->limpiar2($lista[12]);

             

               $linknetclientes->codigo=$codigo;
               $linknetclientes->documento=$documento;
               $linknetclientes->nombre=$nombre;
               $linknetclientes->apellido=$apellido;
               $linknetclientes->domicilio=$domicilio;
               $linknetclientes->telefono=$telefono;
               $linknetclientes->email=$email;
               $linknetclientes->servicios=$servicios;
               $linknetclientes->plan=$plan;
               $linknetclientes->nodo=$nodo;
               $linknetclientes->complejo=$complejo;
               $linknetclientes->empresa=$empresa;
               $linknetclientes->saldo_mes=$saldo_mes;

               try{
                $linknetclientes->save();
            } catch (\Illuminate\Database\QueryException $ex) {
                //$message22 = $message->move($folder_path = "noleidos");
                echo "nose pudo:".$ex;
                continue;
            }
               
             
                $cont++;
            }
            if (!feof($gestor)) {
                echo "Error: fallo inesperado de fgets()\n";
            }
            fclose($gestor);
        }
        $entireTable = linknetclientes::all();

        return redirect()
            ->back()
            ->with('entireTable', $entireTable);

    }

    private function limpiar($query)
    {
        $query = strtolower($query);
        $healthy = array("drop", "truncate", "insert", "update ");
        $yummy = array("", "", "", "");

        $query = str_replace($healthy, $yummy, $query);

        return $query;
    }
    private function limpiar2($query)
    {
        $query = strtolower($query);
        $healthy = array("drop", "truncate", "insert", "update ", ", ");
        $yummy = array("", "", "", "");

        $query = str_replace($healthy, $yummy, $query);

        return $query;
    }
    public function linknetclientes(Request $request)
    {

        return response()->download(public_path('linknetclientes.csv'));
    }

    public function tc(Request $request)
    {

        $subdomain_tmp = 'localhost';
        if (isset($_SERVER['HTTP_HOST'])) {
            $domainParts = explode('.', $_SERVER['HTTP_HOST']);
            $subdomain_tmp =  array_shift($domainParts);
        } elseif(isset($_SERVER['SERVER_NAME'])){
            $domainParts = explode('.', $_SERVER['SERVER_NAME']);
            $subdomain_tmp =  array_shift($domainParts);
            
        }

        $tick=$request->tick;
        if(isset($request->logueado)){

            $st = siennatickets::find($tick);
            $logeado = session('idusuario');

            $st->asignado=$logeado;
            $st->save();
        }
        $empresa = session('empresa');
        $query="select *,a.empresa as idempresa,a.lat,a.lng,a.conversation_id,a.user_id,concat(e.nombre,' ',e.last_name) as nombreagente,
        b.nombre as depto,b.id as iddepto,g.nombre as nombreprioridad,g.colore as colorprioridad,
        a.id as ticketid,c.nombre estadoname,d.nombre topicname,a.cel numerocel,a.asignado,a.email as asunto,a.nya emailnom,a.cliente emailcliente,
        cb.dato as datoCollector, a.cliente iddelcliente,
        convertirTiempo(a.created_at  ) as creacion from 
        ".$subdomain_tmp.".siennaticketsc a
        left join ".$subdomain_tmp.".siennadepto b on b.id=a.siennadepto 
        left join  ".$subdomain_tmp.".siennaestado c on c.id=a.siennaestado
        left join  ".$subdomain_tmp.".siennatopic d on d.id=a.siennatopic
        left join  ".$subdomain_tmp.".users e on e.id=a.asignado
        left join  ".$subdomain_tmp.".siennacliente f on f.cliente=a.cliente
        left join  ".$subdomain_tmp.".prioridad g on g.id=a.prioridad
        left join  ".$subdomain_tmp.".collectorbot cb on cb.ticket=a.id 
        

        
        where a.id='".$tick."'   limit 1";

        dd($query);
        $resultados = DB::select($query);
        $cont=0;
        foreach($resultados as $valu){

                $siennasource=$valu->siennasource;
                $cont++;
        }
        if($cont==0){
            return view("404");
        }

        $query50="select *, convertirTiempo(created_at) as created_at  from siennaseguimientos where ticket='".$tick."'  order by id desc";
        $segui = DB::select($query50);
       // $segui = siennaseguimientos::where('ticket', $tick)->get();

        $query5="select * from iconostipo";
        $resultados5 = DB::select($query5);

        $query6="select * from users where tipousers in ('2','3') and empresa=".$empresa."";
        $usersmerchant= DB::select($query6);

        $query7="select * from siennatags";
        $resultados7 = DB::select($query7);
        $query8="SELECT * 
                        FROM soporte.siennatags 
                WHERE FIND_IN_SET(id, REPLACE((SELECT tags FROM soporte.siennatickets WHERE id = '".$tick."'), ' ', ''));";
        $resultados8 = DB::select($query8);
       // dd($resultados);
       $querydeptos="select * from siennadepto";
       $resultadosdeptos = DB::select($querydeptos);

       $querymails="select * from siennamail where siennatickets='".$tick."'";
       $resultadosmails = DB::select($querymails);


       $querytareas="select *,(select concat(nombre,' ',last_name) from users where id=st.users) as usuario,(select nombre from estadotarea where id=st.estadotarea) as estadoname
        from siennatareas st where st.siennatickets='".$tick."'";
       $resultadostareas = DB::select($querytareas);

       $queryhistorico="select s.id,s.cliente,s2.nombre as depto,s3.nombre as tema,s4.nombre as estado,convertirTiempo(s.created_at) as inicio
         from 
            siennaticketsc s
       left join siennadepto s2 on s2.id =s.siennadepto 
       left join siennatopic s3   on s3.id =s.siennatopic 
       left join siennaestado s4     on s4.id =s.siennaestado  
       where cliente =(select cliente from siennatickets where id='".$tick."')";
       $resultadoshistoricos = DB::select($queryhistorico);


       $querycliente="SELECT  *
       FROM siennacliente
       where cliente =(select cliente from siennaticketsc where id='".$tick."')

       order by created_at desc limit 1";
       $resultadoscliente = DB::select($querycliente);

       $querysuri="select * from siennasuricata where siennatickets='".$tick."'";
       $resultadossuri = DB::select($querysuri);

       $emp=empresa::all();
       $pri=prioridad::all();

       $inte=siennaintegracion::all();
       
       foreach($inte as $val){
            $urlinte=$val->version;
       }
       $urlinte2="";
       $datosonline="";
       
       /*
       prueba
       if($urlinte=="luis"){
            $numcli=$resultados[0]->cliente;
            $urlinte2=$urlinte.$numcli;
          
            if (($datosonline = @file_get_contents($urlinte2)) === false) {
                $error = error_get_last();
                //echo "HTTP request failed. Error was: " . $error['message'];
                $urlinte2="";

          } else {
                echo "Everything went better than expected";
          }

       }*/

       
           
        return view("sienna/tc")
        ->with('subdomain_tmp', $subdomain_tmp)
        ->with('segui', $segui)
        ->with('deptos', $resultadosdeptos)
        ->with('usersmerchant', $usersmerchant)
        ->with('iconos', $resultados5)
        ->with('emp', $emp)
        ->with('datosonline', $datosonline)
        ->with('urlinte2', $urlinte2)
        ->with('pri', $pri)
        ->with('resultadosmails', $resultadosmails)
        ->with('resultadoshistoricos', $resultadoshistoricos)
        ->with('resultadoscliente', $resultadoscliente)
        ->with('resultadossuri', $resultadossuri)
        ->with('resultadostareas', $resultadostareas)
        ->with('siennatags', $resultados7)
        ->with('siennatagstickets', $resultados8)
        ->with('resultados', $resultados);

    }
    public function ticketunico(Request $request)
    {

        $subdomain_tmp = 'localhost';
        if (isset($_SERVER['HTTP_HOST'])) {
            $domainParts = explode('.', $_SERVER['HTTP_HOST']);
            $subdomain_tmp =  array_shift($domainParts);
        } elseif(isset($_SERVER['SERVER_NAME'])){
            $domainParts = explode('.', $_SERVER['SERVER_NAME']);
            $subdomain_tmp =  array_shift($domainParts);
            
        }

        $tick=$request->tick;
        if(isset($request->logueado)){

            $st = siennatickets::find($tick);
            $logeado = session('idusuario');

            $st->asignado=$logeado;
            $st->save();
        }
        $empresa = session('empresa');
        $query="select *,a.empresa as idempresa,a.lat,a.lng,a.conversation_id,a.user_id,concat(e.nombre,' ',e.last_name) as nombreagente,
        b.nombre as depto,b.id as iddepto,g.nombre as nombreprioridad,g.colore as colorprioridad,
        a.id as ticketid,c.nombre estadoname,d.nombre topicname,a.cel numerocel,a.asignado,a.email as asunto,a.nya emailnom,a.cliente emailcliente,
        cb.dato as datoCollector, a.cliente iddelcliente,
        convertirTiempo(a.created_at  ) as creacion from 
        ".$subdomain_tmp.".siennatickets a
        left join ".$subdomain_tmp.".siennadepto b on b.id=a.siennadepto 
        left join  ".$subdomain_tmp.".siennaestado c on c.id=a.siennaestado
        left join  ".$subdomain_tmp.".siennatopic d on d.id=a.siennatopic
        left join  ".$subdomain_tmp.".users e on e.id=a.asignado
        left join  ".$subdomain_tmp.".siennacliente f on f.cliente=a.cliente
        left join  ".$subdomain_tmp.".prioridad g on g.id=a.prioridad
        left join  ".$subdomain_tmp.".collectorbot cb on cb.ticket=a.id 
        

        
        where a.id='".$tick."'   limit 1";

        //dd($query);
        $resultados = DB::select($query);
        $cont=0;
        foreach($resultados as $valu){

                $siennasource=$valu->siennasource;
                $cont++;
        }
        if($cont==0){
            return view("404");
        }

        $query50="select *, convertirTiempo(created_at) as created_at  from siennaseguimientos where ticket='".$tick."'  order by id desc";
        $segui = DB::select($query50);
       // $segui = siennaseguimientos::where('ticket', $tick)->get();

        $query5="select * from iconostipo";
        $resultados5 = DB::select($query5);

        $query6="select * from users where tipousers in ('2','3') and empresa=".$empresa."";
        $usersmerchant= DB::select($query6);

        $query7="select * from siennatags";
        $resultados7 = DB::select($query7);
        $query8="SELECT * 
                        FROM soporte.siennatags 
                WHERE FIND_IN_SET(id, REPLACE((SELECT tags FROM soporte.siennatickets WHERE id = '".$tick."'), ' ', ''));";
        $resultados8 = DB::select($query8);
       // dd($resultados);
       $querydeptos="select * from siennadepto";
       $resultadosdeptos = DB::select($querydeptos);

       $querymails="select * from siennamail where siennatickets='".$tick."'";
       $resultadosmails = DB::select($querymails);


       $querytareas="select *,(select concat(nombre,' ',last_name) from users where id=st.users) as usuario,(select nombre from estadotarea where id=st.estadotarea) as estadoname
        from siennatareas st where st.siennatickets='".$tick."'";
       $resultadostareas = DB::select($querytareas);

       $queryhistorico="select s.id,s.cliente,s2.nombre as depto,s3.nombre as tema,s4.nombre as estado,convertirTiempo(s.created_at) as inicio
         from 
            siennatickets s
       left join siennadepto s2 on s2.id =s.siennadepto 
       left join siennatopic s3   on s3.id =s.siennatopic 
       left join siennaestado s4     on s4.id =s.siennaestado  
       where cliente =(select cliente from siennatickets where id='".$tick."')";
       $resultadoshistoricos = DB::select($queryhistorico);


       $querycliente="SELECT  *
       FROM siennacliente
       where cliente =(select cliente from siennatickets where id='".$tick."')

       order by created_at desc limit 1";
       $resultadoscliente = DB::select($querycliente);

       $querysuri="select * from siennasuricata where siennatickets='".$tick."'";
       $resultadossuri = DB::select($querysuri);

       $emp=empresa::all();
       $pri=prioridad::all();

       $inte=siennaintegracion::all();
       
       foreach($inte as $val){
            $urlinte=$val->version;
       }
       $urlinte2="";
       $datosonline="";
       
       /*
       prueba
       if($urlinte=="luis"){
            $numcli=$resultados[0]->cliente;
            $urlinte2=$urlinte.$numcli;
          
            if (($datosonline = @file_get_contents($urlinte2)) === false) {
                $error = error_get_last();
                //echo "HTTP request failed. Error was: " . $error['message'];
                $urlinte2="";

          } else {
                echo "Everything went better than expected";
          }

       }*/

       
           
        return view("sienna/ticketunico")
        ->with('subdomain_tmp', $subdomain_tmp)
        ->with('segui', $segui)
        ->with('deptos', $resultadosdeptos)
        ->with('usersmerchant', $usersmerchant)
        ->with('iconos', $resultados5)
        ->with('emp', $emp)
        ->with('datosonline', $datosonline)
        ->with('urlinte2', $urlinte2)
        ->with('pri', $pri)
        ->with('resultadosmails', $resultadosmails)
        ->with('resultadoshistoricos', $resultadoshistoricos)
        ->with('resultadoscliente', $resultadoscliente)
        ->with('resultadossuri', $resultadossuri)
        ->with('resultadostareas', $resultadostareas)
        ->with('siennatags', $resultados7)
        ->with('siennatagstickets', $resultados8)
        ->with('resultados', $resultados);

    }

    public function ticketunico2(Request $request)
    {

        $subdomain_tmp = 'localhost';
        if (isset($_SERVER['HTTP_HOST'])) {
            $domainParts = explode('.', $_SERVER['HTTP_HOST']);
            $subdomain_tmp =  array_shift($domainParts);
        } elseif(isset($_SERVER['SERVER_NAME'])){
            $domainParts = explode('.', $_SERVER['SERVER_NAME']);
            $subdomain_tmp =  array_shift($domainParts);
            
        }

        $tick=$request->tick;
        $query="select *,a.conversation_id,a.user_id,concat(e.nombre,' ',e.last_name) as nombreagente,
        b.nombre as depto,b.id as iddepto,g.nombre as nombreprioridad,g.colore as colorprioridad,
        a.id as ticketid,c.nombre estadoname,d.nombre topicname,a.cel numerocel,a.asignado,a.email as asunto,a.nya emailnom,a.cliente emailcliente,
        cb.dato as datoCollector, 
        convertirTiempo(a.created_at  ) as creacion from 
        ".$subdomain_tmp.".siennatickets a
        left join ".$subdomain_tmp.".siennadepto b on b.id=a.siennadepto 
        left join  ".$subdomain_tmp.".siennaestado c on c.id=a.siennaestado
        left join  ".$subdomain_tmp.".siennatopic d on d.id=a.siennatopic
        left join  ".$subdomain_tmp.".users e on e.id=a.asignado
        left join  ".$subdomain_tmp.".siennacliente f on f.cliente=a.cliente
        left join  ".$subdomain_tmp.".prioridad g on g.id=a.prioridad
        left join  ".$subdomain_tmp.".collectorbot cb on cb.ticket=a.id 
        

        
        where a.id='".$tick."'";

        $resultados = DB::select($query);
        foreach($resultados as $valu){

                $siennasource=$valu->siennasource;
        }

        $query50="select *, convertirTiempo(created_at) as created_at  from siennaseguimientos where ticket='".$tick."'  order by id desc";
        $segui = DB::select($query50);
       // $segui = siennaseguimientos::where('ticket', $tick)->get();

        $query5="select * from iconostipo";
        $resultados5 = DB::select($query5);

        $query6="select * from users where tipousers in ('2','3')";
        $usersmerchant= DB::select($query6);

        $query7="select * from siennatags";
        $resultados7 = DB::select($query7);
        $query8="SELECT * 
                        FROM soporte.siennatags 
                WHERE FIND_IN_SET(id, REPLACE((SELECT tags FROM soporte.siennatickets WHERE id = '".$tick."'), ' ', ''));";
        $resultados8 = DB::select($query8);
       // dd($resultados);
       $querydeptos="select * from siennadepto";
       $resultadosdeptos = DB::select($querydeptos);

       $querymails="select * from siennamail where siennatickets='".$tick."'";
       $resultadosmails = DB::select($querymails);


       $querytareas="select *,(select concat(nombre,' ',last_name) from users where id=st.users) as usuario,(select nombre from estadotarea where id=st.estadotarea) as estadoname
        from siennatareas st where st.siennatickets='".$tick."'";
       $resultadostareas = DB::select($querytareas);

       $queryhistorico="select s.id,s.cliente,s2.nombre as depto,s3.nombre as tema,s4.nombre as estado,convertirTiempo(s.created_at) as inicio
         from 
            siennatickets s
       left join siennadepto s2 on s2.id =s.siennadepto 
       left join siennatopic s3   on s3.id =s.siennatopic 
       left join siennaestado s4     on s4.id =s.siennaestado  
       where cliente =(select cliente from siennatickets where id='".$tick."')";
       $resultadoshistoricos = DB::select($queryhistorico);


       $querycliente="SELECT  *
       FROM siennacliente
       where cliente =(select cliente from siennatickets where id='".$tick."')

       order by created_at desc limit 1";
       $resultadoscliente = DB::select($querycliente);

       $querysuri="select * from siennasuricata where siennatickets='".$tick."'";
       $resultadossuri = DB::select($querysuri);

       $emp=empresa::all();
       $pri=prioridad::all();

       $inte=siennaintegracion::all();
       
       foreach($inte as $val){
            $urlinte=$val->version;
       }
       $urlinte2="";
       $datosonline="";
       
       /*
       prueba
       if($urlinte=="luis"){
            $numcli=$resultados[0]->cliente;
            $urlinte2=$urlinte.$numcli;
          
            if (($datosonline = @file_get_contents($urlinte2)) === false) {
                $error = error_get_last();
                //echo "HTTP request failed. Error was: " . $error['message'];
                $urlinte2="";

          } else {
                echo "Everything went better than expected";
          }

       }*/
           
        return view("sienna/ticketunico2")
        ->with('subdomain_tmp', $subdomain_tmp)
        ->with('segui', $segui)
        ->with('deptos', $resultadosdeptos)
        ->with('usersmerchant', $usersmerchant)
        ->with('iconos', $resultados5)
        ->with('emp', $emp)
        ->with('datosonline', $datosonline)
        ->with('urlinte2', $urlinte2)
        ->with('pri', $pri)
        ->with('resultadosmails', $resultadosmails)
        ->with('resultadoshistoricos', $resultadoshistoricos)
        ->with('resultadoscliente', $resultadoscliente)
        ->with('resultadossuri', $resultadossuri)
        ->with('resultadostareas', $resultadostareas)
        ->with('siennatags', $resultados7)
        ->with('siennatagstickets', $resultados8)
        ->with('resultados', $resultados);

    }

    public function ticketunico3(Request $request)
    {

        $subdomain_tmp = 'localhost';
        if (isset($_SERVER['HTTP_HOST'])) {
            $domainParts = explode('.', $_SERVER['HTTP_HOST']);
            $subdomain_tmp =  array_shift($domainParts);
        } elseif(isset($_SERVER['SERVER_NAME'])){
            $domainParts = explode('.', $_SERVER['SERVER_NAME']);
            $subdomain_tmp =  array_shift($domainParts);
            
        }

        $tick=$request->tick;
        if(isset($request->logueado)){

            $st = siennatickets::find($tick);
            $logeado = session('idusuario');

            $st->asignado=$logeado;
            $st->save();
        }
        $empresa = session('empresa');
        $query="select *,a.empresa as idempresa,a.lat,a.lng,a.conversation_id,a.user_id,concat(e.nombre,' ',e.last_name) as nombreagente,
        b.nombre as depto,b.id as iddepto,g.nombre as nombreprioridad,g.colore as colorprioridad,
        a.id as ticketid,c.nombre estadoname,d.nombre topicname,a.cel numerocel,a.asignado,a.email as asunto,a.nya emailnom,a.cliente emailcliente,
        cb.dato as datoCollector, a.cliente iddelcliente,
        convertirTiempo(a.created_at  ) as creacion from 
        ".$subdomain_tmp.".siennatickets a
        left join ".$subdomain_tmp.".siennadepto b on b.id=a.siennadepto 
        left join  ".$subdomain_tmp.".siennaestado c on c.id=a.siennaestado
        left join  ".$subdomain_tmp.".siennatopic d on d.id=a.siennatopic
        left join  ".$subdomain_tmp.".users e on e.id=a.asignado
        left join  ".$subdomain_tmp.".siennacliente f on f.cliente=a.cliente
        left join  ".$subdomain_tmp.".prioridad g on g.id=a.prioridad
        left join  ".$subdomain_tmp.".collectorbot cb on cb.ticket=a.id 
        

        
        where a.id='".$tick."'   limit 1";

        //dd($query);
        $resultados = DB::select($query);
        $cont=0;
        foreach($resultados as $valu){

                $siennasource=$valu->siennasource;
                $cont++;
        }
        if($cont==0){
            return view("404");
        }

        $query50="select *, convertirTiempo(created_at) as created_at  from siennaseguimientos where ticket='".$tick."'  order by id desc";
        $segui = DB::select($query50);
       // $segui = siennaseguimientos::where('ticket', $tick)->get();

        $query5="select * from iconostipo";
        $resultados5 = DB::select($query5);

        $query6="select * from users where tipousers in ('2','3') and empresa=".$empresa."";
        $usersmerchant= DB::select($query6);

        $query7="select * from siennatags";
        $resultados7 = DB::select($query7);
        $query8="SELECT * 
                        FROM soporte.siennatags 
                WHERE FIND_IN_SET(id, REPLACE((SELECT tags FROM soporte.siennatickets WHERE id = '".$tick."'), ' ', ''));";
        $resultados8 = DB::select($query8);
       // dd($resultados);
       $querydeptos="select * from siennadepto";
       $resultadosdeptos = DB::select($querydeptos);

       $querymails="select * from siennamail where siennatickets='".$tick."'";
       $resultadosmails = DB::select($querymails);


       $querytareas="select *,(select concat(nombre,' ',last_name) from users where id=st.users) as usuario,(select nombre from estadotarea where id=st.estadotarea) as estadoname
        from siennatareas st where st.siennatickets='".$tick."'";
       $resultadostareas = DB::select($querytareas);

       $queryhistorico="select s.id,s.cliente,s2.nombre as depto,s3.nombre as tema,s4.nombre as estado,convertirTiempo(s.created_at) as inicio
         from 
            siennatickets s
       left join siennadepto s2 on s2.id =s.siennadepto 
       left join siennatopic s3   on s3.id =s.siennatopic 
       left join siennaestado s4     on s4.id =s.siennaestado  
       where cliente =(select cliente from siennatickets where id='".$tick."')";
       $resultadoshistoricos = DB::select($queryhistorico);


       $querycliente="SELECT  *
       FROM siennacliente
       where cliente =(select cliente from siennatickets where id='".$tick."')

       order by created_at desc limit 1";
       $resultadoscliente = DB::select($querycliente);

       $querysuri="select * from siennasuricata where siennatickets='".$tick."'";
       $resultadossuri = DB::select($querysuri);

       $emp=empresa::all();
       $pri=prioridad::all();

       $inte=siennaintegracion::all();
       
       foreach($inte as $val){
            $urlinte=$val->version;
       }
       $urlinte2="";
       $datosonline="";
       
       /*
       prueba
       if($urlinte=="luis"){
            $numcli=$resultados[0]->cliente;
            $urlinte2=$urlinte.$numcli;
          
            if (($datosonline = @file_get_contents($urlinte2)) === false) {
                $error = error_get_last();
                //echo "HTTP request failed. Error was: " . $error['message'];
                $urlinte2="";

          } else {
                echo "Everything went better than expected";
          }

       }*/

       
           
        return view("sienna/ticketunico3")
        ->with('subdomain_tmp', $subdomain_tmp)
        ->with('segui', $segui)
        ->with('deptos', $resultadosdeptos)
        ->with('usersmerchant', $usersmerchant)
        ->with('iconos', $resultados5)
        ->with('emp', $emp)
        ->with('datosonline', $datosonline)
        ->with('urlinte2', $urlinte2)
        ->with('pri', $pri)
        ->with('resultadosmails', $resultadosmails)
        ->with('resultadoshistoricos', $resultadoshistoricos)
        ->with('resultadoscliente', $resultadoscliente)
        ->with('resultadossuri', $resultadossuri)
        ->with('resultadostareas', $resultadostareas)
        ->with('siennatags', $resultados7)
        ->with('siennatagstickets', $resultados8)
        ->with('resultados', $resultados);

    }

}
