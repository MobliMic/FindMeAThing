<?php

require_once('../../../.application/food.class.php');

$food = new F_Food();

$lat = $_POST['lat'];
$long = $_POST['long'];
$distance = $_POST['dist'];

$near = $food->getNearbyBusinesses($lat, $long, $distance);

print_r($near);