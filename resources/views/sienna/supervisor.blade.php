@include('facu.header2')

<style>
  .tooltip-button {
    position: relative;
    display: inline-block;
    
  }
  
  /* Tooltip text */
  .tooltip-button .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: #555;
    color: #fff;
    text-align: center;
    padding: 5px 0;
    border-radius: 6px;
    margin-top: 4.5px;
    /* Position the tooltip text */
    position: absolute;
    z-index: 1;
    top: -5px;
    left: 105%;
  
    /* Fade in tooltip */
    opacity: 0;
    transition: opacity 0.3s;
  }
  
  /* Tooltip arrow */
  .tooltip-button .tooltiptext::after {
    content: "";
    position: absolute;
    top: 42%;
    right: 100%;
    margin-left: -5px;
    border-width: -10px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
    transform: rotate(90deg);
  }
  
  /* Show the tooltip text when you mouse over the tooltip container */
  .tooltip-button:hover .tooltiptext {
    visibility: visible;
    opacity: 1;
  }

</style>

<script>
 

        let departamentoslista = {!! json_encode($deptos,JSON_FORCE_OBJECT) !!};
        let sourcelista = {!! json_encode($source,JSON_FORCE_OBJECT) !!};
        let estadoslista = {!! json_encode($estados,JSON_FORCE_OBJECT) !!};
        let iconos = {!! json_encode($iconos,JSON_FORCE_OBJECT) !!};
        let usersmerchant = {!! json_encode($usersmerchant,JSON_FORCE_OBJECT) !!};
        let pri = {!! json_encode($prioridades,JSON_FORCE_OBJECT) !!};
        let extras = {!! json_encode($resultadosextras,JSON_FORCE_OBJECT) !!};
        console.log(extras);





       
        function parar(){
          console.log(identificadorIntervaloDeTiempo);
          clearInterval(identificadorIntervaloDeTiempo);

        }
        function star(){
          identificadorIntervaloDeTiempo = setInterval(maxid, frecuencia);


        }
        function pedir2(dd) {
              document.getElementById("idticketpedir2").value = dd;
        }

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
        function pedirall(){
          var checked = document.querySelectorAll('input:checked');

          if (checked.length === 0) {
              // there are no checked checkboxes
              console.log('no checkboxes checked');
          } else {
              // there are some checked checkboxes
              console.log(checked.length + ' checkboxes checked');
          }

          let area_interes = "";
          for (let i = 0, length = checked.length; i < length; i++) {
              area_interes += checked[i].value + ",";             
          }
          document.getElementById("idticketpedir20").value = area_interes;

        }

        function tags(){
          var checked = document.querySelectorAll('input:checked');

          if (checked.length === 0) {
              // there are no checked checkboxes
              console.log('no checkboxes checked');
          } else {
              // there are some checked checkboxes
              console.log(checked.length + ' checkboxes checked');
          }

          let area_interes = "";
          for (let i = 0, length = checked.length; i < length; i++) {
              area_interes += checked[i].value + ",";             
          }
          document.getElementById("idtickettags").value = area_interes;

        }
        function areaall(){
          var checked = document.querySelectorAll('input:checked');

          if (checked.length === 0) {
              // there are no checked checkboxes
              console.log('no checkboxes checked');
          } else {
              // there are some checked checkboxes
              console.log(checked.length + ' checkboxes checked');
          }

          let area_interes = "";
          for (let i = 0, length = checked.length; i < length; i++) {
              area_interes += checked[i].value + ",";             
          }
          document.getElementById("idticketdepto22").value = area_interes;

        }
        function cerrarall(){
          var checked = document.querySelectorAll('input:checked');

          if (checked.length === 0) {
              // there are no checked checkboxes
              console.log('no checkboxes checked');
          } else {
              // there are some checked checkboxes
              console.log(checked.length + ' checkboxes checked');
          }

          let area_interes = "";
          for (let i = 0, length = checked.length; i < length; i++) {
              area_interes += checked[i].value + ",";             
          }
          document.getElementById("tc").value = area_interes;

        }
        function prioridadall(){
          var checked = document.querySelectorAll('input:checked');

          if (checked.length === 0) {
              // there are no checked checkboxes
              console.log('no checkboxes checked');
          } else {
              // there are some checked checkboxes
              console.log(checked.length + ' checkboxes checked');
          }

          let area_interes = "";
          for (let i = 0, length = checked.length; i < length; i++) {
              area_interes += checked[i].value + ",";             
          }
          document.getElementById("tp").value = area_interes;

        }
        function selects(){  
                var ele=document.getElementsByName('chk');  
                for(var i=0; i<ele.length; i++){  
                    if(ele[i].type=='checkbox')  
                        ele[i].checked=true;  
                }  
        }  
        function deSelect(){  
                var ele=document.getElementsByName('chk');  
                for(var i=0; i<ele.length; i++){  
                    if(ele[i].type=='checkbox')  
                        ele[i].checked=false;  
                      
                }  
        }             
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
        function displayData(data) {
            const container = document.getElementById('data-container');
            container.innerHTML = ''; // Limpia el contenido anterior

            data.forEach((item, index) => {
                const div = document.createElement('div');
                div.textContent = JSON.stringify(item);

                // Si es un nuevo registro o ha cambiado, añade una clase CSS
                if (lastData && JSON.stringify(item) !== JSON.stringify(lastData[index])) {
                    div.classList.add('new-data');
                }

                container.appendChild(div);
            });
        }
        let lastData = null;

        


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

        function historico(result,dd) {


          document.getElementById("historico").innerHTML = "";
          url = "https://"+result+".suricata.cloud/api/historico?cliente=" + dd;
          axios.get(url)
          .then(function (response) {
          // función que se ejecutará al recibir una respuesta
          console.log(response.data);

          dato = "";
          for (i = 0; i < response.data.length; i++) {
              console.log(response.data[i].id);
              console.log(response.data[i].nombre);


              dato += ' <div class="mt-3"> ' +

                  '<div class="form-check mb-2">' +
                  'estado:'+response.data[i].nombreestado +'<br> ' +
                  'depto:'+response.data[i].nombredepto +'<br> ' +
                  'fecha:'+response.data[i].created_at +'<br> ' +

                  '<a target="_blank" href="https://ispgroup.suricata.cloud/ticketunico?tick='+ response.data[i].ticketid+'" class="form-check-label" >' + response.data[i].siennatopicnombre + '</a>' +
                  '</div><hr />' +

                  ' </div>';


          }
          document.getElementById("historico").innerHTML = dato;



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
                uri="";
                if(response.data[i].logo!=null){

                  ht='https://sienamedia.sfo3.digitaloceanspaces.com/ispgroup/xen/enviados/'+response.data[i].logo;
                  uri='<a target=_blank href="'+ht+'">'+response.data[i].logo+'</a>';
                }else{
                  uri='';
                }
              coloreicono= coloriconos(response.data[i].tipo);

                dato += ' <div class="timeline-item">'+
                        coloreicono+
                        '<div class="timeline-item-info">'+
                        '<span class="text-info fw-bold mb-1 d-block">'+response.data[i].descripcion+'</span>'+
                        '<small>'+response.data[i].autor+'</small>'+
                        '<p class="mb-0 pb-2">'+
                        '<small class="text-muted">'+response.data[i].created_at+'</small>'+
                      
                        '</p> '+uri+'</div> </div>';
                                                    
                                                    
                                        


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
          @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade
                            show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
              <!-- Start Content-->
            <?php 
            $subdomain_tmp = 'localhost';
            if (isset($_SERVER['HTTP_HOST'])) {
                $domainParts = explode('.', $_SERVER['HTTP_HOST']);
                $subdomain_tmp =  array_shift($domainParts);
            } elseif(isset($_SERVER['SERVER_NAME'])){
                $domainParts = explode('.', $_SERVER['SERVER_NAME']);
                $subdomain_tmp =  array_shift($domainParts);
                
            }
            if(session('tokeninterno')<>0){?>
              <div class="">
                        <iframe sandbox="allow-same-origin allow-scripts allow-popups allow-forms" allow="camera;microphone" src="https://view-sip.pagoralia.dev/?token=<?php echo session('tokeninterno');?>&merchant=<?php echo $subdomain_tmp;?>" width="100%" class="border rounded-3" style="height: 120px!important;"></iframe>
                    </div>

                    <?php }?>
                <div onload="maxid()" class="container-fluid " id="casa">
                   
                    
                                                     
                </div>

                <script>
                  function area2(dd, ee, ff) {

document.getElementById("idticketdepto202").value = dd;
document.getElementById("idconv").value = ee;
document.getElementById("user_id").value = ff;


}
function obtenerFechaUTC() {
    const fechaActualUTC = new Date();

    const año = fechaActualUTC.getUTCFullYear();
    const mes = String(fechaActualUTC.getUTCMonth() + 1).padStart(2, '0'); // Los meses empiezan desde 0
    const dia = String(fechaActualUTC.getUTCDate()).padStart(2, '0');
    const hora = String(fechaActualUTC.getUTCHours()).padStart(2, '0');
    const minutos = String(fechaActualUTC.getUTCMinutes()).padStart(2, '0');
    const segundos = String(fechaActualUTC.getUTCSeconds()).padStart(2, '0');

    return `${año}-${mes}-${dia} ${hora}:${minutos}:${segundos}`;
}
                  function maxid() {
           //document.body.style.zoom = "80%";

            var URLactual = window.location.href;
            var porciones = URLactual.split('.');
            let result = porciones[0].replace("https://", "");
            var idusuario =<?php echo session('idusuario');?>;
            var area =<?php echo session('areas');?>;
            var tipodemenu =<?php echo session('tipodemenu');?>;
           // var deptosuser =<?php echo session('deptosuser');?>;

            var ctusersall = <?php echo session('ctusers');?>;
            console.log(ctusersall);
           url = "https://"+result+".suricata.cloud/api/maxid?idusuario=" + idusuario + "";

                    if (tipodemenu==3) {
                      url = "https://"+result+".suricata.cloud/api/maxid?idusuario=" + idusuario + "";

          
                      // el código se ejecuta
                    } else {
                      url = "https://"+result+".suricata.cloud/api/maxid?idusuario=" + idusuario + "";
                    }
            console.log(url);

            axios.get(url)
            .then(function (response) {
              const newData = response.data;


                    // Compara los datos nuevos con los datos anteriores
                    if (JSON.stringify(newData) !== JSON.stringify(lastData)) {
                      lastData = newData;
                     // displayData(newData);


                // función que se ejecutará al recibir una respuesta
            
                sd='<br><button  onclick="pedirall()" class="btn btn-info tooltip-button" type="button" data-bs-toggle="modal" data-bs-target="#standard-modal-reclamo"><span class="mdi mdi-account-arrow-left"><span class="tooltiptext">Asignar tickets</span></span></button> '+
                '<button onclick="areaall()"  class="btn btn-info tooltip-button me-1" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm2"><span class="mdi mdi-account-group"><span class="tooltiptext">Cambiar departamento</span></span></button> ';
                if(ctusersall==1){
                  sd=sd+'<button onclick="cerrarall()"  class="btn btn-success tooltip-button" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-smcerrarall"><span class="mdi mdi-check-circle"><span class="tooltiptext">Cerrar tickets</span></span></button> ';

                }
                sd=sd+ '<button onclick="prioridadall()"  class="btn btn-success tooltip-button" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-prioridadall"><span class="mdi mdi-priority-high"><span class="tooltiptext">Cambiar prioridad</span></button> '+
                '<button type="button" onclick="selects()" class="btn btn-primary tooltip-button"><span class="mdi mdi-check-all"><span class="tooltiptext">Seleccionar todos los tickets</span></span></button> '+  
                '<button type="button" onclick="deSelect()" class="btn btn-info tooltip-button"><span class="mdi mdi-checkbox-blank-outline"><span class="tooltiptext">Quitar selección</span></span></button> '+
                '<button type="button" onclick="parar()" class="btn btn-danger tooltip-button"><span class="mdi mdi-motion-pause"><span class="tooltiptext"> Detener autosincronización</span></span></button> '+
                '<button type="button" onclick="star()" class="btn btn-success tooltip-button"><span class="mdi mdi-refresh-auto"> <span class="tooltiptext"> Activar autosincronización</span></span></button> '+
                '<button onclick="tags()"  class="btn btn-success tooltip-button" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-smtagsall"><span class="mdi mdi-check-circle"><span class="tooltiptext">Tgas</span></span></button>'+
                '<br><br><table style="width: 100%;" id="example"  class="table table-hover display responsive nowrap text-light">'+
                                '<thead>'+
                              '     <tr class="text-center bg-dark" >'+
                              

                              '        <th class="text-light"><i></i>Ticket</th>'+
                              '        <th class="text-light">Cliente</th>'+
                              '        <th class="text-light">Asignado</th>'+
                              '          <th class="text-light">Area</th>'+
                              '        <th class="text-light">Topic</th>'+
                              '        <th class="text-light">Prioridad</th>'+
                              '        <th class="text-light">Telefono</th>'+
                              '        <th class="text-light">Creado</th>'+
                              
                              '        <th class="text-light">Estado</th>'+

                              <?php foreach($resultadosextras as $valo){
                                      echo "'<th class=text-light>".$valo->pseudo."</th>'+";
                              }?>
                              '        <th class="text-light">Acciones</th>'+
                              '        '+
                              '    </tr>'+
                              ' </thead>'+
                              ' <tbody id="tb">'+
                              
                              ' </tbody>'+
                              '<tfoot>'+
                              '     <tr class="bg-secondary">'+
                              

                              '        <th class="text-light"><i></i>Ticket</th>'+
                              '        <th class="text-light">Cliente</th>'+
                              '        <th class="text-light">Asignado</th>'+
                              '          <th class="text-light">Area</th>'+
                              '        <th class="text-light">Topic</th>'+
                              '        <th class="text-light">Prioridad</th>'+
                              '        <th class="text-light">Telefono</th>'+
                              '        <th class="text-light">Creado</th>'+
                              
                              '        <th class="text-light">Estado</th>'+
                              <?php foreach($resultadosextras as $valo){
                                      echo "'<th class=text-light>".$valo->pseudo."</th>'+";
                              }?>
                              '        <th class="text-light">Acciones</th>'+
                              '        '+
                              '    </tr>'+
                              ' </tfoot>'+
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
                    if(response.data[i].siennasource==7){
                      aviso='<a target=blank href=/ticketunico?tick='+response.data[i].ticketid +'><i class="mdi mdi-email  "></i></a>';
                      aviso=''
                    }
                    if(response.data[i].siennasource==5){
                      aviso=''
                    }

                    if(response.data[i].nombreagente ==null){
                      $nombreamostrar="sin asignar";
                    }else{
                      $nombreamostrar=response.data[i].nombreagente ;
                    }

                    if(response.data[i].cliente !== null && response.data[i].cliente !=''){
                      url2 = "<a target=_blank href=https://"+result+".suricata.cloud/userprofile?cliente=" + response.data[i].cliente + " class='link-body-emphasis'>"+response.data[i].nya +"</a>";

                    }else{
                      url2 =response.data[i].nya;
                    }
                    console.log("yo");
                    console.log(response.data[i].ticketid);

                  // Fecha específica en formato 'YYYY-MM-DD HH:MM:SS'
                  const fechaDada = response.data[i].fn;
                  console.log(response.data[i].fn);

                  // Convertir la fecha dada en un objeto Date
                  const fechaDadaDate = new Date(fechaDada);
                  console.log(fechaDadaDate);

                  // Obtener la fecha y hora actual
                  const fechaActual =  obtenerFechaUTC();
                  const fechaActual2 = new Date(fechaActual);

                  console.log(fechaActual);

                  // Calcular la diferencia en milisegundos
                  const diferenciaMilisegundos = fechaActual2 - fechaDadaDate;

                  // Convertir la diferencia a minutos (1000 ms = 1 segundo, 60 segundos = 1 minuto)
                  const diferenciaMinutos = diferenciaMilisegundos / (1000 * 60);
                  console.log(diferenciaMinutos);

                  // Verificar si han pasado más de 1440 minutos (24 horas)
                  if (diferenciaMinutos > response.data[i].sla) {
                      console.log("Han pasado más de "+response.data[i].sla+" minutos.");
                      valcol="background-color: #ffeff2 !important;";

                  } else {
                    valcol="background-color: white !important;";

                      console.log("No han pasado más de "+response.data[i].sla+" minutos.");
                  }

                    tt += '<tr style=" '+valcol+'" class="text-center">' +
        
                        ' <td><input name="chk" class="form-check-input me-1" type="checkbox" value="'+response.data[i].ticketid +'" id="flexCheckDefault"><a target="_blank" href="/ticketunico?tick='+response.data[i].ticketid +'"><i class="mdi '+im+'  '+im2+' me-1 "></i><strong>' + response.data[i].ticketid + '</strong></a></td>' +
                        ' <td><b>'+url2 + '</b></td>' + 
                        ' <td>' + $nombreamostrar+ '</td>' + 
                        '<td><span class="badge '+colordepto+'" style="font-size:medium;" onclick="area2(`' + response.data[i].ticketid + '`,`' + response.data[i].conversation_id + '`,`' + response.data[i].user_id + '`)"  class="badge bg-info" style="font-size: medium" role="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm202">'+response.data[i].depto+' </span></td>' +
                        '<td><span style="font-size:medium;" class="'+colorpri+'" onclick="topic(`' + result + '`,`' + response.data[i].ticketid + '`,`' + response.data[i].conversation_id + '`,`' + response.data[i].iddepto + '`)"  class="badge badge-info-lighten border" style="font-size: medium" role="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-smtopic"> ' + response.data[i].topicnombre + '</span></td> ' +
                        ' <td><span style="font-size:medium;" class="'+colorpri+'">' + response.data[i].pri + '</span></td>' +

                        ' <td>' + response.data[i].cel + '</td>' +
                        ' <td>' + response.data[i].creado + '</td>' +
                        '<td> <span onclick="estado2(`' + result + '`,`' + response.data[i].ticketid + '`,`' + response.data[i].conversation_id + '`,`' + response.data[i].iddepto + '`)"  class="badge '+colorestado+' " style="font-size: medium" role="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm">' + response.data[i].estadoname + ' </span></td> ' +

                        <?php foreach($resultadosextras as $valo){
                                      $busco=$valo->nombre;
                                      echo "'<td class=>' + response.data[i].".$busco." + '</td>'+";
                              }?>
                        ' <td>'+
                       '<button  onclick="listadoseguimientos(`' + result + '`,`' + response.data[i].ticketid + '`)"   class="btn btn-secondary " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="mdi mdi-link" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="mb-1" data-bs-title="Seguimiento."></i></button>' +
                        ''+
                        '  '+aviso+ ''+
                        ' </td </tr>';

                      

                }
                document.getElementById("casa").innerHTML = null;

                document.getElementById("casa").innerHTML = sd;
                document.getElementById("tb").innerHTML = null;

                document.getElementById("tb").innerHTML = tt;
                $('#example').dataTable({
                    "order": [[5, 'asc'],[0, 'desc']],
                    "responsive": !0,
                    "pageLength": 25,                    
                    "language" : {
                      "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                    },
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ],
                    initComplete: function () {
                    this.api()
                      .columns()
                      .every(function () {
                        let column = this;
                        let title = column.footer().textContent;

                        // Create input element
                        let input = document.createElement("input");
                        input.placeholder = title;
                        input.className = "form-control";
                        column.footer().replaceChildren(input);

                        // Event listener for user input
                        input.addEventListener("keyup", () => {
                          if (column.search() !== this.value) {
                            column.search(input.value).draw();
                          }
                        });
                  });
              }
                    });
          }//fin del if
            else{
              console.log("no hay cambios");

            }
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
        document.addEventListener('DOMContentLoaded', () => {
        
        maxid();
      })
                  var frecuencia =<?php echo session('frecuencia');?>;

                  identificadorIntervaloDeTiempo = setInterval(maxid, frecuencia);
                  </script>
                <div id="data-container"></div>

                <div class="floating-button">
                    <button id="main-button" class="bg-primary text-light" onclick="toggleRotation(); toggleMenu()">
                    <span class="mdi mdi-plus"></span>
                    </button>
                    <div id="menu" class="hidden">
                    <?php
                        $querygenerico="select * from empresa";
                        $siennadeptosgenericos = DB::select($querygenerico);
                        $uribotfrontdesk="";
                        foreach($siennadeptosgenericos as $val){
                            $uribotfrontdesk=$val->botfrontdesk;
                        }
                        ?>
                        <?php if($uribotfrontdesk<>""){?>
                    <button id="button-4" class="mdi mdi-robot bg-primary text-light " href="#warning-alert-modal2" data-bs-toggle="modal"></button>
                    <?php } else {
                      ?>
                      <button  id="button-2" class="mdi mdi-ticket-account bg-warning text-light" data-bs-toggle="modal" href="#exampleModalToggle" >
                    <?php }?>
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

      @include('sienna.ticketsmodals.departamentos')
      @include('sienna.ticketsmodals.departamentos2')
      @include('sienna.ticketsmodals.asignarall')
      @include('sienna.ticketsmodals.tagsall')
      @include('sienna.ticketsmodals.seguimientos')
      @include('sienna.ticketsmodals.historialtickets')
      @include('sienna.ticketsmodals.cerrar')
      @include('sienna.ticketsmodals.cerrarall')
      @include('sienna.ticketsmodals.prioridadall')
      
      @include('sienna.flotantes.creartickets')
      @include('sienna.flotantes.crearticketsnc')
      @include('sienna.flotantes.webchat')
      @include('sienna.flotantes.salientes')
    </div>
  <!-- END wrapper -->

  @include('facu.footer')