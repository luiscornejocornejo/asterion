<?php

if (isset($resultadoscliente[0]->cliente)) {
} else {
    return '';
}
if($subdomain_tmp=="wiber2"){
    $subdomain_tmp="wiber";
}

function conectar($id)
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
$queryws = "SELECT * from mikrowisp.ws_cliente where nombre='" . $subdomain_tmp . "'";
        $baseget="14";
        $prueba = conectar($baseget);
        $resultadosws = DB::connection('mysql2')->select($queryws);

        foreach ($resultadosws as $value) {

            $tokensienna = $value->tokensienna;
            $urilogin = $value->urilogin;
        }

$lista= file_get_contents("https://".$subdomain_tmp.".suricata-mikrowisp.com.ar/api/ListTicket?token=".$tokensienna."&idcliente=" . $resultadoscliente[0]->cliente);

$data = json_decode($lista, true);

// Acceder a la propiedad 'data'
$dataContent = $data['data'];

// Acceder específicamente a 'tickets'
//$tickets = $dataContent['tickets'];

// Mostrar datos separados
/*
$estados= file_get_contents("https://".$subdomain_tmp.".suricata-ispkeeper.com.ar/api/estado?token=".$tokensienna."");
$estados2=json_decode($estados, true);

$usuariosserp = file_get_contents("https://".$subdomain_tmp.".suricata-ispkeeper.com.ar/api/usuarios?token=".$tokensienna."");
$usuariosserp2 = json_decode($usuariosserp, true);
$ticketserp = file_get_contents("https://".$subdomain_tmp.".suricata-ispkeeper.com.ar/api/tickets?token=".$tokensienna."&cliente_id=" . $resultadoscliente[0]->cliente);
$ticketserp2 = json_decode($ticketserp, true);*/
?>
<div class="card widget-flat" id="infoUser">
    <div class="card-body">

        <div style="background-color: #6D0078;" class="d-flex justify-content-end">
            <div class="me-2">
                <img src="https://".$subdomain_tmp.".suricata.cloud/mikrowisp.webp"
                    alt="mikrowisp logo" height="55">
            </div>
        </div>
        <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
            <li class="nav-item">
                <a href="#ticket" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 active">
                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                    <span class="d-none d-md-block">Tickets</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#data" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                    <i class="mdi mdi-account-circle d-md-none d-block"></i>
                    <span class="d-none d-md-block">Datos</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#extra" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                    <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                    <span class="d-none d-md-block">Extra</span>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane show active" id="ticket">

                <form method="post" action="api/crearispkipper">
                    @csrf
                    <input type="hidden" name="tokensienna" value="<?php echo $tokensienna;?>"/>
                    <input type="hidden" name="dom" value="<?php echo $subdomain_tmp;?>"/>
                    <div class="row">
                        <div class="col-xxl-2 col-xl-2 col-lg-2 col-sm-12 mb-2">
                            <label for="example-textarea" class="form-label">Cliente</label>
                            <input required name="cliente" type="text" class="form-control" id="lastNameUser"
                                value="<?php echo $resultadoscliente[0]->cliente; ?>">
                            <input name="prioridad" type="hidden" class="form-control" id="lastNameUser"
                                value="3">
                        </div>
                        <div class="col-xxl-5 col-xl-5 col-lg-5 col-sm-12 mb-2">
                            <label for="agent" class="form-label">Agente:</label>
                            <select class="form-select js-example-basic-single" name="usuarios" id="agent">

                               
                            </select>
                        </div> 
                        <div class="col-xxl-5 col-xl-5 col-lg-5 col-sm-12 mb-2">
                            <label class="form-label" for="description">Subcategoria:</label>
                            <select class="form-select js-example-basic-single" name="subcategoria" id="subcategoria" >

                               



   
                                    
                            </select>
                        </div>
                      
                        <div class="mb-2">
                            <label for="example-textarea" class="form-label">Descripcion</label>
                            <textarea name="detalle" class="form-control" id="example-textarea" rows="4"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-3 mb-2">Crear Ticket</button>
                    <hr class="mx-1" />
                </form>

                <table id="casadepapel" class="table table-striped dt-responsive nowrap w-100 text-light">
                    <thead>
                        <tr class="text-center bg-dark">
                            <th class="text-light">Ticket_id</th>
                            <th class="text-light">Fecha</th>
                            <th class="text-light">Estado</th>
                            <th class="text-light">Asunto</th>
                        </tr>
                    </thead>
                    <tbody id="log">
                        <?php for($i=0;$i<sizeof($dataContent['tickets']);$i++){
                                        ?>
                        <tr class="text-center">
                            <td><a target='_blank' href='{{ $dataContent['tickets'][$i]['id'] }}'>{{ $dataContent['tickets'][$i]['id'] }}</a> </td>
                            <td>{{ $dataContent['tickets'][$i]['fecha_soporte'] }}
                            </td>
                            <td> {{ $dataContent['tickets'][$i]['estado'] }} </td>

                            <td>{{ $dataContent['tickets'][$i]['asunto'] }} </td>


                        </tr>
                        <?php }?>

                    </tbody>
                </table>


            </div>
            <div class="tab-pane " id="data">
                Aqui va información de datos
            </div>
            <div class="tab-pane" id="extra">
                <div data-tf-live="01JDFRQDH03PQAH7HE59FRXFB0"></div>
                <script src="//embed.typeform.com/next/embed.js"></script>
            </div>
        </div>
    </div>
</div>
  