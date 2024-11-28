<?php

if (isset($resultadoscliente[0]->cliente)) {
} else {
    return '';
}
$subserp= file_get_contents("https://wiber.suricata-ispkeeper.com.ar/api/listadodeticketsubcategorias?token=wiber");
$subserp2=json_decode($subserp, true);

$estados= file_get_contents("https://wiber.suricata-ispkeeper.com.ar/api/estado?token=wiber");
$estados2=json_decode($estados, true);

$usuariosserp = file_get_contents('https://wiber.suricata-ispkeeper.com.ar/api/usuarios?token=wiber');
$usuariosserp2 = json_decode($usuariosserp, true);
$ticketserp = file_get_contents('https://wiber.suricata-ispkeeper.com.ar/api/tickets?token=wiber&cliente_id=' . $resultadoscliente[0]->cliente);
$ticketserp2 = json_decode($ticketserp, true);
?>
<div class="card widget-flat" id="infoUser">
    <div class="card-body">

        <div style="background-color: #6D0078;" class="d-flex justify-content-end">
            <div class="me-2">
                <img src="https://files.readme.io/a2839ba-small-ISPKeeper_Logo_Oficial_Horizontal_white.png"
                    alt="ispkeeper logo" height="55">
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
                            <select name="usuarios" id="agent" class="form-select">

                                <?php for($i=0;$i<sizeof($usuariosserp2);$i++){
                                        ?>
                                <option value="{{ $usuariosserp2[$i]['usuario_id'] }}">
                                    {{ $usuariosserp2[$i]['usuario_nombre'] }}
                                    {{ $usuariosserp2[$i]['usuario_apellido'] }}
                                </option>
                                <?php }
                                    
                                    ?>
                            </select>
                        </div>
                        <div class="col-xxl-5 col-xl-5 col-lg-5 col-sm-12 mb-2">
                            <label class="form-label" for="description">Subcategoria:</label>
                            <select name="subcategoria" id="agent" class="form-select">

                                <?php
                                    
                                    for($i=0;$i<sizeof($subserp2);$i++){
                                        ?>
                                <option value="<?php echo $subserp2[$i]['ticket_subcategoria_id']; ?>">
                                    <?php echo $subserp2[$i]['ticket_subcategoria_nombre']; ?>

                                </option>
                                <?php }


function buscarNombreSubcategoria($subserp2, $idBuscado) {
    for($j=0;$j<sizeof($subserp2);$j++){
        if ($subserp2[$j]["ticket_subcategoria_id"]== $idBuscado) {
            return $subserp2[$j]["ticket_subcategoria_nombre"];
        }
    }
    return null; // Si no se encuentra, devuelve null o cualquier valor por defecto
}
function estados($estados2, $idBuscado) {
   

    foreach ($estados2[0]['data'] as $estado) {
        if ($estado['estado_tickets_id'] === $idBuscado) {
            return $nombre_estado = $estado['estado_tickets_nombre'];
        }
    }
    return null; // Si no se encuentra, devuelve null o cualquier valor por defecto
}
   
                                    
                                    ?>
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
                            <th class="text-light">ticket_id</th>
                            <th class="text-light">ticket_dia</th>
                            <th class="text-light">ticket_estado</th>
                            <th class="text-light">ticket_subcategoria</th>
                        </tr>
                    </thead>
                    <tbody id="log">
                        <?php for($i=0;$i<sizeof($ticketserp2);$i++){
                                        ?>
                        <tr class="text-center">
                            <td><a target='_blank' href='https://malbec.wiber.com.ar/tickets/ver/{{ $ticketserp2[$i]['ticket_id'] }}'>{{ $ticketserp2[$i]['ticket_id'] }}</a> </td>
                            <td>{{ $ticketserp2[$i]['ticket_dia'] }} {{ $ticketserp2[$i]['ticket_hora'] }}
                            </td>
                            <td> <?php echo $est = estados($estados2, $ticketserp2[$i]['ticket_estado']); ?> </td>

                            <td> <?php echo $nomsub = buscarNombreSubcategoria($subserp2, $ticketserp2[$i]['ticket_subcategoria']); ?> </td>


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
  