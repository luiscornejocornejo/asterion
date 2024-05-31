@include('facu.header2')


<script>

function rol(dd) {

document.getElementById("user_id").value = dd;

}
function areas(dd) {

document.getElementById("user_id2").value = dd;

}
function ticket(dd) {

document.getElementById("user_id4").value = dd;

}
function notificacion(dd) {

document.getElementById("user_id5").value = dd;

}
function eliminar(dd) {

document.getElementById("idagente").value = dd;

}
</script>
  <!-- Begin page -->
  <div class="wrapper">

      <!-- ========== Left Sidebar Start ========== -->
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
              <!-- Start Content-->
                <div class="container-fluid pt-2">
                    <table id="example" class="table dt-responsive nowrap w-100">
                        <thead class="bg-dark">
                            <tr class="text-center">
                            <th class="text-light">Nombre</th>
                                <th class="text-light">Descripcion</th>
                                <th class="text-light">Users</th>
                                <th class="text-light">Ticket</th>

                                <th class="text-light">Fecha limite</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                        $vueltas=0;
                        foreach($tareas as $val3){
                            if(!isset($val3->nom)){
                                continue;
                            }
                            ?>
                            <tr class="text-center">
                            <td>{{$val3->nom}}</td>
                                <td>{{$val3->descripcion}}</td>
                                <td>{{$val3->users}}</td>
                                
 
                                
                                <td>{{$val3->fechalimite}}</td>
                              
                                <td>
                                    <button onclick="rol(`{{$val3->id}}`)"  data-bs-toggle="modal" data-bs-target="#standard-modalrol" class="btn btn-info rounded" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-account-cog" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-custom-class="mb-1" data-bs-title="Rol"></i>
                                    </button> 
                                    <button onclick="areas(`{{$val3->id}}`)"  data-bs-toggle="modal" data-bs-target="#standard-modalareas"  class="btn btn-warning rounded" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-office-building-cog" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-custom-class="mb-1" data-bs-title="Departamento"></i>
                                    </button> 

                                    <button onclick="ticket(`{{$val3->id}}`)"  data-bs-toggle="modal" data-bs-target="#standard-modalticket"  class="btn btn-success rounded" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-account-arrow-left-outline" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-custom-class="mb-1" data-bs-title="Asignación automática"></i>
                                    </button> 
                                    <button onclick="notificacion(`{{$val3->id}}`)"  data-bs-toggle="modal" data-bs-target="#standard-modalnotificacion"  class="btn btn-primary rounded" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-email" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-custom-class="mb-1" data-bs-title="Notificación email"></i>
                                    </button> 
                                    <button onclick="eliminar(`{{$val3->id}}`)"  data-bs-toggle="modal" data-bs-target="#standard-modalticketeliminar"  class="btn btn-danger rounded" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-delete-outline" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-custom-class="mb-1" data-bs-title="Departamento"></i>
                                    </button> 
                                </td>
                                <?php 
                                if($vueltas==23){
                                //dd($val3);
                                }
                                $vueltas++;?>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    
                                                     
                </div>
              <!-- container -->
          </div>
          <!-- content -->
      </div>
        

<!-- Modal users register -->
@include('sienna.tareas.nuevotareas')        

                    
      <!-- End users register -->
      <div class="newAgent"  data-bs-toggle="modal" data-bs-target="#standard-modaltareas">
        <i class="mdi mdi-account-plus" style="font-size: 25px;"></i>
      </div>

    </div>
  <!-- END wrapper -->
  
  @include('facu.footer')

  