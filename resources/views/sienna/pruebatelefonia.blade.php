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
              <!-- container -->
          </div>
          <!-- content -->
      </div>
  
<!-- Modal users register -->

  <!-- END wrapper -->

  @include('facu.footer')