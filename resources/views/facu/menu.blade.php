
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

        /* 🔹 Menú principal */
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

        /* 🔹 Links del menú */
        .nav-links {
            list-style: none;
            display: flex;
        }

        .nav-links li {
            margin: 0 15px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 18px;
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
                padding: 10px 0;
            }

            .nav-links.active {
                display: flex;
            }
        }
    </style>


    <!-- Menú -->
    <nav class="navbar">
        <div class="logo">Mi Web</div>
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
            <?php $tipodemenu = session('tipodemenu');?>

        </ul>
        <!-- Botón Hamburguesa -->
        <div class="menu-toggle" onclick="toggleMenu()">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </nav>



