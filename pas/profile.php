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

//because arrays can be set and still empty(ie array() is set but also empty)
$gs = isset($_GET) && !empty($_GET) ? true : false; //get set
$ps = isset($_POST) && !empty($_POST) ? true : false;   //post set

class sql{
    public static function selectAll(&$tableName){
        //preferably, $tableName should be a single word,
        //but can also be expanded to include addional sql WHERE, GROUP BY, ORDER BY, LIMIT, etc statements
        return "SELECT * FROM $tableName";
    }
    //public static function selectAll(&$tableName, &$stmtsStr){
        //preferably, $tableName should be a single word,
        //but can also be expanded to include addional sql WHERE, GROUP BY, ORDER BY, LIMIT, etc statements
        //return "SELECT * FROM $tableName WHERE $stmtsStr";
    //}
}

function getUserPurchases(){
    //$w = getUserWins();
    //$l = getUserLosses();
    //$avg = $l > 0 ? $w / $l : $w;
    
    return array(
        'carsOwned'=>0,
        'carsPurch'=>0,
        'urPurch'=>0,
        'carsSold'=>0,
        'wins'=>0,
        'losses'=>0,
        'avg'=>0
    );
}

function getUserIncome(){
    //$w = getUserWins();
    //$l = getUserLosses();
    //$avg = $l > 0 ? $w / $l : $w;
    
    return array(
        'fundsPurch'=>0.0,
        'tokensPurch'=>0.0,
        'aph'=>0.0,
        'tae'=>0.0,
        //
        'tic'=>0.0,
        'tiru'=>0.0,
        'tfs'=>0.0,
        'tts'=>0.0,
        'tpAH'=>0.0,
        //
        'nsp'=>0.0,
        'gsp'=>0.0,
        'ngd'=>0.0,
        'aGL'=>0.0
    );
}
function eUSerData(){
    //returns all stats for the user's profile
    $purch = getUserPurchases();
    $inc = getUserIncome();
    
    echo json_encode(array(
            'stats'=>$purch,
            'income'=>$inc
        )
    );
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
//
$OP = 'op';
//echo json_encode(false);
//exit();
if($gs){
    //echo 'GET set';
    //args being passed vai the url
    //regex match, must contain no whitespace, numbers or special characters!
    $op = (isset($_GET[$OP]) && isAlpha($_GET[$OP]) ) ? $_GET[$OP] : '';
    
    if($op == 'asc'){
        /*$T = 'type';
        $R = 'range';
        
        if($ps && (isset($_POST[$T]) || isset($_POST[$R]) ) ){
            $t = isset($_POST[$T]) ? $_POST[$T] : '';
            $r = isset($_POST[$R]) ? $_POST[$R] : '';
            //echo $t;
            //echo $r;
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
        //echo 'auction cars, no filter';
        pasGet::auctionCars();*/
        exit();
    }

    if($op == 'gucc'){
        //echo json_encode(pasGet::currentCar() );
        exit();
    }
    if($op == 'gcid'){
        //echo json_encode(pasGet::currentCarID() );
        exit();
    }
    elseif($op == 'gug'){
        //get user garage
        //echoUserCars();
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
//echo '_GET:$gs, not set, checking _POST:$ps';
//exit();
if($ps){
    //echo '_POST set: json_encode($_POST);
    //exit();  
    $CID = 'carID';
    
    if(isset($_POST[$CID])){
        $carID = $_POST[$CID];
        //validate value, must be an int!
        //echo json_encode($carID);
        //access other post vars!
        //
        //switch the operation besed on value passed in url
        //
        if($gs){
            //args being passed via the url
            //echo '_GET set: ' . json_encode($_GET);
            //exit();
            $op = (isset($_GET[$OP]) && isAlpha($_GET[$OP]) ) ? $_GET[$OP] : '';

            if($op == 'hasCar'){
                //echo '{"hasCar": ' . strval(false) . '}';
                //echo json_encode(hasCar($carID) );
                exit();
            }
            //elseif($op == 'usp'){
                //eUserPurchases();
                //exit();
            //}
            //elseif($op == 'usi'){
                //eUserIncome();
                //exit();
            //}
            //elseif($op == '') switch to other calls
            //else not supported
            echo "unsupported operation:$op, script calling exit()";
            exit();
        }
        //else no GET args, simply return data of car with id
        //$car = getCarFromID($carID);
        //echo $car != null?
            //$car->toJSON()
            //:
            //json_encode("no car with id:$carID, found in database");
        //if($car != null){
            //echo $car->toJSON();
        //}
        //else{
            //echo "no car with id:$carID, found in database";  //return emtpy object
        //}
        exit();
    }
    //other post vars
    echo 'other post vars'; // . json_encode($_POST);
    exit();
}
else{
    //no passing any values via POST, return all user data
    //echo json_encode(true);
    //echoUserCars();
    eUserData();
    exit();
}
//all other branches of execution have been exhausted, should never get here
echo 'fail';
exit();
?>