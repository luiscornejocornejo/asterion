<div id="standard-modalrol" class="modal fade bs-example-modal-center " tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title">Cambiar Rol</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/rolusers" method="post">
                    @csrf
                       
                        <input value="" type="hidden" name="user_id" id="user_id">
                       

                        <div >
                     
                            <input required value="2" class="form-radio" type="radio" name="statos">&nbsp;
                        <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">Supervisor</span>
                            <br><br>
                            <input required value="3" class="form-radio" type="radio" name="statos">&nbsp;
                        <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">Agente</span>
                            <br><br>
 
                                             </div>
                        <button type="submit" class="btn btn-success
                                    waves-effect waves-light">Cambiar</button>

                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>