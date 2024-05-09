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
   function cerrar(result,dd, ee, ff,cliente){
  document.getElementById("idticketestado20").value = dd;
  document.getElementById("conversation_id20").value = ee;
  document.getElementById("client_number").value = cliente;

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
                    <div>
                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4 class="fw-normal text-dark" title="Number of Customers">Información del Ticket #<?php echo $resultados[0]->ticketid; ?></h4>
                                    </div>
                                    <div>
                                        <i class="mdi mdi-note-text widget-icon bg-secondary-lighten text-secondary"></i>
                                    </div>
                                </div>
                                <hr style="margin-top: 10px;" />
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <div class="mb-1">
                                            <i class="mdi mdi-list-status"></i> <strong>Estado: </strong><?php echo $resultados[0]->estadoname; ?>
                                        </div>
                                        <div class="mb-1">
                                            <i class="mdi mdi-office-building"></i> <strong>Departamento: </strong><?php echo $resultados[0]->depto; ?>
                                        </div>
                                        <div class="mb-1">
                                            <i class="mdi mdi-account-voice"></i> <strong>Asignado a: </strong><?php echo $resultados[0]->nombreagente; ?>
                                        </div>

                                    </div>

                                    <div>
                                        <div class="mb-1">
                                            <i class="mdi mdi-calendar"></i> <strong>Creado: </strong><?php echo $resultados[0]->creacion; ?>
                                        </div>
                                        <div>
                                        <i class="mdi mdi-priority-high"></i> <strong>Prioridad: </strong>
                                        <span onclick="prioridad(`<?php echo $subdomain_tmp; ?>`,`<?php echo $resultados[0]->ticketid; ?>`,`<?php echo $resultados[0]->conversation_id; ?>`,`<?php echo $resultados[0]->iddepto; ?>`,`<?php echo $resultados[0]->cliente; ?>`)" role="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-smprioridad">
                                        <span class="badge <?php echo $resultados[0]->colorprioridad; ?> line-h" style="font-size: 13px;">
                                                <?php echo $resultados[0]->nombreprioridad; ?>
                                            </span>
                                     </span>
                         
                                         
                                        </div>
                                        <div class="mb-1">
                                            <i class="mdi mdi-information"></i> <strong>Tema de ayuda: </strong><?php echo $resultados[0]->topicname; ?>
                                        </div>
                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>
                    <?php
                    $urlreabrir="";
                     if($resultados[0]->siennasource==7){?>

                        <div class="card ">
                                <div class="card-body">
                                    <h5 class="font-18 mb-2">Asunto: <?php echo $resultados[0]->emailnom;?></h5>

                                    <ul class="conversation-list p-0" data-simplebar="init">
                                        <?php foreach($resultadosmails as $valormail) :
                                            $b = html_entity_decode($valormail->cuerpo);
                                            $b = str_replace('src="cid:', '', $b);
                                            $b = preg_replace('/<img\b(?![^>]*\bsrc=)[^>]*>/i', '', $b); 
                                        ?>
                                            <?php if($valormail->autor === 0): ?>
                                                <li class="clearfix">
                                                    <div class="chat-avatar">
                                                        <img src="https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png" class="rounded-circle border" alt="Usuario">
                                                    </div>
                                                    <div class="conversation-text">
                                                        <div class="ctext-wrap bg-white border">
                                                        <small class="text-muted">De: <?php echo $resultados[0]->emailcliente;?></small><br>
                                                        <small class="text-muted">CC: <?php echo $resultados[0]->cc;?></small>
                                                            <p class="mb-1">
                                                                <?php echo $valormail->autor ?>
                                                                {!! $b !!}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php else: ?>
                                                <li class="clearfix odd">
                                                    <div class="chat-avatar">
                                                        <img src="https://static.thenounproject.com/png/535375-200.png" class="rounded-circle border" alt="Operador">
                                                    </div>
                                                    <div class="conversation-text">
                                                        <div class="ctext-wrap">
                                                            <i>Soporte Suricata</i>
                                                            <p>
                                                                {!! $b !!}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>


                                    

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
                                   
                                        <div class="mt-5">
                                        <input id="subject" class="d-none" readonly type="email" value="<?php echo $resultados[0]->emailcliente;?>">
                                        <input id="cc2" class="d-none" readonly type="text" value="<?php echo $resultados[0]->cc;?>">
                                        <input id="mailaeviar" class="d-none" readonly type="text" value="<?php echo $resultados[0]->emailnom;?>">
                                            <div id="snow-editor" style="height: 300px;">
                                            </div>
                                            <button onclick="enviaremail2('<?php echo $resultados[0]->ticketid;?>','<?php echo $subdomain_tmp;?>','<?php echo $resultados[0]->cc;?>','<?php echo $resultados[0]->emailnom;?>')" type="button" class="btn me-2 mt-2 rounded-pill" style="background-color: #FFD193;">Responder</button> 
                                        </div>
                                        <script>
                                            function enviaremail2(ticket,merchant,cc,subject){

                                                let mail=document.getElementById("mailaeviar").value;
                                                 cc=document.getElementById("cc2").value;
                                                 subject=document.getElementById("subject").value;
                                                let texto=document.getElementById("snow-editor").innerHTML;
                                               
                                                url='/api/mandarmail';
                                              

                                                axios.post(url, {
                                                    mail: mail,
                                                    cc: cc,
                                                        texto: texto,
                                                        ticket: ticket,
                                                        merchant: merchant,
                                                        subject: subject,
                                                        
                                                    })
                                                    .then(function (response) {
                                                        console.log("respuesta");
                                                        console.log(response);
                                                        window.location.reload();

                                                    })
                                                    .catch(function (error) {
                                                        console.log(error);
                                                    });
                                            }
                                        </script>
                                    

                                </div>
                        <!-- end .mt-4 -->

                        </div> 


                    <?php
                    }else{?>
                            <iframe src="<?php echo $resultados[0]->conversation_url; ?>" width="100%" class="border rounded-3" style="height: 500px!important;"></iframe>
                            <?php  $vero="";
                                    foreach($emp as $value){
                                        $urlreabrir=$value->reabrir;
                                    }
                                    if(strlen($urlreabrir)<2){
                                        $vero="d-none";
                                    }
                            ?>
                            <div class="<?php  echo $vero;?> d-flex justify-content-between mt-2 mb-2">
                                <div></div>
                                <div class="me-2">
                                
                                
                                    <button class="btn btn-success " data-bs-toggle="modal" data-bs-target="#open-conversation">
                                            <i class="mdi mdi-whatsapp me-1" ></i>Reabrir conversación 
                                    </button>
                                </div>
                                <script>
                                                    function reabrir(tel2,url){
                                                    
                                                        const xhr = new XMLHttpRequest();
                                                    // url="https://publicapi.xenioo.com/broadcasts/jjjTNjqyv3gGCFnsGDT3JA7G8dgHzpjr/4iQCeaeFBmdGvLZSo3dKzM9Q1H36cLlrTCrsFImZTxVR7BJ1dJVdjMCiZzBMXXdp/direct";
                                                        //tel2="541133258450";
                                                        urlprincipal2="https://suricata4.com.ar/api/broadcast?url="+url+"&tel2="+tel2+"&token=EDElDqlQf3RDP5EDK1pHhugV9M6aCXtwAm57SD0G5JYZjw7RxwZbbfdKMhWYdUUM";
                            
                                                        xhr.open("GET", urlprincipal2.trim());
                                                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                                    
                                                        xhr.onload = () => {
                                                        if (xhr.readyState == 4 && xhr.status == 200) {
                                                            console.log(JSON.parse(xhr.responseText));
                                                        } else {
                                                            console.log(`Error: ${xhr.status}`);
                                                        }
                                                        };
                                                        xhr.send();


                                                    }
                                </script>

                            </div>  
                    <?php }?>
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
                </div>
                <div class="col-sm-12 col-lg-4 col-xxl-3 card widget-flat">
                    <strong class="mt-2">Seguimiento</strong>
                    <hr>
                    <div class="card-body" style="padding-top: 0;">
                        <!-- end sub tasks/checklists -->
                        <form action="/api/siennacrearseguimiento2" method="POST" enctype="multipart/form-data">
                            <div class="mt-2 ">
                                <div>
                                    <label class="form-label">Subir archivo</label>
                                    <input name="logo" class="form-control" type="file" id="inputGroupFile04">
                                </div>
                                <div class="mb-2 mt-2">
                                    <label class="form-label">Nota interna</label>
                                    <div class="input-group">
                                        <input value="<?php echo session('nombreusuario'); ?>" type="hidden" name="logeado" id="logeado">

                                        <input value="<?php echo $resultados[0]->ticketid; ?>" type="hidden" name="idticketseguimiento" id="idticketseguimiento">
                                        <input name="comentario" type="text" class="form-control" aria-label="Recipient's username">
                                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-send"></i></button>
                                    </div>
                                </div>

                            </div>
                        </form>
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
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">No</button>
                    <button onclick="reabrir('<?php echo $resultados[0]->cel;?>','<?php echo $urlreabrir;?>')"  type="button" class="btn btn-success">Si, enviar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

</div>

@include('facu.footer')