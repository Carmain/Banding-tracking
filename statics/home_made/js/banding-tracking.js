var input = $(".mandatory");

/**
 * When the user leave an input, we color it if it's empty
 * @param  {events}  One or more space-separated event types and optional namespaces
 * @param  {handler} A function to execute when the event is triggered.
 */
input.on("blur keyup", function () {
     if ($(this).val().length <= 0) {
         $(this).css("background", "#FFCCCC");
         console.log(this);
     } else {
         $(this).css("background", "");
     }
});

/**
 * Check if any require field is empty when we submit the form
 * @param  {events}  One or more space-separated event types and optional namespaces
 * @param  {handler} A function to execute when the event is triggered.
 */
$("form").on("submit", function (event) {
   event.preventDefault();
   var missing_require = false;
   console.log(input);
   
   for (var i = 0; i < input.length; i++) {
        if ($(input[i]).val().length <= 0) {
            $(input[i]).css("background", "#FFCCCC");
            missing_require = true;
        } else {
            $(this).css("background", "");
        }
    }
   
    if (!missing_require) {
        this.submit();
    }
    else {
        swal("Erreur dans le formulaire",
             "Un ou plusieurs champs n'ont pas été remplis correctement", "warning");
    }
});

function getMarker(positionSet, map) {
    var myMarker = new google.maps.Marker({
        position: positionSet,
        map: map,
    });
}

function getPosition(latitude, longitude) {
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

    var map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);
    getMarker(positionSet, map);
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
        alert('Votre navigateur ne prends pas en compte la géolocalisation, merci de ne vous fier qu\'au champs à remplir');
    }
}

google.maps.event.addDomListener(window, 'load', initialize);