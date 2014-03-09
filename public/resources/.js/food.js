/**
 * Created by Michael on 09/03/14.
 */
console.log('food');

function updateFoodList(object) {

    console.log(object);

    var newobject = JSON.parse(object);

    $.each(newobject, function (index, value) {
        console.log(index);
        console.warn(value);

        $('#locationContainer').append(
            '<a href="food/summary.php?name=Super%20Cool%20NomNom%20Place" class="btn btn-block btn-default text-left">' +
                value.Name +
                '<br>30m -<span class="glyphicons star"></span>' +
                '<span class="glyphicons star"></span>' +
                '<span class="glyphicons star"></span></a>'
        );
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