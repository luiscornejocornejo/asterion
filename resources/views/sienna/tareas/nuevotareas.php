<div id="standard-modaltareas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-light">
                        <h4 class="modal-title" id="standard-modalLabel">Crear Usuario</h4>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="/newusers">
        
                        @csrf
                            <label class="form-label" for="exampleInputEmail1">Nombre</label>
                            <input type="text" name="nombre" class="form-control mb-2" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nombre" required="">

                            <label class="form-label" for="exampleInputEmail1">Apellido </label>
                            <input type="text" name="apellido" class="form-control mb-2" id="" aria-describedby="" placeholder="Apellido" required="">
                            
                            <label class="form-label" for="exampleInputEmail1">Email</label>
                            <input type="mail" name="maill" class="form-control mb-2" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Mail logeo" required="">
                            
                            <label class="form-label" for="exampleInputEmail1">Grupos </label>
                            <select name="grupossso[]" class="form-control mb-2" multiple="">   
                                <?php foreach ($deptos as $dep){?>


                                
                                <option value="<?php echo $dep->id;?>"><?php echo $dep->nombre;?></option>
                               <?php }?>
                            </select>
                            
                            <label class="form-label" for="exampleInputEmail1">Contraseña</label>
                            <input type="password" name="pass" class="form-control mb-2" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" required="">
                            
                            <label class="form-label" for="exampleInputEmail1">Rol</label>
                            <select class="form-select mb-3" aria-label="Default select example" name="rol">
                                <option value="2">supervisor</option>
                                <option value="3">agente</option>
                            </select>
                            <label class="form-label" for="exampleInputEmail1">Asignar</label>
                            <select class="form-select mb-3" aria-label="Default select example" name="asignar">
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
                            <label class="form-label" for="exampleInputEmail1">Interno</label>
                            <input type="text" name="interno" class="form-control mb-2" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="303" required="">
                            
                            <button type="submit" class="btn btn-success w-100">Crear</button>
                            
                         </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>   