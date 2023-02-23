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

<?php
/*
var_dump($_SERVER['SERVER_NAME'] );
var_dump($_SERVER['HTTP_HOST'] );
$domainParts = explode('.', $_SERVER['SERVER_NAME']);
$subdomain_tmp =  array_shift($domainParts);

var_dump($subdomain_tmp );
 */?>
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <iframe style="width: 1400px; height: 1400px !important; "  src="http://ibm.clientdeck.com.ar/public/dashboard/cdef47f0-e7af-4dd1-87c9-57abcf17fdcc"  frameborder="0" allowfullscreen></iframe>
            <div class="row">
                <?php

use App\Models\dashboard;
use App\Models\graficos;

$das = dashboard::datos();
// var_dump($das);
foreach ($das as $value) {

    ?>

                    <div class="col-lg-4">
                        <div class="card border border-primary">
                            <div class="card-header bg-transparent border-primary">
                                <h5 class="my-0 text-primary"><i class="mdi
                                mdi-bullseye-arrow me-3"></i><?php echo $value->titulo; ?></h5>
                                <p class="card-text"><?php echo $value->subtitulo; ?></p>
                            </div>
                            <div class="card-body">
                                <?php
$master = dashboard::reporte($value->masterreport);
    $grafi = graficos::find($value->tipo);
    if ($master->servicio != 2) {

        $a = "<a target=_blank  href='/ceviche_view?id=" . $master->id . "'   >" . $master->nombre . "</a>";
        echo $a;
    } else {
        $grafico = "grafico";?>
                                    <iframe id="inlineFrameExample"
                                    title="Inline Frame Example"
                                    scrolling="no"
                                    width="300"
                                    height="300"
                                    src="/ceviche_grafico_iframe?id=<?php echo $master->id; ?>&graficos=<?php echo $grafi->nombre; ?>">
                                </iframe>
                                   <?php
}
    //  echo $view=dashboard::grafico($master,$value->tipo);
    ?>
                            </div>
                        </div>
                    </div>


                <?php }?>
            </div>
            </div>
        </div>
    </div>
</div>
<br><br><br>
@include('pp.footer')