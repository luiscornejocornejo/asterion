<div class="navbar-custom topnav-navbar" style="background-color: <?php echo session('empresaMenu'); ?>;">
    <div class="container-fluid detached-nav" style="margin-left:0px;">

        <!-- Topbar Logo -->
        <div class="logo-topbar" style="margin-left:0px;">
            <!-- Logo light -->
            <a href="" class="logo-light">
                <span class="logo-lg">
                    <img src="img/suri5.png" alt="logo" style="width: 150px !important;height: 70px;" >
                </span>
                <span class="logo-sm">
                    <img src="img/suri5.png" alt="small logo" style="width: 150px !important;height: 70px;" >
                </span>
            </a>

            <!-- Logo Dark -->
            <a href="" class="logo-dark">
                <span class="logo-lg">
                    <img src="img/suri5.png" alt="dark logo" style="width: 150px !important;height: 70px;" >
                </span>
                <span class="logo-sm">
                    <img src="img/suri5.png" alt="small logo" style="width: 150px !important;height: 70px;" >
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
          

         
          
        <?php 
           $saliente = session('saliente');

if($saliente ==1){?>
 &nbsp; 
 <li class="notification-list d-none d-sm-inline-block">
    <br>

<button style="background-color: #ffc95c;" type="button" class="btn btn-sm mb-0 " data-bs-toggle="modal" data-bs-target="#warning-alert-modal"><span style="color: #495057;" >Iniciar Conversacion</span></button>

            </li>

 
<?php  }?>
          

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
                    <span> Estado </span>
                </a>
                <div class="collapse" id="sidebarDashboards">
                    <ul class="side-nav-second-level">
                        <li>
                        <a target="_self" href="/estado">
                                    <span id="Estado" onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" class="sin" data-key="t-Base">Estado</span>
                                </a>
                        </li>
                    
                     
                       
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarDashboards3" aria-expanded="false" aria-controls="sidebarDashboards3" class="side-nav-link">
                    <i class="ri-lifebuoy-line"></i>
                    <span class="badge bg-success float-end"></span>
                    <span> Conversacion </span> 
                </a>
                <div class="collapse" id="sidebarDashboards3">
                    <ul class="side-nav-second-level">
                        <li>
                        <a target="_self" href="/conversations2">
                                    <span id="Ticketsc" onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" class="sin" data-key="t-Base">Conversacion</span>
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





<div id="warning-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header " style="background-color:#3c4655">
                <h5 class="modal-title text-white" id="exampleModalLabel">Iniciar Conversacion</h5>
                               
            </div>
            <form id="frmAgregarBienCapitalizable" action="/" method="post"> 
                @csrf

                        <div class="modal-body p-4">
                        <div id="resul"  ></div>

                                        <label  style="  margin: 20px;"  class="form-label"   for="formrow-firstname-input">WhatsApp</label>
                                        <br>
                                        <input size="22" style="margin-right:20;margin-left:20;"   required name="telefono" type="cel" class=" input-lg" id="telefono" placeholder="5491133258450">

                                        <select style="  margin: 20px;"  id="template" >
                                        <?php 

                                                $query22="SELECT id, nombre, url, descripcion FROM template";

                                                $resultados22 = DB::select($query22);
                                                foreach($resultados22 as $val22){
                                                    $url=$val22->url;
                                                    $nombre=$val22->nombre;
                                                    $descripcion=$val22->descripcion;
                                                    echo "<option value='".$url."'>".$nombre."</option>";
                                                }
                                                ?>
                                        </select>
                                        <div  style="  margin: 20px;"  class="alert alert-warning  " role="alert">
                                                        <i class="ri-alert-line me-1 align-middle font-16"></i> Atención - Este proceso puede demorar unos minutos y el usuario debe responder el mensaje enviado.
                                        </div>
                            
                        </div>
                        <div class="modal-footer">
                                <button type="button" class="btn btn-secondary mb-0" data-bs-dismiss="modal">Close</button>
                                <button type="button" style="background-color: #ffc95c;"  class="btn  mb-0 " onclick="mensaje('<?php echo $saliente = session('saliente');?>')"  class="  "><span style="color: #495057;">Iniciar</span></button>
                        </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
            function mensaje(saliente){

                    var tel= document.getElementById("telefono");
                    var telvalor= document.getElementById("telefono").value;
                    if(telvalor==""){
                        var men= document.getElementById("resul");
                     men.innerHTML ='<div data-mdb-delay="3000" class="alert alert-danger" role="alert">   '+
                        '<strong>Error - </strong> El campo Whatsapp es obligatorio.</div>';

                        window.setTimeout(function() {
                        $(".alert").fadeTo(500, 0).slideUp(500, function(){
                            $(this).remove(); 
                        });
                    }, 4000);
                    }else{


                    
                        var url= document.getElementById("template").value;
                      //  var url= "https://publicapi.xenioo.com/broadcasts/uD7SL7UMkUeF878WQ5Jat5vE0KqKjY1sUjVi84xKAI781x0x0yy1EVFpHtS0H9dB/rn5HSrzi9xrvW8ZtVw8yVdiJdqoLdsc7kjybZSRbJpax6TEWL0RyWn8E5meb2e4H/direct";///document.getElementById("template").value;
                    var tel2=tel.value;
                    if(tel2==""){
                        tel2="5491133258450"
                    }
                    console.log(tel2);
                    console.log(url);

                    const xhr = new XMLHttpRequest();
                    urlprincipal2="https://suricata4.com.ar/api/broadcast?url="+url+"&tel2="+tel2+"&token=EDElDqlQf3RDP5EDK1pHhugV9M6aCXtwAm57SD0G5JYZjw7RxwZbbfdKMhWYdUUM";
                    console.log(urlprincipal2);

                    xhr.open("GET", urlprincipal2);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                   
                    xhr.onload = () => {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        console.log(JSON.parse(xhr.responseText));
                    } else {
                        console.log(`Error: ${xhr.status}`);
                    }
                    };
                    xhr.send();

                    var men= document.getElementById("resul");
                     men.innerHTML ='<div data-mdb-delay="3000" class="alert alert-success" role="alert">   '+
                    '<strong>Felicitaciones - </strong>   El mensaje fue enviado correctamente</div>';

                    window.setTimeout(function() {
                    $(".alert").fadeTo(500, 0).slideUp(500, function(){
                        $(this).remove(); 
                    });
                }, 4000);
                }
            }
</script>