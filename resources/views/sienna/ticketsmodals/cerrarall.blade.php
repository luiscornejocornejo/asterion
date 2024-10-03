<div class="modal fade" id="bs-example-modal-smcerrarall" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h4 class="modal-title" id="mySmallModalLabel">Cerrar ticket all</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form method="post" action="/cerrarall">
                    <div class="modal-body">
                        ¿Está seguro de cerrar los tickets?
                      
                  
                    <div class="modal-footer">
                    @csrf
                            <input type="hidden" name="tikall" id="tc" value="">
                            <input type="hidden" name="estado" id="es" value="4">
                            <input value="<?php echo $subdomain_tmp;?>" type="hidden" name="idbot" id="idbot">
                            <input value="<?php  $bot_channel="WhatsAppChannel"; echo $bot_channel;?>" type="hidden" name="bot_channel" id="bot_channel">


                            
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Si, cerrar</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
</div>