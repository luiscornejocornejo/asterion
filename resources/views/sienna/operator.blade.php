@include('facu.header2')


<script>


let departamentoslista = {!! json_encode($deptos,JSON_FORCE_OBJECT) !!};
let sourcelista = {!! json_encode($source,JSON_FORCE_OBJECT) !!};
let estadoslista = {!! json_encode($estados,JSON_FORCE_OBJECT) !!};


identificadorIntervaloDeTiempo = setInterval(maxid, 5000);


function maxid() {


    var URLactual = window.location.href;

var porciones = URLactual.split('.');

let result = porciones[0].replace("https://", "");

var idusuario =<?php echo session('idusuario');?>;
var area =<?php echo session('areas');?>;


    url = "https://"+result+".suricata.cloud/api/maxid?idusuario=" + idusuario + "&area=" + area + "";
    console.log(url);

    axios.get(url)
    .then(function (response) {
        // función que se ejecutará al recibir una respuesta
        
        
        document.getElementById("tb").innerHTML = null;
        tt = "";
      
        for (i = 0; i < response.data.length; i++) {
            console.log(response.data[i].id);


            im=logo(response.data[i].siennasource);
            colordepto=colordeptof(response.data[i].iddepto);
            colorestado=colorestadof(response.data[i].siennaestado);
            tt += '<tr class="text-center">' +
                ' <td><i class="mdi '+im+' me-1 "></i>' + response.data[i].ticketid + '</td>' +
                ' <td>' + response.data[i].nya + '</td>' +
                ' <td> <span class="badge '+colordepto+'" style="font-size:medium;">' + response.data[i].depto + '</span>'+
                ' <td>' + response.data[i].cel + '</td>' +
                ' <td>' + response.data[i].created_at + '</td>' +
                ' <td> <span class="badge '+colorestado+'" style="font-size:medium;">' + response.data[i].estadoname + '</span>'+

                ' <td>'+
                
                '<button onclick="pedir(`' + response.data[i].ticketid + '`)"  class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#standard-modal-reclamo"><i class="mdi mdi-account-voice"></i> </button> ' +
                '<button onclick="area(`' + response.data[i].ticketid + '`,`' + response.data[i].conversation_id + '`,`' + response.data[i].user_id + '`)"  class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm2"><i class="mdi mdi-account-group"></i> </button>' +
                '<button onclick="estado2(`' + result + '`,`' + response.data[i].ticketid + '`,`' + response.data[i].conversation_id + '`,`' + response.data[i].iddepto + '`)"  class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm"><i class="mdi mdi-flag"></i> </button> ' +

                ' </td>'+

                '<td><button  class="btn btn-outline-secondary rounded" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="mdi mdi-flag"></i></button>' +
                '<button  onclick="vista(`' + response.data[i].conversation_url + '`)" class="btn btn-outline-secondary rounded" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg"><i class="mdi mdi-wechat"></i> </button></td </tr>';

              

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
</script>
 

  <!-- Begin page -->
  <div class="wrapper">

      <!-- ========== Left Sidebar Start ========== -->
      @include('facu.menu')


      <div class="content-page" style="padding: 0!important;">
          <div class="content">

              <!-- Start Content-->
                <div class="container pt-5" id="">
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
                                
                                    <span class="badge <?php echo $bgcolor2;?>" style="font-size:medium;"><?php echo $val->estadoname;?></span>
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