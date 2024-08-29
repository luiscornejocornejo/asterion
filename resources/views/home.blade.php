
@include('facu.header2')

<script>
        let navegador = navigator.userAgent;
        if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) {
            tipo=<?php  echo $tipodemenu = session('tipodemenu'); ?>;
            var url = window.location.href;
            console.log("Estás usando un dispositivo móvil!!"+tipo);


            if(tipo=="2"){
                location.href = url+'viewtickets';


            }else{
                location.href = url+'viewtickets';

            }
        } else {
            console.log("No estás usando un móvil");
        }
</script>
<?php   
               $tokeninterno = session('tokeninterno');
               $miip=request()->ip();
?>
<script type="application/javascript">
    necesito="<?php echo $miip;?>";
    console.log("My public IP address is: ", necesito," mi subdominio es :  datos:","<?php echo $tokeninterno;?>");
    let hay=<?php echo $tokeninterno;?>;
    if(hay==0) {
        console.log("no logear");
    }
    else{
        console.log("logear");
        var URLactual = window.location.href;
        var porciones = URLactual.split('.');
        let result = porciones[0].replace("https://", "");
        url2 = "https://"+result+".suricata.cloud/api/telefonia?ip=" + necesito ;
        console.log(url2);
        axios.get(url2)
        .then(function (response) {
            console.log("data:");
            console.log(response.data);
        })
        .catch(function (error) {
             // función para capturar el error
            console.log("error:");
            console.log(error);
        })
        .then(function () {
             // función que siempre se ejecuta
        });

    }
</script>

<?php

$subdomain_tmp = 'localhost';
if (isset($_SERVER['HTTP_HOST'])) {
    $domainParts = explode('.', $_SERVER['HTTP_HOST']);
    $subdomain_tmp =  array_shift($domainParts);
} elseif (isset($_SERVER['SERVER_NAME'])) {
    $domainParts = explode('.', $_SERVER['SERVER_NAME']);
    $subdomain_tmp =  array_shift($domainParts);
}
$subdomain_tmp = trim($subdomain_tmp);
$query = "select idusuario from siennaloginxenioo where login=1 and  DATE(created_at) >= DATE(NOW()) group by idusuario";
$resultados = DB::select($query);
$cantidaduser = 0;
$cantidadtickets = 0;
$cantidadtickets2 = 0;
$listamensual = array();

$cantidaduser =sizeof($resultados);
if (isset($_GET['fecha'])) {

    $queryfecha = "";
    if ($_GET['fecha'] == "dia") {

        $queryfecha = "DATE(created_at) >= DATE(NOW())";
    }
    if ($_GET['fecha'] == "semana") {

        $queryfecha = "created_at>= (DATE_SUB(CURRENT_DATE, INTERVAL 7 DAY))";
    }
    $listamensual = array();

    try {

    $query = "select count(*) as cantidadtickets  from siennatickets where siennaestado=1 and  " . $queryfecha;
    $resultados2 = DB::select($query);
    $cantidadtickets = 0;
    foreach ($resultados2 as $val) {
        $cantidadtickets = $val->cantidadtickets;
    }


    $query = "select count(*) as cantidadtickets2  from siennatickets where siennaestado=4 and  " . $queryfecha;
    $resultados2 = DB::select($query);
    $cantidadtickets2 = 0;
    foreach ($resultados2 as $val) {
        $cantidadtickets2 = $val->cantidadtickets2;
    }
   
     }
     catch(\Illuminate\Database\QueryException$ex){
      echo "";//$ex;
     }
}
?>

<script>
        
    function mostrar() {
        var e = document.getElementById('foo');
        var f = document.getElementById('foo2');
        var g = document.getElementById('foo3');
        var h = document.getElementById('foo4');
          e.style.display = 'block';
       
          f.style.display = 'none';
          g.style.display = 'none';
          h.style.display = 'none';
    }
    function mostrar2() {
        var e = document.getElementById('foo');
        var f = document.getElementById('foo2');
        var g = document.getElementById('foo3');
        var h = document.getElementById('foo4');

          e.style.display = 'none';
       
          f.style.display = 'block';
          g.style.display = 'none';
          h.style.display = 'none';


    }
    function mostrar3() {
        var e = document.getElementById('foo');
        var f = document.getElementById('foo2');
        var g = document.getElementById('foo3');
        var h = document.getElementById('foo4');

          e.style.display = 'none';
          h.style.display = 'none';

          f.style.display = 'none';
          g.style.display = 'block';


    }
    function mostrar4() {
        var e = document.getElementById('foo');
        var f = document.getElementById('foo2');
        var g = document.getElementById('foo3');
        var h = document.getElementById('foo4');

          e.style.display = 'none';
       
          f.style.display = 'none';
          g.style.display = 'none';
          h.style.display = 'block';


    }
    function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  }
</script>
<!-- Begin page -->

<div class="wrapper" >

    <!-- ========== Left Sidebar Start ========== -->
    @include('facu.menu')


    <!-- ========== Left Sidebar End ========== -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page" style="padding:0 !important;">
        <div class="content">


           

            <script>
                window.addEventListener('load', home());
                let myChart;
                let myChart2;
                let myChart3;
                let myChart4;
                let myChart5;
                function grafico(datosp,subdomain_tmp,divss) {
                   // console.log(datosp.data);

                    var labels=[];
                    var datos=[];
                  
                    for (i = 0; i < datosp.data.length; i++) {
                       // console.log(datosp.data[i].name);
                        labels.push(datosp.data[i].name);
                       // console.log(labels);

                        datos.push(datosp.data[i].cant);

                       // console.log(datos);

                    }
                    //console.log(labels);

                    //console.log(datos);

                    const ctx = document.getElementById('myChart');
                    if (myChart) {
                        myChart.destroy();
                    }
                    myChart=new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                    labels: labels,
                    datasets: [{
                        label: '# depto',
                        data: datos,
                        borderWidth: 1
                    }]
                    },
                    options: {
                    scales: {
                        y: {
                            position: 'right',                display: false,
                        }
                    }
                    }
                });
                }
                function grafico2(datosp,subdomain_tmp,divss) {
                    //console.log(datosp.data);

                    var labels=[];
                    var datos=[];
                  
                    for (i = 0; i < datosp.data.length; i++) {
                       // console.log(datosp.data[i].name);
                        labels.push(datosp.data[i].name);
                      //  console.log(labels);

                        datos.push(datosp.data[i].cant);

                       // console.log(datos);

                    }
                   // console.log(labels);

                   // console.log(datos);

                    const ctx2 = document.getElementById('myChart2');
                    if (myChart2) {
                        myChart2.destroy();
                    }
                    myChart2=new Chart(ctx2, {
                    type: 'doughnut',
                    data: {
                    labels: labels,
                    datasets: [{
                        label: '# estado',
                        data: datos,
                        borderWidth: 1
                    }]
                    },
                    options: {
                    scales: {
                        y: {
                            position: 'right',                display: false,
                        }
                    }
                    }
                    });


                }
                function grafico3(datosp,subdomain_tmp,divss) {
                   // console.log(datosp.data);

                    var labels=[];
                    var datos=[];
                  
                    for (i = 0; i < datosp.data.length; i++) {
                        //console.log(datosp.data[i].name);
                        labels.push(datosp.data[i].name);
                       // console.log(labels);

                        datos.push(datosp.data[i].cant);

                        //console.log(datos);

                    }
                   // console.log(labels);

                    //console.log(datos);

                    const ctx3 = document.getElementById('myChart3');
                    if (myChart3) {
                        myChart3.destroy();
                    }
                    myChart3=new Chart(ctx3, {
                    type: 'doughnut',
                    data: {
                    labels: labels,
                    datasets: [{
                        label: '# canal',
                        data: datos,
                        borderWidth: 1
                    }]
                    },
                    options: {
                    scales: {
                        y: {
                            position: 'right',                display: false,
                        }
                    }
                    }
                    });


                }
                function grafico4(datosp,subdomain_tmp,divss) {
                   // console.log(datosp.data);

                    var labels=[];
                    var datos=[];
                  
                    for (i = 0; i < datosp.data.length; i++) {
                       // console.log(datosp.data[i].name);
                        labels.push(datosp.data[i].name);
                      //  console.log(labels);

                        datos.push(datosp.data[i].cant);

                       // console.log(datos);

                    }
                    //console.log(labels);

                   // console.log(datos);

                    const ctx4 = document.getElementById('myChart4');
                    if (myChart4) {
                        myChart4.destroy();
                    }
                    myChart4=new Chart(ctx4, {
                    type: 'doughnut',
                    data: {
                    labels: labels,
                    legend: {position: 'right'},

                    datasets: [{
                        label: '# canal',
                        data: datos,
                        borderWidth: 1
                    }]
                    },
                    options: {
                    scales: {
                        y: {
                            position: 'right',                display: false,

                        },
                        yAxes: [{
                            ticks: {
                                fontSize: 100
                            }
                        }]
                  
                    }
                    }
                    });


                }
                function grafico5(datosp,subdomain_tmp,divss) {
                    //console.log(datosp.data);

                    var labels=[];
                    var datos=[];
                  
                    for (i = 0; i < datosp.data.length; i++) {
                        //console.log(datosp.data[i].name);
                        labels.push(datosp.data[i].name);
                        //console.log(labels);

                        datos.push(datosp.data[i].cant);

                        //console.log(datos);

                    }
                    //console.log(labels);

                    //console.log(datos);

                    const ctx5 = document.getElementById('myChart5');
                    if (myChart5) {
                        myChart5.destroy();
                    }
                    myChart5=new Chart(ctx5, {
                    type: 'doughnut',
                    data: {
                    labels: labels,
                    datasets: [{
                        label: '# agente',
                        data: datos,
                        borderWidth: 1
                    }]
                    },
                    options: {
                    scales: {
                        y: {
                            position: 'right',                display: false,
                        }
                    }
                    }
                    });


                }
                function ticketxdepto(url2,result) {

                    axios.get(url2)
                        .then(function(response) {
                          
                           // console.log(response);
                            divss="#chart3";
                            grafico(response,result,divss) 

                        })
                        .catch(function(error) {
                            // función para capturar el error
                            console.log(error);
                        })
                        .then(function() {
                            // función que siempre se ejecuta
                        });

                }
                function ticketxestado(url2,result) {

                        axios.get(url2)
                            .then(function(response) {
                            
                                //console.log(response);
                                divss="#chart4";
                                grafico2(response,result,divss) 

                            })
                            .catch(function(error) {
                                // función para capturar el error
                                console.log(error);
                            })
                            .then(function() {
                                // función que siempre se ejecuta
                            });

                }
                function ticketxcanal(url2,result) {

                    axios.get(url2)
                        .then(function(response) {
                        
                            //console.log(response);
                            divss="#chart5";
                            grafico3(response,result,divss) 

                        })
                        .catch(function(error) {
                            // función para capturar el error
                            console.log(error);
                        })
                        .then(function() {
                            // función que siempre se ejecuta
                        });

                }
                
                function ticketxagente(url2,result) {

                    axios.get(url2)
                        .then(function(response) {
                        
                           // console.log(response);
                            divss="#chart6";
                            grafico5(response,result,divss) 

                        })
                        .catch(function(error) {
                            // función para capturar el error
                            console.log(error);
                        })
                        .then(function() {
                            // función que siempre se ejecuta
                        });

                }
                function ticketxtopic(url2,result) {

                    axios.get(url2)
                        .then(function(response) {
                        
                           // console.log(response);
                            divss="#chart6";
                            grafico4(response,result,divss) 

                        })
                        .catch(function(error) {
                            // función para capturar el error
                            console.log(error);
                        })
                        .then(function() {
                            // función que siempre se ejecuta
                        });

                }
                function abiertos(urlabiertos) {
                    axios.get(urlabiertos)
                        .then(function(response) {
                            //console.log(response);
                            for (i = 0; i < response.data.length; i++) {
                                let ticketabiertos = response.data[i].cantidadtickets2;
                                //console.log(ticketabiertos);
                                document.getElementById("abiertos").innerHTML = ticketabiertos;


                            }
                        })
                        .catch(function(error) {
                            // función para capturar el error
                            console.log(error);
                        })
                        .then(function() {
                            // función que siempre se ejecuta
                        });
                }

                function cerrados(urlcerrados) {
                    axios.get(urlcerrados)
                        .then(function(response) {
                            for (i = 0; i < response.data.length; i++) {
                                let ticketcerrados = response.data[i].cantidadtickets2;
                               // console.log(ticketcerrados);
                                document.getElementById("cerrados").innerHTML = ticketcerrados;


                            }
                        })
                        .catch(function(error) {
                            // función para capturar el error
                            console.log(error);
                        })
                        .then(function() {
                            // función que siempre se ejecuta
                        });

                }

                function logeados(urllogeados) {
                    axios.get(urllogeados)
                        .then(function(response) {
                            console.log(response);
                            sd='<table id="example2"  class="table table-striped dt-responsive nowrap w-100 text-light">'+
                                '<thead>'+
                              '     <tr class="text-center bg-dark" >'+
                              

                              '        <th class="text-light">Usuario</th>'+
                              '        <th class="text-light">Area</th>'+
                              '        <th class="text-light">Tipo</th>'+
                              '        <th class="text-light">Inicio</th>'+
                            
                              '        '+
                              '    </tr>'+
                              ' </thead>'+
                              ' <tbody id="tb">'+
                              
                              ' </tbody>'+
                              ' </table>';
                
                            tt = "";
                            for (i = 0; i < response.data.length; i++) {
                                let usu = response.data[i].usu;
                                let area = response.data[i].area;
                                console.log("logeados");
                                console.log(usu);
                                console.log(area);
                               // document.getElementById("abiertos").innerHTML = ticketabiertos;
                               tt += '<tr class="text-center">' +
                                        ' <td>' + response.data[i].usu + '</td>' +
                                        ' <td>' + response.data[i].area + '</td>' + 
                                        ' <td>' + response.data[i].tipo + '</td>' + 
                                        ' <td>' + response.data[i].inicio + '</td></tr>' ;

                            }

                            document.getElementById("logeados").innerHTML = null;
                            document.getElementById("logeados").innerHTML = sd;
                            document.getElementById("tb").innerHTML = null;
                            document.getElementById("tb").innerHTML = tt;
                            $('#example').dataTable({
                                            "order": [[0, 'desc']],
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
                                            $(cell).html('<input type="text" placeholder="' + title + '" />');
                        
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
                        .catch(function(error) {
                            // función para capturar el error
                            console.log(error);
                        })
                        .then(function() {
                            // función que siempre se ejecuta
                        });
                }
                function home() {

                  
                    var URLactual = window.location.href;
                    var porciones = URLactual.split('.');
                    let result = porciones[0].replace("https://", "");

                 //   urlcerrados = "https://" + result + ".suricata.cloud/api/cerradoscant?ini=" + start + "&fin=" + endDate + "";
                   // cerrados(urlcerrados);


                   //usuarios por area logeados
                   urllogeados = "https://" + result + ".suricata.cloud/api/logeados";
                    var intervalID = setInterval(logeados, 60000, urllogeados);
                    var intervalIDd = setTimeout(logeados, 500, urllogeados);


                    urlabiertos = "https://" + result + ".suricata.cloud/api/abiertoscant2";
                    var intervalID = setInterval(abiertos, 60000, urlabiertos);
                    var intervalIDd = setTimeout(abiertos, 500, urlabiertos);

                    //abiertos(urlabiertos);

                    urlticketxdepto = "https://" + result + ".suricata.cloud/api/ticketxdepto";
                   // ticketxdepto(urlticketxdepto,result);
                    var intervalID2 = setInterval(ticketxdepto, 60000, urlticketxdepto,result);
                    var intervalIDd2 = setTimeout(ticketxdepto, 500, urlticketxdepto,result);


                    urlticketxestado = "https://" + result + ".suricata.cloud/api/ticketxestado";
                   // ticketxestado(urlticketxestado,result);
                    var intervalID3 = setInterval(ticketxestado, 60000, urlticketxestado,result);
                    var intervalIDd3 = setTimeout(ticketxestado, 500, urlticketxestado,result);

                    urlticketxcanal = "https://" + result + ".suricata.cloud/api/ticketxcanal";
                   // ticketxcanal(urlticketxcanal,result);
                    var intervalID4 = setInterval(ticketxcanal, 60000, urlticketxcanal,result);
                    var intervalIDd4 = setTimeout(ticketxcanal, 500, urlticketxcanal,result);

                    urlticketxtopic = "https://" + result + ".suricata.cloud/api/ticketxtopic";
                    //ticketxtopic(urlticketxtopic,result);
                    var intervalID5 = setInterval(ticketxtopic, 60000, urlticketxtopic,result);
                    var intervalIDd5 = setTimeout(ticketxtopic, 500, urlticketxtopic,result);


                    urlticketxagente = "https://" + result + ".suricata.cloud/api/ticketxagente";
                   // ticketxagente(urlticketxagente,result);
                    var intervalID6 = setInterval(ticketxagente, 60000, urlticketxagente,result);
                    var intervalIDd6 = setTimeout(ticketxagente, 500, urlticketxagente,result);


                }

                function reportes() {

                    var endDate = $("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD');
                    var start = $("#reportrange").data('daterangepicker').startDate.format('YYYY-MM-DD');             
                    var URLactual = window.location.href;
                    var porciones = URLactual.split('.');
                    let result = porciones[0].replace("https://", "");

                    urlticketxdeptofecha = "https://" + result + ".suricata.cloud/api/ticketxdeptofecha?ini=" + start + "&fin=" + endDate + "";
                    ticketxdeptofecha(urlticketxdeptofecha,result);
                                
                    urlticketxestadofecha = "https://" + result + ".suricata.cloud/api/ticketxestadofecha?ini=" + start + "&fin=" + endDate + "";
                    ticketxestadofecha(urlticketxestadofecha,result);
                                
                    urlticketxcanalfecha = "https://" + result + ".suricata.cloud/api/ticketxcanalfecha?ini=" + start + "&fin=" + endDate + "";
                    ticketxcanalfecha(urlticketxcanalfecha,result);
                               
                    urlticketxtopicfecha = "https://" + result + ".suricata.cloud/api/ticketxtopicfecha?ini=" + start + "&fin=" + endDate + "";
                    ticketxtopicfecha(urlticketxtopicfecha,result);
                               
                    urlticketxagentefecha = "https://" + result + ".suricata.cloud/api/ticketxagentefecha?ini=" + start + "&fin=" + endDate + "";
                    ticketxagentefecha(urlticketxagentefecha,result);

                    urlticketxmotivocfecha = "https://" + result + ".suricata.cloud/api/ticketxmotivocfecha?ini=" + start + "&fin=" + endDate + "";
                    ticketxmotivocfecha(urlticketxmotivocfecha,result);

                    
                }
                let myChartdeptofecha;
                let myChartestadofecha;
                let myChartcanalfecha;
                let myCharttopicfecha;
                let myChartagentefecha;
                let myChartmotivocfecha;
                function ticketxdeptofecha(url2,result) {

                    axios.get(url2)
                        .then(function(response) {
                        
                            console.log(response);
                            graficodeptofecha(response) 

                        })
                        .catch(function(error) {
                            // función para capturar el error
                            console.log(error);
                        })
                        .then(function() {
                            // función que siempre se ejecuta
                        });

                }
                function graficodeptofecha(datosp) {
                    console.log(datosp.data);

                    var labels=[];
                    var datos=[];
                  
                    for (i = 0; i < datosp.data.length; i++) {
                        console.log(datosp.data[i].name);
                        labels.push(datosp.data[i].name);
                        console.log(labels);

                        datos.push(datosp.data[i].cant);

                        console.log(datos);

                    }
                    
                    const ctxdeptofecha = document.getElementById('myChartdeptofecha');
                    if (myChartdeptofecha) {
                        myChartdeptofecha.destroy();
                    }
                    myChartdeptofecha=new Chart(ctxdeptofecha, {
                    type: 'doughnut',
                    data: {
                    labels: labels,
                    datasets: [{
                        label: '# deptos',
                        data: datos,
                        borderWidth: 1
                    }]
                    },
                    options: {
                    scales: {
                        y: {
                            position: 'right',                display: false,
                        }
                    }
                    }
                    });


                }
                function ticketxestadofecha(url2,result) {

                    axios.get(url2)
                        .then(function(response) {
                        
                            console.log(response);
                            graficoestadofecha(response) 

                        })
                        .catch(function(error) {
                            // función para capturar el error
                            console.log(error);
                        })
                        .then(function() {
                            // función que siempre se ejecuta
                        });

                }
                function graficoestadofecha(datosp) {
                        var labels=[];
                        var datos=[];
                        for (i = 0; i < datosp.data.length; i++) {
                            labels.push(datosp.data[i].name);
                            datos.push(datosp.data[i].cant);
                        }

                        const ctxestadofecha = document.getElementById('myChartestadofecha');
                        if (myChartestadofecha) {
                            myChartestadofecha.destroy();
                        }
                        myChartestadofecha=new Chart(ctxestadofecha, {
                        type: 'doughnut',
                        data: {
                        labels: labels,
                        datasets: [{
                            label: '# estados',
                            data: datos,
                            borderWidth: 1
                        }]
                        },
                        options: {
                        scales: {
                            y: {
                                position: 'right',                display: false,
                            }
                        }
                        }
                        });


                }
                function ticketxcanalfecha(url2,result) {

                        axios.get(url2)
                            .then(function(response) {
                            
                                console.log(response);
                                graficocanalfecha(response) 

                            })
                            .catch(function(error) {
                                // función para capturar el error
                                console.log(error);
                            })
                            .then(function() {
                                // función que siempre se ejecuta
                            });

                }
                function graficocanalfecha(datosp) {
                        var labels=[];
                        var datos=[];
                        for (i = 0; i < datosp.data.length; i++) {
                            console.log(datosp.data[i].name);
                            labels.push(datosp.data[i].name);
                            console.log(labels);

                            datos.push(datosp.data[i].cant);

                            console.log(datos);

                        }

                        const ctxcanalfecha = document.getElementById('myChartcanalfecha');
                        if (myChartcanalfecha) {
                            myChartcanalfecha.destroy();
                        }
                        myChartcanalfecha=new Chart(ctxcanalfecha, {
                        type: 'doughnut',
                        data: {
                        labels: labels,
                        datasets: [{
                            label: '# canal',
                            data: datos,
                            borderWidth: 1
                        }]
                        },
                        options: {
                        scales: {
                            y: {
                                position: 'right',                display: false,
                            }
                        }
                        }
                        });


                }
                function ticketxtopicfecha(url2,result) {

                        axios.get(url2)
                            .then(function(response) {
                            
                                console.log(response);
                                graficotopicfecha(response) 

                            })
                            .catch(function(error) {
                                // función para capturar el error
                                console.log(error);
                            })
                            .then(function() {
                                // función que siempre se ejecuta
                            });

                }
                function graficotopicfecha(datosp) {
                    var labels=[];
                    var datos=[];

                    for (i = 0; i < datosp.data.length; i++) {
                        labels.push(datosp.data[i].name);
                        datos.push(datosp.data[i].cant);
                    }

                    const ctxtopicfecha = document.getElementById('myCharttopicfecha');
                    if (myCharttopicfecha) {
                        myCharttopicfecha.destroy();
                    }
                    myCharttopicfecha=new Chart(ctxtopicfecha, {
                        type: 'doughnut',
                        data: {
                        labels: labels,
                        datasets: [{
                            label: '# topic',
                            data: datos,
                            borderWidth: 1
                        }]
                        },
                        options: {
                        scales: {
                            y: {
                                position: 'right',                display: false,
                            }
                        }
                        }
                    });


                }
                function ticketxagentefecha(url2,result) {

                    axios.get(url2)
                        .then(function(response) {
                        
                            console.log(response);
                            graficoagentefecha(response) 

                        })
                        .catch(function(error) {
                            // función para capturar el error
                            console.log(error);
                        })
                        .then(function() {
                            // función que siempre se ejecuta
                        });

                }
                function graficoagentefecha(datosp) {

                            var labels=[];
                            var datos=[];

                            for (i = 0; i < datosp.data.length; i++) {
                                labels.push(datosp.data[i].name);
                                datos.push(datosp.data[i].cant);
                            }

                            const ctxagentefecha = document.getElementById('myChartagentefecha');
                            if (myChartagentefecha) {
                                myChartagentefecha.destroy();
                            }
                            myChartagentefecha=new Chart(ctxagentefecha, {
                            type: 'doughnut',
                            data: {
                            labels: labels,
                            datasets: [{
                                label: '# agente',
                                data: datos,
                                borderWidth: 1
                            }]
                            },
                            options: {
                            scales: {
                                y: {
                                    position: 'right',                display: false,
                                }
                            }
                            }
                            });


                }
                function ticketxmotivocfecha(url2,result) {

                    axios.get(url2)
                    .then(function(response) {
                    
                        console.log(response);
                        graficomotivocfecha(response) 

                    })
                    .catch(function(error) {
                        // función para capturar el error
                        console.log(error);
                    })
                    .then(function() {
                        // función que siempre se ejecuta
                    });

                }
                function graficomotivocfecha(datosp) {

                    var labels=[];
                    var datos=[];

                    for (i = 0; i < datosp.data.length; i++) {
                        labels.push(datosp.data[i].name);
                        datos.push(datosp.data[i].cant);
                    }

                    const ctxmotivocfecha = document.getElementById('myChartmotivocfecha');
                    if (myChartmotivocfecha) {
                        myChartmotivocfecha.destroy();
                    }
                    myChartmotivocfecha=new Chart(ctxmotivocfecha, {
                    type: 'doughnut',
                    data: {
                    labels: labels,
                    datasets: [{
                        label: '# motivo cierre',
                        data: datos,
                        borderWidth: 1
                    }]
                    },
                    options: {
                    scales: {
                        y: {
                            position: 'right',                display: false,
                        }
                    }
                    }
                    });


                }
                
            </script>
        
            <div>
                   
            </div>

            <?php

            $ruta=Request::path();
                $queryempresa="select * from empresa";
                $resultadosempresas = DB::select($queryempresa);
                foreach($resultadosempresas as $vale){
                    $idioma = $vale->idioma;
                    $urlmetabase = $vale->urlmetabase;

                }
                
                 $querypagina="select b.".$idioma." as texto,b.variable   from siennapaginas a 
                join  siennavariables b
                on a.id=b.siennapaginas
                where a.uri='".$ruta."'";
                $resultadospaginas = DB::select($querypagina);
                foreach ($resultadospaginas as $val) {
                    $dinamic=$val->variable;
                     $$dinamic = $val->texto;
                     //var_dump($$dinamic);
                }
            ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<div class="container-fluid" id="main-content">
        <div class="container">
            <div class="row p-3">
                <div class="col-4"><a class="btn btn-outline-primary" href="#" onclick="mostrar();"><?php echo $boton1;?></a></div>
                <div class="col-4"><a class="btn btn-outline-success" href="#" onclick="mostrar2();"><?php echo $boton2;?></a></div>
                <div class="col-4"><a class="btn btn-outline-info" href="#" onclick="mostrar3();"><?php echo $boton3;?></a></div>
                <?php if($urlmetabase<>""){?>
                    <div class="col-4 mt-2"><a class="btn btn-outline-info" href="#" onclick="mostrar4();">Dash</a></div>
                    <?php }?>
            </div>
        </div>
</div>

<div class="container-fluid" id="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-16">
                <div id="foo"> 

                    <div class="">
                                    <div class="row" style="">
                                        <div class="col-xl-2 col-lg-2">
                                            <div class="card tilebox-one">
                                                <div class="card-body">
                                                    <i class='uil uil-users-alt float-end'></i>
                                                    <h6 class="text-uppercase mt-0">Users</h6>
                                                    <h2 class="my-2" id="active-users-count2"><?php echo  $cantidaduser; ?></h2>
                                                    <p class="mb-0 text-muted">
                                                        <span class="text-success me-2"><span class="mdi mdi-arrow-up-bold"></span></span>
                                                        <span class="text-nowrap"> day</span>
                                                    </p>
                                                    
                                                </div> <!-- end card-body-->
                                            </div>
                                            <!--end card-->

                                            <div class="card tilebox-one">
                                                <div class="card-body">
                                                    <i class='uil uil-window-restore float-end'></i>
                                                    <h6 class="text-uppercase mt-0">Tickets </h6>
                                                    <h2 class="my-2" id="active-views-count2">
                                                        <p id="abiertos"><?php echo $cantidadtickets; ?></p>
                                                    </h2>
                                                    <p class="mb-0 text-muted">
                                                        <span class="text-success me-2"><span class="mdi mdi-arrow-up-bold"></span></span>
                                                        <span class="text-nowrap"> Abiertos</span>
                                                    </p>
                                                
                                                </div> <!-- end card-body-->
                                            </div>

                                           
                                            <!--end card-->


                                        </div> <!-- end col -->
                                        <div class="col-xl-10 col-lg-16">
                                            <div class="row" style="">
                                                    <div class="col-md-4 ">
                                                            <div class="card">
                                                                <div class="card-body" style="width: 400px;">
                                                                <h4 class="header-title">Tickets Por Estado<i title="" class="ri-information-fill"></i></h4>
                                                                <canvas id="myChart2" ></canvas>
                                    
                                                                </div>
                                                            </div> <!-- end card-body-->
                                                    </div>
                                                    <div class="col-md-4 ">
                                                            <div class="card">
                                                                <div class="card-body" style="width: 400px;">
                                                                <h4 class="header-title">Tickets Por Canal<i title="" class="ri-information-fill"></i></h4>
                                                                    <canvas id="myChart3" ></canvas>
                                    
                                                                </div>
                                                            </div> <!-- end card-body-->
                                                    </div>
                                                    <div class="col-md-4 ">
                                                            <div class="card">
                                                                <div class="card-body" style="width: 400px;">
                                                                <h4 class="header-title">Tickets Por Deparrtamento<i title="" class="ri-information-fill"></i></h4>
                                                                <canvas id="myChart" ></canvas>
                                                                </div>
                                                            </div> <!-- end card-body-->
                                                    </div>
                                                   

                                            </div>
                                            <div class="row" style="">
                                                    
                                                    <div class="col-md-4 col-sm-5">
                                                            <div class="card">
                                                                <div class="card-body" style="width: 400px;">
                                                                    <h4 class="header-title">Tickets Por Tema<i title="" class="ri-information-fill"></i></h4>
                                                                    <canvas id="myChart4" ></canvas>
                                                                </div>
                                                            </div> <!-- end card-body-->
                                                    </div>
                                                    <div class="col-md-4 col-sm-5">
                                                            <div class="card">
                                                                <div class="card-body" style="width: 400px;">
                                                                    <h4 class="header-title">Tickets Por Agente <i title="" class="ri-information-fill"></i></h4>
                                                                    <canvas id="myChart5" ></canvas>
                                                                </div>
                                                            </div> <!-- end card-body-->
                                                    </div>

                                            </div>
                                            
                                        </div> <!-- end col -->
                                    </div> <!-- end row-->
                                    </div>
                                    </div>

                                                    </div>
                                                    
                                                </div>
                </div>
                <div id="foo2" style="display:none">
                    <div class="row">
                        <div class="col-lg-4 col-sm-12">
                            <label class="form-label">Período</label>
                            <div id="reportrange" class="form-control" data-toggle="date-picker-range" data-target-display="#reportrange" data-cancel-class="btn-light">
                                <i class="mdi mdi-calendar"></i>&nbsp;
                                <span></span> <i class="mdi mdi-menu-down"></i>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <div class="mb-2 position-relative">
                                <label class="form-label">&nbsp;</label>
                                <input onclick="reportes()" type="submit" type="button" class="form-control w-25 bg-success text-light" value="Buscar">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="">
                                                    <div class="col-md-4 ">
                                                            <div class="card">
                                                                <div class="card-body" style="width: 400px;">
                                                                <h4 class="header-title">Tickets Por Estado<i title="" class="ri-information-fill"></i></h4>
                                                                <canvas id="myChartestadofecha" ></canvas>
                                    
                                                                </div>
                                                            </div> <!-- end card-body-->
                                                    </div>
                                                    
                                                    
                                                    <div class="col-md-4 ">
                                                            <div class="card">
                                                                <div class="card-body" style="width: 400px;">
                                                                <h4 class="header-title">Tickets Por Canal<i title="" class="ri-information-fill"></i></h4>
                                                                    <canvas id="myChartcanalfecha" ></canvas>
                                    
                                                                </div>
                                                            </div> <!-- end card-body-->
                                                    </div>
                                                    <div class="col-md-4 ">
                                                            <div class="card">
                                                                <div class="card-body" style="width: 400px;">
                                                                <h4 class="header-title">Tickets Por Departamento<i title="" class="ri-information-fill"></i></h4>
                                                                <canvas id="myChartdeptofecha" ></canvas>
                                                                </div>
                                                            </div> <!-- end card-body-->
                                                    </div>
                                                   

                    </div>
                    <div class="row" style="">
                                                    <div class="col-md-4 ">
                                                            <div class="card">
                                                                <div class="card-body" style="width: 400px;">
                                                                <h4 class="header-title">Tickets por Tema<i title="" class="ri-information-fill"></i></h4>
                                                                <canvas id="myCharttopicfecha" ></canvas>
                                    
                                                                </div>
                                                            </div> <!-- end card-body-->
                                                    </div>
                                                    <div class="col-md-4 ">
                                                            <div class="card">
                                                                <div class="card-body" style="width: 400px;">
                                                                <h4 class="header-title">Tickets Por Agente<i title="" class="ri-information-fill"></i></h4>
                                                                    <canvas id="myChartagentefecha" ></canvas>
                                    
                                                                </div>
                                                            </div> <!-- end card-body-->
                                                    </div>

                                                    <div class="col-md-4 ">
                                                            <div class="card">
                                                                <div class="card-body" style="width: 400px;">
                                                                <h4 class="header-title">Tickets Por Motivo De Cierre<i title="" class="ri-information-fill"></i></h4>
                                                                    <canvas id="myChartmotivocfecha" ></canvas>
                                    
                                                                </div>
                                                            </div> <!-- end card-body-->
                                                    </div>
                                                  
                                                   

                    </div>
                
                </div>
                <div id="foo3" style="display:none">
                    <div class="row">
                        <div id="logeados">
                        </div>
                    </div>
                </div>
                <div id="foo4" style="display:none">
                    <div class="row">
                        <iframe id="if" onload="resizeIframe(this)" frameborder="0" style="height: 900px; width: 100%;" src='<?php echo $urlmetabase;?>'>
                    </div>
                </div>
</div>


            <!-- Start Content-->
            
        </div>
        <!-- container -->
    </div>
    <!-- content -->
</div>

<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->

</div>
<!-- END wrapper -->
@include('facu.footer2')