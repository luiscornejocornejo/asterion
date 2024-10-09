<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscripcion;
use App\Eve;
use App\Models\categoria;
use App\Models\dashboard;
use App\Models\graficos;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\PDO;
use Redirect;
use Flash;
use phpDocumentor\Reflection\PseudoTypes\False_;
use Illuminate\Support\File;
use App\Models\cronmail;
use App\Models\masterreport;
use Mail;
class Dashboard2Controller extends Controller
{
    //
    public function view(Request $request)
    {
        $query = "SELECT a.id,a.nombre,b.nombre as servicio FROM `masterreport` a
        join servicio b on
        b.id=a.servicio
        where a.dashboard =1";
        $resultados = DB::select($query);

        $categorias = categoria::all();
        $graficos = graficos::all();

        return view("sienna/dashboard")
            ->with('servicio', $graficos)
            ->with('reporte', $resultados)
            ->with('categorias', $categorias);
    }

    public function viewpost(Request $request)
    {

        $das = new dashboard;
        $das->titulo = $request->titulo;
        $das->subtitulo = $request->subtitulo;
        $das->masterreport = $request->reporte;
        $das->tipo = $request->tipo;
        $das->categoria = $request->categoria;
        $das->save();

        return redirect()
            ->back()
            ->with('success', 'Se Agrego al dashboard  correctamente!');
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
        }
        config(['database.connections.mysql2.host' => $host]);
        config(['database.connections.mysql2.database' => $base]);
        config(['database.connections.mysql2.username' => $usuario]);
        config(['database.connections.mysql2.password' => $pass]);
    }

    function cabezerasgraficos($datos)
  {

    $thearray = (array) $datos;
    $return = array();

    foreach ($thearray as $key => $value) {

      foreach ($value as $key2 => $value2) {

        array_push($return, $key2);
      }
    }
    $return = array_unique($return);

    return $return;
  }
    public function cronmail()
    {

        date_default_timezone_set("America/Argentina/Buenos_Aires");
      echo  $hora = date('H:i:00');
     echo    $fecha = date('Y-m-d');
        $datos = cronmail::where('estado', '=', '0', 'and')->where('fecha', '=', $fecha, 'and')->where('hora', '=', $hora)->get();
        if (sizeof($datos) > 0) {
            foreach ($datos as $value) {
                
                $datoreporte = masterreport::where('id', '=', $value->idreporte)->get();
                var_dump($datoreporte);
                foreach ($datoreporte as $value2) {
                    echo $base = $value2->base;
                    echo $query = $value2->query;
                    echo "<br>1";
                    echo "<br>";
                }
                if ($base == 0) {
                        $fields2 = DB::select($query);
                        $cabezeras=$this->cabezerasgraficos($fields2 );
                        var_dump($fields2);
                        $subject = $value->asunto;
                        $for = "kayser1712@gmail.com";
                        Mail::send('mail',["fields2"=>$fields2,'cabezeras'=>$cabezeras], function($msj) use($subject,$for){
                            $msj->from("prueba@siennasystem.com","luis");
                            $msj->subject($subject);
                            $msj->to($for);
                        });
                } else {

                        $prueba = $this->conectar($base);
                        //si es distinta a 1 aa otra base
                        $fields2 = DB::connection('mysql2')->select($query);
                        $cabezeras=$this->cabezerasgraficos($fields2 );

                        var_dump($fields2);
                        $subject = $value->asunto;
                        $for = "kayser1712@gmail.com";
                        Mail::send('mail',["fields2"=>$fields2,'cabezeras'=>$cabezeras], function($msj) use($subject,$for){
                            $msj->from("prueba@siennasystem.com","luis");
                            $msj->subject($subject);
                            $msj->to($for);
                        });
                    }
            }
               
        }
  
    }

     public function getTicketsCreated()
    {
        $queryTicketsCreated = "SELECT COUNT(*) AS `count`FROM `siennatickets_view` 
        LEFT JOIN `siennasource` AS `Siennasource` ON `siennatickets_view`.`siennasource` = `Siennasource`.`id`
        LEFT JOIN `siennadepto` AS `Siennadepto` ON `siennatickets_view`.`siennadepto` = `Siennadepto`.`id`
        LEFT JOIN `users` AS `Users - Siennaestado` ON `siennatickets_view`.`siennaestado` = `Users - Siennaestado`.`id`";
        $resultTicketCreated = DB::select($queryTicketsCreated);
        
        return $resultTicketCreated;
    } 
    public function getTicketsByStatus()
    {
        $queryByStatus = "SELECT `Siennaestado`.`nombre` AS `Siennaestado__nombre`, COUNT(*) AS `count` FROM `siennatickets_view`
        LEFT JOIN `siennasource` AS `Siennasource` ON `siennatickets_view`.`siennasource` = `Siennasource`.`id`
        LEFT JOIN `siennadepto` AS `Siennadepto` ON `siennatickets_view`.`siennadepto` = `Siennadepto`.`id`
        LEFT JOIN `siennaestado` AS `Siennaestado` ON `siennatickets_view`.`siennaestado` = `Siennaestado`.`id`
        GROUP BY
            `Siennaestado`.`nombre`
        ORDER BY
            `count` DESC,
            `Siennaestado`.`nombre` ASC";
        $resultByStatus = DB::select($queryByStatus);

        return $resultByStatus;       
    }
    public function getTicketPerAgent() 
    {
        $queryPerAgent = "SELECT `Users - Asignado`.`last_name` AS `Users - Asignado__last_name`, COUNT(*) AS `count`
        FROM
        `siennatickets_view`
        LEFT JOIN `users` AS `Users - Asignado` ON `siennatickets_view`.`asignado` = `Users - Asignado`.`id`
        GROUP BY
        `Users - Asignado`.`last_name`
        ORDER BY
        `Users - Asignado`.`last_name` ASC";

        $resultPerAgent = DB::select($queryPerAgent);
        
        return $resultPerAgent;
    }

    public function getTicketPerChannel()
    {
        $queryPerChannel = "SELECT
        `Siennasource`.`nombre` AS `Siennasource__nombre`, COUNT(*) AS `count`
        FROM `siennatickets_view`
        LEFT JOIN `siennasource` AS `Siennasource` ON `siennatickets_view`.`siennasource` = `Siennasource`.`id`
        LEFT JOIN `siennadepto` AS `Siennadepto` ON `siennatickets_view`.`siennadepto` = `Siennadepto`.`id`
        LEFT JOIN `users` AS `Users` ON `siennatickets_view`.`user_id` = `Users`.`id`
        GROUP BY
        `Siennasource`.`nombre`
        ORDER BY
        `count` DESC,
        `Siennasource`.`nombre` ASC";

        $resultPerChannel = DB::select($queryPerChannel);

        return $resultPerChannel;
    }

    public function getTicketByDepartment()
    {
        $queryByDepartment = "SELECT
        `Siennadepto`.`nombre` AS `Siennadepto__nombre`,
        COUNT(*) AS `count`
        FROM `siennatickets_view`
        LEFT JOIN `siennasource` AS `Siennasource` ON `siennatickets_view`.`siennasource` = `Siennasource`.`id`
        LEFT JOIN `siennadepto` AS `Siennadepto` ON `siennatickets_view`.`siennadepto` = `Siennadepto`.`id`
        LEFT JOIN `users` AS `Users` ON `siennatickets_view`.`user_id` = `Users`.`id`
        GROUP BY
        `Siennadepto`.`nombre`
        ORDER BY
        `count` DESC,
        `Siennadepto`.`nombre` ASC";

        $resultByDepartment = DB::select($queryByDepartment);

        return $resultByDepartment;
    }

    public function getTicketPendings()
    {
        $queryTicketPendings = "SELECT `Siennadepto`.`nombre` AS `Siennadepto__nombre`, COUNT(*) AS `count` FROM `siennatickets_view`
        LEFT JOIN `siennasource` AS `Siennasource` ON `siennatickets_view`.`siennasource` = `Siennasource`.`id`
        LEFT JOIN `users` AS `Users` ON `siennatickets_view`.`user_id` = `Users`.`id`
        LEFT JOIN `siennaestado` AS `Siennaestado` ON `siennatickets_view`.`siennaestado` = `Siennaestado`.`id`
        LEFT JOIN `siennadepto` AS `Siennadepto` ON `siennatickets_view`.`siennadepto` = `Siennadepto`.`id`
        WHERE
        (`Siennaestado`.`nombre` <> 'Cerrado')
        OR (`Siennaestado`.`nombre` IS NULL)
        GROUP BY
        `Siennadepto`.`nombre`";
        
        $resultTicketPendings = DB::select($queryTicketPendings);

        return $resultTicketPendings;
    }

    public function getTimeOfLiveOfTickets()
    {
            $queryTimeOfLive = "SELECT
            DATE(`siennatickets_view`.`timeoflife`) AS `timeoflife`,
            COUNT(*) AS `count`
            FROM
            `siennatickets_view`

            LEFT JOIN `siennasource` AS `Siennasource` ON `siennatickets_view`.`siennasource` = `Siennasource`.`id`
            LEFT JOIN `siennadepto` AS `Siennadepto` ON `siennatickets_view`.`siennadepto` = `Siennadepto`.`id`
            GROUP BY
            DATE(`siennatickets_view`.`timeoflife`)
            ORDER BY
            DATE(`siennatickets_view`.`timeoflife`) ASC";

            $resultTimeOfLive = DB::select($queryTimeOfLive);

            return $resultTimeOfLive;
    }

    public function getTicketPerDepartmentByDay() {
        $queryDepartmentByDay = "SELECT
            `Siennadepto`.`nombre` AS `Siennadepto__nombre`,
            DATE(`siennatickets_view`.`Creado`) AS `Creado`,
            COUNT(*) AS `count`
            FROM
            `siennatickets_view`

            LEFT JOIN `siennasource` AS `Siennasource` ON `siennatickets_view`.`siennasource` = `Siennasource`.`id`
            LEFT JOIN `siennadepto` AS `Siennadepto` ON `siennatickets_view`.`siennadepto` = `Siennadepto`.`id`
            LEFT JOIN `users` AS `Users` ON `siennatickets_view`.`user_id` = `Users`.`id`
            GROUP BY
            `Siennadepto`.`nombre`,
            DATE(`siennatickets_view`.`Creado`)
            ORDER BY
            `Siennadepto`.`nombre` ASC,
            DATE(`siennatickets_view`.`Creado`) ASC LIMIT 50" ;

            $resultDepartmentByDay = DB::select($queryDepartmentByDay);

            return $resultDepartmentByDay;
    }

    public function getTicketPendingByTopic()
    {
        $queryPendigByTopic = "SELECT
            `Siennatopic`.`nombre` AS `Siennatopic__nombre`,
            COUNT(*) AS `count`
            FROM
            `siennatickets_view`

            LEFT JOIN `siennaestado` AS `Siennaestado - Siennadepto` ON `siennatickets_view`.`siennadepto` = `Siennaestado - Siennadepto`.`id`
            LEFT JOIN `siennatopic` AS `Siennatopic` ON `siennatickets_view`.`siennatopic` = `Siennatopic`.`id`
            WHERE
            (`Siennaestado - Siennadepto`.`nombre` <> 'Cerrado')

            OR (`Siennaestado - Siennadepto`.`nombre` IS NULL)
            GROUP BY
            `Siennatopic`.`nombre`
            ORDER BY
            `count` DESC,
            `Siennatopic`.`nombre` ASC";

             $resultPendingByTopic = DB::select($queryPendigByTopic);

            return $resultPendingByTopic;
    }

    public function getTicketTopicPerDay() 
    {
        $queryTopicPerDay = "SELECT
        DATE(`siennatickets_view`.`Creado`) AS `Creado`,
        `Siennatopic`.`nombre` AS `Siennatopic__nombre`,
        COUNT(*) AS `count`
        FROM
        `siennatickets_view`

        LEFT JOIN `siennaestado` AS `Siennaestado` ON `siennatickets_view`.`siennaestado` = `Siennaestado`.`id`
        LEFT JOIN `siennadepto` AS `Siennadepto` ON `siennatickets_view`.`siennadepto` = `Siennadepto`.`id`
        LEFT JOIN `siennatopic` AS `Siennatopic` ON `siennatickets_view`.`siennatopic` = `Siennatopic`.`id`
        GROUP BY
        DATE(`siennatickets_view`.`Creado`),
        `Siennatopic`.`nombre`
        ORDER BY
        `count` ASC,
        DATE(`siennatickets_view`.`Creado`) ASC,
        `Siennatopic`.`nombre` ASC LIMIT 50";

        $resultTopicPerDay = DB::select($queryTopicPerDay);

        return $resultTopicPerDay;
    }

    public function getAgents() 
    {
        $queryGetAgent = "SELECT id, nombre, last_name, deptosuser FROM users";
        $resultAgents = DB::select($queryGetAgent);
        return $resultAgents;
    }

    public function getSources() 
    {
        $queryGetSource = "SELECT id, nombre FROM siennasource";
        $resultGetSource = DB::select($queryGetSource);
        return $resultGetSource;
    }

    public function getDepartments() 
    {
        $queryGetDepartment = "SELECT id, nombre FROM siennadepto";
        $resultGetDepartment = DB::select($queryGetDepartment);
        return $resultGetDepartment;
    }
    public function dashboardgeneric()
    {
        
        $ticketCreated = $this->getTicketsCreated();
        $ticketByStatus = $this->getTicketsByStatus();
        $ticketPerAgent = $this->getTicketPerAgent();
        $ticketPerChannel = $this->getTicketPerChannel();
        $ticketByDepartment = $this->getTicketByDepartment();
        $ticketPendings = $this->getTicketPendings();
        $ticketTimeOfLive = $this->getTimeOfLiveOfTickets();
        $ticketPerDepartmentByDay = $this->getTicketPerDepartmentByDay();
        $ticketPendingByTopic = $this->getTicketPendingByTopic();
        $ticketTopicPerDay = $this->getTicketTopicPerDay();
        $getAgent = $this->getAgents();
        $getSource = $this->getSources();
        $getDepartment = $this->getDepartments();

        return view('sienna/dash', [
            'tickets' => $ticketCreated,
            'status' => $ticketByStatus,
            'perAgent' => $ticketPerAgent,
            'perChannel' => $ticketPerChannel,
            'byDepartment' => $ticketByDepartment,
            'tickets_pendings' => $ticketPendings,
            'ticket_timeLive' => $ticketTimeOfLive,
            'departmentByDay' => $ticketPerDepartmentByDay,
            'pendingByTopic' => $ticketPendingByTopic,
            'topicPerDay' => $ticketTopicPerDay,
            'agents' => $getAgent,
            'sources' => $getSource,
            'departments' => $getDepartment
        ]);
    }
}
