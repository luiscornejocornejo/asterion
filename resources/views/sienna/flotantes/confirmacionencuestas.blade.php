<div class="modal fade" id="encuesta-csat" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="/sendCsatWithParams" method="post">
                @csrf
                <div class="modal-header bg-dark">

                    <h4 class="modal-title text-light" id="mySmallModalLabel">Envío encuesta C-SAT</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="csat-select" class="form-label">Encuesta</label>
                        <select class="form-select" id="csat-select" name="url">
                            <?php foreach($motivosCierre as $values) { ?>
                            <option value="<?php echo $values->url; ?>"> <?php echo $values->nombre; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Enviar</button>
                    <input type="hidden" id="telcsat" name="telcsat" value="<?php $celcliente; ?>">
                    <input type="hidden" id="ticket" name="ticket" value="">

            </form>
        </div>
    </div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="encuesta-nps" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="/sendCsatWithParams" method="post">
                @csrf

                <div class="modal-header bg-dark">
                    <h4 class="modal-title text-light" id="mySmallModalLabel">Encuesta NPS</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nps-select" class="form-label">Encuesta</label>
                        <select class="form-select" id="nps-select" name="url">
                            <?php  foreach($motivosCierre as $values) { ?>
                            <option value="<?php echo $values->url; ?>"> <?php echo $values->nombre; ?> </option>
                            <?php  } ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Enviar</button>
                    <input type="hidden" id="telnps" name="tel" value="">
                    <input type="hidden" id="ticket" name="ticket" value="">
            </form>
        </div>
    </div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>
