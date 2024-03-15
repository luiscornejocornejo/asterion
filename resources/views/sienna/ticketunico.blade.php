@include('facu.header2')


<?php
function coloriconos($iconos,$tipo){
    $coloricono="";
    foreach ($iconos as $valu){
        if($valu->id==$tipo){
            $coloricono=$valu->descripcion;
        }
    }
    return $coloricono;
}

?>
<script>
    
function cerrar(result,dd, ee, ff,cliente){
  document.getElementById("idticketestado20").value = dd;
  document.getElementById("conversation_id20").value = ee;
  document.getElementById("client_number").value = cliente;
}
</script>
<div class="wrapper menuitem-active">
@include('facu.menu')
<div class="content-page" style="padding: 0!important;">
          <div class="content">

              <!-- Start Content-->
           
        <div class="container pt-2 ">
            <div class="d-flex justify-content-between pb-2">
               
                <div>
                                <?php
                    $tipodemenu = session('tipodemenu');
                    if(($tipodemenu =="1")or($tipodemenu =="2")or($tipodemenu =="4")){
                    ?>
                    <button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm-assign">
                        <i class="mdi mdi-account-arrow-right" data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-custom-class="mb-1" data-bs-title="Asignar ticket"></i>
                    </button>
                    <?php }else{?>
                    <button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#standard-modal-reclamo">
                        <i class="mdi mdi-account-arrow-left" data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-custom-class="mb-1" data-bs-title="Reclamar ticket."></i>
                    </button>
                    <?php }?>

                   
                
                    
                </div>

            </div>
            <div class="row">
                <div class="col-sm-12 col-lg-8 col-xxl-9">
                    <div class="mt-2">
                        <div class="card widget-flat">
                            <div class="card-body">
                              <div class="d-flex justify-content-between">
                                <div>  
                                  <h4 class="fw-normal text-dark" title="Number of Customers">Información del Ticket #<?php  echo $resultados[0]->ticketid;?></h4>
                                </div>
                                <div>
                                    <i class="mdi mdi-note-text widget-icon bg-secondary-lighten text-secondary"></i>          
                                </div>
                              </div>
                              <hr style="margin-top: 10px;"/>
                              <div class="d-flex justify-content-between">
                                <div>
                                    <div class="mb-1">
                                        <i class="mdi mdi-list-status"></i> <strong>Estado: </strong><?php  echo $resultados[0]->estadoname;?>
                                    </div>
                                    <div class="mb-1">
                                        <i class="mdi mdi-office-building"></i> <strong>Departamento: </strong><?php  echo $resultados[0]->depto;?>
                                    </div>
                                    <div class="mb-1">
                                        <i class="mdi mdi-account-voice"></i> <strong>Asignado a: </strong><?php  echo $resultados[0]->nombreagente;?>
                                    </div>

                                </div>
                                
                                <div>
                                    <div class="mb-1">
                                        <i class="mdi mdi-calendar"></i> <strong>Creado: </strong><?php  echo $resultados[0]->created_at;?>
                                    </div>
                                    <div class="mb-1">
                                        <i class="mdi sienna_source_class"></i> <strong>Fuente: </strong><?php  echo $resultados[0]->siennasource;?>
                                    </div>
                                    <div class="mb-1">
                                        <i class="mdi mdi-information"></i> <strong>Tema de ayuda: </strong><?php  echo $resultados[0]->topicname;?>
                                    </div>
                                </div>
                              </div>
                              

                              </div>
                              
                        </div>
                    </div>
                    <iframe src="<?php  echo $resultados[0]->conversation_url;?>" width="100%" class="border rounded-3" style="height: 400px!important;"></iframe>    
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
                              <hr style="margin-top: 10px;"/>
                              <div class="d-flex mt-2">
                                <i class="mdi mdi-card-account-details"></i>&nbsp;Numero cliente:&nbsp;
                                <span class="badge badge-secondary-lighten line-h">
                                <?php  echo $resultados[0]->cliente;?>
                                </span>
                              </div>
                              <div class="d-flex  mt-2">
                                <i class="mdi mdi-account"></i>&nbsp;Nombre:&nbsp;
                                <span class="badge badge-secondary-lighten hover-overlay line-h">
                                <?php  echo $resultados[0]->nya;?>
                                </span>
                              </div>
                              <div class="d-flex mt-2">
                                <i class="mdi mdi-home"></i>&nbsp;Domicilio:&nbsp;
                                <span class="badge badge-secondary-lighten line-h">
                                <?php  echo $resultados[0]->address;?>
                                </span>
                              </div>
                              <div class="d-flex mt-2">
                                  <i class="mdi mdi-whatsapp text"></i>&nbsp;Teléfono:&nbsp;
                                  <span class="badge badge-secondary-lighten line-h">
                                  <?php  echo $resultados[0]->cel;?>
                                  </span>
                                </div>
                                <div class="d-flex mt-2">
                                  <i class="mdi mdi-email"></i>&nbsp;Email:&nbsp;
                                  <span class="badge badge-secondary-lighten line-h">
                                  <?php  echo $resultados[0]->email;?>
                                  </span>
                                </div>
                                <div class="d-flex mt-2">
                                  <i class="mdi mdi-account-cash"></i>&nbsp;Estado de cuenta:&nbsp;
                                  <span class="badge badge-success-lighten line-h">
                                  <?php  echo $resultados[0]->a_status;?>
                                  </span>
                               
                                </div>
                                <div class="d-flex mt-2">
                                  <i class="mdi mdi-antenna"></i>&nbsp;Estado de servicio:&nbsp;
                                  <span class="badge badge-success-lighten line-h">
                                  <?php  echo $resultados[0]->s_status;?>
                                  </span>
                                  
                                </div>
                                <div class="d-flex mt-2">
                                    <i class="mdi mdi-switch"></i>&nbsp;Nodo:&nbsp;
                                    <span class="badge badge-secondary-lighten line-h">
                                    <?php  echo $resultados[0]->nodo;?>
                                    </span>
                                  </div>
                                <div class="d-flex mt-2">
                                    <i class="mdi mdi-map-marker"></i>&nbsp;IP:&nbsp;
                                    <span class="badge badge-secondary-lighten line-h">
                                    <?php  echo $resultados[0]->ip;?>
                                    </span>
                                  </div>
                                <div class="d-flex mt-2">
                                    <i class="mdi mdi-currency-usd"></i>&nbsp;Deuda:&nbsp;
                                    <span class="badge badge-secondary-lighten line-h">
                                    <?php  echo $resultados[0]->deuda;?>
                                    </span>
                                  </div>
                                  
                              </div>
                              
                              
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-4 col-xxl-3">
                    <strong>Seguimiento</strong>
                    <hr>
                    <div class="card-body">
                        <!-- end sub tasks/checklists -->
                        <form action="/api/siennacrearseguimiento2" method="POST"  enctype="multipart/form-data">

                                <div class="mt-2 ">
                                <div>
                                        <label class="form-label">Subir archivo</label>
                                        <input name="logo" class="form-control" type="file" id="inputGroupFile04">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Nota interna</label>
                                        <div class="input-group">
                                        <input value="<?php echo session('nombreusuario');?>" type="hidden" name="logeado" id="logeado">

                                        <input value="<?php echo $resultados[0]->ticketid;?>" type="hidden" name="idticketseguimiento" id="idticketseguimiento">
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
                                <div class="card-body py-0 mb-3 mt-3 " style="height: 600px;" data-simplebar="init"><div class="simplebar-wrapper" ><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px 24px;">
                                   
                                <?php foreach($segui as $val){
                                    
                                    
                                    if($val->logo<>null){
                                       

                                        if ($val->tipo == 5) {
                                            $ht='https://sienamedia.sfo3.digitaloceanspaces.com/'.$val->logo;
                                        } else {
                                            $ht='https://sienamedia.sfo3.digitaloceanspaces.com/'.$subdomain_tmp.'/xen/enviados/'.$val->logo;
                                            
                                        }

                                        
                                        
                                        $uri='<a target=_blank href="'.$ht.'"><img  src='.$ht.' width="40px;"></a>';
                                      }else{
                                        $uri='';
                                      }
                                      ?>
                                 <div class="timeline-alt py-0 " ">
                                <div class="timeline-item">
                                    <?php  $tipo=$val->tipo;
                                echo $color=coloriconos($iconos,$tipo);?>
                                    <div class="timeline-item-info">
                                    <span class="text-info fw-bold mb-1 d-block"><?php echo $val->descripcion;?></span>
                                    <small><?php echo $val->autor;?></small>
                                    <p class="mb-0 pb-2">
                                    <small class="text-muted"><?php echo $val->created_at;?></small>
                                    </p>
                                <span><?php if($uri<>""){
                                
//echo $uri;?>
                                <button onclick="ng(`<?php  echo $ht;?>`)" 
                     class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-img" >
                        <i class="mdi mdi-notebook" data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-custom-class="mb-1" data-bs-title="Img."></i>
                    </button><?php }?>
                            </span> </div> </div>

                                    <?php }?>
                            
                            </div></div></div><div class="simplebar-placeholder" style="width: auto; height: 353px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 281px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div> <!-- end slimscroll -->
                            </div>
            </div> <!-- end row-->
                </div>
            </div>
              <!-- container -->
        </div>
          <!-- content -->
      </div>
      
      
      <!-- Small modal Status-->
       
      <!-- End modal Status -->
      @include('sienna.ticketsmodals.estados')
        <!-- Departament modal Status-->
        <div class="modal fade" id="bs-example-modal-sm-assign" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h4 class="modal-title" id="mySmallModalLabel">Asignar Ticket</h4>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                    <form action="/api/pedir2" method="POST">
                        <input value="<?php echo $resultados[0]->ticketid;?>" type="hidden" name="idticketpedir" id="idticketpedir2">
                        <input value="<?php echo session('nombreusuario');?>" type="hidden" name="logeado" id="logeado">
                        
                            <div class="mt-3">
                                
                                <div v-for="department in departments ">
                                    <?php foreach($usersmerchant as $dep){?>
                                        <input value="<?php echo $dep->id;?>" class="form-radio" type="radio" name="usuarioticket">&nbsp;
                                    <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;"><?php echo$dep->nombre." ".$dep->last_name;?></span>
                                        <br><br>

                                    <?php }?>   
                                </div>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Asignar</button>
                                </form>
                        </div>
                    </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
      <!-- End modal Status -->

        <!-- Departament modal Status-->
        <div class="modal fade" id="bs-example-modal-sm-departament" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h4 class="modal-title" id="mySmallModalLabel">Cambiar Area</h4>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                    <form action="/api/cambiardeptosienna2" method="post">
                        <input type="hidden" name="_token" v-bind:value="csrf">
                        <input value="<?php  echo $resultados[0]->conversation_id;?>" type="hidden" name="idconv" id="idconv">
                        <input value="<?php echo session('nombreusuario');?>" type="hidden" name="logeado" id="logeado">
                        <input value="<?php  echo $resultados[0]->user_id;?>" type="hidden" name="user_id" id="user_id">
                        <input value="<?php echo $subdomain_tmp;?>" type="hidden" name="idbot" id="idbot">
                        <input value="<?php  echo $resultados[0]->ticketid;?>"  type="hidden" name="idticketdepto" id="idticketdepto">
                        <input value="" type="hidden" name="bot_channel" id="bot_channel">
  
                        <input  type="hidden" name="merchant" id="merchant" value=" <?php echo $subdomain_tmp;?> ">

                        <div v-for="department in departments ">
                        <?php foreach($deptos as $dep){?>
                            <input value="<?php echo $dep->id;?>" class="form-radio" type="radio" name="statos">&nbsp;
                        <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;"><?php echo$dep->nombre;?></span>
                            <br><br>

                            <?php }?>   
                                             </div>
                        <button type="submit" class="btn btn-success
                                    waves-effect waves-light">Cambiar</button>

                    </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
      <!-- End modal Status -->

      

      <!-- Modal Reclamo Ticket -->
      <div id="standard-modal-reclamo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="dark-header-modalLabel" aria-hidden="true">
           <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h4 class="modal-title text-light" id="dark-header-modalLabel">Reclamar ticket</h4>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
            <div class="modal-body">
                ¿Deseas reclamar este ticket?
            </div>
            <div class="modal-footer">
            <form action="/api/pedir" method="POST">
                        <input value="<?php  echo $resultados[0]->ticketid;?>" type="hidden" name="idticketpedir" id="idticketpedir">
                        <input value="<?php echo session('idusuario'); ?>" type="hidden" name="usuarioticket" id="usuarioticket">
                        <input value="<?php echo session('nombreusuario');?>" type="hidden" name="logeado" id="logeado">

                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                <button type="submit" class="btn btn-success">Si, reclamar</button>
                                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
      
      <!-- End Reclamo Ticket -->
    
<!-- /.modal-topic -->

<div class="modal fade" id="bs-example-modal-smt" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h4 class="modal-title" id="mySmallModalLabel">Cambiar Topic</h4>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/topiccambiar" method="post">
                            @csrf
                            <input type="hidden" name="tik" id="idticketestado3" value="">
                            <input value="<?php echo $subdomain_tmp;?>" type="hidden" name="idbot" id="idbot">
                            
                            <div id="estunico2"></div>
                                
                                    
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success">Cambiar</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
</div>
<script>
function topic(result,dd, ee, ff) {

        document.getElementById("idticketestado3").value = dd;
        url = "https://"+result+".suricata.cloud/api/topicxdepto?depto=" + ff;
        axios.get(url)
        .then(function (response) {
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
        .catch(function (error) {
            // función para capturar el error
            console.log(error);
        })
        .then(function () {
            // función que siempre se ejecuta
        });


}
function ng(ruta) {
    document.getElementById('vista2').innerHTML = "";
   // document.getElementById('vista').src = dd;
   // g='<iframe allow="camera;microphone"  src="'+dd+'" width="100%" height="800px" class="border rounded-3" style="height:400px !important"></iframe>';
   g='<embed src="'+ruta+'" type="" width="180" height="350" quality="high" wmode="transparent">'
    document.getElementById('vista2').innerHTML = g;
}
</script>
<!-- /.modal-topic -->
     


    <!-- End Solicita numero de cliente -->
    @include('sienna.ticketsmodals.cerrar')



      <!-- ============================================================== -->
      <!-- End Page content -->
      <!-- ============================================================== -->

  </div>



  
     

   

</div> 
</div>
<?php
// dd($resultados);?>
    <br><br><br>
  
    
    <div class="modal fade" id="bs-example-modal-img" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-headerbg-dark text-white">
                        hola
                   
                    </div>
                    <div class="modal-body">
                    <div class="modal-body" id="vista2">
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
</div>
</div>
   
    @include('facu.footer')