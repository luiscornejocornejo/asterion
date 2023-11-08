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
use App\Models\siennaloginxenioo;

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
        var_dump($email);
        var_dump($AccountAPIKey);
        var_dump($BotAPIKey);
        var_dump($BotAPISecret);
        var_dump($url);

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
                    echo "<br>f";
                    echo $response;
                    echo "a<br>";

                    return $response;
        
    }
    public function index(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $query = "select * from users where email='" . $email . "' and password=md5('" . $password . "')";
        $resultados = DB::select($query);
        $subdomain_tmp = 'localhost';
        if (isset($_SERVER['HTTP_HOST'])) {
            $domainParts = explode('.', $_SERVER['HTTP_HOST']);
            $subdomain_tmp =  array_shift($domainParts);
        } elseif(isset($_SERVER['SERVER_NAME'])){
            $domainParts = explode('.', $_SERVER['SERVER_NAME']);
            $subdomain_tmp =  array_shift($domainParts);
            
        }
        if($subdomain_tmp=="redlam"){ 
            echo $query;
           /// dd(dump($app->environment()));
#            dd($resultados);
        }
        if (sizeof($resultados) == 1) {

            foreach ($resultados as $value) {


                
                $idusuario = $value->id;
                $categoria = $value->categoria;
                 $email_suricata = $value->email_suricata;
                 $nombreusuario = $value->nombre . " " . $value->last_name;

               
                session(['idusuario' => $idusuario]);
                session(['categoria' => $categoria]);
                if($subdomain_tmp=="opticom"){ 
                                $query4 = "select * from categoria where id='" . $categoria . "'";
                                $resultados4 = DB::select($query4);

                                foreach($resultados4 as $val4){
                                    session(['areas' => $val4->area]);
                                }

                    }
                session(['nombreusuario' => $nombreusuario]);
                session(['email' => $email]);
                session(['email_suricata' => $email_suricata]);
            }


            

            if($subdomain_tmp=="opticom"){

                $xen = siennaloginxenioo::where('idusuario', '=', session('idusuario'))->get();  
                  foreach($xen as $val){

                    $idxen=$val->id;
                    $xen2=siennaloginxenioo::find($idxen); 
                    $xen2->login=2;
                    $xen2->save();
                  }     
                  
                $xen = new siennaloginxenioo();
                $xen->idusuario=session('idusuario');
                $xen->categoria=session('categoria');
                $xen->areas=session('areas');
                $xen->login=1;
                $xen->save();
            }
            

            if($categoria==90){


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
                    echo $url='https://meerkat.xenioo.com/authorization/sso';

                   }else{
                  echo   $url='https://publicapi.xenioo.com/sso/authorize';


                   }

                   session(['saliente' => $saliente]);
                }



              

               

               $hh= $this->suricata($email_suricata,$AccountAPIKey,$BotAPIKey,$BotAPISecret,$url);
               $res=json_decode($hh, true);
                if($res<>''){

                    if( $url=='https://publicapi.xenioo.com/sso/authorize'){

                                                 $urlfinal=$res['Data']['Home'];
                                                 $urlfinal.="/conversation";
                                                 $url=$urlfinal;

                                

                    }else{

                        $url=$res['Home']."/conversation";

                    }
                    session(['urlxennio' => $url]);


                    return Redirect::to('/conversations2');

                   

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
