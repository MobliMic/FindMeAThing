console.log('Main');

if(geo_position_js.init()){
    window.coordinates = false;
    window.geoInterval = setInterval(function(){
        var success_callback = function (a){
            window.coordinates = a.coords;
        };

        var error_callback = function (a){
            console.log('Failure', a);
        };
        geo_position_js.getCurrentPosition(success_callback,error_callback);
    },10000);

}
else{
    alert("Functionality not available");
}