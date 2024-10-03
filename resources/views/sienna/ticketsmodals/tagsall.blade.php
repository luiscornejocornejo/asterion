<div id="bs-example-modal-smtagsall" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="dark-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title text-light" id="dark-header-modalLabel">Tags</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form action="/tagsall" method="POST">
                    @csrf
                    <input value="" type="hidden" name="idtickettags" id="idtickettags">
                    <input value="<?php echo session('nombreusuario'); ?>" type="hidden" name="logeado" id="logeado">
                    <input value="" readonly type="hidden" name="ticketss" id="idticketpedir20">
                    <div v-for="department in departments">
                        <?php foreach ($siennatags as $dep) { ?>
                            <div class="form-check mt-2">
                                <input value="<?php echo $dep->id; ?>" id="<?php echo $dep->id; ?>" class="form-check-input" type="radio" name="usuarioticket">
                                <label for="<?php echo $dep->id; ?>" class="form-check-label"><?php echo ucfirst($dep->nombre) ; ?></label>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="modal-footer mt-2">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Asignar</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div><!-- /.modal -->