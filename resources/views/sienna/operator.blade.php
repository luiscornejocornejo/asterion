@include('facu.header2')


<script>

var URLactual = window.location;
var porciones = URLactual.split('.');

alert(porciones[0]);
// identificadorIntervaloDeTiempo = setInterval(maxid, 5000);
var idusuario =<?php echo session('idusuario');?>;
</script>
 

  <!-- Begin page -->
  <div class="wrapper">

      <!-- ========== Left Sidebar Start ========== -->
      @include('facu.menu')


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
                                    <button onclick="vista('<?php echo $val->conversation_url;?>')" class="btn btn-light" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg">
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
      @include('sienna.ticketsmodals.conversacion')        
      @include('sienna.ticketsmodals.estados')
      @include('sienna.ticketsmodals.departamentos')
      @include('sienna.ticketsmodals.pedir')
      @include('sienna.ticketsmodals.seguimientos')
 

    </div>
  <!-- END wrapper -->

  @include('facu.footer')