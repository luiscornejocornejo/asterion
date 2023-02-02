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
        if (isset($datos)) { ?>td:nth-of-type(0):before {
            content: "id"
        }

        td:nth-of-type(1):before {
            content: "nombre"
        }

        td:nth-of-type(2):before {
            content: "base"
        }



        td:nth-of-type(3):before {
            content: "Modificar"
        }

        ;

        td:nth-of-type(4):before {
            content: "eliminar"
        }

        ;

        <?php } ?>
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
                    <h1 class="h3 mb-0 text-gray-800">Sienna</h1>
                </div>

                <form action="" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Tipo de servicio</label>
                        <select name="servicio" class="form-control" id="exampleFormControlSelect2">
                            <?php foreach ($servicios as $value) { ?>
                                <option value='<?php echo $value->id; ?>'><?php echo $value->nombre; ?></option>
                            <?php  } ?>

                        </select>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Elejir</button>
                    </div>
                </form>

                <br><br>


                <?php if (isset($datos)) { ?>
                    <a class="btn btn-primary" href="/serviciocreate?id={{$id}}" role="button">Nuevo</a>
                    <div class="table-responsive">

                        <table role="table" id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                            <thead role="rowgroup" class="table-success">
                                <tr role="row">
                                    <th role="columnheader">id</th>
                                    <th role="columnheader">nombre</th>
                                    <th role="columnheader">base</th>
                                    <th role="columnheader">Action</th>
                                </tr>
                            </thead>
                            <tbody role="rowgroup">
                                @foreach($datos as $resultado)
                                <tr role="row">

                                <?php if($id==2){

                                    $a="<a href='/siennagraficos?id=".$resultado->id ."'>".$resultado->id ."</a>";
                                }elseif($id==1){

                                    $a="<a href='/siennareport?id=".$resultado->id ."'>".$resultado->id ."</a>";
                                }elseif($id==3){

                                    $a="<a href='/siennaendpoint?id=".$resultado->id ."'>".$resultado->id ."</a>";
                                }elseif($id==4){

                                    $a="<a href='/siennaemail?id=".$resultado->id ."'>".$resultado->id ."</a>";
                                }elseif($id==5){

                                    $a="<a href='/siennaabm?id=".$resultado->id ."'>".$resultado->id ."</a>";
                                }elseif($id==6){

                                    $a="<a href='/siennaform?id=".$resultado->id ."'>".$resultado->id ."</a>";
                                }elseif($id==7){

                                    $a="<a href='/siennaformg?id=".$resultado->id ."'>".$resultado->id ."</a>";
                                }elseif($id==8){

                                    $a="<a href='/siennaforme?id=".$resultado->id ."'>".$resultado->id ."</a>";
                                }
                                
                                else{
                                    $a=$resultado->id ;
                                }?>
                                    <td role="cell">{!! $a !!}</td>
                                    <td role="cell">{!! $resultado->nombre !!}</td>
                                    <td role="cell">{!! $resultado->base !!}</td>
                                    <td role="cell">

                                        <div class="btn-group">
                                        <button type="button" class="btn btn-primary
                                    dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Action <i class="mdi
                                        mdi-chevron-down"></i></button>
                                        <div class="dropdown-menu">
                                            <a class="btn btn-warning" href="/siennamodificar?id={{$resultado->id}}" role="button"> <i data-feather="edit"></i></a>
                                            <button type="button" onclick="borrar(<?php echo $resultado->id; ?>)" class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center"><i data-feather="delete"></i></button>


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
                                    <form method="post" action="eliminar">

                                        <input type="hidden" name="tabla" id="tabla" value="masterreport">
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
        <?php } ?>
        </div>
    </div>
</div>
</div>
<br><br><br>
@include('pp.footer')