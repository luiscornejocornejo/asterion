<div id="standard-modal-reclamo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="dark-header-modalLabel" aria-hidden="true">
           <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h4 class="modal-title text-light" id="dark-header-modalLabel">Reclamar ticket</h4>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
             

                    <div class="modal-body">
                        ¿Deseas reclamar este ticket?
                    </div>
                    <div class="modal-footer">
                    <form action="/api/pedir" method="POST">
                                <input value="<?php echo $resultados[0]->ticketid; ?>" type="hidden" name="idticketpedir" id="idticketpedir">
                                <input value="<?php echo session('idusuario'); ?>" type="hidden" name="usuarioticket" id="usuarioticket">
                                <input value="<?php echo session('nombreusuario'); ?>" type="hidden" name="logeado" id="logeado">

                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-success">Si, reclamar</button>
                    </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
</div>