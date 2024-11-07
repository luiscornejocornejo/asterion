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
                url =
                    "https://<?php echo $subdomain_tmp; ?>.pagoralia.com/api/listadocliente?&token=elmasgrandesiguesiendoriverplate&cliente=<?php echo $resultados[0]->iddelcliente; ?>"
                axios.get(url)
                    .then(function(response) {
                        let res = '';

                        console.log(response.data);
                        for (let i = 0; i < response.data.length; i++) { const badge = response.data[i].detalle === 'paid' ? 'badge bg-success' : response.data[i].detalle === 'pending' ? 'badge bg-warning' : ''; console.log(response.data[i].nombre); res += `<tr class='text-center'> <td>${response.data[i].recibo}</td> <td class="${badge}">${response.data[i].detalle}</td> <td>${response.data[i].total}</td> <td>${response.data[i].estado}</td> <td>${response.data[i].realink}<i class="me-1 mdi mdi-content-copy" onclick="copyToClipboard('${response.data[i].realink}')"></i></td> </tr>`;

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

                    function copyToClipboard(text) {
                            navigator.clipboard.writeText(text)
                                .then(() => {
                                    conso.log("Contenido copiado al portapapeles!");
                                })
                                .catch(err => {
                                    console.error("Error al copiar el contenido: ", err);
                                });
                        }
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
</div>
