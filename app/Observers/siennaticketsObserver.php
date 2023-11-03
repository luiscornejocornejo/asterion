<?php

namespace App\Observers;
use App\Models\siennaloginxenioo;

class siennaticketsObserver
{
    //

    public function created(siennatickets $siennatickets)
    {
        //
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\siennatickets  $siennatickets
     * @return void
     */
    public function updated(siennatickets $siennatickets)
    {
        //
        $dato=$siennatickets->id;
        $xen = new siennaloginxenioo();
            $xen->idusuario=session('idusuario');
            $xen->categoria=session('categoria');
            $xen->login=$siennatickets->id;
            $xen->save();

    }
}
