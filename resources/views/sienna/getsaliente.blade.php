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
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="container-fluid pt-2">
            <form method="post" action="">
                @csrf
                <div class="row">
                    <div class="col-lg-4 col-sm-12">
                        <label for="typeSearch" class="form-label">Tipo de busqueda</label>
                        <select name="typeSearch" id="typeSearch" class="form-select">
                            <option value="0">DNI | Cédula</option>
                            <option value="1">Número de cliente</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <label for="userNumber" class="form-label">Número</label>
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
                ?>


            </div>
            <div class="mb-3" class="col-2">
                <center>
                    <h1>Datos</h1>
                </center>
                <table id="example" class="table table-striped dt-responsive nowrap w-100 text-light">
                    <thead>
                        <tr class="text-center bg-dark">
                            <th class="text-light">Nombre</th>
                            <th class="text-light">Teléfono</th>
                            <th class="text-light">Móvil</th>
                            <th class="text-light">Acción</th>
                        </tr>
                    </thead>
                    <tbody id="tb">
                        <tr class="text-center">
                            <td><?php echo $datosonline2->name; ?></td>
                            <td><?php echo $datosonline2->phone; ?></td>
                            <td><?php echo $datosonline2->phone_mobile; ?></td>
                            <td><button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#create-ticket-modal"><i class="mdi mdi-check"></i></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="border  mb-3" class="col-2">
                <center>
                    <h1>Crear Ticket</h1>
                </center>

            </div>
            <div class="border  mb-3" class="col-2">
                <center>
                    <h1>Saliente</h1>
                </center>
                
            </div>




        <?php } ?>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="create-ticket-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="multiple-oneModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="multiple-oneModalLabel">Crear ticket</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="crearticketsiennacliente" method="post">
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
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-1">

                            <input value="<?php echo session('nombreusuario'); ?>" type="hidden" name="logeado" id="logeado">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit">Crear</button>
                <button type="button" class="btn btn-primary" data-bs-target="#create-ticket-modal-2" data-bs-toggle="modal" data-bs-dismiss="modal">Saliente</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal -->
<div id="create-ticket-modal-2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="multiple-twoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="multiple-twoModalLabel">Modal Heading</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <label class="form-label">Plantilla a enviar</label>
                <div class="row mb-3">
                    <div class="col-lg-4 col-sm-12">
                        <select name="template" id="template" class="form-select">
                            <option value="0">1</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Enviar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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