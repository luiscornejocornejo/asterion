
<html  lang="en" data-bs-theme="light" data-layout-mode="fluid" data-menu-color="dark" data-topbar-color="light" data-layout-position="fixed" data-sidenav-size="condensed" class="menuitem-active">
<head>
  <meta charset="utf-8">
  <title>Suricata Cx</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
  <meta content="Coderthemes" name="author">

  <!-- App favicon -->
  <link rel="shortcut icon" href="assetsfacu/images/favicom_suricata.png">

  <!-- Daterangepicker css -->
  <link rel="stylesheet" href="assetsfacu/vendor/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="tt.css">

  <!-- Vector Map css -->
  <link rel="stylesheet" href="assetsfacu/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css">

  <!-- Theme Config Js -->
  <script src="assetsfacu/js/hyper-config.js"></script>
  <script src="js/utils.js"></script>
  <script src="js/Chart.min.js"></script>
  <script src="assets/libs/apexcharts/apexcharts.min.js"></script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
  <!-- App css -->
  <link href="assetsfacu/css/app-saas.min.css" rel="stylesheet" type="text/css" id="app-style">
  <link href="agents.css" rel="stylesheet" type="text/css" id="app-style">

  <!-- Icons css -->
  <link href="assetsfacu/css/icons.min.css" rel="stylesheet" type="text/css">
    <style id="apexcharts-css">
        .background-buttons :hover{
        background-color: #FFD193!important;
        color: #3C4665!important;
        }



    .whatsapp {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9999;
        cursor: pointer;
        color: #fff;
        background-color: #25d366;
        border-radius: 50%;
        text-align: center;
        width: 50px;
        height: 50px;
        line-height: 50px;
        font-size: 16px;
        box-shadow: 2px 2px 3px #999;

    }


    </style>

    <style>
        body {
            margin: 0;            /* Reset default margin */
        }
        iframe {
                /* Reset default border */
            height: 100%;        /* Viewport-relative units */
        /* width: 80vw;*/
            width: 100%;


        z-index: 999;}
        </style>

    <script src="sienna/js/5tickets.js"></script>

</head>
<body class="show" onload="maxid()">


    <script>

    function cerrar(result,dd, ee, ff,cliente){
    document.getElementById("idticketestado20").value = dd;
    document.getElementById("conversation_id20").value = ee;
    document.getElementById("client_number").value = cliente;
    }
    </script>
<div class="wrapper menuitem-active">
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
        <a href="/home?fecha=dia"  class="side-nav-link hovering-pan ">
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






                <li class="side-nav-item background-buttons">
                    <a href="/profile"   class="side-nav-link background-buttons">
                        <i class="uil-user"></i>
                        <span> luis cornejo infitelecom </span>
                    </a>
                </li>
                  <li class="side-nav-item background-buttons">
                      <a  href="/salir" class="side-nav-link background-buttons">
                          <i class="uil-exit"></i>
                          <span> Cerrar sesión </span>
                      </a>
                  </li>



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

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#Menu" aria-expanded="false" aria-controls="Menu" class="side-nav-link">
                    <i class="mdi mdi-home"></i>
                    <span class="badge bg-success float-end"></span>
                    <span> Menu </span>
                </a>
                <div class="collapse" id="Menu">
                                    <ul class="side-nav-second-level">
                        <li>
                                                            <li><a target='_self' href="siennaabm?id=49"><span id="categoria_menu " onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" class="sin" data-key="t-Base">categoria_menu</span>
                             </a></li>
                                                                <li><a target='_self' href="siennaabm?id=47"><span id="menu " onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" class="sin" data-key="t-Base">menu</span>
                             </a></li>
                                                                <li><a target='_self' href="siennaabm?id=48"><span id="sub-menu " onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" class="sin" data-key="t-Base">sub-menu</span>
                             </a></li>
                                                    </li>



                    </ul>

                                    </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#ws-entrantes" aria-expanded="false" aria-controls="ws-entrantes" class="side-nav-link">
                    <i class="mdi mdi-home"></i>
                    <span class="badge bg-success float-end"></span>
                    <span> ws-entrantes </span>
                </a>
                <div class="collapse" id="ws-entrantes">
                                    <ul class="side-nav-second-level">
                        <li>
                                                            <li><a target='_self' href="siennaabm?id=64"><span id="ws-entrantes " onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" class="sin" data-key="t-Base">ws-entrantes</span>
                             </a></li>
                                                                <li><a target='_self' href="siennaabm?id=65"><span id="ws-entrantes-principal " onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" class="sin" data-key="t-Base">ws-entrantes-principal</span>
                             </a></li>
                                                    </li>



                    </ul>

                                    </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#configuracion-ws" aria-expanded="false" aria-controls="configuracion-ws" class="side-nav-link">
                    <i class="mdi mdi-home"></i>
                    <span class="badge bg-success float-end"></span>
                    <span> configuracion-ws </span>
                </a>
                <div class="collapse" id="configuracion-ws">
                                    <ul class="side-nav-second-level">
                        <li>
                                                            <li><a target='_self' href="siennaabm?id=93"><span id="ws_cliente " onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" class="sin" data-key="t-Base">ws_cliente</span>
                             </a></li>
                                                    </li>



                    </ul>

                                    </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#Menu" aria-expanded="false" aria-controls="Menu" class="side-nav-link">
                    <i class="mdi mdi-home"></i>
                    <span class="badge bg-success float-end"></span>
                    <span> Menu </span>
                </a>
                <div class="collapse" id="Menu">
                                    <ul class="side-nav-second-level">
                        <li>
                                                            <li><a target='_self' href="siennaabm?id=49"><span id="categoria_menu " onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" class="sin" data-key="t-Base">categoria_menu</span>
                             </a></li>
                                                                <li><a target='_self' href="siennaabm?id=47"><span id="menu " onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" class="sin" data-key="t-Base">menu</span>
                             </a></li>
                                                                <li><a target='_self' href="siennaabm?id=48"><span id="sub-menu " onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" class="sin" data-key="t-Base">sub-menu</span>
                             </a></li>
                                                    </li>



                    </ul>

                                    </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#Menu" aria-expanded="false" aria-controls="Menu" class="side-nav-link">
                    <i class="mdi mdi-home"></i>
                    <span class="badge bg-success float-end"></span>
                    <span> Menu </span>
                </a>
                <div class="collapse" id="Menu">
                                    <ul class="side-nav-second-level">
                        <li>
                                                            <li><a target='_self' href="siennaabm?id=49"><span id="categoria_menu " onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" class="sin" data-key="t-Base">categoria_menu</span>
                             </a></li>
                                                                <li><a target='_self' href="siennaabm?id=47"><span id="menu " onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" class="sin" data-key="t-Base">menu</span>
                             </a></li>
                                                                <li><a target='_self' href="siennaabm?id=48"><span id="sub-menu " onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" class="sin" data-key="t-Base">sub-menu</span>
                             </a></li>
                                                    </li>



                    </ul>

                                    </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#Menu" aria-expanded="false" aria-controls="Menu" class="side-nav-link">
                    <i class="mdi mdi-home"></i>
                    <span class="badge bg-success float-end"></span>
                    <span> Menu </span>
                </a>
                <div class="collapse" id="Menu">
                                    <ul class="side-nav-second-level">
                        <li>
                                                            <li><a target='_self' href="siennaabm?id=49"><span id="categoria_menu " onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" class="sin" data-key="t-Base">categoria_menu</span>
                             </a></li>
                                                                <li><a target='_self' href="siennaabm?id=47"><span id="menu " onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" class="sin" data-key="t-Base">menu</span>
                             </a></li>
                                                                <li><a target='_self' href="siennaabm?id=48"><span id="sub-menu " onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" class="sin" data-key="t-Base">sub-menu</span>
                             </a></li>
                                                    </li>



                    </ul>

                                    </div>
            </li>

    </ul>
    <!--- End Sidemenu -->




    <div class="whatsapp" data-bs-toggle="modal" data-bs-target="#warning-alert-modal">
    <i class="mdi mdi-send ms-1" style="font-size: 25px;margin-left: 0.785rem!important;"></i>
</div>

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
                <input type="hidden" name="_token" value="7Kxvtu03568OX1spOY3rCgmahk1J1RJd3mahAfgw">
                        <div class="modal-body p-4">
                        <div id="resul"  ></div>

                                        <label  style="  margin: 20px;"  class="form-label"   for="formrow-firstname-input">WhatsApp</label>
                                        <br>
                                        <input size="22" style="margin-right:20;margin-left:20;"   required name="telefono" type="cel" class=" input-lg" id="telefono" placeholder="5491133258450">

                                        <select style="  margin: 20px;"  id="template" >
                                        <option value='https://publicapi.xenioo.com/broadcasts/MEEoUIjLlxedpBG2QrJgTt3QyCrHERM3/afkOdInGxsVN6INSteW9X24ha1voWeBJCdc2o8H6i9d2DIncp99GZVoYa2obMykJ/direct'>Comercial</option><option value='https://publicapi.xenioo.com/broadcasts/MEEoUIjLlxedpBG2QrJgTt3QyCrHERM3/9xO1PcIyGAkK0HOyxXoTL6eSyLZrkjh7JTO21MZium7V62HssR3Gqoy2Iw332QEX/direct'>Facturacion</option><option value='https://publicapi.xenioo.com/broadcasts/MEEoUIjLlxedpBG2QrJgTt3QyCrHERM3/Tc0XsLxay5ZYy8Mv4gyIfQHVULj5JVfTYa2T1k0XUTIkEQ4AZ7yLSvr2LV2WbsHS/direct'>Soporte PL</option><option value='https://publicapi.xenioo.com/broadcasts/MEEoUIjLlxedpBG2QrJgTt3QyCrHERM3/P5zO5suKgRoC8WG4HZVBWK1ciz8WhTvcBpL9Qf4gDee07fuoEyE2M6v54Mg6kNcD/direct'>Soporte SL</option>                                        </select>
                                        <div  style="  margin: 20px;"  class="alert alert-warning  " role="alert">
                                                        <i class="ri-alert-line me-1 align-middle font-16"></i> Atención - Este proceso puede demorar unos minutos y el usuario debe responder el mensaje enviado.
                                        </div>

                        </div>
                        <div class="modal-footer">
                                <button type="button" class="btn btn-secondary mb-0" data-bs-dismiss="modal">Close</button>
                                <button type="button" style="background-color: #ffc95c;"  class="btn  mb-0 " onclick="mensaje('')"  class="  "><span style="color: #495057;">Iniciar</span></button>
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
                    console.log(urlprincipal2.trim());

                    xhr.open("GET", urlprincipal2.trim());
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
<div class="content-page" style="padding: 0!important;">

          <div class="content">

              <!-- Start Content-->

        <div class="container pt-2 ">
            <div class="d-flex justify-content-between pb-2">

                <div>
                                                    <button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm-assign">
                        <i class="mdi mdi-account-arrow-right" data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-custom-class="mb-1" data-bs-title="Asignar ticket"></i>
                    </button>
                                        <button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm-departament">
                        <i class="mdi mdi-account-group" data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-custom-class="mb-1" data-bs-title="Asignar departamento."></i>
                    </button>
                    <button onclick="topic(`ispgroup`,`10763`,`+5492994011455_MEEoUIjLlxedpBG2QrJgTt3QyCrHERM3`,`1`)"
                     class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-smt" >
                        <i class="mdi mdi-notebook" data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-custom-class="mb-1" data-bs-title="Cambiar topic."></i>
                    </button>
                    <button onclick="estado2(`ispgroup`,`10763`,`+5492994011455_MEEoUIjLlxedpBG2QrJgTt3QyCrHERM3`,`1`)"
                     class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm" >
                        <i class="mdi mdi-flag" data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-custom-class="mb-1" data-bs-title="Cambiar estado."></i>
                    </button>
                    <button onclick="cerrar(`ispgroup`,`10763`,`+5492994011455_MEEoUIjLlxedpBG2QrJgTt3QyCrHERM3`,`1`,`002895`)"
                     class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-smcerrar" >
                        <i class="mdi mdi-check-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-custom-class="mb-1" data-bs-title="Cerrar Ticket."></i>
                    </button>


                </div>

            </div>

        </div>
  <!-- Small modal Status-->

      <!-- End modal Status -->


            <div class="row">
                <div class="col-sm-12 col-lg-8 col-xxl-9">
                    <div class="mt-2">
                        <div class="card widget-flat">
                            <div class="card-body">
                              <div class="d-flex justify-content-between">
                                <div>
                                  <h4 class="fw-normal text-dark" title="Number of Customers">Información del Ticket #10763</h4>
                                </div>
                                <div>
                                    <i class="mdi mdi-note-text widget-icon bg-secondary-lighten text-secondary"></i>
                                </div>
                              </div>
                              <hr style="margin-top: 10px;"/>
                              <div class="d-flex justify-content-between">
                                <div>
                                    <div class="mb-1">
                                        <i class="mdi mdi-list-status"></i> <strong>Estado: </strong>Cerrado                                    </div>
                                    <div class="mb-1">
                                        <i class="mdi mdi-office-building"></i> <strong>Departamento: </strong>Soporte                                    </div>
                                    <div class="mb-1">
                                        <i class="mdi mdi-account-voice"></i> <strong>Asignado a: </strong>Javier Curapil                                    </div>

                                </div>

                                <div>
                                    <div class="mb-1">
                                        <i class="mdi mdi-calendar"></i> <strong>Creado: </strong>hace 2 días                                    </div>
                                    <div class="mb-1">
                                        <i class="mdi sienna_source_class"></i> <strong>Fuente: </strong>1                                    </div>
                                    <div class="mb-1">
                                        <i class="mdi mdi-information"></i> <strong>Tema de ayuda: </strong>Consulta Administrativa                                    </div>
                                </div>
                              </div>


                            </div>

                        </div>
                    </div>
                    <iframe src="https://routing.xenioo.com/share/TW1VWGZ2VPSRYR9O5ISZGGY7WDDT33K3" width="100%" class="border rounded-3" style="height: 400px!important;"></iframe>
                    <div class="mt-2">
                        <div class="card widget-flat">
                            <div class="card-body">
                              <div class="d-flex justify-content-between">
                                <div>
                                  <h4 class="fw-normal text-dark" title="Number of Customers">Información de usuario</h4>
                                </div>
                                <div>
                                    <i class="mdi mdi-card-account-details widget-icon bg-secondary-lighten text-secondary"></i>
                                </div>
                              </div>
                              <hr style="margin-top: 10px;"/>
                              <div class="d-flex mt-2">
                                <i class="mdi mdi-card-account-details"></i>&nbsp;Numero cliente:&nbsp;
                                <span class="badge badge-secondary-lighten line-h">
                                002895                                </span>
                              </div>
                              <div class="d-flex  mt-2">
                                <i class="mdi mdi-account"></i>&nbsp;Nombre:&nbsp;
                                <span class="badge badge-secondary-lighten hover-overlay line-h">
                                Castro Carolina                                </span>
                              </div>
                              <div class="d-flex mt-2">
                                <i class="mdi mdi-home"></i>&nbsp;Domicilio:&nbsp;
                                <span class="badge badge-secondary-lighten line-h">
                                PUELEN                                </span>
                              </div>
                              <div class="d-flex mt-2">
                                  <i class="mdi mdi-whatsapp text"></i>&nbsp;Teléfono:&nbsp;
                                  <span class="badge badge-secondary-lighten line-h">
                                  +5492994011455                                  </span>
                                </div>
                                <div class="d-flex mt-2">
                                  <i class="mdi mdi-email"></i>&nbsp;Email:&nbsp;
                                  <span class="badge badge-secondary-lighten line-h">
                                                                    </span>
                                </div>
                                <div class="d-flex mt-2">
                                  <i class="mdi mdi-account-cash"></i>&nbsp;Estado de cuenta:&nbsp;
                                  <span class="badge badge-success-lighten line-h">
                                  Habilitado                                  </span>

                                </div>
                                <div class="d-flex mt-2">
                                  <i class="mdi mdi-antenna"></i>&nbsp;Estado de servicio:&nbsp;
                                  <span class="badge badge-success-lighten line-h">
                                  Normal                                  </span>

                                </div>
                                <div class="d-flex mt-2">
                                    <i class="mdi mdi-switch"></i>&nbsp;Nodo:&nbsp;
                                    <span class="badge badge-secondary-lighten line-h">
                                                                        </span>
                                  </div>
                                <div class="d-flex mt-2">
                                    <i class="mdi mdi-map-marker"></i>&nbsp;IP:&nbsp;
                                    <span class="badge badge-secondary-lighten line-h">
                                                                        </span>
                                  </div>
                                <div class="d-flex mt-2">
                                    <i class="mdi mdi-currency-usd"></i>&nbsp;Deuda:&nbsp;
                                    <span class="badge badge-secondary-lighten line-h">
                                    7300.00                                    </span>
                                  </div>

                              </div>


                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-4 col-xxl-3">
                    <strong>Seguimiento</strong>
                    <hr>
                    <div class="card-body">
                        <!-- end sub tasks/checklists -->
                        <form action="/api/siennacrearseguimiento2" method="POST"  enctype="multipart/form-data">

                                <div class="mt-2 ">
                                <div>
                                        <label class="form-label">Subir archivo</label>
                                        <input name="logo" class="form-control" type="file" id="inputGroupFile04">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Nota interna</label>
                                        <div class="input-group">
                                        <input value="luis cornejo infitelecom" type="hidden" name="logeado" id="logeado">

                                        <input value="10763" type="hidden" name="idticketseguimiento" id="idticketseguimiento">
                                            <input name="comentario" type="text" class="form-control" aria-label="Recipient's username">
                                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-send"></i></button>
                                        </div>
                                    </div>

                                </div>
                        </form>
                            <div class="mt-2">
                                <div class="card-header d-flex justify-content-between align-items-center mt-2">
                                    <h4 class="header-title">Actividad reciente</h4>
                                </div>
                                <div class="card-body py-0 mb-3 mt-3 " style="height: 600px;" data-simplebar="init"><div class="simplebar-wrapper" ><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: auto; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px 24px;">

                                                                                <div class="timeline-alt py-0 " ">
                                                <div class="timeline-item">
                                                    <i class="mdi mdi-ticket-account bg-info-lighten text-info timeline-icon"></i>                                                           <div class="timeline-item-info">
                                                                <span class="text-info fw-bold mb-1 d-block">created</span>
                                                                <small>sistema</small>
                                                                <p class="mb-0 pb-2">
                                                                <small class="text-muted">2024-03-15 10:48:34</small>
                                                                </p>
                                                            <span>
                                                                                                                            </span>
                                                     </div>
                                                </div>
                                                </div>

                                                                                    <div class="timeline-alt py-0 " ">
                                                <div class="timeline-item">
                                                    <i class="mdi mdi-account-group bg-info-lighten text-info timeline-icon"></i>                                                    <div class="timeline-item-info">
                                                                <span class="text-info fw-bold mb-1 d-block">modificar area:Comercial</span>
                                                                <small>luis cornejo infitelecom</small>
                                                                <p class="mb-0 pb-2">
                                                                <small class="text-muted">2024-03-15 11:11:57</small>
                                                                </p>
                                                            <span>
                                                                                                                            </span>
                                                     </div>
                                                </div>
                                                </div>

                                                                                    <div class="timeline-alt py-0 " ">
                                                <div class="timeline-item">
                                                    <i class="mdi mdi-account-group bg-info-lighten text-info timeline-icon"></i>                                                    <div class="timeline-item-info">
                                                                <span class="text-info fw-bold mb-1 d-block">modificar area:Facturación</span>
                                                                <small>luis cornejo infitelecom</small>
                                                                <p class="mb-0 pb-2">
                                                                <small class="text-muted">2024-03-15 11:12:08</small>
                                                                </p>
                                                            <span>
                                                                                                                            </span>
                                                     </div>
                                                </div>
                                                </div>

                                                                                    <div class="timeline-alt py-0 " ">
                                                <div class="timeline-item">
                                                    <i class="mdi mdi-flag bg-primary-lighten text-primary timeline-icon"></i>                                                    <div class="timeline-item-info">
                                                                <span class="text-info fw-bold mb-1 d-block">cambio estado Progreso</span>
                                                                <small>luis cornejo infitelecom</small>
                                                                <p class="mb-0 pb-2">
                                                                <small class="text-muted">2024-03-15 11:30:20</small>
                                                                </p>
                                                            <span>
                                                                                                                            </span>
                                                     </div>
                                                </div>
                                                </div>

                                                                                    <div class="timeline-alt py-0 " ">
                                                <div class="timeline-item">
                                                    <i class="mdi mdi-comment-text bg-info-lighten text-info timeline-icon"></i>                                                    <div class="timeline-item-info">
                                                                <span class="text-info fw-bold mb-1 d-block">CASTRO CAROLINA- PUELEN// SIN SERVICIO</span>
                                                                <small>Francis Fernandez</small>
                                                                <p class="mb-0 pb-2">
                                                                <small class="text-muted">2024-03-15 11:35:02</small>
                                                                </p>
                                                            <span>
                                                                                                                            </span>
                                                     </div>
                                                </div>
                                                </div>

                                                                                    <div class="timeline-alt py-0 " ">
                                                <div class="timeline-item">
                                                    <i class="mdi mdi-account-group bg-info-lighten text-info timeline-icon"></i>                                                    <div class="timeline-item-info">
                                                                <span class="text-info fw-bold mb-1 d-block">modificar area:Soporte</span>
                                                                <small>Francis Fernandez</small>
                                                                <p class="mb-0 pb-2">
                                                                <small class="text-muted">2024-03-15 11:35:40</small>
                                                                </p>
                                                            <span>
                                                                                                                            </span>
                                                     </div>
                                                </div>
                                                </div>

                                                                                    <div class="timeline-alt py-0 " ">
                                                <div class="timeline-item">
                                                    <i class="mdi mdi-flag bg-primary-lighten text-primary timeline-icon"></i>                                                    <div class="timeline-item-info">
                                                                <span class="text-info fw-bold mb-1 d-block">cambio estado Cerrado</span>
                                                                <small>luis cornejo infitelecom</small>
                                                                <p class="mb-0 pb-2">
                                                                <small class="text-muted">2024-03-15 11:49:20</small>
                                                                </p>
                                                            <span>
                                                                                                                            </span>
                                                     </div>
                                                </div>
                                                </div>

                                                                                    <div class="timeline-alt py-0 " ">
                                                <div class="timeline-item">
                                                    <i class="mdi mdi-flag bg-primary-lighten text-primary timeline-icon"></i>                                                    <div class="timeline-item-info">
                                                                <span class="text-info fw-bold mb-1 d-block">cambio estado Progreso</span>
                                                                <small>luis cornejo infitelecom</small>
                                                                <p class="mb-0 pb-2">
                                                                <small class="text-muted">2024-03-15 11:49:29</small>
                                                                </p>
                                                            <span>
                                                                                                                            </span>
                                                     </div>
                                                </div>
                                                </div>

                                                                                    <div class="timeline-alt py-0 " ">
                                                <div class="timeline-item">
                                                    <i class="mdi mdi-account-voice bg-primary-lighten text-primary timeline-icon"></i>                                                    <div class="timeline-item-info">
                                                                <span class="text-info fw-bold mb-1 d-block">asignarse </span>
                                                                <small>Javier Curapil</small>
                                                                <p class="mb-0 pb-2">
                                                                <small class="text-muted">2024-03-15 12:47:35</small>
                                                                </p>
                                                            <span>
                                                                                                                            </span>
                                                     </div>
                                                </div>
                                                </div>

                                                                                    <div class="timeline-alt py-0 " ">
                                                <div class="timeline-item">
                                                    <i class="mdi mdi-comment-text bg-info-lighten text-info timeline-icon"></i>                                                    <div class="timeline-item-info">
                                                                <span class="text-info fw-bold mb-1 d-block">SIN SERVICIO- LLEGAMOS DE FORMA REMOTA- REINICIAMOS ANTENA- LEVANTO-</span>
                                                                <small>Javier Curapil</small>
                                                                <p class="mb-0 pb-2">
                                                                <small class="text-muted">2024-03-15 12:47:58</small>
                                                                </p>
                                                            <span>
                                                                                                                            </span>
                                                     </div>
                                                </div>
                                                </div>

                                                                                    <div class="timeline-alt py-0 " ">
                                                <div class="timeline-item">
                                                    <i class="mdi mdi-flag bg-primary-lighten text-primary timeline-icon"></i>                                                    <div class="timeline-item-info">
                                                                <span class="text-info fw-bold mb-1 d-block">cambio estado Cerrado</span>
                                                                <small>Javier Curapil</small>
                                                                <p class="mb-0 pb-2">
                                                                <small class="text-muted">2024-03-15 12:48:15</small>
                                                                </p>
                                                            <span>
                                                                                                                            </span>
                                                     </div>
                                                </div>
                                                </div>

                                                                                    <div class="timeline-alt py-0 " ">
                                                <div class="timeline-item">
                                                    <i class="mdi mdi-comment-text bg-info-lighten text-info timeline-icon"></i>                                                    <div class="timeline-item-info">
                                                                <span class="text-info fw-bold mb-1 d-block"></span>
                                                                <small>luis cornejo infitelecom</small>
                                                                <p class="mb-0 pb-2">
                                                                <small class="text-muted">2024-03-15 18:39:08</small>
                                                                </p>
                                                            <span>
                                                                                                                            <button onclick="ng(`https://sienamedia.sfo3.digitaloceanspaces.com/ispgroup/seguimientos/P2FdrZ95vEL3xeI03DiaaShSafTdSrJMTHY2yQ3K.jpg`)"
                                                                class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#bs-example-modal-img" >
                                                                    <i class="mdi mdi-notebook" data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    data-bs-custom-class="mb-1" data-bs-title="Img."></i>
                                                            </button>
                                                                                                                        </span>
                                                     </div>
                                                </div>
                                                </div>


                            </div></div></div><div class="simplebar-placeholder" style="width: auto; height: 353px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 281px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div> <!-- end slimscroll -->
                            </div>
            </div> <!-- end row-->
                </div>
            </div>
              <!-- container -->
        </div>
          <!-- content -->
      </div>



        <!-- Departament modal Status-->

      <!-- End modal Status -->

        <!-- Departament modal Status-->

      <!-- End modal Status -->



      <!-- Modal Reclamo Ticket -->

</div>
<!-- /.modal -->

      <!-- End Reclamo Ticket -->

<!-- /.modal-topic -->

<div class="modal fade" id="bs-example-modal-sm-assign" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header bg-dark text-white">
                                    <h4 class="modal-title" id="mySmallModalLabel">Asignar Ticket</h4>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/api/pedir2" method="POST">
                                        <input value="10763" type="hidden" name="idticketpedir" id="idticketpedir2">
                                        <input value="luis cornejo infitelecom" type="hidden" name="logeado" id="logeado">

                                            <div class="mt-3">

                                                <div v-for="department in departments ">
                                                                                                            <input value="2" class="form-radio" type="radio" name="usuarioticket">&nbsp;
                                                    <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">fede Weidemann</span>
                                                        <br><br>

                                                                                                            <input value="79" class="form-radio" type="radio" name="usuarioticket">&nbsp;
                                                    <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">luis cornejo</span>
                                                        <br><br>

                                                                                                            <input value="80" class="form-radio" type="radio" name="usuarioticket">&nbsp;
                                                    <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">facundo paez</span>
                                                        <br><br>

                                                                                                            <input value="91" class="form-radio" type="radio" name="usuarioticket">&nbsp;
                                                    <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">Eduardo Coplo</span>
                                                        <br><br>

                                                                                                            <input value="92" class="form-radio" type="radio" name="usuarioticket">&nbsp;
                                                    <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">Irina Galfrascoli</span>
                                                        <br><br>

                                                                                                            <input value="93" class="form-radio" type="radio" name="usuarioticket">&nbsp;
                                                    <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">Luciana Olguin</span>
                                                        <br><br>

                                                                                                            <input value="94" class="form-radio" type="radio" name="usuarioticket">&nbsp;
                                                    <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">Rocio Molina</span>
                                                        <br><br>

                                                                                                            <input value="95" class="form-radio" type="radio" name="usuarioticket">&nbsp;
                                                    <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">Brian Arena</span>
                                                        <br><br>

                                                                                                            <input value="96" class="form-radio" type="radio" name="usuarioticket">&nbsp;
                                                    <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">Damian Muñoz</span>
                                                        <br><br>

                                                                                                            <input value="97" class="form-radio" type="radio" name="usuarioticket">&nbsp;
                                                    <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">Francis Fernandez</span>
                                                        <br><br>

                                                                                                            <input value="98" class="form-radio" type="radio" name="usuarioticket">&nbsp;
                                                    <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">Jazmin Martinez</span>
                                                        <br><br>

                                                                                                            <input value="99" class="form-radio" type="radio" name="usuarioticket">&nbsp;
                                                    <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">Jesica Leineker</span>
                                                        <br><br>

                                                                                                            <input value="100" class="form-radio" type="radio" name="usuarioticket">&nbsp;
                                                    <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">Raul Farias</span>
                                                        <br><br>

                                                                                                            <input value="101" class="form-radio" type="radio" name="usuarioticket">&nbsp;
                                                    <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">Lorenzo Moiola</span>
                                                        <br><br>

                                                                                                            <input value="102" class="form-radio" type="radio" name="usuarioticket">&nbsp;
                                                    <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">Lucas Viñoly</span>
                                                        <br><br>

                                                                                                            <input value="103" class="form-radio" type="radio" name="usuarioticket">&nbsp;
                                                    <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">Rafael Galarza</span>
                                                        <br><br>

                                                                                                            <input value="104" class="form-radio" type="radio" name="usuarioticket">&nbsp;
                                                    <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">Admin User</span>
                                                        <br><br>

                                                                                                            <input value="105" class="form-radio" type="radio" name="usuarioticket">&nbsp;
                                                    <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">Soporte Segunda Linea</span>
                                                        <br><br>

                                                                                                            <input value="106" class="form-radio" type="radio" name="usuarioticket">&nbsp;
                                                    <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">Javier Curapil</span>
                                                        <br><br>

                                                                                                            <input value="107" class="form-radio" type="radio" name="usuarioticket">&nbsp;
                                                    <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">Mariana Villagra</span>
                                                        <br><br>

                                                                                                            <input value="108" class="form-radio" type="radio" name="usuarioticket">&nbsp;
                                                    <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">Tamara Villagra</span>
                                                        <br><br>

                                                                                                            <input value="109" class="form-radio" type="radio" name="usuarioticket">&nbsp;
                                                    <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">Franco Calbucoy</span>
                                                        <br><br>

                                                                                                            <input value="110" class="form-radio" type="radio" name="usuarioticket">&nbsp;
                                                    <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">Martin Rodriguez</span>
                                                        <br><br>

                                                                                                            <input value="113" class="form-radio" type="radio" name="usuarioticket">&nbsp;
                                                    <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">Rodrigo Miller</span>
                                                        <br><br>

                                                                                                            <input value="114" class="form-radio" type="radio" name="usuarioticket">&nbsp;
                                                    <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">Nayadet Loreto</span>
                                                        <br><br>

                                                                                                            <input value="115" class="form-radio" type="radio" name="usuarioticket">&nbsp;
                                                    <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">Florencia Zubieta</span>
                                                        <br><br>

                                                                                                            <input value="116" class="form-radio" type="radio" name="usuarioticket">&nbsp;
                                                    <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">German Vera</span>
                                                        <br><br>

                                                                                                    </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-success">Asignar</button>
                                                </form>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
</div>        <div id="standard-modal-reclamo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="dark-header-modalLabel" aria-hidden="true">
           <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h4 class="modal-title text-light" id="dark-header-modalLabel">Reclamar ticket</h4>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>


                    <div class="modal-body">
                        ¿Deseas reclamar este ticket?
                    </div>
                    <div class="modal-footer">
                    <form action="/api/pedir" method="POST">
                                <input value="10763" type="hidden" name="idticketpedir" id="idticketpedir">
                                <input value="1" type="hidden" name="usuarioticket" id="usuarioticket">
                                <input value="luis cornejo infitelecom" type="hidden" name="logeado" id="logeado">

                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-success">Si, reclamar</button>
                    </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
</div>        <div class="modal fade" id="bs-example-modal-smt" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h4 class="modal-title" id="mySmallModalLabel">Cambiar Topic</h4>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/topiccambiar" method="post">
                            <input type="hidden" name="_token" value="7Kxvtu03568OX1spOY3rCgmahk1J1RJd3mahAfgw">                            <input type="hidden" name="tik" id="idticketestado3" value="">
                            <input value="ispgroup" type="hidden" name="idbot" id="idbot">

                            <div id="estunico2"></div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success">Cambiar</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
</div>        <div class="modal fade" id="bs-example-modal-sm-departament" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h4 class="modal-title" id="mySmallModalLabel">Cambiar Area</h4>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/api/cambiardeptosienna2" method="post">
                            <input type="hidden" name="_token" v-bind:value="csrf">
                            <input value="+5492994011455_MEEoUIjLlxedpBG2QrJgTt3QyCrHERM3" type="hidden" name="idconv" id="idconv">
                            <input value="luis cornejo infitelecom" type="hidden" name="logeado" id="logeado">
                            <input value="" type="hidden" name="user_id" id="user_id">
                            <input value="ispgroup" type="hidden" name="idbot" id="idbot">
                            <input value="10763"  type="hidden" name="idticketdepto" id="idticketdepto">
                            <input value="" type="hidden" name="bot_channel" id="bot_channel">

                            <input  type="hidden" name="merchant" id="merchant" value=" ispgroup ">

                            <div v-for="department in departments ">
                                                            <input value="1" class="form-radio" type="radio" name="statos">&nbsp;
                            <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">Soporte</span>
                                <br><br>

                                                                <input value="2" class="form-radio" type="radio" name="statos">&nbsp;
                            <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">Facturación</span>
                                <br><br>

                                                                <input value="3" class="form-radio" type="radio" name="statos">&nbsp;
                            <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">Comercial</span>
                                <br><br>

                                                                <input value="4" class="form-radio" type="radio" name="statos">&nbsp;
                            <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">Soporte Grandes Clientes</span>
                                <br><br>

                                                                <input value="5" class="form-radio" type="radio" name="statos">&nbsp;
                            <span class=" fw-bold" style="color: #98a6ad;font-size: 12px;">Supervisión Técnica</span>
                                <br><br>


                                                </div>
                            <button type="submit" class="btn btn-success
                                        waves-effect waves-light">Cambiar</button>

                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
</div>        <div class="modal fade" id="bs-example-modal-smcerrar" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h4 class="modal-title" id="mySmallModalLabel">Cerrar ticket</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form method="post" action="/ventasstatus">
                    <div class="modal-body">
                        ¿Está seguro de cerrar el ticket?
                        <label for="client_number" class="form-label">Por favor agrega el número de cliente correspondiente del usuario :</label>
                    <input required type="number" class="form-control" name="client_number" id="client_number">

                    </div>
                    <div class="modal-footer">
                    <input type="hidden" name="_token" value="7Kxvtu03568OX1spOY3rCgmahk1J1RJd3mahAfgw">                            <input type="hidden" name="tik" id="idticketestado20" value="">
                            <input type="hidden" name="idconv" id="conversation_id20" value="">
                            <input type="hidden" name="estado" id="es" value="4">
                            <input value="ispgroup" type="hidden" name="idbot" id="idbot">
                            <input value="WhatsAppChannel" type="hidden" name="bot_channel" id="bot_channel">


                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Si, cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>        <div class="modal fade" id="bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h4 class="modal-title" id="mySmallModalLabel">Estado de Ticket</h4>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/ventasstatus" method="post">
                            <input type="hidden" name="_token" value="7Kxvtu03568OX1spOY3rCgmahk1J1RJd3mahAfgw">                            <input type="hidden" name="tik" id="idticketestado2" value="">
                            <input type="hidden" name="idconv" id="conversation_id2" value="">
                            <input value="ispgroup" type="hidden" name="idbot" id="idbot">
                            <input value="WhatsAppChannel" type="hidden" name="bot_channel" id="bot_channel">

                            <div id="estunico"></div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success">Cambiar</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
</div>        <div id="bs-example-modal-img" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="dark-header-modalLabel" aria-hidden="true">
           <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h4 class="modal-title text-light" id="dark-header-modalLabel">Archivo</h4>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>


                    <div class="modal-body" id="vista2">

                    </div>
                    <div class="modal-footer">

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
</div><script>
function topic(result,dd, ee, ff) {

        document.getElementById("idticketestado3").value = dd;
        url = "https://"+result+".suricata.cloud/api/topicxdepto?depto=" + ff;
        axios.get(url)
        .then(function (response) {
            // función que se ejecutará al recibir una respuesta
            console.log(response.data);
            dato = "";
            for (i = 0; i < response.data.length; i++) {
                console.log(response.data[i].id);
                console.log(response.data[i].nombre);
                dato += ' <div class="mt-3">' +
                    '<div class="form-check mb-2">' +
                    ' <input type="radio" id="customRadio' + response.data[i].id + '" name="estado" value="' + response.data[i].id + '"  class="form-check-input">' +
                    '<label class="form-check-label" for="customRadio' + response.data[i].id + '">' + response.data[i].nombre + '</label>' +
                    '</div>' +
                    ' </div>';
            }
            document.getElementById("estunico2").innerHTML = dato;
        })
        .catch(function (error) {
            // función para capturar el error
            console.log(error);
        })
        .then(function () {
            // función que siempre se ejecuta
        });


}
function ng(ruta) {
    document.getElementById('vista2').innerHTML = "";
   // document.getElementById('vista').src = dd;
   // g='<iframe allow="camera;microphone"  src="'+dd+'" width="100%" height="800px" class="border rounded-3" style="height:400px !important"></iframe>';
   g='<embed src="'+ruta+'" type="" width="180" height="auto" quality="high" wmode="transparent">'
    document.getElementById('vista2').innerHTML = g;
}
</script>
<!-- /.modal-topic -->



    <!-- End Solicita numero de cliente -->



      <!-- ============================================================== -->
      <!-- End Page content -->
      <!-- ============================================================== -->

  </div>








</div>
</div>
    <br><br><br>



</div>

    <!-- Theme Settings -->


  <!-- Vendor js -->
  <script src="assetsfacu/js/vendor.min.js"></script>

  <link href="assetsfacu/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
  <link href="assetsfacu/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />

  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>


    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.dataTables.min.css"></script>


    <script type="text/javascript">
   new DataTable('#example', {
    "responsive": true,

  "language" : {
    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
  },
  dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
}
)
    </script>
  <!-- Daterangepicker js -->
  <script src="assetsfacu/vendor/daterangepicker/moment.min.js"></script>
  <script src="assetsfacu/vendor/daterangepicker/daterangepicker.js"></script>

  <!-- Apex Charts js -->

  <!-- Vector Map js -->

  <!-- Dashboard App js -->

  <!-- App js -->
  <script src="assetsfacu/js/app.min.js"></script>




<svg id="SvgjsSvg1001" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;"><defs id="SvgjsDefs1002"></defs><polyline id="SvgjsPolyline1003" points="0,0"></polyline><path id="SvgjsPath1004" d="M0 0 "></path></svg><div class="daterangepicker ltr single opensright"><div class="ranges"></div><div class="drp-calendar left single" style="display: block;"><div class="calendar-table"></div><div class="calendar-time" style="display: none;"></div></div><div class="drp-calendar right" style="display: none;"><div class="calendar-table"></div><div class="calendar-time" style="display: none;"></div></div><div class="drp-buttons"><span class="drp-selected"></span><button class="cancelBtn btn btn-sm btn-default" type="button">Cancel</button><button class="applyBtn btn btn-sm btn-primary" disabled="disabled" type="button">Apply</button> </div></div><div class="jvectormap-label"></div>



</body>
</html>
