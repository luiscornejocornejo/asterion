

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
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Iniciar Mensaje</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                    
                                @csrf

                              

                                <div class="row">
                                                                            <div class="col-6">
                                            
                                                                                <label
                                                                                    class="form-label"
                                                                                    for="formrow-firstname-input">WhatsApp</label>
                                                                                <input
                                                                                required
                                                                                name="telefono"
                                                                                    type="cel"
                                                                                    class="form-control"
                                                                                    id="formrow-hasta-input"
                                                                                    placeholder="+5491133258450"
                                                                                    >
                                                                                    


                                                                        </div>
                                                                        
                                                                        </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                
                                <button type="submit"   class="btn  btn-primary   w-md">Cargar</button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
</html>
