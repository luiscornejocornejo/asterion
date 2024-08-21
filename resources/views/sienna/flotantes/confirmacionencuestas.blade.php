

<div class="modal fade" id="encuesta-csat" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title text-light" id="mySmallModalLabel">Envío encuesta C-SAT</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="csat-select" class="form-label">Encuesta</label>
                    <select class="form-select" id="csat-select" name="csat-selected">
                        <?php foreach($resultados2 as $values) { ?>
                           <option value="<?php echo $values->url; ?>"> <?php $values->nombre; ?> </option> 
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <form action="" method="post">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success">Enviar</button>
                    <input type="hidden" name="id" value="">
                </form>
            </div></div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="encuesta-nps" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title text-light" id="mySmallModalLabel">Encuesta NPS</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="nps-select" class="form-label">Encuesta</label>
                    <select class="form-select" id="nps-select" name="nps-selected">
                        <?php  foreach($resultados3 as $values) { ?>
                           <option value="<?php echo $values->url; ?>"> <?php  echo $values->nombre; ?> </option> 
                        <?php  } ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <form action="" method="post">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success">Enviar</button>
                    <input type="hidden" name="id" value="">
                </form>
            </div></div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>