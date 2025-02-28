@include('facu.header2')

  <!-- Begin page -->
  <div class="wrapper" >

      <!-- ========== Left Sidebar Start ========== -->
      @include('facu.menu')


      <div class="content-page" style="padding: 0!important;">
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

                        <table role="table" id="example" class="table table-bordered dt-responsive nowrap w-100">
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
                                elseif($id==9){

                                    $a="<a href='/siennaexcel?id=".$resultado->id ."'>".$resultado->id ."</a>";
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
@include('facu.footer')