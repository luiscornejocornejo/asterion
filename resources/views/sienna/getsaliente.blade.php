@include('facu.header2')
<script>

    
    function topics(id) {
        var URLactual = window.location.href;
        var porciones = URLactual.split('.');
        let result = porciones[0].replace("https://", "");
        let opt = "";
        url = "https://" + result + ".suricata.cloud/api/topicxdepto?depto=" + id + "";
        console.log(url);
        axios.get(url)
            .then(function(response) {
                console.log(response);

                tt = "";
                for (i = 0; i < response.data.length; i++) {
                    console.log(response.data[i].nombre);
                    tt += '<option  value=' + response.data[i].id + '>' + response.data[i].nombre + '</option>';

                }
                document.getElementById("top").innerHTML = null;
                document.getElementById("top").innerHTML = tt;
            })
            .catch(function(error) {
                // función para capturar el error
                console.log(error);
            })
            .then(function() {
                // función que siempre se ejecuta
            });
    }
</script>
<div class="wrapper menuitem-active">
    @include('facu.menu')
    <div class="content-page" style="padding: 0!important;">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade
                            show" role="alert">
                            {!! session('success') !!}

                   

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <script>

function sal(tick,phone){
document.getElementById("ticketid").value = tick;
document.getElementById("phone").value = phone;

}</script>
        <div class="container-fluid pt-2">
            <form method="post" action="">
                @csrf
                <div class="row">
                    <div class="col-lg-4 col-sm-12">
                        <label for="typeSearch" class="form-label">Tipo de busqueda</label>
                        <select name="typeSearch" id="typeSearch" class="form-select">
                            <?php foreach($busquedas as $bus){
                                $tipointegracion=$bus->nombre;
                                ?>
                            <option value="<?php echo $bus->id;?>"><?php echo $bus->tipows;?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <label for="userNumber" class="form-label">Numero</label>
                        <input type="text" name="cliente" class="form-control" id="userNumber" aria-describedby="emailHelp" placeholder="005215" required>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="mb-2 position-relative">
                            <label class="form-label">&nbsp;</label>
                            <input type="submit" type="button" class="form-control w-25 bg-success text-light" value="Buscar">
                        </div>
                    </div>
                </div>
            </form>
            <div class="border" class="col-2">
                <?php if (isset($datosonline)) {
                    $datosonline2 = json_decode($datosonline);
                    $tablaname="";
                    $tablaphone="";
                    $tablaphone_mobile="";
                  //  if(isset($datosonline2->name)){
                        
                        if($tipointegracion=="wispro"){
                            $tablaname=$datosonline2->name;
                            $tablaphone=$datosonline2->phone;
                            $tablaphone_mobile=$datosonline2->phone_mobile;
                            }

                        if($tipointegracion=="futu"){
                                $tablaname=$datosonline2->nombres;
                                $tablaphone= $datosonline2->infocontratos[0]->telefonolocal ;
                                $tablaphone_mobile= $datosonline2->infocontratos[0]->telefonolocal ;
                                }


                        if($tipointegracion=="ispcube"){
                            $tablaname=$datosonline2->name;
                            if($datosonline2->phones_qty>0){
                                foreach($datosonline2->phones as $valphone){
                                    $tablaphone=$valphone->number;
                                    $tablaphone_mobile=$valphone->number;
                                }

                            }
                            
                            

                        }
                    
                ?>


            </div>
            <div>
                <table id="example" class="table table-striped dt-responsive nowrap w-100 text-light">
                    <thead>
                        <tr class="text-center bg-dark">
                            <th class="text-light">Nombre</th>
                            <th class="text-light">Teléfono</th>
                            <th class="text-light">Móvil</th>
                            <th class="text-light">Confirmar usuario</th>
                        </tr>
                    </thead>
                    <tbody id="tb">
                        <tr class="text-center">
                            <td><?php echo $tablaname; ?></td>
                            <td><?php echo $tablaphone; ?></td>
                            <td><?php echo $tablaphone_mobile; ?></td>
                            <td><button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#create-ticket-modal"><i class="mdi mdi-check"></i></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>

                        <?php
                        /* }else{
                            echo "cliente no encontrado";
                        }*/?>
            <!-- Modal -->
            <div id="create-ticket-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="multiple-oneModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-dark">
                            <h4 class="modal-title text-light" id="multiple-oneModalLabel">Crear ticket</h4>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="crearticketsiennaclientegetdata" method="post"  enctype="multipart/form-data">
                                @csrf

                                <div class="row">


                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-1">
                                        <label for="department" class="form-label">Departamento</label>
                                        <select required onchange="topics(this.value)" class="form-select" name="depto">
                                            <option value="0">seleccionar</option>

                                            <?php foreach ($siennadeptosgenericos as $val) { ?>

                                                <option value="<?php echo $val->id; ?>"><?php echo $val->nombre; ?></option>

                                            <?php
                                            } ?>

                                        </select>
                                    </div>
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-1">
                                        <label for="reason" class="form-label">Motivo</label>
                                        <select required id="top" class="form-select" name="topicos">
                                        </select>
                                    </div>
                                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-1">

                                        <label for="ticket-text" class="form-label">Descripción:</label>
                                        <textarea class="form-control mb-3" id="task-text" name="textticket" class="form-control mb-3" rows="4" required></textarea>
                                    </div>

                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-1">


                                        <label for="evidence" class="btn btn-secondary rounded-pill">
                                            <i class="mdi mdi-attachment"></i> Archivo adjunto
                                            <input name="evicence" type="file" id="evidence" class="d-none">
                                        </label>
                                    </div>

                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-1">
                                    <input readonly type="hidden" value="<?php echo $cliente; ?>" id="number-client" name="number_client" class="form-control" required>
                                    <input readonly type="hidden" value="<?php echo $tablaphone_mobile; ?>" id="phone-client" name="phone_client" class="form-control" required>
                                    </div>
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-1">

                                        <input value="<?php echo session('nombreusuario'); ?>" type="hidden" name="logeado" id="logeado">
                                        <input value="<?php echo session('idusuario'); ?>" type="hidden" name="idlogeado" id="idlogeado">
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" type="submit">Crear ticket</button>
                        </div>
                        </form>

                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <!-- Modal -->
           
        <?php } ?>

        <div id="create-ticket-modal-2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="multiple-twoModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-dark">
                            <h4 class="modal-title text-light" id="multiple-twoModalLabel">Saliente</h4>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="/getsalienteticket">
                        @csrf

                            <div class="modal-body">
                                <label class="form-label" for="phone">Número teléfono</label>
                                <div class="row mb-3">
                                    <div class="col-lg-8 col-sm-12">
                                        <input type="text" class="form-control" name="phone" id="phone" value="<?php //echo $datosonline2->phone_mobile;  ?>" >
                                        <input type="hidden" name="ticketid" id="ticketid" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Enviar saliente</button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
    </div>
</div>
<script>
    function init() {
        document.getElementById('evidence').addEventListener('change', showName, false);
    }

    function showName(event) {
        document.getElementById('fileName').innerHTML = event.target.files[0].name
    }
    init()
</script>

@include('facu.footer')