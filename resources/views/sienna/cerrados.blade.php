@include('facu.header')
<div class="wrapper" >

<!-- ========== Left Sidebar Start ========== -->
@include('facu.menu')


<div class="content-page" style="padding: 0!important;">

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade
                            show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
<script>
    function pp(){

        var endDate=  $("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD');
        var start=  $("#reportrange").data('daterangepicker').startDate.format('YYYY-MM-DD');

        alert(endDate);
        alert(start);
   
        var URLactual = window.location.href;

        var porciones = URLactual.split('.');

        let result = porciones[0].replace("https://", "");



        url = "https://"+result+".suricata.cloud/api/cerrados?inicio=" + start + "&fin=" + endDate + "";
        console.log(url);
        alert(url);
        axios.get(url)
        .then(function (response) {
            console.log(response.data);

            // función que se ejecutará al recibir una respuesta
            
            

            sd=' <table id="example"  class="table table-striped dt-responsive nowrap w-100 text-light">'+
                            '<thead>'+
                        '     <tr class="text-center bg-dark" >'+
                        '        <th class="text-light"><i></i>Ticket</th>'+
                        '        <th class="text-light">Cliente</th>'+
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
                if(response.data[i].asignado !='99999'){
                    d="d-none";
                }
                tt += '<tr class="text-center">' +
                    ' <td><i class="mdi '+im+'  '+im2+' me-1 "></i>' + response.data[i].ticketid + '</td>' +
                    ' <td>' + response.data[i].nya + '</td>' +
                    ' <td> <span class="badge '+colordepto+'" style="font-size:medium;">' + response.data[i].depto + '</span>'+
                    ' <td>' + response.data[i].topicnombre + '</td>' +
                    ' <td>' + response.data[i].cel + '</td>' +
                    ' <td>' + response.data[i].created_at + '</td>' +
                
                    ' <td> <span class="badge '+colorestado+'" style="font-size:medium;">' + response.data[i].estadoname + '</span>'+

                    ' <td>'+
                    
                    '<button  onclick="pedir(`' + response.data[i].ticketid + '`)"  class="btn btn-info '+d+'" type="button" data-bs-toggle="modal" data-bs-target="#standard-modal-reclamo"><i class="mdi mdi-account-arrow-left" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="" data-bs-title="Reclamar ticket."></i></button> ' +
                    '<button onclick="area(`' + response.data[i].ticketid + '`,`' + response.data[i].conversation_id + '`,`' + response.data[i].user_id + '`)"  class="btn btn-info " type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm2"><i class="mdi mdi-account-group" data-bs-toggle="tooltip" data-bs-placement="top"     data-bs-custom-class="" data-bs-title="Asignar departamento."></i> </button>' +
                    '<button onclick="estado2(`' + result + '`,`' + response.data[i].ticketid + '`,`' + response.data[i].conversation_id + '`,`' + response.data[i].iddepto + '`)"  class="btn btn-secondary " type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm"><i class="mdi mdi-flag" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="mb-1" data-bs-title="Cambiar estado."></i> </button> ' +
                    '<button onclick="topic(`' + result + '`,`' + response.data[i].ticketid + '`,`' + response.data[i].conversation_id + '`,`' + response.data[i].iddepto + '`)"  class="btn btn-info " type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-smtopic">  <i class="mdi mdi-notebook" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="mb-1" data-bs-title="Cambiar topic."></i></button> ' +
                    '<button onclick="cerrar(`' + result + '`,`' + response.data[i].ticketid + '`,`' + response.data[i].conversation_id + '`,`' + response.data[i].iddepto + '`)"  class="btn btn-success  " type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-smcerrar">  <i class="mdi mdi-check-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="" data-bs-title="Cambiar cerrar."></i></button> ' +

                    ' '+

                    '<button  onclick="listadoseguimientos(`' + result + '`,`' + response.data[i].ticketid + '`)"   class="btn btn-secondary me-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="mdi mdi-link" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="mb-1" data-bs-title="Seguimiento."></i></button>' +
                    '<button  onclick="vista(`' + response.data[i].conversation_url + '`,`' + response.data[i].cliente + '`,`' + result + '`)" class="btn btn-primary " type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg"><i class="mdi mdi-wechat" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="mb-1" data-bs-title="Conversación."></i> </button>'+
                    '<button       class="btn btn-secondary d-none" type="button" data-bs-toggle="modal" data-bs-target="#modalHistory">  <i class="mdi mdi-history" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="mb-1" data-bs-title="Historial."></i>           </button> </td </tr>';

                

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

</script>
        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-4 col-sm-12">
                        <label class="form-label">Período</label>
                        <div  id="reportrange" class="form-control" data-toggle="date-picker-range" data-target-display="#reportrange" data-cancel-class="btn-light">
                            <i class="mdi mdi-calendar"></i>&nbsp;
                            <span ></span> <i class="mdi mdi-menu-down"></i>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="mb-2 position-relative">
                            <label class="form-label">&nbsp;</label>
                            <input onclick="pp()" type="submit" type="button" class="form-control w-25 bg-success text-light" value="Buscar">
                        </div>
                    </div>
                </div>
           
                


            </div>
        </div>
    </div>
</div>
<br><br><br>
@include('facu.footer')
