<?php
//this script includes fundemental functions,
//used across most script in this folder
header('Access-Control-Allow-Origin: *');
//
require_once '../vehicles/vehicle.php';
require_once '../include/dbConnect.php';  //sql database connections
//require_once '../include/secure.php';
//
//secure::loggin();
//
function hasCar($id){
    //does the user's table in aoUsersDB already have an entry with car_id '$id'
    global $aoUsersDB;
    
    $ret = false;
    $tableName = 'user' . strval(0);    //$_SESSION['userID'];
   
    $res = $aoUsersDB->query("SELECT * FROM $tableName WHERE car_id = $id");
    
    if($res){
        //user has car
        $ret = mysqli_num_rows($res) != 0 ? true : false;
    }
    else{
        //query failed, user has no entry in database
    }
    mysqli_free_result($res);
    
    return $ret;
}
function sellCar($cid, $price){
    //does the user's table in aoUsersDB already have an entry with car_id '$id'
    global $aoUsersDB;
    //global $aoCarSalesDB;
    
    $ret = false;
    $tableName = 'user' . strval(0);    //$_SESSION['userID'];
   
    $res = $aoUsersDB->query("SELECT * FROM $tableName WHERE car_id = $cid");
    
    if($res){
        //user has car
        if(mysqli_num_rows($res) ){
            $data = $res->fetch_assoc();
            //pasUpdate::soldCar($data, $price);
            //pasRemove::userCar($data['car_id']);
        }
    }
    else{
        //query failed, user has no entry in database
        //$er = sqlError($aoUsersDB);
        //$erno = $aoUsersDB->con->errno;
        //$err = $aoUsersDB->con->error;
        //echo "hasCar($id), bind_params failed:($erno), reason: $err";
        //exit();
    }
    mysqli_free_result($res); 
    return $ret;
}
function getCarFromID($carID){
    //selects a vehicle from the car database($AO_DB),
    //returning it as a an instance of a php class
    global $AO_DB;
    $aoCars = 'aoCars';
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
    return null;
}
?>