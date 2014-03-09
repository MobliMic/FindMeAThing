/**
 * Created by Michael on 09/03/14.
 */

function nearBusiness() {

    updateCoordinates();

    $.ajax({
        'type': 'post',
        'url': '/resources/ajax/food.php',
        'data': {'lat':window.coordinates.coords.latitude,'long':window.coordinates.coords.longitude,'dist':'10'}
    });

}