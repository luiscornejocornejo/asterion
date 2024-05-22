@include('facu.header2')


<script>
 

        let departamentoslista = {!! json_encode($deptos,JSON_FORCE_OBJECT) !!};
        let sourcelista = {!! json_encode($source,JSON_FORCE_OBJECT) !!};
        let estadoslista = {!! json_encode($estados,JSON_FORCE_OBJECT) !!};
        let iconos = {!! json_encode($iconos,JSON_FORCE_OBJECT) !!};
        let usersmerchant = {!! json_encode($usersmerchant,JSON_FORCE_OBJECT) !!};
        let pri = {!! json_encode($prioridades,JSON_FORCE_OBJECT) !!};



        var frecuencia =<?php echo session('frecuencia');?>;

        identificadorIntervaloDeTiempo = setInterval(maxid, frecuencia);
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
        function maxid() {
           document.body.style.zoom = "80%";

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
            
                sd='<button  onclick="pedirall()"  class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#standard-modal-reclamo"><i class="mdi mdi-account-arrow-left" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="" data-bs-title="Reclamar ticket."></i></button> '+
                '<button onclick="areaall()"  class="btn btn-info me-1" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm2"><i class="mdi mdi-account-group" data-bs-toggle="tooltip" data-bs-placement="top"     data-bs-custom-class="" data-bs-title="Asignar departamento."></i> </button>'+
                '<button onclick="cerrarall()"  class="btn btn-success  " type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-smcerrarall">  <i class="mdi mdi-check-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="" data-bs-title="Cambiar cerrar."></i></button> '+
                '<button onclick="prioridadall()"  class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-prioridadall"><i class="mdi mdi-priority-high"></i></button> '+
                '  <button type="button" onclick="selects()" class="btn btn-primary"><i class="mdi mdi-check-all" ></i></button>'+  
                ' <button type="button" onclick="deSelect()" class="btn btn-info"><i class="mdi mdi-checkbox-blank-outline"></i></button>'+
                '<br><br><table style="width: 1500 px !important;" id="example"  class="table table-striped display responsive nowrap w-100 text-light">'+
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
                    }

                    if(response.data[i].nombreagente ==null){
                      $nombreamostrar="sin asignar";
                    }else{
                      $nombreamostrar=response.data[i].nombreagente ;
                    }
                  
                    tt += '<tr class="text-center">' +
        
                        ' <td><input name="chk" class="form-check-input me-1" type="checkbox" value="'+response.data[i].ticketid +'" id="flexCheckDefault"><a target=blank href=/ticketunico?tick='+response.data[i].ticketid +'><i class="mdi '+im+'  '+im2+' me-1 "></i>' + response.data[i].ticketid + '</a></td>' +
                        ' <td>' + response.data[i].nya + '</td>' + 
                        ' <td>' + $nombreamostrar+ '</td>' + 
                        ' <td> <span class="badge '+colordepto+'" style="font-size:medium;">' + response.data[i].depto + '</span>'+
                        ' <td><button onclick="topic(`' + result + '`,`' + response.data[i].ticketid + '`,`' + response.data[i].conversation_id + '`,`' + response.data[i].iddepto + '`)"  class="btn btn-info " type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-smtopic">  ' + response.data[i].topicnombre + '</button></td>' +
                        ' <td><span style="font-size:medium;" class="'+colorpri+'">' + response.data[i].pri + '</span></td>' +
                        ' <td>' + response.data[i].cel + '</td>' +
                        ' <td>' + response.data[i].creado + '</td>' +
                      
                        ' <td> <button class="badge '+colorestado+'" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm" onclick="estado2(`' + result + '`,`' + response.data[i].ticketid + '`,`' + response.data[i].conversation_id + '`,`' + response.data[i].iddepto + '`)"><span class="badge '+colorestado+'" style="font-size:medium; ">' + response.data[i].estadoname + '</span></button>'+

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
                    "order": [[0, 'desc']],
                    "responsive": !0,
                    "pageLength": 25,
                    select: true,
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
                    $(cell).html('<input size="50" type="text" placeholder="' + title + '" />');
 
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
          
        .appendTo('#example thead ');
        $('#example thead tr').width('800 px;');
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

              <!-- Start Content-->
            
                <div class="container-fluid " id="casa">
                   
                    
                                                     
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

      @include('sienna.ticketsmodals.departamentos')
      @include('sienna.ticketsmodals.asignarall')
      @include('sienna.ticketsmodals.seguimientos')
      @include('sienna.ticketsmodals.historialtickets')
      @include('sienna.ticketsmodals.cerrar')
      @include('sienna.ticketsmodals.cerrarall')
      @include('sienna.ticketsmodals.prioridadall')
      
      @include('sienna.flotantes.creartickets')
      @include('sienna.flotantes.crearticketsnc')
      @include('sienna.flotantes.salientes')
    </div>
  <!-- END wrapper -->

  @include('facu.footer')