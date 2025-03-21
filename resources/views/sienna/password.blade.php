<!doctype html>
<html lang="en">

<head>
    <?php
        date_default_timezone_set("America/Argentina/Buenos_Aires");

$date = date('d-m-y H:i:s');
    use Illuminate\Support\Facades\DB;

    $query = "select * from login";
    $resultados = DB::select($query);


   $empresasss= explode(".",$_SERVER['HTTP_HOST']);


   
    ?>
    <meta charset="utf-8" />
    <title>Login | <?php echo $empresasss[0];?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- preloader css -->
    <link rel="stylesheet" href="assets/css/preloader.min.css" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>

    <!-- <body data-layout="horizontal"> -->
    <div class="auth-page">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-xxl-3 col-lg-4 col-md-5">
                    <div class="auth-full-page-content d-flex p-sm-5 p-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100">
                                <div class="mb-4 mb-md-5 text-center">
                                    <a href="" class="d-block auth-logo">
                                        <img src="/img/suri.jpg" alt="" height="80px;"> 
                                        <br><br><span class="logo-txt"> <?php echo $empresasss[0];?></span>
                                    </a>
                                </div>
                                <div class="auth-content my-auto">
                                    <div class="text-center">
                                        <h5 class="mb-0">Welcome Back!</h5>
                                        <p class="text-muted mt-2">Recovery Password <?php echo $empresasss[0]; ?></p>
                                    </div>


                                    <form class="custom-form mt-4 pt-2" method="post" action="/recuperar">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Username</label>
                                            <input type="text" name="email" class="form-control" id="username" placeholder="Enter username">
                                        </div>
                                      
                                        <div class="mb-3">
                                            <button style="background-color: #ffc95c;" class="btn w-100 waves-effect waves-light" type="submit">Log In</button>
                                        </div>
                                    </form>



                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end auth full page content -->
                </div>
                <!-- end col -->
                <div class="col-xxl-9 col-lg-8 col-md-7" >
                    <div class="auth-bg pt-md-5 p-4 d-flex" >
                        <div class="bg-overlay bg-primary"></div>
                        <ul class="bg-bubbles "  style="background-color: #38e991;opacity:0.3;">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <!-- end bubble effect -->
                        <div class="row justify-content-center align-items-center" >
                            <div class="col-xl-7">
                                <div class="p-0 p-sm-4 px-xl-0">
                                    <div id="reviewcarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-indicators carousel-indicators-rounded justify-content-start ms-0 mb-0">
                                            <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                            <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                            <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                        </div>
                                        <!-- end carouselIndicators -->
                                        <div class="carousel-inner">



       <?php
                                            $vuelta=0;
                                            foreach ($resultados as $resultado){

?>
<div class="carousel-item  <?php if($vuelta==0){ echo "active";}?>">
                                                <div class="testi-contain text-white">
                                                    <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                    <h4 class="mt-4 fw-medium lh-base text-white"><?php echo $resultado->texto;?></h4>
                                                    <div class="mt-4 pt-3 pb-5">
                                                        <div class="d-flex align-items-start">
                                                            <img src="diseno/Minia_Ajax_v1.2.0/Admin/assets/images/users/avatar-3.jpg" class="avatar-md img-fluid rounded-circle" alt="...">
                                                            <div class="flex-1 ms-3 mb-4">
                                                                <h5 class="font-size-18 text-white"><?php echo $resultado->contacto;?></h5>
                                                                <p class="mb-0 text-white-50"><?php echo $resultado->puesto;?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

         <?php

                                                $vuelta++;

                                            }?>
                                       
                                        </div>
                                        <!-- end carousel-inner -->
                                    </div>
                                    <!-- end review carousel -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container fluid -->
    </div>


    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <!-- pace js -->
    <script src="assets/libs/pace-js/pace.min.js"></script>
    <!-- password addon init -->
    <script src="assets/js/pages/pass-addon.init.js"></script>

</body>

</html>