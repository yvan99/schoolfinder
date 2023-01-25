<script>
    let map = L.map('map');
    // get schools info from session
    let schoolsData = <?php echo $_SESSION["schools"]; ?>;
    let myIcon = L.icon({
        iconUrl: 'assets/img/high-school.png',
        iconSize: [50, 50], // width and height of the image in pixels
        shadowSize: [35, 20], // width, height of optional shadow image
        iconAnchor: [12, 12], // point of the icon which will correspond to marker's location
        shadowAnchor: [12, 6], // anchor point of the shadow. should be offset
        popupAnchor: [0, 0] // point from which the popup should open relative to the iconAnchor
    })

    function onEachFeature(feature, layer) {
        let popupContent =
            `<b> ${feature.properties.Name}</b>
             <p>${feature.properties.Address}</p>
             <p>${feature.properties.District}</p>
             <p>${feature.properties.Sector}</p>
             <p>${feature.properties.Cell}</p>
             <p>${feature.properties.Village}</p> 
             `;
        if (feature.properties && feature.properties.popupContent) {
            popupContent += feature.properties.popupContent;
        }
        layer.bindPopup(popupContent);
    }
    map.setView([-1.99095,30.02127], 9.5); // point to NYARUGENGE DISTRICT
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
        pointToLayer: (feature, latlng) => {
            return L.marker(latlng, {
                icon: myIcon
            });
        },
        onEachFeature: onEachFeature
    }).addTo(map);
</script>