<?php

require_once('../../../.core/core.class.php');

$food = new F_Food();

$lat = $_POST['lat'];
$long = $_POST['long'];
$distance = $_POST['dist'];

$near = $food->getNearbyBusinesses($lat, $long, $distance);

echo json_encode($near);