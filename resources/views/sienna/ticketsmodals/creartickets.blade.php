<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/flotante.css">
     <!-- App favicon -->
  <link rel="shortcut icon" href="assetsfacu/images/favicon.ico">

  <!-- Daterangepicker css -->
  <link rel="stylesheet" href="assetsfacu/vendor/daterangepicker/daterangepicker.css">

  <!-- Datables-->
  <link href="assetsfacu/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
  <link href="assetsfacu/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />

  <!-- Vector Map css -->
  <link rel="stylesheet" href="assetsfacu/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css">

  <!-- Theme Config Js -->
  <script src="assetsfacu/js/hyper-config.js"></script>

  <!-- App css -->
  <link href="assetsfacu/css/app-saas.min.css" rel="stylesheet" type="text/css" id="app-style">

  <!-- Icons css -->
  <link href="assetsfacu/css/icons.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <!-- HTML -->
<div class="floating-button">
    <button id="main-button" class="bg-primary text-light" onclick="toggleRotation(); toggleMenu()">
      <span class="mdi mdi-plus"></span>
    </button>
    <div id="menu" class="hidden">
      <button 
        id="button-2" 
        class="mdi mdi-ticket-account bg-warning text-light"
        data-bs-toggle="modal" href="#exampleModalToggle"
       >
    </button>
      <button id="button-3" class="mdi mdi-send bg-success text-light "></button>
    </div>
  </div>

    <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-end align-items-center me-2 mt-2">
        <!-- Then put toasts within -->
        <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-success text-white">
                <span class="me-1"><i class="mdi mdi-check-bold me-1 text-light"></i>Ticket creado exitosamente</span>
                <strong ></strong>
                <div class="ms-auto">
                    <small class="ms-auto">ahora</small>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
            <div class="toast-body">
                El numero de ticket es ct_sienna.
            </div>
        </div>
    </div> <!--end toast-->

<div aria-live="polite" aria-atomic="true" class="d-flex justify-content-end align-items-center me-2 mt-2" >
    <!-- Then put toasts within -->
    <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-danger text-light">
            <span class="me-1"><i class="mdi mdi-close text-light me-1"></i>Hubo un inconveniente</span>
            <strong ></strong>
            <div class="ms-auto">
                <small class="">ahora</small>
                <button type="button" class=" btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        <div class="toast-body">
            Verifique si el numero de cliente es existente.
        </div>
    </div> <!--end toast-->
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
<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
tabindex="-1">
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
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
tabindex="-1">
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
            
    <!--End  Between Modal -->
<!-- Vendor js -->
<script src="assetsfacu/js/vendor.min.js"></script>

<!-- App js -->
<script src="assetsfacu/js/app.min.js"></script>
  <script src="flotante.js"></script>
</body>
</html>