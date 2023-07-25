<?php
use Illuminate\Support\Facades\DB;

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

        <?php $subdomain_tmp = 'localhost';
                if (isset($_SERVER['HTTP_HOST'])) {
                    $domainParts = explode('.', $_SERVER['HTTP_HOST']);
                    $subdomain_tmp =  array_shift($domainParts);
                } elseif(isset($_SERVER['SERVER_NAME'])){
                    $domainParts = explode('.', $_SERVER['SERVER_NAME']);
                    $subdomain_tmp =  array_shift($domainParts);
                    
                }

                if($subdomain_tmp =="redlam"){?>
 <button class="btn btn-primary btn-sm" id="btnAbrirAgregarBien" data-toggle="modal" data-target="#modalExample">
    <i class="mdi mdi-plus-circle-outline"></i>Iniciar Conversacion
</button>
       <?php  }?>
        <div class="modal fade" id="modalExample" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Iniciar Mensaje</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="frmAgregarBienCapitalizable" action="/" method="post">         
                            @csrf

                            <div class="mt-12">                                 
                                        
                            </div>

                            <div class="row">
                                                                        <div class="col-6">
                                        
                                                                            <label
                                                                                class="form-label"
                                                                                for="formrow-firstname-input">WhatsApp</label>
                                                                            <input
                                                                            required
                                                                            name="HORASDESDE"
                                                                                type="cel"
                                                                                class="form-control"
                                                                                id="formrow-hasta-input">

                                                                    </div>
                                                                    
                                                                    </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                
                            <button type="submit"   class="btn  btn-primary   w-md">Cargar</button>
                        </div>
                    </div>
                    </form>
                </div>
        </div>
        <!-- Horizontal Menu Toggle Button -->
        <button class="navbar-toggle bg-light" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
            <div class="lines">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>

        <ul class="list-unstyled topbar-menu float-end mb-0">

        </ul>

        <ul class="list-unstyled topbar-menu float-end mb-0">
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#"
                    role="button" aria-haspopup="false" aria-expanded="false">
                    <span class="account-user-avatar">
                        <img src="assets3/images/users/avatar-1.jpg" alt="user-image" class="rounded-circle">
                    </span>
                    <span>
                        <span class="account-user-name"><?php echo session('nombreusuario'); ?></span>
                        <span class="account-position"><?php echo $nombrecategoria; ?></span>
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
    </div>
</div>
