<div class="modal fade" id="bs-example-modal-prioridadall" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title" id="mySmallModalLabel">Cambiar prioridad</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form method="post" action="/prioridadsiennaall">
                <div class="modal-body">
                    @csrf
                    <input value="" type="hidden" name="idticketpedir" id="idticketpedir2">
                    <input value="<?php echo session('nombreusuario'); ?>" type="hidden" name="logeado" id="logeado">
                    <input value="" readonly type="hidden" name="ticketss" id="tp">

                    <div v-for="department in departments ">
                        <?php foreach ($prioridades as $dep) { ?>
                            <div class="form-check mt-2">
                                <input value="<?php echo $dep->id; ?>" id="<?php echo $dep->id; ?>" class="form-check-input" type="radio" name="statos">
                                <label for="<?php echo $dep->id; ?>" class="form-check-label"><?php echo $dep->nombre; ?></label>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="modal-footer mt-2">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Cambiar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>