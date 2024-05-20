<?php
$querygenerico="select * from siennadepto";
$siennadeptosgenericos = DB::select($querygenerico);?>
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-light" id="exampleModalToggleLabel2">Crear Ticket</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="fullname" class="form-label">Nombre completo</label>
                            <input type="text" class="form-control" id="fullname" name="fullname">
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="phone" class="form-label">Telefono de contacto</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-1">
                            <label for="address" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="address" name="address">
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-1">
                            <label for="city" class="form-label">Localidad</label>
                            <input type="text" class="form-control" id="city" name="city">
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-1">
                            <label for="reason-prospect" class="form-label">Motivo</label>
                            <input type="text" class="form-control" id="reason-prospect" name="reason-prospect">
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-1">
                            <label for="department-prospect" class="form-label">Departamento</label>
                            <select class="form-select" id="department-prospect" name="department-prospect">
                            <?php foreach($siennadeptosgenericos as $val){?>

                                    <option id="<?php echo $val->id;?>"><?php echo $val->nombre ;?></option>

                                    <?php
                                    }?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer mt-2">
                    <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal"
                        data-bs-dismiss="modal">Volver</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
