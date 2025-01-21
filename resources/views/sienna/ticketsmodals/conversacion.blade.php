<script>
    function vista(dd,ee,result) {
    
    console.log(typeof(ee) );
    if(ee=== ""){

    }else{

    
    url = "https://"+result+".suricata.cloud/api/datoscliente?cliente=" + ee;
    console.log(url);

    axios.get(url)
    .then(function (response) {
        // función que se ejecutará al recibir una respuesta
       // console.log(response.data);

        dato = "";
        for (i = 0; i < response.data.length; i++) {
            console.log(response.data[i].deuda);
            console.log(response.data[i].nya);
            console.log(response.data[i].cel);

            document.getElementById("nyac").innerHTML = response.data[i].nya;
            document.getElementById("clientec").innerHTML = ee;
            document.getElementById("domic").innerHTML = response.data[i].address;
            document.getElementById("celc").innerHTML = response.data[i].cel;
            document.getElementById("emailc").innerHTML = response.data[i].email;
            document.getElementById("estadocuentac").innerHTML = response.data[i].a_status;
            document.getElementById("estadoservicioc").innerHTML = response.data[i].s_status;
            document.getElementById("deuda").innerHTML = response.data[i].deuda;
            document.getElementById("ip").innerHTML = response.data[i].ip;
            document.getElementById("nodo").innerHTML = response.data[i].nodo;


        }
       // 



    })
    .catch(function (error) {
        // función para capturar el error
        console.log(error);
    })
    .then(function () {
        // función que siempre se ejecuta
    });


    }
    document.getElementById('vista').innerHTML = "";
   // document.getElementById('vista').src = dd;
   if (dd === "botpress") {
    // Acción cuando dd es exactamente "botpress"
    const g = '<iframe allow="camera;microphone" scrolling="no" src="https://conversations.suricata.chat/<?php echo $merchantId;?>/t/<?php echo $resultados[0]->ticketid;?>?agentEmail=<?php echo session('emailusuario');?>" width="100%" class="border rounded-3" style="height: 650px!important;"></iframe>';
      console.log(g);
        document.getElementById('vista').innerHTML = g;

} else if (dd === "" || dd === null || dd === undefined) {
    // Acción cuando dd está vacío, es nulo o está 
    document.getElementById('vista').innerHTML ="";
} else {
    // Crear un iframe con el valor de dd
    const g = '<iframe allow="camera;microphone" src="' + dd + '" width="100%" height="800px" class="border rounded-3" style="height:400px !important"></iframe>';
    document.getElementById('vista').innerHTML = g;
}

   
}

</script>

<div>
        <div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                   
                    <div class="modal-body" id="vista">
                        
                    </div>
                    <div class="card-body" style="margin:20px;" id="registros">
                            <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="fw-normal text-dark" title="Number of Customers">
                                Información de usuario
                                </h4>
                            </div>
                            <div>
                                <i
                                class="mdi mdi-card-account-details widget-icon bg-secondary-lighten text-secondary"
                                ></i>
                            </div>
                            </div>
                            <hr style="margin-top: 10px" />
                            <div class="row mt-2">
    <!-- Primera columna -->
    <div class="col-md-6">
        <div class="d-flex mt-2">
            <i class="mdi mdi-card-account-details"></i>&nbsp;Numero cliente:&nbsp;
            <span class="badge badge-secondary-lighten line-h"> <span id="clientec"></span> </span>
        </div>
        <div class="d-flex mt-2">
            <i class="mdi mdi-account"></i>&nbsp;Nombre:&nbsp;
            <span class="badge badge-secondary-lighten hover-overlay line-h">
                <span id="nyac"></span>
            </span>
        </div>
        <div class="d-flex mt-2">
            <i class="mdi mdi-home"></i>&nbsp;Domicilio:&nbsp;
            <span class="badge badge-secondary-lighten line-h">
                <span id="domic"></span>
            </span>
        </div>
        <div class="d-flex mt-2">
            <i class="mdi mdi-whatsapp text"></i>&nbsp;Whatsapp:&nbsp;
            <span class="badge badge-secondary-lighten line-h"> <span id="celc"></span> </span>
        </div>
        <div class="d-flex mt-2">
            <i class="mdi mdi-email"></i>&nbsp;Email:&nbsp;
            <span class="badge badge-secondary-lighten line-h">
                <span id="emailc"></span>
            </span>
        </div>
    </div>

    <!-- Segunda columna -->
    <div class="col-md-6">
        <div class="d-flex mt-2">
            <i class="mdi mdi-account-cash"></i>&nbsp;Estado de cuenta:&nbsp;
            <span class="badge badge-success-lighten line-h"> <span id="estadocuentac"></span> </span>
        </div>
        <div class="d-flex mt-2">
            <i class="mdi mdi-antenna"></i>&nbsp;Estado de servicio:&nbsp;
            <span class="badge badge-success-lighten line-h"> <span id="estadoservicioc"></span> </span>
        </div>
        <div class="d-flex mt-2">
            <i class="mdi mdi-antenna"></i>&nbsp;Deuda:&nbsp;
            <span class="badge badge-success-lighten line-h"> <span id="deuda"></span> </span>
        </div>
        <div class="d-flex mt-2">
            <i class="mdi mdi-antenna"></i>&nbsp;Ip:&nbsp;
            <span class="badge badge-success-lighten line-h"> <span id="ip"></span> </span>
        </div>
        <div class="d-flex mt-2">
            <i class="mdi mdi-antenna"></i>&nbsp;Nodo:&nbsp;
            <span class="badge badge-success-lighten line-h"> <span id="nodo"></span> </span>
        </div>
    </div>
</div>


                           
                            
                            
                           
                           
                    </div>
                   
                   
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
      </div>
     
      <div class="card widget-flat">
  
</div>