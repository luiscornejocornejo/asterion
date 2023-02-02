<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\users;

class dashboard extends Model
{
    public $timestamps = false;

    protected $table = 'dashboard';
    protected $fillable = ['titulo', 'subtitulo', 'masterreport', 'categoria', 'tipo'];


    static function datos()
    {

        $datos = users::find(session('idusuario'));
        $cate = $datos->categoria;
        $das = dashboard::where('categoria', $cate)->get();
        return $das;
    }

    static function reporte($id)
    {

        $datos = masterreport::find($id);
        return $datos;
    }

    static function grafico($master, $tipo)
    {

        if ($master->servicio <> 2) {

            $a = "<a target=_blank  href='https://test.siennasystem.com/ceviche_view?id=" . $master->id . "'   >" . $master->nombre . "</a>";
            return $a;
        } else {
            $grafico = "grafico";
            
            return $grafico;
        }
    }
}
