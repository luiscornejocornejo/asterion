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
                    <h1 class="h3 mb-0 text-gray-800"> Canciones</h1>
                    
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
                    <span role="button" id="playPauseBtn" class="border btn btn-light me-3">
                        <i class="mdi mdi-play" id="playIcon" style="font-size: 30px;"></i>
                        <i class="mdi mdi-pause d-none" id="pauseIcon" style="font-size: 30px;"></i>
                    </span>
                    <div class="flex-grow-1">
                        <input type="range" id="progressBar" class="form-range" value="0" min="0" max="100">
                    </div>
                    <?php $ht = 'https://ibbvp.suricata.cloud/ibbvp/canciones/' . $value->url; ?>
                    <span id="currentTime" class="ms-3">00:00</span>
                    <span>/</span>
                    <span id="totalDuration" class="ms-1">00:00</span>
                    <audio id="audioPlayer">
                        <source src="<?php echo $ht; ?>" type="audio/ogg">
                        <source src="<?php echo $ht; ?>" type="audio/mpeg">
                    </audio>
                        
                        
                            
                        <div id="footer-<?php echo htmlspecialchars($value->nombre); ?>" class="card-footer">
                        
                        <?php echo htmlspecialchars($value->letra); ?>
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
    document.addEventListener("DOMContentLoaded", function() {
        const playPauseBtn = document.getElementById("playPauseBtn");
        const audioPlayer = document.getElementById("audioPlayer");
        const playIcon = document.getElementById("playIcon");
        const pauseIcon = document.getElementById("pauseIcon");
        const progressBar = document.getElementById("progressBar");
        const currentTime = document.getElementById("currentTime");
        const totalDuration = document.getElementById("totalDuration");

        // Play/Pause Toggle
        playPauseBtn.addEventListener("click", () => {
            if (audioPlayer.paused) {
                audioPlayer.play();
                playIcon.classList.add("d-none");
                pauseIcon.classList.remove("d-none");
            } else {
                audioPlayer.pause();
                playIcon.classList.remove("d-none");
                pauseIcon.classList.add("d-none");
            }
        });

        // Update Progress Bar
        audioPlayer.addEventListener("timeupdate", () => {
            const progress = (audioPlayer.currentTime / audioPlayer.duration) * 100;
            progressBar.value = progress;

            // Update time display
            currentTime.textContent = formatTime(audioPlayer.currentTime);
        });

        // Set audio duration
        const setAudioDuration = () => {
            if (!isNaN(audioPlayer.duration)) {
                totalDuration.textContent = formatTime(audioPlayer.duration);
            }
        };

        // Evento cuando los metadatos se cargan
        audioPlayer.addEventListener("loadedmetadata", setAudioDuration);

        // Forzar carga de metadatos al montar el DOM
        if (audioPlayer.readyState >= 1) {
            setAudioDuration();
        } else {
            audioPlayer.addEventListener("canplay", setAudioDuration);
        }

        // Seek Audio
        progressBar.addEventListener("input", () => {
            const seekTime = (progressBar.value / 100) * audioPlayer.duration;
            audioPlayer.currentTime = seekTime;
        });

        // Format time in MM:SS
        function formatTime(seconds) {
            const minutes = Math.floor(seconds / 60);
            const secs = Math.floor(seconds % 60);
            return `${minutes < 10 ? '0' : ''}${minutes}:${secs < 10 ? '0' : ''}${secs}`;
        }
    });
</script>
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