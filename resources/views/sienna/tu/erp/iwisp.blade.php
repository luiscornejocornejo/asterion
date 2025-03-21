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
        
        $locaf= file_get_contents("https://".$subdomain_tmp.".suricata-iwisp.com.ar/api/getLocalities?token=".$tokensienna."&tipo=f ");
        $locaf2=json_decode($locaf, true);
        $locaw= file_get_contents("https://".$subdomain_tmp.".suricata-iwisp.com.ar/api/getLocalities?token=".$tokensienna."&tipo=w ");
        $locaw2=json_decode($locaw, true);

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
            alt="iwisp logo" height="55" class="py-2">
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
                            <select onchange="fetchLocalities(this.value)" class="form-select " name="tipo" id="tipo">
                            <option value="">Seleccione un Tipo</option>
                            <option value="F">Fibra</option>
                                <option value="W">Wireless</option>
                            </select>

                        </div>
                        <div class="col-xxl-5 col-xl-5 col-lg-5 col-sm-12 mb-2">
                            <label for="agent" class="form-label">Localidades:</label>
                            <select class="form-select " name="localidad" id="localidad">

                                
                            </select>
                            <script>
                               function fetchLocalities(tipo) {
                                    const uno = {!! json_encode($locaf2, JSON_FORCE_OBJECT) !!};
                                    const dos = {!! json_encode($locaw2, JSON_FORCE_OBJECT) !!};


                                    const localidadSelect = document.getElementById("localidad");
                                    localidadSelect.innerHTML = ""; // Limpiar opciones

                                    let localities = [];
                                    const fragment = document.createDocumentFragment();

                                    if (tipo === "W") {
                                        console.log("Datos dos:", dos);
                                        console.log( typeof dos);

                                        let claves = Object.keys(dos); // claves = ["nombre", "color", "macho", "edad"]
                                        for(let i=0; i< claves.length; i++){
                                            let clave = claves[i];
                                            console.log(dos[clave]);
                                            console.log(dos[clave]["id"]);
                                            console.log(dos[clave]["localidad"]);
                                            const option = document.createElement('option');
                                            option.value = dos[clave]["id"];
                                            option.textContent =dos[clave]["localidad"];
                                            fragment.appendChild(option);
                                            
                                        }


                                    } else if (tipo === "F") {
                                        console.log("Datos uno:", uno);
                                        console.log( typeof uno);

                                        let claves = Object.keys(uno); // claves = ["nombre", "color", "macho", "edad"]
                                        for(let i=0; i< claves.length; i++){
                                            let clave = claves[i];
                                            console.log(uno[clave]);
                                            console.log(uno[clave]["id"]);
                                            console.log(uno[clave]["localidad"]);
                                            const option = document.createElement('option');
                                            option.value = uno[clave]["id"];
                                            option.textContent =uno[clave]["localidad"];
                                            fragment.appendChild(option);
                                            
                                        }


                                    }
                                   

                                    

                                   
                                   
                                    localidadSelect.appendChild(fragment);
                                    console.log("Localidades cargadas exitosamente.");
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
  