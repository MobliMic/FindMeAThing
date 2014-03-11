/**
 * Created by Michael on 09/03/14.
 */
console.log('convert');

function mileToKm(miles) {

    return miles * 1.60934;

}

function kmToMile(km) {

    return km / 1.60934;
}

function kmToM(km) {

    return km * 1000;

}

function milesToMeters(miles) {

    var km = mileToKm(miles);

    var meters = kmToM(km);

    return meters;

}