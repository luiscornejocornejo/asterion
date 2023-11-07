<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;
use App\Models\siennaloginxenioo;

class ChauController extends Controller
{
  public function logout()
  {

    $idusuario=session('idusuario');

    $subdomain_tmp = 'localhost';
            if (isset($_SERVER['HTTP_HOST'])) {
                $domainParts = explode('.', $_SERVER['HTTP_HOST']);
                $subdomain_tmp =  array_shift($domainParts);
            } elseif(isset($_SERVER['SERVER_NAME'])){
                $domainParts = explode('.', $_SERVER['SERVER_NAME']);
                $subdomain_tmp =  array_shift($domainParts);
                
            }

            if($subdomain_tmp=="opticom"){

                  $idxen=0;
                  $xen = siennaloginxenioo::where('idusuario', '=', $idusuario)->get();  
                  foreach($xen as $val){

                    $idxen=$val->id;
                  }     
                  if($idxen<>0){
                    $xen2=siennaloginxenioo::find($idxen); 
                    $xen2->login=2;
                    $xen2->save();
                  }
                  

            }
    session()->forget('idusuario');

    
    return Redirect::to(env('APP_URL'));
    
  }
}