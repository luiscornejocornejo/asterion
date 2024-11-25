

<?php 
$subserp= file_get_contents("https://wiber.suricata-ispkeeper.com.ar/api/listadodeticketsubcategorias?token=wiber");
$subserp2=json_decode($subserp, true);

$usuariosserp= file_get_contents("https://wiber.suricata-ispkeeper.com.ar/api/usuarios?token=wiber");
$usuariosserp2=json_decode($usuariosserp, true);
$ticketserp= file_get_contents("https://wiber.suricata-ispkeeper.com.ar/api/tickets?token=wiber&cliente_id=".$resultadoscliente[0]->cliente);
$ticketserp2=json_decode($ticketserp, true);
?>
<div class="card widget-flat" id="infoUser">
    <div class="card-body">
    <div class="row">
    <div class="col-sm-3 mb-2 mb-sm-0">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active show" id="v-pills-home-tab" data-bs-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home"
                aria-selected="true">
                <i class="mdi mdi-home-variant d-md-none d-block"></i>
                <span class="d-none d-md-block">Tickets</span>
            </a>
            <a class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile"
                aria-selected="false">
                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                <span class="d-none d-md-block">Datos</span>
            </a>
            <a class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings"
                aria-selected="false">
                <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                <span class="d-none d-md-block">extra</span>
            </a>
        </div>
    </div> <!-- end col-->

    <div class="col-sm-9">
        <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade active show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">


                <div class="row">
                    <form method="post" action="api/crearispkipper">
                        @csrf
                        <div class="row">
                        <div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-6">
                                        <label for="agent" class="form-label">Usuario</label>
                                        <select name="usuarios" id="agent"  class="form-select">

                                        <?php for($i=0;$i<sizeof($usuariosserp2);$i++){
                                            ?>
                                            <option value="{{ $usuariosserp2[$i]["usuario_id"] }}">
                                                    {{ $usuariosserp2[$i]["usuario_nombre"] }} {{ $usuariosserp2[$i]["usuario_apellido"] }}
                                                </option>
                                        <?php }
                                        
                                        ?>
                                        </select>

                                           
                                               
                          </div>
                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-sm-12 mt-2">
                                <label class="form-label" for="description">Subcategoria</label>
                                <select name="subcategorias" id="agent"  class="form-select">

                                        <?php
                                        function buscarNombreSubcategoria($subserp2, $idBuscado) {
                                            for($i=0;$i<sizeof($subserp2);$i++){
                                                if ($subserp2[$i]["ticket_subcategoria_id"]== $idBuscado) {
                                                    return $subserp2[$i]["ticket_subcategoria_nombre"];
                                                }
                                            }
                                            return null; // Si no se encuentra, devuelve null o cualquier valor por defecto
                                        }
                                        for($i=0;$i<sizeof($subserp2);$i++){
                                            ?>
                                            <option value="<?php echo $subserp2[$i]["ticket_subcategoria_id"];?>">
                                                <?php echo $subserp2[$i]["ticket_subcategoria_nombre"];?>
                                                   
                                                </option>
                                        <?php }
                                        
                                        ?>
                                        </select>
                            </div>
                            <div class="mb-3">
                                <label for="example-textarea" class="form-label">Descripcion</label>
                                <textarea name="detalle" class="form-control" id="example-textarea" rows="4"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="example-textarea" class="form-label">Cliente</label>
                                <input required name="cliente" type="text" class="form-control" id="lastNameUser"
                            value="<?php echo $resultadoscliente[0]->cliente; ?>">
                            <input  name="prioridad" type="hidden" class="form-control" id="lastNameUser"
                            value="3">
                            </div>
                            

                        </div>
                        
                        <button type="submit" class="btn btn-success mt-3 mb-2">Crear Ticket</button>
                        <hr class="mx-1" />
                    </form>
                </div>
        <div class="row">
           
            <table id="casadepapel" class="table table-striped dt-responsive nowrap w-100 text-light">
                <thead>
                    <tr class="text-center bg-dark">
                        <th class="text-light">ticket_id</th>
                        <th class="text-light">ticket_dia</th>
                        <th class="text-light">ticket_hora</th>
                        <th class="text-light">ticket_subcategoria</th>
                    </tr>
                </thead>
                <tbody id="log">
                <?php for($i=0;$i<sizeof($ticketserp2);$i++){
                                            ?>
                 <tr class="text-center">
                 <td>{{ $ticketserp2[$i]["ticket_id"] }} </td>
                 <td>{{ $ticketserp2[$i]["ticket_dia"] }} </td>
                 <td>{{ $ticketserp2[$i]["ticket_hora"] }} </td>
                 <td><?php  echo $nomsub=buscarNombreSubcategoria($subserp2, $subserp2[$i]["ticket_subcategoria_id"]);?> </td>
                </tr>                             
                                        <?php }?>

                </tbody>
            </table>
        </div>

            </div>
            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <p class="mb-0">...</p>
            </div>
            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
            <div data-tf-live="01JDFRQDH03PQAH7HE59FRXFB0"></div><script src="//embed.typeform.com/next/embed.js"></script>
            </div>
        </div> <!-- end tab-content-->
    </div> <!-- end col-->
</div>
<!-- end row-->

    </div>


</div>