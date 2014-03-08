console.log('Main');

if(geo_position_js.init()){
    var success_callback = function (a, b ,c){
        console.log('Success', a, b, c);
    };

    var error_callback = function (a, b ,c){
        console.log('Failure', a, b, c);
    };

    geo_position_js.getCurrentPosition(success_callback,error_callback);
}
else{
    alert("Functionality not available");
}