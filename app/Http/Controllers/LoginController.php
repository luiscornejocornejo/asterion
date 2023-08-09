<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscripcion;
use App\Eve;
use Illuminate\Support\Facades\DB;
use Redirect;
use Flash;
use App\Models\users;
use App\Models\graficos;

use phpDocumentor\Reflection\PseudoTypes\False_;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function profile(Request $request)
    {

        return view('sienna/profile');;
    }

    public function suricata( $email,$AccountAPIKey,$BotAPIKey,$BotAPISecret,$url)
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
                        "Email":"'.$email.'"
                    }',
                    CURLOPT_HTTPHEADER => array(
                        'Accept: application/json',
                        'Content-Type: application/json'
                    ),
                    ));

                    $response = curl_exec($curl);

                    curl_close($curl);
                    echo $response;
                    return $response;
        
    }
    public function index(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $query = "select * from users where email='" . $email . "' and password=md5('" . $password . "')";
        $resultados = DB::select($query);


        if (sizeof($resultados) == 1) {

            foreach ($resultados as $value) {

                $idusuario = $value->id;
                $categoria = $value->categoria;
              echo   $email_suricata = $value->email_suricata;

                $nombreusuario = $value->nombre . " " . $value->last_name;
                session(['idusuario' => $idusuario]);
                session(['categoria' => $categoria]);
                session(['nombreusuario' => $nombreusuario]);
                session(['email' => $email]);
            }

            if($categoria==9){


                $subdomain_tmp = 'localhost';
                if (isset($_SERVER['HTTP_HOST'])) {
                    $domainParts = explode('.', $_SERVER['HTTP_HOST']);
                    $subdomain_tmp =  array_shift($domainParts);
                } elseif(isset($_SERVER['SERVER_NAME'])){
                    $domainParts = explode('.', $_SERVER['SERVER_NAME']);
                    $subdomain_tmp =  array_shift($domainParts);
                    
                }

                if($subdomain_tmp =="redlam"){
                    $AccountAPIKey="9474C39E-5E40-4A99-96B4-9709EAFA677A";
                    $BotAPIKey="H4TJzHoAedn0lo6acczPYqtu";
                    $BotAPISecret="mK6swiRhdihoS2lB8INOPr6AKDQLVYbQBYWeAvEwC6M36I8a";
                    $saliente="https://meerkat.xenioo.com/bc/H4TJzHoAedn0lo6acczPYqtu/CctysvLkSxT22CrsyRn2xVyA";
                    session(['saliente' => $saliente]);
                    $url='https://meerkat.xenioo.com/authorization/sso';


                }elseif($subdomain_tmp =="elevate"){
                    $AccountAPIKey="9474C39E-5E40-4A99-96B4-9709EAFA677A";
                    $BotAPIKey="UH1jLwAoIDYBSkTw73dysIRr";
                    $BotAPISecret="L5tZePdZNvY563aMsCRhDuKTUySkNmTCqANF3b9taynXCNp3";
                    $saliente="";
                    session(['saliente' => $saliente]);
                    $url='https://meerkat.xenioo.com/authorization/sso';
                }
                elseif($subdomain_tmp =="prolux"){
                    $AccountAPIKey="9474C39E-5E40-4A99-96B4-9709EAFA677A";
                    $BotAPIKey="kUSkMV3DW5ggE4sMFNNrDcuM";
                    $BotAPISecret="hJmQXef5k5hYYoYGe3xIRORfIS5MyBS8a622idfsPav8MJoQ";
                    $saliente="";
                    session(['saliente' => $saliente]);
                    $url='https://meerkat.xenioo.com/authorization/sso';
                }
                elseif($subdomain_tmp =="amecom"){
                    $AccountAPIKey="9474C39E-5E40-4A99-96B4-9709EAFA677A";
                    $BotAPIKey="3GIpQX25eLVHdEAw6BXDk9Pp";
                    $BotAPISecret="dx2BlM4u4mdYNdaL2NVQdzwsXuMcJyQuqSCTUqJIHaDrbbYT";
                    $saliente="";
                    session(['saliente' => $saliente]);
                    $url='https://meerkat.xenioo.com/authorization/sso';



                }
                elseif($subdomain_tmp =="conectared"){ 
                   echo  $AccountAPIKey="9474C39E-5E40-4A99-96B4-9709EAFA677A";
                    $BotAPIKey="eeghPqCSLVA78h7FlGLAY0Zf";
                    $BotAPISecret="E8mqLMvFhTa24KF8zUkw10NWzAMQYRTe50SH3M7zZvPf74BR";
                    $saliente="https://meerkat.xenioo.com/bc/eeghPqCSLVA78h7FlGLAY0Zf/nSfNwBMaY92Oc8ERWTSWLsvf";
                    session(['saliente' => $saliente]);
                    $url='https://meerkat.xenioo.com/authorization/sso';


                }
                elseif($subdomain_tmp =="pconline"){ 
                    echo  $AccountAPIKey="9474C39E-5E40-4A99-96B4-9709EAFA677A";
                     $BotAPIKey="Ob7mdpIh3YaiU9F3MOQUuOiW";
                     $BotAPISecret="uavtbNMlky1FUijOjnE0PdsLbxsxCoA0sas2uO6gCoyV7zZd";
                     $saliente="";
                     session(['saliente' => $saliente]);
                     $url='https://meerkat.xenioo.com/authorization/sso';
 
 
                 }
                elseif($subdomain_tmp =="betured"){ 
                    echo  $AccountAPIKey="9474C39E-5E40-4A99-96B4-9709EAFA677A";
                     $BotAPIKey="rhsazXnAbQW3rfyeRpKt929E";
                     $BotAPISecret="M5Qqb7O6Yw5qF7dN4I98jxMrGVyehX1oYeEt6wZT2PVua8OK";
                     $saliente="";
                     session(['saliente' => $saliente]);
                     $url='https://meerkat.xenioo.com/authorization/sso';
                     $queryoriginal="select * from sienna_creado where nombre='".$subdomain_tmp."' ";
                     $resultados = DB::connection('mysql3')->select($queryoriginal);
                     dd($resultados);
 
 
                 }
                elseif($subdomain_tmp =="internetservice"){ 
                    echo  $AccountAPIKey="315CEEE5-F54A-4B7C-A1F9-BB10A75E5C08";
                     $BotAPIKey="opUaCLLrEfIBULaJ7S3F2MTxKygGl9oujfXp4OeF2ZT5x5ay3sQ1B3GRMWFEf454";
                     $BotAPISecret="qORookEjonDStOzFNhDtjmigP5TY8QaxUOEZdmAIdgDOpoYyWzqxrBL3flPiGgaN";
                     $saliente="";
                     session(['saliente' => $saliente]);
                     $url='https://publicapi.xenioo.com/sso/authorize';
 
 
                 }
                 elseif($subdomain_tmp =="redpower"){ 
                    echo  $AccountAPIKey="315CEEE5-F54A-4B7C-A1F9-BB10A75E5C08";
                     $BotAPIKey="SzTppTZ5pCsk3xRL0CjsGzKRj6GJlqOzIw6dyFJQ9e4p3t5nVFeWM3cTf25jCGKz";
                     $BotAPISecret="nsS6qoMktJjcuUNp0SnWBscEKdxw9aDtJ42ARyxhstc3K0YBeFijSonvFDmDqQaJ";
                     $saliente="";
                     session(['saliente' => $saliente]);
                     $url='https://publicapi.xenioo.com/sso/authorize';
 
 
                 }
                

               

              

               

               $hh= $this->suricata($email_suricata,$AccountAPIKey,$BotAPIKey,$BotAPISecret,$url);
               $res=json_decode($hh, true);
                if($res<>''){

                    if( $url=='https://publicapi.xenioo.com/sso/authorize'){

                                             dd($res);
                                                 $urlfinal=$res['Data']['Home'];
                                                // $urlfinal.="conversation";
                                                // $url=$urlfinal;
                                                //
                                                
                                                $urlfinal=explode("auth",$urlfinal);
                                                $url=$urlfinal[0]."bots/6d3b5545-0b8a-4215-9baa-c7cd8d518913/conversation";
                        //  dd($url);https://designer.xenioo.com/en/bots/6d3b5545-0b8a-4215-9baa-c7cd8d518913/conversation
                                            
                                             //   dd($url);
                                                //   https://designer.xenioo.com/en/
                                                 //https://designer.xenioo.com/en/bots/6d3b5545-0b8a-4215-9baa-c7cd8d518913/conversation
                                                 //https://designer.xenioo.com/en/bots/6d3b5545-0b8a-4215-9baa-c7cd8d518913/conversation

                    }else{

                        $url=$res['Home']."/conversation";

                    }
                    session(['urlxennio' => $url]);


                    return Redirect::to('/conversations');

                   

                }else{

                    echo "no login";
                }
          


                

            }else{
                return Redirect::to('/home');


            }

            // return view('home');;
        } else {
            return Redirect::to(env('APP_URL'));
        }
        // 
    }

    public function actualizardatos(Request $request){

       // $datoreporte = users::where('id', '=', $request->idusuario)->get();
     //  dd($request->idusuario);
        $post = users::find($request->iduser);
        $post->name = $request->nombre;
        $post->email = $request->email;
        $post->dni = $request->dni;
        $post->birthdate = $request->birthdate;

        if($request->password<>""){
        // echo    $post->password = md5($request->pass);

         $dato="update users  set password=md5('" . $request->password . "') where id='".$request->iduser."'";
         $resultados = DB::select($dato);


        }


        $post->save();
        return redirect()
        ->back()
        ->with('success', 'Se Actulizo el registro  correctamente!');
    }
}
