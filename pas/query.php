<?php
//this script ONLY queries the vehicle database returning the results,
//database values are not set by this script, only read and returned!
//used by javascript ajax requests
//
//allow access to this file via file in the document's root directory
require_once 'meta.php';  //sql database connection
//
function getCurrentCar(){
    //returns the user's currently selected vehicle
    //global $AO_DB;
    /*$id = strval(0);  //$_SESSION['user_id'];
    $users = getUserTableName();
    
    $res = $AO_DB->query("SELECT curCarID FROM $users WHERE user_id = $id");
    
    if($res){
        //user has car
        //$ret = mysqli_num_rows($res) != 0 ? true : false;
    }
    else{
        //query failed, user has no entry in database
        ret = 0;
    }
    mysqli_free_result($res);
    
    return $ret;*/
}
function getAuctionCars(){
    //selects all vehicles from the primary AutoObsession vehicle table(in finalpost),
    //returning them as a JSON array
    global $AO_DB;
    $aoCars = 'aoCars';
    $cars = array();
    //static $getCar = $AO_DB->prepare(
        //"SELECT * FROM $aoCars"
    //);
    $res = $AO_DB->query(
        "SELECT * FROM $aoCars"
    );
    
    if($res){        
        while($row = mysqli_fetch_array($res) ){
            $carID = intval($row['car_id']);
            $cars[] = array(
                'carID' => $carID,
                'hasCar' => hasCar($carID)   //does user have this car?
                //'hasLostCar' => hasLostCar($carID)   //did the user lose the auction for this car
                //'hasSoldCar' => hasSoldCar($carID)   //does user have this car?
            );
        }
        mysqli_free_result($res);
    }
    else{   //The no entries in table
        //echo "<p class='error'>User: has no entries in database</p>";
    }
    echo json_encode($cars);
}
function getAuctionCarsCount(){
    //returns the number of entries in vehicle database
    global $AO_DB;
    $aoCars = 'aoCars';
    //$count is initialized when this is called for the first time
    static $count = 0;
    //static $getCars = $AO_DB->prepare(
        //"SELECT * FROM $aoCars"
    //);
    if($count == 0){
        //this should only execute once
        //static $getCars = $AO_DB->prepare(
            //"SELECT * FROM $aoCars"
        //);
        $res = $AO_DB->query(
            "SELECT * FROM $aoCars"
        );
        
        if($res){    
            //fetch each entry until there are no more
            while($row = mysqli_fetch_array($res) ){
                $count += 1;
            }
            mysqli_free_result($res);
        }
        else{   //The vehicle is already registered
            //echo "<p class='error'>User: has no entries in database</p>";
        }
    }
    return $count;
}
function getUserCarFromID($carID){
    //selects all vehicles the user owns, returning it as a JSON array
    global $aoUsersDB;
    $userID = getUserTableName();
    
    $res = $aoUsersDB->query(
        "SELECT * FROM $userID WHERE car_id = $carID"
    );
    if($res){
        if(mysqli_num_rows($res) != 0){
            //$q = "INSERT INTO vehicles (car_id, make, model, year, info) VALUES (' ', '$make', '$model', '$year', '$info')";		
            $data = $res->fetch_assoc();//@mysqli_query($CARS.$con, $q); // Run the query
            //if(DEBUG){
                //$car = Vehicle::fromArray($data);
                //echo '{"data":"this is data!"}';
                //echo $car->toJSON();
            //}
            //else{
                //echo Vehicle::fromArray($result->fetch_assoc() )->toJSON();
            //}
        } 
        else{ 
            echo "<h2>System Error</h2>
            <p class='error'>Vehicle could not be registered due to a system error. Please try again later</p>";
            //echo '<p>'.mysqli_error($CARS.$con).'<br><br>Query: '.$q.'</p>';
        } 
        mysqli_free_result($res);
    }
    else{   //The vehicle is already registered
        echo "<p class='error'>The email address is not acceptable because it is already registered</p>";
    }
}
function getUserCarCount(){
    //returns the number of entries in user's database(garage)
    global $aoUsersDB;
    $uid = getUserTableName();
    //$count is initialized when this is called for the first time
    $count = 0;
    //this should only execute once
    $res = $aoUsersDB->query(
        "SELECT * FROM $uid"
    );
    
    if($res){  
        $count = $res->num_rows;
        //fetch each entry until there are no more
        //while($row = mysqli_fetch_array($res) ){
            //$count += 1;
        //}
        $res->close();
    }
    //else{query failed, no entries in table}
    return $count;
}
//function getAuctionWins(){
    //returns how many auctions the user has won
//}
//function getAuctionLosses(){
    //returns how many auctions the user has lost
    //global aoFailedAuctions;
    //$uid = getUserTableName();
    //$count = 0;
    /*
    $res = $aoCarSalesDB->query(
        "SELECT * FROM $uid"
    );
    
    if($res){
        $count = $res->num_rows;
        //fetch each entry until there are no more
        //while($row = mysqli_fetch_array($res) ){
            //$count += 1;
        //}
        $res->close();
    }*/
//}
//function getAuctionAvg(){
    //returns aver ratio of wins/losses
    //return (getAuctionWins() - getAuctionLosses() ) / getTotalCarCount();
//}
function getUserSalesCount(){
    //returns the number cars sold by the user
    global $aoCarSalesDB;
    $uid = getUserTableName();
    //$count is initialized when this is called for the first time
    $count = 0;
    /*
    $res = $aoCarSalesDB->query(
        "SELECT * FROM $uid"
    );
    
    if($res){
        $count = $res->num_rows;
        //fetch each entry until there are no more
        //while($row = mysqli_fetch_array($res) ){
            //$count += 1;
        //}
        $res->close();
    }
    //else{user has no entries in table, count is 0;}
    */
    return $count;
}
//function getRemainingCars(){
    //returns an array of cars the user still has to purchase
//}
function getTotalUserCarCount(){
    //total cars ever purchased by the user
    return getUserCarCount() + getUserSalesCount();
}
function getRemainingCarCount(){
    //returns the number of cars the user still has to purchase
    //$ret = getAuctionCars() - (getUserCarCount() + getUserSalesCount() );
    //echo $ret
    return getAuctionCarsCount() - getTotalUserCarCount();
}
function getGameCompletion(){
    //percentage of cars bought and sold by the user
    $acCount = getAuctionCarsCount();
    
    return $acCount != 0 ? getTotalUserCarCount() / $acCount : 0.0;
}
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
            //insert an new array repressenting a car at the end of $cars
            $cars[] = array(
                'carID' => intval($row['car_id']),
                'drivetrain' => intval($row['drivetrain']),
                'body' => intval($row['body']),
                'interior' => intval($row['interior']),
                'docs' => intval($row['docs']),
                'repairs' => intval($row['repairs'])
            );
        }
        mysqli_free_result($res);
        //echo json_encode($cars);
    }
    else{   //The vehicle is already registered
        //echo "<p class='error'>User: has no entries in database</p>";
    }
    //echo 'WIN!';
    //exit();
    echo json_encode($cars);
}

function getUserSoldCars(){
    //selects all vehicles sold by the currently logged-in user
    //returning them as a JSON array
    //global $aoCarSalesDB;
    //$user = 'user0';
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

if(isset($_GET) && !empty($_GET) ){
    //args being passed vai the url
    $op = isset($_GET['op']) ? $_GET['op'] : '';
    //regex match, must contain no whitespace, numbers or special characters!
    //if(preg_match('/[[:alpha;]]/', $op) ){
        if($op == 'asc'){
            getAuctionCars();
            exit();
        }
        //elseif($op == 'ucs'){
            //getUserCarSales();
            //exit();
        //}
        //elseif($op == '') preform other operations
        //else not supported
    //}
    echo "operation:$op, script calling exit()";
    exit();
}
//else no vars passed via GET

if(isset($_POST) && !empty($_POST) ){
    //echo 'post set';
    //exit();    
    if(isset($_POST['carID'])){
        $carID = $_POST['carID'];
        //validate value, must be an int!
        //echo json_encode($carID);
        //switch the operation besed on value passed in url
        if(isset($_GET) && !empty($_GET) ){
            //args being passed via the url
            $op = isset($_GET['op']) ? $_GET['op'] : '';
            //match $op against RE containing one or more letters, only. No whitespace or numbers
            //$op = preg_match('[:alpha;]+', $_GET['op']);
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
    echo 'other post vars' . json_encode($_POST);
    exit();
}
else{
    //no passing any values via POST, return all user's cars
    echoUserCars();
    exit();
}
echo 'WIN';
exit();
?>