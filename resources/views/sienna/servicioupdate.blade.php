@include('facu.header')



<div class="wrapper menuitem-active">
@include('facu.menu')
    <div class="content-page" style="padding: 0!important;">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade
                            show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
<?php 
foreach ($report as $valor){

    $nombre=$valor->nombre;
    $query=$valor->query;
    $descripcion=$valor->descripcion;
    $crear=$valor->crear;
    $modificar=$valor->modificar;
    $eliminar=$valor->eliminar;
    $parametros=$valor->parametros;
    $parametrosTipo=$valor->parametrosTipo;
    $tabla=$valor->tabla;
    $servicio=$valor->servicio;
    $dashboard=$valor->dashboard;
    $base=$valor->base;
}?>

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800"><?php //echo $servicio[1]; 
                                                    ?></h1>
            </div>

            <form action="" method="post" enctype="multipart/form-data">

                @csrf

                <input type="hidden" name="idreport" value="<?php echo $idreport;?>">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Sienna Reporting</h4>
                            </div>
                            <div class="card-body">

                                <div id="progrss-wizard" class="twitter-bs-wizard">
                                    <ul class="twitter-bs-wizard-nav nav nav-pills
                                nav-justified">
                                        <li class="nav-item">
                                            <a href="#progress-seller-details" class="nav-link" data-toggle="tab">
                                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Seller Details">
                                                    <i class="bx bx-list-ul"></i>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#progress-company-document" class="nav-link" data-toggle="tab">
                                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Company Document">
                                                    <i class="bx bx-book-bookmark"></i>
                                                </div>
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="#progress-bank-detail" class="nav-link" data-toggle="tab">
                                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Bank
                                            Details">
                                                    <i class="bx bxs-bank"></i>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- wizard-nav -->

                                    <div id="bar" class="progress mt-4">
                                        <div class="progress-bar bg-success
                                    progress-bar-striped progress-bar-animated"></div>
                                    </div>
                                    <div class="tab-content
                                twitter-bs-wizard-tab-content">
                                        <div class="tab-pane" id="progress-seller-details">
                                            <div class="text-center mb-4">
                                                <h5>Datos del query</h5>
                                                <p class="card-title-desc">

                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="progresspill-firstname-input">Nombre
                                                        </label>
                                                        <input type="text" required class="form-control" name="nombre" value="<?php echo  $nombre;?>" id="progresspill-firstname-input">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="progresspill-lastname-input">descripcion
                                                        </label>
                                                        <input type="text" class="form-control" name="descripcion" id="progresspill-lastname-input" value="<?php echo $descripcion;?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="progresspill-phoneno-input">base</label>
                                                        <select class="form-select" aria-label="Default select example" name="base">
                                                            <?php foreach ($bases as $value) { ?>
                                                                <option <?php if($base==$value->id){echo "selected";}?>  value='<?php echo $value->id; ?>'><?php echo $value->nombre; ?></option>
                                                            <?php  } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="progresspill-email-input">Dsshboard</label>
                                                        <select class="form-control" name="dashboard">
                                                            <option <?php if($dashboard==0){echo "selected";}?> value="0">NO</option>
                                                            <option <?php if($dashboard==1){echo "selected";}?> value="1">SI</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-3">
                                                        <label for="progresspill-address-input">QUERY</label>
                                    
                                                        <textarea class="form-control" rows="10" required  name="query2" ><?php echo $query;?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="pager wizard
                                        twitter-bs-wizard-pager-link">
                                                <li class="next"><a href="javascript:
                                                void(0);" class="btn
                                                btn-primary" onclick="nextTab()">Next <i class="bx bx-chevron-right
                                                    ms-1"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" id="progress-company-document">
                                            <div>
                                                <div class="text-center mb-4">
                                                    <h5>ABM</h5>
                                                    <p class="card-title-desc">
                                                    </p>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-2">
                                                            <label for="progresspill-pancard-input" class="form-label">ALTA
                                                            </label>
                                                            <select class="form-control" name="crear">
                                                                <option <?php if($crear==0){echo "selected";}?> value="0">NO</option>
                                                                <option <?php if($crear==1){echo "selected";}?> value="1">SI</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="mb-2">
                                                            <label for="progresspill-vatno-input" class="form-label">Modificar</label>
                                                            <select class="form-control" name="modificar">
                                                                <option <?php if($modificar==0){echo "selected";}?> value="0">NO</option>
                                                                <option  <?php if($modificar==1){echo "selected";}?> value="1">SI</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="progresspill-cstno-input" class="form-label">eliminar
                                                            </label>
                                                            <select class="form-control" name="eliminar">
                                                                <option <?php if($eliminar==0){echo "selected";}?> value="0">NO</option>
                                                                <option <?php if($eliminar==1){echo "selected";}?> value="1">SI</option>
                                                            </select>

                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="progresspill-servicetax-input" class="form-label">Tabla</label>
                                                            <input type="text" name="tabla" value="<?php echo $tabla;?>" class="form-control" id="progresspill-servicetax-input">
                                                        </div>
                                                    </div>
                                                </div>

                                                <ul class="pager wizard
                                            twitter-bs-wizard-pager-link">
                                                    <li class="previous"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()"><i class="bx
                                                        bx-chevron-left me-1"></i>
                                                            Previous</a></li>
                                                    <li class="next"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()">Next <i class="bx
                                                        bx-chevron-right ms-1"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="progress-bank-detail">
                                            <div>
                                                <div class="text-center mb-4">
                                                    <h5>Parametros</h5>
                                                    <p class="card-title-desc"></p>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="progresspill-namecard-input" class="form-label">parametro</label>
                                                            <input type="text"  class="form-control" id="parametro">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Tipo</label>

                                                            <select class="form-select" aria-label="Default select example"  id="tipo">
                                                                <?php foreach ($tipoparametro as $value) { ?>
                                                                    <option value='<?php echo $value->id; ?>'><?php echo $value->nombre; ?></option>
                                                                <?php  } ?>
                                                            </select>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="row">
                                                <div class="mb-12">
                                                    <input type="hidden" id="parametrostodos" name="parametrostodos" value="">
                                                            <button type="button" onClick="agregar()" class="btn btn-primary mb-2 form-control">Agregar</button>

                                                        </div>
                                                
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="mb-12" id="campos" name="campos">
                                                            <table class="table "  >
                                                                <thead class="table-dark">
                                                                    <tr>
                                                                        <td>nombre</td>
                                                                        <td>tipo</td>
                                                                    </tr>

                                                                </thead>

                                                                <tbody id="items">

                                                                </tbody>


                                                            </table>
                                                        </div>
                                                    </div>


                                                </div>

                                                <ul class="pager wizard
                                            twitter-bs-wizard-pager-link">
                                                    <li class="previous"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()"><i class="bx
                                                        bx-chevron-left me-1"></i>
                                                            Previous</a></li>
                                                    <li class="float-end">
                                                        <button type="submit" class="btn btn-primary form-control">Actualizar</button>

                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>

        </div>
    </div>
</div>
</form>
<script>
    let map = new Map();

    window.onload = function() {
        let parametros = [];
        let map = new Map();

    }

    function agregar() {

        let vari = document.getElementById("parametro").value;
        let tipo = document.getElementById("tipo").value;
        map.set(vari, tipo);
        console.log(map);
        renderItems();
    }

    function renderItems() {
        let $items = document.querySelector('#items');
        $items.innerHTML = "";
        document.getElementById("parametrostodos").value = "";
let valor="";
        for (let info of map) {
            // Estructura
            valor=valor+"|"+info[0]+","+info[1];
            var hilera = document.createElement("tr");
            var celda = document.createElement("td");
            var celda2 = document.createElement("td");

            var textoCelda = document.createTextNode(info[0]);
            celda.appendChild(textoCelda);
            var textoCelda2 = document.createTextNode(info[1]);
            celda2.appendChild(textoCelda2);
            hilera.appendChild(celda)
            hilera.appendChild(celda2)

            items.appendChild(hilera);

                            
        }
        document.getElementById("parametrostodos").value = valor;

    }
</script>
<br><br><br>
@include('facu.footer')
<script src="assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="assets/libs/twitter-bootstrap-wizard/prettify.js"></script>

<!-- form wizard init -->
<script src="assets/js/pages/form-wizard.init.js"></script>

<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>


<script>
        CKEDITOR.replace( 'query3' );
</script>