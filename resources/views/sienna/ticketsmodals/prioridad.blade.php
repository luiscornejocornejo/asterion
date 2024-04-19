<div class="modal fade" id="bs-example-modal-smcerrar" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h4 class="modal-title" id="mySmallModalLabel">Cerrar ticket</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form method="post" action="/prioridad">
                    <div class="modal-body">
                        ¿Está seguro de cerrar el ticket?
                        <label for="client_number" class="form-label">Por favor agrega el número de cliente correspondiente del usuario :</label>
                    <input required type="number" class="form-control" name="client_number" id="client_number">

                    </div>
                    <div class="modal-footer">
                    @csrf
                            <input type="hidden" name="tik" id="idticketestadoprioridad" value="">
                            <input type="hidden" name="idconv" id="conversation_id20" value="">
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