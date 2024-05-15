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
                                <th class="text-light">Departamento</th>
                              
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                        foreach($motivoc as $val3){
                            
                            ?>
                            <tr class="text-center">
                            <td>{{$val3->nombre}}</td>
                                <td>{{$val3->deptonombre}}</td>
                                <td>
                                    <button onclick="modi(`{{$val3->id}}`)"  data-bs-toggle="modal" data-bs-target="#standard-modalrol" class="btn btn-info rounded" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-account-cog" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-custom-class="mb-1" data-bs-title="Rol"></i>
                                    </button> 
                                    <button onclick="eliminar(`{{$val3->id}}`)"  data-bs-toggle="modal" data-bs-target="#standard-modalareas"  class="btn btn-warning rounded" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-office-building-cog" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-custom-class="mb-1" data-bs-title="Departamento"></i>
                                    </button> 

                                  
                                </td>
                            
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
 
      <!-- End users register -->
      <div class="newAgent"  data-bs-toggle="modal" data-bs-target="#standard-modal23">
        <i class="mdi mdi-account-plus" style="font-size: 25px;"></i>
      </div>

    </div>
  <!-- END wrapper -->

  @include('facu.footer')