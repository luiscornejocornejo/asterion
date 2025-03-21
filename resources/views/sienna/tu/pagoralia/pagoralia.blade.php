<style>
    .zoom {
        transition: transform .2s;
        margin: 0 auto;
    }

    .zoom:hover {
        -ms-transform: scale(1.5);
        -webkit-transform: scale(1.5);
        transform: scale(1.5);
    }

    .tooltip {
        position: relative;
        display: inline-block;
    }

    .custom-tooltip {
        position: relative;
        display: inline-block;
    }

    .custom-tooltip .tooltiptext {
        visibility: hidden;
        width: 160px;
        background-color: #555;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px 0;
        position: absolute;
        z-index: 1;
        bottom: 125%; /* Ubica el tooltip arriba del botón */
        left: 50%;
        transform: translateX(-50%);
        opacity: 0;
        transition: opacity 0.3s;
    }

    .custom-tooltip .tooltiptext::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #555 transparent transparent transparent;
    }

    .custom-tooltip:hover .tooltiptext {
        visibility: visible;
        opacity: 1;
    }
</style>

<?php 

if($subdomain_tmp=="neurotech"){

    $subdomain_tmp="neurotelco";
}

?>

<div class="card widget-flat ">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div>
            <a target="_blank" id="limkpagoralia" href="" class="fw-normal text-dark" title="Number of Customers">Link</a>
           <?php if(isset($resultados[0]->iddelcliente)){?>
            <script>
                url2 =
                                "https://<?php echo $subdomain_tmp; ?>.pagoralia.com/api/link?&token=elmasgrandesiguesiendoriverplate&cliente=<?php echo $resultados[0]->iddelcliente; ?>"
                            axios.get(url2)
                                .then(function(response) {
                                    console.log(response.data);
                                    for (i = 0; i < response.data.length; i++) {
                                        let link = response.data[i].realink;
                                        console.log(link);

                                    document.getElementById("limkpagoralia").href  = link;

                                    }

                                })
                                .catch(function(error) {
                                    // función para capturar el error
                                    console.log(error);
                                })
                                .then(function() {
                                    // función que siempre se ejecuta
                                });

            </script>
            <?php }?>
                <h4 class="fw-normal text-dark" title="Number of Customers">Crear orden</h4>
            </div>
            <div>
                <img src="/assetsfacu/images/logo-pagoralia.jpeg" height="30px" alt="logo-pagoralia">
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
                </div>
                <button type="submit" class="btn btn-success mt-3 mb-2">Generar orden</button>
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
</div>
