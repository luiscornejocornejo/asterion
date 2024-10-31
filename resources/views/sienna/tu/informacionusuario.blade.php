<div class="card widget-flat" id="infoUser">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div>
                <h4 class="fw-normal text-dark" title="Number of Customers">Información de usuario</h4>
            </div>
            <div>
                <i class="mdi mdi-card-account-details widget-icon bg-secondary-lighten text-secondary"></i>
            </div>
        </div>
        <hr style="margin-top: 10px;" />
        <div class="row">
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-sm-12">
                <?php //dd($resultadoscliente);
                                        if(isset($resultadoscliente[0]->cliente)){?>
                <div class="d-flex mt-2">
                    <i class="mdi mdi-card-account-details"></i>&nbsp;Numero cliente:&nbsp;
                    <span class="badge badge-secondary-lighten line-h">
                        <?php echo $resultadoscliente[0]->cliente; ?>
                    </span>
                </div>
                <?php
                                            }if(isset($resultadoscliente[0]->nya)){?>
                <div class="d-flex  mt-2">
                    <i class="mdi mdi-account"></i>&nbsp;Nombre:&nbsp;
                    <span class="badge badge-secondary-lighten hover-overlay line-h">
                        <?php echo $resultadoscliente[0]->nya; ?>
                    </span>
                </div>
                <?php
                                            }if(isset($resultadoscliente[0]->address)){?>
                <div class="d-flex mt-2">
                    <i class="mdi mdi-home"></i>&nbsp;Domicilio:&nbsp;
                    <style>
                        .ellipsis {
                            white-space: nowrap;
                            max-width: 300px;
                            overflow: hidden;
                            text-overflow: ellipsis;
                        }
                    </style>
                    <span class="badge badge-secondary-lighten line-h ellipsis">
                        <?php echo $resultadoscliente[0]->address; ?>
                    </span>
                </div>
                <?php
                                            }if(isset($resultadoscliente[0]->cel)){?>
                <div class="d-flex mt-2">
                    <i class="mdi mdi-whatsapp text"></i>&nbsp;Teléfono:&nbsp;
                    <span class="badge badge-secondary-lighten line-h">
                        <?php echo $resultadoscliente[0]->cel; ?>
                    </span>
                </div>
                <?php
                                            }if(isset($resultadoscliente[0]->email)){?>
                <div class="d-flex mt-2">
                    <i class="mdi mdi-email"></i>&nbsp;Email:&nbsp;
                    <span class="badge badge-secondary-lighten line-h">
                        <?php echo $resultadoscliente[0]->email; ?>
                    </span>
                </div>
                <?php }?>

            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-sm-12">
                <?php
                                            if(isset($resultadoscliente[0]->a_status)){?>
                <div class="d-flex mt-2">
                    <i class="mdi mdi-account-cash"></i>&nbsp;Estado de cuenta:&nbsp;
                    <span class="badge badge-success-lighten line-h">
                        <?php echo $resultadoscliente[0]->a_status; ?>
                    </span>

                </div>
                <?php
                                            }if(isset($resultadoscliente[0]->s_status)){?>
                <div class="d-flex mt-2">
                    <i class="mdi mdi-antenna"></i>&nbsp;Estado de servicio:&nbsp;
                    <span class="badge badge-success-lighten line-h">
                        <?php echo $resultadoscliente[0]->s_status; ?>
                    </span>

                </div>
                <?php
                                            }if(isset($resultadoscliente[0]->nodo)){?>
                <div class="d-flex mt-2">
                    <i class="mdi mdi-switch"></i>&nbsp;Nodo:&nbsp;
                    <span class="badge badge-secondary-lighten line-h">
                        <?php echo $resultadoscliente[0]->nodo; ?>
                    </span>
                </div>
                <?php
                                            }if(isset($resultadoscliente[0]->ip)){?>
                <div class="d-flex mt-2">
                    <i class="mdi mdi-map-marker"></i>&nbsp;IP:&nbsp;
                    <span class="badge badge-secondary-lighten line-h">
                        <?php echo $resultadoscliente[0]->ip; ?>
                    </span>
                </div>
                <?php
                                            }if(isset($resultadoscliente[0]->deuda)){?>
                <div class="d-flex mt-2">
                    <i class="mdi mdi-currency-usd"></i>&nbsp;Deuda:&nbsp;
                    <span class="badge badge-secondary-lighten line-h">
                        <?php echo $resultadoscliente[0]->deuda; ?>
                    </span>
                </div>
                <?php }?>
            </div>
        </div>
<?php if($intehabilitado==1){?>
        <div>
                <button onclick="extraordinario('<?php echo $resultados[0]->cliente;?>')" type="button" class="btn btn-success"><i class="mdi mdi-account-search me-1"></i> Buscar datos</button>
        </div>
        <?php }?>
    </div>


</div>
