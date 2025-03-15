<!doctype html>
<html lang="en">

<head>
    <?php
        date_default_timezone_set("America/Argentina/Buenos_Aires");

$date = date('d-m-y H:i:s');
    


   $empresasss= explode(".",$_SERVER['HTTP_HOST']);


  

// Obtener la IP del cliente
$clientIp = $_SERVER['SERVER_ADDR'] ?? 'No disponible';


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
    <?php
   // $dbName = $_ENV['DB_DATABASE'];
   // dd($_ENV);//  $dbName ;
    ?>

    <!-- <body data-layout="horizontal"> -->
    <div class="auth-page">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-xxl-3 col-lg-4 col-md-5">
                <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <div class="flex justify-center mb-4">
            <img src="logo.png" alt="Asterion Logo" class="w-16 h-16">
        </div>
        <h2 class="text-2xl font-bold text-center mb-2">Asterion</h2>
        <p class="text-center text-gray-600 mb-6">Sign in to continue to Asterion</p>
        
        <form>
            <label class="block text-sm font-medium text-gray-700">Username</label>
            <input type="text" placeholder="Enter username" class="w-full p-2 border rounded mb-4">
            
            <label class="block text-sm font-medium text-gray-700">Password</label>
            <div class="relative">
                <input type="password" placeholder="Enter password" class="w-full p-2 border rounded">
                <span class="absolute right-3 top-2 cursor-pointer">👁</span>
            </div>
            
            <div class="flex items-center justify-between mt-4">
                <label class="flex items-center">
                    <input type="checkbox" class="mr-2">
                    <span class="text-sm">Remember me</span>
                </label>
                <a href="#" class="text-sm text-blue-600 hover:underline">Forgot password?</a>
            </div>
            
            <button class="w-full bg-yellow-400 text-white p-2 rounded mt-6 hover:bg-yellow-500">Log In</button>
        </form>
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
 

  
  
                                                <div class="testi-contain text-white">

                                                  
                                                </div>
                                            </div>

      
                                       
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