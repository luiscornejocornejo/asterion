<div class="modal fade" id="bs-example-modal-sm-departament" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h4 class="modal-title" id="mySmallModalLabel">Cambiar Area</h4>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/api/cambiardeptosienna2" method="post">
                            <input type="hidden" name="_token" v-bind:value="csrf">
                            <input value="<?php  echo $resultados[0]->conversation_id;?>" type="hidden" name="idconv" id="idconv">
                            <input value="<?php echo session('nombreusuario');?>" type="hidden" name="logeado" id="logeado">
                            <input value="<?php  echo $resultados[0]->user_id;?>" type="hidden" name="user_id" id="user_id">
                            <input value="<?php echo $subdomain_tmp;?>" type="hidden" name="idbot" id="idbot">
                            <input value="<?php  echo $resultados[0]->ticketid;?>"  type="hidden" name="idticketdepto" id="idticketdepto">
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