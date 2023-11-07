@include('facu.header2')

  <!-- Begin page -->
  <div class="wrapper">

      <!-- ========== Left Sidebar Start ========== -->
      @include('facu.menu')
<script>
    function estado2(dd,ee) {
      
        document.getElementById("idticketestado2").value = dd;
        document.getElementById("conversation_id2").value = ee;

        alert("llego");


        /*
        url="https://opticom.suricata.cloud/api/statussiennaxdepto?depto=3";
        const response = await fetch(url);
    var data = await response.json();
        alert($data);*/

    

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
                                <th>Whatapp</th>
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
                                <td><?php echo $val->cel;?></td>
                                <td><?php echo $val->created_at;?></td>
                             
                                <td>
                                <?php  
/*
                                        foreach($estados as $value){

                                            if($val->siennaestado==$value->id){$bgcolor=$value->color;}

                                        }*/

                                        $bgcolor="success";
                                     
                                 
                                        
                                        ?>
                                    <button onclick="estado2('<?php echo $val->ticketid;?>','<?php echo $val->conversation_id;?>')"  class="btn btn-<?php echo $bgcolor;?>" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm">
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
                   
                    <div class="modal-body">
                        <iframe id="vista" src="" width="100%" height="800px" class="border rounded-3" style="height:400px !important"></iframe>
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
                        <form action="/ventasstatus" method="post">
                        @csrf
                        <input type="hidden" name="tik" id="idticketestado2" value="">

                        
                        <?php 
                       
                        foreach($estados as $value){?>
  

                        <input type="hidden" name="idconv" id="conversation_id2" value="">
                        <input value="<?php echo $subdomain_tmp;?>" type="hidden" name="idbot" id="idbot">
                            <div class="mt-3">

                            <div class="form-check mb-2">
                                    <input type="radio" id="customRadio<?php echo $value->id;?>" name="estado" value="<?php echo $value->id;?>"  class="form-check-input">
                                    
                                    <label class="form-check-label" for="customRadio<?php echo $value->id;?>"><?php echo $value->nombre;?></label>
                                </div>

                                </div>

                       <?php }?>
                               
                                
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Cambiar</button>
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
            <div class="offcanvas-header bg-dark text-white">
                <h5 id="offcanvasRightLabel" >Seguimiento</h5>
                <button type="button" class="btn-close btn-close-white  text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
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