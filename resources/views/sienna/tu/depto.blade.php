<div class="modal fade" id="bs-example-modal-sm-departament" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title" id="mySmallModalLabel">Cambiar Area</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form action="/cambiardeptosiennacloud" method="post">

                    @csrf

                    <input value="<?php echo $resultados[0]->conversation_id; ?>" type="hidden" name="idconv" id="idconv">
                    <input value="<?php echo session('nombreusuario'); ?>" type="hidden" name="logeado" id="logeado">
                    <input value="<?php echo $resultados[0]->user_id; ?>" type="hidden" name="user_id" id="user_id">
                    <input value="<?php echo $subdomain_tmp; ?>" type="hidden" name="idbot" id="idbot">
                    <input value="<?php echo $resultados[0]->ticketid; ?>" type="hidden" name="idticketdepto" id="idticketdepto">
                    <input value="" type="hidden" name="bot_channel" id="bot_channel">

                    <input type="hidden" name="merchant" id="merchant" value=" <?php echo $subdomain_tmp; ?> ">

                    <div v-for="department in departments ">
                        <?php foreach ($deptos as $dep) { ?>
                            <div class="form-check mt-2">
                                <input value="<?php echo $dep->id; ?>" id="<?php echo $dep->id; ?>" class="form-check-input" type="radio" name="statos">
                                <label for="<?php echo $dep->id; ?>" class="form-check-label"><?php echo ucfirst($dep->nombre); ?></label>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="modal-footer mt-2">
                        <button type="submit" class="btn btn-success">Cambiar</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>