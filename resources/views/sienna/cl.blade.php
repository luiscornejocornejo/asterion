@include('facu.header2')

  <!-- Begin page -->
  <div class="wrapper">

      <!-- ========== Left Sidebar Start ========== -->
          <div class="content"> @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade
                            show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
      <?php

            $subdomain_tmp = 'localhost';
            if (isset($_SERVER['HTTP_HOST'])) {
                $domainParts = explode('.', $_SERVER['HTTP_HOST']);
                $subdomain_tmp =  array_shift($domainParts);
            } elseif (isset($_SERVER['SERVER_NAME'])) {
                $domainParts = explode('.', $_SERVER['SERVER_NAME']);
                $subdomain_tmp =  array_shift($domainParts);
            }
            $emailuri = session('email_suricata');

          
            

        $url="https://cl.suricata-conversations.com.ar/cl?token=prueba&merchant=".$subdomain_tmp."&email_suricata=".$emailuri;
       //dd($url);
       ?>
      <!-- ========== Left Sidebar End ========== -->

      <!-- ============================================================== -->
      <!-- Start Page Content here -->
      <!-- ============================================================== -->

      <div class="content-page" style="padding: 0!important;">
          <div class="content">

              <!-- Start Content-->
              <div class="container-fluid">
                 <div>
                 <iframe height="800px;"  src="<?php echo $url; ?>" sandbox="allow-forms allow-scripts allow-popups allow-same-origin " ></iframe>
                 </div>
                 <script>

              </div>
              <!-- container -->
          </div>
          <!-- content -->
      </div>
  
      <!-- ============================================================== -->
      <!-- End Page content -->
      <!-- ============================================================== -->

  </div>
  <!-- END wrapper -->

  @include('facu.footer')
