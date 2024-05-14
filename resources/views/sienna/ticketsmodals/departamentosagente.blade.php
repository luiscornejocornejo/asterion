<div id="bs-example-modal-sm2" class="modal fade bs-example-modal-center " tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title">Cambiar Depto Agente</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/api/cambiardeptosienna2" method="post">
                        <input type="hidden" name="_token" v-bind:value="csrf">
                        <input value="" type="hidden" name="idconv" id="idconv">
                        <input value="<?php echo session('nombreusuario');?>" type="hidden" name="logeado" id="logeado">
                        <input value="" type="hidden" name="user_id" id="user_id">
                        <input value="<?php echo $subdomain_tmp;?>" type="hidden" name="idbot" id="idbot">
                        <input value=""  type="hidden" name="idticketdepto" id="idticketdepto">
                        <input value="" readonly type="hidden" name="ticketss" id="idticketdepto22">
                        <input value="" type="hidden" name="bot_channel" id="bot_channel">
  
                        <input  type="hidden" name="merchant" id="merchant" value=" <?php echo $subdomain_tmp;?> ">

                        <div v-for="department in departments ">
                        <?php foreach($deptos as $dep){?>
                            <input value="<?php echo $dep->id;?>" class="form-radio" type="radio" name="statos">&nbsp;
                        <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;"><?php echo$dep->nombre;?></span>
                            <br><br>

                            <?php }?>   
                                             </div>
                        <button type="submit" class="btn btn-success
                                    waves-effect waves-light">Cambiar</button>

                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>