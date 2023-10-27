

@include('facu.header')
<div class="wrapper">

<!-- ========== Left Sidebar Start ========== -->
@include('facu.menu')
<style>
    @media only screen and (max-width: 760px),
    (min-device-width: 768px) and (max-device-width: 1024px) {

        /* Force table to not be like tables anymore */
        table,
        thead,
        tbody,
        th,
        td,
        tr {
            display: block;
        }

        /* Hide table headers (but not display: none;, for accessibility) */
        thead tr {
            position: absolute;
            top: -9999px;
            left: -9999px;
            padding: 2rem 1rem !important;
        }

        tr {
            margin: 1rem 1rem 1rem 1rem !important;
        }

        tr:nth-child(odd) {
            background: #ccc;
        }

        td {
            /* Behave  like a "row" */
            border: none;
            border-bottom: 1px solid #eee;
            position: relative;
            padding-left: 50%;
        }

        td:before {
            /* Now like a table header */
            position: absolute;
            /* Top/left values mimic padding */
            top: 0;
            left: 6px;
            width: 45%;
            padding-right: 10px;
            white-space: nowrap;
        }

        <?php $cant = 0;
        foreach ($cabezeras as $cabeza) { ?>
             td:nth-of-type(<?php echo $cant; ?>):before {content: "<?php echo $cabeza; ?>"};
        <?php $cant++;
        } ?>
        td:nth-of-type(<?php echo $cant; ?>):before {content: "Modificar"; };
        td:nth-of-type(<?php echo $cant + 1; ?>):before {content: "eliminar"; };
    }
</style>
<div id="principal">
    <div class="container" >

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade
                            show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Report</h1>
                </div>
                <button class="btn btn-success" onclick="exportTableToExcel('datatable')">Exportar </button>
                <?php
                    if ($master->crear == 1) {?>
                        <a class="btn btn-primary" href="/siennacreate?report={{$master->id}}" role="button">Nuevo</a>
                    <?php } ?>

                <div class="table-responsive">


                    <table role="table" id="datatable" class="table table-bordered dt-responsive nowrap w-100">
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
    <?php  if ($master->modificar == 1) {?>
    <a class="btn btn-warning" href="/siennaabmmodificar?registro={{$resultado->$registro}}&idreport={{$idreport}}&pk={{$registro}}" role="button"> <i data-feather="edit"></i></a>
    <?php }?>
    <?php  if ($master->eliminar == 1) {?>

    <button type="button" onclick="borrar(<?php echo $resultado->$registro; ?>)" class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center"><i data-feather="delete"></i></button>

    <?php }?>

</div>
</div><!-- /btn-group -->


</td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
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

                                        <input type="hidden" name="tabla" id="tabla" value="<?php echo $master->tabla;?>">
                                        <input type="hidden" name="idregistro" id="idregistro">
                                        <input type="hidden" name="dbexterna" id="dbexterna" value="<?php echo $master->base;?>">
                                        <input type="hidden" name="pk" id="pk" value="<?php echo $registro;?>">

                                        @csrf
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </div>

            </div>
        </div>
    </div>
</div>
<br><br><br>
@include('facu.footer')