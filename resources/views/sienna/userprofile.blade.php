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

<style>
  .tooltip-button {
     position: relative;
    display: inline-block;
    border-bottom: 1px dotted #ccc;
    color: #006080;
    
  }
  
  /* Tooltip text */
  .tooltip-button .tooltiptext {
    visibility: hidden;
    position: absolute;
    width: 100px;
    background-color: #555;
    color: #fff;
    text-align: center;
    padding: 5px 0;
    border-radius: 6px;
    z-index: 1;
    opacity: 0;
    transition: opacity .6s;
    font-size: 15px;
  }
  
  /* Show the tooltip text when you mouse over the tooltip container */
  .tooltip-button:hover .tooltiptext {
    visibility: visible;
    opacity: 1;
  }

  .tooltip-bottom {
  top: 135%;
  left: 50%;  
  margin-left: -60px;
    }
  .tooltip-bottom::after {
    content: "";
    position: absolute;
    bottom: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: transparent transparent #555 transparent;
}
</style>


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

                        <?php foreach($datoscliente as $val){
                                            
                                            $nombrecliente=$val->nya;
                                            $emailcliente=$val->email;
                                            $direccioncliente=$val->address;
                                            $celcliente=$val->cel;
                                            $deudacliente=$val->deuda;
                                            $estadocliente=$val->a_status;
                                            $ipcliente=$val->ip;
                                            
                                        }?>
                       
                        <!-- end card -->
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 md-6 sm-12" >
                                <div class="card bg-dark">
                                    <div class="card-body h-100">
                                        <strong class="text-uppercase text-white">Información del cliente</strong>
                                        <hr>
                                        
                                        <p class="text-light font-size-13"><strong>Nombre: </strong><?php echo $nombrecliente;?></p>
                                        <p class="text-light font-size-13"><strong>Email: </strong><?php echo $emailcliente;?></p>
                                        <p class="text-light font-size-13"><strong>Dirección: </strong><?php echo $direccioncliente;?></p>
                                        <p class="text-light font-size-13"><strong>Whatsapp: </strong><?php echo $celcliente;?></p>
                                        <p class="text-light font-size-13" ><strong>Deuda: </strong><?php echo $deudacliente;?></p>
                                        <p class="text-light font-size-13" ><strong>Estado de cuenta: </strong><?php echo $estadocliente;?></p>
                                        <p class="text-light font-size-13"><strong>IP: </strong><?php echo $ipcliente;?></p>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 md-6 sm-12">
                                <div class="card bg-info text-light">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h4 class="fw-normal" title="Number of Customers">C-SAT</h4>
                                            </div>
                                            <div class="tooltip-button" role="button">
                                                <i class="mdi mdi-comment-check-outline widget-icon text-white bg-info">
                                                    <span class="tooltiptext tooltip-bottom">Enviar C-SAT</span>
                                                </i>
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
                                            <div class="tooltip-button" role="button">
                                                <i class="mdi mdi-comment-check widget-icon text-white bg-success">
                                                <span class="tooltiptext tooltip-bottom">Enviar NPS</span>
                                                </i>
                                            </div>
                                        </div>
                                        <hr>
                                        <p class="h1">0</p>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                           
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase mb-0">Tickets creados (<?php  echo sizeof($tickets);?>)</h5>
                                <hr>
                                <table id="example"  class="table table-centered mb-0 bg-ligth">
                                    <thead>
                                        <tr class="bg-dark">
                                            <th class="text-white">Ticket</th>
                                            <th class="text-white">Area</th>
                                            <th class="text-white">Topic</th>
                                            <th class="text-white">Estado</th>
                                            <th class="text-white">Fecha creado</th>
                                            <th class="text-white">Fecha cerrado</th>
                                            <th class="text-white">C-SAT</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php foreach($tickets as $val2){?>
                                        <tr>
                                            <td><a href="{{ url('ticketunico?tick=' . $val2->id) }}" target="_blank"><?php echo $val2->id;?></a></td>
                                            <td><?php echo $val2->departamento;?></td>
                                            <td><?php echo $val2->motivo;?></td>
                                            <td><?php echo $val2->estado;?></td>
                                            <td><?php echo $val2->inicio;?></td>
                                            <td><?php echo $val2->cerrado;?></td>
                                            <td><?php echo $val2->csat;?></td>
                                        </tr>

                                        <?php }?>
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
      
        <div class="floating-button">
            <button id="button-3" class="mdi mdi-send bg-success text-light " data-bs-toggle="modal" data-bs-target="#warning-alert-modal2"></button>
            
        </div> 
    </div> <!-- container-fluid -->
</div>
</div>
</div>
</div>
</div>
<br><br><br>
@include('sienna.flotantes.salientesunico')

@include('facu.footer')