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
                          url="'https://suricata99.llamadaip.org/firewall/iptables-varios2.php?ip="+necesito+"&estado=ON'";
                          url2 = "https://"+result+".suricata.cloud/api/telefonia?url=" + url + "";
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