@include('facu.header2')
<div class="wrapper" >

<!-- ========== Left Sidebar Start ========== -->
@include('facu.menu')


<div class="content-page" style="padding: 0!important;">

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade
                            show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
<script>
    function pp(){

        vari=document.getElementById("reportrange").value;
        alert(vari);
    }
</script>
        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <form method="get" action="/cerrados">
                <div class="row">
                    <div class="col-lg-4 col-sm-12">
                        <label class="form-label">Período</label>
                        <div name="fecha" id="reportrange" class="form-control" data-toggle="date-picker-range" data-target-display="#reportrange" data-cancel-class="btn-light">
                            <i class="mdi mdi-calendar"></i>&nbsp;
                            <span ></span> <i class="mdi mdi-menu-down"></i>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="mb-2 position-relative">
                            <label class="form-label">&nbsp;</label>
                            <input onclick="pp()" type="submit" type="button" class="form-control w-25 bg-success text-light" value="Buscar">
                        </div>
                    </div>
                </div>
            </form>
                


            </div>
        </div>
    </div>
</div>
<br><br><br>
@include('facu.footer')
