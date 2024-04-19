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
<script language="JavaScript">

window.onbeforeunload = saveBeforeExit; 
function saveBeforeExit(){
if (confirm("desea salir sin enviar el mensaje?")) window.location.href = "/salir";
return 0;
} 

</script>
<!-- Begin page -->
<div class="wrapper">

    <!-- ========== Left Sidebar Start ========== -->
    @include('facu.menu')


    <!-- ========== Left Sidebar End ========== -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page" style="padding:0 !important;">
        <div class="content">


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
                        <input onclick="home()" type="submit" type="button" class="form-control w-25 bg-success text-light" value="Buscar">
                    </div>
                </div>
            </div>

            <script>
                let myChart;
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

                function ticketxdepto(url2,result) {

                    axios.get(url2)
                        .then(function(response) {
                            /*
                            for (i = 0; i < response.data.length; i++) {
                                    let ticketabiertos=response.data[i].cantidadtickets2;
                                    console.log(ticketabiertos);
                                    document.getElementById("abiertos").innerHTML =ticketabiertos;
                            }*/
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

                function abiertos(urlabiertos) {
                    axios.get(urlabiertos)
                        .then(function(response) {
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

                    var endDate = $("#reportrange").data('daterangepicker').endDate.format('YYYY-MM-DD');
                    var start = $("#reportrange").data('daterangepicker').startDate.format('YYYY-MM-DD');
                    var URLactual = window.location.href;
                    var porciones = URLactual.split('.');
                    let result = porciones[0].replace("https://", "");

                    urlcerrados = "https://" + result + ".suricata.cloud/api/cerradoscant?ini=" + start + "&fin=" + endDate + "";
                    cerrados(urlcerrados);

                    urlabiertos = "https://" + result + ".suricata.cloud/api/abiertoscant?ini=" + start + "&fin=" + endDate + "";
                    abiertos(urlabiertos);

                    urlticketxdepto = "https://" + result + ".suricata.cloud/api/ticketxdepto?ini=" + start + "&fin=" + endDate + "";
                    ticketxdepto(urlticketxdepto,result);

                }
            </script>
        
            <div>
                   
            </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


            <!-- Start Content-->
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
                                <h2 class="my-2" id="active-views-count2">
                                    <p id="cerrados"><?php echo $cantidadtickets2; ?></p>
                                </h2>
                                <p class="mb-0 text-muted">
                                    <span class="text-danger me-2"><span class="mdi mdi-arrow-down-bold"></span> </span>
                                    <span class="text-nowrap"> close</span>
                                </p>
                            </div> <!-- end card-body-->
                        </div>
                        <!--end card-->


                    </div> <!-- end col -->
                    <div class="col-xl-8 col-lg-14">
                        <div class="row" style="">
                            <div class="col-xl-12 col-lg-24">
                                <div class="card">
                                    <div class="card-body" style="width: 400px;">

                                        <h4 class="header-title">Tickets por Depto<i title="" class="ri-information-fill"></i></h4>
                                        <canvas id="myChart" ></canvas>
                                        <script>
  
</script>

                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div> <!-- end row-->
                    </div> <!-- end col -->
                </div> <!-- end row-->
            </div>
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