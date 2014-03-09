/**
 * Created by Michael on 09/03/14.
 */


function updateFoodList() {

    $.each(nearBusiness(), function (index, value) {
        console.log(index);
        console.warn(value);
    });

}


$(document).ready(function () {
    updateCoordinates();
    updateFoodList();
});