<style>
    .conversation-list .odd .conversation-text {
    float: right!important;
    margin-right: 12px;
    text-align: right;
    width: 90%!important
}

.conversation-list .conversation-text {
    float: left;
    font-size: 13px;
    margin-left: 12px;
    width: 90%
}
</style>

<div class="card ">
                                <div class="card-body">
                                    <div class="row">
                                        <h5 class="font-18 mb-2">Asunto: <?php echo $resultados[0]->asunto; ?></h5>
                                            <ul class="conversation-list p-0" data-simplebar="init">
                                                <?php foreach ($resultadosmails as $valormail):
                                                    $b = html_entity_decode($valormail->cuerpo);
                                                    $b = str_replace('src="cid:', '', $b);
                                                    $b = preg_replace('/<img\b(?![^>]*\bsrc=)[^>]*>/i', '', $b);
                                                // dd($b);

                                                ?>
                                                        <?php if ($valormail->autor == 0): ?>
                                                            <li class="clearfix">
                                                                <div class="chat-avatar">
                                                                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png" class="rounded-circle border" alt="Usuario">
                                                                </div>
                                                                <div class="conversation-text">
                                                                    <div class="ctext-wrap bg-white border w-100">
                                                                    <small class="text-muted">De1: <?php echo $resultados[0]->emailnom; ?></small><br>
                                                                    <small class="text-muted">CC: <?php echo $resultados[0]->cc; ?></small><br>
                                                                    <small class="text-muted">Fecha: <?php echo $resultados[0]->creacion; ?> </small>
                                                                        <p class="mb-1">
                                                                        {!! $b !!}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php else: ?>
                                                        <li class="clearfix odd">
                                                            <div class="chat-avatar">
                                                                <img src="/assetsfacu/images/users/operator.jpeg" class="rounded-circle border" alt="Operador">
                                                            </div>
                                                            <div class="conversation-text">
                                                                <div class="ctext-wrap w-100">
                                                                <small class="text-muted">De2: <?php // echo $resultados[0]->emailnom; ?></small><br>
                                                                    <small class="text-muted">Para: <?php echo "{$resultados[0]->emailnom}, {$resultados[0]->cc}" ?></small><br>
                                                                    <small class="text-muted">Fecha: <?php echo $resultados[0]->creacion; ?> </small>
                                                                    <p class="mb-1">
                                                                    {!! $b !!}
                                                        </p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    <?php endif;?>
                                                <?php endforeach;?>
                                            </ul>



                                            </div>
                                            </div>
                                            <div class="row">
                                        <h5 class="mb-3">Adjuntos</h5>

                                        <?php foreach ($segui as $adj) {
                                        if ($adj->tipo == 9) {?>
                                        <div class="col-xl-4">
                                            <div class="card mb-1 shadow-none border">
                                                <div class="p-2">
                                                    <div class="row align-items-center">

                                                        <div class="col-auto">
                                                            <!-- Button -->
                                                    <a target=_blank href="<?php echo $adj->descripcion; ?>"><img  src='<?php echo $adj->descripcion . "_" . $adj->logo; ?>' width="40px;"></a>




                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                        <?php }
                                        }?>

                                    </div>
                                    <!-- end row-->
                                    <div class="row">
                                        <div class="mt-5">
                                        <h5 class="mb-3">Responder</h5>

                                        <form action="{{asset('')}}mandarmailnuevo" method="POST" enctype="multipart/form-data">
                                            @csrf

                                            <div class="mt-2 ">
                                                <div class="mb-2 mt-2">
                                                    <div class="form-group">
                                                        
                                                        <label >Asunto: </label>
                                                        <span><?php echo $resultados[0]->asunto; ?></span>
                                                        <br> 
                                                        <input name="subject" id="subject" class=""  type="text" value="<?php echo $resultados[0]->asunto; ?>">

                                                            <br>                             
                                                      <label for="comentarios">CC:</label>
                         <input name="cc"  id="cc" class=""  type="text" value="<?php echo $resultados[0]->cc; ?>">
                           <br>                             <label for="comentarios">Destinatario</label>
                                                        <span name="mailaeviar" id="mailaeviar" class="badge text-bg-secondary rounded-pill" ><?php echo $resultados[0]->emailnom; ?></span>
                                                        <input name="mailaeviar"  id="mailaeviar" class=""  type="email" value="<?php echo $resultados[0]->emailnom; ?>">

                                                        <input type="hidden" name="ticket" value="<?php echo $resultados[0]->ticketid; ?>">

                                                    </div>
                                                    <div class="form-group"> 
                                                        <label for="comentarios"></label>
                                                        <textarea class="form-control" rows="5" id="comentarios" name="comentarios"></textarea>
                                                    </div> 
                                                    <div class="mt-2">
                                                        <button class="btn btn-primary rounded-pill me-1" type="submit">Crear</button>
                                                        <label for="fileInput" class="btn btn-secondary rounded-pill">
                                                            <i class="mdi mdi-attachment"></i> Adjuntar
                                                            <input multiple name="logo[]" type="file" id="fileInput" class="">
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                      
                                    </div>
                                       


                                </div>
                        <!-- end .mt-4 -->

                        </div>