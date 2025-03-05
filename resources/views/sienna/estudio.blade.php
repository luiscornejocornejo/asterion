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
    #playPauseBtn {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .audio-wave {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        animation: none;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1), transparent);
    }

    .playing .audio-wave {
        animation: wave-animation 1.5s infinite;
    }

    /* Estilo del input range */
    #progressBar {
        width: 100%;
        appearance: none;
        background: linear-gradient(to right, #007bff 0%, #00d4ff 100%);
        height: 8px;
        border-radius: 5px;
        outline: none;
        transition: background-size 0.3s;
        background-size: 0% 100%;
        cursor: pointer;
    }

    /* Estilo del handle (thumb) */
    #progressBar::-webkit-slider-thumb {
        appearance: none;
        width: 15px;
        height: 15px;
        background-color: #007bff;
        border-radius: 50%;
        cursor: pointer;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        transition: transform 0.2s;
    }

    #progressBar::-moz-range-thumb {
        width: 15px;
        height: 15px;
        background-color: #007bff;
        border-radius: 50%;
        cursor: pointer;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        transition: transform 0.2s;
    }

    /* Animación al reproducir */
    .playing #progressBar {
        animation: pulse-animation 1s infinite;
    }

    @keyframes pulse-animation {
        0% {
            background-size: 0% 100%;
        }

        50% {
            background-size: 100% 100%;
        }

        100% {
            background-size: 0% 100%;
        }
    }
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
                    <h1 class="h3 mb-0 text-gray-800"> Estudio</h1>
                    
                </div>
                </center>
                <hr>
               
            

        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
            <?php
    
                $canti=0;
                foreach ($estudio as $value) {
                    if($canti==0){
                        $active="active";
                    }else{
                        $active="";

                    }
                    ?>
                <div class="carousel-item <?php echo $active;?>">
                        <h3><?php echo htmlspecialchars($value->nombre); ?> </h3>
                        <h3><?php echo $value->contenido; ?> </h3>
                </div>
                <?php $canti++;}?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
          
</div>

                 
                <hr>
         

                    
          

        </div>
    </div>
</div>


<br><br><br>

<script>

let listageneral = {!! json_encode($estudio, JSON_FORCE_OBJECT) !!};
input.oninput = function() {
    const searchValue = input.value.toLowerCase();

    for (const key in listageneral) {
        if (Object.hasOwnProperty.call(listageneral, key)) {
            const database = listageneral[key]["nombre"];
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