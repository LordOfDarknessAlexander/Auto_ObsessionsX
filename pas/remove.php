<?php
//this script REMOVEs Database values with sql
//this file contains function/class definitions ONLY, no functionality
//header('Access-Control-Allow-Origin: *');
//
require_once './pasMeta.php';
//require_once '../vehicles/vehicle.php';
//require_once '../include/dbConnect.php';  //sql database connection
//require_once '../include/secure.php';
//
//secure::loggin();
//
class pasRemove
{
    public static function userAccount($email, $pw){
        //removes all user data, across all databases
        //call this when a user deletes their account,
        //or an admin removes them for violating terms of service, etc
        global $AO_DB;
        $UID = ao::UID;
        $users = ao::USERS;
        //echo "removing user account with email:$email and password:$pw<br>";
        $res = $AO_DB->query(
            "SELECT $UID FROM $users WHERE(
                email ='$email' AND psword=SHA1('$pw')
            )"
        );
        //echo json_encode($res);
        
        if($res->num_rows){
            $uid = $res->fetch_assoc()[$UID];
            //
            //echo "removing user account with ID:$uid<br>";
            //remove from finalpost users
            if(pasRemove::dropUser($uid) ){
                //remove table from aoUsersDB
                if(pasRemove::userGarageTable($uid) ){
                    //remove table from aoCarSales
                    if(pasRemove::userSalesTable($uid) ){
                        if(pasRemove::userLossTable($uid) ){
                            echo "<p class='error'>user with id:$uid, account removed, farewell!</p>";
                            return true;
                        }
                    }
                }
            }
        }
        else{
            //$erno = $AO_DB->con->errno;
            //$err = $AO_DB->con->error;
            echo "<p class='error'>remove userAccount() failed, no entry in database</p><br>";
        }
        return false;
    }
    public static function dropUser($uid){
        //drops the table of user with id userIDfrom aoUsersDB
        //returns true on success, false on failure
        global $AO_DB;
        $users = ao::USERS;
        $UID = ao::UID;
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
        $ret = $AO_DB->query(
            "DELETE FROM $users WHERE $UID=$uid"
        );
        ////if($ret){$ret->close()};?
        return ($AO_DB->con->affected_rows != 0) ? true : false;
    }
    public static function userGarageTable($uid){
        //drops the table of user with id userIDfrom aoUsersDB
        //returns true on success, false on failure
        global $aoUsersDB;
        $tableName = "user$uid";    //getUserTableName();
        
        $ret = $aoUsersDB->query(
            "DROP TABLE IF EXISTS $tableName"
        );
        
        if(!$ret){
            $erno = $aoUsersDB->con->errno;
            $err = $aoUsersDB->con->error;
            echo "<p class='error'>pasRemove::userGarageTable()<br>error:($erno), reason: $err<br>";
        }
        return $ret;
    }
    public static function userSalesTable($uid){
        //drops the table of user with id userIDfrom aoUsersDB
        //returns true on success, false on failure
        //global $aoCarSalesDB;
        
        $tableName = getUserTableName();
        
        //returns true if user was dropped, false on error
        /*$ret = $aoCarSalesDB->query(
            "DROP TABLE IF EXISTS $tableName"
        );
        if(!$ret){    //AND DEBUG){
            //output mysqli error!
        }
        return $ret;*/
        return true;
    }
    public static function userSales($userID){
        //removes all entries from user's sale history,
        //does not remove the table
        global $aoCarSalesDB;
        
        $tableName = "user$userID"; //getUserTableName();
        
        //returns true if user was dropped, false on error
        //$ret $aoCarSalesDB->query(
            //"DELETE FROM $tableName"
        //);
        //if(!$ret){    //AND DEBUG){
            //output mysqli error!
        //}
        //return ($aoCarSalesDB->con->affected_rows != 0) ? true : false;
        return true;
    }
    public static function userLossTable($uid){
        //drops the table of user with id userIDfrom aoUsersDB
        //returns true on success, false on failure
        global $aoAuctionLossDB;        
        $tableName = "user$uid"; //getUserTableName();        
        //returns true if user was dropped, false on error
        $ret = $aoAuctionLossDB->query(
            "DROP TABLE IF EXISTS $tableName"
        );
        if(!$ret){    //AND DEBUG){
            $erno = $aoAuctionLossDB->con->errno;
            $err = $aoAuctionLossDB->con->error;
            echo "<p class='error'>pasRemove::userLossTable()<br>error:($erno), reason: $err<br>";
        }
        return $ret;
    }
    public static function allUserCars($userID){
        //removes all car entries the user owns,
        //returning true upon success and false on failure,
        //such as the user's table does not exist or a car entry
        //attempting to be removed does not exist
        global $aoUsersDB;
        $uid = "user$userID";//getUserTableName();
        
        $ret = $aoUSersDB->query(
            "DELETE FROM $uid"
        );
        if(!$ret){    //AND DEBUG){
            //output mysqli error!
        }
        return ret;
        //return ($aoUsersDB->con->affected_rows != 0) ? true : false;
    }
    public static function userCar($carID){
        //removes a singe car with ID from the user's garage,
        //returning true upon success and false on failure
        global $aoUsersDB;
        
        $CID = ao::CID;
        $uid = getUserTableName();    //$_SESSION['user_id'];
        
        $ret = $aoUsersDB->query(
            "DELETE FROM $uid WHERE $CID = $carID"
        );
        
        if(!$ret){    //AND DEBUG){
            //output mysqli error!
        }
        return ret;
        //return ($aoUsersDB->con->affected_rows != 0) ? true : false;
    }
}
?>