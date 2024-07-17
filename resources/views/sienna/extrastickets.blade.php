@include('facu.header')

<div class="wrapper menuitem-active">
    @include('facu.menu')
    <div class="content-page" style="padding: 0!important;">
        <div class="container-fluid pt-2">
            <h2>extrastickets</h2>
            <table id="example" class="table dt-responsive w-100">
                <thead class="bg-dark">
                    <tr class="text-center">
                        <th class="text-light">#</th>
                        <th class="text-light">Nombre</th>
                        <th class="text-light">Pseudo</th>
                        <th class="text-light">View</th>
                        <th class="text-light">Modificar</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($tsoporte as $val3) {

                    ?>
                        <tr class="text-center">
                            <td>{{$val3->id}}</td>
                            <td>{{$val3->nombre}}</td>
                            <td class="ellipsis">{{$val3->pseudo}}</td>
                            <td>{{$val3->view}}</td>
                            <td><a role="button" data-bs-toggle="modal" data-bs-target="#preview" class="text-primary">Modificar datos</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
                 
              
        </div>
    </div>
</div>
<!-- Modal Preview -->
<div class="modal fade" id="preview" tabindex="-1" role="dialog" aria-labelledby="modalTitlePreview" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-light">
                    <h5 class="modal-title" id="modalTitlePreview">Listado de usuarios</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">

                    <table class="table table-striped display responsive nowrap w-100 table-bordered" id="excelTable">
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cerrar</button>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@include('facu.footer')