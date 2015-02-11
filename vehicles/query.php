<?php
//this script queries the vehicle database returning the results, used by javascript ajax requests
require_once 'vehicle.php';
require_once '../include/dbConnect.php';  //sql database connection
//require_once '../include/secure.php';
//
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
//echo $cars->toJSON(); //serialize to JSON to send over internet
//}
function hasCar($id){
    global $aoUsersDB;
    
    $ret = false;
    $tableName = 'user' . strval(0);    //$_SESSION['userID'];
    $res = $aoUsersDB->query("SELECT * FROM $tableName WHERE car_id = $id");
    
    if($res){
        //user has car
        $ret = mysqli_num_rows($res) != 0 ? true : false;
    }
    //else{
        //query failed, user has no entry in database
    //}
    mysqli_free_result($res);
    
    return $ret;
}
function getUserCarFromID($carID){
    //selects all vehicles the user owns, returning it as a JSON array
    global $aoUsersDB;
    $userID = 'user' . strval(0);    //$_SESSION['userID'];
    $res = $aoUsersDB->query(
        "SELECT * FROM $userID WHERE car_id = $carID"
    );
    if($res){
        if(mysqli_num_rows($res) != 0){
            //$q = "INSERT INTO vehicles (car_id, make, model, year, info) VALUES (' ', '$make', '$model', '$year', '$info')";		
            $data = $res->fetch_assoc();//@mysqli_query($CARS.$con, $q); // Run the query
            //$car = Vehicle::fromArray($data);
            //echo '{"data":"this is data!"}';
            //echo $car->toJSON();
            //echo Vehicle::fromArray($result->fetch_assoc() )->toJSON();
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
function getCarFromID($carID){
    //selects a vehicle from the car database,
    //returning it as a JSON object string
    global $AO_DB;
    $res = $AO_DB->query(
        "SELECT * FROM aoCars WHERE car_id = $carID"
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
function echoUserCars(){
    //selects all vehicles the user owns, returning it as a JSON array
    global $aoUsersDB;
    
    $userID = 'user' . strval(0);   //$_SESSION['userID'];
    $res = $aoUsersDB->query(
        "SELECT * FROM $userID"
    );
    
    if($res){
        $cars = array();
        
        while($row = mysqli_fetch_array($res) ){
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
        echo json_encode($cars);
    }
    else{   //The vehicle is already registered
        //echo "<p class='error'>User: has no entries in database</p>";
        echo '{"cars":[]}';
    }
}

$q = '';

if(isset($_POST) && !empty($_POST) ){
    $carID = $_POST['carID'];
    //validate value
    //echo json_encode($carID);
    //echo '{"data":' . strval($carID) . '}';
       //select an individual element with car_id $carID
    //$q = "SELECT * FROM aoCars WHERE car_id = $carID";
    $car = getCarFromID($carID);
    
    if($car != null){
        echo $car->toJSON();
    }
    else{
        echo '{}';  //return emtpy object
    }
}
else{
    //no passing any values/filter, return all cars
    echoUserCars();
}
?>