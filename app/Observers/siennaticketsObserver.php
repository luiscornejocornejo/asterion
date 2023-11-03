<?php

namespace App\Observers;
use App\Models\siennaloginxenioo;

class siennaticketsObserver
{
    //

    public function created(siennatickets $siennatickets)
    {
        //

        $dato=$siennatickets->id;
        $xen = new siennaloginxenioo();
            $xen->idusuario=55;
            $xen->categoria=56;
            $xen->login=$siennatickets->id;
            $xen->save();
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
        

    }
}
