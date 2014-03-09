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

    public function getSingleBusiness($id)
    {

    }


    /**
     * @deprecated
     * @return array
     */
    public function findBusiness()
    {
        $this->arraySize = sizeof($this->businessTypeID);
        $y = 0;
        for ($x = 0; $x < $this->arraySize; $x++) {
            // $resArray = $types[$x];
            $this->resArray = array(
                $this->types[$x] => array
                (
                    "Name",
                    "ID",
                    "Location" => array
                    (
                        "Lat",
                        "Long"
                    ),
                    "Type",
                    "Open",
                    "Close",
                    "Available",
                    "Hygiene",
                    "Rating"
                )

            );

            switch ($this->types[$y][$x]) {
                case $x:
                    $this->resArray[$this->types[$x]]["Name"][$this->busiName[x]];
                    $this->resArray[$this->types[$x]]["ID"][$this->id[x]];
                    //$resCafCan["resCafCan"]["Name"][$loc[x,x]];
                    $this->resArray[$this->types[$x]]["Type"][$this->businessType[x]];
                    $this->resArray[$this->types[$x]]["Open"][$this->open[x]];
                    $this->resArray[$this->types[$x]]["Close"][$this->close[x]];
                    $this->resArray[$this->types[$x]]["Available"][$this->available[x]];
                    $this->resArray[$this->types[$x]]["Hygiene"][$this->hyg[x]];
                    $this->resArray[$this->types[$x]]["Rating"][$this->ratingValue[x]];
                    break;
            }
        }

        return $this->resArray;
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