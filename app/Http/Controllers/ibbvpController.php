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
use Mail; 
use App\Models\logs;

use phpDocumentor\Reflection\PseudoTypes\False_;
use App\Http\Controllers\LogsController;


use App\Models\ibbvp\canciones;
use App\Models\ibbvp\videos;
use App\Models\ibbvp\estudios;

class ibbvpController extends Controller
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
    public function canciones(Request $request)
    {
        $canciones = canciones::all();
        return view("sienna/canciones")->with('canciones', $canciones);

    }

    public function videos(Request $request)
    {
        $videos = videos::all();
        return view("sienna/videos")->with('videos', $videos);

    }
    public function estudios(Request $request)
    {
        $estudios = estudios::all();
        return view("sienna/estudios")->with('estudios', $estudios);

    }

    public function estudio(Request $request)
    {
        $id=$request->id;
        $estudio = estudio::where('padre', '=', $id)->get();

        return view("sienna/estudio")->with('estudio', $estudios);

    }
   

}