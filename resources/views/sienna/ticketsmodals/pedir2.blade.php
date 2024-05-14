<div id="standard-modal-reclamo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="dark-header-modalLabel" aria-hidden="true">
           <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h4 class="modal-title text-light" id="dark-header-modalLabel">Asignar ticket</h4>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                            Asignar el ticket             
                                </div>
                    <div class="modal-footer mx-auto">
                        <form action="/api/pedir20" method="POST">
                            <input value="" type="hidden" name="idticketpedir" id="idticketpedir2">
                            <input value="<?php echo session('nombreusuario');?>" type="hidden" name="logeado" id="logeado">
                            <input value="" readonly type="hidden" name="ticketss" id="idticketpedir20">

                            <div v-for="department in departments ">
                                <?php foreach($usersmerchant as $dep){?>
                                    <input value="<?php echo $dep->id;?>" class="form-radio" type="radio" name="usuarioticket">&nbsp;
                                <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;"><?php echo$dep->nombre." ".$dep->last_name;?></span>
                                    <br><br>

                                    <?php }?>   
                            </div>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-success">Si, asignar</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
</div><!-- /.modal -->