@include('facu.header2')

<script>
let departamentoslista = {!! json_encode($deptos,JSON_FORCE_OBJECT) !!};

function rol(dd) {

document.getElementById("user_id").value = dd;

}
function areas(dd) {

document.getElementById("user_id2").value = dd;

}
function ticket(dd) {

document.getElementById("user_id4").value = dd;

}
</script>
  <!-- Begin page -->
  <div class="wrapper">

      <!-- ========== Left Sidebar Start ========== -->
      @include('facu.menu')


      <div class="content-page" style="padding: 0!important;">
          <div class="content">

              <!-- Start Content-->
                <div class="container-fluid pt-2">
                    <table id="example" class="table dt-responsive nowrap w-100">
                        <thead class="bg-dark">
                            <tr class="text-center">
                            <th class="text-light">Nombre</th>
                                <th class="text-light">Apellido</th>
                                <th class="text-light">Email</th>
                                <th class="text-light">Asignarse</th>

                                <th class="text-light">Departamentos</th>
                                <th class="text-light">Rol</th>
                                <th class="text-light">Interno</th>
                                <th class="text-light">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                        $vueltas=0;
                        foreach($agentes as $val3){
                            if(!isset($val3->nom)){
                                continue;
                            }
                            ?>
                            <tr class="text-center">
                            <td>{{$val3->nom}}</td>
                                <td>{{$val3->last_name}}</td>
                                <td>{{$val3->email}}</td>
                                <td><?php
                                 if($val3->tickets==1){
                                    echo "Si";
                                }else{
                                    echo "No";
                                }?>
                                    </td> 
                                <?php 
                                $dp=explode(",",$val3->deptosuser);

                                $nue="";
                                foreach($dp as $vl){

                                    foreach($deptos as $val2){
                                        if($val2->id==$vl){
                                            $nue.=$val2->nombre."-";
                                        }
                                    }
                                   // $nue.=$deptos[$vl-1]->nombre."-" ;
                                }
                                ?>
                                <td>{{$nue}}</td>
 
                                
                                <td>{{$val3->tipousuario}}</td>
                                <td>{{$val3->interno}}</td>
                              
                                <td>
                                    <button onclick="rol(`{{$val3->idusu}}`)"  data-bs-toggle="modal" data-bs-target="#standard-modalrol" class="btn btn-info rounded" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-account-cog" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-custom-class="mb-1" data-bs-title="Rol"></i>
                                    </button> 
                                    <button onclick="areas(`{{$val3->idusu}}`)"  data-bs-toggle="modal" data-bs-target="#standard-modalareas"  class="btn btn-warning rounded" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-office-building-cog" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-custom-class="mb-1" data-bs-title="Departamento"></i>
                                    </button> 

                                    <button onclick="ticket(`{{$val3->idusu}}`)"  data-bs-toggle="modal" data-bs-target="#standard-modalticket"  class="btn btn-success rounded" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-office-building-cog" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-custom-class="mb-1" data-bs-title="Departamento"></i>
                                    </button> 

                                    <button onclick="eliminar(`{{$val3->idusu}}`)"  data-bs-toggle="modal" data-bs-target="#standard-modalticketeliminar"  class="btn btn-danger rounded" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-office-building-cog" data-bs-toggle="tooltip" data-bs-placement="top"
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
      @include('sienna.usermodal.rol')        
      @include('sienna.usermodal.areas')        
      @include('sienna.usermodal.ticket')        
      @include('sienna.usermodal.nuevo')        

<!-- Modal users register -->
 
      <!-- End users register -->
      <div class="newAgent"  data-bs-toggle="modal" data-bs-target="#standard-modal23">
        <i class="mdi mdi-account-plus" style="font-size: 25px;"></i>
      </div>

    </div>
  <!-- END wrapper -->

  @include('facu.footer')