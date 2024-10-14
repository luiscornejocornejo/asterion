@include('facu.header')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    console.log("Ticket Per Channel:", @json($perChannel))
</script>

@if ($tickets[0]->count)
    <div class="wrapper menuitem-active">
        @include('facu.menu')
        <div class="content-page" style="padding: 0!important;">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade
                                show"
                    role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <style>
                .hoverDataTicket:hover {
                    color: #509EE3 !important;
                }
            </style>

            <div class="content">
                <div class="container py-4">
                    <div class="card">
                        <form action="/dash" method="POST">
                            @csrf

                            <div class="row mx-1 my-1">
                                <div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Período</label>
                                        <select name="periodo" id="periodo" class="form-select">
                                            <option value="0">Hoy</option>
                                            <option value="1">Ayer</option>
                                            <option value="2">Ultmos 7 Dias</option>
                                            <option value="3">Ultmos 30 Dias</option>
                                            <option value="4">Mes Actual</option>
                                            <option value="5">Mes Anterior</option>
                                            <option value="6">Rango</option>
                                        </select>


                                    </div>
                                    <div id="rango-fechas" style="display:none;">
                                        <label for="start_date" class="form-label">Fecha de Inicio:</label>
                                        <input type="date" name="start_date" id="start_date"
                                            class="form-control mb-2">

                                        <label for="end_date" class="form-label">Fecha de Fin:</label>
                                        <input type="date" name="end_date" id="end_date" class="form-control">
                                    </div>
                                    <script>
                                        // Mostrar los campos de fecha si el usuario selecciona "Rango"
                                        document.getElementById('periodo').addEventListener('change', function() {
                                            var display = this.value === '6' ? 'block' : 'none';
                                            document.getElementById('rango-fechas').style.display = display;
                                        });
                                    </script>
                                </div>
                                <div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-6">
                                    <label for="channel" class="form-label">Canales</label>
                                    <select name="channel[]" id="channel" multiple="multiple" class="form-select">
                                        @foreach ($sources as $source)
                                            <option value="{{ $source->id }}">
                                                {{ $source->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-6">
                                    <label for="deparment" class="form-label">Departamento</label>
                                    <select name="department[]" id="department" multiple="multiple" class="form-select">

                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">
                                                {{ $department->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-6">
                                    <label for="agent" class="form-label">Agente</label>
                                    <select name="agent[]" id="agent" multiple="multiple" class="form-select">

                                        @foreach ($agents as $agent)
                                            <option value="{{ $agent->id }}">
                                                {{ $agent->nombre }} {{ $agent->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="row mx-1 my-1">
                                <div class="col-xxl-2 col-xl-2 col-lg-4 col-sm-12 mt-2">
                                    <input type="submit" class="btn btn-primary" placeholder="Buscar">
                                </div>
                                <div>
                                    <div class="row mx-1 my-1">
                                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-sm-12 mt-2">
                                            <div class="border rounded text-center"
                                                style="min-height: 250px!important;">
                                                <div class="my-5">
                                                    <span class="h1 hoverDataTicket"
                                                        style="font-size: 3.4rem;">{{ $tickets[0]->count }}</span><br>
                                                    <span class="hoverDataTicket">Tickets creados</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xxl-4 col-xl-4 col-lg-8 col-sm-12 mt-2">
                                            <div class="border rounded" style="min-height: 250px!important;">
                                                <p class="m-1">Ticket por estado</p>
                                                @php
                                                    $series = array_map(function ($item) {
                                                        return $item->count;
                                                    }, $status);

                                                    $labels = array_map(function ($item) {
                                                        return $item->Siennaestado__nombre ?? 'Sin estado';
                                                    }, $status);

                                                @endphp
                                                <div id="chart"></div>



                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        var options = {
                                                            series: @json($series),
                                                            chart: {
                                                                width: '100%',
                                                                height: 380,
                                                                type: 'donut',
                                                                dropShadow: {
                                                                    enabled: true,
                                                                    color: '#111',
                                                                    top: -1,
                                                                    left: 3,
                                                                    blur: 3,
                                                                    opacity: 0.2
                                                                }
                                                            },
                                                            stroke: {
                                                                width: 0,
                                                            },
                                                            plotOptions: {
                                                                pie: {
                                                                    donut: {
                                                                        labels: {
                                                                            show: true,
                                                                            total: {
                                                                                showAlways: true,
                                                                                show: true
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            },
                                                            labels: @json($labels),
                                                            dataLabels: {
                                                                dropShadow: {
                                                                    blur: 3,
                                                                    opacity: 0.8
                                                                }
                                                            },
                                                            fill: {
                                                                type: 'donut',
                                                                opacity: 1,
                                                                pattern: {
                                                                    enabled: true,
                                                                    style: ['verticalLines', 'squares', 'horizontalLines', 'circles', 'slantedLines'],
                                                                },
                                                            },
                                                            states: {
                                                                hover: {
                                                                    filter: 'none'
                                                                }
                                                            },
                                                            theme: {
                                                                palette: 'palette2'
                                                            },
                                                            responsive: [{
                                                                breakpoint: 480,
                                                                options: {
                                                                    chart: {
                                                                        width: 380,
                                                                        height: 250
                                                                    },
                                                                    legend: {
                                                                        position: 'bottom'
                                                                    }
                                                                }
                                                            }]
                                                        };

                                                        var chart = new ApexCharts(document.querySelector("#chart"), options);
                                                        chart.render();

                                                    });
                                                </script>


                                            </div>


                                        </div>

                                        <div class="col-xxl-4 col-xl-4 col-lg-12 col-sm-12 mt-2">
                                            <div class="border rounded" style="min-height: 250px!important;">
                                                <p class="m-1">Ticket por agentes</p>
                                                @php
                                                    $agentSeries = array_map(function ($item) {
                                                        return $item->count;
                                                    }, $perAgent);

                                                    $agentLabels = array_map(function ($item) {
                                                        return $item->{'Users - Asignado__last_name'} ?? 'Sin asignar';
                                                    }, $perAgent);
                                                @endphp
                                                <div id="agentPieChart"></div>
                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        var options = {
                                                            series: @json($agentSeries),
                                                            chart: {
                                                                width: '100%',
                                                                height: 380,
                                                                type: 'donut',
                                                                dropShadow: {
                                                                    enabled: true,
                                                                    color: '#111',
                                                                    top: -1,
                                                                    left: 3,
                                                                    blur: 3,
                                                                    opacity: 0.2
                                                                }
                                                            },
                                                            stroke: {
                                                                width: 0,
                                                            },
                                                            plotOptions: {
                                                                pie: {
                                                                    donut: {
                                                                        labels: {
                                                                            show: true,
                                                                            total: {
                                                                                showAlways: true,
                                                                                show: true
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            },
                                                            labels: @json($agentLabels),
                                                            dataLabels: {
                                                                dropShadow: {
                                                                    blur: 3,
                                                                    opacity: 0.8
                                                                }
                                                            },
                                                            fill: {
                                                                type: 'donut',
                                                                opacity: 1,
                                                                pattern: {
                                                                    enabled: true,
                                                                    style: ['verticalLines', 'squares', 'horizontalLines', 'circles', 'slantedLines'],
                                                                },
                                                            },
                                                            states: {
                                                                hover: {
                                                                    filter: 'none'
                                                                }
                                                            },
                                                            theme: {
                                                                palette: 'palette2'
                                                            },
                                                            responsive: [{
                                                                breakpoint: 480,
                                                                options: {
                                                                    chart: {
                                                                        width: 380,
                                                                        height: 250
                                                                    },
                                                                    legend: {
                                                                        position: 'bottom'
                                                                    }
                                                                }
                                                            }]
                                                        };

                                                        var chartAgent = new ApexCharts(document.querySelector("#agentPieChart"), options);
                                                        chartAgent.render();
                                                    });
                                                </script>
                                            </div>


                                        </div>

                                        <div class="col-xxl-4 col-xl-4 col-lg-12 col-md-12 col-sm-12 mt-2">
                                            <div class="border rounded">
                                                <p class="m-1">Ticket por Canal</p>
                                                @php
                                                    /*
                                                    $seriesChannel = array_map(function ($item) {
                                                        return $item->count;
                                                    }, $perChannel);


                                                    $labelsChannel = array_map(function ($item) {
                                                        return $item->Siennasource__nombre ?? 'Desconocido';
                                                    }, $perChannel);
                                                      */  
                                                    $perChannel = array_map(function($item) {
                                                        return (array) $item;
                                                    }, $perChannel)

                                                    $catPerChannel = [];
                                                    $seriesChannel = [];

                                                    foreach ($departmentByDay as $regChannel) {
                                                    $fecha = $regChannel['Creado'];
                                                    $source = $regChannel['Siennasource__nombre'];
                                                    $count = $regChannel['count'];

                                                    if (!in_array($fecha, $categorias)) {
                                                        $catPerChannel[] = $fecha;
                                                    }

                                                    if (!isset($seriesChannel[$depto])) {
                                                        $seriesChannel[$depto] = [];
                                                    }

                                                    $seriesChannel[$depto][] = $count;
                                                    
                                                    }
                                                    $seriesPerChannel = [];
                                                    foreach ($seriesChannel as $depto => $data) {
                                                        $seriesPerChannel[] = [
                                                            'name' => $depto,
                                                            'data' => $data,
                                                        ];
                                                    }

                                                @endphp
                                                <div id="donut"></div>

                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        document.addEventListener('DOMContentLoaded', function() {
                                                        var options = {
                                                            series: @json($seriesChannel),
                                                            chart: {
                                                                type: 'bar',
                                                                height: 350,
                                                                stacked: true
                                                            },
                                                            responsive: [{
                                                                breakpoint: 480,
                                                                options: {
                                                                    legend: {
                                                                        position: 'bottom',
                                                                        offsetX: -10,
                                                                        offsetY: 0
                                                                    }
                                                                }
                                                            }],
                                                            xaxis: {
                                                                categories: @json($catPerChannel),
                                                            },
                                                            fill: {
                                                                opacity: 1
                                                            },
                                                            legend: {
                                                                position: 'right',
                                                                offsetX: 0,
                                                                offsetY: 50
                                                            },
                                                        };

                                                        var donut = new ApexCharts(
                                                            document.querySelector("#donut"),
                                                            optionDonut
                                                        )
                                                        donut.render();

                                                    });
                                                </script>


                                            </div>


                                        </div>

                                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-sm-12 mt-2">
                                            <div class="border rounded">
                                                <p class="m-1">Ticket por Departamento</p>
                                                @php
                                                    $seriesDept = array_map(function ($item) {
                                                        return $item->count;
                                                    }, $byDepartment);

                                                    $labelsDept = array_map(function ($item) {
                                                        return $item->Siennadepto__nombre ?? 'Desconocido';
                                                    }, $byDepartment);

                                                @endphp
                                                <div id="chartDepartment"></div>

                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        var optionDonut = {
                                                            series: @json($seriesDept),
                                                            labels: @json($labelsDept),
                                                            chart: {
                                                                type: 'polarArea',
                                                            },
                                                            stroke: {
                                                                colors: ['#fff']
                                                            },
                                                            fill: {
                                                                opacity: 0.8
                                                            },
                                                            legend: {
                                                                position: 'left',
                                                                offsetY: 80
                                                            },
                                                            responsive: [{
                                                                breakpoint: 480,
                                                                options: {
                                                                    chart: {
                                                                        width: 380
                                                                    },
                                                                    legend: {
                                                                        position: 'bottom'
                                                                    }
                                                                }
                                                            }]
                                                        };

                                                        var donut = new ApexCharts(
                                                            document.querySelector("#chartDepartment"),
                                                            optionDonut
                                                        )
                                                        donut.render();

                                                    });
                                                </script>


                                            </div>


                                        </div>

                                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-sm-12 mt-2">
                                            <div class="border rounded">
                                                <p class="m-1">Ticket Pendientes</p>
                                                @php
                                                    $seriesDeptPending = array_map(function ($item) {
                                                        return $item->count;
                                                    }, $tickets_pendings);

                                                    $labelsDeptPending = array_map(function ($item) {
                                                        return $item->Siennadepto__nombre ?? 'Desconocido';
                                                    }, $tickets_pendings);

                                                @endphp
                                                <div id="radarTickets"></div>

                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        var options = {
                                                            series: [{
                                                                name: @json($labelsDeptPending),
                                                                data: @json($seriesDeptPending),
                                                            }],
                                                            chart: {
                                                                height: 350,
                                                                type: 'radar',
                                                            },
                                                            dataLabels: {
                                                                enabled: true
                                                            },
                                                            yaxis: {
                                                                stepSize: 20
                                                            },
                                                            xaxis: {
                                                                categories: @json($labelsDeptPending)
                                                            }
                                                        };

                                                        var chart = new ApexCharts(document.querySelector("#radarTickets"), options);
                                                        chart.render();

                                                    });
                                                </script>


                                            </div>


                                        </div>

                                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-sm-12 mt-2">
                                            <div class="border rounded">
                                                <p class="m-1">Tiempo de Vida de Ticket</p>
                                                @php

                                                    $seriesPending = array_map(function ($item) {
                                                        return $item->count;
                                                    }, $ticket_timeLive);

                                                    $labelsPending = array_map(function ($item) {
                                                        return $item->timeoflife ?? 'Desconocido';
                                                    }, $ticket_timeLive);

                                                @endphp
                                                <div id="ticketsPendings"></div>

                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        var options = {
                                                            series: [{
                                                                name: 'Tiempo de Vida de Tickets',
                                                                data: @json($seriesPending)
                                                            }],
                                                            chart: {
                                                                height: 350,
                                                                type: 'bar',
                                                            },
                                                            plotOptions: {
                                                                bar: {
                                                                    borderRadius: 10,
                                                                    dataLabels: {
                                                                        position: 'top', // top, center, bottom
                                                                    },
                                                                }
                                                            },
                                                            dataLabels: {
                                                                enabled: true,
                                                                offsetY: -20,
                                                                style: {
                                                                    fontSize: '12px',
                                                                    colors: ["#304758"]
                                                                }
                                                            },

                                                            xaxis: {
                                                                categories: @json($labelsPending),
                                                                position: 'top',
                                                                axisBorder: {
                                                                    show: false
                                                                },
                                                                axisTicks: {
                                                                    show: false
                                                                },
                                                                crosshairs: {
                                                                    fill: {
                                                                        type: 'gradient',
                                                                        gradient: {
                                                                            colorFrom: '#D8E3F0',
                                                                            colorTo: '#BED1E6',
                                                                            stops: [0, 100],
                                                                            opacityFrom: 0.4,
                                                                            opacityTo: 0.5,
                                                                        }
                                                                    }
                                                                },
                                                                tooltip: {
                                                                    enabled: true,
                                                                }
                                                            },
                                                            yaxis: {
                                                                axisBorder: {
                                                                    show: false
                                                                },
                                                                axisTicks: {
                                                                    show: false,
                                                                },
                                                                labels: {
                                                                    show: false,
                                                                    formatter: function(val) {
                                                                        return val + " Minutos";
                                                                    }
                                                                }

                                                            },
                                                            title: {
                                                                text: 'Expresados en minutos',
                                                                floating: true,
                                                                offsetY: 330,
                                                                align: 'center',
                                                                style: {
                                                                    color: '#444'
                                                                }
                                                            }
                                                        };

                                                        var chart = new ApexCharts(document.querySelector("#ticketsPendings"), options);
                                                        chart.render();


                                                    });
                                                </script>


                                            </div>


                                        </div>

                                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-sm-12 mt-2">
                                            <div class="border rounded">
                                                <p class="m-1">Tiempo Por Departamento Diario</p>
                                                @php
                                                    $departmentByDay = array_map(function ($item) {
                                                        return (array) $item;
                                                    }, $departmentByDay);

                                                    $categorias = [];
                                                    $seriesData = [];

                                                    foreach ($departmentByDay as $registro) {
                                                        $fecha = $registro['Creado'];
                                                        $depto = $registro['Siennadepto__nombre'];
                                                        $count = $registro['count'];

                                                        if (!in_array($fecha, $categorias)) {
                                                            $categorias[] = $fecha;
                                                        }

                                                        if (!isset($seriesData[$depto])) {
                                                            $seriesData[$depto] = [];
                                                        }

                                                        $seriesData[$depto][] = $count;
                                                    }

                                                    $series = [];
                                                    foreach ($seriesData as $depto => $data) {
                                                        $series[] = [
                                                            'name' => $depto,
                                                            'data' => $data,
                                                        ];
                                                    }
                                                @endphp
                                                <div id="ticketsByDeptDiary"></div>

                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        var options = {
                                                            series: @json($series),
                                                            chart: {
                                                                type: 'bar',
                                                                height: 350,
                                                                stacked: true,
                                                                toolbar: {
                                                                    show: true
                                                                },
                                                                zoom: {
                                                                    enabled: true
                                                                }
                                                            },
                                                            responsive: [{
                                                                breakpoint: 480,
                                                                options: {
                                                                    legend: {
                                                                        position: 'bottom',
                                                                        offsetX: -10,
                                                                        offsetY: 0
                                                                    }
                                                                }
                                                            }],
                                                            xaxis: {
                                                                categories: @json($categorias),
                                                            },
                                                            fill: {
                                                                opacity: 1
                                                            },
                                                            legend: {
                                                                position: 'right',
                                                                offsetX: 0,
                                                                offsetY: 50
                                                            },
                                                        };

                                                        var chart = new ApexCharts(document.querySelector("#ticketsByDeptDiary"), options);
                                                        chart.render();
                                                    });
                                                </script>
                                            </div>


                                        </div>

                                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-sm-12 mt-2">
                                            <div class="border rounded">
                                                <p class="m-1">Topics pendientes</p>
                                                @php
                                                    $seriesTopicPending = array_map(function ($item) {
                                                        return $item->count;
                                                    }, $pendingByTopic);

                                                    $labelsTopicPending = array_map(function ($item) {
                                                        return $item->Siennatopic__nombre ?? 'Sin Topic';
                                                    }, $pendingByTopic);

                                                @endphp
                                                <div id="ticketPendingTopic"></div>

                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        var options = {
                                                            series: @json($seriesTopicPending),
                                                            chart: {
                                                                width: 380,
                                                                type: 'donut',
                                                                dropShadow: {
                                                                    enabled: true,
                                                                    color: '#111',
                                                                    top: -1,
                                                                    left: 3,
                                                                    blur: 3,
                                                                    opacity: 0.2
                                                                }
                                                            },
                                                            stroke: {
                                                                width: 0,
                                                            },
                                                            plotOptions: {
                                                                pie: {
                                                                    donut: {
                                                                        labels: {
                                                                            show: true,
                                                                            total: {
                                                                                showAlways: true,
                                                                                show: true
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            },
                                                            labels: @json($labelsTopicPending),
                                                            dataLabels: {
                                                                dropShadow: {
                                                                    blur: 3,
                                                                    opacity: 0.8
                                                                }
                                                            },
                                                            fill: {
                                                                type: 'donut',
                                                                opacity: 1,
                                                                pattern: {
                                                                    enabled: true,
                                                                    style: ['verticalLines', 'squares', 'horizontalLines', 'circles', 'slantedLines'],
                                                                },
                                                            },
                                                            states: {
                                                                hover: {
                                                                    filter: 'none'
                                                                }
                                                            },
                                                            theme: {
                                                                palette: 'palette2'
                                                            },
                                                            responsive: [{
                                                                breakpoint: 480,
                                                                options: {
                                                                    chart: {
                                                                        width: 380
                                                                    },
                                                                    legend: {
                                                                        position: 'bottom'
                                                                    }
                                                                }
                                                            }]
                                                        };

                                                        var chart = new ApexCharts(document.querySelector("#ticketPendingTopic"), options);
                                                        chart.render();

                                                    });
                                                </script>

                                            </div>


                                        </div>

                                        <div class="col-xxl-8 col-xl-8 col-lg-8 col-sm-12 mt-2">
                                            <div class="border rounded">
                                                <p class="m-1">Topics por Día</p>
                                                @php
                                                    $topicPerDay = array_map(function ($item) {
                                                        return (array) $item;
                                                    }, $topicPerDay);

                                                    $cat = [];
                                                    $seriesTopicPending = [];

                                                    foreach ($topicPerDay as $register) {
                                                        $dateTopic = $register['Creado'];
                                                        $deptoTopic = $register['Siennatopic__nombre'];
                                                        $countTopic = $register['count'];

                                                        if (!in_array($dateTopic, $cat)) {
                                                            $cat[] = $dateTopic;
                                                        }

                                                        if (!isset($seriesData[$deptoTopic])) {
                                                            $seriesData[$deptoTopic] = [];
                                                        }

                                                        $seriesDataTopic[$deptoTopic][] = $countTopic;
                                                    }

                                                    $series = [];
                                                    foreach ($seriesDataTopic as $deptoTopic => $data) {
                                                        $series[] = [
                                                            'name' => $deptoTopic,
                                                            'data' => $data,
                                                        ];
                                                    }
                                                @endphp

                                                <div id="ticketTopicDay"></div>

                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        var options = {
                                                            series: @json($series),
                                                            chart: {
                                                                type: 'bar',
                                                                height: 350,
                                                                stacked: true
                                                            },
                                                            responsive: [{
                                                                breakpoint: 480,
                                                                options: {
                                                                    legend: {
                                                                        position: 'bottom',
                                                                        offsetX: -10,
                                                                        offsetY: 0
                                                                    }
                                                                }
                                                            }],
                                                            xaxis: {
                                                                categories: @json($cat),
                                                            },
                                                            fill: {
                                                                opacity: 1
                                                            },
                                                            legend: {
                                                                position: 'right',
                                                                offsetX: 0,
                                                                offsetY: 50
                                                            },
                                                        };
                                                        var chart = new ApexCharts(document.querySelector("#ticketTopicDay"), options);
                                                        chart.render();
                                                    });
                                                </script>



                                            </div>


                                        </div>
                                    </div>


                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@else
    <div class="container">
        <div class="mt-2">
            <div class="border rounded text-center" style="min-height: 250px!important;">
                <div class="my-5">
                    <h2 class="text-center">No hay información que mostrar</h2>
                </div>
            </div>
        </div>
    </div>
@endif
@include('facu.footer')
