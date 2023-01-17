<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places&key=AIzaSyDpuMMt3CR3XvDhPy1do7Q1KMY0q2G0WOc"></script>
<script>
    function init() {
        let input = document.getElementById('locationTextField');
        let autocomplete = new google.maps.places.Autocomplete(input);
    }
    google.maps.event.addDomListener(window, 'load', init);
</script>
</body>

</html>