@include('facu.header2')


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
                  
                <div class="form-group">
 
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header  text-white" style="background-color:#3C3F50">
                                        <h5 class="modal-title text-white"></h5>
                                        <button onclick="notifyMe()">noti</button>
                                    </div>
                                    <div class="modal-body" style="text-align:center">

                                        <form method="post" action="/getdata">

                                                @csrf
                                                <br>
                                            <label for="exampleInputEmail1">getdata </label>
                                            <input type="text" name="cliente" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="cliente" required>
                                            <br>
                                        
                                                <button type="submit" style="background-color:#18D777" class="btn  form-control">Buscar</button>

                                        </form>

                                    </div>

                                
                                </div><!-- /.modal-content -->
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="border" class="col-4">
                                    <div class="row">
                                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12">
                                        
                                        
                                        <table id="example"  class="table table-striped dt-responsive nowrap w-100 text-light">
                                            <thead>
                                                    <tr class="text-center bg-dark" >                             
                                                        <th class="text-light">Nombre</th>
                                                        <th class="text-light">Icono</th>
                                                        <th class="text-light">Valor</th>
                                                      
                                                    </tr>
                                            </thead>
                                            <tbody id="tb">
                                                    <?php foreach($getdata as $valh){?>
                                                        <tr class="text-center">
                                                        <td><?php echo $valh->nombre;?></td>
                                                        <td><?php echo $valh->icono;?></td>
                                                        <td><?php echo $valh->valor;?></td>
                                                    </tr>
                                                        <?php  }?>
                                            </tbody>
                                            </table>
                                              
                                    </div>
                                    
                                </div> 
                                    </div>
                                    <div class="border" class="col-2">
                                    <?php if(isset($datosonline)){?>

                                        <pre id="json"></pre>

                                        <script>
                                        let data = <?php echo $datosonline;?>;
                                        document.getElementById("json").textContent = JSON.stringify(data, undefined, 2);
                                        </script>     
                                     <?php }?>
                                    </div>
                                    
                                </div>
                            </div>

                           




                                                     
                </div>
              <!-- container -->
          </div>
          <!-- content -->
      </div>
        

      @include('sienna.getdata.nuevovalor')        

      <!-- End users register -->
      <div class="newAgent"  data-bs-toggle="modal" data-bs-target="#standard-modalvalor">
        <i class="mdi mdi-account-plus" style="font-size: 25px;"></i>
      </div>

    </div>
  <!-- END wrapper -->
  
  @include('facu.footer')

  