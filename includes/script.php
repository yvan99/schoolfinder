<?php require_once 'vendor/autoload.php';?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places&key=<?php echo getenv("GOOGLE_PLACES_API");?>"></script>
<script>
    const googlePlacesInit=()=> {
        // restrict googlePlaces to Rwanda places
        const options = {
            componentRestrictions: {
                country: "rw"
            }
        };

        let input = document.getElementById('locationTextField');
        let autocomplete = new google.maps.places.Autocomplete(input,options);
    }
    google.maps.event.addDomListener(window, 'load', googlePlacesInit);
</script>
</body>

</html>