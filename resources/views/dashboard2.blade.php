@include('facu.header2')


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
$query = "select count(*) as cantidaduser  from siennaloginxenioo where login=1 and  DATE(created_at) >= DATE(NOW())";
$resultados = DB::select($query);
$cantidaduser = 0;
$cantidadtickets = 0;
$cantidadtickets2 = 0;
$listamensual = array();
foreach ($resultados as $val) {
    $cantidaduser = $val->cantidaduser;
}

if (isset($_GET['fecha'])) {

    $queryfecha = "";
    if ($_GET['fecha'] == "dia") {

        $queryfecha = "DATE(created_at) >= DATE(NOW())";
    }
    if ($_GET['fecha'] == "semana") {

        $queryfecha = "created_at>= (DATE_SUB(CURRENT_DATE, INTERVAL 7 DAY))";
    }
    $listamensual = array();



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
?>

<script>
    function mostrar() {
        var e = document.getElementById('foo');
        var f = document.getElementById('foo2');
          e.style.display = 'block';
       
          f.style.display = 'none';
    }
    function mostrar2() {
        var e = document.getElementById('foo');
        var f = document.getElementById('foo2');
          e.style.display = 'none';
       
          f.style.display = 'block';
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
                    console.log(labels);

                    console.log(datos);

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
                        beginAtZero: true
                        }
                    }
                    }
                });
                }
                function grafico2(datosp,subdomain_tmp,divss) {
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
                    console.log(labels);

                    console.log(datos);

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
                        beginAtZero: true
                        }
                    }
                    }
                    });


                }
                function grafico3(datosp,subdomain_tmp,divss) {
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
                    console.log(labels);

                    console.log(datos);

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
                        beginAtZero: true
                        }
                    }
                    }
                    });


                }
                function grafico4(datosp,subdomain_tmp,divss) {
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
                    console.log(labels);

                    console.log(datos);

                    const ctx4 = document.getElementById('myChart4');
                    if (myChart4) {
                        myChart4.destroy();
                    }
                    myChart4=new Chart(ctx4, {
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
                        beginAtZero: true
                        }
                    }
                    }
                    });


                }
                function grafico5(datosp,subdomain_tmp,divss) {
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
                    console.log(labels);

                    console.log(datos);

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
                        beginAtZero: true
                        }
                    }
                    }
                    });


                }
                function ticketxdepto(url2,result) {

                    axios.get(url2)
                        .then(function(response) {
                          
                            console.log(response);
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
                            
                                console.log(response);
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
                        
                            console.log(response);
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
                        
                            console.log(response);
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
                        
                            console.log(response);
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
                            console.log(response);
                            for (i = 0; i < response.data.length; i++) {
                                let ticketabiertos = response.data[i].cantidadtickets2;
                                console.log(ticketabiertos);
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
                                console.log(ticketcerrados);
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

                function home() {

                  
                    var URLactual = window.location.href;
                    var porciones = URLactual.split('.');
                    let result = porciones[0].replace("https://", "");

                 //   urlcerrados = "https://" + result + ".suricata.cloud/api/cerradoscant?ini=" + start + "&fin=" + endDate + "";
                   // cerrados(urlcerrados);

                    urlabiertos = "https://" + result + ".suricata.cloud/api/abiertoscant2";
                    abiertos(urlabiertos);

                    urlticketxdepto = "https://" + result + ".suricata.cloud/api/ticketxdepto2";
                    ticketxdepto(urlticketxdepto,result);

                    urlticketxestado = "https://" + result + ".suricata.cloud/api/ticketxestado";
                    ticketxestado(urlticketxestado,result);

                    urlticketxcanal = "https://" + result + ".suricata.cloud/api/ticketxcanal";
                    ticketxcanal(urlticketxcanal,result);

                    urlticketxtopic = "https://" + result + ".suricata.cloud/api/ticketxtopic";
                    ticketxtopic(urlticketxtopic,result);

                    urlticketxagente = "https://" + result + ".suricata.cloud/api/ticketxagente";
                    ticketxagente(urlticketxagente,result);

                }
            </script>
        
            <div>
                   
            </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container-fluid" id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-5"><a href="#" onclick="mostrar();">Dashboard</a></div>
                <div class="col-5"><a href="#" onclick="mostrar2();">Reportes</a></div>
            </div>
        </div>
</div>

<div class="container-fluid" id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-5">
                <div id="foo"> 

                    <div class="col2">
                                    <div class="row" style="">
                                        <div class="col-xl-4 col-lg-4">
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
                                                        <span class="text-nowrap"> open</span>
                                                    </p>
                                                
                                                </div> <!-- end card-body-->
                                            </div>
                                            <!--end card-->


                                        </div> <!-- end col -->
                                        <div class="col-xl-8 col-lg-14">
                                            <div class="row" style="">
                                                    <div class="col">
                                                            <div class="card">
                                                                <div class="card-body" style="width: 300px;">
                                                                <h4 class="header-title">Tickets por Depto<i title="" class="ri-information-fill"></i></h4>
                                                                    <canvas id="myChart" ></canvas>
                                    

                                                            </div> <!-- end card-body-->
                                                    </div>
                                                    <div class="col">
                                                            <div class="card">
                                                                <div class="card-body" style="width: 300px;">
                                                                <h4 class="header-title">Tickets por estado<i title="" class="ri-information-fill"></i></h4>
                                                                <canvas id="myChart2" ></canvas>

                                                            </div> <!-- end card-body-->
                                                    </div>
                                                    <div class="col">
                                                            <div class="card">
                                                                <div class="card-body" style="width: 300px;">
                                                                <h4 class="header-title">Tickets por topic<i title="" class="ri-information-fill"></i></h4>
                                                                <canvas id="myChart4" ></canvas>

                                                            </div> <!-- end card-body-->
                                                    </div>

                                            </div>
                                            <div class="row" style="">

                                                <div class="col-xl-12 col-lg-24">
                                                    <div class="card">
                                                        
                                                        <div class="card-body" style="width: 400px;">

                                                        


                                                        </div> <!-- end card-body-->
                                                        <div class="card-body" style="width: 400px;">

                                                        

                                                        </div> <!-- end card-body-->
                                                        <div class="card-body" style="width: 400px;">

                                                        <h4 class="header-title">Tickets por canal<i title="" class="ri-information-fill"></i></h4>
                                                        <canvas id="myChart3" ></canvas>


                                                        </div> <!-- end card-body-->

                                                        <div class="card-body" style="width: 400px;">

                                                        <h4 class="header-title">Tickets por Agente<i title="" class="ri-information-fill"></i></h4>
                                                        <canvas id="myChart5" ></canvas>


                                                        </div> <!-- end card-body-->
                                                    </div> <!-- end card-->
                                                </div> <!-- end col-->
                                            </div> <!-- end row-->
                                        </div> <!-- end col -->
                                    </div> <!-- end row-->
                                    </div>
                                    </div>

                                                    </div>
                                                    
                                                </div>
                </div>
</div>

<div id="foo2" style="display:none"> This is  DIV 2</div>
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

@include('facu.footer')