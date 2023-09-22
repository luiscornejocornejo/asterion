<div class="navbar-custom topnav-navbar" style="background-color: <?php echo session('empresaMenu'); ?>;">
                <div class="container-fluid detached-nav">

                    <!-- Topbar Logo -->
                    <div class="logo-topbar">
                        <!-- Logo light -->
                        <a href="/" class="logo-light">
                            
                            <span class="logo-lg">
                                <img src="storage/<?php echo $empresaLogo; ?>" alt="logo" height="22">
                            </span>
                            <span class="logo-sm">
                                <img src="storage/<?php echo $empresaLogo; ?>" alt="small logo" height="22">
                            </span>
                        </a>

                        <!-- Logo Dark -->
                        <a href="index.html" class="logo-dark">
                            <span class="logo-lg">
                                <img src="storage/<?php echo $empresaLogo; ?>" alt="dark logo" height="22">
                            </span>
                            <span class="logo-sm">
                                <img src="storage/<?php echo $empresaLogo; ?>" alt="small logo" height="22">
                            </span>
                        </a>
                    </div>

                    <!-- Sidebar Menu Toggle Button -->
                    <button class="button-toggle-menu">
                        <i class="mdi mdi-menu"></i>
                    </button>

                    <!-- Horizontal Menu Toggle Button -->
                    <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </button>

                    <ul class="list-unstyled topbar-menu float-end mb-0">
                      

                         

                        

                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                aria-expanded="false">
                                <span class="account-user-avatar"> 
                                    <img src="assets3/images/users/avatar-1.jpg" alt="user-image" class="rounded-circle">
                                </span>
                                <span>
                                    <span class="account-user-name"><?php echo session('nombreusuario'); ?></span>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                                <!-- item-->
                                <div class=" dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>

                                <!-- item-->
                                <a href="/profile" class="dropdown-item notify-item">
                                    <i class="mdi mdi-account-circle me-1"></i>
                                    <span>Profile</span>
                                </a>

                                <!-- item-->
                         

                                <!-- item-->
                             

                                <!-- item-->
                             

                                <!-- item-->
                                <a href="/salir" class="dropdown-item notify-item">
                                    <i class="mdi mdi-logout me-1"></i>
                                    <span>Salir</span>
                                </a>
                            </div>
                        </li> 
                    </ul>

                
                </div>
</div>
<!-- ========== Topbar End ========== -->
