


<div class="modal fade" id="bs-example-modal-prioridadall" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h4 class="modal-title" id="mySmallModalLabel">Prioridad ticket all</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form method="post" action="/prioridadsiennaall">
                    <div class="modal-body">
                    Cambiar la Prioridad de los tickets             
                      
                  
                    <div class="modal-footer">
                    @csrf
                    <input value="" type="hidden" name="idticketpedir" id="idticketpedir2">
                            <input value="<?php echo session('nombreusuario');?>" type="hidden" name="logeado" id="logeado">
                            <input value="" readonly type="hidden" name="ticketss" id="tp">

                            <div v-for="department in departments ">
                            <?php foreach($prioridades as $dep){?>
                                <input value="<?php echo $dep->id;?>" class="form-radio" type="radio" name="statos">&nbsp;
                            <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;"><?php echo$dep->nombre;?></span>
                                <br><br>

                                <?php }?>   
                                </div>
                                </div>
                            
                        <button type="submit" class="btn btn-success">Si</button>
                    </div>
                </form>
            </div>
        </div>
        </div></div>