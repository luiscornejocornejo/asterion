<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscripcion;
use App\Eve;
use Illuminate\Support\Facades\DB;
use Redirect;
use Flash;
use phpDocumentor\Reflection\PseudoTypes\False_;

class BusquedaController extends Controller
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
    public function pasajededatos(Request $request)
    {
        $query = "SELECT id,id_function_frame FROM `providers`";
        $resultados = DB::select($query);
        foreach ($resultados as $value) {
            echo $providerid = $value->id;
            echo $value->id_function_frame;
            echo "<br><br>";
            $pp = str_replace('["', "", $value->id_function_frame);
            $pp2 = str_replace('"]', "", $pp);
            $pp3 = str_replace('"', "", $pp2);
            $query2 = "insert into provider_function_frame ( `id_provider`,`id_frame`) value(";
            echo $pp3;
            echo "<br><br>";
            $pos3 = stripos($pp3, ",");
            if ($pos3 !== false) {
                $pp4 = explode(",", $pp3);
                foreach ($pp4 as $value2) {
                    echo $value2;
                    echo "<br><br>";
                    $query3 = $query2 . "'" . $providerid . "','" . $value2 . "');";
                    echo $query3;
                    DB::select($query3);
                    echo "<br><br>";
                }
            } else {

                echo $pp3;
                $query2 .= "'" . $providerid . "','" . $pp3 . "');";
                echo $query2;
                DB::select($query2);
                echo "<br><br>";
            }


            echo "<br><br>";
        }
    }
    public function pasajededatos2(Request $request)
    {
        $query = "SELECT id,id_workers_category  as cate FROM `frame_functions` ORDER BY `frame_functions`.`id` ASC;
    ";
        $lista = DB::select($query);

        foreach ($lista as $value) {

            echo $idframe = $value->id;
            echo $value->cate;

            $pp = str_replace('["', "", $value->cate);
            $pp2 = str_replace('"]', "", $pp);
            $pp3 = str_replace('"', "", $pp2);
            $query2 = "INSERT INTO `frame_functions_category`( `id_frame`, `id_category`) VALUES (";
            echo $pp3;
            echo "<br><br>";
            $pos3 = stripos($pp3, ",");
            if ($pos3 !== false) {
                $pp4 = explode(",", $pp3);
                foreach ($pp4 as $value2) {

                    echo $value2;
                    echo "<br><br>";
                    $query3 = $query2 . "'" . $idframe . "','" . $value2 . "');";
                    echo $query3;
                    DB::select($query3);
                    echo "<br><br>";
                }
            } else {
                echo $pp3;
                $query2 .= "'" . $idframe . "','" . $pp3 . "');";
                echo $query2;
                DB::select($query2);
                echo "<br><br>";
            }
            echo "<br><br>";
        }
    }
    public function view(Request $request)
    {
        //  $query = "select u.id as idusuario,u.name as nombreusuario,u.last_name as apellido,ff.name as funcionframe,ff.id_workers_category as categorias from users u join providers p ON u.id=p.id_user join provider_function_frame f ON f.id_provider=p.id join frame_functions ff on ff.id=f.id_frame;";
        $query = " select u.id as idusuario,u.name as nombreusuario,u.last_name as apellido,f.id_provider,
       ff.name as funcionframe,ff.id as idframe,fc.id_category as categorias,sub.nombre,cat.sueldo_basico,
       cat.sueldo_neto from users u join frameproviders p ON u.id=p.id_user 
       join frameprovider_function_frame f ON f.id_provider=p.id join frame_functions ff
        on ff.id=f.id_frame join frame_functions_category fc on fc.id_frame=ff.id 
        join framesub_categorias_sat sub on sub.id=fc.id_category join 
        framecategorias_sat cat on cat.id=sub.categorias_sat;";
        $lista = DB::select($query);
        $idproyect = $request->id_project;
        return view('sienna/busqueda')
            ->with('idproyect', $idproyect)
            ->with('lista', $lista);
    }

    public function list(Request $request)
    {
        $query = "
         SELECT 
         d.sueldo_basico,d.sueldo_bruto,d.sueldo_adicional,d.sueldo_neto,d.name as nombrecategoria,

         c.id as idcontrato,c.name as contrato,

         f.id as idusuario,f.name as nombreusu,f.last_name as apellido,a.count_workdays_crew,a.id as idborrar,

         a.id,a.id_function_frame,a.id_provider,a.id_category_sat,a.id_contract,a.total_workdays,
         a.active,a.id_crew_reemplazo,
         DATE_FORMAT(a.start_date_contract,'%Y-%m-%d') AS start_date_contract,
         DATE_FORMAT(a.finish_date_contract,'%Y-%m-%d') AS finish_date_contract,
         DATE_FORMAT(a.start_afip,'%Y-%m-%d') AS start_afip,
         DATE_FORMAT(a.finish_afip,'%Y-%m-%d') AS finish_afip,
         
         a.hour_initial,a.hour_end,a.is_reemplazo,a.id_workday,
         
         b.name as nombreframe

         FROM `frameproject_providers` as a 
         join frame_functions as b on b.id=a.id_function_frame 
         left join framecontracts as c on c.id=a.id_contract
          join frameworkers_categories as d on d.id=a.id_category_sat 
          join frameproviders e on e.id=a.id_provider 
          join users as f on f.id=e.id_user
          where a.id_project=" . $request->id_project . "
          order by f.id desc";
        $lista = DB::select($query);

        $arraygrupo=[];
        foreach($lista as $probar){

             $cuantosusuarios=$probar->id_provider;
            $querybusca="select count(*) as cuantos from frameproject_providers where id_provider=".$cuantosusuarios." and  id_project=" . $request->id_project . "   ";
            $listabusca = DB::select($querybusca);
            foreach($listabusca as $encontrado){

                if($encontrado->cuantos>1){
                    array_push($arraygrupo,$probar->id_provider);
                }  

            }

         

        }

        //dd($lista);
        $query2 = "SELECT id,name FROM `frameworkdays` where active='1'       ";
        $lista2 = DB::select($query2);
        $query3 = "SELECT * FROM `framecontracts`     ";
        $lista3 = DB::select($query3);
        $idempresa = session('idempresa');

        $query4 = "SELECT a.id,a.fechadesde,a.fechahasta,a.horainicio,a.horafinal,a.nota,a.motivo,a.francocompensatorio,b.name,b.last_name, f.name as funcion,a.usuario,(a.horafinal-a.horainicio) as diferencia FROM `eventos` a join users b on b.id=a.usuario join frameproviders c on c.id_user=b.id join frameproject_providers d on d.id=a.idproyecto join frame_functions f on f.id=d.id_function_frame
        where a.tipo=2  and a.idproyecto=" . $request->id_project . "";
        $listahoras = DB::select($query4);
        $query5 = "SELECT a.id,a.fechadesde,a.fechahasta,a.horainicio,a.horafinal,a.nota,a.motivo,a.francocompensatorio,b.name,b.last_name, f.name as funcion,a.usuario,(a.horafinal-a.horainicio) as diferencia FROM `eventos` a join users b on b.id=a.usuario join frameproviders c on c.id_user=b.id join frameproject_providers d on d.id=a.idproyecto join frame_functions f on f.id=d.id_function_frame
        where a.tipo=3  and a.idproyecto=" . $request->id_project . "";
        $listaausencias = DB::select($query5);
        $query6 = "SELECT a.id,a.fechadesde,a.fechahasta,a.horainicio,a.horafinal,a.nota,a.motivo,a.francocompensatorio,b.name,b.last_name, f.name as funcion,a.usuario,(a.horafinal-a.horainicio) as diferencia FROM `eventos` a join users b on b.id=a.usuario join frameproviders c on c.id_user=b.id join frameproject_providers d on d.id=a.idproyecto join frame_functions f on f.id=d.id_function_frame
        where a.tipo=4  and a.idproyecto=" . $request->id_project . "";
        $listaaferiados = DB::select($query6);
        $query7 = "SELECT a.id,a.fechadesde,a.fechahasta,a.horainicio,a.horafinal,a.nota,a.motivo,a.francocompensatorio,b.name,b.last_name, f.name as funcion,a.usuario,(a.horafinal-a.horainicio) as diferencia FROM `eventos` a join users b on b.id=a.usuario join frameproviders c on c.id_user=b.id join frameproject_providers d on d.id=a.idproyecto join frame_functions f on f.id=d.id_function_frame
        where a.tipo=1  and a.idproyecto=" . $request->id_project . "";
        $listavacacioness = DB::select($query7);

        return view('sienna/teams')
            ->with('lista3', $lista3)
            ->with('lista', $lista)
            ->with('idproyect', $request->id_project)
            ->with('lista2', $lista2)
            ->with('listahoras', $listahoras)
            ->with('listaausencias', $listaausencias)
            ->with('listavacacioness', $listavacacioness)
            ->with('listaaferiados', $listaaferiados)
            ->with('grupo', $arraygrupo);
    }

    public function moditeam(Request $request)
    {


        $id_contract = $request->id_contract; //" => "2"
        $start_date_contract = $request->start_date_contract; //" => "2019-06-10"
        $finish_date_contract = $request->finish_date_contract; //" => "2019-07-31"
        $modalidad = $request->modalidad; //" => "3"
        $dias = $request->dias; //" => "30"
        $horainicio = $request->horainicio; //" => "10:00"
        $horafinal = $request->horafinal; //" => "18:00"
        $afipalta = $request->afipalta; //" => "2019-06-10"
        $afipbaja = $request->afipbaja; //" => "2019-07-31"
        $salary_workdays = $request->salary_workdays; //" => "wtwew"
        $salary_daily = $request->salary_daily; //" => "6022.376590909091"
        $crew_sueldo_diferencia = $request->crew_sueldo_diferencia; //" => "-11,29"
        $reemplazo = $request->reemplazo; //" => "2"
        $aceptado = $request->aceptado; //" => "0"
        $total_workdays_text = $request->total_workdays_text;
        $salary_liquidate = $request->salary_liquidate;
        $salary_contract_category_function = $request->salary_contract_category_function;

        $start_date_secure_contract = date('Y-m-m', strtotime("+1 day", strtotime($start_date_contract)));
        $end_date_secure_contract = date('Y-m-m', strtotime("+1 day", strtotime($finish_date_contract)));

        $idbase = $request->idbase;
        echo $query = "
        UPDATE `frameproject_providers` 
        SET  `id_contract`='" . $id_contract . "',
        `id_workday`='" . $id_contract . "',
        `salary_workdays`='" . $id_contract . "',
        `total_workdays`='" . $id_contract . "',
        `total_workdays_text`='" . $total_workdays_text . "',
        `salary_contract_category_function`='" . $salary_contract_category_function . "',
        `salary_daily`='" . $salary_daily . "',
        `salary_liquidate`='" . $salary_liquidate . "',
        `salaty_difference`='" . $crew_sueldo_diferencia . "',
        `start_date_contract`='" . $start_date_contract . "',
        `finish_date_contract`='" . $finish_date_contract . "',
        `count_workdays_crew`='" . $id_contract . "',
        `hour_initial`='" . $horainicio . "',
        `hour_end`='" . $horafinal . "',
        `start_afip`='" . $afipalta . "',
        `finish_afip`='" . $afipbaja . "',
        `start_date_secure_contract`='" . $start_date_secure_contract . "',
        `end_date_secure_contract`='" . $end_date_secure_contract . "',
        `is_reemplazo`='" . $reemplazo . "',
        `id_crew_reemplazo`='" . $id_contract . "',
        `absence`='" . $id_contract . "',
        `active`='" . $aceptado . "'

         WHERE id='" . $idbase . "'";
        $resultados = DB::select($query);


        return redirect()
            ->back()
            ->with('success', 'Se modifico team  correctamente!');
    }
    public function post(Request $request)
    {


        foreach ($request as $key => $valor) {

            if ($key == "request") {
                

                foreach ($valor as $key2=>$valor2) {
                
                    if($key2<>"_token"){

                       
                    $valor22=explode("|",$valor2);
                   
                   
                    $idproyect = $valor22[2];
                    

                    $query = "INSERT INTO frameproject_providers( id_project,id_function_frame,id_category_sat,id_provider) values (".$valor22[2].",". $valor22[3].",". $valor22[4]. ",". $valor22[5].")   ";
                    $ddd = DB::select($query);
                    }
                 
                }
            }
        }

        if (isset($idproyect)) {

            //if(isset($valor22[2])){
                echo "existe".$idproyect;

            }else{
                echo "no entra";
                return redirect()
                ->back()
                ->with('success', 'Su Equipo est vacio!');
            }
         $url = "/teams?id_project=" . $idproyect;
        return Redirect::to($url);

    }



    public function view2(Request $request)
    {




        $lista = array();
        $proyecyo = $request->id_project;
        $query = "SELECT b.proyect_categories FROM `projects` a join center_costs b
        on b.id=a.cost_center
        where a.id=" . $proyecyo . "";
        $resultados = DB::select($query);
        foreach ($resultados as $value) {
            echo "categoria:";
            echo   $idcategoria = $value->proyect_categories;
            echo "</br>";
        }


        $query2 = "SELECT id,name,id_workers_category FROM `frame_functions` where `id_proyect_category` like '%" . $idcategoria . "%'
        ";
        $resultados2 = DB::select($query2);
        foreach ($resultados2 as $value2) {
            $sublista = array();


            echo "funcion frame:";
            echo "</br>";
            echo "id:";
            echo   $id = $value2->id;
            array_push($sublista, $id);
            echo "</br>";
            echo "nombre ff:";
            echo   $name = $value2->name;
            array_push($sublista, $name);
            echo "</br>";

            echo "worked:";
            $id_workers_category = $value2->id_workers_category;
            echo "</br>";
            $pos3 = stripos($id_workers_category, ",");

            if ($pos3 !== false) {
                $separar = explode(",", $id_workers_category);
                foreach ($separar as $sepa) {
                    echo  $int = (int) filter_var($sepa, FILTER_SANITIZE_NUMBER_INT);
                    array_push($sublista, $int);
                    $query4 = "SELECT * FROM `sub_categorias_sat`a join categorias_sat b on a.categorias_sat=b.id where a.id=" . $int . "
                    ";
                    $resultados4 = DB::select($query4);
                    foreach ($resultados4 as $value4) {
                        echo $nombrecategoria = $value4->nombre;
                        array_push($sublista, $nombrecategoria);
                    }
                    echo "</br>";
                }
            } else {
                echo  $int = (int) filter_var($id_workers_category, FILTER_SANITIZE_NUMBER_INT);
                array_push($sublista, $int);

                $query4 = "SELECT * FROM `sub_categorias_sat`a join categorias_sat b on a.categorias_sat=b.id where a.id=" . $int . "
";
                $resultados4 = DB::select($query4);
                foreach ($resultados4 as $value4) {
                    echo $nombrecategoria = $value4->nombre;
                    array_push($sublista, $nombrecategoria);
                }
            }


            echo "</br>";

            $query3 = "select id,name,last_name from users where id in ( SELECT id_user FROM `providers` where `id_function_frame` like '%\"" . $id . "\"%' );
          ";

            $resultados3 = DB::select($query3);
            echo "providers:";
            echo "</br>";

            foreach ($resultados3 as $value3) {

                echo "idusuario:";
                echo   $idusuario = $value3->id;
                array_push($sublista, $idusuario);

                echo "nombre:";
                echo   $nombreusuario = $value3->name;
                array_push($sublista, $nombreusuario);

                echo   $apellido = $value3->last_name;
                array_push($sublista, $apellido);

                echo "</br>";
            }
            echo "</br></br></br>";
            array_push($lista, $sublista);
        }



        //var_dump($lista);

        return view('sienna/busqueda')->with('lista', $lista);
    }
}
