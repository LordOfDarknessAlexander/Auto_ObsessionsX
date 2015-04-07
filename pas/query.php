<?php
//this script contains the functionality for preforming
//queries the various AO databases, echoing out the results as an ajax response,
//database values are not set by this script, only read and returned!
//used by javascript ajax requests
//
require_once 'get.php';
require_once '../re.php';
//php namespaces require PHP 5.0 or greater, but server only runs v4 :(
//use \pas\get as pg;
//use pas\get\user as pgu;
//use pas\get\auction as pga;
//use pas\get\sales as pgs;
function echoUserCars(){
    //selects all vehicles the user owns, returning it as a JSON array
    global $aoUsersDB;
    
    $cars = array();
    $userID = getUserTableName();
    
    $res = $aoUsersDB->query(
        "SELECT * FROM $userID"
    );

    if($res){
        while($row = mysqli_fetch_array($res) ){
            //insert an new array representing a car at the end of $cars
            $cars[] = array(
                'carID' => intval($row['car_id']),
                'drivetrain' => intval($row['drivetrain']),
                'body' => intval($row['body']),
                'interior' => intval($row['interior']),
                'docs' => intval($row['docs']),
                'repairs' => intval($row['repairs'])
                //'info'=>$row['info']
            );
        }
        mysqli_free_result($res);
        //echo json_encode($cars);
    }
    else{   //The vehicle is already registered
        echo "<p class='error'>Query failed, Table: $userID, in aoUsersDB has no entries</p>";
    }
    //echo 'WIN!';
    //exit();
    echo json_encode($cars);
}

function eLoadUser(){
    //loads all the user's data from a single ajax call!
    global $aoUsersDB;
    
    $cars = array();
    $userID = getUserTableName();
    
    $res = $aoUsersDB->query(
        "SELECT * FROM $userID"
    );

    if($res){
        while($row = mysqli_fetch_array($res) ){
            //insert an new array representing a car at the end of $cars
            $cars[] = array(
                'carID' => intval($row['car_id']),
                'drivetrain' => intval($row['drivetrain']),
                'body' => intval($row['body']),
                'interior' => intval($row['interior']),
                'docs' => intval($row['docs']),
                'repairs' => intval($row['repairs'])
                //info=>$row['info']
            );
        }
        mysqli_free_result($res);
        //echo json_encode($cars);
    }
    else{
        echo "<p class='error'>Query failed, Table: $userID, in aoUsersDB has no entries</p>";
    }
    echo json_encode(array(
        'stats'=>pasGet::userStats(),
        'garage'=>$cars,
        'sales'=>pasGet::userSales()
    ));
}

function getUserSoldCars(){
    //selects all vehicles sold by the currently logged-in user
    //returning them as a JSON array
    global $aoCarSalesDB;
    $user = getUserTableName();
    $cars = array();

    //$res = $aoCarSalesDB->query(
        //"SELECT * FROM $user"
    //);
    
    //if($res){        
        //while($row = mysqli_fetch_array($res) ){
            //$carID = intval($row['carID']);
            //$cars[] = array(
                //'carID' => $carID,
                //'drivetrain' => intval($row['drivetrain']),
                //'body' => intval($row['body']),
                //'interior' => intval($row['interior']),
                //'docs' => intval($row['docs']),
                //'repairs' => intval($row['repairs']),
                //'price' => hasCar($carID)   //does user have this car?
                //'date=>array(
                    //'start'=>$row['start'],
                    //'end'=>$row['end']
                //)
           //);
        //}
        //mysqli_free_result($res);
    //}
    //else{   //The vehicle is already registered
        //echo "<p class='error'>User: has no entries in database</p>";
    //}
    echo json_encode($cars);
}
//echo json_encode(false);
//exit();
if(isset($_GET) && !empty($_GET) ){
    //args being passed vai the url
    //regex match, must contain no whitespace, numbers or special characters!
    $op = (isset($_GET['op']) && isAlpha($_GET['op']) ) ? $_GET['op'] : '';
    
    if($op == 'asc'){
        pasGet::auctionCars();
        exit();
    }
    if($op == 'gucc'){
        //echo json_encode(pasGet::currentCar() );
        exit();
    }
    if($op == 'gcid'){
        echo json_encode(pasGet::currentCarID() );
        exit();
    }
    elseif($op == 'gug'){
        //get user garage
        echoUserCars();
        exit();
    }
    //elseif($op == 'ucs'){
        //pasGet::userCarSales();
        //exit();
    //}
    //elseif($op == '') preform other operations
    //else not supported
    echo "operation:$op, script calling exit()";
    exit();
}
//else no vars passed via GET
//echo '_GET not set, checking $_POST';
//exit();
if(isset($_POST) && !empty($_POST) ){
    //echo 'post set!';
    //echo json_encode($_POST);
    //exit();    
    if(isset($_POST['carID'])){
        $carID = $_POST['carID'];
        //validate value, must be an int!
        //echo json_encode($carID);
        //access other post vars!
        //
        //switch the operation besed on value passed in url
        //
        if(isset($_GET) && !empty($_GET) ){
            //args being passed via the url
            $op = (isset($_GET['op']) && isAlpha($_GET['op']) ) ? $_GET['op'] : '';

            if($op == 'hasCar'){
                //echo '{"hasCar": ' . strval(false) . '}';
                echo json_encode(hasCar($carID) );
                exit();
            }
            //elseif($op == 'hsc'){
                //echo json_encode(hasSoldCar($carID) );
                //exit();
            //}
            //elseif($op == '') switch to other calls
            //else not supported
            echo "unsupported operation:$op, script calling exit()";
            exit();
        }
        //else no GET args, simply return data of car with id
        $car = getCarFromID($carID);
        //echo $car != null?
            //$car->toJSON()
            //:
            //json_encode("no car with id:$carID, found in database");
        if($car != null){
            echo $car->toJSON();
        }
        else{
            echo "no car with id:$carID, found in database";  //return emtpy object
        }
        exit();
    }
    //other post vars
    echo 'other post vars';// . json_encode($_POST);
    exit();
}
else{
    //no passing any values via POST, return all user data
    //echo json_encode(true);
    //echoUserCars();
    eLoadUser();
    exit();
}
echo 'fail';
exit();
?>