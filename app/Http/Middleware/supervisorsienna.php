<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Redirect;

class supervisorsienna
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $tipo=session('tipodemenu');
        $categoria=session('categoria');

        if(($tipo==2) or($categoria==1)){

            return $next($request);

        }else{
            return Redirect::to('/denied');


        }
        return $next($request);

    }
}
