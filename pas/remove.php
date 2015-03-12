<?php
//this script REMOVEs Database values with sql
//used by javascript ajax requests
header('Access-Control-Allow-Origin: *');
//
require_once 'meta.php';
require_once '../vehicles/vehicle.php';
require_once '../include/dbConnect.php';  //sql database connection
//require_once '../include/secure.php';
//
//secure::loggin();
//
class pasRemove
{
    public static function userAccount($userID){
        //removes all user data, across all databases
        //call this when a user deletes their account,
        //or an admin removes them for violating terms of service, etc
        //
        //remove from finalpost users
        if(pasRemove::dropUser($userID) ){
            //remove table from aoUsersDB
            if(pasRemove::userGarageTable($userID) ){
                //remove table from aoCarSales
                if(pasRemove::userSalesTable($userID) ){
                    return true;
                }
            }
        }
        return false;
    }
    public static function dropUser($userID){
        //drops the table of user with id userIDfrom aoUsersDB
        //returns true on success, false on failure
        global $AO_DB;
        //$users = 'users';
        //$_dropUser = $AO_DB->prepare(
            //"DELETE * FROM $users WHERE user_id=?"
        //);
        //if($_dropUser){
            //if($_dropUser->bind_params(i, $userID) ){
                //return json_encode($_dropUser->execute() );
            //}
            //else bind param failed
        //}
        //else preform regular query fallback
        //$ret = $AO_DB->query(
            //"DELETE * FROM $users WHERE user_id=$userID"
        //);
        ////ret->close()?
        //return ($AO_DB->con->affected_rows != 0) ? true : false;
    }
    public static function userGarageTable($userID){
        //drops the table of user with id userIDfrom aoUsersDB
        //returns true on success, false on failure
        global $aoUsersDB;
        $tableName = getUserTableName();
        
        //$ret = $aoUsersDB->query(
            //"DROP TABLE IF EXISTS $tableName
        //);
        
        //if(!$ret){    //AND DEBUG){
            //output mysqli error!
        //}
        //return ret;
    }
    public static function userSalesTable($userID){
        //drops the table of user with id userIDfrom aoUsersDB
        //returns true on success, false on failure
        //global $aoCarSalesDB;
        
        $tableName = getUserTableName();
        
        //returns true if user was dropped, false on error
        //$ret = $aoCarSalesDB->query(
            //"IF EXISTS $tableName
            //"DROP TABLE $tableName"
        //);
        //if(!$ret){    //AND DEBUG){
            //output mysqli error!
        //}
        //return ret;
    }
    public static function userSales($userID){
        //removes all entries from user's sale history,
        //does not remove the table
        //global $aoCarSalesDB;
        
        $tableName = getUserTableName();
        
        //returns true if user was dropped, false on error
        //return $aoCarSalesDB->query(
            //"DELETE * FROM $tableName"
        //);
        //if(!$ret){    //AND DEBUG){
            //output mysqli error!
        //}
        //return ret;
    }
    public static function allUserCars($userID){
        //removes all car entries the user owns,
        //returning true upon success and false on failure,
        //such as the user's table does not exist or a car entry
        //attempting to be removed does not exist
        global $aoUsersDB;
        $uid = getUserTableName();
        
        $ret = $aoUSersDB->query(
            "DELETE * FROM $uid"
        );
        if(!$ret){    //AND DEBUG){
            //output mysqli error!
        }
        return ret;
    }
    public static function userCar($carID){
        //removes a singe car with ID from the user's garage,
        //returning true upon success and false on failure
        global $aoUsersDB;
        
        $userID = getUserTableName();    //$_SESSION['user_id'];
        
        $ret = $aoUSersDB->query(
            "DELETE * FROM $uid WHERE car_id = $carID"
        );
        
        if(!$ret){    //AND DEBUG){
            //output mysqli error!
        }
        return ret;
    }
}

if(isset($_POST) && !empty($_POST) ){
    if(isset($_POST['carID'])){
        $carID = $_POST['carID'];
        //validate value, must be an int!
        //echo json_encode($carID);

        //switch the operation besed on value passed in url
        /*if(isset($_GET) && !empty($_GET) ){
            //args being passed via the url
            if(isset($_GET['op']) ){
                if($_GET['op'] == 'insert'){
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
                }
                //else switch to other calls
                exit();
            }
        }
        //else no GET args, simply return data of car with id
        */
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