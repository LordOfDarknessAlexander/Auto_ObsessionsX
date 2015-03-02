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
    /*$id = strval(0);    //$SESSION['userID'];
    $users = 'users';
    
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
                //'make' => $row['make'],
                //'year' => intval($row['year']),
                //'model' => $row['model'],
                //'price' => intval($row['price']),
                //'info' => $row['info'],
                'hasCar' => hasCar($carID)   //does user have this car?
            );
        }
        mysqli_free_result($res);
    }
    else{   //The vehicle is already registered
        //echo "<p class='error'>User: has no entries in database</p>";
    }
    echo json_encode($cars);
}
function getUserCarFromID($carID){
    //selects all vehicles the user owns, returning it as a JSON array
    global $aoUsersDB;
    $userID = 'user' . strval(0);    //$_SESSION['userID'];
    //$_getUserCar = $aoUsersDB->con->prepare(
        //"SELECT * FROM ? WHERE car_id = ?"
    //);
    /*if($_getUserCar){
        if($_getUserCar->bind_params('si', $userID, $carID)){
            if($_getUserCar->execute() ){
                $res = $_getUserCar->get_result();
            }
            else{
                //execute failed   
            }
        }
        else{
            //bind params failed
        }
    }
    else{
        //prepare statement failed, fall back to regular query
    }*/
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

function echoUserCars(){
    //selects all vehicles the user owns, returning it as a JSON array
    global $aoUsersDB;
    
    $cars = array();
    $userID = '';
    
    //if(isset($_SESSION) AND isset($_SESSION['user_id']) ){
        //$userID = 'user' . $_SESSION['user_id'];
    //}
    //else{
        $userID = 'user' . strval(0);   //$_SESSION['userID'];
    //}
    
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

$q = '';

if(isset($_GET) && !empty($_GET) ){
    //args being passed vai the url
    if(isset($_GET['op']) && $_GET['op'] == 'asc'){
        getAuctionCars();
        exit();
    }
}
if(isset($_POST) && !empty($_POST) ){
    if(isset($_POST['carID'])){
        $carID = $_POST['carID'];
        //validate value, must be an int!
        //echo json_encode($carID);
        
        //switch the operation besed on value passed in url
        if(isset($_GET) && !empty($_GET) ){
        //args being passed via the url
            if(isset($_GET['op']) ){
                //match $op against RE containing one or more letters, only. No whitespace or numbers
                //$op = preg_match('[:alpha;]+', $_GET['op']);
                if($_GET['op'] == 'hasCar'){
                    //echo '{"hasCar": ' . strval(false) . '}';
                    exit();
                }
                //else switch to other calls
            }
            //echo "operation: $_GET['op'] not supported, script exiting()";
            exit();
        }
        //else no GET args, simply return data of car with id
        
        //echo '{"data":' . strval($carID) . '}';
        //select an individual element with car_id $carID
        $car = getCarFromID($carID);
        
        if($car != null){
            echo $car->toJSON();
        }
        else{
            echo '{}';  //return emtpy object
        }
    }
    //other post vars
}
else{
    //no passing any values via POST, return all cars
    echoUserCars();
}
?>