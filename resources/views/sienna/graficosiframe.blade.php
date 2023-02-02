

<META HTTP-EQUIV="REFRESH" CONTENT="60">

<script src="https://siennasystem.com//js/Chart.min.js"></script>
<script src="https://siennasystem.com//js/utils.js"></script>
<script src="https://siennasystem.com//assets/libs/apexcharts/apexcharts.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


<div class="col-xs-4">

                                <div id="chart" class="apex-charts" dir="ltr"></div>
                                               
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


                   

