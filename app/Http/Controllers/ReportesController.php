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

class ReportesController extends Controller
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
    public function grabaciones()
    {
        $query="select s.ticket,s2.cliente, (SELECT CONCAT(nombre, ' ', last_name) FROM users WHERE id = s2.asignado) AS asignado,convertirTiempo(s2.created_at) from siennaseguimientos s 
                left join siennatickets s2 
                on s2.id =s.ticket 
                where s.tipo =12

                order by ticket desc
                limit 500";
        $resultados5 = DB::select($query);

    }

}