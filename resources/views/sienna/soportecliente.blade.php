@include('facu.header')



<div class="wrapper menuitem-active">
    @include('facu.menu')
    <div class="content-page" style="padding: 0!important;">

        <div class="container pt-5">
            <style>
                .conversation-list .odd .conversation-text {
                    float: right !important;
                    margin-right: 12px;
                    text-align: right;
                    width: 90% !important
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

                    <ul class="conversation-list p-0" data-simplebar="init">
                        <?php foreach ($tsoporte as $valor) :

$sss=$valor->siennatickets;
echo $siennaestado=$valor->status;
?>
                            <?php if ($valor->autor == 0) : ?>
                                <li class="clearfix">
                                    <div class="chat-avatar">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png" class="rounded-circle border" alt="Usuario">
                                    </div>
                                    <div class="conversation-text">
                                        <div class="ctext-wrap bg-white border w-100">
                                            <small class="text-muted"> <strong> <?php echo ucfirst($valor->idusuario); ?> </strong> </small><br>
                                            <small class="text-muted"><?php echo $valor->created_at; ?> </small>
                                            <p class="mb-1">
                                                <?php if ($valor->tipo == 2) {
                                                    $url_new = $valor->cuerpo;
                                                ?> <a href="https://sienamedia.sfo3.digitaloceanspaces.com/<?php echo $url_new ?>" target="_blank">Ver archivo </a>
                                                <?php } else {
                                                    echo $valor->cuerpo;
                                                } ?>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            <?php else : ?>
                                <li class="clearfix odd">
                                    <div class="chat-avatar">
                                        <img src="/assetsfacu/images/users/operator.jpeg" class="rounded-circle border" alt="Operador">
                                    </div>
                                    <div class="conversation-text">
                                        <div class="ctext-wrap w-100">
                                            <small class="text-muted"> <strong><?php echo ucfirst($valor->idusuario); ?> </strong> </small><br>
                                            <small class="text-muted"> <?php echo $valor->created_at; ?> </small>
                                            <p class="mt-2">
                                                <?php if ($valor->tipo == 2) {
                                                    $url_new = $valor->cuerpo;
                                                ?> <a href="https://sienamedia.sfo3.digitaloceanspaces.com/<?php echo $url_new ?>" target="_blank"><span class="ri-attachment-line pt-1"></span> Ver archivo </a>
                                                <?php } else {
                                                    echo $valor->cuerpo;
                                                } ?>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>





                    <!-- end row-->

                    <div class="mt-4">
                        <form method='post' action='/createticketsoportecliente' enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="exampleInputEmail1">Descripcion</label>
                                <br>
                                <input type="hidden" name="idnewticket" value="<?php echo $idnewticket;?>" />

                                <textarea name="descripcion" rows="5" class="form-control mb-3"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary rounded-pill me-1">Responder</button>
                                <label for="exampleInputPassword1" class="btn btn-secondary rounded-pill">
                                    <i class="mdi mdi-attachment"></i> Adjuntar
                                    <input name="evicence" type="file" id="exampleInputPassword1" class="d-none">
                                </label>
                                <span id="fileName" class="ms-1"></span>
                            </div>
                        </form>
                    </div>



                </div>
                <!-- end .mt-4 -->

            </div>
        </div>


    </div>
</div>
<script>
    function init() {
        document.getElementById('exampleInputPassword1').addEventListener('change', showName, false);
    }

    function showName(event) {
        document.getElementById('fileName').innerHTML = event.target.files[0].name
    }
    init()
</script>
</div>
    </div>
</div>
@include('facu.footer')