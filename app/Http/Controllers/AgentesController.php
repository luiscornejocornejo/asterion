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

}