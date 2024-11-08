<?php 
    foreach ($segui as $adj) {
        if ($adj->tipo == 12) {
?>

<div class="card shadow-sm">
    <div class="d-flex justify-content-between mx-3 mt-1">
        <div>
            <h5 class="mb-3">Grabaciones</h5>
        </div>
        <div>
            <i class="mdi mdi-headphones widget-icon bg-secondary-lighten text-secondary"></i>
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
