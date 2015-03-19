<?php
//this script contains the api for retrieving stats about the user and associated databases,
//if this script is executed nothing will happen, as it only contains function definitions
//header('Access-Control-Allow-Origin: *');
//
require_once '../pasMeta.php';
//require_once '../include/secure.php';
//
//secure::loggin();
//
class pasGet{
    private static
        $_allCars,
		// $_login,
        //$_allCarData,
        $_allAuctionsCID;
        //$_allUsers ,
        //$_allUIDs,
		/*
    public class user{
        private static
            $_curCar,
            $_cash,
            $_tokens,
            $_prest,
            $_markers,
            $_info,
            $_stats,
            $_login,
        public static userInit(){}
    }
		
	
	public static function userInit ()
	{
		global $finalPost;
		
		$finalPost = 'finalPost';	
		$e = 'email';
		$p = 'psword';
		
		$UID = 'user_id';
        $CID = 'car_id';
			//$finalPost users
		
		self::$_login =  $AO_DB->con->prepare(
            "SELECT user_id, fname,uname, user_level FROM users WHERE (email='$e' AND psword=SHA1('$p') )"
        );
		//self::$_allUsers = $AO_DB->con->prepare(
         //"SELECT * FROM $users"    //returns an array of all user data
        //);
      
        //self::$_userCar = $AO_DB->con->prepare(
            //"SELECT car_id FROM $users WHERE $UID = ?"     //returns an array of all user id's
        //);
        //self::$_userCash = $AO_DB->con->prepare(
            //"SELECT money FROM $users WHERE $UID = ?"
        //);
        //self::$_userCash = $AO_DB->con->prepare(
            //"SELECT tokens FROM $users WHERE $UID = ?"
        //);
        //self::$_userCash = $AO_DB->con->prepare(
            //"SELECT prestige FROM $users WHERE $UID = ?"
        //);
        //self::$_userCash = $AO_DB->con->prepare(
            //"SELECT m_marker FROM $users WHERE $UID = ?"
        //);
        //self::$_userInfo = $AO_DB->con->prepare(
            //"SELECT fname, lname, uname, user_level FROM $users WHERE $UID = ?"
        //);
        //self::$_userStats = $AO_DB->con->prepare(
            //"SELECT money, tokens, prestige, m_marker FROM $users WHERE $UID = ?"
	}*/
	
    public static function init(){
        global $AO_DB;
        
        $aoCars = 'aoCars';
        $aoCars = 'users';
        $UID = 'user_id';
        $CID = 'car_id';
        //
        //AO_DB aoCars
        //
        self::$_allCars = $AO_DB->con->prepare(
            "SELECT * FROM $aoCars" //select all data, from all rows
        );
        //self::$_allCarData = $AO_DB->con->prepare(
            //"SELECT $CID, price FROM $aoCars"
        //);
        self::$_allAuctionsCID = $AO_DB->con->prepare(
            "SELECT $CID FROM $aoCars"  //select the car id from each row
        );
        //
        //$AO_DB users
        //
        //self::$_allUsers = $AO_DB->con->prepare(
            //"SELECT * FROM $users"    //returns an array of all user data
        //);
        //self::$_allUIDs = $AO_DB->con->prepare(
            //"SELECT $UID FROM $users"  //returns an array of all user id's
        //);
        //self::$_userCar = $AO_DB->con->prepare(
            //"SELECT $CID FROM $users WHERE $UID = ?"     //returns an array of all user id's
        //);
        //self::$_userCash = $AO_DB->con->prepare(
            //"SELECT money FROM $users WHERE $UID = ?"
        //);
        //self::$_userCash = $AO_DB->con->prepare(
            //"SELECT tokens FROM $users WHERE $UID = ?"
        //);
        //self::$_userCash = $AO_DB->con->prepare(
            //"SELECT prestige FROM $users WHERE $UID = ?"
        //);
        //self::$_userCash = $AO_DB->con->prepare(
            //"SELECT m_marker FROM $users WHERE $UID = ?"
        //);
        //self::$_userInfo = $AO_DB->con->prepare(
            //"SELECT fname, lname, uname, user_level FROM $users WHERE $UID = ?"
        //);
        //self::$_userStats = $AO_DB->con->prepare(
            //"SELECT money, tokens, prestige, m_marker FROM $users WHERE $UID = ?"
        //);   
        //self::$_userLogin = $AO_DB->con->prepare(
            //"SELECT $UID, user_level FROM $users WHERE (email ='?' AND uname = '?')"
        //);
    }

    public static function allCarIDs(){
        global $AO_DB;
        /*if(self::$_allAuctionsCID){
            if(pasGet::$_allAuctionsCID->execute() ){
                $res = pasGet::$_allAuctionsCID->get_result();  //only available when using mysqlnd in the site's webspace
                //pasGet::$_allAuctionsCID->bind_result($res);
                //pasGet::$_allAuctionsCID->fetch();
                
                if(!$res){
                    echo 'error! no result!';
                    return array();
                }
                //$ret = array();
                //while($row = $res->fetch();){
                    //$ret[] = $row;
                //}
                $ret = $res->fetch_all(MYSQLI_ASSOC); //returns all rows(and their columns) as an associative array
                $res->close();
                return $ret;
            }
            echo 'error! execute failed';
            return array();
        }*/
        //else bind failed,
        //default to regular query
        $aoCars = 'aoCars';
        $res = $AO_DB->query(
            "SELECT car_id FROM $aoCars"
        );
        if($res){
            $ret = array();
            while($row = $res->fetch_assoc()){
                $ret[] = $row;
            }            
            $res->close();
            return $ret;
        }
        return array();
    }
    public static function currentCarID(){
        //returns the user's currently selected vehicle
        global $AO_DB;
        $id = 2;  //$_SESSION['user_id'];
        $users = 'users';
        
        $res = $AO_DB->query(
            "SELECT car_id FROM $users WHERE user_id = $id"
        );
        
        if($res){
            //user has car
            $ret = intval($res->fetch_assoc()['car_id']);
            $res->close();
            return $ret;
        }
        else{
            //query failed, user has no entry in database
            //echo sql error
        }
        return 0;
    }
    public static function currentCar(){
        //returns the user's currently selected vehicle
        global $AO_DB;
        global $aoUsersDB;
        //$id = 2;  //$_SESSION['user_id'];
        $users = 'users';
        
        /*$result = $AO_DB->query(
            //"SELECT car_id FROM $users WHERE user_id = $id"
        //);
        
        if($result){
            //user has car
            $cid = intval($res->fetch_assoc()['car_id']);
            
            if($cid != 0){
                $tableName = getUserTableName();
                $res = $aoUsersDB->query("SELECT * FROM $tableName WHERE car_id = $cid");
                
                if($res){
                    $ret = Vehicle::fromArray($res->fetch_assoc() );
                    $res->close();
                    return $ret;
                }        
                $res->close();
            }
            else{   //user does not have a car selected
                return null;
            }
            $result->close();
        }
        else{
            //query failed, user has no entry in database
            //echo sql error
            return null;
        }*/
        return null;
    }
    
    public static function auctionCars(){
        //selects all vehicles from the primary AutoObsession vehicle table(in finalpost),
        //returning them as a JSON array
        global $AO_DB;
        $aoCars = 'aoCars';
        $CID = 'car_id';
        $cars = array();
       
        $res = pasGet::AllCarIDs(); //returns an array, containing an array for each row/car entry
        
        if(!empty($res)){
            foreach($res as $row){
                $cid = $row[$CID];
                $cars[] = array(
                    'carID' => $cid,
                    'hasCar' => hasCar($cid),   //does user have this car?
                    'hasLostCar' => hasLostCar($cid)   //did the user lose the auction for this car
                    //'hasSoldCar' => hasSoldCar($carID)   //does user have this car?
                );
            }
        }
        /*$res = $AO_DB->query(
            "SELECT * FROM $aoCars"
        );
        
        if($res){        
            while($row = mysqli_fetch_array($res) ){
                $carID = intval($row['car_id']);
                $cars[] = array(
                    'carID' => $carID,
                    'hasCar' => hasCar($carID)   //does user have this car?
                    //'hasLostCar' => hasLostCar($carID)   //did the user lose the auction for this car
                    //'hasSoldCar' => hasSoldCar($carID)   //does user have this car?
                );
            }
            $res->close();
        }
        else{   //The no entries in table
            //echo "<p class='error'>User: has no entries in database</p>";
        }*/
        echo json_encode($cars);
    }
    public static function auctionCarsCount(){
        //returns the number of entries in vehicle database
        global $AO_DB;
        $aoCars = 'aoCars';
        //$count is initialized when this is called for the first time
        static $count = 0;
        //static $getCars = $AO_DB->prepare(
            //"SELECT * FROM $aoCars"
        //);
        if($count == 0){
            //this should only execute once
            //static $getCars = $AO_DB->prepare(
                //"SELECT * FROM $aoCars"
            //);
            $res = $AO_DB->query(
                "SELECT * FROM $aoCars"
            );
            
            if($res){
                //fetch each entry until there are no more
                $count = $res->num_rows;
                //while($row = mysqli_fetch_array($res) ){
                    //$count += 1;
                //}
                $res->close();
            }
            else{   //select failed, no vehicles
                //echo "<p class='error'>User: has no entries in database</p>";
            }
        }
        return $count;
    }/*
    public static function userCarFromID($carID){
        //selects all vehicles the user owns, returning it as a JSON array
        global $aoUsersDB;
        $userID = getUserTableName();
        
        $res = $aoUsersDB->query(
            "SELECT * FROM $userID WHERE car_id = $carID"
        );
        if($res){
            if(mysqli_num_rows($res) != 0){
                //$q = "INSERT INTO vehicles (car_id, make, model, year, info) VALUES (' ', '$make', '$model', '$year', '$info')";		
                $data = $res->fetch_assoc();//@mysqli_query($CARS.$con, $q); // Run the query
                //if(DEBUG){
                    //$car = Vehicle::fromArray($data);
                    //echo '{"data":"this is data!"}';
                    //echo $car->toJSON();
                //}
                //else{
                    //echo Vehicle::fromArray($result->fetch_assoc() )->toJSON();
                //}
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
    }*/
    public static function userCarCount(){
        //returns the number of entries in user's database(garage)
        global $aoUsersDB;
        $uid = getUserTableName();
        //$count is initialized when this is called for the first time
        $count = 0;
        //this should only execute once
        $res = $aoUsersDB->query(
            "SELECT * FROM $uid"
        );
        
        if($res){  
            $count = $res->num_rows;
            //fetch each entry until there are no more
            //while($row = mysqli_fetch_array($res) ){
                //$count += 1;
            //}
            $res->close();
        }
        //else{query failed, no entries in table}
        return $count;
    }
    //public static function getAuctionWins(){
        //returns how many auctions the user has won
        //carCount + salesCount();
    //}
    //public static function getAuctionLosses(){
        //returns how many auctions the user has lost
        //global aoFailedAuctions;
        //$uid = getUserTableName();
        //$count = 0;
        /*
        $res = $aoCarSalesDB->query(
            "SELECT * FROM $uid"
        );
        
        if($res){
            $count = $res->num_rows;
            //fetch each entry until there are no more
            //while($row = mysqli_fetch_array($res) ){
                //$count += 1;
            //}
            $res->close();
        }*/
    //}
    //public static function getAuctionAvg(){
        //returns aver ratio of wins/losses
        //return (getAuctionWins() - getAuctionLosses() ) / getTotalCarCount();
    //}
    public static function userSalesCount(){
        //returns the number cars sold by the user
        global $aoCarSalesDB;
        $uid = getUserTableName();
        //$count is initialized when this is called for the first time
        $count = 0;
        $res = $aoCarSalesDB->query(
            "SELECT * FROM $uid"
        );
        
        if($res){
            $count = $res->num_rows;
            $res->close();
        }
        //else{user has no entries in table, count is 0;}
        return $count;
    }
    //public static function getRemainingCars(){
        //returns an array of cars the user still has to purchase
    //}
    public static function getTotalUserCarCount(){
        //total cars ever purchased by the user
        return getUserCarCount() + getUserSalesCount();
    }
    public static function getRemainingCarCount(){
        //returns the number of cars the user still has to purchase
        //$ret = getAuctionCarsCount() - (getUserCarCount() + getUserSalesCount() );
        //echo $ret
        return getAuctionCarsCount() - getTotalUserCarCount();
    }
    public static function getGameCompletion(){
        //percentage of cars bought and sold by the user
        $acCount = getAuctionCarsCount();
        
        return $acCount != 0 ? getTotalUserCarCount() / $acCount : 0.0;
    }
	
	
}
pasGet::init();
//pasGet::userInit();
?>