@include('facu.header')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<?php

$subdomain_tmp = 'localhost';
if (isset($_SERVER['HTTP_HOST'])) {
    $domainParts = explode('.', $_SERVER['HTTP_HOST']);
    $subdomain_tmp = array_shift($domainParts);
} elseif (isset($_SERVER['SERVER_NAME'])) {
    $domainParts = explode('.', $_SERVER['SERVER_NAME']);
    $subdomain_tmp = array_shift($domainParts);
}

?>

<div class="wrapper menuitem-active">
    @include('facu.menu')
    <div class="content-page" style="padding: 0!important;">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade
                    show" role="alert">
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
            <div class="container">
                <ul class="nav nav-pills bg-nav-pills nav-justified mt-4">
                    <li class="nav-item">
                        <a href="#dashboard" data-bs-toggle="tab" aria-expanded="false"
                            class="nav-link rounded-0 active">
                            <i class="mdi mdi-home-variant d-md-none d-block"></i>
                            <span class="d-none d-md-block">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#logged" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                            <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                            <span class="d-none d-md-block">Agentes en línea</span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane show active" id="dashboard">

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
                                        <select name="department[]" id="department" multiple="multiple"
                                            class="form-select">

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
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-sm-12 mt-2">
                                        <div>
                                            <input type="submit" class="btn btn-primary rounded-pill" value="Buscar">
                                            @if ($tickets[0]->count)
                                                <button type="button" onclick="sendFormWithAxios()"
                                                    class="btn btn-success rounded-pill">Generar reporte</button>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <!-- Aca van los filtros -->
                                        @if ($filter[2])
                                            @if (count($perAgent) > 1)
                                                @foreach ($perAgent as $agentSelected)
                                                    <span class="badge bg-secondary rounded-pill"
                                                        style="font-size: 14px">{{ $agentSelected->{'Users - Asignado__nombre'} }}</span>
                                                @endforeach
                                            @else
                                                <span class="badge bg-secondary rounded-pill"
                                                    style="font-size: 14px">{{ $perAgent[0]->{'Users - Asignado__nombre'} }}</span>
                                            @endif
                                        @endif

                                        @if ($filter[1])
                                            @if (count($byDepartment) > 1)
                                                @foreach ($byDepartment as $departmentSelected)
                                                    <span class="badge bg-info rounded-pill"
                                                        style="font-size: 14px">{{ $departmentSelected->{'Siennadepto__nombre'} }}</span>
                                                @endforeach
                                            @else
                                                <span class="badge bg-info rounded-pill"
                                                    style="font-size: 14px">{{ $byDepartment[0]->{'Siennadepto__nombre'} }}</span>
                                            @endif
                                        @endif

                                        @if ($filter[0])
                                            @if (count($perChannel) > 1)
                                                @foreach ($perChannel as $channelSelected)
                                                    <span class="badge bg-success rounded-pill"
                                                        style="font-size: 14px">{{ $channelSelected->{'Siennasource__nombre'} }}</span>
                                                @endforeach
                                            @else
                                                <span class="badge bg-success rounded-pill"
                                                    style="font-size: 14px">{{ $perChannel[0]->{'Siennasource__nombre'} }}</span>
                                            @endif
                                        @endif

                                        @if (isset($filter[3]))
                                            @if ($filter[3] == 0)
                                                <span class="badge bg-dark rounded-pill"
                                                    style="font-size: 14px">Hoy</span>
                                            @elseif ($filter[3] == 1)
                                                <span class="badge bg-dark rounded-pill"
                                                    style="font-size: 14px">Ayer</span>
                                            @elseif ($filter[3] == 2)
                                                <span class="badge bg-dark rounded-pill"
                                                    style="font-size: 14px">Últimos 7 días</span>
                                            @elseif ($filter[3] == 3)
                                                <span class="badge bg-dark rounded-pill"
                                                    style="font-size: 14px">Últimos 30 días</span>
                                            @elseif ($filter[3] == 4)
                                                <span class="badge bg-dark rounded-pill" style="font-size: 14px">Mes
                                                    actual</span>
                                            @elseif ($filter[3] == 5)
                                                <span class="badge bg-dark rounded-pill" style="font-size: 14px">Mes
                                                    anterior</span>
                                            @elseif (is_array($filter[3]) && count($filter[3]) > 1)
                                                <span class="badge bg-dark rounded-pill"
                                                    style="font-size: 14px">{{ $filter[3][0] }} a
                                                    {{ $filter[3][1] }}</span>
                                            @endif
                                        @endif

                                    </div>
                                    <div>
                                        @if ($tickets[0]->count)
                                            <div class="row mx-1 my-1">
                                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-sm-12 mt-2">
                                                    <div class="border rounded position-relative text-center"
                                                        style="min-height: 421.61px;!important;">
                                                        <div
                                                            class="position-absolute top-50 start-50 translate-middle">
                                                            <span class="h1 hoverDataTicket"
                                                                style="font-size: 3.4rem;">{{ $tickets[0]->count }}</span><br>
                                                            <span class="hoverDataTicket">Tickets creados</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xxl-4 col-xl-4 col-lg-8 col-sm-12 mt-2">
                                                    <div class="border rounded">
                                                        <p class="m-1">
                                                            Ticket por estado
                                                        </p>
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
                                                                var colors = [
                                                                    "#727cf5", "#0acf97", "#fa5c7c", "#39afd1", "#6c757d", "#ffbc00", "#8f75da",
                                                                    "#ff6f61", "#28a745", "#007bff", "#ff8b00", "#dc3545", "#6610f2", "#fd7e14",
                                                                    "#20c997", "#17a2b8", "#e83e8c", "#6f42c1", "#ffc107", "#343a40"
                                                                ]
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
                                                                    colors: colors,
                                                                    plotOptions: {
                                                                        pie: {
                                                                            donut: {
                                                                                labels: {
                                                                                    show: true,
                                                                                    total: {
                                                                                        showAlways: true,
                                                                                        show: true
                                                                                    }
                                                                                },
                                                                                size: '70%'
                                                                            }
                                                                        }
                                                                    },
                                                                    labels: @json($labels),
                                                                    legend: {
                                                                        position: 'bottom',
                                                                        horizontalAlign: 'center',
                                                                        formatter: function(label, opts) {
                                                                            if (label.length > 10) {
                                                                                return label.substring(0, 10) + '...';
                                                                            }
                                                                            return label;
                                                                        }
                                                                    },
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
                                                                return $item->{'Users - Asignado__last_name'} ??
                                                                    'Sin asignar';
                                                            }, $perAgent);
                                                        @endphp
                                                        <div id="agentPieChart"></div>
                                                        <script>
                                                            document.addEventListener('DOMContentLoaded', function() {
                                                                var colors = [
                                                                    "#727cf5", "#0acf97", "#fa5c7c", "#39afd1", "#6c757d", "#ffbc00", "#8f75da",
                                                                    "#ff6f61", "#28a745", "#007bff", "#ff8b00", "#dc3545", "#6610f2", "#fd7e14",
                                                                    "#20c997", "#17a2b8", "#e83e8c", "#6f42c1", "#ffc107", "#343a40"
                                                                ]
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
                                                                    colors: colors,
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
                                                                                },
                                                                                size: '70%'
                                                                            }
                                                                        }
                                                                    },
                                                                    labels: @json($agentLabels),
                                                                    legend: {
                                                                        position: 'bottom',
                                                                        horizontalAlign: 'center',
                                                                        formatter: function(label, opts) {
                                                                            if (label.length > 10) {
                                                                                return label.substring(0, 10) + '...';
                                                                            }
                                                                            return label;
                                                                        }
                                                                    },
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
                                                            $seriesChannel = array_map(function ($item) {
                                                                return $item->count;
                                                            }, $perChannel);

                                                            $labelsChannel = array_map(function ($item) {
                                                                return $item->Siennasource__nombre ?? 'Desconocido';
                                                            }, $perChannel);

                                                        @endphp
                                                        <div id="donut"></div>

                                                        <script>
                                                            document.addEventListener('DOMContentLoaded', function() {
                                                                var colors = ['#1E90FF', '#FF6347', '#32CD32', '#FFD700', '#FF69B4'];
                                                                var options = {
                                                                    series: [{
                                                                        name: "Total",
                                                                        data: @json($seriesChannel)
                                                                    }],
                                                                    chart: {
                                                                        height: 350,
                                                                        type: 'bar',
                                                                        events: {
                                                                            click: function(chart, w, e) {
                                                                                // console.log(chart, w, e)
                                                                            }
                                                                        }
                                                                    },
                                                                    colors: colors,
                                                                    plotOptions: {
                                                                        bar: {
                                                                            columnWidth: '45%',
                                                                            distributed: true,
                                                                        }
                                                                    },
                                                                    dataLabels: {
                                                                        enabled: false
                                                                    },
                                                                    legend: {
                                                                        show: false
                                                                    },
                                                                    xaxis: {
                                                                        categories: @json($labelsChannel),
                                                                        labels: {
                                                                            style: {
                                                                                colors: colors,
                                                                                fontSize: '12px'
                                                                            }
                                                                        }
                                                                    }
                                                                }

                                                                var donut = new ApexCharts(
                                                                    document.querySelector("#donut"),
                                                                    options // Cambiar de 'optionDonut' a 'options'
                                                                );
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
                                                                var colors = [
                                                                    "#727cf5", "#0acf97", "#fa5c7c", "#39afd1", "#6c757d", "#ffbc00", "#8f75da",
                                                                    "#ff6f61", "#28a745", "#007bff", "#ff8b00", "#dc3545", "#6610f2", "#fd7e14",
                                                                    "#20c997", "#17a2b8", "#e83e8c", "#6f42c1", "#ffc107", "#343a40"
                                                                ]
                                                                var options = {
                                                                    series: [{
                                                                        name: "Total",
                                                                        data: @json($seriesDept)
                                                                    }],
                                                                    chart: {
                                                                        height: 350,
                                                                        type: 'bar',
                                                                        events: {
                                                                            click: function(chart, w, e) {
                                                                                // console.log(chart, w, e)
                                                                            }
                                                                        }
                                                                    },
                                                                    colors: colors,
                                                                    plotOptions: {
                                                                        bar: {
                                                                            columnWidth: '45%',
                                                                            distributed: true,
                                                                        }
                                                                    },
                                                                    dataLabels: {
                                                                        enabled: false
                                                                    },
                                                                    legend: {
                                                                        show: false
                                                                    },
                                                                    xaxis: {
                                                                        categories: @json($labelsDept),
                                                                        labels: {
                                                                            style: {
                                                                                colors: colors,
                                                                                fontSize: '12px'
                                                                            }
                                                                        }
                                                                    },

                                                                }

                                                                var donut = new ApexCharts(
                                                                    document.querySelector("#chartDepartment"),
                                                                    options
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
                                                                var colors = [
                                                                    "#727cf5", "#0acf97", "#fa5c7c", "#39afd1", "#6c757d", "#ffbc00", "#8f75da",
                                                                    "#ff6f61", "#28a745", "#007bff", "#ff8b00", "#dc3545", "#6610f2", "#fd7e14",
                                                                    "#20c997", "#17a2b8", "#e83e8c", "#6f42c1", "#ffc107", "#343a40"
                                                                ]
                                                                var options = {
                                                                    series: @json($seriesDeptPending),
                                                                    chart: {
                                                                        height: 360,
                                                                        type: 'radialBar',
                                                                    },
                                                                    colors: colors,
                                                                    plotOptions: {
                                                                        radialBar: {
                                                                            offsetY: 0,
                                                                            startAngle: 0,
                                                                            endAngle: 270,
                                                                            hollow: {
                                                                                margin: 3,
                                                                                size: '20%',
                                                                                background: 'transparent',
                                                                                image: undefined,
                                                                            },
                                                                            dataLabels: {
                                                                                name: {
                                                                                    show: false,
                                                                                },
                                                                                value: {
                                                                                    show: false,
                                                                                }
                                                                            },
                                                                            barLabels: {
                                                                                enabled: true,
                                                                                useSeriesColors: true,
                                                                                offsetX: -8,
                                                                                fontSize: '12px',
                                                                                formatter: function(seriesName, opts) {
                                                                                    return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex]
                                                                                },
                                                                            },
                                                                        }
                                                                    },
                                                                    labels: @json($labelsDeptPending),
                                                                    responsive: [{
                                                                        breakpoint: 350,
                                                                        options: {
                                                                            legend: {
                                                                                show: false
                                                                            }
                                                                        }
                                                                    }]
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
                                                                var colors = [
                                                                    "#727cf5", "#0acf97", "#fa5c7c", "#39afd1", "#6c757d", "#ffbc00", "#8f75da",
                                                                    "#ff6f61", "#28a745", "#007bff", "#ff8b00", "#dc3545", "#6610f2", "#fd7e14",
                                                                    "#20c997", "#17a2b8", "#e83e8c", "#6f42c1", "#ffc107", "#343a40"
                                                                ]
                                                                var options = {
                                                                    series: [{
                                                                        name: 'Tiempo de Vida de Tickets',
                                                                        data: @json($seriesPending)
                                                                    }],
                                                                    chart: {
                                                                        height: 350,
                                                                        type: 'bar',
                                                                    },
                                                                    colors: colors,
                                                                    plotOptions: {
                                                                        bar: {
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
                                                                        labels: {
                                                                            show: false
                                                                        },
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
                                                                            enabled: false,
                                                                        },
                                                                        labels: {
                                                                            show: false
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
                                                                var colors = [
                                                                    "#727cf5", "#0acf97", "#fa5c7c", "#39afd1", "#6c757d", "#ffbc00", "#8f75da",
                                                                    "#ff6f61", "#28a745", "#007bff", "#ff8b00", "#dc3545", "#6610f2", "#fd7e14",
                                                                    "#20c997", "#17a2b8", "#e83e8c", "#6f42c1", "#ffc107", "#343a40"
                                                                ]
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
                                                                    colors: colors,
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
                                                                        labels: {
                                                                            show: false
                                                                        },
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
                                                                var colors = [
                                                                    "#727cf5", "#0acf97", "#fa5c7c", "#39afd1", "#6c757d", "#ffbc00", "#8f75da",
                                                                    "#ff6f61", "#28a745", "#007bff", "#ff8b00", "#dc3545", "#6610f2", "#fd7e14",
                                                                    "#20c997", "#17a2b8", "#e83e8c", "#6f42c1", "#ffc107", "#343a40"
                                                                ]
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
                                                                    colors: colors,
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
                                                                    legend: {
                                                                        position: 'bottom',
                                                                        horizontalAlign: 'center',
                                                                        formatter: function(label, opts) {
                                                                            if (label.length > 10) {
                                                                                return label.substring(0, 10) + '...';
                                                                            }
                                                                            return label;
                                                                        }
                                                                    },
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
                                                                var colors = [
                                                                    "#727cf5", "#0acf97", "#fa5c7c", "#39afd1", "#6c757d", "#ffbc00", "#8f75da",
                                                                    "#ff6f61", "#28a745", "#007bff", "#ff8b00", "#dc3545", "#6610f2", "#fd7e14",
                                                                    "#20c997", "#17a2b8", "#e83e8c", "#6f42c1", "#ffc107", "#343a40"
                                                                ]
                                                                var options = {
                                                                    series: @json($series),
                                                                    chart: {
                                                                        type: 'bar',
                                                                        height: 350,
                                                                        stacked: true
                                                                    },
                                                                    colors: colors,
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
                                                                        labels: {
                                                                            show: false
                                                                        },
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
                                        @else
                                            <div class="bg-white">
                                                <div class="border rounded text-center"
                                                    style="min-height: 250px!important;">
                                                    <div class="my-5">
                                                        <img src="assetsfacu/images/svg/file-searching.svg"
                                                            height="90" alt="Without information">
                                                        <h2 class="text-center">No hay información que mostrar.</h2>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="logged">
            <div id="logeados"></div>
        </div>
    </div>
</div>
</div>


@include('facu.footer')


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.15.1/xlsx.full.min.js"></script>
<script>
    function sendFormWithAxios() {
        var ticket_ids = @json($qtyTickets);
        let tickets = ticket_ids.map(item => item.id).join(',');

        axios.post('https://{{ $subdomain_tmp }}.suricata.cloud/dashreport', {
                ticket_ids: tickets,
                _token: document.querySelector('input[name="_token"]').value
            })
            .then(function(response) {
                console.log(response.data);

                var wb = XLSX.utils.book_new();
                var ws = XLSX.utils.json_to_sheet(response.data);

                XLSX.utils.book_append_sheet(wb, ws, "Reporte");
                const day = new Date()
                XLSX.writeFile(wb, `${day}.xlsx`);

            })
            .catch(function(error) {
                console.error(error);
                alert('Error al generar el reporte.');
            });
    }

    var URLactual = window.location.href;
    var porciones = URLactual.split('.');
    let result = porciones[0].replace("https://", "");
    urllogeados = "https://" + result + ".suricata.cloud/api/logeados";
    console.log(urllogeados)
    function logeados(urllogeados) {
        axios.get(urllogeados)
            .then(function(response) {
                sd = '<table id="example2"  class="table table-striped dt-responsive nowrap w-100 text-light">' +
                    '<thead>' +
                    '     <tr class="text-center bg-dark" >' +


                    '        <th class="text-light">Usuario</th>' +
                    '        <th class="text-light">Area</th>' +
                    '        <th class="text-light">Tipo</th>' +
                    '        <th class="text-light">Inicio</th>' +

                    '        ' +
                    '    </tr>' +
                    ' </thead>' +
                    ' <tbody id="tb">' +

                    ' </tbody>' +
                    ' </table>';

                tt = "";
                for (i = 0; i < response.data.length; i++) {
                    let usu = response.data[i].usu;
                    let area = response.data[i].area;

                    tt += '<tr class="text-center">' +
                        ' <td>' + response.data[i].usu + '</td>' +
                        ' <td>' + response.data[i].area + '</td>' +
                        ' <td>' + response.data[i].tipo + '</td>' +
                        ' <td>' + response.data[i].inicio + '</td></tr>';

                }

                document.getElementById("logeados").innerHTML = null;
                document.getElementById("logeados").innerHTML = sd;
                document.getElementById("tb").innerHTML = null;
                document.getElementById("tb").innerHTML = tt;
                $('#example2').dataTable({
                    "order": [
                        [0, 'desc']
                    ],
                    "pageLength": 25,
                    select: true,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                    },
                    dom: 'Bfrtip',
                    initComplete: function() {
                        var api = this.api();

                        // For each column

                        api
                            .columns()
                            .eq(0)
                            .each(function(colIdx) {
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
                                    .on('change', function(e) {
                                        // Get the search value
                                        $(this).attr('title', $(this).val());
                                        var regexr =
                                            '({search})'; //$(this).parents('th').find('select').val();

                                        var cursorPosition = this.selectionStart;
                                        // Search the column for that value
                                        api
                                            .column(colIdx)
                                            .search(
                                                this.value != '' ?
                                                regexr.replace('{search}', '(((' + this.value +
                                                    ')))') :
                                                '',
                                                this.value != '',
                                                this.value == ''
                                            )
                                            .draw();
                                    })
                                    .on('keyup', function(e) {
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
</script>
