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
  <div class="form-group">
    <label for="exampleInputEmail1">Invoice</label>
    <input required name="invoice" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="fb101232">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Descripcion</label>
    <input required name="descripcion" type="text" class="form-control" id="exampleInputPassword1" placeholder="pago por servicio de inet">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Monto</label>
    <input required name="monto" type="number" step="0.01" class="form-control" id="exampleInputPassword1" placeholder="50.00">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Cliente</label>
    <input required name="cliente" type="text" class="form-control" id="exampleInputPassword1" placeholder="cliente">
    <input required name="nombre" type="text" class="form-control" id="exampleInputPassword1" placeholder="nombre">
    <input required name="apelido" type="text" class="form-control" id="exampleInputPassword1" placeholder="apelido">
  </div>
  <hr style="margin-top: 10px;" />

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
        </div>                    
    </div>
</div>

                                  