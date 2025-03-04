@include('facu.header')
<link href="flotante.css" rel="stylesheet" type="text/css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
<div class="wrapper">

@include('facu.menu')

<?php
function getdata($intedb,$ba){

    foreach($intedb as $val){

        if($val->cliente==$ba){
            return $val->getdata;
        }
    }
    return "";
}
function inte($intedb,$ba){

    foreach($intedb as $val){

        if($val->cliente==$ba){
            return $val->inte;
        }
    }
    return "";
}

function pais($intedb,$ba){

foreach($intedb as $val){

    if($val->cliente==$ba){
        return $val->pais;
    }
}
return "";
}


function estado($intedb,$ba){

    foreach($intedb as $val){
    
        if($val->cliente==$ba){
            return $val->estadomerchant;
        }
    }
    return "";
    }
?>
<style>
  
  

</style>

<script>
    function flipCard(cardId) {
    const cardContainer = document.getElementById(cardId);
    cardContainer.classList.toggle('flipped');
}
</script>
    <div class="content-page" style="padding: 0!important;">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade
                            show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                 <center>
                <div class="mx-auto" style="width: 200px;">
                    <h1 class="h3 mb-0 text-gray-800"> Cloud</h1>
                    
                </div>
                </center>
                <hr>
                <input class="form-control" type="text" id="input" placeholder="Buscar Merchant" >
                <br> <br>
            
<div class="row">
    <?php
    $canti=0;
    foreach ($canciones as $value) {
        
        ?>
        
        <div class="col-md-3">
            <div id="base_<?php echo htmlspecialchars($value->nombre); ?>" class="card border-secondary border">

                    
                    <div class="card-body">
                    <center>

                    <h3><?php echo htmlspecialchars($value->nombre); ?> </h3>

                        
                        
                            
                        <div id="footer-<?php echo htmlspecialchars($value->nombre); ?>" class="card-footer">
                        
                           
                        </div>
                    </center>

                    </div>
            
            </div>
        </div>
    <?php } 
    echo $canti;?>
</div>

                 
                <hr>
         

                    
          

        </div>
    </div>
</div>


<br><br><br>
<script>

let listageneral = {!! json_encode($canciones, JSON_FORCE_OBJECT) !!};
input.oninput = function() {
    const searchValue = input.value.toLowerCase();

    for (const key in listageneral) {
        if (Object.hasOwnProperty.call(listageneral, key)) {
            const database = listageneral[key]["canciones"];
            const elementId = "base_" + database;
            const element = document.getElementById(elementId);

            if (element) { // Verifica que el elemento exista
                const isMatch = database.toLowerCase().includes(searchValue);
                element.style.display = isMatch ? 'block' : 'none';
            } else {
                console.warn(`Elemento con ID '${elementId}' no encontrado.`);
            }
        }
    }
};


</script>


    @include('facu.footer2')