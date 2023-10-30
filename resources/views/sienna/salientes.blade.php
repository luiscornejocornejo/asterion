



@include('pp.header')

<div id="principal">
    <div class="mx-auto" style="width: 1000px;margin-top: 70px;">

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade
                            show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Begin Page Content -->
            <div class="mx-auto" style="width: 1000px;margin-top: 70px;">

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center
                justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Subir Archivo</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
   
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Salientes</h4>
                        <p class="card-title-desc">
                        <a href="/template">Descarga Template</a>

                        </p>
                    </div>
                    <div class="card-body">

                        <div>
                        <form action="" method="post" enctype="multipart/form-data">
           
           @csrf                              
           <div class="fallback">
                                <select name="clientes" class="form-control">

<?php foreach($clientes as $value){?>

    <option value='<?php echo $value->id;?>'><?php echo $value->nombre."(".$value->mobility.")</option>";?>

<?php
}?>
                              

                                </select>

                                    <input class="form-control"  name="file" type="file"
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
            </div> <!-- end col -->
        </div> <!-- end row -->
   
    <!-- end row -->

</div> <!-- container-fluid -->
</div>
        </div>
    </div>
</div>
<br><br><br>
    @include('pp.footer')