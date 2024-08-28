<div id="bs-example-modal-sm202" class="modal fade bs-example-modal-center " tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Cambiar departamentos</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/api/cambiardeptosienna202" method="post">
                    <input type="hidden" name="_token" v-bind:value="csrf">
                    <input value="" type="hidden" name="idconv" id="idconv">
                    <input value="<?php echo session('nombreusuario'); ?>" type="hidden" name="logeado" id="logeado">
                    <input value="" type="hidden" name="user_id" id="user_id">
                    <input value="<?php echo $subdomain_tmp; ?>" type="hidden" name="idbot" id="idbot">
                    <input value="" type="hidden" name="idticketdepto" id="idticketdepto">
                    <input value="" readonly type="hidden" name="ticketss" id="idticketdepto22">
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