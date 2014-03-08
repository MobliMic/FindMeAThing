console.log('Navigate');

function initializeNavigator(lat, long) {
    window.directionsDisplay = new google.maps.DirectionsRenderer();
    window.directionsService = new google.maps.DirectionsService();

    var mapOptions = {
        zoom: 7,
        center: new google.maps.LatLng(lat, long)
    };
    var map = new google.maps.Map($('#map-canvas')[0],
        mapOptions);
    directionsDisplay.setMap(map);
    directionsDisplay.setPanel($('#directions-panel')[0]);
}

function calcRoute(start, end) {
    console.log(start, end);
    var request = {
        origin: start,
        destination: end,
        travelMode: google.maps.TravelMode.DRIVING
    };
    directionsService.route(request, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
        }
    });
}


$(document).ready(function(){
    window.urlVars = getUrlVars();
    if(typeof(window.urlVars['latitude']) != 'undefined'){
        if(typeof(window.urlVars['longitude']) != 'undefined'){
            updateCoordinates(function(){
                var r = JSON.parse(window.localStorage.getItem('coordinates'));
                if(typeof(r) != 'undefined'){
                    if(typeof(r.coords) != 'undefined'){
                        initializeNavigator(r.coords.latitude, r.coords.longitude);
                        calcRoute(String(r.coords.latitude) + ', ' + String(r.coords.longitude), String(window.urlVars['latitude']) + ', ' + String(window.urlVars['longitude']));
                    } else {
                        console.log(r);
                        alert('Failed to get coordinates');
                    }
                } else {
                    alert('Failed to get coordinates');
                }
            }, function(r){
                console.log(r);
                alert('Failed to get coordinates');
            });
        } else {
            alert('No longitude');
        }
    } else {
        alert('No latitude')
    }

});