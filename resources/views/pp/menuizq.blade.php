<?php

use Illuminate\Support\Facades\DB;

$categoria =  session('categoria');
$query = "SELECT m.nombre as nombremenu,i.nombre as icono,m.id FROM `categoria_menu` cm 
join menu m on m.id=cm.menu join icono i on i.id=m.icono WHERE categoria=" . $categoria . ";
";
$resultados = DB::select($query);
?> 
<div data-simplebar class="h-100" style="background-color: <?php echo session('empresaMenu');?>;">

    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title" data-key="t-menu">Menu</li>
            <li>
                <a target="_self" href="/">
                    <i data-feather="home"></i>
                    <span data-key="t-dashboard">Dashboard</span>
                </a>
            </li>

            <?php
            if ($categoria == 1) { ?>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="tool"></i>
                        <span data-key="t-apps">Configuracion</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a target="_self" href="/siennaabm?id=4">
                                <span data-key="t-Base">Bases</span>
                            </a>
                        </li>

                        <li>
                            <a target="_self" href="/siennaabm?id=22">
                                <span data-key="t-chat">Roles</span>
                            </a>
                        </li>
                        <li>
                            <a target="_self" href="/siennaabm?id=15">
                                <span data-key="t-chat">Conversion</span>
                            </a>
                        </li>
                        <li>
                            <a target="_self" href="/dashboard" data-key="t-login">Dashboard </a>


                        </li>


                        <li><a target="_self" href="/Menu" data-key="t-login">Menu</a></li>


                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="cpu"></i>
                        <span data-key="t-authentication">Sienna</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a target="_self" href="/sienna">
                                <span data-key="t-chat">Sienna</span>
                            </a>
                        </li>

                        
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="users"></i>
                                <span data-key="t-authentication">Usuarios</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a target="_self" href="/siennaabm?id=13" data-key="t-login">Lista</a></li>

                            </ul>
                        </li>

                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="file-text"></i>
                        <span data-key="t-pages">Reporting</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a target="_self" href="/siennamenu?id=1" data-key="t-basic-tables">Reporting</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="database"></i>
                        <span data-key="t-pages">ABM</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a target="_self" href="/siennamenu?id=5" data-key="t-basic-tables">ABM</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="pie-chart"></i>
                        <span data-key="t-charts">Charts</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a target="_self" href="/siennamenu?id=2" data-key="t-apex-charts">Graficos</a></li>

                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="sliders"></i>
                        <span data-key="t-tables">Endpoints</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                     
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="divide"></i>
                                <span data-key="t-authentication">Endpoints-Salientes</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a target="_self" href="/siennaabm?id=40" data-key="t-login">Erp</a></li>
                                <li><a target="_self" href="/siennaabm?id=39" data-key="t-login">Clientes</a></li>

                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i data-feather="divide"></i>
                                <span data-key="t-authentication">Endpoints-Entrantes</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a target="_self" href="/siennamenu?id=3" data-key="t-login">Lista</a></li>

                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="mail"></i>
                        <span data-key="t-tables">Email</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a target="_self" href="/siennamenu?id=4" data-key="t-basic-tables">Lista</a></li>
                        <li><a target="_self" href="/configurarmail" data-key="t-basic-tables">Configurar-envios</a></li>

                    </ul>
                </li>

            <?php } ?>

<?php if($categoria==3)
{?>
 <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="tool"></i>
                        <span data-key="t-apps">Ordenes</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a target="_self" href="/pagos">
                                <span data-key="t-Base">Pagos</span>
                            </a>
                        </li>
                    </ul>
</li>
<?php

}?>


            <?php
            if (sizeof($resultados) > 0) {

                foreach ($resultados as $value) {

            ?>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="<?php echo $value->icono; ?>"></i>
                            <span data-key="t-apps"><?php echo $value->nombremenu; ?></span>
                        </a>

                        <?php

                        $query2 = "SELECT m.servicio,m.id,m.nombre FROM `menu_reporte` mr 
        join masterreport m on m.id=mr.masterreport where menu=" . $value->id . ";
        ";
                        $resultados2 = DB::select($query2);
                        if (sizeof($resultados2) > 0) {
                        ?>
                            <ul class="sub-menu" aria-expanded="false">

                                <?php
                                foreach ($resultados2 as $value2) {
                                    if ($value2->servicio == 2) {
                                        $a = "<a target='_self' href='/siennagraficos?id=" . $value2->id . "'><span>" . $value2->nombre . "</span></a>";
                                    } elseif ($value2->servicio == 1) {
                                        $a = "<a target='_self' href='/siennareport?id=" . $value2->id . "'><span>" . $value2->nombre . "</span></a>";
                                    } elseif ($value2->servicio == 3) {
                                        $a = "<a target='_self' href='/siennaendpoint?id=" . $value2->id . "'><span>" . $value2->nombre . "</span></a>";
                                    } elseif ($value2->servicio == 4) {
                                        $a = "<a target='_self' href='/siennaemail?id=" . $value2->id . "'><span>" . $value2->nombre . "</span></a>";
                                    } elseif ($value2->servicio == 5) {

                                        $a = "<a target='_self' href='/siennaabm?id=" . $value2->id . "'><span>" . $value2->nombre . "</span></a>";
                                    } elseif ($value2->servicio == 6) {

                                        $a = "<a target='_self' href='/siennaform?id=" . $value2->id . "'><span>" . $value2->nombre . "</span></a>";
                                    }
                                    elseif ($value2->servicio == 9) {

                                        $a = "<a target='_self' href='/chat?id=" . $value2->id . "'><span>" . $value2->nombre . "</span></a>";
                                    }
                                ?>
                                    <li><?php echo $a; ?></li>
                            <?php
                                }
                                echo "</ul>";
                            }

                            ?>

                    </li>
            <?php

                }
            }
            ?>
            <!-- 
            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i data-feather="calendar"></i>
                    <span data-key="t-authentication">Calendario</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a target="_self" href="/calendario" data-key="t-login">Calendario</a></li>
                </ul>


            </li>

 -->






        </ul>
    </div>
    <!-- Sidebar -->
</div>