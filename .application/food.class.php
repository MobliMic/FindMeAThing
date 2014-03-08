<?php
/**
 * Created by PhpStorm.
 * User: Charlie
 * Date: 08/03/14
 * Time: 14:49
 */

class F_Food {

    private $id;
    private $fhrsid;
    private $LocAuthBusID;
    private $businessName;
    private $businessType;
    private $businessTypeID;
    private $addressLine1;
    private $addressLine2;
    private $addressLine3;
    private $addressLine4;
    private $postCode;
    private $ratingValue;
    private $ratingKey;
    private $ratingDate;
    private $locAuthCode;
    private $locAuthName;
    private $locAuthWeb;
    private $LocAuthEmaAdd;
    private $hyg;
    private $struct;
    private $confInMan;
    private $schemeType;
    private $long;
    private $lat;
    private $loc;
    private $available;
    private $open;
    private $close;
    private $types = array();

    public function __construct(){

        $db = new HC_DB();

        $rst = mysql_fetch_array( $db->query("SELECT * FROM food"));
        $typeRst = mysql_fetch_array($db->query("SELECT BusinessType, BusinessTypeID FROM food"));

        $this->types = array();


        $this->id = $rst["id"];
        $this->fhrsid = $rst["FHRSID"];
        $this->LocAuthBusID = $rst["LocalAuthorityBusinessID"];
        $this->businessName = $rst["BusinessName"];
        $this->businessType = $rst["BusinessType"];
        $this->businessTypeID = $rst["BusinessTypeID"];
        $this->addressLine1 = $rst["AddressLine1"];
        $this->addressLine2 = $rst["AddressLine2"];
        $this->addressLine3 = $rst["AddressLine3"];
        $this->addressLine4 = $rst["AddressLine4"];
        $this->postCode = $rst["PostCode"];
        $this->ratingValue = $rst["RatingValue"];
        $this->ratingKey = $rst["RatingKey"];
        $this->ratingDate = $rst["RatingDate"];
        $this->locAuthCode = $rst["LocalAuthorityCode"];
        $this->locAuthName = $rst["LocalAuthorityName"];
        $this->locAuthWeb = $rst["LocalAuthorityWebsite"];
        $this->LocAuthEmaAdd = $rst["LocalAuthorityEmailAddress"];
        $this->hyg = $rst["Hygiene"];
        $this->struct = $rst["Structural"];
        $this->confInMan = $rst["ConfidenceInManagement"];
        $this->schemeType = $rst["SchemeType"];
        $this->long = $rst["Longitude"];
        $this->lat = $rst["Latitude"];
        $this->loc = array($this->long,$this->lat);
        $this->available =$rst["available"];
        $this->open = $rst["open"];
        $this->close = $rst["close"];

        typeID();
    }

    public function typeId()
    {
        $this->arraySize = sizeof($this->businessTypeID);



        for($x = 0; $x <  $this->arraySize; $x++)
        {
            if(!in_array( $this->businessType, $this->types))
            {
                if( $this->businessTypeID[x] ==  $this->businessType[x])
                {
                    $this->types[$this->businessType][$this->businessTypeID];
                }
            }

        }

        return $this->types;
    }

    public function findBusiness()
    {
        $this->arraySize = sizeof($this->businessTypeID);
        $y = 0;
        for($x = 0; $x < $this->arraySize; $x++)
        {
           // $resArray = $types[$x];
           $resArray = array(
               $this->types[$x]=>array
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

            switch($this->types[$y][$x]) {
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
    }

  
} 