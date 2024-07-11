<div class="modal fade" id="create-ticket" tabindex="-1" role="dialog" aria-labelledby="create-taskdby" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title" id="create-taskdby">Nuevo ticket</h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>

            <div class="modal-body">
                <form action="/create/ticket" method="POST">
                    @csrf

                    <label for="reason" class="form-label">Motivo:</label>
                    <input class="form-control mb-3" type="text" name="reason" required>

                    <label for="ticket-text" class="form-label">Descripción:</label>
                    <textarea class="form-control mb-3" id="task-text" name="text-ticket" class="form-control mb-3" rows="4" required></textarea>
                    <input type="hidden" value="<?php // echo $resultados[0]->ticketid; 
                                                ?>" name="ticketid" />

                    <label for="evidence" class="btn btn-secondary rounded-pill">
                        <i class="mdi mdi-attachment"></i> Evidencia
                        <input name="evicence" type="file" id="evidence" class="d-none">
                    </label>

                    <div class="modal-footer">
                        <input value="<?php echo $subdomain_tmp; ?>" type="hidden" name="idbot" id="idbot">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success" id="liveToastBtn" data-bs-dismiss="modal">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <img src="..." class="rounded me-2" alt="...">
            <strong class="me-auto">Ticket generado</strong>
            <small>Ahora</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Nuestro equipo ha recibido el caso y estaremos en contacto contigo a la brevedad.
        </div>
    </div>
</div>

<script>
    const toastTrigger = document.getElementById('liveToastBtn')
    const toastLiveExample = document.getElementById('liveToast')

    if (toastTrigger) {
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
        toastTrigger.addEventListener('click', () => {
            toastBootstrap.show()
        })
    }
</script>