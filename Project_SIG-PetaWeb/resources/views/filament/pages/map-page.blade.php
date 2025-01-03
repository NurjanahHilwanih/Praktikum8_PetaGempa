<x-filament-panels::page>
    <div id="map" style="height: 500px; width: 100%;"></div>

    <!-- Memuat Leaflet CSS dari CDN -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

    <!-- Memuat Leaflet JS dari CDN -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    
    <script>
        // Inisialisasi peta dengan koordinat tengah Pulau Jawa
        var map = L.map('map').setView([-7.2500, 112.7500], 6); // Koordinat tengah Pulau Jawa, zoom level 7

        // Menambahkan layer peta dasar dari OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Data GeoJSON yang diterima dari controller Laravel
        var geojsonData = @json($geojsonData); // Mengonversi data PHP ke format JavaScript

        // Menambahkan layer GeoJSON ke peta
        geojsonData.forEach(function(data) {
            L.geoJSON(data, {
                onEachFeature: function (feature, layer) {
                    // Cek apakah ada properti 'name', 'latitude', 'longitude'
                    if (feature.properties) {
                        var content = "Name: " + feature.properties.name + "<br>";
                        content += "Latitude: " + feature.properties.latitude + "<br>";
                        content += "Longitude: " + feature.properties.longitude;
                        
                        // Menampilkan informasi saat hover menggunakan tooltip
                        layer.bindTooltip(content, { sticky: true }).openTooltip();
                    }
                }
            }).addTo(map);
        });

        // Memastikan peta mengupdate ukuran jika ada perubahan layout
        map.invalidateSize();
    </script>
</x-filament-panels::page>
