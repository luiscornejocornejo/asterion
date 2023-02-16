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
    $empresaLogo=str_replace("public/","",$empresaLogo);
}

$query2 = "SELECT nombre FROM `menucolor` where id='" . $empresaMenu . "'";
$resultados2 = DB::select($query2);
foreach ($resultados2 as $valuee2) {
    session(['empresaMenu' => $valuee2->nombre]);
}
?>

<!doctype html>
<html lang="es">

<head>

    <meta charset="utf-8" />
    <title>window.onload()</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- App favicon -->
    <link rel="shortcut icon" href="img/frame.ico">

    <!-- preloader css -->
    <link rel="stylesheet" href="assets/css/preloader.min.css" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <!-- Custom Css -->
    <link href="assets/css/custom.css" rel="stylesheet" type="text/css" />

    <link href="assets/css/main.css" rel="stylesheet" type="text/css" />

    
    <style>
        #principal {
            margin: auto !important;
            width: 80% !important;
            padding: 20px !important;
            margin-top: 50px !important;

        }
        .embed-container {
    position: relative;
    padding-bottom: 56.25%;
    height: 0;
    overflow: hidden;
}
.embed-container iframe {
    position: absolute;
    top:0;
    left: 0;
    width: 100%;
    height: 100%;
}
    </style>
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
   
  
    <link rel="stylesheet" href="build/1.2.3/css/pick-a-color-1.2.3.min.css">
    <script src="build/dependencies/jquery-1.9.1.min.js"></script>
    <script src="build/dependencies/tinycolor-0.9.15.min.js"></script>
    <script src="build/1.2.3/js/pick-a-color-1.2.3.min.js"></script>


    <script type="text/javascript">
        window.onload = function() {
            newPageTitle = "<?php echo $empresaTitle; ?>";
            document.title = newPageTitle;

        }

       
    </script>


</head>

<body>
 
    <!-- <body data-layout="horizontal"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar" style="background-color: <?php echo session('empresaMenu'); ?>;">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="/" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="storage/<?php echo $empresaLogo; ?>" alt="" height="24">
                            </span>
                            <span class="logo-lg">
                                <img src="storage/<?php echo $empresaLogo; ?>" alt="" height="24"> <span class="logo-txt"><?php echo $empresaNombre; ?></span>
                            </span>
                        </a>

                        <a href="/" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="storage/<?php echo $empresaLogo; ?>" alt="" height="24">
                            </span>
                            <span class="logo-lg">
                                <img src="storage/<?php echo $empresaLogo; ?>" alt="" height="24"> <span class="logo-txt"><?php echo $empresaNombre; ?></span>
                            </span>
                        </a>
                    </div>
                    <div class="dropdown d-inline-block">

                    <button type="button" class="btn btn-sm px-3
                            font-size-16 header-item" id="vertical-menu-btn">
                        <i class="home" data-feather="home"></i>
                    </button>
                    </div>
                    <!-- App Search-->

                </div>

                <div class="d-flex">


                    <div class="dropdown d-none d-sm-inline-block">
                        <button type="button" class="btn header-item" id="mode-setting-btn">
                            <i data-feather="moon" class="fas fa-fw fa-moon"></i>
                            <i data-feather="sun" class="fas fa-fw fa-sun"></i>
                        </button>
                    </div>



                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item
                                bg-soft-light border-start border-end" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-1.jpg" alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ms-1
                                    fw-medium"><?php echo session('nombreusuario'); ?></span>
                            <i class="mdi mdi-chevron-down d-none
                                    d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" target="_self" href="/profile"><i class="mdi
                                        mdi-face-profile font-size-16
                                        align-middle me-1"></i> Profile</a>

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" target="_self" href="/salir"><i class="mdi
                                        mdi-logout font-size-16 align-middle
                                        me-1"></i> Salir</a>
                        </div>
                    </div>

                </div>
            </div>
           
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">


            @include('pp.menuizq')

        </div>
        <?php

        use App\Models\users;

        $datos = users::find(session('idusuario'));
        echo $cate = $datos->categoria;


        ?>

<script >
function borrarItemCarrito() {

    /*
                console.log()
                // Obtenemos el producto ID que hay en el boton pulsado
                let id = this.getAttribute('item');
                // Borramos todos los productos
                carrito = carrito.filter(function(carritoId) {
                    return carritoId !== id;
                });
                // volvemos a renderizar
                renderizarCarrito();
                // Calculamos de nuevo el precio
                calcularTotal();*/
            }
    function agregarcarrito(valores) {
                // Anyadimos el Nodo a nuestro carrito
                //carrito.push(valores);
                console.log(carrito);
                valores2=valores.split("|");
                $carrito=document.getElementById("carrito");
                var input = document.createElement("input");

                input.setAttribute("type", "hidden");

                input.setAttribute("name", valores2[5]);

                input.setAttribute("value", valores);
                let miNodo = document.createElement('li');
                    miNodo.classList.add('list-group-item', 'text-right', 'mx-2');
                    let br="<b";
                    console.log(valores2[1]);
                    let ff=valores2[1];
                    let nya=valores2[0];
                    let texx=nya+" ("+ff+")";
                    console.log(texx);

                    miNodo.textContent = texx;
                    miNodo.name=valores;
                    miNodo.appendChild(input);


                    // Boton de borrar
                    /*
                    let miBoton = document.createElement('button');
                    miBoton.classList.add('btn', 'btn-danger');
                    miBoton.textContent = 'X';
                    miBoton.style.margin = '1rem';
                    miBoton.style.float='right';
                    miBoton.value=valores2[5];
                   // miBoton.setAttribute('item', item);
                    miBoton.addEventListener('click', borrarItemCarrito);
                    // Mezclamos nodos
                    miNodo.appendChild(miBoton);*/
                    $carrito.appendChild(miNodo);
               // carrito.push(this.getAttribute('marcador'))
                // Calculo el total
               // calcularTotal();
                // Renderizamos el carrito 
               // renderizarCarrito();
            }
</script>