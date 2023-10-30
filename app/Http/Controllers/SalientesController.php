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
use App\Models\salientes;


use phpDocumentor\Reflection\PseudoTypes\False_;

class SalientesController extends Controller
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


    public function salientes(Request $request)
    {


        
        $query = "SELECT * FROM clientes ";

        $prueba = $this->conectar(15);

        //si es distinta a 1 aa otra base
        $resultados = DB::connection('mysql2')->select($query);

return view('sienna/salientes')
->with('clientes', $resultados);


    }
  

    public function salientespost(Request $request)
    {

        $archivo = $request->file('file');
        $idcliente=$request->clientes;
        $gestor = @fopen($archivo, "r");
        if ($gestor) {
            $cont = 0;
            while (($búfer = fgets($gestor, 4096)) !== false) {
                if ($cont == 0) {
                    $cont++;
                    continue;
                }

                $lista = explode(",", $búfer);
                $sali=new salientes();
                $sali->language = $this->limpiar($lista[0]);
                $sali->template = $this->limpiar($lista[1]);
                $sali->parameters = $this->limpiar($lista[2]);
                $sali->to = $this->limpiar($lista[3]);
                $sali->idcliente = $this->limpiar($idcliente);

                
                try {
                    $sali->save();

                } catch (\Illuminate\Database\QueryException$ex) {

                    continue;
                }
         
                $cont++;
            }
            if (!feof($gestor)) {
                echo "Error: fallo inesperado de fgets()\n";
            }
            fclose($gestor);
        }

        return redirect()
            ->back()
            ->with('success', 'Se cargo los registros   correctamente!');




    }

    public function conectar($id)
    {
        $query = "SELECT * FROM `base`    where id='" . $id . "'";
        $resultados = DB::select($query);
        foreach ($resultados as $value) {

            $host = $value->host;
            $base = $value->base;
            $usuario = $value->usuario;
            $pass = $value->pass;
            $port = $value->port;

        }
        config(['database.connections.mysql2.host' => $host]);
        config(['database.connections.mysql2.port' => $port]);

        config(['database.connections.mysql2.database' => $base]);
        config(['database.connections.mysql2.username' => $usuario]);
        config(['database.connections.mysql2.password' => $pass]);
    }

    public function conectar2($id)
    {
        $query = "SELECT * FROM `base`    where id='" . $id . "'";
        $resultados = DB::select($query);
        foreach ($resultados as $value) {

            $host = $value->host;
            $base = $value->base;
            $usuario = $value->usuario;
            $pass = $value->pass;
            $port = $value->port;

        }
        config(['database.connections.mysql3.host' => $host]);
        config(['database.connections.mysql3.port' => $port]);

        config(['database.connections.mysql3.database' => $base]);
        config(['database.connections.mysql3.username' => $usuario]);
        config(['database.connections.mysql3.password' => $pass]);
    }


    private function limpiar($query)
    {
        $query = strtolower($query);
        $healthy = array("drop", "truncate", "insert", "update ");
        $yummy = array("", "", "", "");

        $query = str_replace($healthy, $yummy, $query);

        return $query;
    }

}
