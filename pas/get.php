<?php
//this script contains the api for retrieving stats about the user and associated databases,
//if this script is executed nothing will happen, as it only contains function definitions
//header('Access-Control-Allow-Origin: *');
//
require_once '../pasMeta.php';
require_once 'user.php';
//require_once '../include/secure.php';
//
//secure::loggin();
//
class aoPriceRange{
    const
        LOW = 'low',
        MID = 'mid',
        HIGH = 'high',
        ELITE = 'elite',
        ALL = 'all';
}
/*function aoPriceFromRange($range){
    $ret = array();

    if($range == aoPriceRange::LOW){
        $ret[] = 10000.00;
        $ret[] = 30000.00;
    }
    elseif($range == aoPriceRange::MID){
        $ret[] = 30000.00;
        $ret[] = 75000.00;
    }
    elseif($range == aoPriceRange::HIGH){
        $ret[] = 7.5e4;    //75000
        $ret[] = 1.5e5;
    }
    elseif($range == aoPriceRange::ELITE){
        $ret[] = 1.5e5;    //150000.00
        $ret[] = 1.0e16;    //cap of 10 trillion, no car should ever be this expensive
    }
    elseif($range == aoPriceRange::ALL){
        $ret[] = 0.0;
        $ret[] = 1.0e16;
    }
    else{
        echo "invalid value ($range)";
        return $ret;
    }
}*/
/*
class sql{
    public static function selectAll($tableName){
        $str = mysql_real_escape_string($tableName);
        return "SELECT * FROM $str";
    }
    public static function selectAll($tableName, $rows){
        //single identifier, or comma separated list of identifiers
        //isArgList($rows)
        return "SELECT $rows FROM $tableName";
    }
    public static function selectWhere($tableName, $rows, $cond){
        //single identifier, or comma seperated list of identifiers
        $r = mysql_real_escape_string($rows);
        return "SELECT $rows FROM $tableName WHERE $cond";
    }
    public static function selectAllFromUser(){
        //selects all entries in database with a user table entry
        $userID = getUserTableName();
        return "SELECT * FROM $userID";
    }
}*/
function asCarInfoFromArray($r){
    //returns data to display elements in Auction Select
    $CID = ao::CID;
    $N = 'name';
    $P = 'price';
    $S = 'src';
    $car = Vehicle::fromArray($r);

    return array(
        $CID=>$car->getID(),
        $S=>$car->getLocalPath(),
        $N=>$car->getFullName(),
        $P=>$car->getPrice()
    );           
}
function auctionCarInfoFromArray($r){
    //prepares the car values required for posting an auction
    $CID = ao::CID;
    $N = 'name';
    $P = 'price';
    $S = 'src';
    $cid = $r[$CID];
    
    return array(
        'carID'=>$cid,
        $S=>$r[$S],     //image source
        $N=>$r[$N],     //
        $P=>floatval($r[$P]),       //unmodified price of vehicle
        //
        'hasCar'=>hasCar($cid),   //does user have this car?
        'hasLostCar'=>hasLostCar($cid)   //did the user lose the auction for this car
        //'hasSoldCar' => hasSoldCar($carID)   //does user have this car?
    );
}
class pasGet{
    private static
        $_allCars,
		 $_login,
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
    }*/
		
	
	public static function userInit ()
	{
		//global $aoMembersDB;
		global $AO_DB;
	
		$aoMembersDB = ao::MEMBERS;
		$e = 'email';
		$p = 'psword';
		
		$UID = 'user_id';
			//$aoMembersDB users
		
		self::$_login =  $AO_DB->con->prepare(
            "SELECT user_id, fname,uname, user_level FROM users WHERE (email='$e' AND psword=SHA1('$p') )"
			
			
			
			
			
			
        );
	//	self::$_allUsers = $AO_DB->con->prepare(
     //    "SELECT * FROM $users"    //returns an array of all user data
      //  );
      
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
	}
	
    public static function init(){
        global $AO_DB;
        
        $aoCars = ao::CARS;
        $users = ao::USERS;
        $UID = ao::UID;
        $CID = ao::CID;
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
      /*  self::$_allUsers = $AO_DB->con->prepare(
            "SELECT * FROM $users"    //returns an array of all user data
        );
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
        //);*/
    }
   /* public static function userStage(){
        //returns the user's current stage in the Auction Select screen
        global $AO_DB;
        
        $users = ao::USERS;
        $T = 'stage';
        $UID = ao::UID;
        $uid = getUID();
        $ret = 'classic';
        
        /*$res = $AO_DB->query(
            "SELECT $T FROM $users WHERE $UID = $uid"
        );
        
        if($res){
            $ret = $res->fetch_assoc()[$T];
            $res->close();
        }*/
       // return $ret;
   // }
    public static function allCarData(){
        //
        global $AO_DB;

        $aoCars = ao::CARS;
        $CID = ao::CID;
        $N = 'name';
        $P = 'price';
        $S = 'src';
        $ret = array();
        
        //echo 'car data!';
        
        $res = $AO_DB->query(
            sql::slctAllFromCarDB()//"SELECT * FROM $aoCars"
        );
        
        if($res){   
            while($row = $res->fetch_assoc()){
                $ret[] = asCarInfoFromArray($row);
            }
            $res->close();
        }
        //echo json_encode($ret);
        return $ret;
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
        $aoCars = ao::CARS;
        $CID = ao::CID;
        $ret = array();
        //$res = sql::slctFrom($CID, $aoCars);
        $res = $AO_DB->query(
            "SELECT $CID FROM $aoCars"
        );
        
        if($res){            
            while($row = $res->fetch_assoc()){
                $ret[] = $row;  //intval($row[$cid]);
            }      
            $res->close();
        }
        return $ret;
    }
    public static function carIDsByType($carType){
        global $AO_DB;
        
        $aoCars = ao::CARS;
        //$CID = ao::CID;
        $T = 'type';
        //$N = 'name';
        //$P = 'price';
        //$S = 'src';
        $ct = $AO_DB->escape($carType);
        $ret = array();
        //if is str(carType)
        //echo "carType" . json_encode($carType);
        //echo "CT:" . json_encode($ct);
        $q = sql::slctAllFromCarDB();   //"SELECT * FROM $aoCars";
        
        if($ct != 'all'){
            $q .= " WHERE $T = '$ct'";
        }
        //echo $q;
        $res = $AO_DB->query($q);
        
        if($res){
            while($row = $res->fetch_assoc() ){                
                $ret[] = asCarInfoFromArray($row);    //array(
                    //$CID=>$car->getID(),
                    //$S=>$car->getLocalPath(),
                    //$N=>$car->getFullName(),
                    //$P=>$car->getPrice()
                //);               
            }            
            $res->close();
        }
        //echo json_encode($ret);
        return $ret;    //will be empty if sql fails
    }
    public static function carIDsByPriceRange($range){
        global $AO_DB;
       
        $aoCars = ao::CARS;
        $CID = ao::CID;
        $P = 'price';
        $N = 'name';
        $S = 'src';
        $ret = array();
        //set conditions to default(select all)
        $gt = 0.00;
        $lt = 1.0e16;
        
        if($range == aoPriceRange::LOW){
            $gt = 10000.00;
            $lt = 30000.00;
        }
        elseif($range == aoPriceRange::MID){
            $gt = 30000.00;
            $lt = 75000.00;
        }
        elseif($range == aoPriceRange::HIGH){
            $gt = 7.5e4;    //75000
            $lt = 1.5e5;
        }
        elseif($range == aoPriceRange::ELITE){
            $gt = 1.5e5;    //150000.00
            $lt = 1.0e16;    //cap of 10 trillion, no car should ever be this expensive
        }
        
        $res = $AO_DB->query(
            sql::slctAllFromCarDB() . " WHERE $P >= $gt AND $P < $lt"
        );
        
        if($res){
            while($row = $res->fetch_assoc() ){
                $ret[] = asCarInfoFromArray($row);
            }            
            $res->close();
        }
        return $ret;    //will be empty if sql fails
    }
    public static function carIDsByTypeRange($carType, $range){
        global $AO_DB;
       
        $aoCars = ao::CARS;
        $CID = ao::CID;
        $P = 'price';
        $T = 'type';
        $N = 'name';
        $S = 'src';
        $ret = array();
        $ct = $AO_DB->escape($carType);
        
        //echo "Type:$ct Range:$range";
        
        if($range == aoPriceRange::LOW){
            $gt = 10000.00;
            $lt = 30000.00;
        }
        elseif($range == aoPriceRange::MID){
            $gt = 30000.00;
            $lt = 75000.00;
        }
        elseif($range == aoPriceRange::HIGH){
            $gt = 7.5e4;    //75000
            $lt = 1.5e5;
        }
        elseif($range == aoPriceRange::ELITE){
            $gt = 1.5e5;    //150000.00
            $lt = 1.0e16;    //cap of 10 trillion, no car should ever be this expensive
        }
        elseif($range == aoPriceRange::ALL){
            $gt = 0.0;
            $lt = 1.0e16;
        }
        else{
            echo "invalid value ($range)";
            return $ret;
        }
        //if(!empty($r) ){
        $q = sql::slctAllFromCarDB() . " WHERE $P >= $gt AND $P < $lt";
        
        if($ct != 'all'){
            $q .= " AND $T = '$ct'";
        }
        
        $res = $AO_DB->query($q);
        
        if($res){
            while($row = $res->fetch_assoc() ){
                $ret[] = asCarInfoFromArray($row);
            }            
            $res->close();
        }
        return $ret;    //will be empty if sql fails
    }
    public static function currentCarID(){
        //returns the user's currently selected vehicle
        global $AO_DB;
        //$id = getUID();  //$_SESSION['user_id'];
        //$users = ao::USERS;
        $CID = ao::CID;
        //$UID = ao::UID;
        
        $res = user::slctFromEntry("$CID");
        //$AO_DB->query(
            //"SELECT $CID FROM $users WHERE $UID = $id"
        //);
        
        if($res){
            //user has car
            //$ret = $res->fetch_assoc()[$CID];
            //$i = isUINT($ret) ? intval($ret) : 0;
            $ret = intval($res->fetch_assoc()[$CID]);
            $res->close();
            return $ret;    //$i;
        }
        else{
            $AO_DB->eErr();
        }
        return 0;
    }
    public static function currentCar(){
        //returns the user's currently selected vehicle
        global $AO_DB;
        global $aoUsersDB;
        //$id = 2;  //$_SESSION['user_id'];
        $users = ao::USERS;
        $CID = ao::CID;
        $UID = ao::UID;        
        /*$result = $AO_DB->query(
            //"SELECT $CID FROM $users WHERE $UID = $id"
        //);
        
        if($result){
            //user has car
            $cid = intval($res->fetch_assoc()[$CID]);
            
            if($cid != 0){
                $tableName = getUserTableName();
                $res = $aoUsersDB->query("SELECT * FROM $tableName WHERE $CID = $cid");
                
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

        $cars = array();
        //$N = 'name';
        //$P = 'price';
        //$S = 'src';
       
       //returns an array, containing an array for each row/car entry
        $res = pasGet::allCarData();
        
        if(!empty($res)){
            foreach($res as $row){
                //echo json_encode($row);                
                $cars[] = auctionCarInfoFromArray($row);//array(
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
    public static function auctionCarsByType($carType){
        //selects all vehicles from the primary AutoObsession vehicle table(in finalpost),
        //returning them as a JSON array
        //$type = pasGet::userStage();
        $cars = array();
        $CID = ao::CID;
        //returns an array, containing an array for each row/car entry,
        //or an empty arry on failure
        $res = pasGet::carIDsByType($carType);
        //echo json_encode($res);
        if(!empty($res)){
            foreach($res as $row){
                //echo json_encode($row);
                $cars[] = auctionCarInfoFromArray($row);
            }
        }
        echo json_encode($cars);
    }
    public static function auctionCarsByPriceRange($range){
        //selects all vehicles from the primary AutoObsession vehicle table(in finalpost),
        //returning them as a JSON array
        $type = pasGet::userStage();
        $cars = array();
        //returns an array, containing an array for each row/car entry,
        //or an empty arry on failure
        $res = pasGet::carIDsByPriceRange($range);
        
        if(!empty($res)){
            foreach($res as $row){               
                $cars[] = auctionCarInfoFromArray($row);
            }
        }
        echo json_encode($cars);
    }
    public static function auctionCarsByTypeAndRange($type, $range){
        //selects all vehicles from the primary AutoObsession vehicle table(in finalpost),
        //$type = pasGet::userStage();
        $cars = array();
        $CID = ao::CID;
        $P = 'price';
        $N = 'name';
        $S = 'src';
        //$range = aoPriceRange::LOW;
        //returns an array, containing an array for each row/car entry,
        //or an empty arry on failure
        $res = pasGet::carIDsByTypeRange($type, $range);
        
        if(!empty($res)){
            foreach($res as $row){              
                $cars[] = auctionCarInfoFromArray($row);
            }
        }
        echo json_encode($cars);
    }
    public static function auctionCarsCount(){
        //returns the number of entries in vehicle database(aoCars in $AO_DB)
        global $AO_DB;
        //$aoCars = ao::CARS;
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
                sql::slctAllFromCarDB() //"SELECT * FROM $aoCars"
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
                echo 'error! no entries in vehicle database';
                $AO_DB->eErr();
                //exit();
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
    public static function userStats(){
        //returns the user's stats from SQL database as an assossiative array
        global $AO_DB;
        
        $CID = ao::CID;
        $M = 'money';
        $T = 'tokens';
        $P = 'prestige';
        $MM = 'm_marker';
        
        $res = user::slctFromEntry("$M, $T, $P, $MM, $CID");
        //$AO_DB->query(
            //"SELECT $M, $T, $P, $MM FROM $users WHERE $UID = $id"
            //"SELECT * FROM $users WHERE $UID = $id"
        //);
        //Count the returned rows
        if($res){
            $rows = $res->fetch_assoc();
            //NOTE:sql retrives data as strings, so must conver to numeric type before sending(strings are bulky)
            $ret = array(
                $M=>floatval($rows[$M]),
                $T=>intval($rows[$T]),
                $P=>intval($rows[$P]),
                $MM=>intval($rows[$MM]),
                'cid'=>intval($rows[$CID])
            );
            $res->close();
            return $ret;
        }
        else{
            //echo "No Results";
            // If there was a problem.
            //echo "<p class='error'>Query failed, Please try again.</p>";
            $AO_DB->eErr();
            //exit();
        }
        return array();
    }
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
        else{
            //query failed, no entries in table
            $aoUsersDB->eErr();
        }
        
        return $count;
    }
    //public static function getAuctionWins(){
        //returns how many auctions the user has won
        //carCount + salesCount();
    //}
    public static function auctionLosses(){
        //returns how many auctions the user has lost
        global $aoAuctionLossDB;
        //$uid = getUserTableName();
        $count = 0;
        
        $res = $aoAuctionLossDB->query(
            sql::slctAllFromUserTable() //"SELECT * FROM $uid"
        );
        
        if($res){
            $count = $res->num_rows;
            $res->close();
        }
        return $count;
    }
    public static function auctionAvg(){
        //returns aver ratio of wins/losses
        $wins = pasGet::getTotalUserCarCount();
        $loss = pasGet::auctionLosses();
        $diff = $wins - $loss;
        $total = $wins + $loss;
        
        return 0.0;//$total != 0 ? ($diff / $total) : 0.0;
    }
    public static function userSales(){
        //returns the user's total active and expired actions
        global $aoCarSalesDB;
        //$uid = getUserTableName();
        $sales = array();
        //$count is initialized when this is called for the first time
        $res = $aoCarSalesDB->query(
            sql::slctAllFromUserTable()     //"SELECT * FROM $uid"
        );
        
        if($res){
            $CID = ao::CID;
            
            while($row = $res->fetch_assoc() ){
                //mysqli retuns values as strings, so convert them
                //to proper types, for faster transfer back to server!
                $sales[] = array(
                    'id'=>intval($row[$CID])
                    //'bid'=>floatval($row['bid']),
                    //'time'=>
                );
            }
            $res->close();
        }
        //else{user has no entries in table, count is 0;}
        return $sales;
    }
    public static function userSalesCount(){
        //returns the number cars sold by the user
        global $aoCarSalesDB;
        //$uid = getUserTableName();
        //$count is initialized when this is called for the first time
        $count = 0;
        $res = $aoCarSalesDB->query(
            sql::slctAllFromUserTable()     //"SELECT * FROM $uid"
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
        return pasGet::userCarCount() + pasGet::userSalesCount();
    }
    public static function getRemainingCarCount(){
        //returns the number of cars the user still has to purchase
        //$ret = getAuctionCarsCount() - (getUserCarCount() + getUserSalesCount() );
        //echo $ret
        return pasGet::auctionCarsCount() - pasGet::getTotalUserCarCount();
    }
    public static function gameCompletion(){
        //percentage of cars bought and sold by the user
        $acCount = pasGet::auctionCarsCount();
        
        return $acCount != 0 ? pasGet::getTotalUserCarCount() / $acCount : 0.0;
    }	
}
pasGet::init();
pasGet::userInit();
?>