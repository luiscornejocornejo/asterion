

<?php

use Illuminate\Support\Facades\DB;

$categoria = session('categoria');

$query = "SELECT m.nombre as nombremenu,i.nombre as icono,m.id FROM `categoria_menu` cm
join menu m on m.id=cm.menu join icono i on i.id=m.icono WHERE categoria=" . $categoria . ";
";
$resultados = DB::select($query);

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
<div class="h-100 show" id="leftside-menu-container" data-simplebar="init"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: scroll hidden;"><div class="simplebar-content" style="padding: 0px;">
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
    <li class="side-nav-item background-buttons">
        <a  href="/conversations2"  class="side-nav-link hovering-pan ">
            <i class="uil uil-comment-message"></i>
            <span> Conversaciones </span>
        </a>
    </li>
    <?php
if ($categoria == 10) {?>
    <li class="side-nav-item position-absolute fixed-bottom background-buttons">
        <a target='_self'  href="/siennacrearusuarios" class="side-nav-link background-buttons">
            <i class="uil-exit"></i>
            <span> Crear Usuarios </span>
        </a>
    </li>


    <?php   }
    ?>
    <li class="side-nav-item position-absolute fixed-bottom background-buttons">
        <a target='_self'  href="/salir" class="side-nav-link background-buttons">
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

    <?php
       $saliente = session('saliente');

                if($saliente ==1){?>
    <div class="whatsapp" data-bs-toggle="modal" data-bs-target="#warning-alert-modal">
    <i class="mdi mdi-send ms-1" style="font-size: 25px;margin-left: 0.785rem;"></i>
  </div>

<?php }?>
    <div class="clearfix"></div>
</div></div></div></div>

<div class="simplebar-placeholder" style="width: auto; height: 1195px;"></div>
</div>
<div class="simplebar-track simplebar-horizontal" style="visibility: visible;">
<div class="simplebar-scrollbar" style="width: 32px; display: block; transform: translate3d(0px, 0px, 0px);"></div></div>
<div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
<div class="simplebar-scrollbar" style="height: 0px; transform: translate3d(0px, 0px, 0px); display: none;"></div></div></div>
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