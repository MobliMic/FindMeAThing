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

        $rst = mysql_fetch_assoc($this->db->query("SELECT * FROM food"));

        $id = $rst["id"];
        $businessName = $rst["BusinessName"];
        $businessType = $rst["BusinessType"];
        $businessTypeID = $rst["BusinessTypeID"];
        $addressLine1 = $rst["AddressLine1"];
        $addressLine2 = $rst["AddressLine2"];
        $addressLine3 = $rst["AddressLine3"];
        $addressLine4 = $rst["AddressLine4"];
        $postCode = $rst["PostCode"];
        $ratingValue = $rst["RatingValue"];
        $locAuthWeb = $rst["LocalAuthorityWebsite"];
        $long = $rst["Longitude"];
        $lat = $rst["Latitude"];
        $loc = array($this->long, $this->lat);
        $available = $rst["available"];
        $open = $rst["open"];
        $close = $rst["close"];

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