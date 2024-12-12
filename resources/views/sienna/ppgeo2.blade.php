<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geolocalización de varios puntos</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <style>
        #map {
            height: 500px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h5 class="card-title mb-0">Geolocalización</h5>
        <div id="map"></div>
    </div>

    <script>
        // Inicializar el mapa
        const map = L.map('map').setView([0, 0], 2); // Coordenadas iniciales y zoom global

        // Agregar la capa base de OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Datos de los puntos (array con objetos de coordenadas y descripciones)
        const puntos = [
            <?php 
            $query="select * from naps";
            $resultados = DB::select($query);

            foreach($resultados as $val){?>
            { lat: <?php echo $val->lat;?>, lng: <?php echo $val->log;?>, nombre: "<?php echo $val->nombre;?>" },
            <?php }?>
        ];

        // Agregar los marcadores al mapa
        puntos.forEach(punto => {
            L.marker([punto.lat, punto.lng])
                .addTo(map)
                .bindPopup(`<b>${punto.nombre}</b>`); // Mostrar nombre en el popup
        });

        // Ajustar el mapa para que todos los puntos sean visibles
        const bounds = L.latLngBounds(puntos.map(p => [p.lat, p.lng]));
        map.fitBounds(bounds);
    </script>
</body>
</html>
