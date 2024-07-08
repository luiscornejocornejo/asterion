@include('facu.header2')



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
               <h1>Mis Tareas</h1>
                <div class="container-fluid pt-2">
                    <table id="example" class="table dt-responsive nowrap w-100">
                        <thead class="bg-dark">   
                            <tr class="text-center">
                            <th class="text-light">Nombre</th>
                                <th class="text-light">Descripcion</th>
                                <th class="text-light">Ticket</th>
                                <th class="text-light">F. Limite</th>

                                <th class="text-light">Estado</th>
                               
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                        $vueltas=0;
                        foreach($mistareas as $val3){
                           
                            ?>
                            <tr class="text-center">
                            <td>{{$val3->nombre}}</td>
                                <td>{{$val3->descripcion}}</td>
                                <td>{{$val3->siennatickets}}</td>
                                <td>{{$val3->fechalimite}}</td>
                                <td>{{$val3->estadotarea}}</td>
                              
 
                              
                            
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    
                 
                </div>
              <!-- container -->
</div>
          </div>
          <!-- content -->
      </div>
           

<!-- Modal users register -->
 

  @include('facu.footer')

  