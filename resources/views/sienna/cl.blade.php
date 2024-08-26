@include('facu.header')

  <!-- Begin page -->
  <div class="wrapper">

      <!-- ========== Left Sidebar Start ========== -->
      @include('facu.menu')

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

          
            

        $url="http://209.38.66.108/cl?token=prueba&merchant=".$subdomain_tmp."&email_suricata=".$subdomain_tmp;
        ?>
      <!-- ========== Left Sidebar End ========== -->

      <!-- ============================================================== -->
      <!-- Start Page Content here -->
      <!-- ============================================================== -->

      <div class="content-page" style="padding:0 !important;">
          <div class="content">

              <!-- Start Content-->
              <div class="container-fluid">
                 <div>
                 <iframe src="<?php echo $url; ?>" sandbox="allow-forms allow-scripts allow-popups allow-same-origin allow-top-navigation" ></iframe>
                 </div>
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
