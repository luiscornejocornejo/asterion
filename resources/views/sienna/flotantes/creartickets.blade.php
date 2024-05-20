<!-- Modal for Create Ticket -->
<?php
$querygenerico="select * from siennadepto";
$siennadeptosgenericos = DB::select($querygenerico);


?>

<script>

    function topics(id){
        alert(id);
    }
</script>
    
<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="exampleModalToggleLabel">Crear ticket</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="type-user" class="form-label">Tipo de busqueda</label>
                            <select class="form-select" id="type-user">
                                <option value="id">Cliente</option>
                                <option value="id">DNI o CUIT</option>
                                <option value="id">Cédula o RUC</option>
                                <option value="id">Telefono</option>
                            </select>
                        </div>                                                                                            
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="number-client" class="form-label">Número registrado en la cuenta</label>
                            <input type="number" id="number-client" name="number-client" class="form-control" required>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-1">
                            <label for="department" class="form-label">Departamento</label>
                            <select onchange="topics(this.value)" class="form-select">
                            <option value="0">seleccionar</option>

                                <?php foreach($siennadeptosgenericos as $val){?>

                                    <option value="<?php echo $val->id;?>"><?php echo $val->nombre ;?></option>

                                <?php
                                }?>
                               
                            </select>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-1">
                            <label for="reason" class="form-label">Motivo</label>
                            <input type="text" class="form-control" id="reason" name="reason">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer mt-2">
                <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal"
                    data-bs-dismiss="modal">No es cliente</button>
                    <button class="btn btn-success" type="submit" onclick="">Crear</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
            