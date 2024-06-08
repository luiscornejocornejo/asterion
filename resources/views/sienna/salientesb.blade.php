@include('facu.header')



<div class="wrapper menuitem-active">
@include('facu.menu')
    <div class="content-page" style="padding: 0!important;">

        <div class="container-fluid pt-2">

                        <div class="row">
                        
                            <div class="col-4 mb-2">
                                <label for="example-select" class="form-label">Estado del nodo</label>
                                <select onchange="campos(this->id)" class="form-select" name="estado" id="example-select">
                                <option >seleccionar</option>
                                <?php foreach($listadopadre as $ll){?>
                                    <option value="<?php echo $ll->id;?>"><?php echo $ll->nombre;?></option>
                                <?php }?>
                                </select>
                                <script>
                                    function campos(id){
                                        alert(id);
                                    }

                                </script>
                            </div>
                        
                            

                        </div>
                        <div class="row">

                                <form action="/" method="post" class="dropzone" id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews"
                                    data-upload-preview-template="#uploadPreviewTemplate">
                                    @csrf

                                    <div class="fallback">
                                        <input name="file" type="file" multiple />
                                    </div>
                                    <div class="col-lg-4 col-sm-12">
                                                            <div class="mb-2 position-relative">
                                                                <label class="form-label">&nbsp;</label>
                                                                <input type="submit" type="button" class="form-control w-25 bg-success text-light" value="Cambiar">
                                                            </div>
                                                        </div>
                                
                                </form>

                        </div> 
        </div> 
    </div>
    

@include('facu.footer')