console.log('Main');

function updateCoordinates(success, failure){
    var success_callback = function (a){
        window.localStorage.setItem('coordinates', JSON.stringify(a.coords));
        if(typeof(success) != 'undefined'){
            success.callback(a);
        }
    };

    var error_callback = function (a){
        console.log('Failure', a);
        if(typeof(failure) != 'undefined'){
            failure.callback(a);
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


$(document).ready(function(){
    if(geo_position_js.init()){
        window.geoInterval = setInterval(updateCoordinates(),10000);
    }
    else{
        alert("Functionality not available");
    }
});
