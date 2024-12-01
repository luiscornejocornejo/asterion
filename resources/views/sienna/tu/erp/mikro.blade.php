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
$getdata= file_get_contents("https://".$subdomain_tmp.".suricata-mikrowisp.com.ar/api/ListTicket?token=".$tokensienna."&c=" . $resultadoscliente[0]->cliente);

?>
<div class="card widget-flat" id="infoUser">
    <div class="card-body">

        <div style="background-color: #38b0de;" class="d-flex justify-content-end">
            <div class="me-2">
                <img src="https://<?php echo $subdomain_tmp;?>.suricata.cloud/img/erp/mikrowisp.webp"
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

                <form method="post" action="api/crearmikrowisp">
                    @csrf
                    <input type="hidden" name="tokensienna" value="<?php echo $tokensienna;?>"/>
                    <input type="hidden" name="dom" value="<?php echo $subdomain_tmp;?>"/>
                    <div class="row">
                        <div class="col-xxl-2 col-xl-2 col-lg-2 col-sm-12 mb-2">
                            <label for="example-textarea" class="form-label">Cliente</label>
                            <input required name="cliente" type="text" class="form-control" id="lastNameUser"
                                value="<?php echo $resultadoscliente[0]->cliente; ?>">
                            
                        </div>
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-sm-12 mb-2">
                            <label for="example-textarea" class="form-label">Asunto</label>
                            <input required name="asunto" type="text" class="form-control" id="lastNameUser">
                            <input required value="PAGINA WEB" name="agendado" type="hidden" class="form-control" id="lastNameUser">
                        </div>
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-sm-12 mb-2">
                            <label for="example-textarea" class="form-label">Visita Tecnica</label>
                            <input required name="fecha" type="date" class="form-control" id="lastNameUser">
                        </div>
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-sm-12 mb-2">
                            <label for="example-textarea" class="form-label">Turno</label>
                            <select class="form-select js-example-basic-single" name="turno" id="agent">

                            <option >MAÑANA</option>
                            <option >TARDE</option>
                            </select>
                        </div>
                        <div class="col-xxl-5 col-xl-5 col-lg-5 col-sm-12 mb-2">
                            <label for="agent" class="form-label">Departamento:</label>
                            <select class="form-select js-example-basic-single" name="depto" id="agent">

                               <option value="1">Soporte</option>
                            </select>
                        </div> 
                        
                      
                        <div class="mb-2">
                            <label for="example-textarea" class="form-label">Descripcion</label>
                            <textarea required name="contenido" class="form-control" id="example-textarea" rows="4"></textarea>
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
                            <?php echo $getdata;?>
        </div>
            <div class="tab-pane" id="extra">
                <div data-tf-live="01JDFRQDH03PQAH7HE59FRXFB0"></div>
                <script src="//embed.typeform.com/next/embed.js"></script>
            </div>
        </div>
    </div>
</div>
  