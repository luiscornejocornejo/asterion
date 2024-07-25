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
              <script type="application/javascript" src="https://api.ipify.org?format=jsonp&callback=getIP"></script>

               prueba telefonia
               <script type="application/javascript">
                    function getIP(json) {                      
                      necesito=json.ip;
                    }
                    var idusuario =<?php echo session('idusuario');?>;
                    var URLactual = window.location.href;
                    var datos="";
                    var porciones = URLactual.split('.');
                    let result = porciones[0].replace("https://", "");
                    url = "https://"+result+".suricata.cloud/api/tokennn?idusuario=" + idusuario;
                    console.log(url);
                      axios.get(url)
                    .then(function (response) {
                      datos=response.data;
                      console.log(datos);
                      console.log("My public IP address is: ", necesito," mi userid es:",idusuario," mi subdominio es :",result,"  datos:",datos);


                    })
                    .catch(function (error) {
                        // función para capturar el error
                        console.log(error);
                    })
                    .then(function () {
                        // función que siempre se ejecuta
                    });
</script>


              <!-- container -->
          </div>
          <!-- content -->
      </div>
  
<!-- Modal users register -->

  <!-- END wrapper -->

  @include('facu.footer')