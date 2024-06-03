
<?php
$urlreabrir="";
$vero="";
                                    foreach($emp as $value){
                                        $urlreabrir=$value->reabrir;
                                    }
                                    if(strlen($urlreabrir)<2){
                                        $vero="d-none";
                                    }
?>
<iframe src="<?php echo $resultados[0]->conversation_url; ?>" width="100%" class="border rounded-3" style="height: 500px!important;"></iframe>

<div class="<?php  echo $vero;?> d-flex justify-content-between mt-2 mb-2">
                                <div></div>
                                <div class="me-2">
                                
                                
                                    <button class="btn btn-success " data-bs-toggle="modal" data-bs-target="#open-conversation">
                                            <i class="mdi mdi-whatsapp me-1" ></i>Reabrir conversación 
                                    </button>
                                </div>
                            

                            </div>  