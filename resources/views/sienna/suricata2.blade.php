

<style>
body {
    margin: 0;            /* Reset default margin */
}
iframe {
    display: block;       /* iframes are inline by default */
    background: #000;
    border: none;         /* Reset default border */
    height: 90%;        /* Viewport-relative units */
    width: 85vw;
    margin-top:20px;
    margin-right:70px;

z-index: 999;}
    </style>

    @include('creative2.header')
  
    <div id="principal">
    <div class="container mx-auto" style="margin-top: 70px;">

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
            
<iframe src="<?php echo $url;?>" sandbox="allow-forms allow-scripts allow-popups allow-same-origin allow-top-navigation" ></iframe>




</div>

@include('creative2.footer')