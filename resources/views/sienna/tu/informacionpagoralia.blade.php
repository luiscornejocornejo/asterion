<style>
    .zoom {
        transition: transform .2s;
        margin: 0 auto;
    }

    .zoom:hover {
        -ms-transform: scale(1.1);
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }
</style>

<div class="card widget-flat ">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div>
                <h4 class="fw-normal text-dark" title="Number of Customers">Registrar Orden en Pagoralia</h4>
            </div>
            <div>

            </div>
        </div>
        <hr style="margin-top: 10px;" />
        <div class="row">
            <form method="post" action="/pagoraliaorden">
                @csrf

                <div class="row">
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-sm-12 mt-2">
                        <label class="form-label" id="invoice_number">Invoice:</label>
                        <input required name="invoice" type="text" class="form-control" id="invoice_number"
                            aria-describedby="emailHelp" placeholder="fb101232">
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-sm-12 mt-2">
                        <label class="form-label" for="description">Descripción</label>
                        <input required name="descripcion" type="text" class="form-control" id="description"
                            placeholder="pago por servicio de inet">
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-sm-12 mt-2">
                        <label class="form-label" for="amount">Monto:</label>
                        <input required name="monto" type="number" step="0.01" class="form-control" id="amount"
                            placeholder="50.00">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-sm-12 mt-2">
                        <label class="form-label" for="customer">Número de cliente</label>
                        <input required name="cliente" type="text" class="form-control" id="customer"
                            placeholder="cliente">
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-sm-12 mt-2">
                        <label class="form-label" for="nameUser">Nombre:</label>
                        <input required name="nombre" type="text" class="form-control" id="nameUser"
                            placeholder="nombre">
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-sm-12 mt-2">
                        <label class="form-label" for="lastNameUser">Apellido:</label>
                        <input required name="apellido" type="text" class="form-control" id="lastNameUser"
                            placeholder="apellido">
                    </div>
                    <hr style="margin-top: 10px;" />
                </div>
                <button type="submit" class="btn btn-primary">Registrar</button>
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
                            let badge = response.data[i].detalle === 'paid' ?
                                'badge bg-success' :
                                response.data[i].detalle === 'pending' ?
                                'badge bg-warning' :
                                '';
                            console.log(badge)
                            res += `<tr class="text-center">
                                <td>${response.data[i].recibo}</td>
                                <td class="${badge}">${response.data[i].detalle}</td>
                                <td>${response.data[i].total}</td>
                                <td>${response.data[i].estado}</td>
                                <td>
                                    ${response.data[i].realink}
                                    <i class="me-1 mdi mdi-content-copy zoom" onclick="copyToClipboard('${response.data[i].realink}')" role="button"></i>
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
    <div class="toast fade" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-dark">
            <img src="assetsfacu/images/favicom_suricata.png" alt="brand-logo" height="12" class="me-1" />
            <strong class="me-auto text-light">Copiado!</strong>
            <small class="text-light">Ahora</small>
            <button type="button" class="ms-2 btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            
        </div>
    </div>
</div>
