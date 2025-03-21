@include('facu.header')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    console.log("Filtros:", @json($filter))
    console.log("Encuestas realizadas:", @json($surveySended))
</script>

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
            <div class="container py-4">
                <ul class="nav nav-pills bg-nav-pills nav-justified mt-4">
                    <li class="nav-item">
                        <a href="#csat" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 active">
                            <i class="mdi mdi-home-variant d-md-none d-block"></i>
                            <span class="d-none d-md-block">CSAT</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-pane show active" id="csat">
                    <div class="content">

                        <div class="card">
                            <form action="/surveys" method="POST">
                                @csrf
                                <div class="row mx-1 my-1">
                                    <div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Período</label>
                                            <select name="periodoCsat" id="periodoCSAT" class="form-select">
                                                <option value="0">Hoy</option>
                                                <option value="1">Ayer</option>
                                                <option value="2">Ultmos 7 Dias</option>
                                                <option value="3">Ultmos 30 Dias</option>
                                                <option value="4">Mes Actual</option>
                                                <option value="5">Mes Anterior</option>
                                                <option value="6">Rango</option>
                                            </select>
                                        </div>
                                        <div id="rango-fechasCsat" style="display:none;">
                                            <label for="start_date" class="form-label">Fecha de Inicio:</label>
                                            <input type="date" name="start_date" id="start_date"
                                                class="form-control mb-2">

                                            <label for="end_date" class="form-label">Fecha de Fin:</label>
                                            <input type="date" name="end_date" id="end_date" class="form-control">
                                        </div>
                                        <script>
                                            // Mostrar los campos de fecha si el usuario selecciona "Rango"
                                            document.getElementById('periodoCSAT').addEventListener('change', function() {
                                                var display = this.value === '6' ? 'block' : 'none';
                                                document.getElementById('rango-fechasCsat').style.display = display;
                                            });
                                        </script>
                                    </div>
                                    <div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-6">
                                        <label for="channelCsat" class="form-label">Canales</label>
                                        <select name="channelCsat[]" id="channelCsat" multiple="multiple"
                                            class="form-select">
                                            @foreach ($sources as $source)
                                                <option value="{{ $source->id }}">
                                                    {{ $source->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-6">
                                        <label for="deparment" class="form-label">Departamento</label>
                                        <select name="departmentCsat[]" id="department" multiple="multiple"
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
                                        <select name="agentCsat[]" id="agent" multiple="multiple"
                                            class="form-select">

                                            @foreach ($agents as $agent)
                                                <option value="{{ $agent->id }}">
                                                    {{ $agent->nombre }} {{ $agent->last_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="row my-1">
                                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-sm-12 mt-2">
                                            <input type="submit" class="btn btn-primary rounded-pill" value="Buscar">
                                            @if (isset($totalCsat[0]->avg))
                                                <button type="button" onclick="sendFormWithAxios()"
                                                    class="btn btn-success rounded-pill">Generar reporte</button>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mt-2">
                                        <!-- Aca van los filtros -->
                                        @if (!empty($filter[2]))
                                            @if (count($surveySended) > 1)
                                                @php
                                                    $showAgent = [];
                                                @endphp
                                                @foreach ($surveySended as $agentSelected)
                                                    @if (!in_array($agentSelected->Agent_Name, $showAgent))
                                                        <span class="badge bg-secondary rounded-pill"
                                                            style="font-size: 14px">
                                                            {{ $agentSelected->Agent_Name }}
                                                        </span>
                                                        @php
                                                            $showAgent[] = $agentSelected->Agent_Name;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            @elseif(count($surveySended) == 1)
                                                <span class="badge bg-secondary rounded-pill"
                                                    style="font-size: 14px">{{ $surveySended[0]->Agent_Name }}</span>
                                            @endif
                                        @endif

                                        @if (!empty($filter[1]))
                                            @if (count($surveySended) > 1)
                                                @php
                                                    $showDepartment = [];
                                                @endphp
                                                @foreach ($surveySended as $departmentSelected)
                                                    @if (!in_array($departmentSelected->Depto, $showDepartment))
                                                        <span class="badge bg-secondary rounded-pill"
                                                            style="font-size: 14px">
                                                            {{ $departmentSelected->Depto }}
                                                        </span>
                                                        @php
                                                            $showDepartment[] = $departmentSelected->Depto;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            @elseif(count($surveySended) == 1)
                                                <span class="badge bg-info rounded-pill"
                                                    style="font-size: 14px">{{ $surveySended[0]->Depto }}</span>
                                            @endif
                                        @endif

                                        @if (!empty($filter[0]))
                                            @if (count($surverPerChannel) > 1)
                                                @php
                                                    $shownChannels = [];
                                                @endphp

                                                @foreach ($surverPerChannel as $channelSelected)
                                                    @if (!in_array($channelSelected->{'Siennasource__nombre'}, $shownChannels))
                                                        <span class="badge bg-success rounded-pill"
                                                            style="font-size: 14px">
                                                            {{ $channelSelected->{'Siennasource__nombre'} }}
                                                        </span>
                                                        @php
                                                            $shownChannels[] =
                                                                $channelSelected->{'Siennasource__nombre'};
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            @elseif(count($surverPerChannel) == 1)
                                                <span class="badge bg-success rounded-pill"
                                                    style="font-size: 14px">{{ $surverPerChannel[0]->{'Siennasource__nombre'} }}</span>
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
                                    @if (isset($totalCsat[0]->avg))
                                        <div class="row my-1">
                                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-sm-12 mt-2">
                                                <div class="border rounded position-relative text-center"
                                                    style="min-height: 421.61px;!important;">
                                                    <div class="position-absolute top-50 start-50 translate-middle">
                                                        <span class="h1 hoverDataTicket"
                                                            style="font-size: 3.4rem;">{{ $totalCsat[0]->avg }}</span><br>
                                                        <span class="hoverDataTicket">Total CSAT</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-xl-4 col-lg-8 col-sm-12 mt-2">
                                                <div class="border rounded">
                                                    <p class="m-1">Encuestas realizadas</p>
                                                    @php
                                                        $series = array_map(function ($item) {
                                                            return $item->count;
                                                        }, $surveySended);

                                                        $labels = array_map(function ($item) {
                                                            return $item->Depto ?? 'Sin dato';
                                                        }, $surveySended);

                                                    @endphp
                                                    <div id="chartCsat"></div>



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

                                                            var chart = new ApexCharts(document.querySelector("#chartCsat"), options);
                                                            chart.render();

                                                        });
                                                    </script>
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-xl-4 col-lg-8 col-sm-12 mt-2">
                                                <div class="border rounded">
                                                    <p class="m-1">Encuestas por canal</p>
                                                    @php
                                                        $seriesPerChannelCsat = array_map(function ($item) {
                                                            return $item->count;
                                                        }, $surverPerChannel);

                                                        $labelsperChannelCsat = array_map(function ($item) {
                                                            return $item->Siennasource__nombre ?? 'Desconocido';
                                                        }, $surverPerChannel);

                                                    @endphp
                                                    <div id="chartPerChannelCsat"></div>
                                                    <script>
                                                        document.addEventListener('DOMContentLoaded', function() {
                                                            var options = {
                                                                series: @json($seriesPerChannelCsat),
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
                                                                            },
                                                                            size: '70%'
                                                                        }
                                                                    }
                                                                },
                                                                labels: @json($labelsperChannelCsat),
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

                                                            var chart = new ApexCharts(document.querySelector("#chartPerChannelCsat"), options);
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
                                                    <img src="assetsfacu/images/svg/file-searching.svg" height="90"
                                                        alt="Without information">
                                                    <h2 class="text-center">No hay información que mostrar.</h2>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('facu.footer')

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.15.1/xlsx.full.min.js"></script>
<script>
    function sendFormWithAxios() {
        var ticket_ids = @json($qtyTicketCsat);
        let tickets = ticket_ids.map(item => item.ticket).join(',');

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
</script>
