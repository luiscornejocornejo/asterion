@include('facu.header2')
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
    
    let departamentoslista = {!! json_encode($deptos,JSON_FORCE_OBJECT) !!};
    let sourcelista = {!! json_encode($source,JSON_FORCE_OBJECT) !!};
    let estadoslista = {!! json_encode($estados,JSON_FORCE_OBJECT) !!};
    let iconos = {!! json_encode($iconos,JSON_FORCE_OBJECT) !!};
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
    function pp(){

        var endDate=  $("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD');
        var start=  $("#reportrange").data('daterangepicker').startDate.format('YYYY-MM-DD');
        var URLactual = window.location.href;
        var porciones = URLactual.split('.');
        let result = porciones[0].replace("https://", "");
        var empresageneral = <?php echo session('empresa');?>;

        url = "https://"+result+".suricata.cloud/api/cerrados?inicio=" + start + "&fin=" + endDate + "&empresa="+empresageneral;
        console.log(url);
       
        axios.get(url)
        .then(function (response) {

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
                        '        <th class="text-light">Cerrado</th>'+
                        '        <th class="text-light">Asignado</th>'+
                        
                        '        <th class="text-light">Estado</th>'+
                        '        <th class="text-light">Descripcion</th>'+
                        '        <th class="text-light">Acciones</th>'+
                        '        '+
                        '    </tr>'+
                        ' </thead>'+
                        ' <tbody id="tb">'+ 
                        
                        ' </tbody>'+
                        '<tfoot>'+
                        '     <tr class="text-center bg-dark" >'+
                        '        <th class="text-light"><i></i>Ticket</th>'+
                        '        <th class="text-light">Cliente</th>'+
                        '          <th class="text-light">Area</th>'+
                        '        <th class="text-light">Topic</th>'+
                        '        <th class="text-light">Telefono</th>'+
                        '        <th class="text-light">Creado</th>'+
                        '        <th class="text-light">Cerrado</th>'+
                        '        <th class="text-light">Asignado</th>'+

                        '        <th class="text-light">Estado</th>'+
                        '        <th class="text-light">Descripcion</th>'+

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
                if(response.data[i].asignado !='99999'){
                    d="d-none";
                }
                tt += '<tr class="text-center">' +
                    ' <td><a target=blank href=/ticketunico?tick='+response.data[i].ticketid +'><i class="mdi '+im+'  '+im2+' me-1 "></i>' + response.data[i].ticketid + '</a></td>' +
                    ' <td>' + response.data[i].nya + '</td>' +
                    ' <td> <span class="badge '+colordepto+'" style="font-size:medium;">' + response.data[i].depto + '</span>'+
                    ' <td>' + response.data[i].topicnombre + '</td>' +
                    ' <td>' + response.data[i].cel + '</td>' +
                    ' <td>' + response.data[i].created_at2 + '</td>' +
                    ' <td>' + response.data[i].t_cerrado2 + '</td>' +
                    ' <td>' + response.data[i].elasignado + '</td>' +
                    

                    ' <td> <span class="badge '+colorestado+'" style="font-size:medium;">' + response.data[i].estadoname + '</span>'+
                    ' <td> <span  style="font-size:medium;">' + response.data[i].descripciondelcierre + '</span>'+

                    ' <td>'+
                    
                 
                    ' '+

                    '<button  onclick="listadoseguimientos(`' + result + '`,`' + response.data[i].ticketid + '`)"   class="btn btn-secondary me-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="mdi mdi-link" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-custom-class="mb-1" data-bs-title="Seguimiento."></i></button>' +
                    '<button  onclick="vista(`' + response.data[i].conversation_url + '`,`' + response.data[i].cliente + '`,`' + result + '`)" class="btn btn-primary " type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg"><i class="mdi mdi-wechat" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="mb-1" data-bs-title="Conversación."></i> </button>'+
                    '</td </tr>';

                

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
           
                <div id="casa"></div>
                


            </div>
        </div>
    </div>
</div>
<br><br><br>
@include('sienna.ticketsmodals.conversacion')        

@include('sienna.ticketsmodals.seguimientos')
@include('facu.footer')
