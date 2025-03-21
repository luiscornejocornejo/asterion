


<div class="row ">
    <div class="col-md-12">
        <!-- Portlet card -->
        <div class="card mb-md-0 mb-3">
            <div class="card-body">
               
                <h5 class="card-title mb-0">Geolocalizacion</h5>
                <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
                <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

            <div id="map" style="height: 600px; width: 1000px;"></div>

            <script>
                    console.log(<?php echo $resultados[0]->lat;?>); 

                        <?php
                        
                        if(isset($resultados[0]->lat)){
                            $coor=explode(",",$resultados[0]->lat);
                                    if(isset($coor[0])){?>

                                            const lat = <?php echo $coor[0];?>;
                                            console.log(<?php echo $coor[0];?>);

                                        <?php 
                                    }
                                    if(isset($coor[1])){?>
                                        const lng = <?php echo $coor[1];?>;
                                        console.log(<?php echo $coor[1];?>); 


                                        <?php  
                                    }
                        }else{
                            ?>
                                const lat = -34.545278; // Ejemplo: Latitud de Nueva York
                                const lng = -58.449722; // Ejemplo: Longitud de Nueva York

                                <?php 
                        } ?>

                    const map = L.map('map').setView([lat, lng], 13);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(map);

                    L.marker([lat, lng]).addTo(map)
                        .bindPopup('Ubicación seleccionada.')
                        .openPopup();
            </script>       
                
            </div>
        </div> <!-- end card-->
    </div><!-- end col -->
                                
   
                                
  
</div>
<!-- end row -->
