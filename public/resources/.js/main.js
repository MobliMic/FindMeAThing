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
        $('#alpha').text(e.alpha);
        $('#beta').text(e.beta);
        $('#gamma').text(e.gamma);
        e.direction = 360 - e.alpha;

        e.delta = Math.round(e.direction) - ref;
        ref = Math.round(e.direction);
        if (e.delta < -180)
            e.delta += 360;
        if (e.delta > 180)
            e.delta -= 360;
        dir += e.delta;

        e.heading = e.direction;
        while (heading >= 360) {
            e.heading -= 360;
        }
        while (heading < 0) {
            e. heading += 360;
        }
        e.heading = Math.round(e.heading);
        $('#direction').text(e.direction);
        $('#compass').css('-ms-transform','rotate('  +e.direction + 'deg)');
        $('#compass').css('-webkit-transform','rotate('  +e.direction + 'deg)');
        $('#compass').css('transform','rotate('  +e.direction + 'deg)');
        window.orientation = e;
        callback.call(e);
    });
}