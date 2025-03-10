<style>
        /* Reset básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
        }

        /* 🔹 Estilos del Menú */
        .navbar {
            background-color: #333;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            color: white;
            font-size: 24px;
            font-weight: bold;
        }

        /* 🔹 Estilos de los Links */
        .nav-links {
            list-style: none;
            display: flex;
        }

        .nav-links li {
            position: relative;
            margin: 0 15px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            display: block;
            padding: 10px;
        }

        /* 🔹 Submenú */
        .submenu {
            display: none;
            position: absolute;
            top: 40px;
            left: 0;
            background-color: #444;
            list-style: none;
            width: 150px;
            border-radius: 5px;
            overflow: hidden;
        }

        .submenu li {
            padding: 0;
        }

        .submenu a {
            font-size: 16px;
            padding: 10px;
            display: block;
            color: white;
        }

        .submenu a:hover {
            background-color: #555;
        }

        /* Mostrar submenú al pasar el mouse (en escritorio) */
        .nav-links li:hover .submenu {
            display: block;
        }

        /* 🔹 Botón Hamburguesa */
        .menu-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
        }

        .menu-toggle div {
            width: 30px;
            height: 4px;
            background-color: white;
            margin: 5px 0;
        }

        /* 📱 Estilos para móviles */
        @media (max-width: 768px) {
            .menu-toggle {
                display: flex;
            }

            .nav-links {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 60px;
                left: 0;
                width: 100%;
                background-color: #333;
                text-align: center;
            }

            .nav-links li {
                margin: 0;
                border-bottom: 1px solid #444;
            }

            .nav-links.active {
                display: flex;
            }

            /* Submenú en móviles */
            .submenu {
                position: static;
                background-color: #222;
                display: none;
                width: 100%;
            }

            .nav-links li.show .submenu {
                display: block;
            }
        }
        .menu-toggle {
    z-index: 1100; /* 🔹 Asegura que el botón también esté encima */
    position: relative;
}
    </style>

<?php
$subdomain_tmp = 'localhost';
if (isset($_SERVER['HTTP_HOST'])) {
    $domainParts = explode('.', $_SERVER['HTTP_HOST']);
    $subdomain_tmp =  array_shift($domainParts);
} elseif (isset($_SERVER['SERVER_NAME'])) {
    $domainParts = explode('.', $_SERVER['SERVER_NAME']);
    $subdomain_tmp =  array_shift($domainParts);
}

?>
    <!-- Menú -->
    <nav class="navbar">
        <div class="logo"><?php echo $subdomain_tmp;?></div>
        <ul class="nav-links">
            <li><a href="/"  class="side-nav-link hovering-pan ">
                <i class="uil-dashboard"></i>
                <span> Dashboards </span>
            </a></li>
            <li> <a  href="/canciones"  class="side-nav-link hovering-pan ">
                <i class="uil-music"></i>
                <span>Canciones </span>
            </a></li>
            <li> <a  href="/videos"  class="side-nav-link hovering-pan ">
                <i class="uil-video"></i>
                <span>Videos</span>
            </a></li>
            <li> <a  href="/estudios"  class="side-nav-link hovering-pan ">
                <i class="uil-book-reader"></i>
                <span>Estudios</span>
            </a></li>
            <?php $tipodemenu = session('tipodemenu');
            if(($tipodemenu ==1)or($tipodemenu ==2)){
            ?>

<li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarDashboards2" aria-expanded="false" aria-controls="sidebarDashboards2" class="side-nav-link">
                                <i class="mdi mdi-sitemap-outline"></i>
                                <span class="badge bg-success float-end"></span>
                                <span> ABM </span>
                            </a>
                            <div class="collapse" id="sidebarDashboards2">
                                <ul class="side-nav-second-level">
                                   
                                   
                                    <li>
                                    <a target="_self" href="/siennaabm?id=1602">
                                                <span id="report" onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" class="sin" data-key="t-Base">Canciones</span>
                                            </a>
                                    </li>
                                    <li>
                                    <a target="_self" href="/siennaabm?id=1601">
                                                <span id="report" onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" class="sin" data-key="t-Base">Estucios</span>
                                            </a>
                                    </li>
                                    
            
                                </ul>
                            </div>
                        </li>
           


            <?php }
                    if($tipodemenu =="1"){?>
                        
                       
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarDashboards" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                                <i class="mdi mdi-sitemap-outline"></i>
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
                                    <li>
                                    <a target="_self" href="/siennaabm?id=64">
                                                <span id="report" onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" class="sin" data-key="t-Base">Ws</span>
                                            </a>
                                    </li>
                                    <li>
                                    <a target="_self" href="/siennaabm?id=65">
                                                <span id="report" onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" class="sin" data-key="t-Base">Ws Principal</span>
                                            </a>
                                    </li>
                                    <li>
                                    <a target="_self" href="/siennaabm?id=4">
                                                <span id="report" onmouseover="changeColor(this.id, '#38e991')"  onmouseout="retro(this.id, '#a6e8ff')" class="sin" data-key="t-Base">Bases</span>
                                            </a>
                                    </li>
                                    
            
                                </ul>
                            </div>
                        </li>
                        <?php
                    }?>
            
            <li> <a  href="/salir"  class="side-nav-link hovering-pan ">
            <i class="uil-exit"></i>
            <span>Salir</span>
            </a></li>
        </ul>
        <!-- Botón Hamburguesa -->
        <div class="menu-toggle" onclick="toggleMenu()">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </nav>



