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
$gs = isset($_GET) && !empty($_GET) ? true : false;
$ps = isset($_POST) && !empty($_POST) ? true : false;

function getCarStatsFromArray($row){
    //convert the result of an sql query,
    //which stores all values as strings,
    //to the proper primitives/types
    $CID = ao::CID;
    //
    $DT = 'drivetrain';
    $B = 'body';
    $IN = 'interior';
    $R = 'repairs';
    $D = 'docs';
    
    return array(
        'carID'=>intval($row[$CID]),
        $DT=>intval($row[$DT]),
        $B=>intval($row[$B]),
        $IN=>intval($row[$IN]),
        $D=>intval($row[$D]),
        $R=>intval($row[$R])
    );
}

function echoUserCars(){
    //selects all vehicles the user owns, returning it as a JSON array
    global $aoUsersDB;
    
    $cars = array();
    //$userID = getUserTableName();
    
    //$DT = 'drivetrain';
    //$CID = ao::CID;
    //$B = 'body';
    //$IN = 'interior';
    //$R = 'repairs';
    //$D = 'docs';
    
    $res = $aoUsersDB->query(
        sql::slctAllFromUserTable() //"SELECT * FROM $userID"
    );

    if($res){
        while($row = mysqli_fetch_array($res) ){
            //insert an new array representing a car at the end of $cars
            $cars[] = getCarStatsFromArray($row);
        }
        $res->close();
        //echo json_encode($cars);
    }
    else{   //The vehicle is already registered
        $aoUsersDB->eErr();
    }
    //echo 'WIN!';
    //exit();
    echo json_encode($cars);
}

function eLoadUser(){
    //loads all the user's data from a single ajax call!
    global $aoUsersDB;
    
    $cars = array();
    //$userID = getUserTableName();
    
    $res = $aoUsersDB->query(
        sql::slctAllFromUserTable() //"SELECT * FROM $userID"
    );

    if($res){
        while($row = mysqli_fetch_array($res) ){
            //insert an new array representing a car at the end of $cars
            $cars[] = getCarStatsFromArray($row);
        }
        $res->close();
        //echo json_encode($cars);
    }
    else{
        //echo "<p class='error'>Query failed, Table: $userID, in aoUsersDB has no entries</p>";
        $aoUsersDB->eErr();
    }
    echo json_encode(array(
        'stats'=>user::getStats(),
        'garage'=>$cars,
        'sales'=>pasGet::userSales()
    ));
}

function getUserSoldCars(){
    //selects all vehicles sold by the currently logged-in user
    //returning them as a JSON array
    global $aoCarSalesDB;
    //$user = getUserTableName();
    $cars = array();

    //$res = $aoCarSalesDB->query(
        //sql::slctAllFromUserTable()
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

if($gs){
    //echo '_GET';
    //args being passed vai the url
    //regex match, must contain no whitespace, numbers or special characters!
    $OP = 'op';
    $op = (isset($_GET[$OP]) && isAlphaSmall($_GET[$OP]) ) ? $_GET[$OP] : '';
    
    if($op == 'asc'){
        $T = 'type';
        $R = 'range';
        
        if($ps && (isset($_POST[$T]) || isset($_POST[$R]) ) ){
            $t = (isset($_POST[$T]) && isAlphaSmall($_POST[$T]) ) ? $_POST[$T] : '';
            $r = (isset($_POST[$R]) && isAlphaSmall($_POST[$R]) ) ? $_POST[$R] : '';
            //echo "_POST:" . json_encode($_POST);
            //echo "R:$r";
            if($t != '' && $r != ''){
                //echo 'auction cars, type and range';
                pasGet::auctionCarsByTypeAndRange($t, $r);
                exit();
            }
            elseif($t == '' && $r != ''){
                //echo "auction cars, range ($r)";
                pasGet::auctionCarsByPriceRange($r);
                exit();
            }
            elseif($t != '' && $r == ''){
                //echo "auction cars, type ($t)";
                pasGet::auctionCarsByType($t);
                exit();
            }
        }
        //echo 'auction cars, no filter!';
        pasGet::auctionCars();
        exit();
    }
    
    if($op == 'gus'){
        //get user stats
        echo json_encode(user::getStats() );
        exit();
    }
    if($op == 'gucc'){
        //echo json_encode(pasGet::currentCar() );
        exit();
    }
    if($op == 'gcid'){
        //get currect user car id
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
if($ps){
    $OP = 'op';
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
        if($gs){
            //args being passed via the url
            $op = (isset($_GET[$OP]) && isAlpha($_GET[$OP]) ) ? $_GET[$OP] : '';

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
    /*elseif(isset($_POST['type']) || isset($_POST['range']) ){
        $op = (isset($_GET['op']) && isAlpha($_GET['op']) ) ? $_GET['op'] : '';
    
        if($op == 'asc'){
            $T = 'type';
            $R = 'range';
            
            $t = isset($_POST[$T]) ? $_POST[$T] : '';
            $r = isset($_POST[$R]) ? $_POST[$R] : '';
            //echo $t;
            //echo $r;
            if($t != '' && $r != ''){
                echo 'type and range';
                pasGet::auctionCarsByTypeAndRange($t, $r);
                //pasGet::auctionCars();
                exit();
            }
            elseif($t == '' && $r != ''){
                echo 'range';
                //pasGet::auctionCarsByPriceRange($r);
                exit();
            }
            elseif($t != '' && $r == ''){
                echo 'type';
                pasGet::auctionCarsByType($r);
                exit();
            }
            //echo invalid $_POST;
            exit();
        }
    }*/
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