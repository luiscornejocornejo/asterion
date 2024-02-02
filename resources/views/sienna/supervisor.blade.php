@include('facu.header2')

<script type="text/javascript">
    /*
    (function(document) {
      'use strict';

      var LightTableFilter = (function(Arr) {

        var _input;

        function _onInputEvent(e) {
          _input = e.target;
          var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
          Arr.forEach.call(tables, function(table) {
            Arr.forEach.call(table.tBodies, function(tbody) {
              Arr.forEach.call(tbody.rows, _filter);
            });
          });
        }

        function _filter(row) {
          var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
          row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
        }
        return {
          init: function() {
            var inputs = document.getElementsByClassName('light-table-filter');
            Arr.forEach.call(inputs, function(input) {
              input.oninput = _onInputEvent;
            });
          }
        };
      })(Array.prototype);

      document.addEventListener('readystatechange', function() {
        if (document.readyState === 'complete') {
          LightTableFilter.init();
        }
      });

    })(document);*/


    </script>
<script>


let departamentoslista = {!! json_encode($deptos,JSON_FORCE_OBJECT) !!};
let sourcelista = {!! json_encode($source,JSON_FORCE_OBJECT) !!};
let estadoslista = {!! json_encode($estados,JSON_FORCE_OBJECT) !!};
let iconos = {!! json_encode($iconos,JSON_FORCE_OBJECT) !!};
let usersmerchant = {!! json_encode($usersmerchant,JSON_FORCE_OBJECT) !!};



var frecuencia =<?php echo session('frecuencia');?>;

//identificadorIntervaloDeTiempo = setInterval(maxid, frecuencia);
function pedir2(dd) {

document.getElementById("idticketpedir2").value = dd;



}

function cerrar(result,dd, ee, ff,cliente){
  alert(cliente);
  document.getElementById("idticketestado20").value = dd;
    document.getElementById("conversation_id20").value = ee;
}
function maxid() {


    var URLactual = window.location.href;

    var porciones = URLactual.split('.');

    let result = porciones[0].replace("https://", "");

    var idusuario =<?php echo session('idusuario');?>;
    var area =<?php echo session('areas');?>;


    url = "https://"+result+".suricata.cloud/api/maxid2?idusuario=" + idusuario + "&area=" + area + "";
    console.log(url);

    axios.get(url)
    .then(function (response) {
        // función que se ejecutará al recibir una respuesta
         
        

        sd=' <table id="example"  class="table table-striped dt-responsive nowrap w-100 text-light">'+
                        '<thead>'+
                       '     <tr class="text-center bg-dark" >'+
                       '        <th class="text-light"><i></i>Ticket</th>'+
                       '        <th class="text-light">Cliente</th>'+
                       '        <th class="text-light">Asignado</th>'+
                       '          <th class="text-light">Area</th>'+
                       '        <th class="text-light">Topic</th>'+
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
            if(response.data[i].estadoconv==1){
              aviso='<button onclick="vista(`' + response.data[i].conversation_url + '`,`' + response.data[i].cliente + '`,`' + result + '`)" class="btn btn-primary position-relative" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg">'+
                                       ' <i class="mdi mdi-wechat" data-bs-toggle="tooltip" data-bs-placement="top"'+
                                       ' data-bs-custom-class="mb-1" data-bs-title="El usuario ha enviado un mensaje"></i>'+
                                        '<span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">'+
                                            '<span class="visually-hidden">New alerts</span>'+
                                            '</span>'+
                                    '</button>';
            }else{
              aviso='<button  onclick="vista(`' + response.data[i].conversation_url + '`,`' + response.data[i].cliente + '`,`' + result + '`)" class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg"><i class="mdi mdi-wechat" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="mb-1" data-bs-title="Conversación."></i> </button>';
            }

            if(response.data[i].nombreagente ==null){
              $nombreamostrar="sin asignar";
            }else{
              $nombreamostrar=response.data[i].nombreagente ;
            }
          
            tt += '<tr class="text-center">' +
                ' <td><i class="mdi '+im+'  '+im2+' me-1 "></i>' + response.data[i].ticketid + '</td>' +
                ' <td>' + response.data[i].nya + '</td>' + 
                ' <td>' + $nombreamostrar+ '</td>' + 
                ' <td> <span class="badge '+colordepto+'" style="font-size:medium;">' + response.data[i].depto + '</span>'+
                ' <td>' + response.data[i].topicnombre + '</td>' +
                ' <td>' + response.data[i].cel + '</td>' +
                ' <td>' + response.data[i].creado + '</td>' +
              
                ' <td> <span class="badge '+colorestado+'" style="font-size:medium;">' + response.data[i].estadoname + '</span>'+

                ' <td>'+
                
                '<button  onclick="pedir2(`' + response.data[i].ticketid + '`)"  class="btn btn-info'+d+'" type="button" data-bs-toggle="modal" data-bs-target="#standard-modal-reclamo"><i class="mdi mdi-account-arrow-left" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="" data-bs-title="Reclamar ticket."></i></button> ' +
                '<button onclick="area(`' + response.data[i].ticketid + '`,`' + response.data[i].conversation_id + '`,`' + response.data[i].user_id + '`)"  class="btn btn-info " type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm2"><i class="mdi mdi-account-group" data-bs-toggle="tooltip" data-bs-placement="top"     data-bs-custom-class="" data-bs-title="Asignar departamento."></i> </button>' +
                '<button onclick="estado2(`' + result + '`,`' + response.data[i].ticketid + '`,`' + response.data[i].conversation_id + '`,`' + response.data[i].iddepto + '`)"  class="btn btn-secondary " type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm"><i class="mdi mdi-flag" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="" data-bs-title="Cambiar estado."></i> </button> ' +
                '<button onclick="topic(`' + result + '`,`' + response.data[i].ticketid + '`,`' + response.data[i].conversation_id + '`,`' + response.data[i].iddepto + '`)"  class="btn btn-info " type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-smtopic">  <i class="mdi mdi-notebook" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="" data-bs-title="Cambiar topic."></i></button> ' +
                '<button onclick="cerrar(`' + result + '`,`' + response.data[i].ticketid + '`,`' + response.data[i].conversation_id + '`,`' + response.data[i].iddepto + '`,`' + response.data[i].cliente + '`)"  class="btn btn-success  " type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-smcerrar">  <i class="mdi mdi-check-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="" data-bs-title="Cambiar cerrar."></i></button> ' +

                ' '+
 
                '<button  onclick="listadoseguimientos(`' + result + '`,`' + response.data[i].ticketid + '`)"   class="btn btn-secondary " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="mdi mdi-link" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="mb-1" data-bs-title="Seguimiento."></i></button>' +
                ''+
                '  '+aviso+ ''+
                '<button       class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#modalHistory">  <i class="mdi mdi-history" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="mb-1" data-bs-title="Historial."></i>           </button> </td </tr>';

              

        }
        document.getElementById("casa").innerHTML = null;

        document.getElementById("casa").innerHTML = sd;
        document.getElementById("tb").innerHTML = null;

        document.getElementById("tb").innerHTML = tt;
        $('#example').dataTable({
            "order": [[0, 'desc']],
  "language" : {
    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
  }
});



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
            
                <div class="container-fluid pt-2" id="casa">
                   
                    
                                                     
                </div>
               
              <!-- container -->
          </div>
          <!-- content -->
      </div>
      <!-- Modal of conversation-->
      @include('sienna.ticketsmodals.conversacion')        
      @include('sienna.ticketsmodals.estados')
      @include('sienna.ticketsmodals.topic')

      @include('sienna.ticketsmodals.departamentos')
      @include('sienna.ticketsmodals.pedir2')
      @include('sienna.ticketsmodals.seguimientos')
      @include('sienna.ticketsmodals.historialtickets')
      @include('sienna.ticketsmodals.cerrar')
      

    </div>
  <!-- END wrapper -->

  @include('facu.footer')