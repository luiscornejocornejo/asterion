<div id="standard-modalct" class="modal fade bs-example-modal-center " tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title">Puede Cerrar  tickets?</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/ctusers" method="post">
                    @csrf
                       
                        <input value="" type="hidden" name="user_idct" id="user_idct">
                       

                        <div >
                     
                        <select name="statos">

                        <option value="1">Si</option>
                        <option value="0">No</option>
                        </select>
                      <br><br>
 
                                             </div>
                        <button type="submit" class="btn btn-success
                                    waves-effect waves-light">Cambiar</button>

                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>