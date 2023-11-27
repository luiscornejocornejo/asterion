@include('facu.header2')

  <!-- Begin page -->
  <div class="wrapper">

      <!-- ========== Left Sidebar Start ========== -->
      @include('facu.menu')
<script>

let identificadorIntervaloDeTiempo;


 // identificadorIntervaloDeTiempo = setInterval(maxid, 5000);

   let variableGlobal =0;



function maxid(){
 

    var idusuario=<?php echo session('idusuario');?>;
    url="https://opticom.suricata.cloud/api/maxid?idusuario="+idusuario+"";
        axios.get(url)
                .then(function (response) {
                    // función que se ejecutará al recibir una respuesta
                    console.log(response.data.length);
                    console.log(response.data);
                    document.getElementById("tb").innerHTML = null;
                    tt="";
                    for (i = 0; i < response.data.length; i++) {
                        console.log(response.data[i].id);



                        tt+='<tr class="text-center">'+
                        ' <td>'+response.data[i].ticketid+'</td>'+
                        ' <td>'+response.data[i].nya+'</td>'+
                        ' <td><button onclick="area('+response.data[i].ticketid+','+response.data[i].conversation_id+','+response.data[i].user_id+')"  class="btn s" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm2">'+response.data[i].depto+' </button> </td>'+
                        ' <td>'+response.data[i].cel+'</td>'+
                        ' <td>'+response.data[i].created_at+'</td>'+
                        ' <td><button onclick="estado2('+response.data[i].ticketid+','+response.data[i].conversation_id+','+response.data[i].iddepto+')"  class="btn s" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm">'+response.data[i].estadoname+' </button> </td>'+
                        '<td><button  class="btn btn-outline-secondary rounded" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="mdi mdi-link"></i></button>'+ 
                            '<button  onclick="vista('+response.data[i].conversation_url+')" class="btn btn-outline-secondary rounded" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg"><i class="mdi mdi-wechat"></i> </button></td </tr>';



                    }
                    document.getElementById("tb").innerHTML = tt;

                   
                })
                .catch(function (error) {
                    // función para capturar el error
                    console.log(error);
                })
                .then(function () {
                    // función que siempre se ejecuta
                });  
    console.log("Ha pasado 1 segundo.");

}
function area(dd,ee,ff) {
      
      document.getElementById("idticketdepto").value = dd;
      document.getElementById("idconv").value = ee;
      document.getElementById("user_id").value = ff;


}
function pedir(dd) {
      
      document.getElementById("idticketpedir").value = dd;



}
    function estado2(dd,ee,ff) {
      
        document.getElementById("idticketestado2").value = dd;
        document.getElementById("conversation_id2").value = ee;



        
        url="https://opticom.suricata.cloud/api/statussiennaxdepto?depto="+ff;
        axios.get(url)
                .then(function (response) {
                    // función que se ejecutará al recibir una respuesta
                    console.log(response.data);

                    dato="";
                    for (i = 0; i < response.data.length; i++) {
                        console.log(response.data[i].id);
                        console.log(response.data[i].nombre);


                       dato+=' <div class="mt-3">'+

                            '<div class="form-check mb-2">'+
                                   ' <input type="radio" id="customRadio'+response.data[i].id+'" name="estado" value="'+response.data[i].id+'"  class="form-check-input">'+
                                    
                                    '<label class="form-check-label" for="customRadio'+response.data[i].id+'">'+response.data[i].nombre+'</label>'+
                                '</div>'+

                               ' </div>';


                        } 
                        document.getElementById("est").innerHTML = dato;



                })
                .catch(function (error) {
                    // función para capturar el error
                    console.log(error);
                })
                .then(function () {
                    // función que siempre se ejecuta
                });
    

    }
function vista(dd) {
        document.getElementById('vista').src = "";

        document.getElementById("vista").contentWindow.document.location.href=dd;
        document.getElementById('vista').src = dd;

        }

    </script>

      <div class="content-page" style="padding: 0!important;">
          <div class="content">

              <!-- Start Content-->
                <div class="container pt-5">
                    <table id="basic-datatable" class="table dt-responsive nowrap w-100 text-light">
                        <thead>
                            <tr class="text-center bg-dark" >
                                <th class="text-light"><i></i>Ticket</th>
                                <th class="text-light">Cliente</th>
                                <th class="text-light">Area</th>
                                <th class="text-light">Telefono</th>
                                <th class="text-light">Creado</th>
                                <th class="text-light">Estado</th>
                                <th class="text-light">Acciones</th>
                                <th class="text-light">Historial</th>
                            </tr>
                        </thead>
                        <tbody id="tb">
                        <?php
                        $maxid=0; foreach($tickets as $val){
                            
                            $maxid=$val->ticketid;?>
                            <tr class="text-center">
                                <td>
                                <?php foreach($source as $so){
                                    
                                    
                                    if($so->id==$val->siennasource){

                                        $fon=$so->svg;
                                    }
                                    
                                }?>
                                    <span><i class="mdi <?php echo $fon;?> me-1 "></i><?php echo $val->ticketid;?></span>
                                </td>
                                <td><?php echo $val->nya;?></td>
                                <td>
                                <?php foreach($deptos as $dep){
                                    
                                    
                                    if($dep->id==$val->iddepto){

                                        $bgcolor=$dep->colore;
                                    }
                                    
                                }?>


                                    <span class="badge <?php echo $bgcolor;?>" style="font-size:medium;"><?php echo $val->depto;?></span>
                                </td>
                                <td><?php echo $val->cel;?></td>
                                <td><?php echo $val->created_at;?></td>
                                <td>
                                <?php foreach($estados as $est){
                                    
                                    
                                    if($est->id==$val->siennaestado){

                                        $bgcolor2=$est->clasecolor;
                                    }
                                    
                                }?>
                                
                                    <span class="badge bg-<?php echo $bgcolor2;?>" style="font-size:medium;"><?php echo $val->estadoname;?></span>
                                </td>
                                <td>
                                    <button onclick="pedir('<?php echo $val->ticketid;?>')" <?php if($val->asignado<>'99999'){ echo "disabled";}?> class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#standard-modal-reclamo">
                                        <i class="mdi mdi-account-voice"></i>
                                    </button>
                                    <button onclick="area('<?php echo $val->ticketid;?>','<?php echo $val->conversation_id;?>','<?php echo $val->user_id;?>')"  class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm2">
                                        <i class="mdi mdi-account-group"></i>
                                    </button>
                                    <button onclick="estado2('<?php echo $val->ticketid;?>','<?php echo $val->conversation_id;?>','<?php echo $val->iddepto;?>')" class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm" >
                                        <i class="mdi mdi-flag"></i>
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                                        <i class="mdi mdi-link"></i>
                                    </button> 
                                    <button nclick="vista('<?php echo $val->conversation_url;?>')" class="btn btn-light" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg">
                                        <i class="mdi mdi-wechat"></i>
                                    </button> 
                                </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    
                                                     
                </div>
               
              <!-- container -->
          </div>
          <!-- content -->
      </div>
      <!-- Modal of conversation-->
      @include('sienna.ticketsmodals.coversacion')

      
      <!-- End Modal -->
      
      <!-- Small modal Status-->
        
      @include('sienna.ticketsmodals.estados')

      @include('sienna.ticketsmodals.departamentos')
      @include('sienna.ticketsmodals.pedir')
 
      <!-- End modal Status -->

      <!-- OffCanvas -->
     <!-- Modal Reclamo Ticket -->
    
      
      <!-- End Reclamo Ticket -->
    

      <!-- OffCanvas -->
      <div>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header bg-dark text-white">
                <h5 id="offcanvasRightLabel" >Seguimiento</h5>
                <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-6">
                                    <!-- assignee -->
                                    <p class="mb-1 text-muted">Asignado a:</p>
                                    <div class="d-flex">
                                        <div>
                                            <span class="mt-1 font-14">
                                                agent_sienna
                                            </span>
                                        </div>
                                    </div>
                                    <!-- end assignee -->
                                </div> <!-- end col -->                                
                            </div> <!-- end row -->

                            
                            <!-- end sub tasks/checklists -->
                            <div class="mt-2 ">
                                <div class="mb-2">
                                    <label class="form-label">Comentario</label>
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
                                        <!-- Dropdown Inactivo
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end" style="">
                                                
                                                <a class="dropdown-item">Editar</a>
                                                
                                                <a href="javascript:void(0);" class="dropdown-item">Cerrar</a>
                                            </div>
                                        </div>
                                        -->
                                    </div>

                                    <div class="card-body py-0 mb-3 mt-3" data-simplebar="init"><div class="simplebar-wrapper" ><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px 24px;">
                                        <div class="timeline-alt py-0">
                                            <div class="timeline-item">
                                                <i class="mdi mdi-upload bg-info-lighten text-info timeline-icon"></i>
                                                <div class="timeline-item-info">
                                                    <span class="text-info fw-bold mb-1 d-block">Carga de archivo</span>
                                                    <small>agent_sienna ha subido un elemento</small>
                                                    <p class="mb-0 pb-2">
                                                        <small class="text-muted">date_event</small>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="timeline-item">
                                                <i class="mdi mdi-flag bg-primary-lighten text-primary timeline-icon"></i>
                                                <div class="timeline-item-info">
                                                    <a href="#" class="text-primary fw-bold mb-1 d-block">Cambio de estado en ticket</a>
                                                    <small>agent_sienna cambió el estado del ticket a
                                                        <span class="fw-bold">ticket_status</span>
                                                    </small>
                                                    <p class="mb-0 pb-2">
                                                        <small class="text-muted">date_event</small>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="timeline-item">
                                                <i class="mdi mdi-account-group bg-info-lighten text-info timeline-icon"></i>
                                                <div class="timeline-item-info">
                                                    <a href="#" class="text-info fw-bold mb-1 d-block">Cambio de departamento</a>
                                                    <small>agent_sienna derivó a 
                                                        <span class="fw-bold">departament</span>
                                                    </small>
                                                    <p class="mb-0 pb-2">
                                                        <small class="text-muted">date_event</small>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="timeline-item">
                                                <i class="mdi mdi-account-voice bg-primary-lighten text-primary timeline-icon"></i>
                                                <div class="timeline-item-info">
                                                    <a href="#" class="text-primary fw-bold mb-1 d-block">Reclamo de ticket</a>
                                                    <small> Por agente agent_sienna</small>
                                                    <p class="mb-0 pb-2">
                                                        <small class="text-muted">date_event</small>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="timeline-item">
                                                <i class="mdi mdi-account bg-primary-lighten text-primary timeline-icon"></i>
                                                <div class="timeline-item-info">
                                                    <a href="#" class="text-primary fw-bold mb-1 d-block">Asignación de ticket</a>
                                                    <small> Asignado a agent_sienna</small>
                                                    <p class="mb-0 pb-2">
                                                        <small class="text-muted">date_event</small>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="timeline-item">
                                                <i class="mdi mdi-comment-text bg-info-lighten text-info timeline-icon"></i>
                                                <div class="timeline-item-info">
                                                    <a href="#" class="text-info fw-bold mb-1 d-block">agent_sienna</a>
                                                    <small>comment</small>
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
                            <!-- end comments -->
                        </div> <!-- end col -->
                    </div> <!-- end row-->
                </div>
            </div>
        </div>
        
      </div>
      <!-- End of OffCanvas -->




    </div>
  <!-- END wrapper -->

  @include('facu.footer')