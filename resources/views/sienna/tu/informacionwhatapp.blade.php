
<?php 
    
    $tipobot=0;
    foreach($datosempresa as $val){
        $tipobot=$val->tipo;
        $bp_bot_id=$val->bp_botid;
        $bp_ws_id=$val->bp_wsid;
        $bp_webhook_id=$val->bt_webhook_id;
    }

   
    $merchantId=$subdomain_tmp;
    if(($resultados[0]->ticketid==324)or($resultados[0]->ticketid==320)){
   // if($tipobot==1){
            ?>
<iframe allow="camera;microphone" 
src="https://conversations.suricata.chat/?ticketId=<?php echo $resultados[0]->ticketid;?>&agentName=<?php echo session('nombreusuario');?>&merchant=<?php echo $merchantId;?>" width="100%" class="border rounded-3" style="height: 650px!important;"></iframe>
<?php }
else{?>
<iframe allow="camera;microphone" src="<?php echo $resultados[0]->conversation_url; ?>" width="100%" class="border rounded-3" style="height: 650px!important;"></iframe>
<?php }?>
<div class="<?php echo $vero; ?> d-flex justify-content-between mt-2 mb-2">
    <div></div>
   

    <div class="me-2">
        <button class="btn btn-success " data-bs-toggle="modal" data-bs-target="#open-conversation">
            <i class="mdi mdi-whatsapp me-1"></i>Reabrir conversación
        </button>
    </div>


</div>
<div class="me-2">
    
    <select onChange="mos(this.options[this.selectedIndex].value)" class="form-select" aria-label="Default select example">
   <option>Seleccionar</option>
            <?php foreach($datosatajos as $val){?>
            <option value="<?php echo $val->contenido;?>" ><?php echo $val->nombre;?></option>
        <?php }?>
        </select>
    <script>
        function mos(dd){
            document.getElementById("cop").innerHTML =null;
            document.getElementById("cop").innerHTML =dd;
        }
    </script>


</div>
<div class="me-2">
<textarea class="form-control" id="cop"></textarea>
</div>