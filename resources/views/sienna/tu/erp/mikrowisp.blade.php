

<?php 
$subserp= file_get_contents("https://wiber.suricata-ispkeeper.com.ar/api/listadodeticketsubcategorias?token=wiber");
$usuariosserp= file_get_contents("https://wiber.suricata-ispkeeper.com.ar/api/usuarios?token=wiber");
$usuariosserp2=json_decode($usuariosserp, true);
$ticketserp= file_get_contents("https://wiber.suricata-ispkeeper.com.ar/api/tickets?token=wiber&cliente_id=47235");
?>
<div class="card widget-flat" id="infoUser">
    <div class="card-body">
    <div class="row">
    <div class="col-sm-3 mb-2 mb-sm-0">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active show" id="v-pills-home-tab" data-bs-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home"
                aria-selected="true">
                <i class="mdi mdi-home-variant d-md-none d-block"></i>
                <span class="d-none d-md-block">Tickets</span>
            </a>
            <a class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile"
                aria-selected="false">
                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                <span class="d-none d-md-block">Datos</span>
            </a>
            <a class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings"
                aria-selected="false">
                <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                <span class="d-none d-md-block">extra</span>
            </a>
        </div>
    </div> <!-- end col-->

    <div class="col-sm-9">
        <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade active show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">


                <div class="row">
                    <form method="post" action="/crearispkipper">
                        @csrf
                        <div class="row">
                        <div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-6">
                                        <label for="agent" class="form-label">Usuario</label>

                                            @foreach ($usuariosserp2 as $agent2)
                                            @foreach ($agent2 as $agent)
                                                <?php var_dump($agent2[0]);?>
                                               
                                                @endforeach
                                                @endforeach
                                                <select name="usuario" id="agent" multiple="multiple" class="form-select">

                                                </select>
                          </div>
                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-sm-12 mt-2">
                                <label class="form-label" for="description">Subcategoria</label>
                                <input required name="descripcion" type="text" class="form-control" id="description"
                                    placeholder="pago por servicio de inet">
                            </div>
                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-sm-12 mt-2">
                                <label class="form-label" for="amount">Prioridad:</label>
                                <input required name="monto" type="number" step="0.01" class="form-control" id="amount"
                                    placeholder="50.00">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-sm-12 mt-2">
                                <label class="form-label" for="customer">Descripcion</label>
                                
                            </div>
                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-sm-12 mt-2">
                                <label class="form-label" for="nameUser">Cliente:</label>
                                <input required name="cliente" type="text" class="form-control" id="nameUser"
                                    placeholder="cliente" value="47235">
                            </div>
                            
                        </div>
                        <button type="submit" class="btn btn-success mt-3 mb-2">Crear Ticket</button>
                        <hr class="mx-1" />
                    </form>
                </div>
        <div class="row">
            <script>
                function copyToClipboard(text) {
                    navigator.clipboard.writeText(text)
                        .then(() => {
                            console.log("Contenido copiado al portapapeles!");
                            let toastEl = document.getElementById('liveToast')
                            toastEl.querySelector('.toast-body').innerHTML =
                                'Orden copiada al portapapeles.'
                            let toast = new bootstrap.Toast(toastEl)
                            toast.show()
                        })
                        .catch(err => {
                            console.error("Error al copiar el contenido: ", err);
                        });
                }

                url =
                    "https://<?php echo $subdomain_tmp; ?>.pagoralia.com/api/listadocliente?&token=elmasgrandesiguesiendoriverplate&cliente=<?php echo $resultados[0]->iddelcliente; ?>"
                axios.get(url)
                    .then(function(response) {
                        res = '';
                        console.log(response.data);
                        for (i = 0; i < response.data.length; i++) {
                            let badge = response.data[i].estado === 'paid' ?
                                'badge bg-success' :
                                response.data[i].estado === 'pending' ?
                                'badge bg-warning' :
                                '';
                            console.log(badge)
                            res += `<tr class="text-center">
                                <td>${response.data[i].recibo}</td>
                                <td>${response.data[i].detalle}</td>
                                <td>${response.data[i].total}</td>
                                <td><span class="${badge}">${response.data[i].estado}</span></td>
                                <td>
                                    <button class="btn btn-success custom-tooltip" onclick="copyToClipboard('${response.data[i].realink}')">
                                        <i class="mdi mdi-content-copy text-light"></i>
                                        <span class="tooltiptext">Copiar link.</span>
                                    </button>
                                </td>
                            </tr>`;
                        }

                        document.getElementById("log").innerHTML = null;

                        document.getElementById("log").innerHTML = res;

                    })
                    .catch(function(error) {
                        // función para capturar el error
                        console.log(error);
                    })
                    .then(function() {
                        // función que siempre se ejecuta
                    });
            </script>
            <table id="casadepapel" class="table table-striped dt-responsive nowrap w-100 text-light">
                <thead>
                    <tr class="text-center bg-dark">
                        <th class="text-light">Invoice</th>
                        <th class="text-light">Detalle</th>
                        <th class="text-light">Total</th>
                        <th class="text-light">Estado</th>
                        <th class="text-light">Link</th>
                    </tr>
                </thead>
                <tbody id="log">

                </tbody>
            </table>
        </div>

            </div>
            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <p class="mb-0">...</p>
            </div>
            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                <p class="mb-0">...</p>
            </div>
        </div> <!-- end tab-content-->
    </div> <!-- end col-->
</div>
<!-- end row-->

    </div>


</div>