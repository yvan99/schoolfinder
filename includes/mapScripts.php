<script>
    let map = L.map('map');
    let schoolsData = <?php echo $_SESSION["schools"]; ?>;

    function onEachFeature(feature, layer) {
        let popupContent =
            `<img src=../photo/${feature.properties.Image}><b> ${feature.properties.Name}</b><p>${feature.properties.Address}</p>`;
        if (feature.properties && feature.properties.popupContent) {
            popupContent += feature.properties.popupContent;
        }
        layer.bindPopup(popupContent);
    }
    map.setView([-1.882914, 30.144405], 9.5);
    mapLink =
        '<a href="http://openstreetmap.org">OpenStreetMap</a>';
    L.tileLayer(
        'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoieXZhbjk5IiwiYSI6ImNsMzdoM2ltYzBhMjIzY250ZGx0ODBtNXUifQ.Ff_HDqm6vbFNxFceg7TrCg', {
            attribution: 'Map data © <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 30,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
        }).addTo(map);
    L.geoJson(schoolsData, {
        onEachFeature: onEachFeature
    }).addTo(map);
</script>