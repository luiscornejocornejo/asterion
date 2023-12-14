<div class="modal fade" id="bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h4 class="modal-title" id="mySmallModalLabel">Estado de Ticket</h4>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/ventasstatus" method="post">
                            @csrf
                            <input type="hidden" name="tik" id="idticketestado2" value="">
                            <input type="hidden" name="idconv" id="conversation_id2" value="">
                            <input value="<?php echo $subdomain_tmp;?>" type="hidden" name="idbot" id="idbot">
                            <input value="<?php  $bot_channel="WhatsAppChannel"; echo $bot_channel;?>" type="hidden" name="bot_channel" id="bot_channel">

                            <div id="estunico"></div>
                                
                                    
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success">Cambiar</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
</div>