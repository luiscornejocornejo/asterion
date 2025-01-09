@include('facu.header2')


<?php

$querypagoralia = 'select * from siennapagoralia';
$datospagoralia = DB::select($querypagoralia);
$pagohabilitado = 0;
foreach ($datospagoralia as $valpago) {
    $pagohabilitado = $valpago->habilitado;
}

$queryservicios2 = 'select * from sienna_suricata_servicios ';
$datosservicios2 = DB::select($queryservicios2);
$geoservicio = 0;
$erpservicio = 0;
$pagoservicio = 0;
$mailservicio = 0;
$grabacionesservicio = 0;
$botpresservicio = 0;
$xenservicio = 0;
$iclasservicio = 0;
foreach ($datosservicios2 as $valservicios2) {
    if ($valservicios2->id == 6) {
        $geoservicio = $valservicios2->habilitado;
    }
    if ($valservicios2->id == 2) {
        $erpservicio = $valservicios2->habilitado;
    }
    if ($valservicios2->id == 1) {
        $pagoservicio = $valservicios2->habilitado;
    }
    if ($valservicios2->id == 4) {
        $mailservicio = $valservicios2->habilitado;
    }
    if ($valservicios2->id == 5) {
        $grabacionesservicio = $valservicios2->habilitado;
    }
    if ($valservicios2->id == 8) {
        $xenservicio = $valservicios2->habilitado;
    }
    if ($valservicios2->id == 9) {
        $botpresservicio = $valservicios2->habilitado;
    }
    if ($valservicios2->id == 12) {
        $iclasservicio = $valservicios2->habilitado;
    }
}

$queryempresa = 'select * from empresa';
$datosempresa = DB::select($queryempresa);

$queryatajos = "select * from siennaatajos where siennadepto='" . $resultados[0]->iddepto . "'";
$datosatajos = DB::select($queryatajos);

$queryintegracion = 'select * from siennaintegracion';
$datosintegracion = DB::select($queryintegracion);
$intehabilitado = 0;
foreach ($datosintegracion as $vali) {
    $intehabilitado = $vali->habilitado;
}

function coloriconos($iconos, $tipo)
{
    $coloricono = '';
    foreach ($iconos as $valu) {
        if ($valu->id == $tipo) {
            $coloricono = $valu->descripcion;
        }
    }
    return $coloricono;
}
function tituloiconos($iconos, $tipo)
{
    $tituloiconos = '';
    foreach ($iconos as $valu) {
        if ($valu->id == $tipo) {
            $tituloiconos = $valu->titulo;
        }
    }
    return $tituloiconos;
}
?>
<script>
    document.title = <?php echo $resultados[0]->ticketid; ?>;


    function cerrar(result, dd, ee, ff, cliente, source) {
        document.getElementById("idticketestado20").value = dd;
        document.getElementById("conversation_id20").value = ee;
        document.getElementById("client_number").value = cliente;
        document.getElementById("source").value = source;

        if (source == '7') {
            // alert(source);
            document.getElementById("client_number").removeAttribute("required");
            document.getElementById("client_number").style.display = "none";
            document.getElementById("texto").style.display = "none";
        }

        ff
        url = "https://" + result + ".suricata.cloud/api/motic?depto=" + ff + "";
        console.log(url);

        axios.get(url)
            .then(function(response) {

                res = "<select name='motivoc' class='form-control'>";
                console.log(response.data);
                for (i = 0; i < response.data.length; i++) {
                    console.log(response.data[i].nombre);
                    res += "<option value='" + response.data[i].id + "'>" + response.data[i].nombre + "</option>";

                }
                res += "</select>";
                document.getElementById("motivoc").innerHTML = null;

                document.getElementById("motivoc").innerHTML = res;

            })
            .catch(function(error) {
                // función para capturar el error
                console.log(error);
            })
            .then(function() {
                // función que siempre se ejecuta
            });
    }

    function prioridad(result, dd, ee, ff, cliente) {
        document.getElementById("idticketestadoprioridad").value = dd;
        document.getElementById("conversation_id20").value = ee;
        document.getElementById("client_number").value = cliente;
    }
    var originalTitle = document.title;

    /*
     
    */
    function destellarTitulo() {
        var titulo = document.title;
        var favi = document.getElementById("favicon");
        var destellando = false;
        var destellando2 = false;

        var destelloIntervalo = setInterval(function() {
            document.title = destellando ? titulo : "¡Contacto del cliente!";

            // favicon.href = "https://cdn.sstatic.net/Sites/es/Img/favicon.ico?v=9c017e88b153";
            //favi.href = destellando2 ? favi : "";
            favi.href = destellando2 ? "assetsfacu/images/favialarma.png" :
                "assetsfacu/images/favicom_suricata.png";

            destellando = !destellando;
            destellando2 = !destellando2;
        }, 1000); // Cambiar la duración del destello aquí (en milisegundos)

        // Detener la animación después de un tiempo
        setTimeout(function() {
            clearInterval(destelloIntervalo);
            document.title = titulo;


        }, 50000); // Cambiar la duración total del destello aquí (en milisegundos)
    }

    function extraordinario(valor) {
        var URLactual = window.location.href;
        var porciones = URLactual.split('.');
        let result = porciones[0].replace("https://", "");
        url = "https://" + result + ".suricata.cloud/api/getdata2?cliente=" + valor + "";
        console.log(url);
        console.log(valor);
        console.log("aca");
        dato = '<div class="row">';
        document.getElementById("datosonline").innerHTML = "";

        axios.get(url)
            .then(function(response) {
                for (i = 0; i < response.data.length; i++) {
                    console.log(response.data[i].nombre);
                    console.log(response.data[i].icono);
                    console.log(response.data[i].valor);
                    dato += ' <div class="col-md-6 mb-2">' + response.data[i].icono + response.data[i].nombre +
                        ": <span class='badge badge-secondary-lighten line-h'> " + response.data[i].valor +
                        "</span></div>";
                }
                dato += '</div>';

                document.getElementById("datosonline").innerHTML = dato;




            })
            .catch(function(error) {
                // función para capturar el error
                console.log(error);
            })
            .then(function() {
                // función que siempre se ejecuta
            });


    }
</script>
<div class="wrapper menuitem-active">
    @include('facu.menu')
    <div class="content-page" style="padding: 0!important;">
        <div class="content">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade
                            show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="container pt-2 ">

                <div class="d-flex justify-content-between pb-2">
                    <div>
                    </div>
                    <div>
                        <?php
                        $tipodemenu = session('tipodemenu');
                        if (($tipodemenu == "1") or ($tipodemenu == "2") or ($tipodemenu == "4")) {
                        ?>
                        <button class="btn btn-info" type="button" data-bs-toggle="modal"
                            data-bs-target="#bs-example-modal-sm-assign">
                            <i class="mdi mdi-account-arrow-right" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-custom-class="mb-1" data-bs-title="Asignar ticket"></i>
                        </button>
                        <?php } else { ?>
                        <button class="btn btn-info" type="button" data-bs-toggle="modal"
                            data-bs-target="#standard-modal-reclamo">
                            <i class="mdi mdi-account-arrow-left" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-custom-class="mb-1" data-bs-title="Reclamar ticket."></i>
                        </button>
                        <?php } ?>
                        <button class="btn btn-info" type="button" data-bs-toggle="modal"
                            data-bs-target="#bs-example-modal-sm-departament">
                            <i class="mdi mdi-account-group" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-custom-class="mb-1" data-bs-title="Asignar departamento."></i>
                        </button>
                        <button
                            onclick="topic(`<?php echo $subdomain_tmp; ?>`,`<?php echo $resultados[0]->ticketid; ?>`,`<?php echo $resultados[0]->conversation_id; ?>`,`<?php echo $resultados[0]->iddepto; ?>`)"
                            class="btn btn-info" type="button" data-bs-toggle="modal"
                            data-bs-target="#bs-example-modal-smt">
                            <i class="mdi mdi-notebook" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-custom-class="mb-1" data-bs-title="Cambiar topic."></i>
                        </button>
                        <button
                            onclick="estado2(`<?php echo $subdomain_tmp; ?>`,`<?php echo $resultados[0]->ticketid; ?>`,`<?php echo $resultados[0]->conversation_id; ?>`,`<?php echo $resultados[0]->iddepto; ?>`)"
                            class="btn btn-secondary" type="button" data-bs-toggle="modal"
                            data-bs-target="#bs-example-modal-sm">
                            <i class="mdi mdi-flag" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-custom-class="mb-1" data-bs-title="Cambiar estado."></i>
                        </button>

                        <?php  $ctusers = session('ctusers');

                                if($ctusers=="1"){?>
                        <button
                            onclick="cerrar(`<?php echo $subdomain_tmp; ?>`,`<?php echo $resultados[0]->ticketid; ?>`,`<?php echo $resultados[0]->user_id; ?>`,`<?php echo $resultados[0]->iddepto; ?>`,`<?php echo $resultados[0]->cliente; ?>`,`<?php echo $resultados[0]->siennasource; ?>`)"
                            class="btn btn-success" type="button" data-bs-toggle="modal"
                            data-bs-target="#bs-example-modal-smcerrar">
                            <i class="mdi mdi-check-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-custom-class="mb-1" data-bs-title="Cerrar Ticket."></i>
                        </button>

                        <?php }else{?>
                        <button class="btn btn-success" type="button" data-bs-toggle="modal"
                            data-bs-target="#bs-example-modal-sm-derivar">
                            <i class="mdi mdi-account-arrow-right" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-custom-class="mb-1" data-bs-title="Derivar ticket"></i>
                        </button>

                        <?php }?>
                        <button onclick="printScreen()" class="btn btn-secondary" type="button">
                            <i class="mdi mdi-cloud-print-outline" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-custom-class="mb-1" data-bs-title="Imprimir ticket."></i>
                        </button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-lg-8 col-xxl-9">
                        <div>
                            @include('sienna.tu.informacionticket')
                        </div>


                        <?php
                     $urlreabrir="";
                        $vero="";
                                    foreach($emp as $value){
                                        $urlreabrir=$value->reabrir;
                                    }
                                    if(strlen($urlreabrir)<2){
                                        $vero="d-none";
                                    }
                                     
                      
                     if($resultados[0]->siennasource==10){?>


                        @include('sienna.tu.informacionsuricata')


                        <?php
                    }

                    
                    $excludedProductIds = [1,2,3,4,6];
                    if($xenservicio){
                        if (in_array($resultados[0]->siennasource, $excludedProductIds)) {
                            ?>
                        <div class="mt-2">

                            @include('sienna.tu.bot.whatapp')
                        </div>
                        <?php 
                      }
                  }
                  if($botpresservicio){
                    if (in_array($resultados[0]->siennasource, $excludedProductIds)) {
                        ?>
                        <div class="mt-2">

                            @include('sienna.tu.bot.botpres')
                        </div>
                        <?php 
                  }
              }?>

                        <div class="accordion mt-2" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseOne">
                                        Información de Usuario
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse"
                                    aria-labelledby="panelsStayOpen-headingOne">
                                    <div class="accordion-body">
                                        @include('sienna.tu.informacionusuario')
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo"
                                        aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                        Información Tiempo Real
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                                    aria-labelledby="panelsStayOpen-headingTwo">
                                    <div class="accordion-body">
                                        @include('sienna.tu.informaciononline')
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree"
                                        aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                        Datos Coleccionados del bot
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="panelsStayOpen-headingThree">
                                    <div class="accordion-body">
                                        @include('sienna.tu.collectorbot')
                                    </div>
                                </div>
                            </div>

                            <?php
                      if($mailservicio){
                        if($resultados[0]->siennasource==7){?>
                            <span class="mt-2"></span>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingFour">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour"
                                        aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                                        Adjuntos
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse"
                                    aria-labelledby="panelsStayOpen-headingFour">
                                    <div class="accordion-body">
                                        @include('sienna.tu.mail.mail')
                                        @include('sienna.tu.mail.adjuntos')
                                    </div>
                                </div>
                            </div>
                            <?php 
                        }
                    }?>

                            <?php
                      if($grabacionesservicio){
                        if($resultados[0]->siennasource==5){?>
                            <span class="mt-2"></span>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingRecords">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseRecords"
                                        aria-expanded="false" aria-controls="panelsStayOpen-collapseRecords">
                                        Grabaciones
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseRecords" class="accordion-collapse collapse"
                                    aria-labelledby="panelsStayOpen-headingRecords">
                                    <div class="accordion-body">
                                        @include('sienna.tu.telefonia.grabaciones')
                                    </div>
                                </div>
                            </div>
                            <?php 
                        }
                    }?>


                            <?php if($erpservicio){
                         $nombreintegracion = session('nombreintegracion');
                        if($nombreintegracion=="ispkipper"){?>@include('sienna.tu.erp.kipper')<?php }
                        if($nombreintegracion=="mikrowisp"){?>@include('sienna.tu.erp.mikro')<?php }
                        if($nombreintegracion=="ispcube2"){?>@include('sienna.tu.erp.ispcube')<?php }
                        if($nombreintegracion=="iwisp"){?>@include('sienna.tu.erp.iwisp')<?php }
                
                    }?>
                            <?php
                      if($iclasservicio){?>

                            @include('sienna.tu.gestioncampo.iclass')<?php 
                
                    }?>
                            <?php
                      if($geoservicio){?>

                            @include('sienna.tu.geolocalizacion.geo')<?php 
                
                    }?>
                            <?php
                      if($pagoservicio){?>
                            <div class="mt-2">

                                @include('sienna.tu.pagoralia.pagoralia')
                            </div>
                            <?php 
                
                    }?>
                            <span class="mt-2"></span>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingInternNotes">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseInternNotes"
                                        aria-expanded="false" aria-controls="panelsStayOpen-collapseInternNotes">
                                        Notas Internas
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseInternNotes" class="accordion-collapse collapse"
                                    aria-labelledby="panelsStayOpen-headingInternNotes">
                                    <div class="accordion-body">
                                        @include('sienna.tu.informacionnotainterna')
                                    </div>
                                </div>
                            </div>

                        <div class="mt-2">
                            @include('sienna.tu.informaciontareas')

                        </div>
                        <div class="mt-2">
                            @include('sienna.tu.informacionhistorial')

                        </div>

                        <div aria-live="polite" aria-atomic="true"
                            class="toast fade position-fixed bottom-0 end-0 m-3" role="alert"
                            style="z-index: 1050;" id="liveToast">
                            <div class="toast-header bg-dark">
                                <img src="assetsfacu/images/logo-mini.png" alt="brand-logo" height="12"
                                    class="me-1" />
                                <strong class="me-auto text-light">Copiado!</strong>
                                <small class="text-light">Ahora</small>
                                <button type="button" class="ms-2 btn-close btn-close-white" data-bs-dismiss="toast"
                                    aria-label="Close"></button>
                            </div>
                            <div class="toast-body">

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-4 col-xxl-3 card widget-flat" id="forwardTicket">
                        <strong class="mt-2">Seguimiento</strong>
                        <hr>
                        <div class="card-body" style="padding-top: 0;">
                            <!-- end sub tasks/checklists -->

                            <div class="mt-2">
                                <div class="card-header d-flex justify-content-between align-items-center mt-2">
                                    <h4 class="header-title">Actividad reciente</h4>
                                </div>
                                <div class="card-body py-0 mb-3 mt-3 " style="height: 600px;" data-simplebar="init">
                                    <div class="simplebar-wrapper">
                                        <div class="simplebar-height-auto-observer-wrapper">
                                            <div class="simplebar-height-auto-observer"></div>
                                        </div>
                                        <div class="simplebar-mask">
                                            <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                                <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                                    aria-label="scrollable content"
                                                    style="height: auto; overflow: hidden scroll;">
                                                    <div class="simplebar-content" style="padding: 0px 24px;">

                                                        <?php foreach ($segui as $val) {
                                                        if ($val->tipo <> 5) {
                                                        if ($val->logo != null) {
                                                            $ht = 'https://sienamedia.sfo3.digitaloceanspaces.com/' . $subdomain_tmp . '/xen/enviados/' . $val->logo;
                                                         
                                                            $uri = '<a target=_blank href="' . $ht . '"><img  src=' . $ht . ' width="40px;"></a>';
                                                        } else {
                                                            $uri = '';
                                                        }
                                                        if($val->tipo == 9){
                                                            //$ht = $val->descripcion;
                                                            //$uri = '<a target=_blank href="' . $ht . '"><img  src=' . $ht . ' width="40px;"></a>';
                                                            continue;
                                                        }
                                                        if($val->tipo == 12){
                                                            //$ht = $val->descripcion;
                                                            //$uri = '<a target=_blank href="' . $ht . '"><img  src=' . $ht . ' width="40px;"></a>';
                                                            continue;
                                                        }

                                                    ?>
                                                        <div class="timeline-alt py-0 ">
                                                            <div class=" timeline-item">
                                                                <?php $tipo = $val->tipo;
                                                                echo $color = coloriconos($iconos, $tipo); ?>
                                                                <div class="timeline-item-info">

                                                                    <small><?php
                                                                    if ($val->tipo != 9) {
                                                                        echo $val->descripcion;
                                                                    } ?></small>
                                                                    <p class="mb-0 pb-2">
                                                                        <small
                                                                            class="text-muted"><?php echo $val->autor; ?></small>
                                                                        <br>
                                                                        <small
                                                                            class="text-muted"><?php echo $val->created_at; ?></small>
                                                                    </p>
                                                                    <span>
                                                                        <?php if ($uri != "") { ?>
                                                                        <span onclick="ng(`<?php echo $ht; ?>`)"
                                                                            class="link-primary" type="button"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#bs-example-modal-img">
                                                                            Ver archivo
                                                                        </span>
                                                                        <?php } ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <?php } }?>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="simplebar-placeholder" style="width: auto; height: 353px;">
                                            </div>
                                        </div>
                                        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                            <div class="simplebar-scrollbar" style="width: 0px; display: none;">
                                            </div>
                                        </div>
                                        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                            <div class="simplebar-scrollbar"
                                                style="height: 281px; transform: translate3d(0px, 0px, 0px); display: block;">
                                            </div>
                                        </div>
                                    </div> <!-- end slimscroll -->
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
            @include('sienna.tu.derivar')
            @include('sienna.tu.reclamar')
            @include('sienna.tu.topic')
            @include('sienna.tu.depto')
            @include('sienna.ticketsmodals.cerrar')
            @include('sienna.ticketsmodals.estados')
            @include('sienna.tu.imagen')
            @include('sienna.tu.tags')
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
                                    ' <input type="radio" id="customRadio' + response.data[i].id + '" name="estado" value="' +
                                    response.data[i].id + '"  class="form-check-input">' +
                                    '<label class="form-check-label" for="customRadio' + response.data[i].id + '">' + response
                                    .data[i].nombre + '</label>' +
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

                function tags(idtag) {

                    document.getElementById("idtickettag").value = idtag;

                }

                function printScreen() {
                    let infoTicket = document.getElementById("infoTicket").innerHTML
                    let infoUser = document.getElementById("infoUser").innerHTML
                    let ticketHistory = document.getElementById("ticketHistory").innerHTML
                    let forwardTicket = document.getElementById("forwardTicket").innerHTML

                    let printWindow = window.open('', '', 'height=500, width=500');
                    printWindow.document.open();
                    printWindow.document.write(`
            <html>
            <head>
                <title>Print Div Content</title>
                <style>
                    body { font-family: Arial, sans-serif; }
                    h1 { color: #333; }
                </style>
            </head>
            <body>
                ${infoTicket}
                ${infoUser}
                ${ticketHistory}
                <br>
                ${forwardTicket}
            </body>
            </html>
        `);
                    printWindow.document.close();
                    printWindow.print()
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
<div id="open-conversation" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="open-conversation"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title text-light" id="standard-modalLabel">Reabrir conversación</h4>
                <button type="button" class="btn-close btn-white" data-bs-dismiss="modal"
                    aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                ¿Confirma la reapertura de conversación?
            </div>
            <div class="modal-footer">
                <form method='post'action='/reabrirconversacion'>
                    @csrf

                    <input type="hidden" value="<?php echo $urlreabrir; ?>" name="url" />
                    <input type="hidden" value="<?php echo $resultados[0]->cel; ?>" name="tel" />
                    <input type="hidden" value="<?php echo session('nombreusuario'); ?>" name="asignado" />
                    <input type="hidden" value="<?php echo $resultados[0]->ticketid; ?>" name="ticket" />

                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">NO</button>
                    <button type="submit" class="btn btn-success">Si</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

</div>

@include('facu.footer')
