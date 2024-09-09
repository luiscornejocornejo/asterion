<div class="modal fade" id="create-task" tabindex="-1" role="dialog" aria-labelledby="create-taskdby" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title" id="create-taskdby">Crear tarea</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>

            <div class="modal-body">
                <label for="task-title" class="form-label">Título:</label>
                <input type="text" class="form-control mb-3" name="task-title" id="task-title">
                <label for="task-text" class="form-label">Descripción:</label>
                <textarea id="task-text" name="text-task" class="form-control mb-3" rows="4" required></textarea>
                <div class="row">
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                        <label for="department" class="form-label">Departamento:</label>
                        <select name="department" id="department" class="form-select">
                            <option value="1">Soporte</option>
                        </select>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3">
                        <label for="agent" class="form-label">Agente a asignar:</label>
                        <select name="agent" id="agent" class="form-select">
                            <option value="1">Pepito</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <input value="<?php echo $subdomain_tmp; ?>" type="hidden" name="idbot" id="idbot">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Crear</button>
                </div>
            </div>
        </div>
    </div>
</div>