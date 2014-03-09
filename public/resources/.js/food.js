/**
 * Created by Michael on 09/03/14.
 */
console.log('food');

function updateFoodList(object) {

    console.log(object);

    object = json.parse(object);

    $.each(object, function (index, value) {
        console.log(index);
        console.warn(value);
    });

    console.log('im running');

    //for (var key in object) {
    //    console.log(object[key]);
    //}

}


$(document).ready(function () {
    //updateCoordinates();
    //nearBusiness(updateFoodList);
});