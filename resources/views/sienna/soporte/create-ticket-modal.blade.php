<div class="modal fade" id="create-ticket" tabindex="-1" role="dialog" aria-labelledby="create-taskdby" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title" id="create-taskdby">Nuevo ticket</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>

            <div class="modal-body">
                <form action="/create/ticket" method="POST">
                    <div class="row">
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="department" class="form-label">Departamento:</label>
                            <select onchange="moti(this)" class="form-control mb-3" name="department" id="department" class="form-select">
                            <option value="2">Soporte</option>
                            <option value="3">Administracion</option> 
                            </select>
                        </div>
                        <script>
                            function moti(dep){
                                alert(dep);
                            }
                        </script>
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="reason" class="form-label">Motivo:</label>
                            <select class="form-control mb-3" name="reason" id="reason" class="form-select">
                                <?php // foreach ($usersmerchant as $val) { ?>
                               
                                <?php // } ?>
                            </select>
                        </div>
                    </div>

                    <label for="ticket-text" class="form-label">Descripción:</label>
                    <textarea class="form-control mb-3" id="task-text" name="text-ticket" class="form-control mb-3" rows="4" required></textarea>
                    <input type="hidden" value="<?php // echo $resultados[0]->ticketid; 
                                                ?>" name="ticketid" />

                    <label for="evidence" class="btn btn-secondary rounded-pill">
                        <i class="mdi mdi-attachment"></i> Evidencia
                        <input name="evicence" type="file" id="evidence" class="d-none">
                    </label>

                    <div class="modal-footer">
                        <input value="<?php // echo $subdomain_tmp; ?>" type="hidden" name="idbot" id="idbot">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success" id="liveToastBtn" data-bs-dismiss="modal">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>