<div class="modal fade" id="create-task" tabindex="-1" role="dialog" aria-labelledby="create-taskdby" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title" id="create-taskdby">Nueva tarea</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>

            <div class="modal-body">
                <form action="/creartarea" method="POST">
                    @csrf

                    <label for="task-text" class="form-label">Titulo:</label>
                    <input class="form-control mb-3" type="text" name="titulo">

                    <label for="task-text" class="form-label">Descripción:</label>
                    <textarea class="form-control mb-3" id="task-text" name="texttask" class="form-control mb-3" rows="4" required></textarea>
                    <input type="hidden" value="<?php echo $resultados[0]->ticketid; ?>" name="ticketid" />

                    <div class="row">
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="agent" class="form-label">Agente a asignar:</label>
                            <select class="form-control mb-3" name="agent" id="agent" class="form-select">
                                <?php foreach ($usersmerchant as $val) { ?>
                                    <option value="<?php echo $val->id; ?>"><?php echo $val->nombre . " " . $val->last_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label" for="task-text" class="form-label">Fecha Limite:</label>
                            <input class="form-control mb-3" type="date" name="fecha">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input value="<?php echo $subdomain_tmp; ?>" type="hidden" name="idbot" id="idbot">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>