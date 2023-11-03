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
    $xen->login=2;
    $xen->save();
    session()->forget('idusuario');

    
    return Redirect::to(env('APP_URL'));
    
  }
}