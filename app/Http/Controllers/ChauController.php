<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;
class ChauController extends Controller
{
  public function logout()
  {
    session()->forget('idusuario');

    
    return Redirect::to(env('APP_URL'));
    
  }
}