


  <!-- Theme Settings -->
 
 
  <!-- Vendor js --> 
  <script src="assetsfacu/js/vendor.min.js"></script>

  <link href="assetsfacu/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
  <link href="assetsfacu/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />

  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>


    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.dataTables.min.css"></script>


    <script type="text/javascript">
   new DataTable('#example', {
    "responsive": true,

  "language" : {
    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
  },
  dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
}
)
    </script>
  <!-- Daterangepicker js -->
  <script src="assetsfacu/vendor/daterangepicker/moment.min.js"></script>
  <script src="assetsfacu/vendor/daterangepicker/daterangepicker.js"></script>


  <script src="assetsfacu/vendor/quill/quill.min.js"></script>
 <!-- quill Init js-->
 <script src="assetsfacu/js/pages/demo.quilljs.js"></script>
  <!-- Apex Charts js -->

  <!-- Vector Map js -->
 
  <!-- Dashboard App js -->

  <!-- App js -->
  <script src="assetsfacu/js/app.min.js"></script>


  

<svg id="SvgjsSvg1001" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;"><defs id="SvgjsDefs1002"></defs><polyline id="SvgjsPolyline1003" points="0,0"></polyline><path id="SvgjsPath1004" d="M0 0 "></path></svg><div class="daterangepicker ltr single opensright"><div class="ranges"></div><div class="drp-calendar left single" style="display: block;"><div class="calendar-table"></div><div class="calendar-time" style="display: none;"></div></div><div class="drp-calendar right" style="display: none;"><div class="calendar-table"></div><div class="calendar-time" style="display: none;"></div></div><div class="drp-buttons"><span class="drp-selected"></span><button class="cancelBtn btn btn-sm btn-default" type="button">Cancel</button><button class="applyBtn btn btn-sm btn-primary" disabled="disabled" type="button">Apply</button> </div></div><div class="jvectormap-label"></div>

<script >
    $(function() {
    console.log( "ready!" );


var url      = 'https://view-chat.pagoralia.dev/ctxSip/phone/',
    features = 'menubar=no,location=no,resizable=no,scrollbars=no,status=no,addressbar=no,width=320,height=480';

    $('#launchPhone').on('click', function(event) {
        event.preventDefault();
        // This is set when the phone is open and removed on close
        if (!localStorage.getItem('ctxPhone')) {
            window.open(url, 'ctxPhone', features);
            return false;
        } else {
            window.alert('Phone already open.');
        }
    })
});
</script>
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
<div class="floating-button">
<button id="main-button" class="bg-primary text-light" onclick="toggleRotation(); toggleMenu()">
<span class="mdi mdi-plus"></span>
</button>
<div id="menu" class="hidden">
<button  id="button-2" class="mdi mdi-ticket-account bg-warning text-light" data-bs-toggle="modal" href="#exampleModalToggle" ><button id="button-3" class="mdi mdi-send bg-success text-light "></button>
</div>
</div>
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
</body>
</html>