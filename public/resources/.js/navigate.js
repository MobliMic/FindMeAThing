console.log('Navigate');

function initializeNavigator(latitude, longitude) {
    if (typeof (window.directionsDisplay) == 'undefined') {
        window.directionsDisplay = new google.maps.DirectionsRenderer();
    }

    if (typeof (window.directionsService) == 'undefined') {
        window.directionsService = new google.maps.DirectionsService();
    }

    window.map = new google.maps.Map($('#map-canvas')[0], {
        zoom: 7,
        center: new google.maps.LatLng(latitude, longitude)
    });
    directionsDisplay.setMap(map);
    directionsDisplay.setPanel($('#directions-panel')[0]);
    window.trafficLayer = new google.maps.TrafficLayer();
    trafficLayer.setMap(map);
}

function showSteps(directionResult) {
    // For each step, place a marker, and add the text to the marker's
    // info window. Also attach the marker to an array so we
    // can keep track of it and remove it when calculating new
    // routes.
    var myRoute = directionResult.routes[0].legs[0];

    for (var i = 0; i < myRoute.steps.length; i++) {
        var marker = new google.maps.Marker({
            position: myRoute.steps[i].start_location,
            map: map
        });
        attachInstructionText(marker, myRoute.steps[i].instructions);
        markerArray[i] = marker;
    }
}

function attachInstructionText(marker, text) {
    google.maps.event.addListener(marker, 'click', function() {
        // Open an info window when the marker is clicked on,
        // containing the text of the step.
        stepDisplay.setContent(text);
        stepDisplay.open(map, marker);
    });
}

function calcRoute(start, end) {
    console.log(start, end);

    // First, remove any existing markers from the map.
    for (var i = 0; i < markerArray.length; i++) {
        markerArray[i].setMap(null);
    }

    // Now, clear the array itself.
    markerArray = [];

    var request = {
        origin: start,
        destination: end,
        travelMode: google.maps.TravelMode[$('#mode').val()]
    };

    directionsService.route(request, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            if(response.routes[0].warnings != ''){
                $('#warning').slideUp(400, function(){
                    $('#warningText').html(response.routes[0].warnings);
                    $('#warning').slideDown();
                });
                response.routes[0].warnings = '';
            } else {
                if($('#warning').css('display') == 'block'){
                    $('#warning').slideUp();
                }
            }
            directionsDisplay.setDirections(response);
            showSteps(response);
        }
    });
}

function reCalcMap(){
    calcRoute(String(window.coordinates.coords.latitude) + ', ' + String(window.coordinates.coords.longitude), String(window.urlVars['latitude']) + ', ' + String(window.urlVars['longitude']));
}

/**
 * Calculate the bearing between two positions as a value from 0-360
 *
 * @param lat1 - The latitude of the first position
 * @param lng1 - The longitude of the first position
 * @param lat2 - The latitude of the second position
 * @param lng2 - The longitude of the second position
 *
 * @return int - The bearing between 0 and 360
 */
function bearing(lat1,lng1,lat2,lng2) {
    var dLon = (lng2-lng1);
    var y = Math.sin(dLon) * Math.cos(lat2);
    var x = Math.cos(lat1)*Math.sin(lat2) - Math.sin(lat1)*Math.cos(lat2)*Math.cos(dLon);
    var brng = this._toDeg(Math.atan2(y, x));
    return 360 - ((brng + 360) % 360);
}

/**
 * Since not all browsers implement this we have our own utility that will
 * convert from degrees into radians
 *
 * @param deg - The degrees to be converted into radians
 * @return radians
 */
function _toRad(deg) {
    return deg * Math.PI / 180;
}

/**
 * Since not all browsers implement this we have our own utility that will
 * convert from radians into degrees
 *
 * @param rad - The radians to be converted into degrees
 * @return degrees
 */
function _toDeg(rad) {
    return rad * 180 / Math.PI;
}
function updateCompass(bearing) {
    var direction = 0;
    if (typeof window.orientation.webkitCompassHeading !== 'undefined') {
        direction = window.orientation.webkitCompassHeading;
        if (typeof window.orientation !== 'undefined') {
            direction += window.orientation;
        }
    } else {
        // http://dev.w3.org/geo/api/spec-source-orientation.html#deviceorientation
        direction = 360 - window.orientation.alpha;
    }
    bearing = (parseInt(bearing)-parseInt(direction));
    $('#alpha').text(window.orientation.alpha);
    $('#beta').text(window.orientation.beta);
    $('#gamma').text(window.orientation.gamma);
    $('#direction').text(bearing);
    $('#compass').css('-ms-transform','rotate('  + (bearing) + 'deg)');
    $('#compass').css('-webkit-transform','rotate('  + (bearing) + 'deg)');
    $('#compass').css('transform','rotate('  + (bearing) + 'deg)');
    console.log(direction, bearing);
}

function initNav() {
    window.markerArray = [];
    window.coordinates = {"timestamp": 0, "coords": {"speed": null, "heading": null, "altitudeAccuracy": null, "accuracy": 140000, "altitude": null, "longitude": 0, "latitude": 0}};
    window.urlVars = getUrlVars();
    window.ref = 0;
    window.dir = 0;
    if (typeof (window.urlVars['latitude']) != 'undefined') {
        if (typeof (window.urlVars['longitude']) != 'undefined') {
            updateCoordinates(function () {
                var r = window.coordinates;
                if (typeof (r) != 'undefined') {
                    if (typeof (r.coords) != 'undefined') {
                        initializeNavigator(r.coords.latitude, r.coords.longitude);
                        calcRoute(String(r.coords.latitude) + ', ' + String(r.coords.longitude), String(window.urlVars['latitude']) + ', ' + String(window.urlVars['longitude']));
                        getOrientation(function(c){
                             updateCompass(bearing(parseInt(window.coordinates.coords.latitude),parseInt(window.coordinates.coords.longitude), parseInt(window.urlVars['latitude']), parseInt(window.urlVars['longitude'])));
                        });
                    } else {
                        console.log(r);
                        alert('Failed to get coordinates 3');
                    }
                } else {
                    alert('Failed to get coordinates 2');
                }
            }, function (r) {
                console.log(r);
                alert('Failed to get coordinates 1');
            });
        } else {
            alert('No longitude');
        }
    } else {
        alert('No latitude')
    }
}

$(document).ready(function () {
    try {
        initNav();
    } catch(e) {
        alert(JSON.stringify(e));
    }
});