<?php


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
$queryws = "SELECT * from iwisp.ws_cliente where nombre='" . $subdomain_tmp . "'";
        $baseget="14";
        $prueba = conectar($baseget);
        $resultadosws = DB::connection('mysql2')->select($queryws);

        foreach ($resultadosws as $value) {

            $tokensienna = $value->tokensienna;
            $urilogin = $value->urilogin;
        }

        $categorias= file_get_contents("https://".$subdomain_tmp.".suricata-iwisp.com.ar/api/getCategories?token=".$tokensienna."");
        $categorias2=json_decode($categorias, true);
        /*
        $locaf= file_get_contents("https://".$subdomain_tmp.".suricata-iwisp.com.ar/api/getLocalities?token=".$tokensienna."&tipo=f ");
        $locaf2=json_decode($locaf, true);
        $locaw= file_get_contents("https://".$subdomain_tmp.".suricata-iwisp.com.ar/api/getLocalities?token=".$tokensienna."&tipo=w ");
        $locaw2=json_decode($locaw, true);*/

        if (isset($resultadoscliente[0]->cliente)) {
            $iddelcliente=$resultadoscliente[0]->cliente;
            $getdata= file_get_contents("https://".$subdomain_tmp.".suricata-iwisp.com.ar/api/ws?token=".$tokensienna."&idcliente=" . $iddelcliente);
            $getdata2 = json_decode($getdata, true);
            $getdata3 = json_encode($getdata2, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        } else {
            $iddelcliente="";
            $getdata3 ="";
        }



?>
<div class="card widget-flat" id="infoUser">
    <div class="card-body">

        <div style="background-color: #00a400;" class="d-flex justify-content-end">
            <div class="me-2">
            <img src="https://<?php echo $subdomain_tmp;?>.suricata.cloud/img/erp/iwisp.png"
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
                <a href="#leads" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 ">
                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                <span class="d-none d-md-block">Leads</span>
                </a>
            </li>
          
        </ul>
        <div class="tab-content">
            <div class="tab-pane show active" id="ticket">

                <form method="post" action="api/creariwisp">
                    @csrf
                    <input type="hidden" name="tokensienna" value="<?php echo $tokensienna;?>"/>
                    <input type="hidden" name="dom" value="<?php echo $subdomain_tmp;?>"/>
                    <div class="row">
                        <div class="col-xxl-2 col-xl-2 col-lg-2 col-sm-12 mb-2">
                            <label for="example-textarea" class="form-label">Cliente</label>
                            <input required name="cliente" type="text" class="form-control" id="lastNameUser"
                                value="<?php echo $iddelcliente;?>">
                            
                        </div>
                        <div class="col-xxl-2 col-xl-2 col-lg-2 col-sm-12 mb-2">
                            <label for="example-textarea" class="form-label">tipo</label>
                            <select class="form-select js-example-basic-single" name="tipo" id="agent">
                                <option value="R">Remoto</option>
                                <option value="S">Sitio</option>
                            </select>

                        </div>
                        <div class="col-xxl-5 col-xl-5 col-lg-5 col-sm-12 mb-2">
                            <label for="agent" class="form-label">Categorias:</label>
                            <select class="form-select js-example-basic-single" name="categoria" id="agent">

                                <?php for($i=0;$i<sizeof($categorias2);$i++){
                                        ?>
                                <option value="{{ $categorias2[$i]['id'] }}">
                                    {{ $categorias2[$i]['descripcion'] }}
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

                <?php if(0){?>
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

            <div class="tab-pane " id="leads">
            <form method="post" action="api/creariwispleads">
                    @csrf
                    <input type="hidden" name="tokensienna" value="<?php echo $tokensienna;?>"/>
                    <input type="hidden" name="dom" value="<?php echo $subdomain_tmp;?>"/>
                    <div class="row">
                        <div class="col-xxl-2 col-xl-2 col-lg-2 col-sm-12 mb-2">
                            <label for="example-textarea" class="form-label">Nombre</label>
                            <?php if(isset($resultadoscliente[0]->nya)){
                                    $nya=$resultadoscliente[0]->nya;
                            }else{
                                $nya="";
                            }
                            if(isset($resultadoscliente[0]->address)){
                                $address=$resultadoscliente[0]->address;
                            }else{
                                $address="";
                            }if(isset($resultadoscliente[0]->cel)){
                                $cel=$resultadoscliente[0]->cel;
                            }else{
                                $cel="";
                            }if(isset($resultadoscliente[0]->email)){
                                $email=$resultadoscliente[0]->email;
                            }else{
                                $email="";
                            }
                            ?>
                            <input required name="nombre" type="text" class="form-control" id="lastNameUser" value="<?php echo $nya ;?>">
                        </div>
                        <div class="col-xxl-2 col-xl-2 col-lg-2 col-sm-12 mb-2">
                            <label for="example-textarea" class="form-label">Apellido</label>
                            <input required name="apellido" type="text" class="form-control" id="lastNameUser" value="<?php echo $nya;?>">
                        </div>
                        <div class="col-xxl-2 col-xl-2 col-lg-2 col-sm-12 mb-2">
                            <label for="example-textarea" class="form-label">Domicilio</label>
                            <input required name="domicilio" type="text" class="form-control" id="lastNameUser" value="<?php echo $address;?>">
                        </div>
                        <div class="col-xxl-2 col-xl-2 col-lg-2 col-sm-12 mb-2">
                            <label for="example-textarea" class="form-label">Celular</label>
                            <input required name="cel" type="text" class="form-control" id="lastNameUser" value="<?php echo $cel;?>">
                        </div>
                        <div class="col-xxl-2 col-xl-2 col-lg-2 col-sm-12 mb-2">
                            <label for="example-textarea" class="form-label">Email</label>
                            <input required name="email" type="email" class="form-control" id="lastNameUser" value="<?php echo $email;?>">
                        </div>
                        <div class="col-xxl-2 col-xl-2 col-lg-2 col-sm-12 mb-2">
                            <label for="example-textarea" class="form-label">tipo</label>
                            <select onchange="fetchLocalities(this.value)" class="form-select js-example-basic-single" name="tipo" id="tipo">
                                <option value="F">Fibra</option>
                                <option value="W">Wireless</option>
                            </select>

                        </div>
                        <div class="col-xxl-5 col-xl-5 col-lg-5 col-sm-12 mb-2">
                            <label for="agent" class="form-label">Localidades:</label>
                            <select class="form-select js-example-basic-single" name="categoria" id="localidad">
                            <option value="">Seleccione una localidad</option>

                                
                            </select>
                            <script>
                                function fetchLocalities(tipo) {
                                    const tokenSienna = "<?php echo $tokensienna;?>"; // Reemplaza con el valor real de tu token
                                    const subdomainTmp = "<?php echo $subdomain_tmp;?>"; // Reemplaza con el valor real de tu subdominio
                                    const url = `https://${subdomainTmp}.suricata-iwisp.com.ar/api/getLocalities?token=${tokenSienna}&tipo=${tipo}`;

                                    // Realiza la solicitud
                                    const tipoSelect = document.getElementById("tipo");
                                        const localidadSelect = document.getElementById("localidad"); // Suponiendo que tienes un select para localidades

                                        tipoSelect.addEventListener("change", async function () {
                                            const tipo = tipoSelect.value;
                                            
                                            try {
                                                const response = await axios.get(url);
                                                
                                                // Asumiendo que la respuesta contiene las localidades en un array
                                                const localidades = response.data;

                                                // Limpia el select de localidades antes de llenarlo
                                                localidadSelect.innerHTML = "";

                                                // Llenar el select con las opciones de localidades
                                                localidades.forEach(localidad => {
                                                    const option = document.createElement("option");
                                                    option.value = localidad.id; // Ajusta según el formato de la respuesta
                                                    option.textContent = localidad.localidad; // Ajusta según el formato de la respuesta
                                                    localidadSelect.appendChild(option);
                                                });
                                            } catch (error) {
                                                console.error("Error al obtener localidades:", error);
                                                alert("No se pudo cargar la información. Revisa la consola para más detalles.");
                                            }
                                        });

                                }

                            </script>
                        </div> 
                       
                           
                      
                        <div class="mb-2">
                            <label for="example-textarea" class="form-label">Descripcion</label>
                            <textarea name="detalle" class="form-control" id="example-textarea" rows="4"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-3 mb-2">Crear Leads</button>
                    <hr class="mx-1" />
                </form>
            </div>
           
        </div>
    </div>
</div>
  