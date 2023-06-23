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
                $nombreusuario = $value->nombre . " " . $value->last_name;
                session(['idusuario' => $idusuario]);
                session(['categoria' => $categoria]);
                session(['nombreusuario' => $nombreusuario]);
                session(['email' => $email]);
            }

            if($categoria==9){


                $curl = curl_init();

                    curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://meerkat.xenioo.com/authorization/sso',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>'{
                        "AccountAPIKey":"9474C39E-5E40-4A99-96B4-9709EAFA677A",
                        "BotAPIKey":"UH1jLwAoIDYBSkTw73dysIRr",
                        "BotAPISecret":"L5tZePdZNvY563aMsCRhDuKTUySkNmTCqANF3b9taynXCNp3",
                        "Email":"ar.elevate@suricata.la"
                    }',
                    CURLOPT_HTTPHEADER => array(
                        'Accept: application/json',
                        'Content-Type: application/json',
                        'Cookie: xenioo-id=XENIOO_b527e095-bc1b-4142-9f55-b09da0fe42ab'
                    ),
                    ));

                    $response = curl_exec($curl);

                    curl_close($curl);
                    echo $response;
               // return Redirect::to('/suricata');

            }
            return Redirect::to('/home');

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
