/**
 * Created by Michael on 09/03/14.
 */
console.log('ajax');

function nearBusiness(callback) {

    updateCoordinates(function (callback) {
        $.ajax({
            'type': 'post',
            'url': '/resources/ajax/food.php',
            'data': {'lat': window.coordinates.coords.latitude, 'long': window.coordinates.coords.longitude, 'dist': '10'},
            'success': function (data) {
                console.log('success');
                callback.call(data);

            }
        })
    });

}
