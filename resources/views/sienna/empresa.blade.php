@include('facu.header2')

  <!-- Begin page -->
  <div class="wrapper">

      <!-- ========== Left Sidebar Start ========== -->
      @include('facu.menu')


      <div class="content-page" style="padding: 0!important;">
          <div class="content">

              <!-- Start Content-->
                <div class="container pt-5">
                 <form action="/empresadatos" method="post">

                 frecuencia:<input type="number" name="frecuencia">
                 zona:<input type="text" name="zona">
                 <button type="submit" class="btn btn-primary">Consultar</button>

                 </form>
                                                     
                </div>
              <!-- container -->
          </div>
          <!-- content -->
      </div>
  
<!-- Modal users register -->
<div id="standard-modal23" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-light">
                        <h4 class="modal-title" id="standard-modalLabel">Crear Usuario</h4>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="">
        
                            <input type="hidden" name="_token" value="GzdQZnVvlvbdi86JzkX8IjKUp7MINuufrqu138MD">
                            <label class="form-label" for="exampleInputEmail1">Nombre</label>
                            <input type="text" name="nombre" class="form-control mb-2" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nombre" required="">

                            <label class="form-label" for="exampleInputEmail1">Apellido </label>
                            <input type="text" name="apellido" class="form-control mb-2" id="" aria-describedby="" placeholder="Apellido" required="">
                            
                            <label class="form-label" for="exampleInputEmail1">Email</label>
                            <input type="mail" name="maill" class="form-control mb-2" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Mail logeo" required="">
                            
                            <label class="form-label" for="exampleInputEmail1">Grupos </label>
                            <select name="grupossso[]" class="form-control mb-2" multiple="">    
                                <option>soporte</option>
                                <option>atencion cliente</option>
                                <option>ventas</option>
                            </select>
                            
                            <label class="form-label" for="exampleInputEmail1">Contraseña</label>
                            <input type="password" name="pass" class="form-control mb-2" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" required="">
                            
                            <label class="form-label" for="exampleInputEmail1">Rol</label>
                            <select class="form-select mb-3" aria-label="Default select example" name="tipo">
                                <option>supervisor</option>
                                <option>agente</option>
                            </select>
        
                            <button type="submit" class="btn btn-success w-100">Crear</button>
                            
                         </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>    
      <!-- End users register -->
      <div class="newAgent"  data-bs-toggle="modal" data-bs-target="#standard-modal23">
        <i class="mdi mdi-account-plus" style="font-size: 25px;"></i>
      </div>

    </div>
  <!-- END wrapper -->

  @include('facu.footer')