<?php
//this script INSERTs or UPDATEs Database values with sql
//used by javascript ajax requests
require_once 'meta.php';
//require_once '../include/secure.php';
//
//secure::loggin();
//
class pasUpdate{
    public static function soldCar($carID, $price){
        //$res = $aoUsersDB->query(
            //if entry does not exist add it, else update
            //"UPDATE $tableName SET drivetrain=$dt, body=$body, interior=$inter, docs=$docs, repairs=$rep WHERE car_id = $carID"
        //);
        
        //echo json_encode($res);
    }
}
/*public static function hasSoldCar($carID){
    //does the user's table in aoCarSalesDB already have an entry with car_id '$id'
    global $aoSoldCarsDB;
    
    $tableName = getUserTableName();    //$_SESSION['userID'];
    $ret = false;
    
    $res = $aoSoldCarsDB->query("SELECT * FROM $tableName WHERE car_id = $id");
    
    if($res){
        //user has sold car, valid entry in db
        $ret = mysqli_num_rows($res) != 0 ? true : false;
    }
    //else{user still owns car, no entry in db}
    mysqli_free_result($res);
    
    return $ret;
}*/

/*public static function getCarFromID($carID){
    //selects a vehicle from the car database,
    //returning it as a JSON object string
    global $AO_DB;
    $aoCars = 'aoCars';
    static $_getCar = $AO_DB->prepare(
        "SELECT * FROM $aoCars WHERE car_id = ?"
    );
    if(_getCar){
        //bind_params
            //execute
    }
    else{
        $res = $AO_DB->query(
            "SELECT * FROM $aoCars WHERE car_id = $carID"
        );
        if($res){
            if(mysqli_num_rows($res) != 0){
                //$q = "INSERT INTO vehicles (car_id, make, model, year, info) VALUES (' ', '$make', '$model', '$year', '$info')";		
                $data = $res->fetch_assoc();//@mysqli_query($CARS.$con, $q); // Run the query
                $car = Vehicle::fromArray($data);
                //echo '{"data":"this is data!"}';
                return $car;
                //echo Vehicle::fromArray($result->fetch_assoc() )->toJSON();
            } 
            else{
                //$er = sqlError($AO_DB);
                //echo "<h2>System Error</h2>
                //<p class='error'>Vehicle could not be registered due to a system error. Please try again later</p>";
                //echo '<p>'.mysqli_error($CARS.$con).'<br><br>Query: '.$q.'</p>';
            } 
            mysqli_free_result($res);
        }
        else{   //The vehicle is already registered
            //return null; //echo "<p class='error'>The email address is not acceptable because it is already registered</p>";
        }
    }
    return null;
}*/
function setUserCar($carID){
    global $AO_DB;
    //$aoUsers = 'aoUsers';
    //static $setCar = $AO_DB->prepare("UPDATE car_id FROM $aoUsers WHERE user_id = ?");
    //if($setCar){
        //if($AO_DB->con->bind_paramas('i', $uid)){
            //if(setCar->execute() ){
                //echo json_encode($carID);
            //}
        //}
    //}
    if($carID == 0){
        //return json_encode($res ? true : false);
    }
    elseif($carID > 0 AND hasCar($carID)){
        //$res = $AO_DB->query("UPDATE car_id FROM aousers WHERE user_id = '$uid'");
        //return json_encode($res ? $carID : false);
    }
    //else not valid car ID, do nothing
    //return json_encode(false);
}
/*function updateSale($sale){
    gloabal $aoCarSalesDB;
    $res = $aoCarSalesDB->query(
        "IF NOT EXISTS entry with saleID
        INSERT ... ELSE
        ON DUPLICATE KEY UPDATE existing sale"
    );
    return $ret;
}*/
/*function updateUser(){
    gloabal $AO_DB;
    $users = 'users';
    $uid = getUserTableName();
    //$cash, $tok, $prest, $markers;
    //static $updateUser = $AO_DB->prepare(
        //"UPDATE (money, tokens, presteige, markers) SET FROM $users WHERE user_id = ? VALUES ($cash, $tok, $prest, $markers)"
    //);
    
    $res = $AO_DB->query("UPDATE (money, tokens, presteige, markers) SET FROM $users WHERE user_id = '$uid'");
    //return;
}

/*if(isset($_GET) && !empty($_GET) ){
    //args being passed vai the url
    if(isset($_GET['op']) && $_GET['op'] == 'asc'){
        getAuctionCars();
        exit();
    }
}*/
if(isset($_POST) && !empty($_POST) ){
    if(isset($_POST['carID'])){
        $carID = $_POST['carID'];   //intval(trim($_POST['carID']));
        //validate value, must be an int!
        //echo json_encode($carID);

        //switch the operation besed on value passed in url
        if(isset($_GET) && !empty($_GET) ){
            //args being passed via the url
            if(isset($_GET['op']) ){
                //$op = $_GET['op'];
                
                //if(preg_match('/[[:alpha;]]/', $op)){
                if($_GET['op'] == 'insert'){
                    //inserts a car with carID from the vehicle database into the
                    //logged in user's table in aoUsersDB
                    //returns true if the INSERTion is successful,
                    //false if user has the vehicle already or any other reason the vehicle could not be added
                    $hasCar = hasCar($carID);
                    
                    if($hasCar){
                        //user has already bought this car, exit with false!
                        //echo json_encode(false);
                        exit();
                    }
                    else{
                        $tableName = getUserTableName();   //$_SESSION['userID'];
                        
                        $res = $aoUsersDB->query(
                            "INSERT INTO $tableName (car_id, drivetrain, body, interior, docs, repairs) VALUES ($carID, 0,0,0,0,0)"
                            //IF entry EXISTS do nothing
                        );
                        echo json_encode($res);
                    }
                    exit();
                }
                elseif($_GET['op'] == 'update'){
                    //inserts a car with carID from the vehicle database into the
                    //logged in user's table in aoUsersDB
                    $dt = intval($_POST['dt']);
                    $body = intval($_POST['body']);
                    $inter = intval($_POST['interior']);
                    $docs = intval($_POST['docs']);
                    
                    $rep = intval($_POST['repairs']);
                    
                    $tableName = getUserTableName();    //$_SESSION['userID'];

                    $res = $aoUsersDB->query(
                        "UPDATE $tableName SET drivetrain=$dt, body=$body, interior=$inter, docs=$docs, repairs=$rep WHERE car_id = $carID"
                    );
                    
                    echo json_encode($res);
                    exit();
                }
                //else switch to other calls
                exit();
            }
        }
        //else no GET args, simply return data of car with id
        
        //echo '{"data":' . strval($carID) . '}';
        //select an individual element with car_id $carID
        //$car = getCarFromID($carID);
        
        //if($car != null){
            //echo $car->toJSON();
        //}
        //else{
            //echo '{}';  //return emtpy object
        //}
    }
    //other post vars
}
else{
    //no passing any values via POST, return all cars
    //echoUserCars();
    echo 'not passing post vars!';
    exit();
}
?>