

<div class="card widget-flat">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div>
                <h4 class="fw-normal text-dark" title="Number of Customers">Pagoralia</h4>
            </div>
        <div>
        <i class="uil-notes widget-icon bg-secondary-lighten text-secondary"></i>
        <hr style="margin-top: 10px;" />
                                <div class="row">
                                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12">
                                        
                                    <form action="/api/pagoralia" method="POST" enctype="multipart/form-data">
                                        <div class="mt-2 ">
                                            <div class="mb-2 mt-2">
                                                <label class="form-label">Cuerpo de nota interna</label>
                                                <div class="input-group">
                                                    <input value="<?php echo session('nombreusuario'); ?>" type="hidden" name="logeado" id="logeado">

                                                    <input value="<?php echo $resultados[0]->ticketid; ?>" type="hidden" name="idticketseguimiento" id="idticketseguimiento">
                                                    <textarea  class="form-control" name="comentario" rows="4"></textarea>
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
                                    
                        </div>
    </div>
        

</div>

                                  