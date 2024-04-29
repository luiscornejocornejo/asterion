@include('facu.header2')


<?php
function coloriconos($iconos, $tipo)
{
    $coloricono = "";
    foreach ($iconos as $valu) {
        if ($valu->id == $tipo) {
            $coloricono = $valu->descripcion;
        }
    }
    return $coloricono;
}

?>
<script>
    function cerrar(result, dd, ee, ff, cliente) {
        document.getElementById("idticketestado20").value = dd;
        document.getElementById("conversation_id20").value = ee;
        document.getElementById("client_number").value = cliente;
    }

    function prioridad(result, dd, ee, ff, cliente) {
        document.getElementById("idticketestadoprioridad").value = dd;
        document.getElementById("conversation_id20").value = ee;
        document.getElementById("client_number").value = cliente;
    }
    
</script>
<div class="wrapper menuitem-active">
    @include('facu.menu')
    <div class="content-page" style="padding: 0!important;">
        <div class="content">
            <div class="container pt-2 ">
                <div class="d-flex justify-content-between pb-2">
                    <div>
                    </div>
                    <div>
                        <?php
                        $tipodemenu = session('tipodemenu');
                        if (($tipodemenu == "1") or ($tipodemenu == "2") or ($tipodemenu == "4")) {
                        ?>
                            <button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm-assign">
                                <i class="mdi mdi-account-arrow-right" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="mb-1" data-bs-title="Asignar ticket"></i>
                            </button>
                        <?php } else { ?>
                            <button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#standard-modal-reclamo">
                                <i class="mdi mdi-account-arrow-left" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="mb-1" data-bs-title="Reclamar ticket."></i>
                            </button>
                        <?php } ?>
                        <button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm-departament">
                            <i class="mdi mdi-account-group" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="mb-1" data-bs-title="Asignar departamento."></i>
                        </button>
                        <button onclick="topic(`<?php echo $subdomain_tmp; ?>`,`<?php echo $resultados[0]->ticketid; ?>`,`<?php echo $resultados[0]->conversation_id; ?>`,`<?php echo $resultados[0]->iddepto; ?>`)" class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-smt">
                            <i class="mdi mdi-notebook" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="mb-1" data-bs-title="Cambiar topic."></i>
                        </button>
                        <button onclick="estado2(`<?php echo $subdomain_tmp; ?>`,`<?php echo $resultados[0]->ticketid; ?>`,`<?php echo $resultados[0]->conversation_id; ?>`,`<?php echo $resultados[0]->iddepto; ?>`)" class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm">
                            <i class="mdi mdi-flag" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="mb-1" data-bs-title="Cambiar estado."></i>
                        </button>
                        <button onclick="cerrar(`<?php echo $subdomain_tmp; ?>`,`<?php echo $resultados[0]->ticketid; ?>`,`<?php echo $resultados[0]->conversation_id; ?>`,`<?php echo $resultados[0]->iddepto; ?>`,`<?php echo $resultados[0]->cliente; ?>`)" class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-smcerrar">
                            <i class="mdi mdi-check-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="mb-1" data-bs-title="Cerrar Ticket."></i>
                        </button>


                    </div>
                </div>

        <div class="row">
                <div class="col-sm-12 col-lg-8 col-xxl-9">
                    <div class="">
                        <div class="card widget-flat">
                            <div class="card-body">
                              <div class="d-flex justify-content-between">
                                <div>  
                                  <h4 class="fw-normal text-dark" title="Number of Customers">Información del Ticket <strong>#ticket_number</strong></h4>
                                </div>
                                <div>
                                    <i class="mdi mdi-note-text widget-icon bg-secondary-lighten text-secondary"></i>          
                                </div>
                              </div>
                              <hr style="margin-top: 10px;"/>
                              <div class="d-flex justify-content-between">
                                <div>
                                    <div class="mb-1">
                                        <i class="mdi mdi-list-status"></i> <strong>Estado: </strong>ticket_status
                                    </div>
                                    <div class="mb-1">
                                        <i class="mdi mdi-office-building"></i> <strong>Departamento: </strong>departament
                                    </div>
                                    <div class="mb-1">
                                        <i class="mdi mdi-account-voice"></i> <strong>Asignado a: </strong>operator_name
                                    </div>

                                </div>
                                
                                <div>
                                    <div class="mb-1">
                                        <i class="mdi mdi-calendar"></i> <strong>Creado: </strong>date
                                    </div>
                                    <div class="mb-1">
                                        <i class="mdi sienna_source_class"></i> <strong>Fuente: </strong>Channel
                                    </div>
                                    <div class="mb-1">
                                        <i class="mdi mdi-information"></i> <strong>Tema de ayuda: </strong>topic_name
                                    </div>
                                </div>
                              </div>
                              

                              </div>
                              
                        </div>
                    </div>
                    <div class="card ">
                        <div class="card-body">
                            <h5 class="font-18"><?php echo $resultados[0]->emailnom;?></h5>
                            <hr>
                            <div class="d-flex mb-3 mt-1">
                                <div class="w-100 overflow-hidden">
                                    
                                    <small class="text-muted">From: <?php echo $resultados[0]->emailcliente;?></small>
                                </div>
                            </div>
                            <?php 
                           
// Eliminar el componente src de la URL que contiene 'cid:'
                                   

                                   
                           
                            $b = html_entity_decode($resultados[0]->eltexto);
                            $b = str_replace('src="cid:', '', $b);
                            $b = preg_replace('/<img\b(?![^>]*\bsrc=)[^>]*>/i', '', $b);

                           

?>  
                            {!! $b !!}
                            <hr>

                            <h5 class="mb-3">Adjuntos</h5>

                            <div class="row">
                                <?php foreach($segui as $adj){
                                    if($adj->tipo==9){?>
                                <div class="col-xl-4">
                                    <div class="card mb-1 shadow-none border">
                                        <div class="p-2">
                                            <div class="row align-items-center">
                                            
                                                <div class="col-auto">
                                                    <!-- Button -->
                                               <a target=_blank href="<?php echo $adj->descripcion;?>"><img  src='<?php echo $adj->descripcion;?>' width="40px;"></a>
                                                    
                                                   
                                                       
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                                <?php }}?>
                             
                            </div>
                            <!-- end row-->
                            <form action="" method="post">
                                <div class="mt-5">
                                    <div id="snow-editor" style="height: 300px;">
                                    </div>
                                    <button type="submit" class="btn me-2 mt-2 rounded-pill" style="background-color: #FFD193;">Responder</button> 
                                </div>
                            </form>

                        </div>
                        <!-- end .mt-4 -->

                    </div> 
                   
                </div>
                <div class="col-sm-12 col-lg-4 col-xxl-3 card widget-flat">
                    <strong class="mt-2">Seguimiento</strong>
                    <hr>
                    <div class="card-body" style="padding-top: 0;">
                        <!-- end sub tasks/checklists -->
                        <div>
                            <div class="mb-2">
                                <label class="form-label">Nota interna</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" aria-label="Recipient's username">
                                    <button class="btn btn-primary" type="button"><i class="mdi mdi-send"></i></button>
                                </div>
                            </div>
                            <div>
                                <label class="form-label">Subir archivo</label>
                                <input class="form-control" type="file" id="inputGroupFile04">
                            </div>
                        </div>
                        
                            <div class="mt-2">
                                <div class="card-header d-flex justify-content-between align-items-center mt-2">
                                    <h4 class="header-title">Actividad reciente</h4>
                                </div>

                                <div class="card-body py-0 mb-3 mt-" style="height: 600px;" data-simplebar="init">
                                    <div class="simplebar-wrapper" ><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px 24px;">
                                    <div class="timeline-alt py-0">
                                        <div class="timeline-item">
                                            <img 
                                                src="https://www.cyberclick.es/hs-fs/hubfs/04.%20BLOG/Dashboard%20de%20DataBox.png?width=796&height=579&name=Dashboard%20de%20DataBox.png"
                                                class="timeline-icon"
                                            >
                                            <span onclick="ng(`<?php //echo $ht; ?>`)" class="link-primary" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-img">
                                            Ver archivo
                                            </span>
                                            <div class="timeline-item-info">
                                                <span class="text-info fw-bold mb-1 d-block">Subida de archivo desde Bot</span>
                                                <small>agent_sienna ha subido un archivo de tipo <span class="link-primary" role="button" data-bs-toggle="modal" data-bs-target="#image-modal">imágen</span></small>
                                                <p class="mb-0 pb-2">
                                                    <small class="text-muted">date_event</small>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <i class="mdi mdi-file-document bg-secondary-lighten text-secondary timeline-icon"></i>
                                            <div class="timeline-item-info">
                                                <span class="text-info fw-bold mb-1 d-block">Subida de archivo</span>
                                                <small>agent_sienna ha subido un <a href="route" target="_blank">archivo</a></small>
                                                <p class="mb-0 pb-2">
                                                    <small class="text-muted">date_event</small>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="timeline-item">
                                            <i class="mdi mdi-file-image-plus-outline bg-secondary-lighten text-secondary timeline-icon"></i>
                                            <div class="timeline-item-info">
                                                <span class="text-info fw-bold mb-1 d-block">Subida de imágen</span>
                                                <small>agent_sienna ha subido un archivo de tipo <span class="link-primary" role="button" data-bs-toggle="modal" data-bs-target="#image-modal">imágen</span></small>
                                                <p class="mb-0 pb-2">
                                                    <small class="text-muted">date_event</small>
                                                </p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!-- end timeline -->
                                </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 353px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 281px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div> <!-- end slimscroll -->
                            </div>
            </div> <!-- end row-->
                </div>
            </div>
            <!-- container -->
        </div>
        <!-- content -->




        <!-- Departament modal Status-->

        <!-- End modal Status -->

        <!-- Departament modal Status-->

        <!-- End modal Status -->



        <!-- Modal Reclamo Ticket -->

    </div>
    <!-- /.modal -->

    <!-- End Reclamo Ticket -->

    <!-- /.modal-topic -->

    @include('sienna.tu.asignar')
    @include('sienna.tu.reclamar')
    @include('sienna.tu.topic')
    @include('sienna.tu.depto')
    @include('sienna.ticketsmodals.cerrar')
    @include('sienna.ticketsmodals.estados')
    @include('sienna.tu.imagen')
    @include('sienna.tu.prioridad')
    <script>
        function topic(result, dd, ee, ff) {

            document.getElementById("idticketestado3").value = dd;
            url = "https://" + result + ".suricata.cloud/api/topicxdepto?depto=" + ff;
            axios.get(url)
                .then(function(response) {
                    // función que se ejecutará al recibir una respuesta
                    console.log(response.data);
                    dato = "";
                    for (i = 0; i < response.data.length; i++) {
                        console.log(response.data[i].id);
                        console.log(response.data[i].nombre);
                        dato += ' <div class="mt-3">' +
                            '<div class="form-check mb-2">' +
                            ' <input type="radio" id="customRadio' + response.data[i].id + '" name="estado" value="' + response.data[i].id + '"  class="form-check-input">' +
                            '<label class="form-check-label" for="customRadio' + response.data[i].id + '">' + response.data[i].nombre + '</label>' +
                            '</div>' +
                            ' </div>';
                    }
                    document.getElementById("estunico2").innerHTML = dato;
                })
                .catch(function(error) {
                    // función para capturar el error
                    console.log(error);
                })
                .then(function() {
                    // función que siempre se ejecuta
                });


        }

        function ng(ruta) {
            document.getElementById('vista2').innerHTML = "";
            // document.getElementById('vista').src = dd;
            // g='<iframe allow="camera;microphone"  src="'+dd+'" width="100%" height="800px" class="border rounded-3" style="height:500px !important"></iframe>';
            g = '<embed src="' + ruta + '" type="" width="180" height="auto" quality="high" wmode="transparent">'
            document.getElementById('vista2').innerHTML = g;
        }
    </script>
    <!-- /.modal-topic -->



    <!-- End Solicita numero de cliente -->



    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

</div>








</div>
</div>
<?php
// dd($resultados);
?>
<br><br><br>

<!-- Modal open conversation -->
<div id="open-conversation" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="open-conversation" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title text-light" id="standard-modalLabel">Reabrir conversación</h4>
                    <button type="button" class="btn-close btn-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    ¿Confirma la reapertura de conversación?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">No</button>
                    <button onclick="reabrir('<?php echo $resultados[0]->cel;?>','<?php //echo $urlreabrir;?>')"  type="button" class="btn btn-success">Si, enviar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

</div>

@include('facu.footer')