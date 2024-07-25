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
               <script type="application/javascript">
                    var idusuario =<?php echo session('idusuario');?>;
                    var URLactual = window.location.href;
                    var porciones = URLactual.split('.');
                    let result = porciones[0].replace("https://", "");
                      function getIP(json) {
                        document.write("My public IP address is: ", json.ip," mi userid es:",idusuario," mi subdominio es :",result);
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