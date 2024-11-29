<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

<div id="map" style="height: 400px; width: 100%;"></div>

<script>
    const lat = 40.7128; // Ejemplo: Latitud de Nueva York
    const lng = -74.0060; // Ejemplo: Longitud de Nueva York

    const map = L.map('map').setView([lat, lng], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([lat, lng]).addTo(map)
        .bindPopup('Ubicación seleccionada.')
        .openPopup();
</script>
