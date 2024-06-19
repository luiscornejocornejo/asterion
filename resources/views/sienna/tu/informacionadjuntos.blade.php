<div class="card widget-flat">
                            <div class="card-body">
                              
                            <h5 class="mb-3">Adjuntos</h5>

                                <div class="row">
                                    <?php foreach ($segui as $adj) {
                                                if ($adj->tipo == 9) {?>
                                                                    <div class="col-xl-4">
                                                                        <div class="card mb-1 shadow-none border">
                                                                            <div class="p-2">
                                                                                <div class="row align-items-center">

                                                                                    <div class="col-auto">
                                                                                        <!-- Button -->
                                                                                <a target=_blank href="<?php echo $adj->descripcion; ?>"><img  src='<?php echo $adj->descripcion . "_" . $adj->logo; ?>' width="40px;"></a>




                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div> <!-- end col -->
                                                <?php }
                                    }?>

                                </div>

                            </div>

                        </div>