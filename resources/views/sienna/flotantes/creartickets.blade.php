<!-- Modal for Create Ticket -->
<div id="create-ticket-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="dark-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title text-light" id="dark-header-modalLabel">Crear ticket</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form>
                <div class="modal-body">
                    
                        <div class="mb-3">
                            <label for="number-client" class="form-label">Numero de cliente</label>
                        </div>

                        <div class="mb-3">
                            <label for="number-client" class="form-label">Numero de cliente</label>
                            <input type="number" id="number-client" class="form-control" required>
                        </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Crear</button>
                </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
</div>