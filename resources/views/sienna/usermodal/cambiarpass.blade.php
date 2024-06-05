<div id="standard-modalcambiarpass" class="modal fade bs-example-modal-center " tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title">Cambiar Pass</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/passuser" method="post"  enctype="multipart/form-data">
                    @csrf
                       
                        <input value="" type="hidden" name="user_idpass" id="user_idpass">
                       

                        <div >
                     
                        
                            <input  value="" class="form-radio" type="password" name="newpass">
                        
 
                                             </div>
                        <button type="submit" class="btn btn-success
                                    waves-effect waves-light">Cambiar</button>

                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>