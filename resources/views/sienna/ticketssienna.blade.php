@include('facu.header')
<div class="wrapper">

<!-- ========== Left Sidebar Start ========== -->
@include('facu.menu')
<?php $categoria =  session('categoria');?>
<script>

    function casaa(dc){
        img = document.getElementById(dc);
img.style.transform = 'scale(1.9)';

    }


    function estado(dd,ee) {
        if (ee === undefined) {
            document.getElementById("statos4").disabled = true;  
        }else{
            document.getElementById("statos4").disabled = false;  

        }
    document.getElementById("idticketestado").value = dd;

    }
    function cliente(dd) {
        
    document.getElementById("idticketcliente").value = dd;

    }
    function vista(dd) {
        document.getElementById('vista').src = "";

        document.getElementById("vista").contentWindow.document.location.href=dd;
        document.getElementById('vista').src = dd;

        }

    
function car(dd) {
    //
    document.getElementById("iddelticket").value = dd;

    alert(dd);
                    
                var url2='https://template.suricata.cloud/api/tickessiennaseguimientos?token=12345&ticket='+dd;
                timer=document.getElementById("timer");
                timer.innerHTML = '';
                    $.ajax({
                        url:url2 ,
                        beforeSend: function(xhr) {
                        
                        }, success: function(data){
                           
                            let valores = Object.values(data); // valores = ["Scott", "Negro", true, 5];
                            alert(valores);
                            tt='<div id="dd" class="timeline" dir="ltr"><div class="timeline-show my-2 text-center">'+
                                                                '<h5 class="m-0 time-show-name">Conversacion</h5>'+
                                                            '</div>';
                            for(let i=0; i< valores.length; i++){
                                console.log(valores[i]);
                            
                                    for(let j=0; j< valores[i].length; j++){
                                    console.log(valores[i][j]['id']);
                                    
                                    if(valores[i][j]['autor']=="pagoralia"){
                                        tt+='<div class="timeline-lg-item timeline-item-right" style="">'+
                                                                '<div class="timeline-desk">'+
                                                                    '<div class="timeline-box">'+
                                                                        '<span class="arrow"></span>'+
                                                                        '<span class="timeline-icon"><i class="mdi mdi-adjust"></i></span>'+
                                                                        '<h4 class="mt-0 mb-1 font-16">'+valores[i][j]['autor']+'</h4>'+
                                                                        '<p class="text-muted">'+valores[i][j]['create_at']+'</small></p>'+
                                                                        '<p>'+valores[i][j]['descripcion']+'</p>'+

                                            
                                                                    '</div>'+
                                                                '</div>'+
                                                            '</div>'; 
                                    }else{

                                        tt+='<div class="timeline-lg-item timeline-item-left" style="">'+
                                                                '<div class="timeline-desk">'+
                                                                    '<div class="timeline-box">'+
                                                                        '<span class="arrow-alt"></span>'+
                                                                        '<span class="timeline-icon"><i class="mdi mdi-adjust"></i></span>'+
                                                                        '<h4 class="mt-0 mb-1 font-16">'+valores[i][j]['autor']+'</h4>'+
                                                                        '<p class="text-muted"><small>'+valores[i][j]['create_at']+'</small></p>'+
                                                                        '<p>'+valores[i][j]['descripcion']+'</p>'+

                                            
                                                                    '</div>'+
                                                                '</div>'+
                                                            '</div>';
                                    }
                                    timer=document.getElementById("timer");
                                    timer.innerHTML = tt;
                                    }
                                    
                            }

                            tt+="</div>";

                        
                            //process the JSON data etc
                        }
                })
      
}
</script>

@if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade
                            show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

<div class="container mt-5">
                    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                        <thead class="">
                            <tr class="text-center">
                                <th>Ticket</th>
                                <th>Cliente</th>
                                <th>Departamento</th>
                                <th>Topic</th>
                                <th>Asignado a</th>
                                <th>Estado</th>
                                <th>Historial</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $operator="yo"; foreach ($datos as $item) { ?>
                            <tr class="text-center">
                                <td><?php echo $item->ticketid;?></td>
                                <td><?php echo $item->nya;?>(<?php echo $item->cliente;?>)</td>
                                <td><?php echo $item->depto;?></td>
                                <td><?php echo $item->topicname;?></td>
                                <td><?php echo $operator;?></td>
                                <td>

                                <?php 
                                    if($item->siennaestado==1){$bgcolor="info";}
                                    if($item->siennaestado==2){$bgcolor="warning";}
                                    if($item->siennaestado==3){$bgcolor="success";}
                                    if($item->siennaestado==4){$bgcolor="success";}
                                        
                                        
                                        
                                        ?>
                                <button onclick="estado(<?php echo $item->ticketid;?>,<?php echo $item->cliente;?>)"  id="btnAbrirAgregarBien" type="button" class="btn btn-outline-secondary rounded" data-bs-toggle="modal" data-bs-target="#modalExample">
        <span class="badge bg-<?php echo $bgcolor;?>"><?php echo $item->estadoname;?></span>
        </button>
 
                                </td>
                                <td>
                                    <button class="btn btn-outline-secondary rounded" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="mdi mdi-link"></i>
                                    </button> 
                                    <button onclick="vista('<?php echo $item->conversation_url;?>')"  id="btnAbrirAgregarBien" type="button" class="btn btn-outline-secondary rounded " data-bs-toggle="modal" data-bs-target="#modalExample33">
                                    <i class="mdi mdi-wechat"></i>
        </button>
                                 
                                </td>
                            </tr>

                            <?php }?>
                        </tbody>
                    </table>
                    
                                                     
                </div>


            
                
                              




<div id="modalExample" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-white" id="info-header-modalLabel">Cambiar Estado</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                      
           
            <form action="/siennaestado" method="post" enctype="multipart/form-data">

                        @csrf
                        <input type="hidden" name="idticketestado" id="idticketestado" value="">

                            <?php foreach ($siennaestado as $value2) {?>
                            <div >

                                <input value="<?php echo $value2->id; ?>" class="form-radio"
                                    type="radio" id="statos<?php echo $value2->id; ?>" name="statos">&nbsp; <span class=" fw-bold"
                                    style="color: #98a6ad;font-size: 12px;"><?php echo $value2->nombre; ?></span>
                                <br><br>
                            </div>
                            <?php }?>

                            <button type="submit" class="btn btn-success
                                        waves-effect waves-light">Cambiar</button>
                        </form>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                        <script type="text/javascript">
                        // Initialize our function when the document is ready for events.
                        jQuery(document).ready(function(){
                        // Listen for the input event.
                        jQuery("#cliente").on('input', function (evt) {
                        // Allow only numbers.
                        jQuery(this).val(jQuery(this).val().replace(/[^0-9a-zA-Z]/g, ''));
                        });
                        });
                        </script> 
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="modalExample3" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-white" id="info-header-modalLabel">Cambiar Cliente</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                      
           
            <form action="/siennacliente" method="post" enctype="multipart/form-data">

                        @csrf
                        <input type="hidden" name="idticketcliente" id="idticketcliente" value="">
                        <input type="text"  name="cliente"/>
                           

                            <button type="submit" class="btn btn-success
                                        waves-effect waves-light">Cambiar</button>
                        </form>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                        <script type="text/javascript">
                        // Initialize our function when the document is ready for events.
                        jQuery(document).ready(function(){
                        // Listen for the input event.
                        jQuery("#cliente").on('input', function (evt) {
                        // Allow only numbers.
                        jQuery(this).val(jQuery(this).val().replace(/[^0-9a-zA-Z]/g, ''));
                        });
                        });
                        </script> 
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="modalExample33" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog"  role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-white" id="info-header-modalLabel">CONVERSACION</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
           
                 <iframe id="vista" src="" sandbox="allow-forms allow-scripts allow-popups allow-same-origin allow-top-navigation" ></iframe>
           
            
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="modalExample2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-white" id="info-header-modalLabel">Seguimientos</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                                <form action="/siennacrearseguimiento" method="post" enctype="multipart/form-data">

                    @csrf
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">descripcion</label>
                        <input type="hidden" readonly name="ticket" id="iddelticket" >
                        <input required name="descripcion"  type="descripcion" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter descripcion">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">imagen</label>
                       
                        <input  name="logo"  type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter descripcion">
                    </div>



                    <div class="form-group">
                    <br><br>
                            <button type="submit" class="btn btn-success btn-block">Crear Seguimiento </button>
                    </div>
                    </form>
           
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                                <script type="text/javascript">
                              
                                </script> 
                                <div class="row"> 
                                    <div id="timer" class="col-12">
                                        

                                            

                                           

                                        <!-- end timeline -->
                                    </div> <!-- end col -->
                                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="modalExample4" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content modal-filled bg-danger">
            <div class="modal-body p-4">
                <div class="text-center">                
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
 
                     
                    <h4 class="mt-2">Eliminar Ticket</h4>
                    <p class="mt-3">¿Esta seguro de eliminar este ticket?</p>
                    <form action="eliminarticket" method="post" enctype="multipart/form-data">

                                @csrf
                                <input type="hidden"  name="ticket" id="iddelticket2" >
                        <button type="submit" class="btn btn-light my-2" data-bs-dismiss="modal">Continuar</button>
                            </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

                           

@include('facu.footer')