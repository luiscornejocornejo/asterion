@include('creative2.header')
<?php $categoria =  session('categoria');?>
<script>

    function casaa(dc){
        img = document.getElementById(dc);
img.style.transform = 'scale(1.9)';

    }


    function car2(dd) {
    //alert(dd);
    document.getElementById("iddelticket2").value = dd;

    }
function car(dd) {
    //alert(dd);
    document.getElementById("iddelticket").value = dd;
var url2='https://pagoralia.site/api/ws2?token=12345&ws=8&ticket='+dd;
timer=document.getElementById("timer");
timer.innerHTML = '';
    $.ajax({
        url:url2 ,
        beforeSend: function(xhr) {
           
        }, success: function(data){
            console.log(data);
            let valores = Object.values(data); // valores = ["Scott", "Negro", true, 5];
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
                                                        '<h4 class="mt-0 mb-1 font-16">'+valores[i][j]['creador']+'</h4>'+
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
                                                        '<h4 class="mt-0 mb-1 font-16">'+valores[i][j]['creador']+'</h4>'+
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

<div id="principal">
    <div class="" style="width: 80%;margin-top: 70px;margin-left: 367px;">

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade
                            show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Begin Page Content -->
          
          
        
           <button id="btnAbrirAgregarBien" type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalExample">Realizar Reclamo</button>

                <button onclick="exportTableToExcel('basic-datatable')" style="" class="btn  btn-sm btn-secondary" id="btnAbrirAgregarBien" data-toggle="modal" data-target="#modalExample">
                Exportar
                </button>
                <br> <br>
 
                <?php if(isset($datos)){ 
                    
                  ?>
                        <div class="table-responsive">


                            <table id="basic-datatable" class="table  table-centered mb-0" role="table"  >
                                <thead  class="table-dark">
                                    <tr role="row">

                                    <th role="columnheader" align='center'>Id</th>

                                    <th role="columnheader" align='center'>Fecha</th>
                                    

                                    <th role="columnheader" align='center'>Acciones</th>

                                 
                                    
                                    

                                    </tr>
                                </thead>
                                <tbody role="rowgroup">
                                
                                    
                                <?php 

$array = json_decode($datos, true);

//dd($array);
foreach ($array['pp'] as $item) {

    echo "<tr>";
    echo "<td>".$item['ticket_id']."</td>";
  
    echo '<td><i class="uil-calendar-alt"></i> '.$item['nombredelusuario'].'</td>';
  

    if($item['nombrestatus']=="Open"){
        echo '<td><span class="badge bg-info">'.$item['estadotick'].'</span></td>'; 
       }
    if($item['nombrestatus']=="Progreso"){
        echo '<td><span class="badge bg-warning">'.$item['estadotick'].'</span></td>';
    } 
    if($item['nombrestatus']=="Resuelto"){
        echo '<td><span class="badge bg-success">'.$item['estadotick'].'</span></td>';   
     } 
    if($item['nombrestatus']=="Cerrado"){
        echo '<td><span class="badge bg-danger">'.$item['estadotick'].'</span></td>';    
    }
    ?>
    <td>
    <button onclick="car(<?php echo $item['ticket_id'];?>)" id="segui" type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalExample2"><i class="ri-discuss-line"></i></button>
    <button onclick="car2(<?php echo $item['ticket_id'];?>)" id="segui2" type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#modalExample4"><i class="ri-delete-bin-7-fill"></i></button>
   

    
</td>

   </tr>
   <?php
}?>

</tbody>
                            </table>

                        </div>
                <?php }?>
   

                
                              
<br><br><br>






               

</div>
</div>


                            </div>



<div id="modalExample" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-white" id="info-header-modalLabel">Crear Ticket</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                      
           
            <form action="creartickets" method="post" enctype="multipart/form-data">

                        @csrf
                        <div class="form-group">
                            <?php //var_dump($metodos);?>
                            <label for="exampleInputEmail1">merchant</label>
                            <input required name="merchant"  type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter merchant">
                        </div>
                        <div class="form-group">
                            <?php //var_dump($metodos);?>
                            <label for="exampleInputEmail1">cliente</label>
                            <input required name="cliente"  type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter cliente">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">rastreo</label>
                            <input required name="rastreo"  type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter rastreo">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">recibo</label>
                            <input required name="recibo"  type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter recibo">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">importe</label>
                            <input required name="importe"  type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter importe">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">descripcion</label>
                            <input required name="descripcion"  type="descripcion" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter descripcion">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">metodo</label>
                            <select class="form-control "  name="metodo" id="selectf"  >

                            <?php

                                $metodos2 = json_decode($metodos, true);

                                //dd($array);
                                foreach ($metodos2['pp'] as $item2) {

                                    echo "<option value='".$item2['id']."'>".$item2['nombre']."</option>";
                                }
                            ?>
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">tiporeclamo</label>
                            <select class="form-control "  name="tiporeclamo" id="selectf"  >
                            <?php

                                    $reclamos = json_decode($reclamos, true);

                                    //dd($array);
                                    foreach ($reclamos['pp'] as $item3) {

                                        echo "<option value='".$item3['id']."'>".$item3['nombre']."</option>";
                                    }
                                    ?>
                                </select>
                        </div>
                        <div class="form-group">

                        <input type="hidden" name="estadoticket" value="1">
                            
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">mediodepago</label>
                            <input required name="mediodepago"  type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter descripcion">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">imagen</label>
                            <input required name="logo"  type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter descripcion">
                        </div>



                        <div class="form-group">
                            <br><br>
                                <button type="submit" class="btn btn-success btn-block">Crear Ticket </button>
                        </div>
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
<div id="modalExample2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="info-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-white" id="info-header-modalLabel">Seguimientos</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                                <form action="crearseguimiento" method="post" enctype="multipart/form-data">

                    @csrf
                    <div class="form-group">
                            <?php //var_dump($metodos);?>
                            <label for="exampleInputEmail1">merchant</label>
                            <input required name="merchant"  type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter merchant">
                        </div>
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

                           

@include('creative2.footer')