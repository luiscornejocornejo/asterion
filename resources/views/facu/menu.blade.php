

<?php

use Illuminate\Support\Facades\DB;

$categoria = session('categoria');

$query = "SELECT m.nombre as nombremenu,i.nombre as icono,m.id FROM `categoria_menu` cm
join menu m on m.id=cm.menu join icono i on i.id=m.icono WHERE categoria=" . $categoria . ";
";
$resultados = DB::select($query);

$querygenerico="select * from siennadepto";
$siennadeptosgenericos = DB::select($querygenerico);

?>
<div class="leftside-menu menuitem-active">

<!-- Brand Logo Light -->
<a href="" class="logo logo-light">
    <span class="logo-lg">
        <img src="assetsfacu/images/logo.svg" alt="logo">
    </span>
    <span class="logo-sm mt-2 ">
        <img style="width: 40px; height: 40px;" src="assetsfacu/images/logo.png" alt="small logo">
    </span>
</a>

<!-- Brand Logo Dark -->
<a href="" class="logo logo-dark">
    <span class="logo-lg">
        <img src="assetsfacu/images/logo-dark.png" alt="dark logo">
    </span>
    <span class="logo-sm">
        <img src="assetsfacu/images/logo-dark-sm.png" alt="small logo">
    </span>
</a>

<!-- Sidebar Hover Menu Toggle Button -->
<div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Show Full Sidebar" data-bs-original-title="Show Full Sidebar">
    <i class="ri-checkbox-blank-circle-line align-middle"></i>
</div>

<!-- Full Sidebar Menu Close Button -->
<div class="button-close-fullsidebar">
    <i class="ri-close-fill align-middle"></i>
</div>

<!-- Sidebar -left -->
<div class="h-100 show" id="leftside-menu-container" data-simplebar="init"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: scroll hidden;"><div class="simplebar-content" style="padding: 0px;background-color: #313a46!important;">
    <!-- Leftbar User -->
    <div class="leftbar-user">
        <a href="pages-profile.html">
            <img src="assetsfacu/images/users/avatar-1.jpg" alt="user-image" height="42" class="rounded-circle shadow-sm">
            <span class="leftbar-user-name mt-2">Dominic Keller</span>
        </a>
    </div>

    <!--- Sidemenu -->
    <ul class="side-nav">
   
      <li class="side-nav-item mt-2 background-buttons">
        <a href="/"  class="side-nav-link hovering-pan ">
            <i class="uil-dashboard"></i>
            <span> Dashboards </span>
     
        </a>
    </li>
    <li class="side-nav-item mt-2 background-buttons">
        <a target="_blank" href="/gpt"  class="side-nav-link hovering-pan ">
            <i class="mdi-robot-happy-outline"></i>
            <span> Gpt </span>
     
        </a>
    </li>
   
   
<?php
 $tipodemenu = session('tipodemenu');
 if($tipodemenu =="8"){?>
    
    <li class="side-nav-item background-buttons">
                    <a  href="/conversations2"  class="side-nav-link hovering-pan ">
                        <i class="mdi mdi-account-multiple"></i>
                        <span> conversaciones </span>
                    </a>
                </li>
    <?php
 }
     if(($tipodemenu =="1")or($tipodemenu =="2")or($tipodemenu =="4")){
     ?>
                <li class="side-nav-item background-buttons">
                <a
                  data-bs-toggle="collapse"
                  href="/supervisor"
                  aria-expanded="false"
                  aria-controls="sidebarDashboards"
                  class="side-nav-link hovering-pan"
                >
                  <i class="uil-ticket"></i>
                  <span>Tickets</span>
                  <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEcommerce">
                  <ul class="side-nav-second-level">
                    <li>
                      <a href="/supervisor">Abiertos</a>
                    </li>
                    <li>
                      <a href="/cerrados">Cerrados</a>
                    </li>
                  </ul>
                </div>
</li>
                <li class="side-nav-item background-buttons">
                    <a  href="/agentes"  class="side-nav-link hovering-pan ">
                        <i class="mdi mdi-account-multiple"></i>
                        <span> Agentes </span>
                    </a>
                </li>
                <li class="side-nav-item background-buttons">
                    <a  href="/siennaabm?id=124"  class="side-nav-link hovering-pan ">
                        <i class="mdi mdi-notebook"></i>
                        <span> Topics </span>
                    </a>
                </li>
                <li class="side-nav-item background-buttons">
                    <a  href="/siennaabm?id=18"  class="side-nav-link hovering-pan ">
                        <i class="mdi mdi-notebook"></i>
                        <span> Motivos cierre </span>
                    </a>
                </li>
                <li class="side-nav-item background-buttons">
                    <a  href="/siennaabm?id=138"  class="side-nav-link hovering-pan ">
                        <i class="mdi mdi-notebook"></i>
                        <span> C-sat </span>
                    </a>
                </li>
               
                <li class="side-nav-item background-buttons">
                    <a  href="/nodes"  class="side-nav-link hovering-pan ">
                        <i class="mdi mdi-radio-tower"></i>
                        <span> Nodos </span>
                    </a>
                </li>   
                <li class="side-nav-item background-buttons">
                    <a  href="/siennaabm?id=135"  class="side-nav-link hovering-pan ">
                        <i class="mdi mdi-radio-tower"></i>
                        <span> Clientes </span>
                    </a>
                </li>   
                
    <?php
     }
    ?>
 <?php
     $tipodemenu = session('tipodemenu');
     if($tipodemenu =="1"){
     ?>
               <li class="side-nav-item background-buttons">
                    <a  href="/conversations2"  class="side-nav-link hovering-pan ">
                        <i class="uil uil-comment-message"></i>
                        <span> Conversaciones </span>
                    </a>
                </li>
                <li class="side-nav-item background-buttons">
                    <a  href="/empresadatos"  class="side-nav-link hovering-pan ">
                        <i class="mdi mdi-cog"></i>
                        <span> Empresa </span>
                    </a>
                </li>
                <li class="side-nav-item background-buttons">
                    <a  href="/siennaabm?id=57"  class="side-nav-link hovering-pan ">
                        <i class="mdi mdi-cog"></i>
                        <span> Categoria </span>
                    </a>
                </li>
                
             
    <?php
     }
    ?>
            
            <?php
     $tipodemenu = session('tipodemenu');
     if($tipodemenu =="4"){
     ?>
           
           <li class="side-nav-item background-buttons">
                    <a  href="/conversations2"  class="side-nav-link hovering-pan ">
                        <i class="uil uil-comment-message"></i>
                        <span> Conversaciones </span>
                    </a>
                </li>
             
    <?php
     }
    ?>
               <?php
     $tipodemenu = session('tipodemenu');
     if($tipodemenu =="3"){
     ?>
           
           <li class="side-nav-item background-buttons">
                <a
                  data-bs-toggle="collapse"
                  href="/operator"
                  aria-expanded="false"
                  aria-controls="sidebarDashboards"
                  class="side-nav-link hovering-pan"
                >
                  <i class="uil-ticket"></i>
                  <span>Tickets</span>
                  <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEcommerce">
                  <ul class="side-nav-second-level">
                    <li>
                      <a href="/operator">Abiertos</a>
                    </li>
                    <li>
                      <a href="/cerrados">Cerrados</a>
                    </li>
                  </ul>
                </div>
</li>
             
    <?php
     }
    ?>



                <li class="side-nav-item background-buttons">
                    <a href="/profile"   class="side-nav-link background-buttons">
                        <i class="uil-user"></i>
                        <span> <?php echo session('nombreusuario');?> </span>
                    </a>    
                </li>
                  <li class="side-nav-item background-buttons">
                      <a  href="/salir" class="side-nav-link background-buttons">
                          <i class="uil-exit"></i>
                          <span> Cerrar sesión </span>
                      </a>    
                  </li>
  

    <?php
if ($categoria == 1) {?>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarDashboards" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span class="badge bg-success float-end"></span>
                    <span> Sienna </span>
                </a>
                <div class="collapse" id="sidebarDashboards">
                    <ul class="side-nav-second-level">
                        <li>
                        <a target="_self" href="/siennai">
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
            <?php 
}?>
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

    <div class="clearfix"></div>
</div></div></div></div>
   
    <?php

       $saliente = 1;

                if($saliente ==1){?>
                 
    



    <!-- End of modal Create Ticket -->

    <!-- Between Modal -->
    <!-- Modal -->

<!-- Modal -->

<?php }?>
   

<div class="simplebar-placeholder" style="width: auto; height: 1195px;"></div>
</div>
<div class="simplebar-track simplebar-horizontal" style="visibility: visible;">
<div class="simplebar-scrollbar" style="width: 32px; display: block; transform: translate3d(0px, 0px, 0px);"></div></div>
<div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
<div class="simplebar-scrollbar" style="height: 0px; transform: translate3d(0px, 0px, 0px); display: none;"></div></div></div>
</div>

