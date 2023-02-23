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

        
            <div id="semaforo">


<?php
$clientName = "soporte"; // $_ENV['CLIENT_NAME'];
$maytapiNumber = "2231"; // $_ENV['MAYTAPI_ID'];
$maytapiProduct = "3336d0b5-4e23-4a50-8243-f76dfd70dddd"; // $_ENV['MAYTAPI_PRODUCT_ID'];
$maytapiToken = "66bf7ec4-241b-4418-87cb-3ace5ddad33f"; // $_ENV['MAYTAPI_TOKEN'];
$salida = shell_exec('curl -X GET "https://api.maytapi.com/api/' . $maytapiProduct . '/' . $maytapiNumber . '/status" -H "accept: application/json" -H "x-maytapi-key: ' . $maytapiToken . '"');
$json = json_decode($salida, true);
$json2 = json_encode($json['status']['loggedIn']);

$result = str_replace('"', "", $json2);
//echo $result;

if ($result == 'true') {
    echo '
<meta http-equiv="refresh" content="1000">
<center>
<table style="width: 100px; height: 100px; margin-left: auto; margin-right: auto;">
  <tr>
    <td style="padding:0 50px 0 50px;"><p style="text-align: center;"><img src="img/semaforo_verde.png" alt="Estado de Servicio ok" width="150" height="264"></p></td>
    <td style="padding:0 50px 0 50px;"><p style="text-align: center;">El estado del servicio es: <b>CONECTADO</b></p></td>
  </tr>
</table>
</center>';
} elseif ($result == 'false') {
    echo '
<meta http-equiv="refresh" content="1000">
<center>
<table style="width: 100px; height: 100px; margin-left: auto; margin-right: auto;">
  <tr>
    <td style="padding:0 50px 0 50px;"><p style="text-align: center;"><img src="img/semaforo_rojo.png" alt="Estado de Servicio no ok" align="center" width="150" height="264"></p></td>
    <td style="padding:0 50px 0 50px;"><p style="text-align: justify;"><iframe src="https://' . $clientName . '.clientdeck.com.ar/maytapiqr.php" align="center" frameBorder="0" width="264" height="264" overflow:scroll></iframe></p></td>
  </tr>
</table>
</center>';
} else {
    echo '
<meta http-equiv="refresh" content="1000">
<center>
<table style="width: 100px; height: 100px; margin-left: auto; margin-right: auto;">
  <tr>
    <td style="padding:0 50px 0 50px;"><p style="text-align: center;"><img src="img/semaforo_amarillo.png" alt="Estado de Servicio con alerta" width="150" height="264"></p></td>
    <td style="padding:0 50px 0 50px;"><p style="text-align: center;">El estado del servicio es: <b>', $result, '</b></p></td>
  </tr>
</table>
</center>';
}
?>

            </div>

            <div id="qr">

<?php

$salida=shell_exec('curl -X GET "https://api.maytapi.com/api/'.$maytapiProduct.'/'.$maytapiNumber.'/qrCode" -H "accept: application/json" -H "x-maytapi-key: '.$maytapiToken.'"');
header('Content-type: image/png');
echo $salida;
?>
</div>
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