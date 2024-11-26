<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Kecamatan dan Layanan Kesehatan</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <style>
        #map { height: 600px; }
    </style>
</head>
<body>
    <h1>Peta Kecamatan dan Layanan Kesehatan</h1>
    <div id="map"></div>
    <script src="data/kecamatan.json"></script>
    <script>
        // Inisialisasi peta
        const map = L.map('map').setView([-7.4502, 109.1622], 11);

        // Menambahkan tile layer
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Tambahkan polygon kecamatan
        L.geoJSON(kecamatan).addTo(map);

        // Tambahkan marker layanan kesehatan
        <?php
        include 'db_connection.php';
        $sql = "SELECT name, latitude, longitude FROM health_services";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "L.marker([" . $row['latitude'] . ", " . $row['longitude'] . "])
                     .addTo(map)
                     .bindPopup('<b>" . $row['name'] . "</b>');\n";
            }
        }
        $conn->close();
        ?>
    </script>
</body>
</html>