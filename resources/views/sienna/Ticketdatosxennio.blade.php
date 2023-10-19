<?php

if (isset($_SERVER['HTTP_HOST'])) {
    $domainParts = explode('.', $_SERVER['HTTP_HOST']);
    $subdomain_tmp =  array_shift($domainParts);
} elseif(isset($_SERVER['SERVER_NAME'])){
    $domainParts = explode('.', $_SERVER['SERVER_NAME']);
    $subdomain_tmp =  array_shift($domainParts);
    
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
    <link rel="shortcut icon" href="https://<?php echo $subdomain_tmp;?>.pagoralia.com/assets3/images/favicon.ico">

    <!-- Theme Config Js -->
    <script src="https://<?php echo $subdomain_tmp;?>.pagoralia.com/assets3/js/hyper-config.js"></script>
 
    <!-- App css -->
    <link href="https://<?php echo $subdomain_tmp;?>.pagoralia.com/assets3/css/app-saas.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="https://<?php echo $subdomain_tmp;?>.pagoralia.com/assets3/css/icons.min.css" rel="stylesheet" type="text/css" />


   <!-- Datatables css -->
   <link href="assets3/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="assets3/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="assets3/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="assets3/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="assets3/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="assets3/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css" rel="stylesheet" type="text/css" />

        <!-- Theme Config Js -->
        <script src="assets3/js/hyper-config.js"></script>

        <!-- Icons css -->
        <link href="assets3/css/icons.min.css" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <link href="assets3/css/app-creative.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <script type="text/javascript">
        window.onload = function() {
            newPageTitle = "<?php $empresaTitle="hola";echo $empresaTitle; ?>";
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




<style>
        #principal {
            margin: auto !important;
            width: 100% !important;
            /*padding: 12px !important;*/
            margin-top: 50px !important;

        }
       
    </style>


</head>
<body>
<br>
<?php  foreach($ticket as $valor){?>

<div class="col-xxl-3 col-xl-6 order-xl-1 order-xxl-2" style="max-height: 900px;min-height: 900px;">

            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                        <h2 class="accordion-header bg-primary text-white" id="flush-headingOne" >
                            <button  class="accordion-button collapsed text-white bg-primary" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                               <span align="center" style="font-family: 'Nunito', sans-serif; font-weight: bold; font-size: 18px;"> TICKET #{{ $valor->id }} </span>
                         </button>
                        </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse text-white bg-white" aria-labelledby="flush-headingOne"
                        data-bs-parent="#accordionFlushExample">
                        <div class="card-body py-0 mb-3" data-simplebar="init" style="max-height: 403px;">
                            <div class="simplebar-wrapper" style="margin: 2px -24px;">
                                <div class="simplebar-height-auto-observer-wrapper">
                                    <div class="simplebar-height-auto-observer"></div>
                                </div>
                               

                                <style>
                                    .btn-container {
                                        margin-top: 2px;
                                    }

                                    .btn-container .col {
                                        margin-bottom: 2px;
                                    }
                                    .mar{
                                        margin-bottom: 2px;

                                    }
                                    .pad{
                                        padding: 20px;

                                    }
                                </style>

                            <div class="container">
                                <div class="row">
                                    <div class="col">Topic: 
                                        <button type="button" class="btn btn-info btn-block w-100" data-bs-toggle="modal" data-bs-target="#standard-modal3">
                                            <?php if($valor->siennatopic==null){
                                                echo "sin topic";
                                            } else {
                                                echo $valor->siennatopic;
                                            }?>
                                        </button>
                                    </div>
                                </div>

                                <div class="row btn-container">
                                    <div class="col" style="margin-right: 1px;">
                                        <button type="button" style="color: EEF2F7;text-color:313A46" class="btn btn-secondary   w-100 btn-block" data-bs-toggle="modal" data-bs-target="#standard-modal2">
                                            <?php if($valor->siennadepto==null){
                                                echo "sin depto";
                                            } else {
                                                echo $valor->siennadepto;
                                            }?>
                                        </button>
                                    </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-secondary w-100 btn-block" data-bs-toggle="modal" data-bs-target="#standard-modal4">
                                          
                                        </button>
                                    </div>
                                </div>

                                <div class="row btn-container">
                                    <div class="col">
                                        <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#standard-modal">
                                            <span id="estado">
                                                <?php if($valor->siennaestado==null){
                                                    echo "sin status";
                                                } else {
                                                    echo $valor->siennaestado;
                                                }?>
                                            </span>
                                        </button>
                                    </div>
                                </div>

                                <?php 
                                $merchant=substr($merchant,0,-3);
                                if($merchant=="fastnet"){
                                    $merchant="elevate";
                                }
                                
                                
                                ?>
                                <a class="btn btn-primary" target="_blank" href="https://<?php echo $merchant;?>.clientdeck.com.ar/scp/tickets.php?id=<?php echo $valor->id;?>" role="button">Link</a>
                                
</div>
                                               
                                                <!-- end timeline -->
                                    
                                <div class="simplebar-placeholder" style="width: auto; height: 579px;"></div>
                            </div>
                            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                            </div>
                            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                <div class="simplebar-scrollbar"
                                    style="height: 280px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header  bg-primary text-white" id="flush-headingTwo">
                        <button class="accordion-button collapsed text-white bg-primary" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            <?php //echo $valor->nombredelusuario;?>
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body bg-white">

                       
                                <div class="" style="display:inline-block;">
                                    <?php $vueltas=0;
                                    foreach($datosticketsviejos as $vv){
                                        if($vueltas<>0){
                                        
                                        ?>

                                        <a class="btn btn-secondary w-100 btn-block mar" target="_blank" href="https://<?php echo $merchant;?>.clientdeck.com.ar/scp/tickets.php?id=<?php echo $vv->ticket_id;?>" role="button">#<?php echo $vv->number;?> - <?php echo $vv->topic;?></a>
                                <?php }
                                $vueltas++;
                                }?>
                                </div>


                            

                         
                        </div>
                    </div>
                </div>

            </div>
          
            <div class="card">





            </div> <!-- end card -->
</div>


    <div id="standard-modal3" class="modal fade bs-example-modal-center3 " tabindex="-1" role="dialog" aria-hidden="true">      
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Cambiar Topics</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/api/cambiartopic" method="post">
                        <input type="hidden" name="_token" v-bind:value="csrf">
                        <input  type="hidden" name="idtickettopic" id="idtickettopic" value=" <?php echo $valor->id;?> ">
                        <input  type="hidden" name="merchant" id="merchant" value=" <?php echo $merchant;?> ">

                        <div v-for="topic in topics ">

                        <?php foreach($topics as $dep){?>
                            <input value="<?php echo $dep->id;?>" class="form-radio" type="radio" name="statos">&nbsp;
                        <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;"><?php echo$dep->nombre;?></span>
                            <br><br>

                            <?php }?> 
                        </div>



                        <button type="submit" class="btn btn-success
                                    waves-effect waves-light">Cambiar</button>

                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>


    <div id="standard-modal" class="modal fade bs-example-modal-center " tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Cambiar status</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/api/cambiarstatus" method="post">
                        <input type="hidden" name="_token" v-bind:value="csrf">
                        <input value=" <?php echo $valor->id;?> " type="hidden" name="idticketestado" id="idtickettopic">
                        <input  type="hidden" name="merchant" id="merchant" value=" <?php echo $merchant;?> ">

                        <div v-for="ost_ticket_statu in ost_ticket_status ">

                        <?php foreach($ost_ticket_status as $dep){?>
                            <input value="<?php echo $dep->id;?>" class="form-radio" type="radio" name="statos">&nbsp;
                        <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;"><?php echo$dep->nombre;?></span>
                            <br><br>

                            <?php }?> 
                            <br><br>
                        </div>
                        <button type="submit" class="btn btn-success
                                    waves-effect waves-light">Cambiar</button>

                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div id="standard-modal2" class="modal fade bs-example-modal-center " tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Cambiar Depto</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/api/cambiardepto" method="post">
                        <input type="hidden" name="_token" v-bind:value="csrf">
                        <input value=" <?php echo $valor->id;?> "  type="hidden" name="idticketdepto" id="idtickettopic">
                        <input  type="hidden" name="merchant" id="merchant" value=" <?php echo $merchant;?> ">

                        <div v-for="department in departments ">
                        <?php foreach($deptos as $dep){?>
                            <input value="<?php echo $dep->id;?>" class="form-radio" type="radio" name="statos">&nbsp;
                        <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;"><?php echo$dep->nombre;?></span>
                            <br><br>

                            <?php }?>   
                                             </div>
                        <button type="submit" class="btn btn-success
                                    waves-effect waves-light">Cambiar</button>

                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div id="standard-modal4" class="modal fade bs-example-modal-center " tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Asignar</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/api/cambiarasignacion" method="post">
                        <input type="hidden" name="_token" v-bind:value="csrf">
                        <input value=" <?php echo $valor->id;?> "  type="hidden" name="idticketasignar" id="idtickettopic">
                        <input  type="hidden" name="merchant" id="merchant" value=" <?php echo $merchant;?> ">

                        <div >

                        <?php foreach($staff as $dep){?>
                            <input value="<?php echo $dep->id;?>" class="form-radio" type="radio" name="statos">&nbsp;
                        <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;"><?php echo$dep->name;?></span>
                            <br><br>

                            <?php }?> 
                            <br><br>
                        </div>
                        <button type="submit" class="btn btn-success
                                    waves-effect waves-light">Cambiar</button>

                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

<?php }?>
        @include('creative2.footer2')
