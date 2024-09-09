@if(isset($resultados[0]->datoCollector)) {
$chainParsed = explode(';', $resultados[0]->datoCollector)
<div class="card widget-flat">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div>
                <h4 class="fw-normal text-dark" title="Number of Customers">Datos coleccionados del bot</h4>
            </div>
            <div>
                <i class="mdi mdi-robot widget-icon bg-primary-lighten text-secondary"></i>
            </div>
        </div>
        <hr style="margin-top: 10px;" />
        <div class="row">
            @foreach($chainParsed as $chain)
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-sm-12">
                <div class="d-flex mt-2">
                    <p>{{ trim($chain) }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>


</div>
}
@endif