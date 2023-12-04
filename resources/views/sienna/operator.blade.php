@include('facu.header2')


<script>


let departamentoslista = {!! json_encode($deptos,JSON_FORCE_OBJECT) !!};
let sourcelista = {!! json_encode($source,JSON_FORCE_OBJECT) !!};
let estadoslista = {!! json_encode($estados,JSON_FORCE_OBJECT) !!};
let iconos = {!! json_encode($iconos,JSON_FORCE_OBJECT) !!};


identificadorIntervaloDeTiempo = setInterval(maxid, 6000);


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
         
        sd=' <table id="tbListingsDE" class="table dt-responsive nowrap w-100 text-light">'+
                        '<thead>'+
                       '     <tr class="text-center bg-dark" >'+
                       '        <th class="text-light"><i></i>Ticket</th>'+
                       '        <th class="text-light">Cliente</th>'+
                       '          <th class="text-light">Area</th>'+
                       '        <th class="text-light">Telefono</th>'+
                       '        <th class="text-light">Creado</th>'+
                       '        <th class="text-light">Estado</th>'+
                       '        <th class="text-light">Acciones</th>'+
                       '        <th class="text-light">Historial</th>'+
                       '    </tr>'+
                       ' </thead>'+
                       ' <tbody id="tb">'+
                       
                       ' </tbody>'+
                       ' </table>';
        
        tt = "";
        for (i = 0; i < response.data.length; i++) {
            console.log(response.data[i].id);
            d="";


            im=logo(response.data[i].siennasource);
            im2=colorlogo(response.data[i].siennasource);
            colordepto=colordeptof(response.data[i].iddepto);
            colorestado=colorestadof(response.data[i].siennaestado);
            if(response.data[i].asignado !='99999'){
                d="disabled";
            }
            tt += '<tr class="text-center">' +
                ' <td><i class="mdi '+im+'  '+im2+' me-1 "></i>' + response.data[i].ticketid + '</td>' +
                ' <td>' + response.data[i].nya + '</td>' +
                ' <td> <span class="badge '+colordepto+'" style="font-size:medium;">' + response.data[i].depto + '</span>'+
                ' <td>' + response.data[i].cel + '</td>' +
                ' <td>' + response.data[i].created_at + '</td>' +
                ' <td> <span class="badge '+colorestado+'" style="font-size:medium;">' + response.data[i].estadoname + '</span>'+

                ' <td>'+
                
                '<button '+d+' onclick="pedir(`' + response.data[i].ticketid + '`)"  class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#standard-modal-reclamo"><i class="mdi mdi-account-voice" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="mb-1" data-bs-title="Reclamar ticket."></i></button> ' +
                '<button onclick="area(`' + response.data[i].ticketid + '`,`' + response.data[i].conversation_id + '`,`' + response.data[i].user_id + '`)"  class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm2"><i class="mdi mdi-account-group" data-bs-toggle="tooltip" data-bs-placement="top"     data-bs-custom-class="mb-1" data-bs-title="Asignar departamento."></i> </button>' +
                '<button onclick="estado2(`' + result + '`,`' + response.data[i].ticketid + '`,`' + response.data[i].conversation_id + '`,`' + response.data[i].iddepto + '`)"  class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm"><i class="mdi mdi-flag" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="mb-1" data-bs-title="Cambiar estado."></i> </button> ' +

                ' </td>'+
 
                '<td><button  onclick="listadoseguimientos(`' + result + '`,`' + response.data[i].ticketid + '`)"   class="btn btn-outline-secondary rounded" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="mdi mdi-link" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="mb-1" data-bs-title="Seguimiento."></i></button>' +
                '<button  onclick="vista(`' + response.data[i].conversation_url + '`)" class="btn btn-outline-secondary rounded" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg"><i class="mdi mdi-wechat" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="mb-1" data-bs-title="Conversación."></i> </button>'+
                '<button       class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#modalHistory">  <i class="mdi mdi-history" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="mb-1" data-bs-title="Historial."></i>           </button> </td </tr>';

              

        }
        document.getElementById("casa").innerHTML = null;

        document.getElementById("casa").innerHTML = sd;
        document.getElementById("tb").innerHTML = null;

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

function coloriconos(id){
    coloricono="";
    for (var listado2 in iconos){
        if(iconos[listado2]["id"]==id){
            coloricono=iconos[listado2]["descripcion"];
        }
    }
    return coloricono;
}

function listadoseguimientos(result,dd) {

document.getElementById("idticketseguimiento").value = dd;




url = "https://"+result+".suricata.cloud/api/listadoseguimientos?ticket=" + dd;
axios.get(url)
.then(function (response) {
    // función que se ejecutará al recibir una respuesta
    console.log(response.data);
    document.getElementById("seguimientounico").innerHTML = null;

    dato = "";
    for (i = 0; i < response.data.length; i++) {
        console.log(response.data[i].id);
        console.log(response.data[i].descripcion);
        console.log(response.data[i].autor);
        console.log(response.data[i].created_at);
        console.log(response.data[i].tipo);

       coloreicono= coloriconos(response.data[i].tipo);

        dato += ' <div class="timeline-item">'+
                coloreicono+
                '<div class="timeline-item-info">'+
                '<span class="text-info fw-bold mb-1 d-block">'+response.data[i].descripcion+'</span>'+
                '<small>'+response.data[i].autor+'</small>'+
                '<p class="mb-0 pb-2">'+
                '<small class="text-muted">'+response.data[i].created_at+'</small>'+
                '</p> </div> </div>';
                                            
                                            
                                


    }
    document.getElementById("seguimientounico").innerHTML = dato;



})
.catch(function (error) {
    // función para capturar el error
    console.log(error);
})
.then(function () {
    // función que siempre se ejecuta
});


}
</script>
 

  <!-- Begin page -->
  <div class="wrapper" >

      <!-- ========== Left Sidebar Start ========== -->
      @include('facu.menu')


      <div class="content-page" style="padding: 0!important;">
          <div class="content">

              <!-- Start Content-->
                <div class="container-fluid pt-2" id="casa">
                   
                    
                                                     
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
      @include('sienna.ticketsmodals.historialtickets')
      

    </div>
  <!-- END wrapper -->

  @include('facu.footer')