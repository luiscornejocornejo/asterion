<?php

if (isset($resultadoscliente[0]->cliente)) {
} else {
    return '';
}
if($subdomain_tmp=="wiber2"){
    $subdomain_tmp="wiber";
}

function conectar($id)
    {
        $query = "SELECT * FROM `base`    where id='" . $id . "'";
        $resultados = DB::select($query);
        foreach ($resultados as $value) {

            $host = $value->host;
            $base = $value->base;
            $usuario = $value->usuario;
            $pass = $value->pass;
        }
        config(['database.connections.mysql2.host' => $host]);
        config(['database.connections.mysql2.database' => $base]);
        config(['database.connections.mysql2.username' => $usuario]);
        config(['database.connections.mysql2.password' => $pass]);
    }
$queryws = "SELECT * from ispcube2.ws_cliente where nombre='" . $subdomain_tmp . "'";
        $baseget="14";
        $prueba = conectar($baseget);
        $resultadosws = DB::connection('mysql2')->select($queryws);

        foreach ($resultadosws as $value) {

            $tokensienna = $value->tokensienna;
            $urilogin = $value->urilogin;
        }
        //http://giles.suricata2.com.ar/api/gettickets?token=thecrisPela&codcli=028842
        //echo $urlll="https://".$subdomain_tmp.".suricata2.com.ar/api/gettickets?token=".$tokensienna."&codcli=" . $resultadoscliente[0]->cliente;
 $ticerp= file_get_contents("https://".$subdomain_tmp.".suricata2.com.ar/api/gettickets?token=".$tokensienna."&codcli=" . $resultadoscliente[0]->cliente);
$ticerp2=json_decode($ticerp, true);
$categorias= file_get_contents("https://".$subdomain_tmp.".suricata2.com.ar/api/categories?token=".$tokensienna."");
$categorias2=json_decode($categorias, true);


$getdata= file_get_contents("https://".$subdomain_tmp.".suricata2.com.ar/api/ws?token=".$tokensienna."&codcli=" . $resultadoscliente[0]->cliente);
$getdata2 = json_decode($getdata, true);
$getdata3 = json_encode($getdata2, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

?>
<div class="card widget-flat" id="infoUser">
    <div class="card-body">

        <div style="background-color: #6D0078;" class="d-flex justify-content-end">
            <div class="me-2">
                <img src="https://files.readme.io/a2839ba-small-ISPKeeper_Logo_Oficial_Horizontal_white.png"
                    alt="ispkeeper logo" height="55">
            </div>
        </div>
        <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
            <li class="nav-item">
                <a href="#ticket" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 active">
                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                    <span class="d-none d-md-block">Tickets</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#data" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                    <i class="mdi mdi-account-circle d-md-none d-block"></i>
                    <span class="d-none d-md-block">Datos</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#extra" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                    <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                    <span class="d-none d-md-block">Extra</span>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane show active" id="ticket">

                <form method="post" action="api/crearispcube">
                    @csrf
                    <input type="hidden" name="tokensienna" value="<?php echo $tokensienna;?>"/>
                    <input type="hidden" name="dom" value="<?php echo $subdomain_tmp;?>"/>
                    <div class="row">
                        <div class="col-xxl-2 col-xl-2 col-lg-2 col-sm-12 mb-2">
                            <label for="example-textarea" class="form-label">Cliente</label>
                            <input required name="cliente" type="text" class="form-control" id="lastNameUser"
                                value="<?php echo $resultadoscliente[0]->cliente; ?>">
                            
                        </div>
                        <div class="col-xxl-2 col-xl-2 col-lg-2 col-sm-12 mb-2">
                            <label for="example-textarea" class="form-label">Conexion</label>
                            <input required name="conexion" type="text" class="form-control" id="lastNameUser"
                                value="">
                            
                        </div>
                        <div class="col-xxl-5 col-xl-5 col-lg-5 col-sm-12 mb-2">
                            <label for="agent" class="form-label">Categorias:</label>
                            <select class="form-select js-example-basic-single" name="usuarios" id="agent">

                                <?php for($i=0;$i<sizeof($categorias2);$i++){
                                        ?>
                                <option value="{{ $categorias2[$i]['id'] }}">
                                    {{ $categorias2[$i]['name'] }}
                                </option>
                                <?php }
                                    
                                    ?>
                            </select>
                        </div> 
                       
                           
                      
                        <div class="mb-2">
                            <label for="example-textarea" class="form-label">Descripcion</label>
                            <textarea name="detalle" class="form-control" id="example-textarea" rows="4"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-3 mb-2">Crear Ticket</button>
                    <hr class="mx-1" />
                </form>

                <?php if(isset($ticerp2[0]['id'])){?>
                <table id="casadepapel" class="table table-striped dt-responsive nowrap w-100 text-light">
                    <thead>
                        <tr class="text-center bg-dark">
                            <th class="text-light">ticket_id</th>
                            <th class="text-light">ticket_dia</th>
                            <th class="text-light">ticket_estado</th>
                            <th class="text-light">ticket_subcategoria</th>
                        </tr>
                    </thead>
                    <tbody id="log">
                        <?php

                        for($i=0;$i<sizeof($ticerp2);$i++){
                                        ?>
                        <tr class="text-center">
                            <td><a target='_blank' href='<?php echo $urilogin;?>{{ $ticerp2[$i]['id'] }}'>{{ $ticerp2[$i]['id'] }}</a> </td>
                            <td>{{ $ticerp2[$i]['visit_date'] }}
                            </td>
                            <td> <?php echo $ticerp2[$i]['ticket_status']['name']; ?> </td>
                            <td> <?php echo $ticerp2[$i]['ticket_category']['name']; ?> </td>



                        </tr>
                        <?php }?>

                    </tbody>
                </table>

                <?php }?>


            </div>
            <div class="tab-pane " id="data">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/styles/monokai.min.css">
                <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/highlight.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/languages/json.min.js"></script>
                <pre><code class="json">{{ $getdata3 }}</code></pre>

                                        <script>
                    hljs.highlightAll();
                </script>
                </div>
            <div class="tab-pane" id="extra">
                <div data-tf-live="01JDFRQDH03PQAH7HE59FRXFB0"></div>
                <script src="//embed.typeform.com/next/embed.js"></script>
            </div>
        </div>
    </div>
</div>
  