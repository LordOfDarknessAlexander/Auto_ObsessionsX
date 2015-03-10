<?php
//this script CREATE's Database tables with sql
//used by javascript ajax requests
header('Access-Control-Allow-Origin: *');
//
require_once 'meta.php';
//require_once '../vehicles/vehicle.php';
require_once '../include/dbConnect.php';  //sql database connection
//require_once '../include/secure.php';
//
//secure::loggin();
//
class pasCreate
{
    function userEntry($userID){
        //creates an empty table upon user registration,
        //true on success, false on failure
        global $AO_DB;
        $aoUsers = 'users';
        //get validated and sanitized form data
        //$addUser = $AO_DB->prepare(
           //"INSERT INTO $aoUsers (user_id, title, fname, lname, email, psword, uname, registration_date, user_level, money, m_marker, tokens, prestige, curCarID) VALUES
            //(?, ?, ?, ?, ?, ?, NOW(), 0, 50000.00, 0, 0, 0, 0, 0)"
        //);
        
        /*$res = $AO_DB->query(
           "INSERT INTO $aoUsers (user_id, title, fname, lname, email, psword, uname, registration_date, user_level, money, m_marker, tokens, prestige, curCarID) VALUES
            ($title, $fname, $lname, $email, $pw, $uname, NOW(), 0, 50000.00, 0, 0, 0, 0, 0)"
        );
        
        if(!$res){
            //sql error!
            //The vehicle is already registered
            //echo "<p class='error'>The email address is not acceptable because it is already registered</p>";
        }
        return ret;
        */
        return null;
    }
    public static function userTable($userID){
        //creates an empty table in aoUsersDB upon user registration,
        //user id should be 
        global $aoUsersDB;
        //escape and sanitize input string, incase someone tries an sql injection attack
        
        $tableName = "user$userID";  //getUserTableName();
        $uint = 'int unsigned';
        $defaultCharset = 'DEFAULT CHARSET = latin1';
        $defaultEngine = 'ENGINE = InnoDB';
        //table names can not be used as variables(?) in prepared statements,
        //so must use reqular queries
        $res = $aoUsersDB->query(
           "CREATE TABLE IF NOT EXISTS $tableName(
                car_id $uint NOT NULL PRIMARY KEY,
                drivetrain $uint,
                body $uint,
                interior $uint,
                docs $uint,
                repairs $uint
            )$defaultEngine $defaultCharset"
        );
        
        if(!$res){
            $erno = $aoUsersDB->con->errno;
            $err = $aoUsersDB->con->error;
            echo "createUserTable($userID), prepare failed:($erno), reason: $err<br>";
            return false;
        }
        return true;
    }
    public static function carSaleTable(){
        //creates an empty table in aoUsersDB upon user registration
        global $aoCarSalesDB;
        //$uid = $_SESSION['userID'];
        $tableName = getUserTableName();
        $uint = 'int unsigned';
        $defaultCharset = 'DEFAULT CHARSET = latin1';
        $defaultEngine = 'ENGINE = InnoDB';
        
        /*$res = $aoCarSalesDB->query(
           "CREATE TABLE IF NOT EXISTS $tableName(
                car_id $uint NOT NULL PRIMARY KEY,
                price float,    //0 if the auction has not completed, else the total sale price of the car
                bid float,    //the current highest bid until the auction has completed and the user receives the funds, else 0
                drivetrain $uint,
                body $uint,
                interior $uint,
                docs $uint,
                repairs $uint,
                start date NOT NULL,
                end date,
                time float  //0 if end date is not null, else the time left on the auction
            )$defaultEngine $defaultCharset"
        );*/
         
        //if($res){   //returns true if execute preformed successfully, false on failure
            //return true;
        //}
        //else false, output error
        //$erno = $aoCarSalesDB->errno;
        //$err = $aoCarSalesDB->error;
        //echo "pasCreate::carSalesTable($userID), failed:($erno), reason: $err";
        
        return false;
    }
    function userAccount(){
        //create entry in finalpost
        //if(pasCreate::userEntry($userID) ){
            //get userID from final post for the 
            //if(pasCreae::userTable() {
                //if(pasCreate::userSalesTable() ){
                    //return true;
                //}
            //}
        //}
        //return false;
    }
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