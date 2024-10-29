
<?php if($resultados[0]->ticketid==317){?>
<iframe allow="camera;microphone" src="https://frontend-botpress-q74s5.ondigitalocean.app/?conversationId=<?php echo $resultados[0]->conversation_id; ?>&ticketId=<?php echo $resultados[0]->ticketid;?>&agentName=<?php echo session('nombreusuario');?> " width="100%" class="border rounded-3" style="height: 650px!important;"></iframe>
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