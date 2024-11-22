<!-- Modal for Create Ticket -->
<?php
$querygenerico="select * from siennadepto";
$siennadeptosgenericos = DB::select($querygenerico);


?>

<script>

    function topics(id){
        var URLactual = window.location.href;
        var porciones = URLactual.split('.');
        let result = porciones[0].replace("https://", "");
        let opt="";
        url = "https://"+result+".suricata.cloud/api/topicxdepto?depto=" + id + "";
        console.log(url);
        axios.get(url)
            .then(function (response) {
                console.log(response);
               
                tt = "";
                for (i = 0; i < response.data.length; i++) {
                        console.log(response.data[i].nombre);
                        tt+='<option  value='+response.data[i].id+'>'+response.data[i].nombre+'</option>';

                } 
                document.getElementById("top").innerHTML = null;
                document.getElementById("top").innerHTML = tt;
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
    
<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="exampleModalToggleLabel">Crear ticket</h5>
               
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
           
            <form action="crearticketsiennacliente" method="post">
                 @csrf

                    <div class="row">
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="type-user" class="form-label">Tipo de busqueda</label>
                            <select class="form-select" id="type-user">
                            <option value="id">Cliente</option>
                            <option value="id">Cedula</option>
                               
                            </select>
                        </div>                                                                                            
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="number-client" class="form-label">Número registrado en la cuenta</label>
                            <input required type="number" id="number-client" name="number_client" class="form-control" required>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-1">
                            <label for="department" class="form-label">Departamento</label>
                            <select required onchange="topics(this.value)" class="form-select" name="depto">
                            <option value="0">seleccionar</option>

                                <?php foreach($siennadeptosgenericos as $val){?>

                                    <option value="<?php echo $val->id;?>"><?php echo $val->nombre ;?></option>

                                <?php
                                }?>
                               
                            </select>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-1">
                            <label for="reason" class="form-label">Motivo</label>
                            <select required id="top" class="form-select" name="topicos">
                            </select>
                        </div>
                        <input value="<?php echo session('nombreusuario');?>" type="hidden" name="logeado" id="logeado">
                        <input value="<?php echo session('idusuario');?>" type="hidden" name="idlogeado" id="idlogeado">

                    </div>
                </div>
                <div class="modal-footer mt-2">
                <button class="btn btn-success" type="submit" >Crear</button>
                
                    
            </form>
            <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal"
            data-bs-dismiss="modal">No es cliente</button>
        </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
            