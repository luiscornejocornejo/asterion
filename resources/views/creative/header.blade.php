<?php

use Illuminate\Support\Facades\DB;

$categoria =  session('categoria');
$query = "SELECT * from empresa";
$resultados = DB::select($query);
foreach ($resultados as $valuee) {

    $empresaNombre = $valuee->nombre;
    $empresaTitle = $valuee->title;
    //$empresaBody=$valuee->body;
    $empresaMenu = $valuee->menucolor;
    $empresaLogo = $valuee->logo;
}

$query2 = "SELECT nombre FROM `menucolor` where id='" . $empresaMenu . "'";
$resultados2 = DB::select($query2);
foreach ($resultados2 as $valuee2) {
    session(['empresaMenu' => $valuee2->nombre]);
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="light" data-layout="topnav" data-topbar-color="dark" data-layout-mode="fluid" data-layout-position="fixed">

<head>
    <title>window.onload()</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets3/images/favicon.ico">

    <!-- Theme Config Js -->
    <script src="assets3/js/hyper-config.js"></script>

    <!-- App css -->
    <link href="assets3/css/app-saas.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="assets3/css/icons.min.css" rel="stylesheet" type="text/css" />



    <link href="assets3/vendor/simplemde/simplemde.min.css" rel="stylesheet" type="text/css" />





    <script type="text/javascript">
        window.onload = function() {
            newPageTitle = "<?php echo $empresaTitle; ?>";
            document.title = newPageTitle;

        }
    </script>
    <script>
        function exportTableToExcel(tableID, filename = '') {
            var downloadLink;
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById(tableID);
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

            // Specify file name
            filename = filename ? filename + '.xls' : 'excel_data.xls';

            // Create download link element
            downloadLink = document.createElement("a");

            document.body.appendChild(downloadLink);

            if (navigator.msSaveOrOpenBlob) {
                var blob = new Blob(['ufeff', tableHTML], {
                    type: dataType
                });
                navigator.msSaveOrOpenBlob(blob, filename);
            } else {
                // Create a link to the file
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

                // Setting the file name
                downloadLink.download = filename;

                //triggering the function
                downloadLink.click();
            }
        }

        function borrar(x) {


            document.getElementById("idregistro").value = x;
        }
    </script>
</head>