<?php

$saliente = 1;

         if($saliente ==1){?>
          

<script>
 function toggleMenu() {
     var menu = document.getElementById("menu");
     if (menu.classList.contains("hidden")) {
     menu.classList.remove("hidden");
     menu.classList.add("visible");
     } else {
     menu.classList.remove("visible");
     menu.classList.add("hidden");
     }
 }

 function toggleRotation() {
     var button = document.getElementById('main-button');
     button.classList.toggle('rotated'); // Agrega o quita la clase 'rotated' al hacer clic
 }
</script>

<!-- Modal for Create Ticket -->
<div id="create-ticket-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="dark-header-modalLabel" aria-hidden="true">
 <div class="modal-dialog">
     <div class="modal-content">
         <div class="modal-header bg-dark">
             <h4 class="modal-title text-light" id="dark-header-modalLabel">Crear ticket</h4>
             <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
         </div>
         <div class="modal-body">
             <form>
                 <div class="mb-3">
                     <label for="type-user" class="form-label">Tipo de busqueda</label>
                     <select class="form-select" id="type-user">
                         <option value="id">Cliente</option>
                         <option value="id">Telefono</option>
                     </select>
                 </div>                                                                                            
                 <div class="mb-3">
                     <label for="number-client" class="form-label">Numero de cliente</label>
                     <input type="number" id="number-client" class="form-control" required>
                 </div>
             </form>
         </div>
         <div class="modal-footer">
             <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancelar</button>
             <button type="submit" class="btn btn-success">Crear</button>
         </div>
     </div><!-- /.modal-content -->
 </div><!-- /.modal-dialog -->
</div>
<!-- End of modal Create Ticket -->

<!-- Between Modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"tabindex="-1">
<div class="modal-dialog modal-dialog-centered modal-lg">
 <div class="modal-content">
     <div class="modal-header bg-dark">
         <h5 class="modal-title text-white" id="exampleModalToggleLabel">Crear ticket</h5>
         <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">
         <form>
             <div class="row">
                 <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                     <label for="type-user" class="form-label">Tipo de busqueda</label>
                     <select class="form-select" id="type-user">
                         <option value="id">Cliente</option>
                         <option value="id">DNI o CUIT</option>
                         <option value="id">Cédula o RUC</option>
                         <option value="id">Telefono</option>
                     </select>
                 </div>                                                                                            
                 <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                     <label for="number-client" class="form-label">Número registrado en la cuenta</label>
                     <input type="number" id="number-client" name="number-client" class="form-control" required>
                 </div>
                 <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-1">
                     <label for="department" class="form-label">Departamento</label>
                     <select class="form-select">
                         <option id="1">Administración</option>
                         <option id="2">Instalaciones</option>
                         <option id="3">Soporte</option>
                         <option id="4">Ventas</option>
                     </select>
                 </div>
                 <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-1">
                     <label for="reason" class="form-label">Motivo</label>
                     <input type="text" class="form-control" id="reason" name="reason">
                 </div>
             </div>
         </form>
     </div>
     <div class="modal-footer mt-2">
         <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal"
             data-bs-dismiss="modal">No es cliente</button>
             <button class="btn btn-success" type="submit" onclick="">Crear</button>
     </div>
 </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
     
<!-- Modal -->
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"tabindex="-1">
 <div class="modal-dialog modal-dialog-centered modal-lg">
     <div class="modal-content">
         <div class="modal-header bg-dark">
             <h5 class="modal-title text-light" id="exampleModalToggleLabel2">Crear Ticket</h5>
             <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
             <div class="row">
                 <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                     <label for="fullname" class="form-label">Nombre completo</label>
                     <input type="text" class="form-control" id="fullname" name="fullname">
                 </div>
                 <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                     <label for="phone" class="form-label">Telefono de contacto</label>
                     <input type="text" class="form-control" id="phone" name="phone">
                 </div>
                 <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-1">
                     <label for="address" class="form-label">Dirección</label>
                     <input type="text" class="form-control" id="address" name="address">
                 </div>
                 <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-1">
                     <label for="city" class="form-label">Localidad</label>
                     <input type="text" class="form-control" id="city" name="city">
                 </div>
                 <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-1">
                     <label for="reason-prospect" class="form-label">Motivo</label>
                     <input type="text" class="form-control" id="reason-prospect" name="reason-prospect">
                 </div>
                 <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-1">
                     <label for="department-prospect" class="form-label">Departamento</label>
                     <select class="form-select" id="department-prospect" name="department-prospect">
                         <option id="1">Administración</option>
                         <option id="2">Instalaciones</option>
                         <option id="3">Soporte</option>
                         <option id="4">Ventas</option>
                     </select>
                 </div>
             </div>
         </div>
         <div class="modal-footer mt-2">
             <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal"
                 data-bs-dismiss="modal">Volver</button>
         </div>
     </div><!-- /.modal-content -->
 </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script src="flotante.js"></script>

<?php }?>