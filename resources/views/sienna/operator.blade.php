@include('facu.header2')

<style>
  thead input {
        width: 100%;
    }
    </style>
<script>


let departamentoslista = {!! json_encode($deptos,JSON_FORCE_OBJECT) !!};
let sourcelista = {!! json_encode($source,JSON_FORCE_OBJECT) !!};
let estadoslista = {!! json_encode($estados,JSON_FORCE_OBJECT) !!};
let iconos = {!! json_encode($iconos,JSON_FORCE_OBJECT) !!};

var frecuencia =<?php echo session('frecuencia');?>;

identificadorIntervaloDeTiempo = setInterval(maxid, frecuencia);

function cerrar(result,dd, ee, ff,cliente){
  document.getElementById("idticketestado20").value = dd;
  document.getElementById("conversation_id20").value = ee;
  document.getElementById("client_number").value = cliente;

  ff
  url = "https://"+result+".suricata.cloud/api/motic?depto=" + ff + "";
    console.log(url);

    axios.get(url)
    .then(function (response) {

      res="<select name='motivoc' class='form-control'>";
      console.log(response.data);
      for (i = 0; i < response.data.length; i++) {
            console.log(response.data[i].nombre);
            res+="<option value='"+response.data[i].id+"'>"+response.data[i].nombre+"</option>";

      }
      res+="</select>";
      document.getElementById("motivoc").innerHTML = null;

        document.getElementById("motivoc").innerHTML = res;

    })
    .catch(function (error) {
        // función para capturar el error
        console.log(error);
    })
    .then(function () {
        // función que siempre se ejecuta
    });
}
function maxid() {


    var URLactual = window.location.href;

    var porciones = URLactual.split('.');

    let result = porciones[0].replace("https://", "");

    var idusuario =<?php echo session('idusuario');?>;
    var area ="<?php echo session('deptosuser');?>";

    function colorprif(idprioridad){
          //alert(id);
          console.log(idprioridad);
            if(idprioridad==3){
              return "badge bg-success";
            }
            if(idprioridad==2){
              return "badge bg-warning";
            }
            if(idprioridad==1){
              return " badge bg-danger";
            }
            return "badge bg-success";

        }
    url = "https://"+result+".suricata.cloud/api/maxid?idusuario=" + idusuario + "&area=" + area + "";
    console.log(url);

    axios.get(url)
    .then(function (response) {
        // función que se ejecutará al recibir una respuesta
         
        

        sd=' <table id="example"  class="table table-striped dt-responsive nowrap w-80 text-light">'+
                        '<thead>'+
                       '     <tr class="text-center bg-dark" >'+
                       '        <th class="text-light"><i></i>Ticket</th>'+
                       '        <th class="text-light">Cliente</th>'+
                       '          <th class="text-light">Area</th>'+
                       '        <th class="text-light">Topic</th>'+
                       '        <th class="text-light">Prioridad</th>'+
                       '        <th class="text-light">Telefono</th>'+
                       '        <th class="text-light">Creado</th>'+
                      
                       '        <th class="text-light">Estado</th>'+
                       '        <th class="text-light">Acciones</th>'+
                       '        '+
                       '    </tr>'+
                       ' </thead>'+
                       ' <tbody id="tb">'+
                       
                       ' </tbody>'+
                       ' </table>';
        
        tt = "";
        for (i = 0; i < response.data.length; i++) {
            console.log(response.data[i].ticketid);
            d="";


            im=logo(response.data[i].siennasource);
            im2=colorlogo(response.data[i].siennasource);
            colordepto=colordeptof(response.data[i].iddepto);
            colorestado=colorestadof(response.data[i].siennaestado);
            colorpri=colorprif(response.data[i].prid);

            if(response.data[i].asignado !='99999'){
                d="d-none";
            }
            if(response.data[i].estadoconv==1){
              aviso='<button onclick="vista(`' + response.data[i].conversation_url + '`,`' + response.data[i].cliente + '`,`' + result + '`)" class="btn btn-primary position-relative" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg">'+
                                       ' <i class="mdi mdi-wechat" data-bs-toggle="tooltip" data-bs-placement="top"'+
                                       ' data-bs-custom-class="mb-1" data-bs-title="El usuario ha enviado un mensaje"></i>'+
                                        '<span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">'+
                                            '<span class="visually-hidden">New alerts</span>'+
                                            '</span>'+
                                    '</button>';
            }else{
              aviso='<button  onclick="vista(`' + response.data[i].conversation_url + '`,`' + response.data[i].cliente + '`,`' + result + '`)" class="btn btn-primary " type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg"><i class="mdi mdi-wechat" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="mb-1" data-bs-title="Conversación."></i> </button>';
            }
            colorestado2=colorestado.replace("bg-", "");
            tt += '<tr class="text-center">' +
                ' <td><a  target=blank href=/ticketunico?tick='+response.data[i].ticketid +'><i class="mdi '+im+'  '+im2+' me-1 "></i>' + response.data[i].ticketid + '</a></td>' +
                ' <td>' + response.data[i].nya + '</td>' +
              
                '<td><span onclick="area(`' + response.data[i].ticketid + '`,`' + response.data[i].conversation_id + '`,`' + response.data[i].user_id + '`)"  class="badge bg-info" style="font-size: medium" role="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm2">'+response.data[i].depto+' </span></td>' +
                '<td><span onclick="topic(`' + result + '`,`' + response.data[i].ticketid + '`,`' + response.data[i].conversation_id + '`,`' + response.data[i].iddepto + '`)"  class="badge badge-info-lighten border" style="font-size: medium" role="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-smtopic"> ' + response.data[i].topicnombre + '</span></td> ' +
                ' <td><span style="font-size:medium;" class="'+colorpri+'">' + response.data[i].pri + '</span></td>' +

         
                ' <td>' + response.data[i].cel + '</td>' +
                ' <td>' + response.data[i].creado + '</td>' +
                '<td> <span onclick="estado2(`' + result + '`,`' + response.data[i].ticketid + '`,`' + response.data[i].conversation_id + '`,`' + response.data[i].iddepto + '`)"  class="badge bg-'+colorestado2+' " style="font-size: medium" role="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm">' + response.data[i].estadoname + ' </span></td> ' +
              
                ' <td>'+
                
                '<button  onclick="pedir(`' + response.data[i].ticketid + '`)"  class="btn btn-info '+d+'" type="button" data-bs-toggle="modal" data-bs-target="#standard-modal-reclamo"><i class="mdi mdi-account-arrow-left" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="" data-bs-title="Reclamar ticket."></i></button> ' +
               '<button onclick="cerrar(`' + result + '`,`' + response.data[i].ticketid + '`,`' + response.data[i].conversation_id + '`,`' + response.data[i].iddepto + '`,`' + response.data[i].cliente + '`)"  class="btn btn-success  " type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-smcerrar">  <i class="mdi mdi-check-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="" data-bs-title="Cambiar cerrar."></i></button> ' +
                '<button  onclick="listadoseguimientos(`' + result + '`,`' + response.data[i].ticketid + '`)"   class="btn btn-secondary me-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="mdi mdi-link" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="mb-1" data-bs-title="Seguimiento."></i></button>' +
                ''+
                '  '+aviso+ ''+

                '<button       class="btn btn-secondary d-none" type="button" data-bs-toggle="modal" data-bs-target="#modalHistory">  <i class="mdi mdi-history" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="mb-1" data-bs-title="Historial."></i>           </button> </td </tr>';

              

        }
        document.getElementById("casa").innerHTML = null;

        document.getElementById("casa").innerHTML = sd;
        document.getElementById("tb").innerHTML = null;

        document.getElementById("tb").innerHTML = tt;
        $('#example').dataTable({
            "order": [[0, 'desc']],
            "pageLength": 25,
  "language" : {
    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
  },
  dom: 'Bfrtip',
  initComplete: function () {
            var api = this.api();
 
            // For each column
          
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input size="10" type="text" placeholder="' + title + '" />');
 
                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('change', function (e) {
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
                        })
                        .on('keyup', function (e) {
                            e.stopPropagation();
 
                            $(this).trigger('change');
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
  });
  $('#example thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#example thead');


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


function topic(result,dd, ee, ff) {

  document.getElementById("idticketestado3").value = dd;




  url = "https://"+result+".suricata.cloud/api/topicxdepto?depto=" + ff;
  axios.get(url)
  .then(function (response) {
    // función que se ejecutará al recibir una respuesta
    console.log(response.data);

    dato = "";
    for (i = 0; i < response.data.length; i++) {
        console.log(response.data[i].id);
        console.log(response.data[i].nombre);


        dato += ' <div class="mt-3">' +

            '<div class="form-check mb-2">' +
            ' <input type="radio" id="customRadio' + response.data[i].id + '" name="estado" value="' + response.data[i].id + '"  class="form-check-input">' +

            '<label class="form-check-label" for="customRadio' + response.data[i].id + '">' + response.data[i].nombre + '</label>' +
            '</div>' +

            ' </div>';


    }
    document.getElementById("estunico2").innerHTML = dato;



  })
  .catch(function (error) {
      // función para capturar el error
      console.log(error);
  })
  .then(function () {
      // función que siempre se ejecuta
  });


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
              @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade
                            show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
                <div class="container-fluid pt-2" id="casa"  >
                   
                    
                                                     
                </div>
                <div class="floating-button">
                    <button id="main-button" class="bg-primary text-light" onclick="toggleRotation(); toggleMenu()">
                    <span class="mdi mdi-plus"></span>
                    </button>
                    <div id="menu" class="hidden">
                    <button  id="button-2" class="mdi mdi-ticket-account bg-warning text-light" data-bs-toggle="modal" href="#exampleModalToggle" >
                    <button id="button-3" class="mdi mdi-send bg-success text-light " href="#warning-alert-modal" data-bs-toggle="modal"></button>
                    </div>
                </div>
              <!-- container -->
          </div>
          <!-- content -->
      </div>
      <!-- Modal of conversation-->
      @include('sienna.ticketsmodals.conversacion')        
      @include('sienna.ticketsmodals.estados')
      @include('sienna.ticketsmodals.topic')

      @include('sienna.ticketsmodals.departamentosagente')
      @include('sienna.ticketsmodals.pedir')
      @include('sienna.ticketsmodals.seguimientos')
      @include('sienna.ticketsmodals.historialtickets')
      @include('sienna.ticketsmodals.cerrar')
      @include('sienna.flotantes.creartickets')
      @include('sienna.flotantes.crearticketsnc')
      @include('sienna.flotantes.salientes')
      

    </div>
  <!-- END wrapper -->

  @include('facu.footer')