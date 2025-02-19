<?php 
    foreach ($segui as $adj) {
        if ($adj->tipo == 12) {
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
<div class="card shadow-sm">
    <div class="d-flex justify-content-between mx-3 mt-2">
        <div>
            <h5 class="mb-3">Grabaciones</h5>
        </div>
        <div>
            <a href="https://recordingsuricata.sfo3.digitaloceanspaces.com/<?php echo $adj->descripcion;?>" download="https://recordingsuricata.sfo3.digitaloceanspaces.com/<?php echo $adj->descripcion;?>">
                <i class="mdi mdi-headphones widget-icon bg-secondary-lighten text-secondary"></i>
            </a>
        </div>
    </div>
    <hr class="mx-3 my-0">
    <div class="card-body d-flex align-items-center">
        <span role="button" id="playPauseBtn" class="border btn btn-light me-3">
            <i class="mdi mdi-play" id="playIcon" style="font-size: 30px;"></i>
            <i class="mdi mdi-pause d-none" id="pauseIcon" style="font-size: 30px;"></i>
        </span>
        <div class="flex-grow-1">
            <input type="range" id="progressBar" class="form-range" value="0" min="0" max="100">
        </div>
        <?php $ht = 'https://recordingsuricata.sfo3.digitaloceanspaces.com/' . $adj->descripcion; ?>
        <span id="currentTime" class="ms-3">00:00</span>
        <span>/</span>
        <span id="totalDuration" class="ms-1">00:00</span>
        <audio id="audioPlayer">
            <source src="<?php echo $ht; ?>" type="audio/ogg">
            <source src="<?php echo $ht; ?>" type="audio/mpeg">
        </audio>
    </div>
</div>
<?php 
        }
    }
?>
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
