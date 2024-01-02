@include('facu.header')

  <!-- Begin page -->
  <div class="wrapper">

      <!-- ========== Left Sidebar Start ========== -->
      @include('facu.menu')

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
