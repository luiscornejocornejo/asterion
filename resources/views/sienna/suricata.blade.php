

<html>
    <head>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

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

    </head>

    @include('creative.header')
    @include('creative.menuarriba')
<body>

<?php 



?>

<iframe src="<?php echo $url;?>" sandbox="allow-forms allow-scripts allow-popups allow-same-origin allow-top-navigation" ></iframe>

</body>



@include('creative.footer')

<div class="modal " id="modalExample" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog " role="document">
                    <form id="frmAgregarBienCapitalizable" action="/" method="post"> 
                        <div class="modal-content">
                            <div class="modal-header " style="background-color:#3c4655">
                                <h5 class="modal-title text-white" id="exampleModalLabel">Iniciar Conversacion</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                    
                                @csrf

                              <div id="resul" style="  margin: 4px;"  ></div>

                                <div class="row" style="  margin: 4px;" >
                                <div class="col-1">&nbsp;&nbsp;&nbsp;
                                                    </div>
                                    <div class="col-9">
                                            
                                        <label  class="form-label"   for="formrow-firstname-input">WhatsApp</label>
                                        <input required name="telefono" type="cel" class="form-control" id="telefono" placeholder="+5491133258450">
                                    </div>
                                                                        <br>
                                                                        <br>
                                                          
                                </div>

                           
                            
                                <div class="row" style="  margin: 4px;"  >
                                                    <div class="col-1">&nbsp;&nbsp;&nbsp;
                                                    </div>
                                                    <div class="alert alert-warning   col-9" role="alert">
                                                        <i class="ri-alert-line me-1 align-middle font-16"></i> Atención - Este proceso puede demorar unos minutos y el usuario debe responder el mensaje enviado.
                                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>   

                                <button type="button"  onclick="mensaje('<?php echo $saliente = session('saliente');?>')"  class="btn  btn-primary   w-md">Cargar</button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
        <script>
            function mensaje(saliente){

                    var tel= document.getElementById("telefono");
//https://meerkat.xenioo.com/bc/H4TJzHoAedn0lo6acczPYqtu/CctysvLkSxT22CrsyRn2xVyA
//https://meerkat.xenioo.com/bc/lJqZB2tNWmCcPDtW1t310Ab8/LXj5SURPvdHxKU8XAgeXY8p0
                    var tel2=tel.value;
                    if(tel2==""){
                        tel2="+5491133258459"
                    }
                    console.log(tel2);
                    const xhr = new XMLHttpRequest();
                    xhr.open("POST", saliente);
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
            </script>
</html>
