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
                    <h1 class="h3 mb-0 text-gray-800">Estado</h1>
                </div>

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
$maytapiProduct = "3336d0b5-4e23-4a50-8243-f76dfd70dddd";
$maytapiNumber = "2231";
$maytapiToken = "66bf7ec4-241b-4418-87cb-3ace5ddad33f";
$salida2=shell_exec('curl -X GET "https://api.maytapi.com/api/'.$maytapiProduct.'/'.$maytapiNumber.'/qrCode" -H "accept: application/json" -H "x-maytapi-key: '.$maytapiToken.'"');
header('Content-type: image/png');
//echo $salida2;
?>
</div>


            </div>
        </div>
    </div>
</div>
<br><br><br>
    @include('pp.footer')