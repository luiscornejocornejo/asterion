@include('pp.header')
<?php

use Illuminate\Support\Facades\DB;


?>
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









    function vaciarCarrito() {
        // Limpiamos los productos guardados
        carrito = [];
        // Renderizamos los cambios
        renderizarCarrito();
        calcularTotal();
    }




    // Eventos
    $botonVaciar.addEventListener('click', vaciarCarrito);
    $botonPedir.addEventListener('click', pedirCarrito);
    // $cerrarCarrito.addEventListener('click', cerrarCarrito);
    // Inicio
   
</script>

<body id="page-top">

    <!-- Page Wrapper -->


   
    </div>
    <div class="mx-auto" style="width: 1000px;margin-top: 70px;">

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade
                            show" role="alert">
                            {{ $message }}
                            <button type="button" class="btn-close"
                                data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
        @endif

        <!-- Page Wrapper -->
        <div id="wrapper">


            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Busqueda</h1>
                </div>


                <div class="card-body">
                    <div class="table-responsive">
                     
                        <table id="datatable" class="table table-bordered
                            dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Id Nombre</th>
                                    <th>frame function</th>
                                    <th>Id nombre sat</th>
                                    <th>basico</th>
                                    <th>Agregar</th>

                                    <th>neto</th>



                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lista as $resultado)


                                <tr>




                                    <td>
                                        ( <?php echo $resultado->idusuario; ?>)
                                        <?php echo $resultado->nombreusuario . " " . $resultado->apellido; ?></td>
                                    <td><?php echo $resultado->funcionframe; ?></td>
                                    <td>(<?php echo $resultado->categorias; ?>)<?php echo $resultado->nombre; ?></td>

                                    <td><?php echo $resultado->sueldo_basico; ?>
                                    </td>

                                    <td>
                                        <input type="hidden" name="idproyect" value="<?php echo $idproyect; ?>">
                                        <button class="btn btn-primary" onClick="agregarcarrito(this.value)" value="<?php echo $resultado->nombreusuario . " " . $resultado->apellido . "|" . $resultado->funcionframe . "|" . $idproyect . "|" . $resultado->idframe . "|" . $resultado->categorias . "|" . $resultado->id_provider; ?>">Agregar</button>
                                    </td>

                                    <td><?php echo $resultado->sueldo_neto; ?></td>



                                </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <div class="noaa" id="slideIn">

                <img onclick="slide('slideIn'),rotate('flecha')" style="width: 40px;position:absolute;top:50%;left: -40px;" class="rotateIn" id="flecha" src="public/img/flechita.png">
                <div id="contenidoDelTexto">
                    <br><br><br>
                    <br><br><br>


                    <h2>Teams 
                    </h2>
                    <!-- Elementos del carrito -->

                    <form action="/teams" method="post">
                        {{ csrf_field() }}
                        <ul id="carrito" class="list-group"></ul>

                        <hr>
                        <!-- Precio total -->



                        <button type="submit" id="" class="btn btn-primary">Agregar</button>

                    </form>
                    <button id="boton-vaciar" class="btn btn-secondary">Vaciar</button>



                </div>
            </div>
            <script>
                function rotate(id) {

                    var claseActual = document.getElementById(id).className;

                    if (claseActual === "rotateIn") {
                        rotateOut(id);
                    }
                    if (claseActual === 'rotateOut') {
                        rotateIn(id);
                    }

                }

                function rotateIn(id) {
                    document.getElementById(id).className = "rotateIn";
                }

                function rotateOut(id) {
                    document.getElementById(id).className = "rotateOut";
                }

                function slide(id) {



                    var claseActual = document.getElementById(id).className;
                    if (claseActual === 'aa') {
                        slideOut(id);
                    }
                    if (claseActual === 'noaa') {
                        slideIn(id);
                    }

                }

                function slideOut(id) {

                    document.getElementById(id).className = "noaa";
                    //document.getElementById('body').className = "bodyNormal";
                }

                function slideIn(id) {

                    document.getElementById(id).className = "aa";
                    // document.getElementById('body').className = "bodyReducido";
                }
            </script>
            <script>
                <?php $todo = ""; /*
        @foreach($resultadoproductos as $resultadoproducto)
         $ruta = "http://mitiendaoriginal.online/img/productos/" . $resultadoproducto->imagen; ?>
        if ($resultadoproducto->precio == "") {
            $precio = 0;
        } else {
            $precio = $resultadoproducto->precio;
        }

        $todo .= "{subtitulo:'" . $resultadoproducto->descripcion . "',id:" . $resultadoproducto->id . ",nombre:'" . $resultadoproducto->nombre . "',precio:" . $precio . ",imagen:'" . $ruta . "'},"; 
        
        */ ?>
                <?php
                $todo = substr($todo, 0, -1);
                ?>
                window.onload = function() {
                    // Variables
                    let baseDeDatos = [

                        <?php echo $todo; ?>


                    ]
                    let $items = document.querySelector('#items');
                    let carrito = [];
                    let total = 0;
                    let $carrito = document.querySelector('#carrito');
                    let $total = document.querySelector('#total');
                    let $botonVaciar = document.querySelector('#boton-vaciar');
                    let $botonPedir = document.querySelector('#boton-pedir');
                    // let $cerrarCarrito = document.querySelector('#cerrar-carrito');
                    // Funciones
                    function renderItems() {
                        for (let info of baseDeDatos) {
                            // Estructura
                            let miNodo = document.createElement('div');
                            miNodo.classList.add('card', 'col-12', 'col-md-6', 'p-3');
                            // Body
                            let miNodoCardBody = document.createElement('div');
                            miNodoCardBody.classList.add('card-wrapper');
                            // Titulo
                            let miNodoTitle = document.createElement('h5');
                            miNodoTitle.classList.add('card-title', 'center');
                            miNodoTitle.textContent = info['nombre'];
                            // Imagen
                            let miNodoImagen = document.createElement('img');
                            miNodoImagen.classList.add('card-img');
                            miNodoImagen.setAttribute('src', info['imagen']);
                            // Precio
                            let miNodoPrecio = document.createElement('p', 'center');
                            miNodoPrecio.classList.add('card-text');
                            miNodoPrecio.textContent = info['subtitulo'];


                            // Boton 
                            let miNodoBoton = document.createElement('button');
                            miNodoBoton.classList.add('btn', 'btn-warning-outline', 'display-4', 'circulo', 'center');
                            miNodoBoton.textContent = info['precio'];
                            miNodoBoton.setAttribute('marcador', info['id']);
                            miNodoBoton.addEventListener('click', anyadirCarrito);
                            // Insertamos
                            miNodoCardBody.appendChild(miNodoImagen);
                            miNodoCardBody.appendChild(miNodoTitle);
                            miNodoCardBody.appendChild(miNodoPrecio);
                            miNodoCardBody.appendChild(miNodoBoton);
                            miNodo.appendChild(miNodoCardBody);
                            $items.appendChild(miNodo);
                        }
                    }

                  

                    function renderizarCarrito() {
                        // Vaciamos todo el html
                        $carrito.textContent = '';
                        // Quitamos los duplicados
                     
                    }

                    function borrarItemCarrito() {
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
                        calcularTotal();
                    }

                    function calcularTotal() {
                        // Limpiamos precio anterior
                        total = 0;
                        // Recorremos el array del carrito
                        for (let item of carrito) {
                            // De cada elemento obtenemos su precio
                            let miItem = baseDeDatos.filter(function(itemBaseDatos) {
                                return itemBaseDatos['id'] == item;
                            });
                            total = total + miItem[0]['precio'];
                        }
                        // Formateamos el total para que solo tenga dos decimales
                        let totalDosDecimales = total.toFixed(2);
                        // Renderizamos el precio en el HTML
                        $total.textContent = totalDosDecimales;
                    }

                    function vaciarCarrito() {
                        // Limpiamos los productos guardados
                        carrito = [];
                        // Renderizamos los cambios
                        renderizarCarrito();
                        calcularTotal();
                    }


                    function pedirCarrito() {
                        // Limpiamos los productos guardados

                        url = "https://mitiendaoriginal.online/carrito?cart=" + carrito + "&tienda=<?php //echo $resultado->email; 
                                                                                                    ?>";
                        // 
                        //var carrito="casa";
                        elemento = document.getElementById("miModal");
                        elemento.style.display = 'contents';
                        document.getElementById('valor').value = carrito;


                    }

                    // Eventos
                    $botonVaciar.addEventListener('click', vaciarCarrito);
                    $botonPedir.addEventListener('click', pedirCarrito);
                    // $cerrarCarrito.addEventListener('click', cerrarCarrito);
                    // Inicio
                    renderItems();
                }
            </script>



            <style>
                .card-img {
                    width: 290px;
                    height: 250px;
                }

                .circulo {
                    border-radius: 100px !important;
                }

                .center {
                    text-align: center !important;
                }

                .btn {
                    padding: 1rem 1rem;
                }
            </style>

            <style>
                .aa h1 {
                    color: #333;

                }

                .aa li {
                    margin: 12px;
                    margin-top: 1px;
                    margin-bottom: 1px;
                    padding: 2px;
                    list-style: disc;

                }

                .noaa #contenidoDelTexto {
                    visibility: hidden;

                }

                .aa #contenidoDelTexto {
                    width: 100%;
                    height: 100%;
                    overflow: auto;
                }

                @media screen and (max-width: 600px) {
                    .aa #contenidoDelTexto {
                        width: 250px;
                        height: 100%;
                        overflow: auto;
                    }
                }


                .noaa {

                    font-size: 0.8em;
                    box-sizing: border-box;
                    background-color: rgb(242, 242, 242);
                    border-radius: 20px;
                    margin: auto;
                    padding-left: 50px;
                    padding-right: 50px;
                    border: solid 3px #e5e5e5;
                    height: 100%;
                    width: 400px;
                    position: fixed;
                    top: 0;
                    right: -moz-calc(-100% + 15px);
                    right: -webkit-calc(-100% + 15px);
                    right: calc(-100% + 15px);
                    right: -400px;
                    -webkit-transition: all 1s ease;
                    -moz-transition: all 1s ease;
                    -ms-transition: all 1s ease;
                    -o-transition: all 1s ease;
                    transition: all 1s ease;
                }

                .noaa img {}

                .aa {


                    font-size: 0.8em;
                    box-sizing: border-box;
                    background-color: rgb(242, 242, 242);
                    border-radius: 20px;
                    margin: auto;
                    padding-left: 50px;
                    padding-right: 50px;
                    border: solid 3px #e5e5e5;
                    height: 100%;
                    width: 400px;
                    position: fixed;
                    top: 0;
                    right: 0px;
                    -webkit-transition: right 2.5s ease;
                    -moz-transition: all 2.5s ease;
                    -ms-transition: all 2.5s ease;
                    -o-transition: all 2.5s ease;
                    transition: all 2.5s ease;
                }

                .rotateIn {

                    cursor: pointer;
                    -webkit-transition: all 1.5s ease;
                    -moz-transition: all 1.5s ease;
                    -ms-transition: all 1.5s ease;
                    -o-transition: all 1.5s ease;
                    transition: all 1.5s ease;
                    transform: rotate(0deg);
                    -moz-transform: rotate(0deg); // Mozilla
                    -o-transform: rotate(0deg); // Opera
                    -webkit-transform: rotate(0deg); // Webkit

                }

                .rotateOut {

                    cursor: pointer;
                    -webkit-transition: all 1s ease;
                    -moz-transition: all 1s ease;
                    -ms-transition: all 1s ease;
                    -o-transition: all 1s ease;
                    transition: all 1s ease;
                    transform: rotate(180deg);
                    -moz-transform: rotate(180deg); // Mozilla
                    -o-transform: rotate(180deg); // Opera
                    -webkit-transform: rotate(180deg); // Webkit

                }

                .contenedor {
                    min-height: 500px;
                    box-sizing: border-box;
                    padding: 25px;
                    padding-top: 50px;
                    background-color: #ffffff;
                    margin: auto;
                    width: 1366px;
                }

                .bodyNormal {

                    -webkit-transition: all 2.5s ease;
                    -moz-transition: all 2.5s ease;
                    -ms-transition: all 2.5s ease;
                    -o-transition: all 2.5s ease;
                    transition: all 2.5s ease;
                    width: -webkit-calc(100%);
                    width: calc(100%);

                }

                .bodyReducido {
                    -webkit-transition: all 2.5s ease;
                    -moz-transition: all 2.5s ease;
                    -ms-transition: all 2.5s ease;
                    -o-transition: all 2.5s ease;
                    transition: all 2.5s ease;
                    width: -moz-calc(100% - 385px);
                    width: -webkit-calc(100% - 385px);
                    width: calc(100% - 385px);

                }

                .info-gray {
                    width: 500px;
                    margin: auto auto 20px;
                    background-color: rgb(242, 242, 242);
                    padding: 20px;
                    border-radius: 15px;

                }

                .modal-contenido {
                    background-color: aqua;
                    width: 300px;
                    padding: 10px 20px;
                    margin: 20% auto;
                    position: relative;
                }

                .modal {
                    background-color: rgba(0, 0, 0, .8);
                    position: fixed;
                    top: 0;
                    right: 0;
                    bottom: 0;
                    left: 0;
                    opacity: 0;

                    transition: all 1s;
                }

                #miModal:target {
                    opacity: 1;
                    pointer-events: auto;
                }
            </style>
            <!-- Required datatable js -->
            <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
            <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
            <!-- Buttons examples -->
            <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
            <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
            <script src="assets/libs/jszip/jszip.min.js"></script>
            <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
            <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
            <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
            <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
            <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
            <!-- Responsive examples -->
            <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
            <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
            <!-- Datatable init js -->
            <script src="assets/js/pages/datatables.init.js"></script>
            <!-- End of Main Content -->
            <br><br><br>
    @include('pp.footer')