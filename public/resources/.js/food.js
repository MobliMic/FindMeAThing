/**
 * Created by Michael on 09/03/14.
 */
console.log('food');

function updateFoodList(object) {

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
    nearBusiness(updateFoodList);
});