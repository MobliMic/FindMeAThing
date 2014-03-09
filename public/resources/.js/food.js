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

        var stars;
        for (x = 0; x <= value.Rating; x++) {
            stars += '<span class="glyphicons star"></span>';
        }

        $('#locationContainer').append(
            '<a href="food/summary.php?name=Super%20Cool%20NomNom%20Place" class="btn btn-block btn-default text-left">' +
                value.Name +
                '<br>' +
                value.Location.DistanceMiles +
                'm - ' +
                stars
                + '</a>'
        );
    });

    console.log('im running');

    //for (var key in object) {
    //    console.log(object[key]);
    //}

}


$(document).ready(function () {
    nearBusiness();
});