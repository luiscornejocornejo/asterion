@include('pp.header')
<?php

use Illuminate\Support\Facades\DB;


?>
<script type="text/javascript">
  // search cards from projects
  $("#search_input_card").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".list_crew_view .col-md-4").filter(function() {
      $(this).find('.mb-3').toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });


  function borrar(x) {


    document.getElementById("idregistro").value = x;
  }

  function datos(idbase,dias,idcontrato,start_date_contract,finish_date_contract,start_afip,finish_afip,salariobruto,hour_initial,hour_end,is_reemplazo,active,id_workday) {

    var idbase2 = document.getElementById('idbase');

    var resultado = document.getElementById('pp23');
    var diashtml = document.getElementById('dias');
    var start_date_contract_html = document.getElementById('start_date_contract');
    var finish_date_contract_html = document.getElementById('finish_date_contract');

    var start_afip_html = document.getElementById('start_afip');
    var finish_afip_html = document.getElementById('finish_afip');

    var id_contract_html = document.getElementById('id_contract');
    var id_modalidad_html = document.getElementById('modalidad');
    var id_aceptado_html = document.getElementById('aceptado');

    var id_reemplazo_html = document.getElementById('reemplazo');


    var horainicio_html = document.getElementById('horainicio');
    var horafinal_html = document.getElementById('horafinal');
    horainicio_html.value = hour_initial;
    horafinal_html.value = hour_end;

    
    
    hour_initial
    globalThis.salariobrutoglobal = salariobruto;


    id_contract_html.selectedIndex = idcontrato;
    id_modalidad_html.selectedIndex = id_workday;
    id_aceptado_html.selectedIndex = active;
    id_reemplazo_html.selectedIndex = is_reemplazo;


    idbase2.value=idbase;

    resultado.textContent = idbase;
    diashtml.value = dias;
    start_date_contract_html.value = start_date_contract;
    finish_date_contract_html.value = finish_date_contract;

    start_afip_html.value = start_afip;
    finish_afip_html.value = finish_afip;


    

  }


  function exportTableToExcel(tableID, filename = '') {
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

    // Specify file name
    filename = filename ? filename + '.xls' : 'excel_data.xls';

    // Create download link element
    downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);

    if (navigator.msSaveOrOpenBlob) {
      var blob = new Blob(['ufeff', tableHTML], {
        type: dataType
      });
      navigator.msSaveOrOpenBlob(blob, filename);
    } else {
      // Create a link to the file
      downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

      // Setting the file name
      downloadLink.download = filename;

      //triggering the function
      downloadLink.click();
    }
  }

  function borrar(x) {


    document.getElementById("idregistro").value = x;
  }

  function horasextras(arrayhoras){

    console.log(listadodehorasextras);
    let valor="";
    let filtrados=[];
      for (var listado2 in listadodehorasextras){
        let usuario=listadodehorasextras[listado2]["usuario"];
        if(arrayhoras==usuario){

          let filtradousu=[listadodehorasextras[listado2]["fechadesde"],listadodehorasextras[listado2]["funcion"],listadodehorasextras[listado2]["last_name"],listadodehorasextras[listado2]["horafinal"],listadodehorasextras[listado2]["horainicio"],listadodehorasextras[listado2]["id"]];
          filtrados.push(filtradousu);
        

        }

    }
    console.log(filtrados);
    let tabla=document.getElementById('datatable2');
    //var tblBody = document.getElementById("elbody");
    tabla.innerHTML = "";
    var tblthead= document.createElement("thead");
var hilera = document.createElement("tr");
var celda = document.createElement("th");
var textoCelda = document.createTextNode("id");
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("th");
var textoCelda = document.createTextNode("nombre");
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("th");
var textoCelda = document.createTextNode("fecha");
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("th");
var textoCelda = document.createTextNode("hora I");
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("th");
var textoCelda = document.createTextNode("hora F");
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("th");
var textoCelda = document.createTextNode("Puesto");
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  tblthead.appendChild(hilera);
  tabla.appendChild(tblthead);
    var tblBody = document.createElement("tbody");

    for (var listado3 in filtrados){
      var hilera = document.createElement("tr");

      var celda = document.createElement("td");
      var textoCelda = document.createTextNode(filtrados[listado3][5] );
      celda.appendChild(textoCelda);
      hilera.appendChild(celda);

      var celda = document.createElement("td");
      var textoCelda = document.createTextNode(filtrados[listado3][2] );
      celda.appendChild(textoCelda);
      hilera.appendChild(celda);

      var celda = document.createElement("td");
      var textoCelda = document.createTextNode(filtrados[listado3][0] );
      celda.appendChild(textoCelda);
      hilera.appendChild(celda);

      var celda = document.createElement("td");
      var textoCelda = document.createTextNode(filtrados[listado3][4] );
      celda.appendChild(textoCelda);
      hilera.appendChild(celda);

      var celda = document.createElement("td");
      var textoCelda = document.createTextNode(filtrados[listado3][3] );
      celda.appendChild(textoCelda);
      hilera.appendChild(celda);

      var celda = document.createElement("td");
      var textoCelda = document.createTextNode(filtrados[listado3][1] );
      celda.appendChild(textoCelda);
      hilera.appendChild(celda);


      var celda = document.createElement("td");
      var textoCelda = document.createElement('INPUT');
      textoCelda.setAttribute("type","checkbox");
      textoCelda.setAttribute("name","genero[]");
      textoCelda.innerHTML = 'Eliminar';
      textoCelda.id=filtrados[listado3][5];
      textoCelda.value=filtrados[listado3][5];


      celda.appendChild(textoCelda);
      hilera.appendChild(celda);
      tblBody.appendChild(hilera);

    }
    tabla.appendChild(tblBody);
}



function ausencias(arrayhoras){

console.log(listaausencias);
let valor="";
let filtrados=[];
  for (var listado2 in listaausencias){
    let usuario=listaausencias[listado2]["usuario"];
    if(arrayhoras==usuario){
      let filtradousu=[listaausencias[listado2]["fechadesde"],listaausencias[listado2]["funcion"],listaausencias[listado2]["last_name"],listaausencias[listado2]["motivo"],listaausencias[listado2]["nota"],listaausencias[listado2]["id"]];
      filtrados.push(filtradousu);
    }

}
console.log(filtrados);
let tabla=document.getElementById('datatable4');
tabla.innerHTML = "";

var tblthead= document.createElement("thead");
var hilera = document.createElement("tr");
var celda = document.createElement("th");
var textoCelda = document.createTextNode("id");
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("th");
var textoCelda = document.createTextNode("nombre");
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("th");
var textoCelda = document.createTextNode("puesto");
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("th");
var textoCelda = document.createTextNode("fecha");
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("th");
var textoCelda = document.createTextNode("motivo");
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("th");
var textoCelda = document.createTextNode("nota");
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  tblthead.appendChild(hilera);
  tabla.appendChild(tblthead);


var tblBody = document.createElement("tbody");
for (var listado4 in filtrados){
  var hilera = document.createElement("tr");
  var celda = document.createElement("td");
  var textoCelda = document.createTextNode(filtrados[listado4][5] );
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);

  var celda = document.createElement("td");
  var textoCelda = document.createTextNode(filtrados[listado4][2] );
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);

  var celda = document.createElement("td");
  var textoCelda = document.createTextNode(filtrados[listado4][1] );
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("td");
  var textoCelda = document.createTextNode(filtrados[listado4][0] );
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("td");
  var textoCelda = document.createTextNode(filtrados[listado4][3] );
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("td");
  var textoCelda = document.createTextNode(filtrados[listado4][4] );
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("td");
  var textoCelda = document.createElement('INPUT');
  textoCelda.setAttribute("type","checkbox");
  textoCelda.setAttribute("name","genero[]");


  textoCelda.innerHTML = 'Eliminar';
  textoCelda.value=filtrados[listado4][5];
  textoCelda.id=filtrados[listado4][5];
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  tblBody.appendChild(hilera);

}

tabla.appendChild(tblBody);
}


function vacaciones(arrayhoras){

console.log(listavacacioness);
let valor="";
let filtrados=[];
  for (var listado2 in listavacacioness){
    let usuario=listavacacioness[listado2]["usuario"];
    if(arrayhoras==usuario){
      let filtradousu=[listavacacioness[listado2]["fechadesde"],listavacacioness[listado2]["funcion"],listavacacioness[listado2]["last_name"],listavacacioness[listado2]["motivo"],listavacacioness[listado2]["nota"],listavacacioness[listado2]["id"]];
      filtrados.push(filtradousu);
    }

}
console.log(filtrados);
let tabla=document.getElementById('datatablevacaciones');
tabla.innerHTML = "";
var tblthead= document.createElement("thead");
var hilera = document.createElement("tr");
var celda = document.createElement("th");
var textoCelda = document.createTextNode("id");
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("th");
var textoCelda = document.createTextNode("nombre");
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("th");
var textoCelda = document.createTextNode("puesto");
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("th");
var textoCelda = document.createTextNode("fecha");
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("th");
var textoCelda = document.createTextNode("motivo");
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("th");
var textoCelda = document.createTextNode("nota");
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  tblthead.appendChild(hilera);
  tabla.appendChild(tblthead);
var tblBody = document.createElement("tbody");
for (var listado5 in filtrados){
  var hilera = document.createElement("tr");

  var celda = document.createElement("td");
      var textoCelda = document.createTextNode(filtrados[listado5][5] );
      celda.appendChild(textoCelda);
      hilera.appendChild(celda);
  var celda = document.createElement("td");
  var textoCelda = document.createTextNode(filtrados[listado5][2] );
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("td");
  var textoCelda = document.createTextNode(filtrados[listado5][1] );
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("td");
  var textoCelda = document.createTextNode(filtrados[listado5][0] );
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("td");
  var textoCelda = document.createTextNode(filtrados[listado5][3] );
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("td");
  var textoCelda = document.createTextNode(filtrados[listado5][4] );
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("td");
  var textoCelda = document.createElement('INPUT');
  textoCelda.setAttribute("type","checkbox");
  textoCelda.setAttribute("name","genero[]");  textoCelda.innerHTML = 'Eliminar';
  textoCelda.value=filtrados[listado5][5];
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  tblBody.appendChild(hilera);

}

tabla.appendChild(tblBody);
}

function feriados(arrayhoras){

console.log(listaaferiados);
let valor="";
let filtrados=[];
  for (var listado2 in listaaferiados){
    let usuario=listaaferiados[listado2]["usuario"];
    if(arrayhoras==usuario){
      let filtradousu=[listaaferiados[listado2]["fechadesde"],listaaferiados[listado2]["funcion"],listaaferiados[listado2]["last_name"],listaaferiados[listado2]["motivo"],listaaferiados[listado2]["nota"],listaaferiados[listado2]["id"]];
      filtrados.push(filtradousu);
    }

}
console.log(filtrados);
let tabla=document.getElementById('datatableferiados');
tabla.innerHTML = "";
var tblthead= document.createElement("thead");
var hilera = document.createElement("tr");
var celda = document.createElement("th");
var textoCelda = document.createTextNode("id");
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("th");
var textoCelda = document.createTextNode("nombre");
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("th");
var textoCelda = document.createTextNode("puesto");
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("th");
var textoCelda = document.createTextNode("fecha");
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("th");
var textoCelda = document.createTextNode("motivo");
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("th");
var textoCelda = document.createTextNode("nota");
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  tblthead.appendChild(hilera);
  tabla.appendChild(tblthead);
var tblBody = document.createElement("tbody");
for (var listado6 in filtrados){
      var hilera = document.createElement("tr");
      var celda = document.createElement("td");
      var textoCelda = document.createTextNode(filtrados[listado6][5] );
      celda.appendChild(textoCelda);
      hilera.appendChild(celda);

  var celda = document.createElement("td");
  var textoCelda = document.createTextNode(filtrados[listado6][2] );
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("td");
  var textoCelda = document.createTextNode(filtrados[listado6][1] );
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("td");
  var textoCelda = document.createTextNode(filtrados[listado6][0] );
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("td");
  var textoCelda = document.createTextNode(filtrados[listado6][3] );
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("td");
  var textoCelda = document.createTextNode(filtrados[listado6][4] );
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  var celda = document.createElement("td");
  var textoCelda = document.createElement('INPUT');
  textoCelda.setAttribute("type","checkbox");
  textoCelda.setAttribute("name","genero[]");
    textoCelda.innerHTML = 'Eliminar';
  textoCelda.value=filtrados[listado6][5];
  celda.appendChild(textoCelda);
  hilera.appendChild(celda);
  tblBody.appendChild(hilera);

}

tabla.appendChild(tblBody);
}
</script>

<body id="page-top">

  <!-- Page Wrapper -->



  </div>
  <div class="mx-auto" style="width: 1000px;margin-top: 70px;">

    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade
                            show" role="alert">
                            {{ $message }}
                            <button type="button" class="btn-close"
                                data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

    @endif

    <!-- Page Wrapper -->
    <div id="wrapper">
      <h3>
        
      
      <a  class="btn btn-primary"  href="/busqueda?id_project={{ $idproyect }}">Nuevo</a></h3>
      <h5 class="info-text" id="ancla_list_crew_view"> Lista de Team </h5>

      <div class="form-group">
        <div class="col-md-6">
          <input type="search" placeholder="Buscar Team" id="search_input_card" class="form-control" />
        </div>
        <div class="col-md-6"></div>
      </div>

      <div class="row justify-content-center list_crew_view" style="margin-top: 22px;">
        @foreach($lista as $list)

        <div class="col-md-4 d-flex group-more-team" data-hasreemplazo="{{ $list->id_function_frame }}" data-idprovider="{{ $list->id_function_frame }}" id="{{ $list->id_function_frame }}">
          <div class="card mb-3">
            <div class="card-header card-section-color edit-text-function_frame">
              {{ $list->nombreusu }}  {{ $list->apellido }}
            </div>
            <div class="card-body">
              <h4 class="card-title">{{ $list->nombreframe }}</h4>
              <?php $inicio = substr($list->start_date_contract, 0, 10);
              $fin = substr($list->finish_date_contract, 0, 10);
              if ($list->is_reemplazo == 1) {
                $titular = "TITULAR";
              } else {

                $titular = "SUPLENTE";
              }
              ?>

<?php

$arrayhoras = [];
foreach ( $listahoras as $v ) {        
        if ( $v->usuario ==$list->idusuario ) {
                $arrayhoras2 = ['usuario'=>$v->usuario,'fechadesde'=>$v->fechadesde,'fechahasta'=>$v->fechahasta,'id'=>$v->id,'horainicio'=>$v->horainicio];
                array_push($arrayhoras, $arrayhoras2);

        }
}

?>
              <p class="card-text mb-2 edit-text-dates">Fechas: {{ $inicio }} A {{ $fin }}</p>
              <p class="card-text mb-2 edit-text-contract">Contrato: {{ $list->contrato }}</p>
              <p class="card-text mb-2 edit-text-total_workdays">Sueldo en Mano: ${{ $list->total_workdays }}</p>
            </div>
            <div class="card-footer card-footer-project pt-0">

            <div class="row mt-4">
                
                  <?php if($list->start_date_contract==""){
$disabled="disabled";
                  }else{
?><div class="col-md-4">
              <a  href="/pdfcontratos?idusuario=<?php echo $list->idusuario;?>&idproyect=<?php echo $idproyect;?>" target="_blank"  class="btn btn-outline-info waves-effect waves-light" title="Descargar Contrato">Contrato</a>
              </div>
              <div class="col-md-4"> 
                                <a href="/pdfrelease?idusuario=<?php echo $list->idusuario;?>&idproyect=<?php echo $idproyect;?>" target="_blank" class="btn btn-outline-info waves-effect waves-light" title="Descargar Release"> Release</a>
              </div>
<?php
                  }?>
           
               
              <div class="col-md-4"> 
              <button onClick="ausencias('<?php echo $list->idusuario;?>')"  class="btn btn-outline-info waves-effect waves-light" title="Ausencias" type="button"  data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg-A">Ausencias</button>

              </div>
            </div>
            <div class="row mt-4">

            <div class="col-md-4">
            <button onClick="feriados('<?php echo $list->idusuario;?>')"  class="btn btn-outline-info waves-effect waves-light" title="feriados" type="button"  data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg-F">Feriados</button>


            </div>
            <div class="col-md-4">
            <button onClick="horasextras('<?php echo $list->idusuario;?>')"  class="btn btn-outline-info waves-effect waves-light" title="extras" type="button"  data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg-H"> Extras</button>

            </div>
            <div class="col-md-4">
            <button onClick="vacaciones('<?php echo $list->idusuario;?>')"  class="btn btn-outline-info waves-effect waves-light" title="vacaciones" type="button"  data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg-V">Vacaciones</button>

            </div>
            </div>
            <div class="row mt-4">
  <div class="col-md-6">
  <button title="Eliminar" type="button" 
              onclick="borrar(<?php echo $list->idborrar; ?>)" 
              class="btn btn-danger btn-lg btn-block " data-bs-toggle="modal" data-bs-target=".bs-example-modal-center"><i class="bx bxs-user-x"></i></button>

  </div>
  <div class="col-md-6">
  <button 
                onClick="datos('<?php echo $list->id; ?>','<?php echo $list->count_workdays_crew;?>','<?php echo $list->idcontrato; ?>','<?php echo $list->start_date_contract; ?>','<?php echo $list->finish_date_contract; ?>','<?php echo $list->start_afip; ?>','<?php echo $list->finish_afip; ?>','<?php echo $list->sueldo_bruto; ?>','<?php echo $list->hour_initial; ?>','<?php echo $list->hour_end; ?>','<?php echo $list->is_reemplazo; ?>','<?php echo $list->active; ?>','<?php echo $list->id_workday; ?>')" 
                type="button" class="btn btn-primary btn-lg btn-block " data-bs-toggle="modal" id='editar<?php echo $list->id; ?>' data-bs-target="#firstmodal">Editar</button>

  </div>
</div>



              @if($list->id_function_frame == '1' || $list->id_function_frame == 1)
              {{-- <a href="javascript:void(0)" class="btn btn-link btn-warning btn-just-icon edit add-hour-extras" data-id="{{ $list->id_function_frame }}" data-nameteam="{{ $list->id_function_frame }}" title="Agregar Horas Extras"><i class="bx bxs-edit"></i></a> --}}
              @endif

              <div class="col-lg-6">
           
              
                <!-- First modal dialog -->
                @include('pp.pp2')
              </div><!-- end col -->
            </div><!-- end row -->
          </div>
        </div>
       

        @endforeach
      </div>

    </div>
  </div>
  <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Eliminar</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Esta seguro que quiere borrar el registro de la tabla project_providers </p>
          <form method="post" action="eliminar">

            <input type="hidden" name="tabla" id="tabla" value="frameproject_providers">
            <input type="hidden" name="idregistro" id="idregistro">
            @csrf
            <button type="submit" class="btn btn-danger">Eliminar</button>
          </form>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <div class="modal fade bs-example-modal-lg-H" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Horas Extras</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form method="post" action="eliminar2">
        @csrf

        <div class="table-responsive">
                            
                            <table id="datatable2" class="table table-bordered
                            dt-responsive nowrap w-100"><thead>
                              <tr>
                                    <th>nombre</th>
                                    <th>fecha</th>
                                    <th>horainicio</th>
                                    <th>horafinal</th>
                                    <th>funcion</th>
                                    <th>Eliminar</th>
                              </tr>
                                    </thead>
                             


                            </table>
        </div>

        <input type="hidden" name="tabla" id="tabla" value="eventos">

        <button type="submit" class="btn btn-danger">Eliminar</button>

        </form>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <div class="modal fade bs-example-modal-lg-A" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ausencias</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="table-responsive">
        <form method="post" action="eliminar2">
        @csrf
       
                            <table id="datatable4" class="table table-bordered
                            dt-responsive nowrap w-100">
                             


                            </table>
                            <input type="hidden" name="tabla" id="tabla" value="eventos">

        <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
        </div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <div class="modal fade bs-example-modal-lg-V" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Vacaciones</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="table-responsive">
        <form method="post" action="eliminar2">
        @csrf        
                            <table id="datatablevacaciones" class="table table-bordered
                            dt-responsive nowrap w-100"><thead>
                              <tr>
                                    <th>nombre</th>
                                    <th>fecha</th>
                                    <th>horainicio</th>
                                    <th>horafinal</th>
                                    <th>funcion</th>
                                    <th>Eliminar</th>
                              </tr>
                                    </thead>
                             


                            </table>
                            <input type="hidden" name="tabla" id="tabla" value="eventos">

<button type="submit" class="btn btn-danger">Eliminar</button>
</form>
        </div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <div class="modal fade bs-example-modal-lg-F" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Feriados</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="table-responsive">
        <form method="post" action="eliminar2">
        @csrf           
                            <table id="datatableferiados" class="table table-bordered
                            dt-responsive nowrap w-100"><thead>
                              <tr>
                                    <th>nombre</th>
                                    <th>fecha</th>
                                    <th>horainicio</th>
                                    <th>horafinal</th>
                                    <th>funcion</th>
                                    <th>Eliminar</th>
                              </tr>
                                    </thead>
                             


                            </table>

                            <input type="hidden" name="tabla" id="tabla" value="eventos">

<button type="submit" class="btn btn-danger">Eliminar</button>
</form>
        </div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


 
  <script>  let listadodehorasextras = {!! json_encode($listahoras,JSON_FORCE_OBJECT) !!};
            let listaausencias = {!! json_encode($listaausencias,JSON_FORCE_OBJECT) !!};
            let listavacacioness = {!! json_encode($listavacacioness,JSON_FORCE_OBJECT) !!};
            let listaaferiados = {!! json_encode($listaaferiados,JSON_FORCE_OBJECT) !!};


</script>

  <!-- Required datatable js -->
  <script src="public/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="public/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
  <!-- Buttons examples -->
  <script src="public/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="public/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
  <script src="public/assets/libs/jszip/jszip.min.js"></script>
  <script src="public/assets/libs/pdfmake/build/pdfmake.min.js"></script>
  <script src="public/assets/libs/pdfmake/build/vfs_fonts.js"></script>
  <script src="public/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="public/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="public/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
  <!-- Responsive examples -->
  <script src="public/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
  <script src="public/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
  <!-- Datatable init js -->
  <script src="public/assets/js/pages/datatables.init.js"></script>
  <!-- End of Main Content -->
  <br><br><br>
    @include('pp.footer')