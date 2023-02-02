<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Cappi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Inscripcion;
use App\Eve;
use App\Models\categoria;
use App\Models\dashboard;
use App\Models\graficos;
use Illuminate\Database\PDO;
use Redirect;
use Flash;
use phpDocumentor\Reflection\PseudoTypes\False_;
use Illuminate\Support\File;
use App\Models\cronmail;
use App\Models\masterreport;
use Mail;

class cappi2022Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

 
    public function crear(Request $request)
    {
        //
      
        
        $cappi =new Cappi;
        echo "hola";
        
        echo $cappi->full_name=$request->full_name;
        echo  $cappi->inet=$request->inet;
        echo  $cappi->churn_reason=$request->churn_reason;
        echo  $cappi->service_type=$request->service_type;
        echo  $cappi->user_latitude=$request->user_latitude;
        echo $cappi->user_longitude=$request->user_longitude;
        echo $cappi->email=$request->email;
        echo  $cappi->user_phone=$request->user_phone;
        echo $cappi->localidad=$request->localidad;
         $cappi->save();


    }


}
