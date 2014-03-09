console.log('Main');

function updateCoordinates(success, failure){
    var success_callback = function (r){
        window.coordinates = r;
        window.localStorage.setItem('coordinates', JSON.stringify(r));
        if(typeof(success) != 'undefined'){
            success.call(r);
        }
    };

    var error_callback = function (r){
        console.log('Failure', r);
        if(typeof(failure) != 'undefined'){
            failure.call(r);
        }
    };
    if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(success_callback,error_callback);
    } else {
        alert('Could not get location');
    }
}

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}


function getOrientation(callback){
    window.orientation = {alpha: 0, beta: 0, gamma: 0};
    window.addEventListener('deviceorientation', function(e) {
        console.log(e);
        // y-axis - yaw
        var g = e.gamma || 0;
        // x-axis - tilt
        var b = e.beta || 0;
        // z=axis - swivel
        var a = e.alpha || 0;
        // degree north
        var c = e.compassHeading || e.webkitCompassHeading || 0;
        // accuracy in deg
        var accuracy = e.compassAccuracy || e.webkitCompassAccuracy || 0;

        $('#alpha').text(a);
        $('#beta').text(b);
        $('#gamma').text(g);
        $('#direction').text(c);
        $('#compass').css('-ms-transform','rotate('  + c + 'deg)');
        $('#compass').css('-webkit-transform','rotate('  + c + 'deg)');
        $('#compass').css('transform','rotate('  + c + 'deg)');
        window.orientation = e;
        callback.call(e);
    });
}