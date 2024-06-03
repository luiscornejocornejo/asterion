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
function tituloiconos($iconos, $tipo)
{
    $tituloiconos = "";
    foreach ($iconos as $valu) {
        if ($valu->id == $tipo) {
            $tituloiconos = $valu->titulo;
        }
    }
    return $tituloiconos;
}
?>
<script>



   function cerrar(result,dd, ee, ff,cliente,source){
  document.getElementById("idticketestado20").value = dd;
  document.getElementById("conversation_id20").value = ee;
  document.getElementById("client_number").value = cliente;
  document.getElementById("source").value = source;

  if(source=='7'){
   // alert(source);
        document.getElementById("client_number").removeAttribute("required");
        document.getElementById("client_number").style.display = "none";
        document.getElementById("texto").style.display = "none";
  }

  ff
  url = "https://"+result+".suricata.cloud/api/motic?depto=" + ff + "";
    console.log(url);

    axios.get(url)
    .then(function (response) {

      res="<select name='motivoc' class='form-control'>";
      console.log(response.data);
      for (i = 0; i < response.data.length; i++) {
            console.log(response.data[i].nombre);
            res+="<option value='"+response.data[i].id+"'>"+response.data[i].nombre+"</option>";

      }
      res+="</select>";
      document.getElementById("motivoc").innerHTML = null;

        document.getElementById("motivoc").innerHTML = res;

    })
    .catch(function (error) {
        // función para capturar el error
        console.log(error);
    })
    .then(function () {
        // función que siempre se ejecuta
    });
}

    function prioridad(result, dd, ee, ff, cliente) {
        document.getElementById("idticketestadoprioridad").value = dd;
        document.getElementById("conversation_id20").value = ee;
        document.getElementById("client_number").value = cliente;
    }
    var originalTitle = document.title;

    identificadorIntervaloDeTiempo = setInterval(checkmensaje, 180000);
    function checkmensaje(){
        var URLactual = window.location.href;
            var porciones = URLactual.split('.');
            let result = porciones[0].replace("https://", "");
        idticketbuscar=<?php echo $resultados[0]->ticketid; ;?>;
        console.log(idticketbuscar);
        url = "https://"+result+".suricata.cloud/api/estadoconv?tick=" + idticketbuscar + "";
        console.log(url);
        axios.get(url)
            .then(function (response) {
                console.log(response.data);
                if(response.data==1){
                    newPageTitle="pendiente";
 
                    var blinkTitle = "¡Mira aquí!";
                    var isBlinking = true;
                    destellarTitulo();
                    //document.title = newPageTitle;
 
                }
               
               
            })
            .catch(function (error) {
                // función para capturar el error
                console.log(error);
            })
            .then(function () {
                // función que siempre se ejecuta
            });


    }
   
    function destellarTitulo() {
        var titulo = document.title;
        var favi = document.getElementById("favicon");
        var destellando = false;
        var destellando2 = false;
        
        var destelloIntervalo = setInterval(function() {
            document.title = destellando ? titulo : "¡Contacto del cliente!";
            
           // favicon.href = "https://cdn.sstatic.net/Sites/es/Img/favicon.ico?v=9c017e88b153";
            //favi.href = destellando2 ? favi : "";
            favi.href = destellando2 ? "assetsfacu/images/favialarma.png" : "assetsfacu/images/favicom_suricata.png";

            destellando = !destellando;
            destellando2 = !destellando2;
        }, 1000); // Cambiar la duración del destello aquí (en milisegundos)
      
        // Detener la animación después de un tiempo
        setTimeout(function() {
            clearInterval(destelloIntervalo);
            document.title = titulo;
           
             
        }, 50000); // Cambiar la duración total del destello aquí (en milisegundos)
    }

    function extraordinario(valor){
        var URLactual = window.location.href;
            var porciones = URLactual.split('.');
            let result = porciones[0].replace("https://", "");
        url = "https://"+result+".suricata.cloud/api/getdata2?cliente=" + valor + "";
        console.log(url);
        console.log(valor);
        console.log("aca");
        dato='<div class="row">';
        document.getElementById("datosonline").innerHTML = "";

        axios.get(url)
            .then(function (response) {
                for (i = 0; i < response.data.length; i++) {
                    console.log(response.data[i].nombre);
                    console.log(response.data[i].icono);
                    console.log(response.data[i].valor);
                    dato += ' <div class="m-3 p-2 col-md-3" style="float:left;">' +response.data[i].icono+response.data[i].nombre+" :<span class='badge badge-secondary-lighten line-h'> "+response.data[i].valor+"</span></div>";

                }
                dato += '</div>';

                document.getElementById("datosonline").innerHTML = dato;

                
               
               
            })
            .catch(function (error) {
                // función para capturar el error
                console.log(error);
            })
            .then(function () {
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
                        <button onclick="cerrar(`<?php echo $subdomain_tmp; ?>`,`<?php echo $resultados[0]->ticketid; ?>`,`<?php echo $resultados[0]->conversation_id; ?>`,`<?php echo $resultados[0]->iddepto; ?>`,`<?php echo $resultados[0]->cliente; ?>`,`<?php echo $resultados[0]->siennasource; ?>`)" class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-smcerrar">
                            <i class="mdi mdi-check-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="mb-1" data-bs-title="Cerrar Ticket."></i>
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
                     if($resultados[0]->siennasource==7){?>

                       
                        @include('sienna.tu.informacionmail')


                    <?php
                    }else{?>
                        @include('sienna.tu.informacionwhatapp')

                           
                    <?php }?>
                    <div class="mt-2">
                         @include('sienna.tu.informacionnotainterna')

                    </div>                    


                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4 class="fw-normal text-dark" title="Number of Customers">Información de usuario</h4>
                                    </div>
                                    <div>
                                        <i class="mdi mdi-card-account-details widget-icon bg-secondary-lighten text-secondary"></i>
                                    </div>
                                </div>
                                <hr style="margin-top: 10px;" />
                                <div class="row">
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-sm-12">
                                        <?php if(isset($resultados[0]->cliente)){?>
                                            <div class="d-flex mt-2">
                                                <i class="mdi mdi-card-account-details"></i>&nbsp;Numero cliente:&nbsp;
                                                <span class="badge badge-secondary-lighten line-h">
                                                    <?php echo $resultados[0]->cliente; ?>
                                                </span>
                                            </div>
                                        <?php
                                            }if(isset($resultados[0]->nya)){?>
                                            <div class="d-flex  mt-2">
                                                <i class="mdi mdi-account"></i>&nbsp;Nombre:&nbsp;
                                                <span class="badge badge-secondary-lighten hover-overlay line-h">
                                                    <?php echo $resultados[0]->nya; ?>
                                                </span>
                                            </div>
                                        <?php
                                            }if(isset($resultados[0]->address)){?>
                                            <div class="d-flex mt-2">
                                                <i class="mdi mdi-home"></i>&nbsp;Domicilio:&nbsp;
                                                <span class="badge badge-secondary-lighten line-h">
                                                    <?php echo $resultados[0]->address; ?>
                                                </span>
                                            </div>
                                        <?php
                                            }if(isset($resultados[0]->cel)){?>
                                            <div class="d-flex mt-2">
                                                <i class="mdi mdi-whatsapp text"></i>&nbsp;Teléfono:&nbsp;
                                                <span class="badge badge-secondary-lighten line-h">
                                                    <?php echo $resultados[0]->cel; ?>
                                                </span>
                                            </div>
                                        <?php
                                            }if(isset($resultados[0]->email)){?>
                                            <div class="d-flex mt-2">
                                                <i class="mdi mdi-email"></i>&nbsp;Email:&nbsp;
                                                <span class="badge badge-secondary-lighten line-h">
                                                    <?php echo $resultados[0]->email; ?>
                                                </span>
                                            </div>
                                            <?php }?>

                                    </div>
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-sm-12">
                                        <?php
                                            if(isset($resultados[0]->a_status)){?>
                                            <div class="d-flex mt-2">
                                                <i class="mdi mdi-account-cash"></i>&nbsp;Estado de cuenta:&nbsp;
                                                <span class="badge badge-success-lighten line-h">
                                                    <?php echo $resultados[0]->a_status; ?>
                                                </span>

                                            </div>
                                        <?php
                                            }if(isset($resultados[0]->s_status)){?>
                                            <div class="d-flex mt-2">
                                                <i class="mdi mdi-antenna"></i>&nbsp;Estado de servicio:&nbsp;
                                                <span class="badge badge-success-lighten line-h">
                                                    <?php echo $resultados[0]->s_status; ?>
                                                </span>

                                            </div>
                                        <?php
                                            }if(isset($resultados[0]->nodo)){?>
                                            <div class="d-flex mt-2">
                                                <i class="mdi mdi-switch"></i>&nbsp;Nodo:&nbsp;
                                                <span class="badge badge-secondary-lighten line-h">
                                                    <?php echo $resultados[0]->nodo; ?>
                                                </span>
                                            </div>
                                        <?php
                                            }if(isset($resultados[0]->ip)){?>
                                            <div class="d-flex mt-2">
                                                <i class="mdi mdi-map-marker"></i>&nbsp;IP:&nbsp;
                                                <span class="badge badge-secondary-lighten line-h">
                                                    <?php echo $resultados[0]->ip; ?>
                                                </span>
                                            </div>
                                        <?php
                                            }if(isset($resultados[0]->deuda)){?>
                                            <div class="d-flex mt-2">
                                                <i class="mdi mdi-currency-usd"></i>&nbsp;Deuda:&nbsp;
                                                <span class="badge badge-secondary-lighten line-h">
                                                    <?php echo $resultados[0]->deuda; ?>
                                                </span>
                                            </div>
                                            <?php }?>
                                    </div>
                                </div>                    
                            </div>


                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4 class="fw-normal text-dark" title="Number of Customers">Historial de tickets</h4>
                                    </div>
                                    <div>
                                        <i class="mdi mdi-card-account-details widget-icon bg-secondary-lighten text-secondary"></i>
                                    </div>
                                </div>
                                <hr style="margin-top: 10px;" />
                                <div class="row">
                                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12">
                                        
                                        
                                        <table id="example"  class="table table-striped dt-responsive nowrap w-100 text-light">
                                            <thead>
                                                    <tr class="text-center bg-dark" >                             
                                                        <th class="text-light">Ticket</th>
                                                        <th class="text-light">Departamento</th>
                                                        <th class="text-light">Tema</th>
                                                        <th class="text-light">Estado</th>
                                                        <th class="text-light">Inicio</th>
                                                    </tr>
                                            </thead>
                                            <tbody id="tb">
                                                    <?php foreach($resultadoshistoricos as $valh){?>
                                                        <tr class="text-center">
                                                        <td><a href='/ticketunico?tick=<?php echo $valh->id;?>' target="_blank"><?php echo $valh->id;?></a></td>
                                                        <td><?php echo $valh->depto;?></td>
                                                        <td><?php echo $valh->tema;?></td>
                                                        <td><?php echo $valh->estado;?></td>
                                                        <td><?php echo $valh->inicio;?></td>
                                                    </tr>
                                                        <?php  }?>
                                            </tbody>
                                            </table>
                                              
                                    </div>
                                    
                                </div>                    
                            </div>


                        </div>
                    </div>
               
                    <?php if($urlinte2<>"luis"){?>
                        <div class="mt-2">
                        <div class="card widget-flat d-none">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4 class="fw-normal text-dark" title="Number of Customers">Datos Online</h4>
                                    </div>
                                    <div>
                                    </div>
                                </div>
                                <hr style="margin-top: 10px;" />
                                <div class="row">
                                <button onclick="extraordinario('<?php echo $resultados[0]->cliente;?>')" type="button" class="btn btn-success">traer datos</button>

                                    <div id="datosonline" class="">

                                    
                                       
                                              
                                    </div>
                                    
                                </div>                    
                            </div>


                        </div>
                    </div>
                    <?php }?>
                </div>
                <div class="col-sm-12 col-lg-4 col-xxl-3 card widget-flat">
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
                                            <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden scroll;">
                                                <div class="simplebar-content" style="padding: 0px 24px;">

                                                    <?php foreach ($segui as $val) {

                                                        if ($val->logo != null) {

                                                            if ($val->tipo == 5) {
                                                                $ht = 'https://sienamedia.sfo3.digitaloceanspaces.com/' . $val->logo;
                                                            } else {
                                                                $ht = 'https://sienamedia.sfo3.digitaloceanspaces.com/' . $subdomain_tmp . '/xen/enviados/' . $val->logo;
                                                            }

                                                            
                                                            $uri = '<a target=_blank href="' . $ht . '"><img  src=' . $ht . ' width="40px;"></a>';
                                                        } else {
                                                            $uri = '';
                                                        }
                                                        if($val->tipo == 9){
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
                                                                <span class="text-info fw-bold mb-1 d-block"><?php 
                                                                echo $titulo = tituloiconos($iconos, $tipo);
                                                                
                                                                ?></span>
                                                                <small><?php
                                                                if($val->tipo <> 9){ echo $val->descripcion;} ?></small>
                                                                <p class="mb-0 pb-2">
                                                                <small class="text-muted"><?php echo $val->autor; ?></small>
                                                                <br>
                                                                    <small class="text-muted"><?php echo $val->created_at; ?></small>
                                                                </p>
                                                                <span>
                                                                    <?php if ($uri != "") { ?>
                                                                        <span onclick="ng(`<?php echo $ht; ?>`)" class="link-primary" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-img">
                                                                            Ver archivo    
                                                                        </span>
                                                                    <?php } ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                </div>

                                            <?php } ?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="simplebar-placeholder" style="width: auto; height: 353px;"></div>
                                </div>
                                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="width: 0px; display: none;">
                                    </div>
                                </div>
                                <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                    <div class="simplebar-scrollbar" style="height: 281px; transform: translate3d(0px, 0px, 0px); display: block;">
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
                    <form method='post'action='/reabrirconversacion'>
                    @csrf

                    <input type="hidden" value="<?php echo $urlreabrir;?>" name="url"/>
                    <input type="hidden" value="<?php echo $resultados[0]->cel;?>" name="tel"/>
                    <input type="hidden" value="<?php echo session('nombreusuario');?>" name="asignado"/>
                    <input type="hidden" value="<?php echo $resultados[0]->ticketid;?>" name="ticket"/>

                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">NO</button>
                        <button type="submit" class="btn btn-success">Si</button>
                </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

</div>

@include('facu.footer')