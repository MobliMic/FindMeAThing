<?php

/**
 * Created by PhpStorm.
 * User: Charlie
 * Date: 08/03/14
 * Time: 14:49
 */
class F_Food
{

    var $db;

    public function __construct()
    {
        $this->db = new HC_DB();

        //self::typeId();
    }

    public function typeId()
    {
        $this->arraySize = sizeof($this->businessTypeID);


        for ($x = 0; $x < $this->arraySize; $x++) {
            if (!in_array($this->businessType, $this->types)) {
                if ($this->businessTypeID[x] == $this->businessType[x]) {
                    $this->types[$this->businessType][$this->businessTypeID];
                }
            }

        }

        return $this->types;
    }

    public function getBusinesses()
    {

        $businesses = [];

        $result = $this->db->query("SELECT id, BusinessName, Latitude, Longitude, BusinessType, open, close, available, RatingValue FROM food");

        foreach ($result as $key) {

            $businesses[$key['id']] = [
                "Name" => $key['BusinessName'],
                "ID" => $key['id'],
                "Location" => [
                    "Lat" => $key['Latitude'],
                    "Long" => $key['Longitude']
                ],
                "Type" => $key['BusinessType'],
                "Open" => $key['open'],
                "Close" => $key['close'],
                "Available" => $key['available'],
                "Rating" => $key['RatingValue']
            ];

        }

        return $businesses;
    }

    public function getNearbyBusinesses($userLat, $userLong, $distance = '10')
    {

        $businesses = [];

        $result = $this->db->query('
        SELECT
            id, BusinessName, BusinessTypeID, Latitude, Longitude, BusinessType, open, close, available, RatingValue,
            (3959 * acos(cos(radians(' . $userLat . ')) * cos(radians(Latitude)) * cos(radians(Longitude) - radians(' . $userLong . ')) + sin(radians(' . $userLat . ')) * sin(radians(Latitude)))) AS \'distance\'
        FROM
            food
        HAVING
            distance < ' . $distance . '
        AND
            BusinessTypeID IN (7843,7844,1)
        ORDER BY distance
        LIMIT 0 , 20
        ');

        foreach ($result as $key) {

            $businesses[$key['id']] = [
                "Name" => $key['BusinessName'],
                "ID" => $key['id'],
                "Location" => [
                    "Lat" => $key['Latitude'],
                    "Long" => $key['Longitude'],
                    'DistanceMiles' => $key['distance']
                ],
                "Type" => $key['BusinessType'],
                "Open" => $key['open'],
                "Close" => $key['close'],
                "Available" => $key['available'],
                "Rating" => $key['RatingValue']
            ];

        }

        return $businesses;

    }

    public function getSingleBusiness($id)
    {

    }

    public function searchType($searchType)
    {
        $arraySize = sizeof($this->resArray);
        $outArray = array();

        for ($x = 0; $x < $arraySize; $x++) {
            if (!preg_match($searchType, $this->resArray[$x])) {
                $this->resArray[$x] = $outArray[$x];
            }
        }

        return $outArray;
    }
} 