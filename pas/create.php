<?php
//this script CREATE's Database tables with sql
//used by javascript ajax requests
header('Access-Control-Allow-Origin: *');
//require_once '../vehicles/vehicle.php';
require_once '../include/dbConnect.php';  //sql database connection
//require_once '../include/secure.php';
//
//secure::loggin();
//
function createUserEntry($userID){
    //creates an empty table upon user registration
    global $AO_DB;
    $tableName = 'user' . strval(0);    //strval($_SESSION['userID']);
    //get validated and sanitized form data
    //$userTableName = 'user';
    
    /*$stmnt = $AO_DB->prepare(
       "INSERT INTO $userTableName (user_id, title, fname, lname, email, psword, uname, registration_date, user_level, money, m_marker, tokens, prestige, curCarID) VALUES
        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );
    
    $stmnt->bind_args('issssiiiiii), '', $title, $fname, $lname, $email, $pw, $uname, NOW(), 0, 0, 0, 0, 0, 0";
    
    if($stmt->execute() ){
        //$res = $stmt->
    }
    else{
        //sql error!
    }
    
    if($res){
        if(mysqli_num_rows($res) != 0){
        } 
        else{
        } 
        mysqli_free_result($res);
    }
    else{
        //The vehicle is already registered
        //return null; //echo "<p class='error'>The email address is not acceptable because it is already registered</p>";
    }*/
    return null;
}
function createUserTable($userID){
    //creates an empty table in aoUsersDB upon user registration
    global $aoUsersDB;
    $tableName = 'user' . strval(0);    //userID;
    $uint = 'int unsigned';
    $defaultCharset = 'DEFAULT CHARSET = latin1';
    $defaultEngine = 'ENGINE = InnoDB';
    //make this a static var, should only be executed once!
    $stmnt = $aoUsersDB->prepare(
       "CREATE TABLE IF NOT EXISTS $tableName(
            car_id $uint NOT NULL PRIMARY KEY,
            drivetrain $uint,
            body $uint,
            interior $uint,
            docs $uint,
            repairs $uint
        )$defaultEngine $defaultCharset"
    );
    
    if(!$stmt){
        $erno = $aoUsersDB->errno;
        $err = $aoUsersDB->error;
        echo "createUserTable($userID), prepare failed:($erno), reason: $err";
        return false;
    }
    
    if($stmnt->execute() ){   //returns true if execute preformed successfully, false on failure
        return true;
    }
    //else false, output error
    $erno = $aoUsersDB->errno;
    $err = $aoUsersDB->error;
    echo "createUserTable($userID), prepare failed:($erno), reason: $err";
    
    return false;
}

function createUserAccount(){
    //create entry in finalpost
    //createUserEntry();
    //get userID from final post for the 
    //creatUserTable($userID);
}

$q = '';

/*if(isset($_GET) && !empty($_GET) ){
    //args being passed vai the url
    if(isset($_GET['op']) && $_GET['op'] == 'asc'){
        getAuctionCars();
        exit();
    }
}*/
if(isset($_POST) && !empty($_POST) ){
    if(isset($_POST['carID'])){
        $carID = $_POST['carID'];
        //validate value, must be an int!
        //echo json_encode($carID);

        //switch the operation besed on value passed in url
        if(isset($_GET) && !empty($_GET) ){
            //args being passed via the url
            if(isset($_GET['op']) ){
                /*if($_GET['op'] == 'insert'){
                    //inserts a car with carID from the vehicle database into the
                    //logged in user's table in aoUsersDB
                    $hasCar = hasCar($carID);
                    
                    if($hasCar){
                        //user has already bought this car, error!
                    }
                    else{
                        $tableName = 'user' . strval(0);    //$_SESSION['userID'];
                        $res = $aoUsersDB->query(
                            "INSERT INTO $tableName (car_id, drivetrain, body, interior, docs, repairs) VALUES ($carID, 0,0,0,0,0)"
                            //if entry exists
                        );
                        
                        echo json_encode($res);
                    }
                }
                elseif($_GET['op'] == 'update'){
                    //inserts a car with carID from the vehicle database into the
                    //logged in user's table in aoUsersDB
                    $dt = intval($_POST['dt']);
                    $body = intval($_POST['body']);
                    $inter = intval($_POST['interior']);
                    $docs = intval($_POST['docs']);
                    
                    $rep = intval($_POST['repairs']);
                    
                    $tableName = 'user' . strval(0);    //$_SESSION['userID'];
                    $res = $aoUsersDB->query(
                        "UPDATE $tableName SET drivetrain=$dt, body=$body, interior=$inter, docs=$docs, repairs=$rep WHERE car_id = $carID"
                    );
                    
                    echo json_encode($res);
                    //}
                }*/
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
}
?>