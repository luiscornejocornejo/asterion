<?php

if (isset($_SERVER['HTTP_HOST'])) {
    $domainParts = explode('.', $_SERVER['HTTP_HOST']);
    $subdomain_tmp =  array_shift($domainParts);
} elseif(isset($_SERVER['SERVER_NAME'])){
    $domainParts = explode('.', $_SERVER['SERVER_NAME']);
    $subdomain_tmp =  array_shift($domainParts);
    
}

echo $subdomain_tmp =str_replace("/api","", $subdomain_tmp );
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
   <link href="https://<?php echo $subdomain_tmp;?>.suricata.cloud/assets3/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="https://<?php echo $subdomain_tmp;?>.suricata.cloud/assets3/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="https://<?php echo $subdomain_tmp;?>.suricata.cloud/assets3/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="https://<?php echo $subdomain_tmp;?>.suricata.cloud/assets3/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="https://<?php echo $subdomain_tmp;?>.suricata.cloud/assets3/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="https://<?php echo $subdomain_tmp;?>.suricata.cloud/assets3/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css" rel="stylesheet" type="text/css" />

        <!-- Theme Config Js -->
        <script src="https://<?php echo $subdomain_tmp;?>.suricata.cloud/assets3/js/hyper-config.js"></script>

        <!-- Icons css -->
        <link href="https://<?php echo $subdomain_tmp;?>.suricata.cloud/assets3/css/icons.min.css" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <link href="https://<?php echo $subdomain_tmp;?>.suricata.cloud/assets3/css/app-creative.min.css" rel="stylesheet" type="text/css" id="app-style" />

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


    <div class="card widget-flat">
        <div class="card-body">
          <div class="float-end">
            <i class="mdi mdi-ticket-account widget-icon bg-warning-lighten text-warning"></i>
          </div>
          <h5 class="fw-normal mt-0" title="Number of Customers">Ticket #{{ $valor->ticketid }}</h5>
          <div class="d-flex  mt-4">
            <i class="ri-question-answer-line "></i>&nbsp;Tema de ayuda:&nbsp;
            <span class="badge badge-secondary-lighten hover-overlay line-h"  data-bs-toggle="modal" data-bs-target="#standard-modal2">
            <?php if($valor->siennatopic==null){
                                                echo "sin topic";
                                            } else {
                                                echo $valor->siennatopicnombre;
                                            }?>
            </span>
          </div>
          <div class="d-flex mt-2">
            <i class="ri-building-4-line"></i>&nbsp;Departamento:&nbsp;
            <span class="badge badge-secondary-lighten line-h">
              Facturación/Pago
            </span>
          </div>
          <div class="d-flex mt-2">
              <i class="ri-customer-service-2-line"></i>&nbsp;Operador:&nbsp;
              <span class="badge badge-secondary-lighten line-h">
                Macarena
              </span>
            </div>
            <div class="d-flex mt-2">
              <i class="ri-ticket-line"></i>&nbsp;Estado de ticket:&nbsp;
              <span class="badge badge-success-lighten line-h">
                Abierto
              </span>
              <span class="badge badge-warning-lighten line-h ms-1">
                Cerrado
              </span>
            </div>
          </div> 
        </div> <!-- end card-body-->

        <div class="card widget-flat">
          <div class="card-body">
            <div class="float-end">
              <i class="mdi mdi-card-account-details widget-icon bg-secondary-lighten text-secondary"></i>
            </div>
            <h5 class="fw-normal mt-0" title="Number of Customers">Información de usuario</h5>
            <div class="d-flex mt-4">
              <i class="mdi mdi-identifier"></i>&nbsp;Numero cliente:&nbsp;
              <span class="badge badge-secondary-lighten line-h">
                011223
              </span>
            </div>
            <div class="d-flex  mt-2">
              <i class="mdi mdi-account"></i>&nbsp;Nombre:&nbsp;
              <span class="badge badge-secondary-lighten hover-overlay line-h">
                Pepito
              </span>
            </div>
            <div class="d-flex mt-2">
              <i class="mdi mdi-home"></i>&nbsp;Domicilio:&nbsp;
              <span class="badge badge-secondary-lighten line-h">
                Calle Falsa 123
              </span>
            </div>
            <div class="d-flex mt-2">
                <i class="mdi mdi-whatsapp text"></i>&nbsp;Whatsapp:&nbsp;
                <span class="badge badge-secondary-lighten line-h">
                  5491122334455
                </span>
              </div>
              <div class="d-flex mt-2">
                <i class="mdi mdi-email"></i>&nbsp;Email:&nbsp;
                <span class="badge badge-secondary-lighten line-h">
                  pepito@gmail.com
                </span>
              </div>
              <div class="d-flex mt-2">
                <i class="mdi mdi-account-cash"></i>&nbsp;Estado de cuenta:&nbsp;
                <span class="badge badge-success-lighten line-h">
                  Normal
                </span>
                <span class="badge badge-warning-lighten line-h ms-1">
                  Suspendido
                </span>
              </div>
              <div class="d-flex mt-2">
                <i class="mdi mdi-antenna"></i>&nbsp;Estado de servicio:&nbsp;
                <span class="badge badge-success-lighten line-h">
                  Normal
                </span>
                <span class="badge badge-danger-lighten line-h ms-1">
                  Masivo
                </span>
              </div>
            </div>
            
      </div>
      <div class="card widget-flat">
        <div class="card-body">
          <div class="float-end">
            <i class="mdi mdi-whatsapp widget-icon bg-success-lighten text-success"></i>
          </div>
          <h5 class="fw-normal mt-0" title="Number of Customers">Ultimo template enviado</h5>
          <div class="d-flex  mt-4">
            <i class="mdi mdi-information"></i>&nbsp;Nombre:&nbsp;
            <span class="badge badge-secondary-lighten hover-overlay line-h">
              Consulta
            </span>
          </div>
          <div class="d-flex mt-2">
            <i class="mdi mdi-message-text"></i>&nbsp;Contenido:&nbsp;
            <span class="badge badge-secondary-lighten line-h">
              Texto template
            </span>
          </div>
          <div class="d-flex mt-2">
              <i class="mdi mdi-calendar-today"></i>&nbsp;Fecha:&nbsp;
              <span class="badge badge-secondary-lighten line-h">
                19/10/23 16:00:23
              </span>
          </div> 
          <div class="d-flex mt-2">
            <i class="mdi mdi-history"></i>&nbsp;Historial:&nbsp;
            <span class="badge badge-secondary-lighten line-h">
              <i class="mdi mdi-login-variant"></i>
            </span>
        </div> 
        </div>
    </div>



<div class="col-xxl-3 col-xl-6 order-xl-1 order-xxl-2" style="max-height: 900px;min-height: 900px;">

            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                        <h2 class="accordion-header bg-primary text-white" id="flush-headingOne" >
                            <button  class="accordion-button collapsed text-white bg-primary" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                               <span align="center" style="font-family: 'Nunito', sans-serif; font-weight: bold; font-size: 18px;"> TICKET #{{ $valor->ticketid }} </span>
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
                                                echo $valor->siennatopicnombre;
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
                                                echo $valor->nombredepto;
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
                                                    echo $valor->nombreestado;
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
                            <?php echo $valor->nya;?>
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

<div class="offcanvas offcanvas-end border-0" tabindex="-1" id="theme-settings-offcanvas">
            <div class="d-flex align-items-center bg-primary p-3 offcanvas-header">
                <h5 class="text-white m-0">Theme Settings</h5>
                <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body p-0">
                <div data-simplebar class="h-100">
                    <div class="card mb-0 p-3">
                        <h5 class="mt-0 font-16 fw-bold mb-3">Choose Layout</h5>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-check card-radio">
                                    <input id="customizer-layout01" name="data-layout" type="radio" value="vertical" class="form-check-input">
                                    <label class="form-check-label p-0 avatar-md w-100" for="customizer-layout01">
                                        <span class="d-flex h-100">
                                            <span class="flex-shrink-0">
                                                <span class="bg-light d-flex h-100 border-end flex-column p-1 px-2">
                                                    <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                    <span class="d-block border border-3 w-100 mb-1"></span>
                                                    <span class="d-block border border-3 w-100 mb-1"></span>
                                                    <span class="d-block border border-3 w-100 mb-1"></span>
                                                    <span class="d-block border border-3 w-100 mb-1"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">Vertical</h5>
                            </div>
                            <div class="col-4">
                                <div class="form-check card-radio">
                                    <input id="customizer-layout02" name="data-layout" type="radio" value="horizontal" class="form-check-input">
                                    <label class="form-check-label p-0 avatar-md w-100" for="customizer-layout02">
                                        <span class="d-flex h-100 flex-column">
                                            <span class="bg-light d-flex p-1 align-items-center border-bottom">
                                                <span class="d-block p-1 bg-dark-lighten rounded me-1"></span>
                                                <span class="d-block border border-3 ms-auto"></span>
                                                <span class="d-block border border-3 ms-1"></span>
                                                <span class="d-block border border-3 ms-1"></span>
                                                <span class="d-block border border-3 ms-1"></span>
                                            </span>
                                            <span class="bg-light d-block p-1"></span>
                                        </span>
                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">Horizontal</h5>
                            </div>
                        </div>

                        <h5 class="my-3 font-16 fw-bold">Color Scheme</h5>

                        <div class="colorscheme-cardradio">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-check card-radio">
                                        <input class="form-check-input" type="radio" name="data-theme" id="layout-color-light"
                                            value="light">
                                        <label class="form-check-label p-0 avatar-md w-100" for="layout-color-light">
                                            <span class="d-flex h-100">
                                                <span class="flex-shrink-0">
                                                    <span class="bg-light d-flex h-100 border-end flex-column p-1 px-2">
                                                        <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                        <span class="d-block border border-3 w-100 mb-1"></span>
                                                        <span class="d-block border border-3 w-100 mb-1"></span>
                                                        <span class="d-block border border-3 w-100 mb-1"></span>
                                                        <span class="d-block border border-3 w-100 mb-1"></span>
                                                    </span>
                                                </span>
                                                <span class="flex-grow-1">
                                                    <span class="d-flex h-100 flex-column bg-white">
                                                        <span class="bg-light d-block p-1"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                    <h5 class="font-14 text-center text-muted mt-2">Light</h5>
                                </div>

                                <div class="col-4">
                                    <div class="form-check card-radio">
                                        <input class="form-check-input" type="radio" name="data-theme" id="layout-color-dark"
                                            value="dark">
                                        <label class="form-check-label p-0 avatar-md w-100 bg-black" for="layout-color-dark">
                                            <span class="d-flex h-100">
                                                <span class="flex-shrink-0">
                                                    <span class="bg-light-lighten d-flex h-100 flex-column p-1 px-2">
                                                        <span class="d-block p-1 bg-light-lighten rounded mb-1"></span>
                                                        <span class="d-block border opacity-25 border-3 w-100 mb-1"></span>
                                                        <span class="d-block border opacity-25 border-3 w-100 mb-1"></span>
                                                        <span class="d-block border opacity-25 border-3 w-100 mb-1"></span>
                                                        <span class="d-block border opacity-25 border-3 w-100 mb-1"></span>
                                                    </span>
                                                </span>
                                                <span class="flex-grow-1">
                                                    <span class="d-flex h-100 flex-column">
                                                        <span class="bg-light-lighten d-block p-1"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                    <h5 class="font-14 text-center text-muted mt-2">Dark</h5>
                                </div>
                            </div>
                        </div>

                        <div id="layout-width">
                            <h5 class="my-3 font-16 fw-bold">Layout Mode</h5>

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-check card-radio">
                                        <input class="form-check-input" type="radio" name="data-layout-mode"
                                            id="layout-mode-fluid" value="fluid">
                                        <label class="form-check-label p-0 avatar-md w-100" for="layout-mode-fluid">
                                            <span class="d-flex h-100">
                                                <span class="flex-shrink-0">
                                                    <span class="bg-light d-flex h-100 border-end  flex-column p-1 px-2">
                                                        <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                        <span class="d-block border border-3 w-100 mb-1"></span>
                                                        <span class="d-block border border-3 w-100 mb-1"></span>
                                                        <span class="d-block border border-3 w-100 mb-1"></span>
                                                        <span class="d-block border border-3 w-100 mb-1"></span>
                                                    </span>
                                                </span>
                                                <span class="flex-grow-1">
                                                    <span class="d-flex h-100 flex-column">
                                                        <span class="bg-light d-block p-1"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                    <h5 class="font-14 text-center text-muted mt-2">Fluid</h5>
                                </div>
                                <div class="col-4" id="layout-boxed">
                                    <div class="form-check card-radio">
                                        <input class="form-check-input" type="radio" name="data-layout-mode"
                                            id="layout-mode-boxed" value="boxed">
                                        <label class="form-check-label p-0 avatar-md w-100 px-2" for="layout-mode-boxed">
                                            <span class="d-flex h-100 border-start border-end">
                                                <span class="flex-shrink-0">
                                                    <span class="bg-light d-flex h-100 border-end flex-column p-1">
                                                        <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                        <span class="d-block border border-3 w-100 mb-1"></span>
                                                        <span class="d-block border border-3 w-100 mb-1"></span>
                                                        <span class="d-block border border-3 w-100 mb-1"></span>
                                                        <span class="d-block border border-3 w-100 mb-1"></span>
                                                    </span>
                                                </span>
                                                <span class="flex-grow-1">
                                                    <span class="d-flex h-100 flex-column">
                                                        <span class="bg-light d-block p-1"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                    <h5 class="font-14 text-center text-muted mt-2">Boxed</h5>
                                </div>

                                <div class="col-4" id="layout-detached">
                                    <div class="form-check sidebar-setting card-radio">
                                        <input class="form-check-input" type="radio" name="data-layout-mode"
                                            id="data-layout-detached" value="detached">
                                        <label class="form-check-label p-0 avatar-md w-100" for="data-layout-detached">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-flex p-1 align-items-center border-bottom">
                                                    <span class="d-block p-1 bg-dark-lighten rounded me-1"></span>
                                                    <span class="d-block border border-3 ms-auto"></span>
                                                    <span class="d-block border border-3 ms-1"></span>
                                                    <span class="d-block border border-3 ms-1"></span>
                                                    <span class="d-block border border-3 ms-1"></span>
                                                </span>
                                                <span class="d-flex h-100 p-1 px-2">
                                                    <span class="flex-shrink-0">
                                                        <span class="bg-light d-flex h-100 flex-column p-1 px-2">
                                                            <span class="d-block border border-3 w-100 mb-1"></span>
                                                            <span class="d-block border border-3 w-100 mb-1"></span>
                                                            <span class="d-block border border-3 w-100"></span>
                                                        </span>
                                                    </span>
                                                </span>
                                                <span class="bg-light d-block p-1 mt-auto px-2"></span>
                                            </span>

                                        </label>
                                    </div>
                                    <h5 class="font-14 text-center text-muted mt-2">Detached</h5>
                                </div>
                            </div>
                        </div>

                        <h5 class="my-3 font-16 fw-bold">Topbar Color</h5>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-check card-radio">
                                    <input class="form-check-input" type="radio" name="data-topbar-color"
                                        id="topbar-color-light" value="light">
                                    <label class="form-check-label p-0 avatar-md w-100" for="topbar-color-light">
                                        <span class="d-flex h-100">
                                            <span class="flex-shrink-0">
                                                <span class="bg-light d-flex h-100 border-end  flex-column p-1 px-2">
                                                    <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                    <span class="d-block border border-3 w-100 mb-1"></span>
                                                    <span class="d-block border border-3 w-100 mb-1"></span>
                                                    <span class="d-block border border-3 w-100 mb-1"></span>
                                                    <span class="d-block border border-3 w-100 mb-1"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">Light</h5>
                            </div>
                            <div class="col-4">
                                <div class="form-check card-radio">
                                    <input class="form-check-input" type="radio" name="data-topbar-color" id="topbar-color-dark"
                                        value="dark">
                                    <label class="form-check-label p-0 avatar-md w-100" for="topbar-color-dark">
                                        <span class="d-flex h-100">
                                            <span class="flex-shrink-0">
                                                <span class="bg-light d-flex h-100 border-end  flex-column p-1 px-2">
                                                    <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                    <span class="d-block border border-3 w-100 mb-1"></span>
                                                    <span class="d-block border border-3 w-100 mb-1"></span>
                                                    <span class="d-block border border-3 w-100 mb-1"></span>
                                                    <span class="d-block border border-3 w-100 mb-1"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-dark d-block p-1"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">Dark</h5>
                            </div>
                        </div>

                        <div id="sidebar-color">
                            <h5 class="my-3 font-16 fw-bold">Sidebar Color</h5>

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-check sidebar-setting card-radio">
                                        <input class="form-check-input" type="radio" name="data-sidenav-color"
                                            id="leftbar-color-light" value="light">
                                        <label class="form-check-label p-0 avatar-md w-100" for="leftbar-color-light">
                                            <span class="d-flex h-100">
                                                <span class="flex-shrink-0">
                                                    <span class="bg-light d-flex h-100 border-end  flex-column p-1 px-2">
                                                        <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                        <span class="d-block border border-3 w-100 mb-1"></span>
                                                        <span class="d-block border border-3 w-100 mb-1"></span>
                                                        <span class="d-block border border-3 w-100 mb-1"></span>
                                                        <span class="d-block border border-3 w-100 mb-1"></span>
                                                    </span>
                                                </span>
                                                <span class="flex-grow-1">
                                                    <span class="d-flex h-100 flex-column">
                                                        <span class="bg-light d-block p-1"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                    <h5 class="font-14 text-center text-muted mt-2">Light</h5>
                                </div>
                                <div class="col-4">
                                    <div class="form-check sidebar-setting card-radio">
                                        <input class="form-check-input" type="radio" name="data-sidenav-color"
                                            id="leftbar-color-dark" value="dark">
                                        <label class="form-check-label p-0 avatar-md w-100" for="leftbar-color-dark">
                                            <span class="d-flex h-100">
                                                <span class="flex-shrink-0">
                                                    <span class="bg-dark d-flex h-100 flex-column p-1 px-2">
                                                        <span class="d-block p-1 bg-light-lighten rounded mb-1"></span>
                                                        <span class="d-block border opacity-25 border-3 w-100 mb-1"></span>
                                                        <span class="d-block border opacity-25 border-3 w-100 mb-1"></span>
                                                        <span class="d-block border opacity-25 border-3 w-100 mb-1"></span>
                                                        <span class="d-block border opacity-25 border-3 w-100 mb-1"></span>
                                                    </span>
                                                </span>
                                                <span class="flex-grow-1">
                                                    <span class="d-flex h-100 flex-column">
                                                        <span class="bg-light d-block p-1"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                    <h5 class="font-14 text-center text-muted mt-2">Dark</h5>
                                </div>
                                <div class="col-4">
                                    <div class="form-check sidebar-setting card-radio">
                                        <input class="form-check-input" type="radio" name="data-sidenav-color"
                                            id="leftbar-color-default" value="default">
                                        <label class="form-check-label p-0 avatar-md w-100" for="leftbar-color-default">
                                            <span class="d-flex h-100">
                                                <span class="flex-shrink-0">
                                                    <span class="bg-primary bg-gradient d-flex h-100 flex-column p-1 px-2">
                                                        <span class="d-block p-1 bg-light-lighten rounded mb-1"></span>
                                                        <span class="d-block border opacity-25 border-3 w-100 mb-1"></span>
                                                        <span class="d-block border opacity-25 border-3 w-100 mb-1"></span>
                                                        <span class="d-block border opacity-25 border-3 w-100 mb-1"></span>
                                                        <span class="d-block border opacity-25 border-3 w-100 mb-1"></span>
                                                    </span>
                                                </span>
                                                <span class="flex-grow-1">
                                                    <span class="d-flex h-100 flex-column">
                                                        <span class="bg-light d-block p-1"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                    <h5 class="font-14 text-center text-muted mt-2">Brand</h5>
                                </div>
                            </div>
                        </div>

                        <div id="sidebar-size">
                            <h5 class="my-3 font-16 fw-bold">Sidebar Size</h5>

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-check sidebar-setting card-radio">
                                        <input class="form-check-input" type="radio" name="data-sidenav-size"
                                            id="leftbar-size-default" value="default">
                                        <label class="form-check-label p-0 avatar-md w-100" for="leftbar-size-default">
                                            <span class="d-flex h-100">
                                                <span class="flex-shrink-0">
                                                    <span class="bg-light d-flex h-100 border-end  flex-column p-1 px-2">
                                                        <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                        <span class="d-block border border-3 w-100 mb-1"></span>
                                                        <span class="d-block border border-3 w-100 mb-1"></span>
                                                        <span class="d-block border border-3 w-100 mb-1"></span>
                                                        <span class="d-block border border-3 w-100 mb-1"></span>
                                                    </span>
                                                </span>
                                                <span class="flex-grow-1">
                                                    <span class="d-flex h-100 flex-column">
                                                        <span class="bg-light d-block p-1"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                    <h5 class="font-14 text-center text-muted mt-2">Default</h5>
                                </div>

                                <div class="col-4">
                                    <div class="form-check sidebar-setting card-radio">
                                        <input class="form-check-input" type="radio" name="data-sidenav-size"
                                            id="leftbar-size-compact" value="compact">
                                        <label class="form-check-label p-0 avatar-md w-100" for="leftbar-size-compact">
                                            <span class="d-flex h-100">
                                                <span class="flex-shrink-0">
                                                    <span class="bg-light d-flex h-100 border-end  flex-column p-1">
                                                        <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                        <span class="d-block border border-3 w-100 mb-1"></span>
                                                        <span class="d-block border border-3 w-100 mb-1"></span>
                                                        <span class="d-block border border-3 w-100 mb-1"></span>
                                                        <span class="d-block border border-3 w-100 mb-1"></span>
                                                    </span>
                                                </span>
                                                <span class="flex-grow-1">
                                                    <span class="d-flex h-100 flex-column">
                                                        <span class="bg-light d-block p-1"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                    <h5 class="font-14 text-center text-muted mt-2">Compact</h5>
                                </div>

                                <div class="col-4">
                                    <div class="form-check sidebar-setting card-radio">
                                        <input class="form-check-input" type="radio" name="data-sidenav-size"
                                            id="leftbar-size-small" value="condensed">
                                        <label class="form-check-label p-0 avatar-md w-100" for="leftbar-size-small">
                                            <span class="d-flex h-100">
                                                <span class="flex-shrink-0">
                                                    <span class="bg-light d-flex h-100 border-end  flex-column">
                                                        <span class="d-block p-1 bg-dark-lighten mb-1"></span>
                                                        <span class="d-block border border-3 w-100 mb-1"></span>
                                                        <span class="d-block border border-3 w-100 mb-1"></span>
                                                        <span class="d-block border border-3 w-100 mb-1"></span>
                                                        <span class="d-block border border-3 w-100 mb-1"></span>
                                                    </span>
                                                </span>
                                                <span class="flex-grow-1">
                                                    <span class="d-flex h-100 flex-column">
                                                        <span class="bg-light d-block p-1"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                    <h5 class="font-14 text-center text-muted mt-2">Condensed</h5>
                                </div>

                                <div class="col-4">
                                    <div class="form-check sidebar-setting card-radio">
                                        <input class="form-check-input" type="radio" name="data-sidenav-size"
                                            id="leftbar-size-small-hover" value="sm-hover">
                                        <label class="form-check-label p-0 avatar-md w-100" for="leftbar-size-small-hover">
                                            <span class="d-flex h-100">
                                                <span class="flex-shrink-0">
                                                    <span class="bg-light d-flex h-100 border-end  flex-column">
                                                        <span class="d-block p-1 bg-dark-lighten mb-1"></span>
                                                        <span class="d-block border border-3 w-100 mb-1"></span>
                                                        <span class="d-block border border-3 w-100 mb-1"></span>
                                                        <span class="d-block border border-3 w-100 mb-1"></span>
                                                        <span class="d-block border border-3 w-100 mb-1"></span>
                                                    </span>
                                                </span>
                                                <span class="flex-grow-1">
                                                    <span class="d-flex h-100 flex-column">
                                                        <span class="bg-light d-block p-1"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                    <h5 class="font-14 text-center text-muted mt-2">Hover View</h5>
                                </div>

                                <div class="col-4">
                                    <div class="form-check sidebar-setting card-radio">
                                        <input class="form-check-input" type="radio" name="data-sidenav-size" id="leftbar-size-full" value="full">
                                        <label class="form-check-label p-0 avatar-md w-100" for="leftbar-size-full">
                                            <span class="d-flex h-100">
                                                <span class="flex-shrink-0">
                                                    <span class="d-flex h-100 border-end  flex-column">
                                                        <span class="d-block p-1 bg-dark-lighten mb-1"></span>
                                                    </span>
                                                </span>
                                                <span class="flex-grow-1">
                                                    <span class="d-flex h-100 flex-column">
                                                        <span class="bg-light d-block p-1"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                    <h5 class="font-14 text-center text-muted mt-2">Full Layout</h5>
                                </div>
                            </div>
                        </div>

                        <div id="layout-position">
                            <h5 class="my-3 font-16 fw-bold">Layout Position</h5>

                            <div class="btn-group radio" role="group">
                                <input type="radio" class="btn-check" name="data-layout-position" id="layout-position-fixed" value="fixed">
                                <label class="btn btn-light w-sm" for="layout-position-fixed">Fixed</label>

                                <input type="radio" class="btn-check" name="data-layout-position" id="layout-position-scrollable" value="scrollable">
                                <label class="btn btn-light w-sm ms-0" for="layout-position-scrollable">Scrollable</label>
                            </div>
                        </div>

                        <div id="sidebar-user">
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <label class="font-16 fw-bold m-0" for="sidebaruser-check">Sidebar User Info</label>
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" name="sidebar-user" id="sidebaruser-check">
                                </div>  
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="offcanvas-footer border-top p-3 text-center">
                <div class="row">
                    <div class="col-6">
                        <button type="button" class="btn btn-light w-100" id="reset-layout">Reset</button>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-primary w-100">Buy Now</button>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if (isset($_SERVER['HTTP_HOST'])) {
            $domainParts = explode('.', $_SERVER['HTTP_HOST']);
            $subdomain_tmp =  array_shift($domainParts);
        } elseif(isset($_SERVER['SERVER_NAME'])){
            $domainParts = explode('.', $_SERVER['SERVER_NAME']);
            $subdomain_tmp =  array_shift($domainParts);
            
        }?>

    

   <!-- Vendor js -->
   <script src="https://<?php echo $subdomain_tmp;?>.suricata.cloud/assets3/js/vendor.min.js"></script>

<!-- Code Highlight js -->
<script src="https://<?php echo $subdomain_tmp;?>.suricata.cloud/assets3/vendor/highlightjs/highlight.pack.min.js"></script>
<script src="https://<?php echo $subdomain_tmp;?>.suricata.cloud/assets3/js/hyper-syntax.js"></script>

<!-- Datatables js -->
<script src="https://<?php echo $subdomain_tmp;?>.suricata.cloud/assets3/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="https://<?php echo $subdomain_tmp;?>.suricata.cloud/assets3/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://<?php echo $subdomain_tmp;?>.suricata.cloud/assets3/vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="https://<?php echo $subdomain_tmp;?>.suricata.cloud/assets3/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
<script src="https://<?php echo $subdomain_tmp;?>.suricata.cloud/assets3/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js"></script>
<script src="https://<?php echo $subdomain_tmp;?>.suricata.cloud/assets3/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="https://<?php echo $subdomain_tmp;?>.suricata.cloud/assets3/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="https://<?php echo $subdomain_tmp;?>.suricata.cloud/assets3/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
<script src="https://<?php echo $subdomain_tmp;?>.suricata.cloud/assets3/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="https://<?php echo $subdomain_tmp;?>.suricata.cloud/assets3/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="https://<?php echo $subdomain_tmp;?>.suricata.cloud/assets3/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="https://<?php echo $subdomain_tmp;?>.suricata.cloud/assets3/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="https://<?php echo $subdomain_tmp;?>.suricata.cloud/assets3/vendor/datatables.net-select/js/dataTables.select.min.js"></script>

<!-- Datatable Demo Aapp js -->
<script src="https://<?php echo $subdomain_tmp;?>.suricata.cloud/assets3/js/pages/demo.datatable-init.js"></script>


<!-- App js -->
<script src="https://<?php echo $subdomain_tmp;?>.suricata.cloud/assets3/js/app.min.js"></script> 

<script src="https://<?php echo $subdomain_tmp;?>.suricata.cloud/assets3/js/pages/demo.dashboard-analytics.js"></script>
    </body>

</html>

