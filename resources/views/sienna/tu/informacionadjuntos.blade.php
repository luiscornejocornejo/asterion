<div class="card widget-flat">
                            <div class="card-body">
                              
                            <h5 class="mb-3">Adjuntos</h5>

                                <div class="row">
                                    <?php foreach ($segui as $adj) {
                                                if ($adj->tipo == 9) {?>
                                                                    <div class="col-xl-2">
                                                                        <div class="card mb-1 ">
                                                                            <div class="p-2">
                                                                                <div class="row align-items-center">

                                                                                    <div class="col-auto">
                                                                                        <!-- Button -->
                                                                                         <?php $ht = 'https://sienamedia.sfo3.digitaloceanspaces.com/' . $subdomain_tmp . '/xen/enviados/' . $adj->logo;?>
                                                                                <a target=_blank href="<?php echo $ht; ?>"><img  src='/adjunto.png' width="40px;"></a>




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