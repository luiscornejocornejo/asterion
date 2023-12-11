@include('facu.header')

  <!-- Begin page -->
  <div class="wrapper">

      <!-- ========== Left Sidebar Start ========== -->
      @include('facu.menu')


      <?php
$subdomain_tmp = 'localhost';
if (isset($_SERVER['HTTP_HOST'])) {
    $domainParts = explode('.', $_SERVER['HTTP_HOST']);
    $subdomain_tmp =  array_shift($domainParts);
} elseif(isset($_SERVER['SERVER_NAME'])){
    $domainParts = explode('.', $_SERVER['SERVER_NAME']);
    $subdomain_tmp =  array_shift($domainParts);
    
}
$subdomain_tmp =trim($subdomain_tmp );


if($_GET['fecha']=="dia"){

    $queryfecha="DATE(created_at) >= DATE(NOW())";
}
if($_GET['fecha']=="semana"){

    $queryfecha="created_at BETWEEN date_add(DATE(NOW()), INTERVAL -7 DAY)";
}
$listamensual=array();

$query="select count(*) as cantidaduser  from siennaloginxenioo where login=1 and  ".$queryfecha;
$resultados = DB::select($query);
$cantidaduser=0;
foreach($resultados as $val){
    $cantidaduser=$val->cantidaduser;
}

$query="select count(*) as cantidadtickets  from siennatickets where siennaestado=1 and  ".$queryfecha;
$resultados2 = DB::select($query);
$cantidadtickets=0;
foreach($resultados2 as $val){
    $cantidadtickets=$val->cantidadtickets;
}


$query="select count(*) as cantidadtickets2  from siennatickets where siennaestado=4 and  ".$queryfecha;
$resultados2 = DB::select($query);
$cantidadtickets2=0;
foreach($resultados2 as $val){
    $cantidadtickets2=$val->cantidadtickets2;
}
?>
      <!-- ========== Left Sidebar End ========== -->

      <!-- ============================================================== -->
      <!-- Start Page Content here -->
      <!-- ============================================================== -->

      <div class="content-page" style="padding:0 !important;">
          <div class="content">

              <!-- Start Content-->
              <div class="container-fluid">
                 <div>
                 <div class="col2">
                            <div class="row" style="">
                                <div class="col-xl-4 col-lg-4">
                                    <div class="card tilebox-one">
                                        <div class="card-body">
                                            <i class='uil uil-users-alt float-end'></i>
                                            <h6 class="text-uppercase mt-0">Users</h6>
                                            <h2 class="my-2" id="active-users-count2"><?php echo  $cantidaduser;?></h2>
                                            <p class="mb-0 text-muted">
                                                <span class="text-success me-2"><span class="mdi mdi-arrow-up-bold"></span></span>
                                                <span class="text-nowrap">  day</span>  
                                            </p>
                                        </div> <!-- end card-body-->
                                    </div>
                                    <!--end card-->

                                    <div class="card tilebox-one">
                                        <div class="card-body">
                                            <i class='uil uil-window-restore float-end'></i>
                                            <h6 class="text-uppercase mt-0">Tickets </h6>
                                            <h2 class="my-2" id="active-views-count2"><?php echo $cantidadtickets;?></h2>
                                            <p class="mb-0 text-muted">
                                                <span class="text-danger me-2"><span class="mdi mdi-arrow-down-bold"></span> </span>
                                                <span class="text-nowrap"> open</span>
                                            </p>
                                            <h2 class="my-2" id="active-views-count2"><?php echo $cantidadtickets2;?></h2>
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
                                                <div class="card-body">
                                                
                                                    <h4 class="header-title">Tickets por estado<i title="Volumen bruto por método de pago antes de descontar comisiones." class="ri-information-fill"></i></h4>
                                                    <div id="chart3" class="apex-charts" dir="ltr"></div>
                                                    <script>
                                                            var options = {
                                                                    chart: {
                                                                            height: 262,
                                                                            width: 750,
                                                                            type: 'donut',
                                                                    },
                                                                    <?php $datos = "";
                                                                    $labels = "";
                                                                    foreach ($listamensual  as $resultado) {

                                                                        $cc=round($resultado->cant,2);
                                                                            $labels .= "'" . $resultado->name . "',";
                                                                            $datos .= "" . $cc . ",";
                                                                    }
                                                                    $labels = substr($labels, 0, -1);
                                                                    $datos = substr($datos, 0, -1);
                                                                    ?>
                                                                    <?php
                                                                    $os = array("bar", "line", "area");
                                                                    $bande = in_array("donut", $os);
                                                                    if ($bande) {


                                                                    ?>
                                                                            series: [{
                                                                                    data: [<?php echo $datos; ?>]
                                                                            }],
                                                                    <?php } else { ?>
                                                                            series: [<?php echo $datos; ?>],

                                                                    <?php   } ?>

                                                                    labels: [<?php echo $labels; ?>],
                                                                    xaxis: {
                                                                            categories: [<?php echo $labels; ?>],

                                                                    },
                                                                    yaxis: {
                                                                            title: {
                                                                                    text: '<?php echo $subdomain_tmp;?>',
                                                                                    style: {
                                                                                            fontWeight: '500',
                                                                                    },
                                                                            }
                                                                    },
                                                                    colors: [
                                                                            window.chartColors.green,
                                                                            window.chartColors.blue,
                                                                            window.chartColors.red,
                                                                            window.chartColors.orange,
                                                                            window.chartColors.yellow,
                                                                            window.chartColors.purple,
                                                                            window.chartColors.grenclaro,
                                                                            window.chartColors.grenclaro1,
                                                                            window.chartColors.grenclaro2,
                                                                            window.chartColors.grenclaro3,
                                                                            window.chartColors.grenclaro4,
                                                                            window.chartColors.grenclaro5
                                                                    ],
                                                                    legend: {
                                                                            show: true,
                                                                            position: 'bottom',
                                                                            horizontalAlign: 'center',
                                                                            verticalAlign: 'middle',
                                                                            floating: false,
                                                                            fontSize: '14px',
                                                                            offsetX: 0,
                                                                    },
                                                                    responsive: [{
                                                                            breakpoint: 600,
                                                                            options: {
                                                                                    chart: {
                                                                                            height: 240
                                                                                    },
                                                                                    legend: {
                                                                                            show: true
                                                                                    },
                                                                            }
                                                                    }]

                                                            }

                                                            var chart = new ApexCharts(
                                                                    document.querySelector("#chart3"),
                                                                    options
                                                            );

                                                            chart.render();
                                                    </script>

                                                
                                                </div> <!-- end card-body-->
                                            </div> <!-- end card-->
                                        </div> <!-- end col-->
                                    </div> <!-- end row-->
                                </div> <!-- end col -->
                            </div> <!-- end row-->
                        </div>
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
