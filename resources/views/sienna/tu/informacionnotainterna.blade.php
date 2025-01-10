<style>
    input[type="file"] {
        display: none;
    }

    .custom-file-upload {
        border: 1px solid #ccc;
        display: inline-block;
        padding: 6px 12px;
        cursor: pointer;
    }

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

<div class="card widget-flat">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div>
                <h4 class="fw-normal text-dark" title="Number of Customers">Notas Internas</h4>
            </div>
            <div>
                <i class="uil-notes widget-icon bg-secondary-lighten text-secondary"></i>
            </div>
        </div>
        <hr style="margin-top: 10px;" />
        <div class="row">
            <div class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12">

                <form action="/api/siennacrearseguimiento2" method="POST" enctype="multipart/form-data">
                    <div class="mt-2 ">
                        <div class="mb-2 mt-2">
                            <label class="form-label">Cuerpo de nota interna</label>
                            <div class="input-group">
                                <input value="<?php echo session('nombreusuario'); ?>" type="hidden" name="logeado" id="logeado">

                                <input value="<?php echo $resultados[0]->ticketid; ?>" type="hidden" name="idticketseguimiento"
                                    id="idticketseguimiento">
                                <textarea class="form-control" name="comentario" rows="4"></textarea>
                            </div>
                            <div class="mt-2">
                                <button class="btn btn-primary rounded-pill me-1" type="submit">Crear</button>
                                <label for="fileInput" class="btn btn-secondary rounded-pill">
                                    <i class="mdi mdi-attachment"></i> Adjuntar
                                    <input name="logo" type="file" id="fileInput" class="d-none">
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card-footer">
                    <h5 class="font-18 mb-2">Nota: </h5>
                    <ul class="conversation-list p-0" data-simplebar="init">
                        <?php foreach ($segui as $val) {
                            if ($val->tipo == 5) {
                                if ($val->logo != null) {

                                if ($val->tipo == 5) {
                                    $ht = 'https://sienamedia.sfo3.digitaloceanspaces.com/' . $val->logo;
                                } else {
                                    $ht = 'https://sienamedia.sfo3.digitaloceanspaces.com/' . $subdomain_tmp . '/xen/enviados/' . $val->logo;
                                }

                                
                                $uri = '<a target=_blank href="' . $ht . '"><img  src=' . $ht . ' width="40px;"></a>';
                            } else {
                                $uri = '';
                            }
                            ?>
                        <li class="clearfix">
                            <div class="chat-avatar">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png"
                                    class="rounded-circle border" alt="Usuario">
                            </div>
                            <div class="conversation-text">
                                <div class="ctext-wrap bg-white border w-100">

                                    <p class="mb-1">
                                        <?php echo $val->autor; ?>
                                    </p>
                                    <p class="mb-1">
                                        <?php echo $val->descripcion; ?>
                                    </p>
                                    <p class="mb-1">
                                        <?php echo $val->created_at; ?>
                                    </p>
                                    <span>
                                        <?php if ($uri != "") { ?>
                                        <span onclick="ng(`<?php echo $ht; ?>`)" class="link-primary" type="button"
                                            data-bs-toggle="modal" data-bs-target="#bs-example-modal-img">
                                            Ver archivo
                                        </span>
                                        <?php } ?>
                                    </span>
                                </div>
                            </div>
                        </li>


                        <?php }}?>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
