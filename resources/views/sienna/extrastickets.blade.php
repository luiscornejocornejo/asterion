@include('facu.header')


<script>
    function pasar(uno,dos,tres){
          
        document.getElementById("campo").value = uno;
        document.getElementById("pseudo").value = dos;
        document.getElementById("view").value = tres;

        }
</script>

    
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
                            <td><a onclick="pasar('{{$val3->nombre}}','{{$val3->pseudo}}','{{$val3->view}})'"  role="button" data-bs-toggle="modal" data-bs-target="#preview" class="text-primary">Modificar datos</a>
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
                    <h5 class="modal-title" id="modalTitlePreview">Modificar <div id="nombre"></div></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">

                <form method="post" action="/extrasmod">
                @csrf
                <input type="text" name="campo" id="campo" value="">
                <input type="text" name="pseudo" id="pseudo" value="">
                <input type="text" name="view" id="view" value="">
                <select name="view">

                <option value="0">No</option>
                <option value="1">Si</option>
                    </select>
                <input type="submit"  value="enviar">



                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cerrar</button>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@include('facu.footer')