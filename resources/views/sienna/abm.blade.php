@include('facu.header2')

<?php

$subdomain_tmp = 'localhost';
if (isset($_SERVER['HTTP_HOST'])) {
    $domainParts = explode('.', $_SERVER['HTTP_HOST']);
    $subdomain_tmp =  array_shift($domainParts);
} elseif (isset($_SERVER['SERVER_NAME'])) {
    $domainParts = explode('.', $_SERVER['SERVER_NAME']);
    $subdomain_tmp =  array_shift($domainParts);
}

?>
<link rel="stylesheet" href="agents.css">
<script>
        function borrar(x) {

document.getElementById("idregistro").value = x;
}
</script>
<!-- ========== Left Sidebar Start ========== -->
<div class="wrapper menuitem-active">
    @include('facu.menu')

    <div class="content-page" style="padding: 0!important;">
        <div class="content">
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

            <!-- Page Wrapper -->
            <div class="container-fluid">
                <!-- Begin Page Content -->
                <!-- Page Heading -->
                <center>
                <h1 class="text-center">ABM <?php echo $nombrereporte;?></h1>

                </center>
             

                <table id="example" class="table table-striped dt-responsive nowrap w-100 mt-2">
                    <thead role="rowgroup" class="table-dark">
                        <tr role="row">

                            @foreach($cabezeras as $cabeza)

                            <th role="columnheader">{{ $cabeza }}</th>


                            @endforeach
                            <th role="columnheader">Acción</th>


                        </tr>
                    </thead>
                    <tbody role="rowgroup">
                        @foreach($resultados as $resultado)


                        <tr role="row">
                            @foreach($cabezeras as $cabeza)
                            <td role="cell">
                                {!! $resultado->$cabeza !!}
                            </td>

                            @endforeach
                            <td role="cell">

                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary
                                    dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Acción<i class="mdi
                                    mdi-chevron-down"></i></button>
                                    <div class="dropdown-menu">
                                        <?php if ($master->modificar == 1) { ?>
                                            <a onclick="editar('siennaabmmodificar?registro={{$resultado->$registro}}&idreport={{$idreport}}&pk={{$registro}}')" class="ms-1 btn btn-warning" role="button" data-bs-toggle="modal" data-bs-target="#edit-user-modal"> <i data-feather="edit" class="mdi mdi-square-edit-outline"></i></a>
                                        <?php } ?>
                                        <?php if ($master->eliminar == 1) { ?>

                                            <button type="button" onclick="borrar(<?php echo $resultado->$registro; ?>)" class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center"><i data-feather="delete" class="mdi mdi-delete-outline"></i></button>

                                        <?php } ?>
                                        <?php if ($master->tickets == 1) { ?>

                                        <button type="button" onclick="idticket(<?php echo $resultado->servicio; ?>,<?php echo $resultado->telefono; ?>)" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#ctabm"><i class="mdi mdi-whatsapp"></i></button>

                                        <?php } ?>
                                        

                                    </div>
                                </div><!-- /btn-group -->


                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr role="row">
                            @foreach($cabezeras as $cabeza)
                                <th role="columnheader">{{ $cabeza }}</th>
                            @endforeach
                            <th role="columnheader">Acción</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
     function editar(dd) {
         urleditar="https://<?php echo $subdomain_tmp; ?>.suricata.cloud/"+dd;
              document.getElementById("editariframe").src  = urleditar;
        } 
</script>
    
<?php if ($master->crear == 1) { ?>
<div class="newAgent" data-bs-toggle="modal" data-bs-target="#create-user-modal">
    <i class="mdi mdi-plus" style="font-size: 25px;"></i>
</div>
<?php }?>

<!-- Modal for delete -->
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Esta seguro que quiere borrar el registro el sevicio></p>
                <form method="post" action="eliminarregistro">

                    <input type="hidden" name="tabla" id="tabla" value="<?php echo $master->tabla; ?>">
                    <input type="hidden" name="idregistro" id="idregistro">
                    <input type="hidden" name="dbexterna" id="dbexterna" value="<?php echo $master->base; ?>">
                    <input type="hidden" name="pk" id="pk" value="<?php echo $registro; ?>">

                    @csrf
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal for Create  -->
<div id="create-user-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="dark-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header bg-dark">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <iframe style="display:block; width:35vw; height:100vh;" src="https://<?php echo $subdomain_tmp; ?>.suricata.cloud/siennacreate?report={{$master->id}}"" "></iframe>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- Modal for edit  -->

<div id="edit-user-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="dark-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content h-100">
            <div class="modal-header bg-dark">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <iframe style="display:block; width:35vw; height:100vh;"  id="editariframe" src="" ></iframe>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- Modal for Create Ticket -->
<?php
$querygenerico="select * from siennadepto";
$siennadeptosgenericos = DB::select($querygenerico);


?>

<script>


        function idticket(cli,tel){
            
            document.getElementById("numberclient").value = cli;
            document.getElementById("phone_client").value = tel;

        }
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
    
<div class="modal fade" id="ctabm" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="exampleModalToggleLabel">Crear ticket</h5>
               
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
           
            <form action="crearticketsiennaclientegetdata" method="post">
                 @csrf

                    <div class="row">
                                                                                                               
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="number-client" class="form-label">Número de Cliente</label>
                            <input readonly type="number" id="numberclient" name="number_client" class="form-control" required>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="number-client" class="form-label">Teléfono</label>
                            <input  type="text" id="phone_client" name="phone_client" class="form-control" >
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
                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-1">
                            <label for="reason" class="form-label">Detalle</label>
                            <textarea class="form-control" name="textticket" rows="4"></textarea>
                        </div>
                        <input value="<?php echo session('nombreusuario');?>" type="hidden" name="logeado" id="logeado">

                    </div>
                </div>
                <div class="modal-footer mt-2">
                <button class="btn btn-success" type="submit" >Crear</button>
                
                    
            </form>
        </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
            
<!-- End of modal Create Ticket -->
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
<br><br><br>


@include('facu.footer')