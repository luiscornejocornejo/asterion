<div id="standard-modalvalor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-light">
                        <h4 class="modal-title" id="standard-modalLabel">Crear Valor</h4>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="/newvalor">
        
                        @csrf
                            <label class="form-label" for="exampleInputEmail1">Nombre</label>
                            <input type="text" name="nombre" class="form-control mb-2" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nombre" required="">

                            <label class="form-label" for="exampleInputEmail1">Icono </label>
                            <input type="text" name="icono" class="form-control mb-2" id="" aria-describedby="" placeholder="Icono" required="">
                            
                            <label class="form-label" for="exampleInputEmail1">Valor</label>
                            <input type="text" name="valor" class="form-control mb-2" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Valor" required="">
                            
                           
                            <button type="submit" class="btn btn-success w-100">Crear</button>
                            
                         </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>   