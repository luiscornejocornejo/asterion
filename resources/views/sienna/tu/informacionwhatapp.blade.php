
<?php 
    
    $tipobot=0;
    foreach($datosempresa as $val){
        $tipobot=$val->tipo;
        $bp_botid=$val->bp_botid;
        $bp_wsid=$val->bp_wsid;
        $bt_webhook_id=$val->bt_webhook_id;
    }
    if(($resultados[0]->ticketid==317)or($resultados[0]->ticketid==320)){
   // if($tipobot==1){
            ?>
<iframe allow="camera;microphone" src="https://frontend-botpress-q74s5.ondigitalocean.app/?conversationId=<?php echo $resultados[0]->conversation_id; ?>&ticketId=<?php echo $resultados[0]->ticketid;?>&agentName=<?php echo session('nombreusuario');?>&bp_botid=<?php echo $bp_botid;?>&bp_wsid=<?php echo $bp_wsid;?>&bt_webhook_id=<?php echo $bt_webhook_id;?> " width="100%" class="border rounded-3" style="height: 650px!important;"></iframe>
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