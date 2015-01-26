<?php
//this script queries the vehicle database returning the results, used by javascript ajax requests
//require_once 'vehicle.php';
require_once '../include/dbConnect.php';  //sql database connection
//require_once '../include/secure.php';
//
//$CARS = dbConnect();  //global
//temporary until vehicle DB is setup!

//if($_SERVER['REQUEST_METHOD'] == 'POST'){   //&& isset($_POST) && !empty($_POST)
    //form submitted, add entries to server
    //$errors = array(); // Start an array named errors
    //
    //$e = VehicleEntry();
    //$make = $_POST['make'];
    //$year = $_POST['year'];
    //$name = $_POST['name'];
    
    //$stripped = strip('info');
    //$strlen = mb_strlen($stripped, 'utf8');
    //
    //if(!$strlen){
        //$errors[] = 'No car info.';
    //}
    //else{
        //$info = $stripped;
    //}
//echo $cars[0]->toJSON(); //serialize to JSON to send over internet
//}
?>