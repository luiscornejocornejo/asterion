@include('facu.header')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    console.log("Encuestas realizadas:", @json($surveySended))
</script>

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
                        <form action="/surveys" method="POST">
                            @csrf

                            <div class="row mx-1 my-1">
                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-sm-6">
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
                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-sm-6">
                                    <label for="channel" class="form-label">Canales</label>
                                    <select name="channel[]" id="channel" multiple="multiple" class="form-select">
                                        @foreach ($sources as $source)
                                            <option value="{{ $source->id }}">
                                                {{ $source->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-sm-6">
                                    <label for="agent" class="form-label">Agente</label>
                                    <select name="agent[]" id="agent" multiple="multiple" class="form-select">

                                        @foreach ($agents as $agent)
                                            <option value="{{ $agent->id }}">
                                                {{ $agent->nombre }} {{ $agent->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row mx-1 my-1">
                                    <div class="col-xxl-2 col-xl-2 col-lg-4 col-sm-12 mt-2">
                                        <input type="submit" class="btn btn-primary" value="Buscar">
                                    </div>
                                </div>
                                <div class="row mx-1 my-1">
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
                                                    return $item->SiennaticketsViewTicket ?? 'Sin dato';
                                                }, $surveySended);

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

                                    <div class="col-xxl-4 col-xl-4 col-lg-8 col-sm-12 mt-2">
                                        <div class="border rounded">
                                            <p class="m-1">Encuestas por canal</p>
                                            @php
                                                $seriesPerChannel = array_map(function ($item) {
                                                    return $item->count;
                                                }, $surverPerChannel);

                                                $labelsperChannel = array_map(function ($item) {
                                                    return $item->Siennasource__nombre ?? 'Desconocido';
                                                }, $surverPerChannel);

                                            @endphp
                                            <div id="chartPerChannel"></div>
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var options = {
                                                        series: @json($seriesPerChannel),
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
                                                        labels: @json($labelsperChannel),
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

                                                    var chart = new ApexCharts(document.querySelector("#chartPerChannel"), options);
                                                    chart.render();

                                                });
                                            </script>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>  
    </div>
    @include('facu.footer')