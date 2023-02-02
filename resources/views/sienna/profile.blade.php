
<?php
            use Illuminate\Support\Facades\DB;

$idusuario =  session('idusuario');
$query = "SELECT * from users where id='".$idusuario."'";
$resultados = DB::select($query);
foreach($resultados as $valuee){

    $birthdate=$valuee->birthdate;
    $email=$valuee->email;
    $name=$valuee->name;
    $dni=$valuee->dni;
}
?>


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
                <h4 class="mb-sm-0 font-size-18">Profile</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-9 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm order-2 order-sm-1">
                            <div class="d-flex align-items-start mt-3
                                mt-sm-0">
                                <div class="flex-shrink-0">
                                    <div class="avatar-xl me-3">
                                        <img
                                            src="assets/images/users/avatar-2.jpg"
                                            alt="" class="img-fluid
                                            rounded-circle d-block">
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <h5 class="font-size-16 mb-1"><?php echo session('nombreusuario');?></h5>
                                        <p class="text-muted font-size-13">Categorias</p>

                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    </div>

                    <ul class="nav nav-tabs-custom card-header-tabs
                        border-top mt-4" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link px-3 active"
                                data-bs-toggle="tab" href="#overview"
                                role="tab">Datos</a>
                        </li>
                    
                       
                    </ul>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->

            <div class="tab-content">
                <div class="tab-pane active" id="overview" role="tabpanel">
                    <div class="card">
                        <form action="/actualizardatos" method="post">
                        @csrf
<input type="hidden" name="iduser" value="<?php echo session('idusuario');?>">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Datos</h5>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="pb-3">
                                    <div class="row">
                                        <div class="col-xl-2">
                                            <div>
                                                <h5 class="font-size-15">Nombre
                                                    :</h5>
                                            </div>
                                        </div>
                                        <div class="col-xl">
                                            <div class="text-muted">
                                                <input type="text" name="nombre" value="<?php echo $name;?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="py-3">
                                    <div class="row">
                                        <div class="col-xl-2">
                                            <div>
                                                <h5 class="font-size-15">Email
                                                    :</h5>
                                            </div>
                                        </div>
                                        <div class="col-xl">
                                        <input type="email" name="email" value="<?php echo $email;?>">

                                        </div>
                                    </div>
                                </div>
                                <div class="py-3">
                                    <div class="row">
                                        <div class="col-xl-2">
                                            <div>
                                                <h5 class="font-size-15">Cumple
                                                    :</h5>
                                            </div>
                                        </div>
                                        <div class="col-xl">
                                        <input type="date" name="birthdate" value="<?php echo $birthdate;?>">

                                        </div>
                                    </div>
                                </div>
                                <div class="py-3">
                                    <div class="row">
                                        <div class="col-xl-2">
                                            <div>
                                                <h5 class="font-size-15">D.N.I
                                                    :</h5>
                                            </div>
                                        </div>
                                        <div class="col-xl">
                                        <input type="number" name="dni" value="<?php echo $dni;?>">

                                        </div>
                                    </div>
                                </div>
                                <div class="py-3">
                                    <div class="row">
                                        <div class="col-xl-2">
                                            <div>
                                                <h5 class="font-size-15">pass
                                                    :</h5>
                                            </div>
                                        </div>
                                        <div class="col-xl">
                                        <input type="password" name="password" value="">

                                        </div>
                                    </div>
                                </div>
                                <div class="py-3">
                                    <div class="row">
                                        <div class="col-xl-2">
                                            <div>
                                               
                                            </div>
                                        </div>
                                        <div class="col-xl">
                                        <button type="submit" class="btn btn-primary">Actualizar</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                   
                    <!-- end card -->
                </div>
                <!-- end tab pane -->

                <div class="tab-pane" id="about" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Cambio de pass</h5>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="pb-3">
                                <form>
                                    password
                                </form>
                                </div>

                           
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end tab pane -->

              
                <!-- end tab pane -->
                </form>
            </div>
            <!-- end tab content -->
        </div>
        <!-- end col -->

        <div class="col-xl-3 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Skills</h5>

                    <div class="d-flex flex-wrap gap-2 font-size-16">
                        <a href="#" class="badge badge-soft-primary">Photoshop</a>
                        <a href="#" class="badge badge-soft-primary">illustrator</a>
                        <a href="#" class="badge badge-soft-primary">HTML</a>
                        <a href="#" class="badge badge-soft-primary">CSS</a>
                        <a href="#" class="badge badge-soft-primary">Javascript</a>
                        <a href="#" class="badge badge-soft-primary">Php</a>
                        <a href="#" class="badge badge-soft-primary">Python</a>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->

          
            <!-- end card -->

         
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

</div> <!-- container-fluid -->
</div>
        </div>
    </div>
</div>
<br><br><br>
    @include('pp.footer')