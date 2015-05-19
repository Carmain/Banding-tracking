/**
 * Traforms coords into a real address and save it in the form
 * @param  positionSet  The latitude and the longitude of a point
 */
function litteralAddress(positionSet) {

    // Save the positions in two hidden fields in the form
    $('input[name=mapx]').val(positionSet.lat());
    $('input[name=mapy]').val(positionSet.lng());

    // Transform the latitude and the longitude into address
    geocoder = new google.maps.Geocoder();
    geocoder.geocode({'latLng': positionSet}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if(results[0]) {

                var results = results[0].address_components;

                for(var i = 0; i < results.length; i ++) {
                    results[i];

                    // Save the results in the form
                    if(results[i].types.indexOf("locality") >= 0) {
                        $('input[name=town]').val(results[i].long_name);
                        $('input[name=town]').css("background", "");
                    }

                    if (results[i].types.indexOf("route") >= 0) {
                        $('input[name=location]').val(results[i].long_name);
                        $('input[name=location]').css("background", "");
                    }

                    if(results[i].types.indexOf("administrative_area_level_2") >= 0) {
                        // Display a the long name and save in a hidden field the short
                        $('input[name=department_long]').val(results[i].long_name);
                        $('input[name=department_long]').css("background", "");
                        $('input[name=department_short]').val(results[i].short_name);
                    }
                }
            }
        }
    });
}

function setMarker(positionSet, map, markers) {
    var myMarker = new google.maps.Marker({
        position: positionSet,
        map: map,
    });

    // Remove the previous markers
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
    }
    litteralAddress(positionSet);
    markers.push(myMarker);
}

function getPosition(latitude, longitude) {
    var map;
    var markers = [];

    var positionSet = new google.maps.LatLng(latitude, longitude);
    var mapOptions = {
        center   : positionSet, // Where the center of the card is
        zoom     : 15, // Level of zoom
        mapTypeId: google.maps.MapTypeId.HYBRID // Type of map
        /**
         * Types of maps :
            * ROADMAP (normal, default 2D map)
            * SATELLITE (photographic map)
            * HYBRID (photographic map + roads and city names)
            * TERRAIN (map with mountains, rivers, etc.)
         */
    };

    map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);
    setMarker(positionSet, map, markers);

    google.maps.event.addListener(map, 'click', function(event) {
        setMarker(event.latLng, map, markers);
    });
}

function showLocation(position) {
    getPosition(position.coords.latitude, position.coords.longitude);
}

function errorHandler(error) {
    console.log("Geolocation error : code " + error.code +
                " - " + error.message);
    getPosition(49.175180, -0.339846);
}

/**
 * Initialize the map in the form
 */
function initialize() {
    if(navigator.geolocation) {
        /**
         * showLocation: get the position of the user
         * errorHandler: if we couldn't get the position, we manage the error
         * Object:
            * enableHighAccuracy: If the navigator could, we get the exact position of the user
            * maximumAge        : Used to return a position that would have been kept in hiding
            * timeout           : Maximum time to wait to get the position.
         */
        navigator.geolocation.getCurrentPosition(showLocation, errorHandler,
            {enableHighAccuracy:true, maximumAge:60000,timeout:27000});
    }
    else {
        swal("Erreur dans la géolocalisation",
             "Votre navigateur ne prends pas en compte la géolocalisation.\n" +
             "Merci de bien vouloir remplir les champs de localisation manuellement.", "error");
    }
}

google.maps.event.addDomListener(window, 'load', initialize);
