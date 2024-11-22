<?php
$querygenerico="select * from siennadepto";
$siennadeptosgenericos = DB::select($querygenerico);?>
<script>

function topics2(id2){

    var URLactual = window.location.href;
    var porciones = URLactual.split('.');
    let result = porciones[0].replace("https://", "");
    let opt="";
    url = "https://"+result+".suricata.cloud/api/topicxdepto?depto=" + id2 + "";
    console.log(url);
    axios.get(url)
        .then(function (response) {
            console.log(response);
           
            tt2 = "";
            for (i = 0; i < response.data.length; i++) {
                    console.log(response.data[i].nombre);
                    tt2+='<option  value='+response.data[i].id+'>'+response.data[i].nombre+'</option>';

            } 
            document.getElementById("topi2").innerHTML = null;
            document.getElementById("topi2").innerHTML = tt2;
        })
        .catch(function (error) {
            // función para capturar el error
            console.log(error);
        })
        .then(function () {
            // función que siempre se ejecuta
        });
}
</script>
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-light" id="exampleModalToggleLabel2">Crear Ticket</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="crearticketsiennanocliente" method="post">
                @csrf

                <div class="modal-body">
                    <div class="row">
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="fullname" class="form-label">Nombre completo</label>
                            <input required type="text" class="form-control" id="fullname" name="fullname">
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="phone" class="form-label">Telefono de contacto</label>
                            <input required type="text" class="form-control" id="phone" name="phone">
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
                            <label for="reason-prospect" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">

                        </div>
                        <input value="<?php echo session('nombreusuario');?>" type="hidden" name="logeado" id="logeado">
                        <input value="<?php echo session('idusuario');?>" type="hidden" name="idlogeado" id="idlogeado">

                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-1">
                            <label for="department-prospect2" class="form-label">Departamento</label>
                            <select required onchange="topics2(this.value)" class="form-select" name="depto">
                            <option value="0">seleccionar</option>

                            <?php foreach($siennadeptosgenericos as $val){?>

                                    <option value="<?php echo $val->id;?>"><?php echo $val->nombre ;?></option>

                                    <?php
                                    }?>
                            </select> 
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-1">
                            <label for="reason-prospect" class="form-label">Motivo</label>
                            <select required id="topi2" class="form-select" name="topicos">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer mt-2">
                <button class="btn btn-success" type="submit" >Crear </button>

                </form>
                <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal"
                        data-bs-dismiss="modal">Volver</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
