<?php
//this script REMOVEs Database values with sql
//this file contains function/class definitions ONLY, no functionality
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
                    //if(pasRemove::userLossTable($userID) ){
                        return true;
                    //}
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
        ////if($ret){$ret->close()};?
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
        
         //if($ret){
            //$ret->close();
        //}
        //else{
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
            //"DROP TABLE IF EXISTS $tableName
        //);
         //if($ret){    //AND DEBUG){
            //$ret->close();
        //}
        //else{
            //output mysqli error!
        //}
        //return ret;
    }
    public static function userSales($userID){
        //removes all entries from user's sale history,
        //does not remove the table
        global $aoCarSalesDB;
        
        $tableName = getUserTableName();
        
        //returns true if user was dropped, false on error
        //$ret $aoCarSalesDB->query(
            //"DELETE * FROM $tableName"
        //);
        //if($ret){    //AND DEBUG){
            //$ret->close();
        //}
        //else{
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
        
        $uid = getUserTableName();    //$_SESSION['user_id'];
        
        $ret = $aoUSersDB->query(
            "DELETE * FROM $uid WHERE car_id = $carID"
        );
        
        if(!$ret){    //AND DEBUG){
            //output mysqli error!
        }
        return ret;
    }
}
?>