<?php
/**
 * Created by PhpStorm.
 * User: Charlie
 * Date: 08/03/14
 * Time: 14:49
 */

class F_Food {

    public function __constructor(){

        $db = new HC_DB();

        $rst = mysql_fetch_array( $db->query("SELECT * FROM food"));
        $typeRst = mysql_fetch_array($db->query("SELECT BusinessType, BusinessTypeID FROM food"));

        $types = array();

        $id = $rst["id"];
        $fhrsid = $rst["FHRSID"];
        $LocAuthBusID = $rst["LocalAuthorityBusinessID"];
        $businessName = $rst["BusinessName"];
        $businessType = $rst["BusinessType"];
        $businessTypeID = $rst["BusinessTypeID"];
        $addressLine1 = $rst["AddressLine1"];
        $addressLine2 = $rst["AddressLine2"];
        $addressLine3 = $rst["AddressLine3"];
        $addressLine4 = $rst["AddressLine4"];
        $postCode = $rst["PostCode"];
        $ratingValue = $rst["RatingValue"];
        $ratingKey = $rst["RatingKey"];
        $ratingDate = $rst["RatingDate"];
        $locAuthCode = $rst["LocalAuthorityCode"];
        $locAuthName = $rst["LocalAuthorityName"];
        $locAuthWeb = $rst["LocalAuthorityWebsite"];
        $LocAuthEmaAdd = $rst["LocalAuthorityEmailAddress"];
        $hyg = $rst["Hygiene"];
        $struct = $rst["Structural"];
        $confInMan = $rst["ConfidenceInManagement"];
        $schemeType = $rst["SchemeType"];
        $long = $rst["Longitude"];
        $lat = $rst["Latitude"];
        $loc = array($long,$lat);
        $available =$rst["available"];
        $open = $rst["open"];
        $close = $rst["close"];

        typeID($businessType,$businessTypeID,$types);
    }

    public function typeId($businessType,$businessTypeID, $types)
    {
        $arraySize = sizeof($businessTypeID);



        for($x = 0; $x < $arraySize; $x++)
        {
            if(!in_array($businessType,$types))
            {
                if($businessTypeID[x] == $businessType[x])
                {
                    $types[$businessType][$businessTypeID];
                }
            }

        }

        return $types;
    }

    public function findBusiness($types,$businessType,$businessTypeID,$busiName,$id,$loc,$open,$close,$available,$hyg,$ratingValue)
    {
        $arraySize = sizeof($businessTypeID);
        for($x = 0; $x < $arraySize; $x++)
        {
           // $resArray = $types[$x];
           $resArray = array(
                $types[$x]=>array
                (
                    "Name",
                    "ID",
                    "Location"=>array
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
            switch($types[][$x]) {
                case $x:
                    $resArray[$types[$x]]["Name"][$busiName[x]];
                    $resArray[$types[$x]]["ID"][$id[x]];
                    //$resCafCan["resCafCan"]["Name"][$loc[x,x]];
                    $resArray[$types[$x]]["Type"][$businessType[x]];
                    $resArray[$types[$x]]["Open"][$open[x]];
                    $resArray[$types[$x]]["Close"][$close[x]];
                    $resArray[$types[$x]]["Available"][$available[x]];
                    $resArray[$types[$x]]["Hygiene"][$hyg[x]];
                    $resArray[$types[$x]]["Rating"][$ratingValue[x]];
                break;
            }
        }
    }

  
} 