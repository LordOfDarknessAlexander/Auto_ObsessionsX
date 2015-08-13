<?php
//this script contains the api for retrieving stats about the user and associated databases,
//if this script is executed nothing will happen, as it only contains function definitions
//header('Access-Control-Allow-Origin: *');
//
require_once '../pasMeta.php';
require_once 'user.php';
require_once '../secure.php';
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
/*function aoPriceFromRange($range, &$gt, &$lt){
    $ret = array();

    if($range == aoPriceRange::LOW){
        $ret[] = 10000.00;
        $lt = 30000.00;
    }
    elseif($range == aoPriceRange::MID){
        $ret[] = 30000.00;
        $lt = 75000.00;
    }
    elseif($range == aoPriceRange::HIGH){
        $ret[] = 7.5e4;    //75000
        $lt] = 1.5e5;
    }
    elseif($range == aoPriceRange::ELITE){
        $ret[] = 1.5e5;    //150000.00
        $lt = 1.0e16;    //cap of 10 trillion, no car should ever be this expensive
    }
    elseif($range == aoPriceRange::ALL){
        $ret[] = 0.0;
        $lt = 1.0e16;
    }
    else{
        echo "invalid value ($range)";
        return $ret;
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
        'hasLostCar'=>hasLostCar($cid),   //did the user lose the auction for this car
        'hasSoldCar'=>hasSoldCar($cid)   //does user have this car?
    );
}
class pasGet{
    //private static
        //$_allCars,
		//$_login,
        //$_allCarData,
        //$_allAuctionsCID;
    
    public static function init(){
        global $AO_DB;
        
        $aoCars = ao::CARS;
        $users = ao::USERS;
        $UID = ao::UID;
        $CID = ao::CID;
        //
        //AO_DB aoCars
        //
        //self::$_allCars = $AO_DB->con->prepare(
            //"SELECT * FROM $aoCars" //select all data, from all rows
        //);
        //self::$_allCarData = $AO_DB->con->prepare(
            //"SELECT $CID, price FROM $aoCars"
        //);
        //self::$_allAuctionsCID = $AO_DB->con->prepare(
            //"SELECT $CID FROM $aoCars"  //select the car id from each row
        //);
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
            sql::slctAllFromCarDB()
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
                $ret[] = asCarInfoFromArray($row);
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
        
        $CID = ao::CID;
        
        $res = user::slctFromEntry("$CID");
        
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
        $wins = user::getTotalCarCount();
        $loss = pasGet::auctionLosses();
        $diff = $wins - $loss;
        $total = $wins + $loss;
        
        return 0.0;//$total != 0 ? ($diff / $total) : 0.0;
    }
    //public static function getRemainingCars(){
        //returns an array of cars the user still has to purchase
    //}
    public static function getRemainingCarCount(){
        //returns the number of cars the user still has to purchase
        //$ret = getAuctionCarsCount() - (getUserCarCount() + getUserSalesCount() );
        //echo $ret
        return pasGet::auctionCarsCount() - user::getTotalCarCount();
    }
    //public static function gameCompletion(){
        //percentage of cars bought and sold by the user
        //$acCount = pasGet::auctionCarsCount();
        
        //return $acCount != 0 ? user::getTotalCarCount() / $acCount : 0.0;
    //}	
}
pasGet::init();
//pasGet::userInit();
?>