console.log('Main');

function updateCoordinates(success, failure){
    var success_callback = function (r){
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

    geo_position_js.getCurrentPosition(success_callback,error_callback);
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
    window.ref = 0;
    window.dir = 0;
    var direction, delta, heading;
    window.addEventListener('deviceorientation', function(e) {
        console.log(e);
        $('#alpha').text(e.alpha);
        $('#beta').text(e.beta);
        $('#gamma').text(e.gamma);
        e.direction = 360 - e.alpha;
        var delta = Math.round(e.direction) - ref;
        ref = Math.round(e.direction);
        if (delta < -180)
            delta += 360;
        if (delta > 180)
            delta -= 360;
        dir += delta;

        heading = direction;
        while (heading >= 360) {
            heading -= 360;
        }
        while (heading < 0) {
            heading += 360;
        }
        heading = Math.round(heading);
        e.heading = heading;
        $('#direction').text(heading);
        window.orientation = e;
        callback.call(e);
    });
}

$(document).ready(function(){
    if(geo_position_js.init()){
        if (window.DeviceOrientationEvent) {
            getOrientation(function(){
                window.geoInterval = setInterval(updateCoordinates(),10000);
            });
        } else {
            alert('No device orientation');
        }
    }else{
        alert("Functionality not available");
    }
});
