<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscripcion;
use App\Eve;
use App\Models\categoria;
use App\Models\dashboard;
use App\Models\graficos;
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
