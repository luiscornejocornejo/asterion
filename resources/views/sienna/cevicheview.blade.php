@include('pp.header')


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
        foreach ($cabezeras as $cabeza) { ?>td:nth-of-type(<?php echo $cant; ?>):before {
            content: "<?php echo $cabeza; ?>"
        }


        <?php $cant++;
        }
        if ($modificar == 1) { ?>td:nth-of-type(<?php echo $cant; ?>):before {
            content: "Modificar";
        }

        <?php }
        if ($eliminar == 1) { ?>td:nth-of-type(<?php echo $cant + 1; ?>):before {
            content: "eliminar";
        }

        <?php }
        ?>
    }
</style>
<div id="principal">


    <div class="mx-auto" style="width: 1000px;margin-top: 70px;">

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
                    <h1 title="{{$descripcion}}" class="h3 mb-0 text-gray-800">{{$nombre}}
                    </h1>
                </div>
                <!-- Content Row -->
                <!-- /.container-fluid -->
                <div class="container-fluid">
                    <button class="btn btn-success" onclick="exportTableToExcel('datatable')">Exportar </button>

                    <?php if ($formulario) {  ?>

                        <div class="container-fluid">
                            <form method="post">
                                @csrf
                                <?php
                                $parametrosTipo2 = explode(",", $parametrosTipo);
                                $parametros2 = explode(",", $parametros);

                                for ($i = 0; $i < sizeof($parametrosTipo2); $i++) {

                                    $pos4 = stripos($parametrosTipo2[$i], "int");
                                    if ($pos4 !== false) {
                                        $tipo = "number";
                                    }
                                    $pos = stripos($parametrosTipo2[$i], "varchar");
                                    if ($pos !== false) {
                                        $tipo = "text";
                                    }

                                    $pos2 = stripos($parametrosTipo2[$i], "text");
                                    if ($pos2 !== false) {
                                        $tipo = "textarea";
                                    }

                                    $pos3 = stripos($parametrosTipo2[$i], "tinyint(1)");
                                    if ($pos3 !== false) {
                                        $tipo = "boolean";
                                    }

                                    $pos3 = stripos($parametrosTipo2[$i], "datetime");
                                    if ($pos3 !== false) {
                                        $tipo = "datetime-local";
                                    }




                                ?>
                                    <div class="form-group">

                                        <label for="<?php echo $parametros2[$i]; ?>"><?php echo $parametros2[$i]; ?></label>
                                        <?php
                                        if ($tipo == "textarea") {

                                        ?>
                                            <textarea name="<?php echo $parametros2[$i]; ?>" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>

                                        <?php
                                        } elseif ($tipo == "boolean") {

                                        ?>

                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="<?php echo $parametros2[$i]; ?>" id="flexSwitchCheckDefault">
                                            </div>

                                        <?php


                                        } else {

                                        ?>
                                            <input type="<?php echo $tipo; ?>" class="form-control" name="<?php echo $parametros2[$i]; ?>" aria-describedby="emailHelp" placeholder="<?php echo $parametros2[$i]; ?>">

                                        <?php
                                        } ?>

                                    </div>
                                <?php }  ?>
                                <button type="submit" class="btn btn-primary btn-block">Buscar</button>

                            </form>


                        </div>

                    <?php

                    }
                    ?>

                    <?php
                    if ($crear == 1) {

                    ?>

                        <a class="btn btn-primary" href="/create?table={{$tabla}}&<?php echo $link; ?>" role="button">Nuevo</a>
                    <?php
                    }

                   
                    ?>






                    <div class="table-responsive">

                        <table role="table" id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                            <thead role="rowgroup" class="table-dark">
                                <tr role="row">

                                    @foreach($cabezeras as $cabeza)
                                    <?php if ($cabeza <> "id") { ?>

                                        <th role="columnheader">{{ $cabeza }}</th>
                                    <?php  } ?>

                                    @endforeach
                                    <?php
                                    if ($modificar == 1) {
                                    ?>
                                        <th role="columnheader">Modificar</th> <?php

                                                                            } ?>
                                    <?php
                                    if ($eliminar == 1) {
                                    ?>
                                        <th role="columnheader">Eliminar</th> <?php

                                                                            } ?>
                                  
                                </tr>
                            </thead>
                            <tbody role="rowgroup">
                                @foreach($resultados as $resultado)


                                <tr role="row">
                                    @foreach($cabezeras as $cabeza)
                                    <?php if ($cabeza <> "id") { ?>
                                        <td role="cell">
                                            {!! $resultado->$cabeza !!}
                                        </td>

                                    <?php  } ?>
                                    @endforeach
                                    <?php
                                    if ($modificar == 1) {
                                        if (isset($resultado->id)) {
                                    ?>
                                            <td role="cell"><a class="btn btn-warning" href="/modificar?reporte={{$idreporte}}&id={{$resultado->id}}" role="button"> <i data-feather="edit"></i></a> </td>
                                    <?php

                                        }
                                    } else {


                                        echo "<td>Su tabla no tiene primarikey id</td>";
                                    } ?>
                                    <?php
                                    if ($eliminar == 1) {
                                    ?>
                                        <td role="cell">
                                            <button type="button" onclick="borrar(<?php echo $resultado->id; ?>)" class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center"><i data-feather="delete"></i></button>
                                        </td>

                                    <?php

                                    } ?>
                                 
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
                                        <p>Esta seguro que quiere borrar el registro de la tabla <?php echo $tabla; ?></p>
                                        <form method="post" action="eliminar">

                                            <input type="hidden" name="tabla" id="tabla" value="<?php echo $tabla; ?>">
                                            <input type="hidden" name="idregistro" id="idregistro">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->

                        <!-- End of Main Content -->
                        <!-- Required datatable js -->

                        <!-- Footer -->


                        <footer class="sticky-footer bg-white">
                        </footer>
                        <!-- End of Footer -->
                    </div>
                    <!-- End of Content Wrapper -->

                </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->



            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
</div>
@include('pp.footer')