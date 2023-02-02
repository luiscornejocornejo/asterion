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
<?php
echo "hola";
$das = dashboard::where('id',$cate)->get();

var_dump($das);
//echo $das->titulo;?>
            <div class="col-lg-4">
                <div class="card border border-primary">
                    <div class="card-header bg-transparent border-primary">
                        <h5 class="my-0 text-primary"><i class="mdi
                                mdi-bullseye-arrow me-3"></i>Primary outline
                            Card</h5>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">card title</h5>
                        <p class="card-text">Some quick example text to build on
                            the card title and make up the bulk of the card's
                            content.</p>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<br><br><br>
@include('pp.footer')

