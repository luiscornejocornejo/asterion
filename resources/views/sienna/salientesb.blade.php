@include('facu.header')



<div class="wrapper menuitem-active">
@include('facu.menu')
<div class="content-page" style="padding: 0!important;">

    <div class="container-fluid pt-2">
        <form method="post" action="/nodes">
                @csrf

                    <div class="row">
                       
                        <div class="col-4 mb-2">
                            <label for="example-select" class="form-label">Estado del nodo</label>
                            <select class="form-select" name="estado" id="example-select">
                            
                            <?php foreach($listadopadre as $ll){?>
                                <option value="<?php echo $ll->id;?>"><?php echo $ll->nombre;?></option>
                            <?php }?>
                            </select>
                        </div>
                     
                        <div class="col-lg-4 col-sm-12">
                            <div class="mb-2 position-relative">
                                <label class="form-label">&nbsp;</label>
                                <input type="submit" type="button" class="form-control w-25 bg-success text-light" value="Cambiar">
                            </div>
                        </div>

                    </div>
                    <div class="row">
<!-- plugin js -->

                                                    
<!-- File Upload -->
<form action="/" method="post" class="dropzone" id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews"
    data-upload-preview-template="#uploadPreviewTemplate">
    <div class="fallback">
        <input name="file" type="file" multiple />
    </div>

    <div class="dz-message needsclick">
        <i class="h1 text-muted ri-upload-cloud-2-line"></i>
        <h3>Drop files here or click to upload.</h3>
        <span class="text-muted font-13">(This is just a demo dropzone. Selected files are
            <strong>not</strong> actually uploaded.)</span>
    </div>
</form>

<!-- Preview -->
                    <div class="dropzone-previews mt-3" id="file-previews"></div>

                        <!-- file preview template -->
                                <div class="d-none" id="uploadPreviewTemplate">
                                    <div class="card mt-1 mb-0 shadow-none border">
                                        <div class="p-2">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <img data-dz-thumbnail src="#" class="avatar-sm rounded bg-light" alt="">
                                                </div>
                                                <div class="col ps-0">
                                                    <a href="javascript:void(0);" class="text-muted fw-bold" data-dz-name></a>
                                                    <p class="mb-0" data-dz-size></p>
                                                </div>
                                                <div class="col-auto">
                                                    <!-- Button -->
                                                    <a href="" class="btn btn-link btn-lg text-muted" data-dz-remove>
                                                        <i class="ri-close-line"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                
                    </div>
            
               
        </form>

    </div> 
</div> 
</div>
    @include('facu.footer')