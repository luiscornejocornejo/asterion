@php
 use Illuminate\Http\Request;
@endphp
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
               $miip=request()->ip();
               ?>
               <script type="application/javascript">
                      
                    
                      necesito="<?php echo $miip;?>";
                      console.log("My public IP address is: ", necesito," mi subdominio es :  datos:",<?php echo $tokeninterno;?>);
                      let hay=<?php echo $tokeninterno;?>;
                      if(hay==0) {
                        console.log("no logear");
                      }
                        else{
                          console.log("logear");
                          //necesito="45.46.46.46";
                          var URLactual = window.location.href;
                          var porciones = URLactual.split('.');
                          let result = porciones[0].replace("https://", "");
                          url2 = "https://"+result+".suricata.cloud/api/telefonia?ip=" + necesito ;
                          console.log(url2);
                          axios.get(url2)
                          .then(function (response) {
                            console.log("data:");

                            console.log(response.data);


                          })
                          .catch(function (error) {
                              // función para capturar el error
                              console.log("error:");

                              console.log(error);
                          })
                          .then(function () {
                              // función que siempre se ejecuta
                          });

                        }
                    

                    
                  
                      
</script>


              <!-- container -->
          </div>
          <!-- content -->
      </div>
  
<!-- Modal users register -->

  <!-- END wrapper -->

  @include('facu.footer')