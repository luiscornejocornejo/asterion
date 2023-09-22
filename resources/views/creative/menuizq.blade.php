<div class="navbar-custom topnav-navbar" style="background-color: <?php echo session('empresaMenu'); ?>;">
    <div class="container-fluid detached-nav" style="margin-left:0px;">

        <!-- Topbar Logo -->
        <div class="logo-topbar" style="margin-left:0px;">
            <!-- Logo light -->
            <a href="" class="logo-light">
                <span class="logo-lg">
                    <img src="storage/<?php echo $empresaLogo; ?>" alt="logo" style="width: 150px !important;height: 70px;" >
                </span>
                <span class="logo-sm">
                    <img src="storage/<?php echo $empresaLogo; ?>" alt="small logo" style="width: 150px !important;height: 70px;" >
                </span>
            </a>

            <!-- Logo Dark -->
            <a href="" class="logo-dark">
                <span class="logo-lg">
                    <img src="storage/<?php echo $empresaLogo; ?>" alt="dark logo" style="width: 150px !important;height: 70px;" >
                </span>
                <span class="logo-sm">
                    <img src="storage/<?php echo $empresaLogo; ?>" alt="small logo" style="width: 150px !important;height: 70px;" >
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

        <ul class="list-unstyled topbar-menu float-end mb-0" style="margin-right:0px;">
          

         

          

          

            <li class="notification-list d-none d-sm-inline-block">
                <a class="nav-link" data-bs-toggle="offcanvas" href="#theme-settings-offcanvas">
                    <i class="ri-settings-3-line noti-icon"></i>
                </a>
            </li>

            <li class="notification-list d-none d-sm-inline-block">
                <a class="nav-link" href="javascript:void(0)" id="light-dark-mode">
                    <i class="ri-moon-line noti-icon"></i>
                </a>
            </li>

            <li class="notification-list d-none d-md-inline-block">
                <a class="nav-link" href="" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line noti-icon"></i>
                </a>
            </li>

            <li class="dropdown notification-list" style="background-color: <?php echo session('empresaMenu'); ?>;">
                <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
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
                    <a href="/salir" class="dropdown-item notify-item">
                        <i class="mdi mdi-logout me-1"></i>
                        <span>salir</span>
                    </a>
                </div>
            </li>
        </ul>

        <!-- Topbar Search Form -->
      
    </div>
</div>
<!-- ========== Topbar End ========== -->


<?php

use Illuminate\Support\Facades\DB;

$categoria =  session('categoria');
$query = "SELECT m.nombre as nombremenu,i.nombre as icono,m.id FROM `categoria_menu` cm 
join menu m on m.id=cm.menu join icono i on i.id=m.icono WHERE categoria=" . $categoria . ";
";
$resultados = DB::select($query);


?> 

<style>

.sin{

    color:#a6e8ff;
}

</style>
<script>
function changeColor(elementId, color) {
  document.getElementById(elementId).style.color = color;
}
function retro(elementId, color) {
  document.getElementById(elementId).style.color = color;
}

</script>
<!-- ========== Horizontal Menu Start ========== -->
<div class="leftside-menu">

   

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar  style="background-color: <?php echo session('empresaMenu'); ?>;">
        <!-- Leftbar User -->
        <div class="leftbar-user" style="background-color: <?php echo session('empresaMenu'); ?>;">
            <a href="pages-profile.html">
                <img src="assets3/images/users/avatar-1.jpg" alt="user-image" height="42" class="rounded-circle shadow-sm">
                <span class="leftbar-user-name">Dominic Keller</span>
            </a>
        </div>

        <!--- Sidemenu -->
        <ul class="side-nav" >

            <li class="side-nav-title side-nav-item">Menu</li>
            <li class="side-nav-item">

            <a  data-bs-toggle="collapse" href="#ini" aria-expanded="false" aria-controls="ini" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span class="badge bg-success float-end"></span>
                    <span> Dashboard </span>
                </a>

                <div class="collapse" id="ini">
                    <ul class="side-nav-second-level">
                        <li>
                        <a target="_self" href="/">
                                    <span id="Dashboard" onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" class="sin" data-key="t-Base">Dashboard</span>
                                </a>
                        </li>
                    </ul>
                </div>
           </li>

           <?php
            if ($categoria == 1) { ?>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarDashboards" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span class="badge bg-success float-end"></span>
                    <span> Sienna </span>
                </a>
                <div class="collapse" id="sidebarDashboards">
                    <ul class="side-nav-second-level">
                        <li>
                        <a target="_self" href="/sienna">
                                    <span id="sienna" onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" class="sin" data-key="t-Base">Sienna</span>
                                </a>
                        </li>
                        <li>
                        <a target="_self" href="/siennaabm?id=13">
                                    <span id="Usuarios" onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" class="sin" data-key="t-Base">Usuarios</span>
                                </a>
                        </li>
                        <li>
                        <a target="_self" href="/siennamenu?id=1">
                                    <span id="report" onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" class="sin" data-key="t-Base">Report</span>
                                </a>
                        </li>
                        
                       
                    </ul>
                </div>
            </li> 
            <?php } ?>
           
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarDashboards" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                    <i class="ri-file-list-line"></i>
                    <span class="badge bg-success float-end"></span>
                    <span> Ordenes </span>
                </a>
                <div class="collapse" id="sidebarDashboards">
                    <ul class="side-nav-second-level">
                        <li>
                        <a target="_self" href="/pagosestado">
                                    <span id="Activas" onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" class="sin" data-key="t-Base">Ordenes Activas</span>
                                </a>
                        </li>
                        <?php if($categoria==6)
                     {?>
                        <li>
                        <a target="_self" href="/masivoscobranzas">
                                    <span id="masivoscobranzas" onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" class="sin" data-key="t-Base">Masivos Cobranzas</span>
                                </a>
                        </li>
                        <?php }?>
                        <li>
                        <a target="_self" href="/siennareport?id=125">
                                    <span id="error" onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" class="sin" data-key="t-Base">Ordenes con error</span>
                                </a>
                        </li>
                        <li>
                        <a target="_self" href="/siennareport?id=126">
                                    <span id="historail" onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" class="sin" data-key="t-Base">Historial Ordenes</span>
                                </a>
                        </li>
                       
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarDashboards3" aria-expanded="false" aria-controls="sidebarDashboards3" class="side-nav-link">
                    <i class="ri-lifebuoy-line"></i>
                    <span class="badge bg-success float-end"></span>
                    <span> Soporte </span> 
                </a>
                <div class="collapse" id="sidebarDashboards3">
                    <ul class="side-nav-second-level">
                        <li>
                        <a target="_self" href="/tickets">
                                    <span id="Ticketsc" onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" class="sin" data-key="t-Base">Tickets</span>
                                </a>
                        </li>
                       
                        
                         
                       
                    </ul>
                </div>
            </li>
            <?php if($categoria==6)
            {?>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarProp" aria-expanded="false" aria-controls="sidebarProp" class="side-nav-link">
                    <i class="uil-signal-alt"></i>
                    <span class="badge bg-success float-end"></span>
                    <span> Propietarios </span>
                </a>
                <div class="collapse" id="sidebarProp">
                    <ul class="side-nav-second-level">
                        <li>
                        <a target="_self" href="/siennaabm?id=137">
                                 <span class="sin" id="Listado"  onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" data-key="t-Base">Listado</span>
                                </a>
                        </li>
                        <li>
                        <a target="_self" href="/masivospayers">
                                        <span class="sin" id="masivospayers"  onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" data-key="t-Base">Masivos Payers</span>
                                        </a>
                        </li>
                      
                    
                       
                    </ul>
                </div>
            </li>
            <?php }?>

            <?php
            if (sizeof($resultados) > 0) {

                foreach ($resultados as $value) {

            ?>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#<?php echo $value->nombremenu; ?>" aria-expanded="false" aria-controls="<?php echo $value->nombremenu; ?>" class="side-nav-link">
                    <i class="<?php echo $value->icono; ?>"></i>
                    <span class="badge bg-success float-end"></span>
                    <span> <?php echo $value->nombremenu; ?> </span>
                </a>
                <div class="collapse" id="<?php echo $value->nombremenu; ?>">
                <?php

                        $query2 = "SELECT m.servicio,m.id,m.nombre FROM `menu_reporte` mr 
                        join masterreport m on m.id=mr.masterreport where menu=" . $value->id . ";
                        ";
                        $resultados2 = DB::select($query2);
                        if (sizeof($resultados2) > 0) {
                        ?>
                    <ul class="side-nav-second-level">
                        <li>
                        <?php
                                foreach ($resultados2 as $value2) {
                                    $nom=$value2->nombre;
                                    $a ="";
                                    if ($value2->servicio == 2) {
                                        $a = "siennagraficos?id=" . $value2->id ;
                                    } elseif ($value2->servicio == 1) {
                                        $a = "siennareport?id=" . $value2->id ;
                                    } elseif ($value2->servicio == 3) {
                                        $a = "siennaendpoint?id=" . $value2->id ;
                                    } elseif ($value2->servicio == 4) {
                                        $a = "siennaemail?id=" . $value2->id ;
                                    } elseif ($value2->servicio == 5) {

                                        $a = "siennaabm?id=" . $value2->id ;
                                    } elseif ($value2->servicio == 6) {

                                        $a = "siennaform?id=" . $value2->id ;
                                    }
                                    elseif ($value2->servicio == 9) {

                                        $a = "chat?id=" . $value2->id ;
                                    }

                                    
                                ?>
                                    <li><a target='_self' href="<?php echo $a; ?>"><span id="<?php echo $nom;?> " onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" class="sin" data-key="t-Base"><?php echo $nom;?></span>
                             </a></li>
                            <?php
                                }?>
                        </li>
                        
                      
                    
                       
                    </ul>

                    <?php }?>
                </div>
            </li>
            <?php }}?>











           
           
            
        </ul>
        <!--- End Sidemenu -->

        <!-- Help Box -->
      
        <!-- end Help Box -->

        <div class="clearfix"></div>
    </div>
</div>