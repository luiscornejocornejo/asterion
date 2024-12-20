<div class="modal fade" id="bs-example-modal-smcerrar" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h4 class="modal-title" id="mySmallModalLabel">Cerrar ticket</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form method="post" action="/ventasstatus">
                    <div class="modal-body">
                        ¿Está seguro de cerrar el ticket?
                        <label for="client_number" id="texto" class="form-label">Por favor agrega el número de cliente correspondiente del usuario :</label>
                    <input required type="number" class="form-control mb-1" name="client_number" id="client_number">
                    <br>
                    <span class="mt-2">Motivo de cierre:</span>
                    <div id="motivoc" class="mt-1"></div>
                    <div id="descierre" class="mt-3">
                    <span class="mt-2">Descripcion del cierre:</span>

                    <textarea name="descp" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    </div>
                    
                    <div class="modal-footer">
                    @csrf
                    <input type="hidden" name="tik" id="idticketestado20" value="">
                    <input type="hidden" name="source" id="source" value="">
                            <input type="hidden" name="idconv" id="conversation_id20" value="">
                            <input type="hidden" name="estado" id="es" value="4">
                            <input type="hidden" value="<?php echo session('idusuario');?>" name="userId"/>
                            <?php 
                            if(isset($resultados[0]->idempresa)){

                            
                                if($resultados[0]->idempresa<>1){
                                    $datempresa=$subdomain_tmp.$resultados[0]->idempresa;
                                }else{
                                    $datempresa=$subdomain_tmp;
                                }

                            }else{
                                $datempresa=$subdomain_tmp;

                            }
                             ?>
                            <input value="<?php echo $datempresa;?>" type="hidden" name="idbot" id="idbot">
                            <input value="WhatsAppChannel" type="hidden" name="bot_channel" id="bot_channel">


                            
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Si, cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>