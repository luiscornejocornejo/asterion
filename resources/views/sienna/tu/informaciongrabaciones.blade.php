<div class="card widget-flat">
                            <div class="card-body">
                              
                            <h5 class="mb-3">Grabaciones</h5>

                                <div class="row">
                                    <?php foreach ($segui as $adj) {
                                                if ($adj->tipo == 12) {?>
                                                                    <div class="col-xl-2">
                                                                        <div class="card mb-1 ">
                                                                            <div class="p-2">
                                                                                <div class="row align-items-center">

                                                                                    <div class="col-auto">
                                                                                        <!-- Button -->
                                                                                        <?php $ht = 'https://recordingsuricata.sfo3.digitaloceanspaces.com/'. $adj->descripcion;?>

                                                                                        <audio controls>
                                                                                            <source src="<?php echo $ht; ?>" type="audio/ogg">
                                                                                            <source src="<?php echo $ht; ?>" type="audio/mpeg">
                                                                                            Your browser does not support the audio element.
                                                                                            </audio>




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