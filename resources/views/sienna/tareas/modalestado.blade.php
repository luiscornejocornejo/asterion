<div class="modal fade" id="task_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h4 class="modal-title" id="mySmallModalLabel">Estado de Tarea</h4>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <!-- Fields to use on status tasks
                            @csrf
                                <input type="hidden" name="tik" id="idticketestado2" value="">
                                <input type="hidden" name="idconv" id="conversation_id2" value="">
                                <input value="<?php //echo $subdomain_tmp;?>" type="hidden" name="idbot" id="idbot">
                                <input value="<?php  //$bot_channel="WhatsAppChannel"; echo $bot_channel;?>" type="hidden" name="bot_channel" id="bot_channel">
                                -->
                                <?php foreach ($datos3 as $val3) { ?>
                                <div class="form-check mt-2">
                                    <input value="<?php echo $val->id; ?>" id="<?php echo $val->id; ?>" class="form-check-input" type="radio" name="usuarioticket">
                                    <label for="<?php echo $val->id; ?>" class="form-check-label"><?php echo ucfirst($val->estadotarea); ?></label>
                                </div>
                                <?php } ?>    
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success">Cambiar</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
</div>