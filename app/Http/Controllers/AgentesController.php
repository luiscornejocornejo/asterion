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
use App\Models\logs;

use phpDocumentor\Reflection\PseudoTypes\False_;
use App\Http\Controllers\LogsController;

class AgentesController extends Controller
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
    public function rolusers(Request $request)
    {
        $user_id=$request->user_id;
        $statos=$request->statos;
        $query="update users set tipousers='".$statos."'  where id='".$user_id."'";
        $resultados5 = DB::select($query);
        $otroControlador = new LogsController();
        $resultado3 = $otroControlador->guardarlogs("modificar tipo usuario",$query);
        return redirect()
        ->back()
        ->with('success', 'Se modifico  el registro  correctamente!');

    }
    public function areasusers(Request $request)
    {

         $user_id=$request->user_id2;
        $statos=$request->statos;
        $nuevo="";
        if($statos==""){
            return redirect()
            ->back()
            ->with('success', 'Debe seleccionar al menoso una area!');
        }
        foreach($statos as $val){
            $nuevo.=$val.",";
        }
        $nuevo=substr($nuevo,0,-1);
        $query="update users set deptosuser='".$nuevo."'  where id='".$user_id."'";
        $resultados5 = DB::select($query);
        $otroControlador = new LogsController();
        $resultado3 = $otroControlador->guardarlogs("modificar depto usuario",$query);
        return redirect()
        ->back()
        ->with('success', 'Se modifico  el registro  correctamente!');

    }
    public function notificacionusers(Request $request)
    {
        $user_id=$request->user_id5;
        $statos=$request->statos;
        $si2 = users::find($user_id);
        $si2->avisoemail = $statos;
        $si2->save();
        $otroControlador = new LogsController();
        $resultado3 = $otroControlador->guardarlogs(" notificacionusers",$user_id);
        return redirect()
        ->back()
        ->with('success', 'Se modifico  el registro  correctamente!');
    }
    public function cambiopass(Request $request)
    {       
        
        $newpass=$request->newpass;
        $user_idpass=$request->user_idpass;
        $usuario= users::find($user_idpass);
        $usuario->password=md5($newpass);
        $usuario->save();
        $otroControlador = new LogsController();
        $resultado3 = $otroControlador->guardarlogs("cambio pass usuario",$user_idpass);

        return redirect()
        ->back()
        ->with('success', 'Se Modifico  la password  correctamente!');
 
    }

    public function ticketusers(Request $request)
    {
        $user_id=$request->user_id4;
        $statos=$request->statos;
        $query="update users set tickets='".$statos."'  where id='".$user_id."'";
        $resultados5 = DB::select($query);
        $otroControlador = new LogsController();
        $resultado3 = $otroControlador->guardarlogs(" asignar tickets  usuario",$query);
        return redirect()
        ->back()
        ->with('success', 'Se modifico  el registro  correctamente!');

    }

    public function ctusers(Request $request)
    {
        $user_id=$request->user_idct;
        $statos=$request->statos;
        $si2 = users::find($user_id);
        $si2->ct = $statos;
        $si2->save();
        $otroControlador = new LogsController();
        $resultado3 = $otroControlador->guardarlogs(" cerrar tickets  usuario",$user_id);
        return redirect()
        ->back()
        ->with('success', 'Se modifico  el registro  correctamente!');

    }
    public function habilitadousers(Request $request)
    {
        $user_id=$request->user_idhb;
        $statos=$request->statos;
        $si2 = users::find($user_id);
        $si2->habilitado = $statos;
        $si2->save();
        $otroControlador = new LogsController();
        $resultado3 = $otroControlador->guardarlogs(" habilitar usuario",$user_id);
        return redirect()
        ->back()
        ->with('success', 'Se modifico  el registro  correctamente!');

    }

    public function eliminaragente(Request $request){

        $idagente=$request->idagente;
        $user=users::find($idagente);
        $user->delete(); 
        $otroControlador = new LogsController();
        $resultado3 = $otroControlador->guardarlogs("Eliminar usuario",$idagente);  
        return redirect()
        ->back()
        ->with('success', 'Se elimino el agente  correctamente!');
    
       }

       public function newusers(Request $request)
    {

        $grupossso=$request->grupossso;
        $mailsso=$request->nombre.$request->apellido."@suricata.la";
        $interno=$request->interno;
        $grup="";
        foreach($grupossso as $val){
          $grup.=$val.";";
        }
        $grup=substr($grup,0,-1);
        
        if (isset($_SERVER['HTTP_HOST'])) {
            $domainParts = explode('.', $_SERVER['HTTP_HOST']);
            $subdomain_tmp =  array_shift($domainParts);
        } elseif(isset($_SERVER['SERVER_NAME'])){
            $domainParts = explode('.', $_SERVER['SERVER_NAME']);
            $subdomain_tmp =  array_shift($domainParts);
            
        }

        if($request->rol=="2"){
            $rolpasar="supervisor";
        }
        if($request->rol=="3"){
            $rolpasar="agente";
        }
      
        $url="http://146.190.115.238/api/createuser?token=EDElDqlQf3RDP5EDK1pHhugV9M6aCXtwAm57SD0G5JYZjw7RxwZbbfdKMhWYdUUM&botid=".$subdomain_tmp."&grupo=".$grup."&tipo=".$rolpasar."&email=".$mailsso.""; 
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
         $response = curl_exec($curl);

        curl_close($curl);
        $us=new users();
        $us->nombre=$request->nombre;
        $us->last_name=$request->apellido;
        $us->email=$request->maill;
        $grup22=str_replace(";",",",$grup);
        $us->categoria=3;
        $us->deptosuser=$grup22;
        $us->tipousers=$request->rol;
        $us->tickets=$request->asignar;
        $us->interno=$request->interno;
        $us->password=md5($request->pass);
        $us->email_suricata=$mailsso;
        $us->save();
        $otroControlador = new LogsController();
        $resultado3 = $otroControlador->guardarlogs("crear usuario",$us->id);
       return redirect() 
        ->back() 
        ->with('success', 'Se Creo  correctamente! el usuario');

    }

}