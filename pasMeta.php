<?php
//this script includes fundemental functions,
//used across most script in this folder
//header('Access-Control-Allow-Origin: *');
//
require_once 'vehicles/vehicle.php';
require_once 'dbConnect.php';  //sql database connections
require_once 'secure.php';
require_once 'ao.php';
session_start();
//
//secure::loggin();
//
class sql{
    /*public static function insert($table, $valStr){
        //check using regex that $valStr contains a
        //comma seperated list of identifiers
        if(is_string($table) && is_string($valStr) ){
            $t = mysqli::real_escape_string($table);
            $v = mysqli::real_escape_string($valStr);
            
            return "INSERT INTO $t ($v)";
        }
        return '';
    }
    public static function insertVal($table, $rowStr, $valStr){
        //check using regex that $rowStr and $valStr contain
        //comma seperated list of identifiers
        if(is_string($table) && && is_string($rowStr) && is_string($valStr) ){
            $v = mysqli::real_escape_string($valStr);
            //if(debug() ){
                //$ret = sql::insert($table, $rowStr) . " VALUES ($v)";
                //echo $ret;
                //return $ret;
            //}
            return sql::insert($table, $rowStr) . " VALUES ($v)";
        }
        return '';
    }
    public static function insertOnDuplicateUpdate($table, $rowStr, $valStr, $updateStr){
        //check using regex that $rowStr and $valStr contain
        //comma seperated list of identifiers
        if(is_string($updateStr) ){
            $u = mysqli::real_escape_string($updateStr);
            //if(debug() ){
                //$ret = sql::insertVal($table, $rowStr, $valStr) . " ON DUPLICATE KEY UPDATE ($u)";
                //echo $ret;
                //return $ret;
            //}
            return sql::insertVal($table, $rowStr, $valStr) . " ON DUPLICATE KEY UPDATE ($u)";
        }
        return '';
    }*/
    public static function slctFrom($fields, $table){
        //$fields is a comma seperated list of row names
        global $AO_DB;
        //
        if(is_string($table) && is_string($fields) ){
            $f = mysqli_real_escape_string($AO_DB->con, $fields);
            $t = mysqli_real_escape_string($AO_DB->con, $table);

            return "SELECT $f FROM $t";
        }
        return '';
    }
    public static function slctAllFrom($table){
        //$fields is a comma seperated list of row names
        return sql::slctFrom('*', $table);
    }
    public static function slctFromCarDB($fields){
        global $AO_DB;
        //        
        if(is_string($fields) ){
            $f = mysqli_real_escape_string($AO_DB->con, $fields);
            return sql::slctFrom($f, ao::CARS);
        }
        return '';
    }
    public static function slctAllFromCarDB(){
        return sql::slctFromCarDB('*');
    }
    public static function slctFromUserTable($fields){
        $tn = getUserTableName();
        
        return sql::slctFrom($fields, $tn);
    }
    public static function slctAllFromUserTable(){        
        return sql::slctFromUserTable('*');
    }
    //
    //create
    //
    //public static function createTable($tbl, $args){
        //$t = ;
        //$r = ;
//        return "CREATE TABLE IF NOT EXISTS $tbl(
            //$args
        //)$defEngine $defCharset";

    //}
    //
    //Delete
    //
    public static function dltFrom($table){
        //$fields is a comma seperated list of row names
        global $AO_DB;
        //
        if(is_string($table) ){
            $t = mysqli_real_escape_string($AO_DB->con, $table);

            return "DELETE FROM $t";
        }
        return '';
    }
    public static function update($table, $vals){
        global $AO_DB;
        
        if(is_string($table) && is_string($vals) ){
            $t = mysqli_real_escape_string($AO_DB->con, $table);
            $v = mysqli_real_escape_string($AO_DB->con, $vals);
            
            return "UPDATE $t SET $v";
        }
        return '';
    }
}
//class user{
    function getUID(){
        //returns the user if logged in, else echo error and force user to redirect to login
        $UID = ao::UID;
      
        if(isset($_SESSION) && isset($_SESSION[$UID]) ){
            return intval($_SESSION[$UID]);
        }
        //echo "<p class='error'>User not logged in, could not access user session, Please try again.</p>";
        //header('location: login.php');
        return 3;   //for testing
    }
    function getUserTableName(){
        //returns the name of the table used by the currently logged in user
        //used to access tables in aoUsersDB and aoCarSalesDB
        $id = strval(getUID() );
        return "user$id";
    }
    function hasCar($id){
        //does the user's table in aoUsersDB already have an entry with car_id '$id'
        global $aoUsersDB;
        
        $ret = false;
        $CID = ao::CID;
        //$tableName = getUserTableName();
       
        $res = $aoUsersDB->query(
            sql::slctAllFromUserTable() . " WHERE $CID = $id"
        );
        
        if($res){
            //user has car
            $ret = mysqli_num_rows($res) != 0 ? true : false;
            $res->close();
        }
        else{
            //query failed, user has no entry in database
            //$er = sqlError($aoUsersDB);
            //$erno = $aoUsersDB->con->errno;
            //$err = $aoUsersDB->con->error;
            //echo "pas/meta.php hasCar($id), sql query failed:($erno), reason: $err";
            //exit();
        }
        
        return $ret;
    }
    function hasLostCar($id){
        //does the user's table in aoAuctionLossDB already have an entry with car_id '$id'
        global $aoAuctionLossDB;
        
        $CID = ao::CID;
        $ret = false;
        //$tableName = getUserTableName();

        $res = $aoAuctionLossDB->query(
            sql::slctAllFromUserTable() . " WHERE $CID = $id"
        );
        
        if($res){
            //user has car
            $ret = mysqli_num_rows($res) != 0 ? true : false;
            $res->close();
        }
        else{
            //query failed, user has no entry in database
            //$er = sqlError($aoUsersDB);
            //echo "pas/meta.php hasLostCar($id), sql query failed:($er->no), reason: $er->info";
        }
        
        return $ret;
    }
    function hasSoldCar($id){
        //does the user's table in aoUsersDB already have an entry with car_id '$id'
        global $aoCarSalesDB;
        
        $ret = false;
        $CID = ao::CID;
       
        $res = $aoCarSalesDB->query(
            sql::slctAllFromUserTable() . " WHERE $CID = $id"
        );
        
        if($res){
            $ret = $res->num_rows != 0 ? true : false;
            $res->close();
        }
        else{
            $aoCarSalesDB->eErr();
        }
        
        return $ret;
    }
    function sellCar($cid, $price){
        //does the user's table in aoUsersDB already have an entry with car_id '$id'
        global $aoUsersDB;
        //global $aoCarSalesDB;
        $CID = ao::CID;
        $ret = false;
       
        $res = $aoUsersDB->query(
            sql::slctAllFromUserTable() . " WHERE $CID = $cid"
        );
        
        if($res){
            //user has car
            if(mysqli_num_rows($res) ){
                $data = $res->fetch_assoc();
                //pasUpdate::soldCar($data, $price);
                //pasRemove::userCar($data['car_id']);
            }
            $res->close();
        }
        else{
            //query failed, user has no entry in database
            //$er = sqlError($aoUsersDB);
            //$erno = $aoUsersDB->con->errno;
            //$err = $aoUsersDB->con->error;
            //echo "hasCar($id), bind_params failed:($erno), reason: $err";
            //exit();
        }
        return $ret;
    }
//}
function getCarFromID($carID){
    //selects a vehicle from the car database($AO_DB),
    //returning it as a an instance of a php class
    global $AO_DB;
    //$aoCars = ao::CARS;
    $CID = ao::CID;
    //prepare!
    //$res = pasGet::allCarIDs();
    $res = $AO_DB->query(
        sql::slctAllFromCarDB() . " WHERE $CID = $carID"
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
        $res->close();
    }
    else{   //The vehicle is already registered
        //return null; //echo "<p class='error'>The email address is not acceptable because it is already registered</p>";
    }
    return null;
}
?>