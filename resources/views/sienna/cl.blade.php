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




            $url = "https://cl.suricata-conversations.com.ar/cl?token=prueba&merchant=" . $subdomain_tmp . "&email_suricata=" . $emailuri;
            //dd($url);
            ?>
            <!-- ========== Left Sidebar End ========== -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->



            <iframe style="width: 100%!important; height: 100%!important;" src="<?php echo $url; ?>" sandbox="allow-forms allow-scripts allow-popups allow-same-origin "></iframe>




            <!-- content -->
        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


        <!-- END wrapper -->

        @include('facu.footer')