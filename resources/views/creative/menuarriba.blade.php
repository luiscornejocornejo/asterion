<?php
use Illuminate\Support\Facades\DB;
$saliente = session('saliente');

$categoria = session('categoria');

$resultados = DB::table('categoria')->where('id', $categoria)->get();

$nombrecategoria = "";
foreach ($resultados as $value) {
    $nombrecategoria = $value->nombre;
}
?>

<div class="navbar-custom topnav-navbar" style="background-color:#3c4655">
    <div class="container-fluid detached-nav">

        <!-- Topbar Logo -->
        <style>
            .logo-topbar {
                display: flex !important;
                justify-content: center;
                align-items: center;
            }
        </style>

        <div class="logo-topbar">
            <!-- Logo light -->
            <a href="#" class="logo-light">
                <span class="logo-lg m2">
                    &nbsp; <img src="/img/suri5.png" alt="logo" height="40%">
                </span>
                <span class="logo-sm m2">
                    <img src="/img/suri5.png" alt="small logo" height="40%">
                </span>
            </a>

            <!-- Logo Dark -->
            <a href="#" class="logo-dark">
                <span class="logo-lg">
                    <img src="/img/suri5.png" alt="dark logo" height="40%">
                </span>
                <span class="logo-sm">
                    <img src="/img/suri5.png" alt="small logo" height="40%">
                </span>
            </a>
        </div>

        <!-- Sidebar Menu Toggle Button -->
        <button class="button-toggle-menu">
            <i class="mdi mdi-menu"></i>
        </button>

       
      
       

        

        <ul class="list-unstyled topbar-menu float-end mb-0">
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#"
                    role="button" aria-haspopup="false" aria-expanded="false">
                    <span class="account-user-avatar">
                        <img src="assets3/images/users/avatar-1.jpg" alt="user-image" class="rounded-circle">
                    </span>
                    <span>
                        <span class="account-user-name"><?php echo session('nombreusuario'); ?> (<?php echo $nombrecategoria; ?>)</span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                    <!-- item -->

                    <!-- item -->
                    <a href="/salir" class="dropdown-item notify-item">
                        <i class="mdi mdi-logout me-1"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </li>
        </ul>
        <ul class="list-unstyled topbar-menu float-end mb-0">
            <br>
        <?php 

if($saliente <>""){?>
 &nbsp; 

 <button    style="background-color: #ffc95c;"  class="btn btn-primary btn-sm mb-0 " id="btnAbrirAgregarBien" data-toggle="modal" data-target="#modalExample">
<span style="color: #495057;" >Iniciar Conversacion</span>
</button>
<?php  }?>
        </ul>
    </div>
</div>
