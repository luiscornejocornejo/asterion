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
            <li>
                <a href="#" onclick="toggleSubmenu(event)">Abm ▾</a>
                <ul class="submenu">
            <li> <a  href="/siennaabm?id=10"  class="side-nav-link hovering-pan ">
                <i class="uil-book-reader"></i>
                <span>Estudios</span>
            </a></li>
            <li> <a  href="/siennaabm?id=11"  class="side-nav-link hovering-pan ">
                <i class="uil-music"></i>
                <span>Canciones </span>
            </a></li>
            <li> <a  href="/siennaabm?id=12"  class="side-nav-link hovering-pan ">
                <i class="uil-video"></i>
                <span>Videos</span>
            </a></li>
            </ul>
            </li>


            <?php }?>

        </ul>
        <!-- Botón Hamburguesa -->
        <div class="menu-toggle" onclick="toggleMenu()">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </nav>



