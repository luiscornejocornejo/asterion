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
use Carbon\Carbon;

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

     public function getTicketsCreated($source,$department,$agent,$periodo)
    {
        $dom=$this->dominio();
        $subquery=$this->subquery($source,$department,$agent,$periodo);

        $queryTicketsCreated = "SELECT COUNT(*) AS `count`FROM ".$dom.".`siennatickets_view` 
        LEFT JOIN ".$dom.".`siennasource` AS `Siennasource` ON `siennatickets_view`.`siennasource` = `Siennasource`.`id`
        LEFT JOIN ".$dom.".`siennadepto` AS `Siennadepto` ON `siennatickets_view`.`siennadepto` = `Siennadepto`.`id`
        LEFT JOIN ".$dom.".`users` AS `Users - Siennaestado` ON `siennatickets_view`.`siennaestado` = `Users - Siennaestado`.`id`";
        

        $resultTicketCreated = DB::connection('mysql2')->select($queryTicketsCreated.$subquery);
        
        return $resultTicketCreated;
    } 

    public function getTicketsCreatedQty($source,$department,$agent,$periodo)
    {
        $dom = $this->dominio();
    $subquery = $this->subquery($source, $department, $agent, $periodo);

    $queryTicketsCreatedQty = "SELECT id FROM " . $dom . ".`siennatickets_view`";
    $resultTicketCreatedQty = DB::connection('mysql2')->select($queryTicketsCreatedQty . $subquery);

    return $resultTicketCreatedQty;
    } 
    
    public function getTicketsByStatus($source,$department,$agent,$periodo)
    {
        $dom=$this->dominio();
        $subquery=$this->subquery($source,$department,$agent,$periodo);

        $queryByStatus = "SELECT `Siennaestado`.`nombre` AS `Siennaestado__nombre`, COUNT(*) AS `count` FROM ".$dom.".`siennatickets_view`
        LEFT JOIN ".$dom.".`siennasource` AS `Siennasource` ON `siennatickets_view`.`siennasource` = `Siennasource`.`id`
        LEFT JOIN ".$dom.".`siennadepto` AS `Siennadepto` ON `siennatickets_view`.`siennadepto` = `Siennadepto`.`id`
        LEFT JOIN ".$dom.".`siennaestado` AS `Siennaestado` ON `siennatickets_view`.`siennaestado` = `Siennaestado`.`id`
        ".$subquery."
        GROUP BY
            `Siennaestado`.`nombre`
        ORDER BY
            `count` DESC,
            `Siennaestado`.`nombre` ASC";
        $resultByStatus = DB::select($queryByStatus);

        return $resultByStatus;       
    }
    public function getTicketPerAgent($source,$department,$agent,$periodo) 
    {
        $dom=$this->dominio();
        $subquery=$this->subquery($source,$department,$agent,$periodo);

        $queryPerAgent = "SELECT `Users - Asignado`.`last_name` AS `Users - Asignado__last_name`, `Users - Asignado`.`nombre` AS `Users - Asignado__nombre`, 
        COUNT(*) AS `count`
        FROM ".$dom.".`siennatickets_view`
        LEFT JOIN ".$dom.".`users` AS `Users - Asignado` ON `siennatickets_view`.`asignado` = `Users - Asignado`.`id`
         ".$subquery."
         GROUP BY
        `Users - Asignado`.`last_name`,
        `Users - Asignado`.`nombre`
        ORDER BY
        `Users - Asignado`.`last_name` ASC";

        $resultPerAgent =  DB::connection('mysql2')->select($queryPerAgent);
        
        return $resultPerAgent;
    }

    public function subquery($source,$department,$agent,$periodo){
        $subquery = " WHERE 1=1"; 
        if($source<>null){
            $source = implode(', ', $source);
           $subquery.=" and siennatickets_view.siennasource in(".$source.")";
        }
        if($department<>null){
            $department = implode(', ', $department);
           $subquery.=" and siennatickets_view.siennadepto in(".$department.")";
        }
        if ($periodo !== null) {
           // $department = implode(', ', $department);
        
            $daterange = null;
           switch ($periodo) {
            case '0':  // Hoy
                $daterange = [
                    'start' => Carbon::today()->toDateString(),
                    'end' => Carbon::today()->toDateString()
                ];
                break;
        
                case '1':  // Ayer
                    $daterange = [
                        'start' => Carbon::yesterday()->toDateString(),
                        'end' => Carbon::yesterday()->toDateString()
                    ];
                    break;
            
                case '2':  // Últimos 7 días
                    $daterange = [
                        'start' => Carbon::today()->subDays(7)->toDateString(),
                        'end' => Carbon::today()->toDateString()
                    ];
                    break;
            
                case '3':  // Últimos 30 días
                    $daterange = [
                        'start' => Carbon::today()->subDays(30)->toDateString(),
                        'end' => Carbon::today()->toDateString()
                    ];
                    break;
            
                case '4':  // Mes actual
                    $daterange = [
                        'start' => Carbon::now()->startOfMonth()->toDateString(),
                        'end' => Carbon::now()->toDateString()
                    ];
                    break;
            
                case '5':  // Mes anterior
                    $daterange = [
                        'start' => Carbon::now()->subMonth()->startOfMonth()->toDateString(),
                        'end' => Carbon::now()->subMonth()->endOfMonth()->toDateString()
                    ];
                    break;
            
                case '6':  // Rango personalizado
                    // En este caso, deberías capturar las fechas de inicio y fin de un formulario adicional
                    // Aquí se debe manejar las entradas del usuario
                    $daterange = [
                        'start' => $_POST['start_date'],  // Capturar el valor del input de inicio
                        'end' => $_POST['end_date']  // Capturar el valor del input de fin
                    ];
                    break;
            
                default:
                    // No hacer nada si no hay selección válida
                    $daterange = [
                        'start' => Carbon::today()->toDateString(),
                        'end' => Carbon::today()->toDateString()
                    ];
                    break;
            }
            if (isset($daterange['start']) && isset($daterange['end'])) {

           $subquery .= " AND siennatickets_view.created_at > '".$daterange['start']." 00:00:00' AND siennatickets_view.created_at < '".$daterange['end']." 23:59:59'";
            }
        }
        if($agent<>null){
            $agent = implode(', ', $agent);
           $subquery.=" and siennatickets_view.asignado in(".$agent.")";
        }
        
        return $subquery;
    }
    public function getTicketPerChannel($source,$department,$agent,$periodo)
    {
        $dom=$this->dominio();
        $subquery=$this->subquery($source,$department,$agent,$periodo);

        $queryPerChannel = "SELECT
        `Siennasource`.`nombre` AS `Siennasource__nombre`, COUNT(*) AS `count`
        FROM ".$dom.".`siennatickets_view`
        LEFT JOIN ".$dom.".`siennasource` AS `Siennasource` ON `siennatickets_view`.`siennasource` = `Siennasource`.`id`
        LEFT JOIN ".$dom.".`siennadepto` AS `Siennadepto` ON `siennatickets_view`.`siennadepto` = `Siennadepto`.`id`
        LEFT JOIN ".$dom.".`users` AS `Users` ON `siennatickets_view`.`user_id` = `Users`.`id`
         ".$subquery."
        GROUP BY
        `Siennasource`.`nombre`
        ORDER BY
        `count` DESC,
        `Siennasource`.`nombre` ASC";

        $resultPerChannel =  DB::connection('mysql2')->select($queryPerChannel);

        return $resultPerChannel;
    }

    public function getTicketByDepartment($source,$department,$agent,$periodo)
    {
        $dom=$this->dominio();
        $subquery=$this->subquery($source,$department,$agent,$periodo);
       $queryByDepartment = "SELECT
        `Siennadepto`.`nombre` AS `Siennadepto__nombre`,
        COUNT(*) AS `count`
        FROM ".$dom.".`siennatickets_view`
        LEFT JOIN ".$dom.".`siennasource` AS `Siennasource` ON `siennatickets_view`.`siennasource` = `Siennasource`.`id`
        LEFT JOIN ".$dom.".`siennadepto` AS `Siennadepto` ON `siennatickets_view`.`siennadepto` = `Siennadepto`.`id`
        LEFT JOIN ".$dom.".`users` AS `Users` ON `siennatickets_view`.`user_id` = `Users`.`id`
         ".$subquery."
        GROUP BY
        `Siennadepto`.`nombre`
        ORDER BY
        `count` DESC,
        `Siennadepto`.`nombre` ASC";

        $resultByDepartment = DB::connection('mysql2')->select($queryByDepartment);

        return $resultByDepartment;
    }

    public function getTicketPendings($source,$department,$agent,$periodo)
    {
        $dom=$this->dominio();
        $subquery=$this->subquery($source,$department,$agent,$periodo);

        $queryTicketPendings = "SELECT `Siennadepto`.`nombre` AS `Siennadepto__nombre`, COUNT(*) AS `count` FROM ".$dom.".`siennatickets_view`
        LEFT JOIN ".$dom.".`siennasource` AS `Siennasource` ON `siennatickets_view`.`siennasource` = `Siennasource`.`id`
        LEFT JOIN ".$dom.".`users` AS `Users` ON `siennatickets_view`.`user_id` = `Users`.`id`
        LEFT JOIN ".$dom.".`siennaestado` AS `Siennaestado` ON `siennatickets_view`.`siennaestado` = `Siennaestado`.`id`
        LEFT JOIN ".$dom.".`siennadepto` AS `Siennadepto` ON `siennatickets_view`.`siennadepto` = `Siennadepto`.`id`
        ".$subquery."
       and (`Siennaestado`.`nombre` <> 'Cerrado')
        OR (`Siennaestado`.`nombre` IS NULL)
        GROUP BY
        `Siennadepto`.`nombre`";
        
        $resultTicketPendings = DB::connection('mysql2')->select($queryTicketPendings);

        return $resultTicketPendings;
    }

    public function getTimeOfLiveOfTickets($source,$department,$agent,$periodo)
    {
        $dom=$this->dominio();
        $subquery=$this->subquery($source,$department,$agent,$periodo);

            $queryTimeOfLive = "SELECT
            DATE(`siennatickets_view`.`timeoflife`) AS `timeoflife`,
            COUNT(*) AS `count`
            FROM
            ".$dom.".`siennatickets_view`

            LEFT JOIN ".$dom.".`siennasource` AS `Siennasource` ON `siennatickets_view`.`siennasource` = `Siennasource`.`id`
            LEFT JOIN ".$dom.".`siennadepto` AS `Siennadepto` ON `siennatickets_view`.`siennadepto` = `Siennadepto`.`id`
                    ".$subquery."

            GROUP BY
            DATE(`siennatickets_view`.`timeoflife`)
            ORDER BY
            DATE(`siennatickets_view`.`timeoflife`) ASC";

            $resultTimeOfLive = DB::connection('mysql2')->select($queryTimeOfLive);

            return $resultTimeOfLive;
    }

    public function getTicketPerDepartmentByDay($source,$department,$agent,$periodo) {
        $dom=$this->dominio();
        $subquery=$this->subquery($source,$department,$agent,$periodo);

        $queryDepartmentByDay = "SELECT
            `Siennadepto`.`nombre` AS `Siennadepto__nombre`,
            DATE(".$dom.".`siennatickets_view`.`Creado`) AS `Creado`,
            COUNT(*) AS `count`
            FROM
            ".$dom.".`siennatickets_view`

            LEFT JOIN ".$dom.".`siennasource` AS `Siennasource` ON `siennatickets_view`.`siennasource` = `Siennasource`.`id`
            LEFT JOIN ".$dom.".`siennadepto` AS `Siennadepto` ON `siennatickets_view`.`siennadepto` = `Siennadepto`.`id`
            LEFT JOIN ".$dom.".`users` AS `Users` ON `siennatickets_view`.`user_id` = `Users`.`id`
              ".$subquery."
              GROUP BY
            `Siennadepto`.`nombre`,
            DATE(".$dom.".`siennatickets_view`.`Creado`)
            ORDER BY
            `Siennadepto`.`nombre` ASC,
            DATE(".$dom.".`siennatickets_view`.`Creado`) ASC" ;

            $resultDepartmentByDay = DB::connection('mysql2')->select($queryDepartmentByDay);

            return $resultDepartmentByDay;
    }

    public function getTicketPendingByTopic($source,$department,$agent,$periodo)
    {
        $dom=$this->dominio();
        $subquery=$this->subquery($source,$department,$agent,$periodo);

        $queryPendigByTopic = "SELECT
            `Siennatopic`.`nombre` AS `Siennatopic__nombre`,
            COUNT(*) AS `count`
            FROM
            ".$dom.".`siennatickets_view`

            LEFT JOIN ".$dom.".`siennaestado` AS `Siennaestado - Siennadepto` ON `siennatickets_view`.`siennadepto` = `Siennaestado - Siennadepto`.`id`
            LEFT JOIN ".$dom.".`siennatopic` AS `Siennatopic` ON `siennatickets_view`.`siennatopic` = `Siennatopic`.`id`
              ".$subquery." and
            (`Siennaestado - Siennadepto`.`nombre` <> 'Cerrado')

            OR (`Siennaestado - Siennadepto`.`nombre` IS NULL)
            GROUP BY
            `Siennatopic`.`nombre`
            ORDER BY
            `count` DESC,
            `Siennatopic`.`nombre` ASC";

             $resultPendingByTopic = DB::connection('mysql2')->select($queryPendigByTopic);

            return $resultPendingByTopic;
    }

    public function getTicketTopicPerDay($source,$department,$agent,$periodo) 
    {
        $dom=$this->dominio();
        $subquery=$this->subquery($source,$department,$agent,$periodo);

        $queryTopicPerDay = "SELECT
        DATE(`siennatickets_view`.`Creado`) AS `Creado`,
        `Siennatopic`.`nombre` AS `Siennatopic__nombre`,
        COUNT(*) AS `count`
        FROM
        ".$dom.".`siennatickets_view`

        LEFT JOIN ".$dom.".`siennaestado` AS `Siennaestado` ON `siennatickets_view`.`siennaestado` = `Siennaestado`.`id`
        LEFT JOIN ".$dom.".`siennadepto` AS `Siennadepto` ON `siennatickets_view`.`siennadepto` = `Siennadepto`.`id`
        LEFT JOIN ".$dom.".`siennatopic` AS `Siennatopic` ON `siennatickets_view`.`siennatopic` = `Siennatopic`.`id`
          ".$subquery."
          GROUP BY
        DATE(".$dom.".`siennatickets_view`.`Creado`),
        `Siennatopic`.`nombre`
        ORDER BY
        `count` ASC,
        DATE(".$dom.".`siennatickets_view`.`Creado`) ASC,
        `Siennatopic`.`nombre` ASC LIMIT 50";

        $resultTopicPerDay = DB::connection('mysql2')->select($queryTopicPerDay);

        return $resultTopicPerDay;
    }


    public function getTickets(Request $request)
    {
        $base=25;
        $prueba = $this->conectar($base);
        $dom = $this->dominio();
        $ticket_ids = $request->input('ticket_ids');
        
        $queryGetTickets = "select 
        a.cliente,
        a.nya as nombre,
        a.cel as callid,
        a.id as ticketid,
        b.nombre as departamento,
        d.nombre as tema,
        g.nombre as fuente,
        c.nombre as estado,
        cs.r1,
        cs.r2,
        cs.r3,
        cs.csat,
        concat(u.nombre, ' ', u.last_name) as asignado,
        a.t_cerrado as cerrado,
        s2.autor,
        timestampdiff(minute, a.created_at, a.t_cerrado) as lifetime,
        date_sub(a.created_at, interval (select local from " . $dom . ".empresa limit 1) hour) as creado,
        date_sub(a.t_cerrado, interval (select local from " . $dom . ".empresa limit 1) hour) as cerrado
        from 
            " . $dom . ".siennatickets as a
        left join " . $dom . ".siennadepto b on b.id = a.siennadepto 
        left join " . $dom . ".siennaestado c on c.id = a.siennaestado
        left join " . $dom . ".csat cs on cs.ticket = a.id
        left join " . $dom . ".siennatopic d on d.id = a.siennatopic
        left join " . $dom . ".siennasource g on g.id = a.siennasource
        left join " . $dom . ".users u on u.id = a.asignado
        left join (
            select ticket, autor 
            from " . $dom . ".siennaseguimientos 
            where tipo = 2 
            order by id desc limit 1
        ) s2 on s2.ticket = a.id
        where 
            a.id in(".$ticket_ids.")
        order by 
            timestampdiff(minute, a.created_at, a.t_cerrado) desc;";

        $resultGetTicket = DB::connection('mysql2')->select($queryGetTickets);
        
        dd($resultGetTicket); die;
        
        
        return redirect()->route('sienna/dashboard/report')->with('tickets', $resultGetTicket);
        
    }

    public function reportDashboard()
    {
        $tickets = session('tickets');
        return view('sienna/dashboard/report', compact('tickets'));
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

        $base=25;
        $prueba = $this->conectar($base);

        $source="";
        $department="";
        $agent="";
        $daterange="";
        $ticketCreated = $this->getTicketsCreated($source,$department,$agent,$daterange);
        $ticketByStatus = $this->getTicketsByStatus($source,$department,$agent,$daterange);
        $ticketPerAgent = $this->getTicketPerAgent($source,$department,$agent,$daterange);
        $ticketPerChannel = $this->getTicketPerChannel($source,$department,$agent,$daterange);
        $ticketByDepartment = $this->getTicketByDepartment($source,$department,$agent,$daterange);
        $ticketPendings = $this->getTicketPendings($source,$department,$agent,$daterange);
        $ticketTimeOfLive = $this->getTimeOfLiveOfTickets($source,$department,$agent,$daterange);
        $ticketPerDepartmentByDay = $this->getTicketPerDepartmentByDay($source,$department,$agent,$daterange);
        $ticketPendingByTopic = $this->getTicketPendingByTopic($source,$department,$agent,$daterange);
        $ticketTopicPerDay = $this->getTicketTopicPerDay($source,$department,$agent,$daterange);
        $getAgent = $this->getAgents();
        $getSource = $this->getSources();
        $getDepartment = $this->getDepartments();
        $getTicketsCreatedQty = $this->getTicketsCreatedQty($source,$department,$agent,$daterange);

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
            'departments' => $getDepartment,
            'filter' => [$source, $department, $agent, $daterange],
            'qtyTickets' => $getTicketsCreatedQty
            
        ]);
    }
    public function dashboardgeneric2(Request $request)
    {
        $base=25;
        $prueba = $this->conectar($base);
        
        $source=$request->channel;
        $department=$request->department;
        $agent=$request->agent;
        $daterange=$request->periodo;

        $ticketCreated = $this->getTicketsCreated($source,$department,$agent,$daterange);
        $ticketByStatus = $this->getTicketsByStatus($source,$department,$agent,$daterange);
        $ticketPerAgent = $this->getTicketPerAgent($source,$department,$agent,$daterange);
        $ticketPerChannel = $this->getTicketPerChannel($source,$department,$agent,$daterange);
        $ticketByDepartment = $this->getTicketByDepartment($source,$department,$agent,$daterange);
        $ticketPendings = $this->getTicketPendings($source,$department,$agent,$daterange);
        $ticketTimeOfLive = $this->getTimeOfLiveOfTickets($source,$department,$agent,$daterange);
        $ticketPerDepartmentByDay = $this->getTicketPerDepartmentByDay($source,$department,$agent,$daterange);
        $ticketPendingByTopic = $this->getTicketPendingByTopic($source,$department,$agent,$daterange);
        $ticketTopicPerDay = $this->getTicketTopicPerDay($source,$department,$agent,$daterange);
        $getAgent = $this->getAgents();
        $getSource = $this->getSources();
        $getDepartment = $this->getDepartments();
        $getTicketsCreatedQty = $this->getTicketsCreatedQty($source,$department,$agent,$daterange);

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
            'departments' => $getDepartment,
            'filter' => [$source, $department, $agent, $daterange],
            'qtyTickets' => $getTicketsCreatedQty
            
        ]);
    }


    public function getTotalCsat($source) 
    {
        $subquery=$this->subqueryCsat($source);
        $queryTotalCsat = "SELECT ROUND(AVG(`csat_view`.`CEILING(csat)`), 2) AS `avg`
            FROM
            `csat_view`

            LEFT JOIN `siennatickets_view` AS `SiennaticketsViewTicket` ON `csat_view`.`ticket` = `SiennaticketsViewTicket`.`id`" .$subquery;

            $resultTotalCsat = DB::select($queryTotalCsat);
            return $resultTotalCsat;
    }

    public function surveySended($source)
    {
        $subquery=$this->subqueryCsat($source);
        $querySurveySended = "SELECT COUNT(*) AS `count`, `SiennaticketsViewTicket`.`Creado`
            FROM
            `csat_view`
            LEFT JOIN `siennatickets_view` AS `SiennaticketsViewTicket` ON `csat_view`.`ticket` = `SiennaticketsViewTicket`.`id`
            ".$subquery."
            GROUP BY `SiennaticketsViewTicket`.`Creado`";

        $resultSurveySended = DB::select($querySurveySended);
        return $resultSurveySended;
    }

    public function surveyPerChannel($source)
    {
        $subquery=$this->subqueryCsat($source);
        $querySurveyPerChannel = "SELECT
            `Siennasource`.`nombre` AS `Siennasource__nombre`,
            COUNT(*) AS `count`, `SiennaticketsViewTicket`.`Creado`
            FROM
            `csat_view`

            LEFT JOIN `siennatickets_view` AS `SiennaticketsViewTicket` ON `csat_view`.`ticket` = `SiennaticketsViewTicket`.`id`
            LEFT JOIN `siennasource` AS `Siennasource` ON `SiennaticketsViewTicket`.`siennasource` = `Siennasource`.`id`
            ".$subquery."

            GROUP BY
            `Siennasource`.`nombre`,
            `SiennaticketsViewTicket`.`Creado`
            ORDER BY
            `count` DESC,
            `Siennasource`.`nombre` ASC";

        $resultSurverPerChannel = DB::select($querySurveyPerChannel);
        return $resultSurverPerChannel;
    }

    public function dashboardSurveyGeneric()
    {   
        $source="";
        $daterange="";
        
        $totalCsat = $this->getTotalCsat($source);
        $surverSended = $this->surveySended($source);
        $surveyPerChannel = $this->surveyPerChannel($source);
        $getSource = $this->getSources();
        
        return view('sienna/dashboard/csat', [
            'totalCsat' => $totalCsat,
            'surveySended' => $surverSended,
            'surverPerChannel' => $surveyPerChannel,
            'sources' => $getSource
        ]);
    }

    public function dashboardSurveyGeneric2(Request $request)
    {   
        $source=$request->channel;
        $daterange=$request->periodo ;

        $totalCsat = $this->getTotalCsat($source);
        $surverSended = $this->surveySended($source);
        $surveyPerChannel = $this->surveyPerChannel($source);
        $getSource = $this->getSources();
        
        return view('sienna/dashboard/csat', [
            'totalCsat' => $totalCsat,
            'surveySended' => $surverSended,
            'surverPerChannel' => $surveyPerChannel,
            'sources' => $getSource,
        ]);
    }
    public function dominio()
    {

        $subdomain_tmp = 'localhost';
        if (isset($_SERVER['HTTP_HOST'])) {
            $domainParts = explode('.', $_SERVER['HTTP_HOST']);
            $subdomain_tmp =  array_shift($domainParts);
        } elseif (isset($_SERVER['SERVER_NAME'])) {
            $domainParts = explode('.', $_SERVER['SERVER_NAME']);
            $subdomain_tmp =  array_shift($domainParts);
        }

        return $subdomain_tmp;
    }
    

    public function subqueryCsat($source){
        $subquery = " WHERE 1=1"; 
        if($source<>null){
            $source = implode(', ', $source);
           $subquery.=" and csat_view.siennasource in(".$source.")";
        }
        /*if ($periodo !== null) {

        
           $daterange = null;
           switch ($periodo) {
            case '0':  // Hoy
                $daterange = [
                    'start' => Carbon::today()->toDateString(),
                    'end' => Carbon::today()->toDateString()
                ];
                break;
        
                case '1':  // Ayer
                    $daterange = [
                        'start' => Carbon::yesterday()->toDateString(),
                        'end' => Carbon::yesterday()->toDateString()
                    ];
                    break;
            
                case '2':  // Últimos 7 días
                    $daterange = [
                        'start' => Carbon::today()->subDays(7)->toDateString(),
                        'end' => Carbon::today()->toDateString()
                    ];
                    break;
            
                case '3':  // Últimos 30 días
                    $daterange = [
                        'start' => Carbon::today()->subDays(30)->toDateString(),
                        'end' => Carbon::today()->toDateString()
                    ];
                    break;
            
                case '4':  // Mes actual
                    $daterange = [
                        'start' => Carbon::now()->startOfMonth()->toDateString(),
                        'end' => Carbon::now()->toDateString()
                    ];
                    break;
            
                case '5':  // Mes anterior
                    $daterange = [
                        'start' => Carbon::now()->subMonth()->startOfMonth()->toDateString(),
                        'end' => Carbon::now()->subMonth()->endOfMonth()->toDateString()
                    ];
                    break;
            
                case '6':  // Rango personalizado
                    // En este caso, deberías capturar las fechas de inicio y fin de un formulario adicional
                    // Aquí se debe manejar las entradas del usuario
                    $daterange = [
                        'start' => $_POST['start_date'],  // Capturar el valor del input de inicio
                        'end' => $_POST['end_date']  // Capturar el valor del input de fin
                    ];
                    break;
            
                default:
                    // No hacer nada si no hay selección válida
                    $daterange = [
                        'start' => Carbon::today()->toDateString(),
                        'end' => Carbon::today()->toDateString()
                    ];
                    break;
            }
            if (isset($daterange['start']) && isset($daterange['end'])) {

           $subquery .= " AND siennatickets_view.created_at > '".$daterange['start']." 00:00:00' AND siennatickets_view.created_at < '".$daterange['end']." 23:59:59'";
            }
        }*/
        
        return $subquery;
    }
}
