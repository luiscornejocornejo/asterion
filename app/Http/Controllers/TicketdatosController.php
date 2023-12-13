<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscripcion;
use App\Eve;
use App\Models\categoria;
use App\Models\dashboard;
use App\Models\graficos;
use App\Models\users;
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
                    CURLOPT_TIMEOUT => 0,
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
        $query="update empresa set zona='".$zona."',frecuencia='".$frecuencia."' where id='1'";
        $resultados5 = DB::select($query);
        return redirect()
        ->back()
        ->with('success', 'Se modifico  el registro  correctamente!');

    }

    
    public function rolusers(Request $request)
    {

        $user_id=$request->user_id;
        $statos=$request->statos;



        $query="update users set tipousers='".$statos."'  where id='".$user_id."'";
        $resultados5 = DB::select($query);
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

        
            return view('sienna/empresa')
            ->with('subdomain_tmp', $subdomain_tmp)
            ->with("zonahoraria",$resultados6)
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
     
        $query5="select * ,b.nombre as tipousuario,a.id idusu from users a
        join tipousers b on a.tipousers=b.id
        where tipousers<>'1'";
        $resultados5 = DB::select($query5);
            return view('sienna/agentes')
            ->with('subdomain_tmp', $subdomain_tmp)
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
    public function ventasstatus(Request $request)
    {


        echo   $tik=$request->tik;
        echo   $estado=$request->estado;


        //dd($tik);
        $si2 = siennatickets::find($tik);
        $si2->siennaestado=$estado;
        $si2->save();

        $est=siennaestado::find($estado);
        $estnombre=$est->nombre;
        $se=new siennaseguimientos();
        $se->ticket=$tik;
        $se->tipo="2";
        $se->descripcion="cambio estado ".$estnombre;
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
/*

            sleep(10);
          $query1="update  `".$dbcrear."`.pagoraliaconfig set url='https://".$dbcrear.".pagoralia.live/api/v2/',token='".$token."'  where id='1'";
        $basesdb = DB::connection('mysql2')->select($query1);

         $query2="update  `".$dbcrear."`.base set base='db_".$dbcrear."',nombre='".$dbcrear."' where id='11'";
        $basesdb = DB::connection('mysql2')->select($query2);

         $query3="update  `".$dbcrear."`.masterreport SET nombre = REPLACE(nombre, 'template', '".$dbcrear."') where id='131' ";
        $basesdb = DB::connection('mysql2')->select($query3);

         $query4="update  `".$dbcrear."`.masterreport SET query = REPLACE(query, 'template', '".$dbcrear."') where id='131' ";
        $basesdb = DB::connection('mysql2')->select($query4);

         $query5="update  `".$dbcrear."`.masterreport SET query = REPLACE(query, 'template', '".$dbcrear."') where id='126' ";
        $basesdb = DB::connection('mysql2')->select($query5);

        */
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
}
