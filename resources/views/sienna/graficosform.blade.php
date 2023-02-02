@include('pp.header')
<script src="https://siennasystem.com//js/Chart.min.js"></script>
<script src="https://siennasystem.com//js/utils.js"></script>
<script src="https://siennasystem.com//assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- apexcharts init -->
<div id="principal">
        <div class="mx-auto" style="width: 1000px;margin-top: 70px;">

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade
                            show" role="alert">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <!-- Page Wrapper -->
                <div id="wrapper">
                        <!-- Begin Page Content -->
                        <div class="container">
                                <!-- Page Heading -->
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                        <h1 class="h3 mb-0 text-gray-800">Graficos</h1>
                                </div>


                                <form method="post" action="">
                                        @csrf
                                        <select name="graficos" class="form-select" aria-label="Default select example">
                                                <option <?php if(isset($graficos)){ if ($graficos == "line") {
                                                                echo "selected";
                                                        } }?>>line</option>
                                                <option <?php if(isset($graficos)){ if ($graficos == "area") {
                                                                echo "selected";
                                                        } }?>>area</option>
                                                <option <?php if(isset($graficos)){ if ($graficos == "pie") {
                                                                echo "selected";
                                                        }} ?>>pie</option>
                                                <option <?php if(isset($graficos)){ if ($graficos == "bar") {
                                                                echo "selected";
                                                        }} ?>>bar</option>
                                                <option <?php if(isset($graficos)){ if ($graficos == "radialBar") {
                                                                echo "selected";
                                                        }} ?>>radialBar</option>
                                                <option <?php if(isset($graficos)){ if ($graficos == "donut") {
                                                                echo "selected";
                                                        } }?>>donut</option>

                                        </select>
                                        <input type="hidden" name="id" value="<?php echo $idgrafico; ?>">
                                        <input type="submit" name="enviar" value="Ver">

                                </form>



                        </div>

                        @if(isset($datosget))

                        <div class="container">
                                <!-- Page Heading -->
                                <div class="col-xl-12">
                                        <div class="card">
                                                <div class="card-header">
                                                        <h4 class="card-title mb-0"><?php echo $graficos; ?></h4>
                                                </div>
                                                <div class="card-body">
                                                        <div id="chart" class="apex-charts" dir="ltr"></div>
                                                </div>

                                        </div>
                                </div>
                                <script>
                                        var options = {
                                                chart: {
                                                        height: 320,
                                                        type: '<?php echo $graficos; ?>',
                                                },
                                                <?php $datos = "";
                                                $labels = "";
                                                foreach ($datosget as $resultado) {
                                                        $labels .= "'" . $resultado->name . "',";
                                                        $datos .= "" . $resultado->cant . ",";
                                                }
                                                $labels = substr($labels, 0, -1);
                                                $datos = substr($datos, 0, -1);
                                                ?>
                                                <?php
                                                $os = array("bar", "line", "area");
                                                $bande = in_array($graficos, $os);
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
                                                                text: 'data',
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
                                                                        show: false
                                                                },
                                                        }
                                                }]

                                        }

                                        var chart = new ApexCharts(
                                                document.querySelector("#chart"),
                                                options
                                        );

                                        chart.render();
                                </script>


                        </div>
                        @endif

                </div>
        </div>
</div>
<br><br><br>
@include('pp.footer')