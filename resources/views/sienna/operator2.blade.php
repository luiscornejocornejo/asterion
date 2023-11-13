@include('facu.header2')

  <!-- Begin page -->
  <div class="wrapper">

      <!-- ========== Left Sidebar Start ========== -->
      @include('facu.menu')
<script>


function area(dd,ee,ff) {
      
      document.getElementById("idticketdepto").value = dd;
      document.getElementById("idconv").value = ee;
      document.getElementById("user_id").value = ff;


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
                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                        <thead class="">
                            <tr class="text-center">
                                <th>Ticket</th>
                                <th>Cliente</th>
                                <th>Area</th>
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

                                <td><button onclick="area('<?php echo $val->ticketid;?>','<?php echo $val->conversation_id;?>','<?php echo $val->user_id;?>')"  class="btn s" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm2">
                                    <?php echo $val->depto;?>
                                    </button> </td>
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
                                    <button onclick="estado2('<?php echo $val->ticketid;?>','<?php echo $val->conversation_id;?>','<?php echo $val->iddepto;?>')"  class="btn btn-<?php echo $bgcolor;?>" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm">
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
                        <input type="hidden" name="idconv" id="conversation_id2" value="">
                        <input value="<?php echo $subdomain_tmp;?>" type="hidden" name="idbot" id="idbot">
                        
                        <div id="est"></div>
                               
                                
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Cambiar</button>
                        </div>
                    </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>


        <div id="bs-example-modal-sm2" class="modal fade bs-example-modal-center " tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title">Cambiar Depto</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/api/cambiardeptosienna" method="post">
                        <input type="hidden" name="_token" v-bind:value="csrf">
                        <input value="" type="hidden" name="idconv" id="idconv">
                        <input value="" type="hidden" name="user_id" id="user_id">
                        <input value="<?php echo $subdomain_tmp;?>" type="hidden" name="idbot" id="idbot">
                        <input value=""  type="hidden" name="idticketdepto" id="idticketdepto">
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