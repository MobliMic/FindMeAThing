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
    window.addEventListener('deviceorientation', function(e) {
        window.orientation = e;
        callback.call(e);
        $('#alpha').text(e.alpha);
        $('#beta').text(e.beta);
        $('#gamma').text(e.gamma);
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
