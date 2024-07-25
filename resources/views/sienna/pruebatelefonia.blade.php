@include('facu.header2')

  <!-- Begin page -->
  <div class="wrapper">

      <!-- ========== Left Sidebar Start ========== -->
      @include('facu.menu')


      <div class="content-page" style="padding: 0!important;">
          <div class="content"> @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade
                            show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif


              <!-- Start Content-->

               prueba telefonia
               <?php   
               $tokeninterno = session('tokeninterno');
               ?>
               <script type="application/javascript">

                    function getIP(json) {                      
                      necesito=json.ip;
                      console.log("My public IP address is: ", necesito," mi userid es:",idusuario," mi subdominio es :",result,"  datos:",<?php echo $tokeninterno;?>);

                      if(<?php echo $tokeninterno;?>==="") {
                            console.log("El string está vacío");
                          }
                        else{
                          console.log("logear");

                        }
                    }   

                    
                  
                      
</script>
<script type="application/javascript" src="https://api.ipify.org?format=jsonp&callback=getIP"></script>


              <!-- container -->
          </div>
          <!-- content -->
      </div>
  
<!-- Modal users register -->

  <!-- END wrapper -->

  @include('facu.footer')