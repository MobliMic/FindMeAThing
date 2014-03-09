/**
 * Created by Michael on 09/03/14.
 */


function updateFoodList() {

    var object = nearBusiness();
    /*
     $.each(object, function (index, value) {
     console.log(index);
     console.warn(value);
     });*/

    for (var key in object) {
        console.log(object[key]);
    }

}


$(document).ready(function () {
    updateCoordinates();
    updateFoodList();
});