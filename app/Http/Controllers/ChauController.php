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
    $xen = siennaloginxenioo::where('idusuario', '=', $idusuario)->get();  
    foreach($xen as $val){

      $idxen=$val->id;
    }     
    $xen2=siennaloginxenioo::find($idxen); 
    $xen2->login=2;
    $xen2->save();
    session()->forget('idusuario');

    
    return Redirect::to(env('APP_URL'));
    
  }
}