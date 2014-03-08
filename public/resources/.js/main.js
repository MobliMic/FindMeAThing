console.log('Main');

if(geo_position_js.init()){
    var success_callback = function (a){
        console.log('Success', a);
    };

    var error_callback = function (a){
        console.log('Failure', a);
    };

    geo_position_js.getCurrentPosition(success_callback,error_callback);
}
else{
    alert("Functionality not available");
}