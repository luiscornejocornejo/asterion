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
            <form method="get" action="/pagoraliaorden">
                <div class="row">
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-sm-12">
                        <label for="exampleInputEmail1">Invoice</label>
                        <input required name="invoice" type="text" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="fb101232">
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-sm-12">
                        <label for="exampleInputPassword1">Descripcion</label>
                        <input required name="descripcion" type="text" class="form-control"
                            id="exampleInputPassword1" placeholder="pago por servicio de inet">
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-sm-12">
                        <label for="exampleInputPassword1">Monto</label>
                        <input required name="monto" type="number" step="0.01" class="form-control"
                            id="exampleInputPassword1" placeholder="50.00">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-sm-12">
                        <label for="exampleInputPassword1">Cliente</label>
                        <input required name="cliente" type="text" class="form-control" id="exampleInputPassword1"
                            placeholder="cliente">
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-sm-12">
                    <input required name="nombre" type="text" class="form-control" id="exampleInputPassword1"
                        placeholder="nombre">
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-sm-12">
                    <input required name="apellido" type="text" class="form-control" id="exampleInputPassword1"
                        placeholder="apellido">
                    </div>
                    <hr style="margin-top: 10px;" />
                </div>
                <button type="submit" class="btn btn-primary">Registrar</button>
            </form>
        </div>
    </div>
</div>
