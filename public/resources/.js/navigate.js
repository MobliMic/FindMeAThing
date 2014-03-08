console.log('Navigate');

function initializeNavigator() {
    window.directionsDisplay = new google.maps.DirectionsRenderer();
    window.directionsService = new google.maps.DirectionsService();

    var mapOptions = {
        zoom: 7,
        center: new google.maps.LatLng(41.850033, -87.6500523)
    };
    var map = new google.maps.Map($('#map-canvas')[0],
        mapOptions);
    directionsDisplay.setMap(map);
    directionsDisplay.setPanel($('#directions-panel')[0]);
}

function calcRoute(start, end) {
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
    if(typeof(window.urlVars['lat']) != 'undefined'){
        if(typeof(window.urlVars['long']) != 'undefined'){
            updateCoordinates(function(r){
                if(typeof(r) != 'undefined'){
                    if(typeof(r.coords) != 'undefined'){
                        initializeNavigator();
                        calcRoute(String(r.coords.latitude) + ' ' + String(r.coords.longitude), String(window.urlVars['latitude']) + ' ' + String(window.urlVars['longitude']));
                    } else {
                        console.log(r);
                        alert('Failed to get coordinates');
                    }
                } else {
                    console.log(r);
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