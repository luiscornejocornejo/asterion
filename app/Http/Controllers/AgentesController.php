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
}