<?php

use Illuminate\Support\Facades\DB;

$idusuario =  session('idusuario');
$query = "SELECT * from users where id='" . $idusuario . "'";
$resultados = DB::select($query);
foreach ($resultados as $valuee) {

    $birthdate = $valuee->birthdate;
    $email = $valuee->email;
    $name = $valuee->nombre;
    $dni = $valuee->dni;
}
?>


@include('facu.header')
<div class="wrapper">
    @include('facu.menu')


    <div class="content-page" style="padding: 0!important;">
        <div class="content">
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
                <div>

                    <div class="container-fluid mt-2">

                        <!-- start page title -->
                        
                        <!-- end page title -->


                        <div class="card bg-dark">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm order-2 order-sm-1">
                                        <div class="d-flex align-items-start mt-3
                                mt-sm-0">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xl me-3">
                                                    <img src="assets/images/users/avatar-11.png" alt="" class="img-fluid
                                            rounded-circle d-block">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div>
                                                    <h5 class="font-size-16 mb-1 text-light"><?php echo $cliente; ?></h5>
                                                    <p class="text-muted font-size-13">Plan: $plan | Valor : $200</p>
                                                    <p class="text-light font-size-13">Cantidad de tickets: 13</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                        <div class="row">
                            <div class="col-xl-4 col-lg-6 md-6 sm-12" >
                                <div class="card">
                                    <div class="card-body h-100">
                                        <strong class="text-uppercase">Información del cliente</strong>
                                        <hr>
                                        <p><strong>Nombre: </strong>ss</p>
                                        <p><strong>Email: </strong>ss</p>
                                        <p><strong>Dirección: </strong>ss</p>
                                        <p><strong>Whatsapp: </strong>ss</p>
                                        <p><strong>Deuda: </strong>ss</p>
                                        <p><strong>Estado de cuenta: </strong>ss</p>
                                        <p><strong>IP: </strong>ss</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 md-6 sm-12">
                                <div class="card bg-info text-light">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h4 class="fw-normal" title="Number of Customers">C-SAT</h4>
                                            </div>
                                            <div>
                                                <i class="mdi mdi-note-text widget-icon text-white bg-info"></i>
                                            </div>
                                        </div>
                                        <hr>
                                        <p class="h1">3,2</p>
                                    </div>
                                </div>
                                <div class="card bg-success text-light">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h4 class="fw-normal" title="Number of Customers">NPS</h4>
                                            </div>
                                            <div>
                                                <i class="mdi mdi-note-text widget-icon text-white bg-success"></i>
                                            </div>
                                        </div>
                                        <hr>
                                        <p class="h1">8,4</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 md-6 sm-12">
                            <div>
                                <div class="card bg-success" role="button" data-bs-toggle="modal" data-bs-target="#modal-open-chat-profile">
                                    <div class="card-body">
                                        <p class="h3 text-center text-white">
                                            <i class="mdi mdi-whatsapp me-1"></i>Abrir ticket por Whatsapp
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="card bg-secondary" role="button" data-bs-toggle="modal" data-bs-target="#modal-push-call">
                                    <div class="card-body">
                                        <p class="h3 text-center text-white p-2">
                                            <i class="mdi mdi-phone me-1"></i>Llamar al cliente
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="card bg-info" role="button" data-bs-toggle="modal" data-bs-target="#modal-push-nps">
                                    <div class="card-body">
                                        <p class="h3 text-center text-white">
                                            <i class="mdi mdi-file-send-outline me-1"></i>Disparar encuesta NPS
                                        </p>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>

                        <div class="row">

                           
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase mb-0">Tickets creados</h5>
                                <hr>
                                <table class="table table-centered mb-0 bg-ligth">
                                    <thead>
                                        <tr class="bg-dark">
                                            <th class="text-white">Ticket</th>
                                            <th class="text-white">Area</th>
                                            <th class="text-white">Topic</th>
                                            <th class="text-white">Estado</th>
                                            <th class="text-white">Agente</th>
                                            <th class="text-white">Fecha creado</th>
                                            <th class="text-white">Fecha cerrado</th>
                                            <th class="text-white">C-SAT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><i class="mdi mdi-whatsapp text-success me-1"></i>1</td>
                                            <td><span class="badge bg-warning">Soporte</span></td>
                                            <td>General Soporte</td>
                                            <td><span class="badge bg-success">Cerrado</td>
                                            <td>Pepito</td>
                                            <td>12-04-2024 20:02</td>
                                            <td>12-04-2024 22:02</td>
                                            <td>3,2</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->


                        <!-- end card -->
                    </div>
                    <!-- end tab pane -->
                </div>
                <!-- end tab content -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
      

    </div> <!-- container-fluid -->
</div>
</div>
</div>
</div>
</div>
<br><br><br>
@include('facu.footer')