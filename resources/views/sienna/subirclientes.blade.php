@include('facu.header')



<div class="wrapper menuitem-active">
@include('facu.menu')
<div class="content-page" style="padding: 0!important;">

    <div class="container-fluid pt-2">
    <div class="card-header">
                        <h4 class="card-title">Datos</h4>
                        <p class="card-title-desc">
                        <a href="/linknetclientes">Descarga Template</a>

                        </p>
                    </div>
    <form action="" method="post" enctype="multipart/form-data">
           
           @csrf                                <div class="fallback">
                                    <input name="file" type="file"
                                        multiple="multiple">
                                </div>
                                <div class="dz-message needsclick">
                                    <div class="mb-3">
                                        <i class="display-4 text-muted bx
                                            bx-cloud-upload"></i>
                                    </div>
                                    <button type="submit" class="btn btn-primary
                                waves-effect waves-light">Send</button>
                                    
                                </div>

                            </form>

    </div> 
</div> 
</div>
    <br><br><br>
    @include('facu.footer')