

@include('facu.header')



<div class="wrapper menuitem-active">
@include('facu.menu')
<div class="content-page" style="padding: 0!important;">

    <div class="container-fluid pt-2">
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
                                <h5 class="font-18 mb-2">Tarea: <?php //echo $resultados[0]->merchant; ?></h5>
                                    <ul class="conversation-list p-0" data-simplebar="init">
                                        <?php foreach ($resultadostareasegui as $valor):
                                           

                                        ?>
	                                            <?php if ($valor->autor == 0): ?>
	                                                <li class="clearfix">
	                                                    <div class="chat-avatar">
	                                                        <img src="https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png" class="rounded-circle border" alt="Usuario">
	                                                    </div>
	                                                    <div class="conversation-text">
	                                                        <div class="ctext-wrap bg-white border w-100">
	                                                        <small class="text-muted">De: <?php echo $valor->idusuario; ?></small><br>
	                                                        <small class="text-muted">Fecha: <?php echo $valor->created_at; ?> </small>
	                                                            <p class="mb-1">
                                                                <?php if($valor->tipo==1){
                                                                        echo $valor->cuerpo; 
                                                                }else{
                                                                    echo "img".$valor->cuerpo; 
                                                                }?>
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
                                                        <small class="text-muted">De: <?php echo $valor->idusuario;?></small><br>
                                                            <small class="text-muted">Fecha: <?php echo $valor->created_at;?> </small>
                                                            <p>
                                                            <?php if($valor->tipo==1){
                                                                        echo $valor->cuerpo; 
                                                                }else{
                                                                    echo "img".$valor->cuerpo; 
                                                                }?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endif;?>
                                        <?php endforeach;?>
                                    </ul>




                                    
                                    <!-- end row-->

                                        <div class="mt-5">
                                        <form method='post'action='/api/mandarmail'>
                                         @csrf
                                        
                                            <div  style="height: 300px;">
                                            </div>
                                        </form>
                                        </div>
                                       


                                </div>
                        <!-- end .mt-4 -->

                        </div>

                                        </div>


                                        </div> 
</div>
    <br><br><br>
    @include('facu.footer')