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
                                    <div class="border" class="col-xs-8">
                                    <?php if(isset($datosonline)){?>

                                        <pre id="json"></pre>

                                        <script>
                                        let data = <?php echo $datosonline;?>;
                                        document.getElementById("json").textContent = JSON.stringify(data, undefined, 2);
                                        </script>     
                                     <?php }?>
                                    </div>
                                    <div class="border" class="col-xs-4">
                                        TWO
                                    </div>
                                </div>
                            </div>

                           




                                                     
                </div>
              <!-- container -->
          </div>
          <!-- content -->
      </div>
        


      <!-- End users register -->
      <div class="newAgent"  data-bs-toggle="modal" data-bs-target="#standard-modalgetdata">
        <i class="mdi mdi-account-plus" style="font-size: 25px;"></i>
      </div>

    </div>
  <!-- END wrapper -->
  
  @include('facu.footer')

  