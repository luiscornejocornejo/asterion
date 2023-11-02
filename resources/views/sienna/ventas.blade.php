@include('facu.header')

  <!-- Begin page -->
  <div class="wrapper">

      <!-- ========== Left Sidebar Start ========== -->
      @include('facu.menu')
<script>
    function estado(dd,ee) {
        if (ee === undefined) {
            document.getElementById("statos4").disabled = true;  
        }else{
            document.getElementById("statos4").disabled = false;  

        }
        document.getElementById("idticketestado").value = dd;
        document.getElementById("conversation_id").value = ee;


    

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
                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                        <thead class="">
                            <tr class="text-center">
                                <th>Ticket</th>
                                <th>Cliente</th>
                                <th>Creado</th>
                              
                                <th>Estado</th>
                                <th>Historial</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php foreach($tickets as $val){?>
                            <tr class="text-center">
                                <td><?php echo $val->ticketid;?></td>
                                <td><?php echo $val->nya;?></td>
                                <td><?php echo $val->created_at;?></td>
                             
                                <td>
                                <?php  
                                    if($item->siennaestado==1){$bgcolor="info";}
                                    if($item->siennaestado==2){$bgcolor="warning";}
                                    if($item->siennaestado==3){$bgcolor="success";}
                                    if($item->siennaestado==4){$bgcolor="success";}
                                        
                                        ?>
                                    <button onclick="estado('<?php echo $val->ticketid;?>','<?php echo $val->conversation_id;?>')"  class="btn btn-<?php echo $bgcolor;?>" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm">
                                    <?php echo $val->estadoname;?>
                                    </button> 
                                </td>
                                <td>
                               
                                    <button  class="btn btn-outline-secondary rounded" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                                        <i class="mdi mdi-link"></i>
                                    </button> 
                                    <button  onclick="vista('<?php echo $val->conversation_url;?>')" class="btn btn-outline-secondary rounded" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg">
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
      <div>
        <div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-black">
                        <h4 class="modal-title text-light" id="myLargeModalLabel">Historial de conversación</h4>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <iframe id="vista" src="" width="100%" height="400px" class="border rounded-3"></iframe>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
      </div>
      <!-- End Modal -->
      
      <!-- Small modal Status-->
        <div class="modal fade" id="bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h4 class="modal-title" id="mySmallModalLabel">Estado de Ticket</h4>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="mt-3">
                                <div class="form-check mb-2">
                                    <input type="radio" id="customRadio1" name="customRadio" class="form-check-input">
                                    <label class="form-check-label" for="customRadio1">Abierto</label>
                                </div>
                                <div class="form-check mb-2">
                                <input type="radio" id="customRadio2" name="customRadio" class="form-check-input">
                                <label class="form-check-label" for="customRadio2">Progreso</label>
                            </div>
                            <div class="form-check mb-2">
                                <input type="radio" id="customRadio3" name="customRadio" class="form-check-input">
                                <label class="form-check-label" for="customRadio3">Resuelto</label>
                            </div>
                            <div class="form-check mb-2">
                                <input type="radio" id="customRadio4" name="customRadio" class="form-check-input">
                                <label class="form-check-label" for="customRadio4">Cerrado</label>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-success">Cambiar</button>
                        </div>
                    </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
      <!-- End modal Status -->

      <!-- OffCanvas -->
      <div>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header bg-black text-white">
                <h5 id="offcanvasRightLabel" >Seguimiento</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                Aca va el contenido
            </div>
        </div>
      </div>
      <!-- End of OffCanvas -->




    </div>
  <!-- END wrapper -->

  @include('facu.footer')