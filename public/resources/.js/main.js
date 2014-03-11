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

function getOrientation(callback){
    window.orientation = {alpha: 0, beta: 0, gamma: 0};
    window.addEventListener('deviceorientation', function(e) {
        window.orientation = e;
        callback.call(e);
    });
}

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
