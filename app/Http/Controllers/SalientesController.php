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

     public function template(){

        return response()->download(public_path('templatesaliente.csv'));

    }

   
    public function salientes(Request $request)
    {


        $subdomain_tmp = 'localhost';
        if (isset($_SERVER['HTTP_HOST'])) {
            $domainParts = explode('.', $_SERVER['HTTP_HOST']);
            $subdomain_tmp =  array_shift($domainParts);
        } elseif(isset($_SERVER['SERVER_NAME'])){
            $domainParts = explode('.', $_SERVER['SERVER_NAME']);
            $subdomain_tmp =  array_shift($domainParts);
            
        }
        $query = "SELECT *,b.id idmobility,b.nombre nombremobility,b.cantvariables FROM clientes a join mobility b on  a.mobility=b.id  where a.nombre='".$subdomain_tmp."_suricata'";

        $prueba = $this->conectar(15);

        //si es distinta a 1 aa otra base
        $resultados = DB::connection('mysql2')->select($query);

return view('sienna/salientes')
->with('clientes', $resultados)
->with('posts', 0);


    }
  
   
    public function salientespost(Request $request)
    {

        $archivo = $request->file('file');
        $idmobility=$request->clientes;
        $gestor = @fopen($archivo, "r");
        if ($gestor) {
            $cont = 0;
            while (($búfer = fgets($gestor, 4096)) !== false) {
                if ($cont == 0) {
                    $cont++;
                    continue;
                }

               
         
                $cont++;
            }
            if (!feof($gestor)) {
                echo "Error: fallo inesperado de fgets()\n";
            }
            fclose($gestor);
        }

        $subdomain_tmp = 'localhost';
        if (isset($_SERVER['HTTP_HOST'])) {
            $domainParts = explode('.', $_SERVER['HTTP_HOST']);
            $subdomain_tmp =  array_shift($domainParts);
        } elseif(isset($_SERVER['SERVER_NAME'])){
            $domainParts = explode('.', $_SERVER['SERVER_NAME']);
            $subdomain_tmp =  array_shift($domainParts);
            
        }
        $query = "SELECT *,b.id idmobility,b.nombre nombremobility,b.cantvariables FROM clientes a join mobility b on  a.mobility=b.id  where a.nombre='".$subdomain_tmp."_suricata'";

        $prueba = $this->conectar(15);

        //si es distinta a 1 aa otra base
        $resultados = DB::connection('mysql2')->select($query);

        $query2="select demo from mobility where id='".$idmobility."'";
        $resultados2 = DB::connection('mysql2')->select($query2);
        foreach($resultados2 as $value){

            $prevista=$value->demo;
        }
        $cont=$cont-1;
        //$archivo2=$this->parseCsv($archivo,true);
            return view('sienna/salientes')
            ->with('clientes', $resultados)
            ->with('cantidad', $cont)
            ->with('idmobility', $idmobility)
            ->with('prevista', $prevista)
            ->with('archivo', $archivo)
            ->with('posts', 1);




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



    public function botsalientes(Request $request)
    {

        $query="select * from sienna_bp_templates";
        $resultados = DB::select($query);
        return view('sienna/salientesbot')
        ->with('listadopadre', $resultados)
        ;

    }

}
