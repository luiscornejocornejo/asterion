@include('facu.header')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    console.log("TOTAL CSAT:", @json($totalCsat))
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
                                <div class="row mx-1 my-1">
                                    <div class="col-xxl-2 col-xl-2 col-lg-4 col-sm-12 mt-2">
                                        <input type="submit" class="btn btn-primary" value="Buscar">
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