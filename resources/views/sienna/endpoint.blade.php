@include('pp.header')

<div id="principal">
    <div class="mx-auto" style="width: 1000px;margin-top: 70px;">

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade
                            show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">endpoint</h1>
                </div>

                <pre id="json"></pre>

                <script>

                    let data=<?php echo $datosget;?>;
                    document.getElementById("json").textContent = JSON.stringify(data, undefined, 2);

                </script>


            </div>
        </div>
    </div>
</div>
<br><br><br>
    @include('pp.footer')