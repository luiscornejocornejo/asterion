

<style>
body {
    margin: 0;            /* Reset default margin */
}
iframe {
    display: block;       /* iframes are inline by default */
    background: #000;
    border: none;         /* Reset default border */
    height: 90%;        /* Viewport-relative units */
    width: 100vw;
    margin-top:70px;
z-index: 999;}
    </style>

    @include('creative2.header')
  
    <div id="principal">
    <div class="container mx-auto" style="margin-top: 70px;">

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Report</h1>
                </div>

<iframe src="<?php echo $url;?>" sandbox="allow-forms allow-scripts allow-popups allow-same-origin allow-top-navigation" ></iframe>



<div class="modal " id="modalExample" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog " role="document">
                    <form id="frmAgregarBienCapitalizable" action="/" method="post"> 
                        <div class="modal-content">
                            <div class="modal-header " style="background-color:#3c4655">
                                <h5 class="modal-title text-white" id="exampleModalLabel">Iniciar Conversacion</h5>
                               
                            </div>
                            <div class="modal-body">
                                    
                                @csrf

                              <div id="resul"  ></div>

                              
                               
                                   
                                            
                                        <label  style="  margin: 20px;"  class="form-label"   for="formrow-firstname-input">WhatsApp</label>
                                        <br>
                                        <input size="52" style="  margin-right:20;margin-left:20;"   required name="telefono" type="cel" class=" input-lg" id="telefono" placeholder="+5491133258450">

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
                                <button type="button" class="btn btn-secondary  mb-0 " data-dismiss="modal">Close</button>   

                                <button type="button" style="background-color: #ffc95c;"  class="btn  mb-0 " onclick="mensaje('<?php echo $saliente = session('saliente');?>')"  class="  "><span style="color: #495057;">Iniciar</span></button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
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
               
                    var tel2=tel.value;
                    if(tel2==""){
                        tel2="+5491133258459"
                    }
                    console.log(tel2);
                    const xhr = new XMLHttpRequest();
                    xhr.open("POST", url);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    var  valores="WhatsAppChannel;"+tel2;
                    const body = JSON.stringify({
                        set_variables: "bot_channel;user_phone_number",
                        set_variables_values: valores,
                        set_conversation: true,
                    });
                    xhr.onload = () => {
                    if (xhr.readyState == 4 && xhr.status == 201) {
                        console.log(JSON.parse(xhr.responseText));
                    } else {
                        console.log(`Error: ${xhr.status}`);
                    }
                    };
                    xhr.send(body);

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
</div>

@include('creative2.footer')