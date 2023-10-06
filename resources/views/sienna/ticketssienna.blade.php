@include('creative2.header')
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

                                    <th role="columnheader" align='center'>#Ticket</th>
                                    
                                    <th role="columnheader" align='center'>#Cliente</th>
                                    <th role="columnheader" align='center'>Departamento</th>
                                    <th role="columnheader" align='center'>Topic</th>
                                    <th role="columnheader" align='center'>Cel</th>

                                    <th role="columnheader" align='center'>Nombre</th>

                                    <th role="columnheader" align='center'>Estado</th>
                                    

                                    <th role="columnheader" align='center'>Acciones</th>

                                 
                                    
                                    

                                    </tr>
                                </thead>
                                <tbody role="rowgroup">
                                
                                    
                                <?php 


//dd($datos[0]->pp);
foreach ($datos as $item) { 

    echo "<tr>";
    echo '<td><i class="ri-whatsapp-line"></i> '.$item->ticketid.'</td>';
  
    if($item->cliente<>""){
        $cli=$item->cliente;

    }else{
        $cli="sin cliente";
    }

    if($item->cliente<>""){
        echo '<td>'.$item->cliente.'</td>';
    }else{

        echo '<td><span class="badge bg-info">    <button onclick="cliente('.$item->ticketid.')"  id="btnAbrirAgregarBien3" type="button" class="btn btn-sm btn-info " data-bs-toggle="modal" data-bs-target="#modalExample3">'.$cli.'</button>
        </span></td>'; 
    }
    
    echo '<td>'.$item->depto.'</td>';
    if($item->topicname==""){
        echo '<td>sin topic</td>';

    }else{
        echo '<td>'.$item->topicname.'</td>';

    }
    echo '<td>'.$item->numerocel.'</td>';
    
    echo '<td>'.$item->nya.'</td>';


    if($item->siennaestado==1){
        echo '<td><span class="badge bg-info">    <button onclick="estado('.$item->ticketid.','.$item->cliente.')"  id="btnAbrirAgregarBien" type="button" class="btn btn-sm btn-info " data-bs-toggle="modal" data-bs-target="#modalExample">'.$item->estadoname.'</button>
        </span></td>'; 
       }
    if($item->siennaestado==2){
    
        echo '<td><span class="badge bg-warning">    <button onclick="estado('.$item->ticketid.','.$item->cliente.')"  id="btnAbrirAgregarBien" type="button" class="btn btn-sm btn-warning " data-bs-toggle="modal" data-bs-target="#modalExample">'.$item->estadoname.'</button>
        </span></td>'; 
    } 
    if($item->siennaestado==3){
      
        echo '<td><span class="badge bg-success">    <button onclick="estado('.$item->ticketid.','.$item->cliente.')"  id="btnAbrirAgregarBien" type="button" class="btn btn-sm btn-success " data-bs-toggle="modal" data-bs-target="#modalExample">'.$item->estadoname.'</button>
        </span></td>'; 
     } 
    if($item->siennaestado==4){
        
        echo '<td><span class="badge bg-danger">    <button onclick="estado('.$item->ticketid.','.$item->cliente.')"  id="btnAbrirAgregarBien" type="button" class="btn btn-sm btn-danger " data-bs-toggle="modal" data-bs-target="#modalExample">'.$item->estadoname.'</button>
        </span></td>';  
    }



    ?>
    <td>
    <button onclick="car(<?php echo $item->ticketid;?>)" id="segui" type="button" class="btn btn-sm btn-info " data-bs-toggle="modal" data-bs-target="#modalExample2"><i class="ri-discuss-line"></i></button>
   

    
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

                           

@include('creative2.footer')