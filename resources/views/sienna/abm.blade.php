@include('facu.header')

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

<!-- ========== Left Sidebar Start ========== -->
<div class="wrapper menuitem-active">
    @include('facu.menu')

    <div class="content-page" style="padding: 0!important;">
        <div class="content">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <!-- Page Wrapper -->
            <div class="container-fluid">
                <!-- Begin Page Content -->
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">ABM <?php echo $nombrereporte;?></h1>
                </div>
                <button class="btn btn-success" onclick="exportTableToExcel('datatable')">Exportar </button>
                <?php
                if ($master->crear == 1) { ?>
                    <a class="btn btn-primary" href="/siennacreate?report={{$master->id}}" role="button">Nuevo</a>
                <?php } ?>

                <table role="table" id="example" class="table table-bordered dt-responsive nowrap w-100 mt-2">
                    <thead role="rowgroup" class="table-dark">
                        <tr role="row">

                            @foreach($cabezeras as $cabeza)

                            <th role="columnheader">{{ $cabeza }}</th>


                            @endforeach
                            <th role="columnheader">Action</th>


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
                                    dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Action <i class="mdi
                                    mdi-chevron-down"></i></button>
                                    <div class="dropdown-menu">
                                        <?php if ($master->modificar == 1) { ?>
                                            <a onclick="editar('siennaabmmodificar?registro={{$resultado->$registro}}&idreport={{$idreport}}&pk={{$registro}}')" class="btn btn-warning" role="button" data-bs-toggle="modal" data-bs-target="#edit-user-modal"> <i data-feather="edit"></i></a>
                                        <?php } ?>
                                        <?php if ($master->eliminar == 1) { ?>

                                            <button type="button" onclick="borrar(<?php echo $resultado->$registro; ?>)" class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center"><i data-feather="delete"></i></button>

                                        <?php } ?>

                                    </div>
                                </div><!-- /btn-group -->


                            </td>

                        </tr>
                        @endforeach

                    </tbody>
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
    

<div class="newAgent" data-bs-toggle="modal" data-bs-target="#create-user-modal">
    <i class="mdi mdi-plus" style="font-size: 25px;"></i>
</div>

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
    <div class="modal-dialog modal-lg">
        <div class="modal-content h-100">
            <div class="modal-header bg-dark">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <iframe  src="https://<?php echo $subdomain_tmp; ?>.suricata.cloud/siennacreate?report={{$master->id}}"" class="w-100 h-100"></iframe>
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
                <iframe id="editariframe" src="" class="w-100 h-100"></iframe>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- End of modal Create Ticket -->
<br><br><br>
@include('facu.footer')