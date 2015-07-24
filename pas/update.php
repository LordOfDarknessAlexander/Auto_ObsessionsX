  <?php
//this script INSERTs or UPDATEs Database values with sql
//used by javascript ajax requests
require_once '../pasMeta.php';
require_once '../re.php';
require_once '../secure.php';
require_once 'user.php';

//
//secure::loggin();
//secure::memberLogin();
//
$ps = isset($_POST) && !empty($_POST) ? true : false;
$gs = isset($_GET) && !empty($_GET) ? true : false;
//
/*
 public static function cancelCarSale($carID){
        //
        global $aoUsersDB;
        
        $ut = getUserTableName();
        $car = user::getCarByID($carID);
        $CID = ao::CID;
		$P = 'price';
		$p = 0.0;
		
		if(user::removeCarSaleByID($carID) ){
			$res = user::slctFromEntry("$CID");
			
			if($res){
				$cid = intval($res->fetch_assoc()[$CID]);
              
               echo 'BiddyBoop';
				
                //echo $cid;
				//if($cid == $carID){
					//pasUpdate::userCurrentCar();
				//}
                //else vehicles are different, no change
              //  $temp = $aoUsersDB->query(
				//    "INSERT INTO $ut ($CID, $P) VALUES ($carID, )"
			   // );
                
                //echo json_encode($temp);
                
                if($temp){               
                    return array(
                        $CID => $carID
                    );
                }
			}
			
			
					
        }
        return null;
    }
}

*/

class pasUpdate{
    public static function soldCar($carID, $price){
        //$res = $aoUsersDB->query(
            //if entry does not exist add it, else update
            //"UPDATE $tableName SET drivetrain=$dt, body=$body, interior=$inter, docs=$docs, repairs=$rep WHERE car_id = $carID"
        //);
        
        //echo json_encode($res);
    }
    public static function userLoss($carID){
        global $aoAuctionLossDB;
        $table = getUserTableName();
        $ret = false;
        $CID = ao::CID;
        
        $res = $aoAuctionLossDB->query(
            //if entry does not exist add it, else update
            //sql::insert($table, "$CID", "$carID");
            "INSERT INTO $table ($CID) VALUES ($carID)"
        );
        
        return $res ? true : false;
    }
    public static function userCurrentCar($carID = 0){
        //global $AO_DB;
        $CID = ao::CID;
        //$UID = ao::UID;
        //$users = 'users';
        //$uid = strval(getUID() );
        
        if($carID == 0 || hasCar($carID)){
            //$res = user::updateEntry("$CID = $carID");

			if(user::updateEntry("$CID = $carID")){
				return $carID;
				//$id = intval($res->fetch_assoc()[$CID]);
			}
		}
		return 0;
        //return hasCar($carID) ? ($AO_DB->query(
            //"UPDATE $users SET
                //$CID = $carID
            //WHERE
               //$UID = $uid"
        //) ? $carID : 0) : 0;
    }
	public static function updateSale($carID, $bid, $curTime){
		global $aoCarSalesDB;
        $CID = ao::CID;
		$T = '_time';
		$P = 'price';
		$b = is_numeric($bid) ? $bid : floatval($bid);
		$t = is_numeric($curTime) ? $curTime : floatval($curTime);
		$t = $t >= 0.0 ? $t : 0.0;
		//time should never be less then 0
        $q = sql::update(getUserTableName(), "$P = $b, $T = $t") . "WHERE $CID = $carID";
          
        return $aoCarSalesDB->query($q);
	}
}
/*if($gs){
    //args being passed vai the url
    if(isset($_GET['op']) && $_GET['op'] == 'asc'){
        getAuctionCars();
        exit();
    }
}*/
class purchase{
    //private
    //const FAILED = 'Could not complete purchase!';
    static public function funds($funds){
        //add funds to loggedin user's account        
        if(is_float($funds) && $funds > 0.0){
            $f = round($funds, 2);  //round currency to 2 decimal places
            $m = 'money';            
            $uf = user::slctFromEntry($m);  //previous user funds
            //$rm = user::getFunds();
            
            //if($rm){
            //$UID = ao::UID;
            $MF = PHP_INT_MAX;
            //$uf = floatval($rm->fetch_assoc()[$m]);  //user funds
            $nf = $uf + $f;   //new funds
            //echo $nf;
            if($nf < $MF){
                //echo $nf;
                $res = user::updateEntry("$m = $nf");
                //echo json_encode($res);
                if($res){
                    //echo 'win';
                    echo json_encode($nf);
                    return;
                }
                //else
                //output sql errors
            }
            //else
            echo 'Operation failed, could not purchase more funds, cap reached!';
            $rm->close();
            echo json_encode($uf);
        }
        //}
        //$f = json_encode($funds);
        //echo "purchase::funds(), invalid value $f, purchase::failed";
    }
    static public function tokens($val){
        //adds $val number of tokens to user's account,
        //$val must be an unsigned int greater than 0
        $MAX_TOKENS = PHP_INT_MAX;
        
        if(is_int($val) && $val > 0){
            $t = 'tokens';            
            $rt = user::slctFromEntry($t);
            
            if($rt){
                $ut = intval($rt->fetch_assoc()[$t]);   //user's current tokens
                $nt = $ut + $val;    //new tokens
                
                if($nt < $MAX_TOKENS){
                    $res = user::updateEntry("$t = $nt");
                    
                    if($res){
                        echo json_encode($nt);
                        return;
                    }
                    //else
                    //echo json_encode($ut);
                    //output sql errors
                    return;
                }
                //else
                echo 'Operation failed, could not purchase more tokens, cap reached!';
                $rt->close();
                echo json_encode($ut);
                return;
            }
            //else
            //echo 'sql error, select query failed!';
            //return;
        }
        //$f = json_encode($funds);
        //echo "purchase::funds(), invalid value $f, purchase::failed";
    }
}
function addPrestige($val){
    //$val must be an unsigned int greater than 0    
    if(is_int($val) && $val > 0){
        $t = 'prestige';
        $rt = user::slctFromEntry($t);
       
        if($rt){
            $MP = PHP_INT_MAX;  //static max prestige
            $ut = intval($rt->fetch_assoc()[$t]);   //user's current tokens
            $nt = $ut + $val;    //new tokens
            
            if($nt < $MP){
                $res = user::updateEntry("$t = $nt");

                if($res){
                    echo json_encode($nt);
                    return;
                }
                //else
                //echo json_encode($ut);
                //output sql errors
                return;
            }
            //else
            echo 'Operation failed, could not purchase more tokens, cap reached!';
            $rt->close();
            echo json_encode($ut);
            return;
        }
        //else
        //echo 'sql error, select query failed!';
        //return;
    }
    //$f = json_encode($funds);
    //echo "purchase::funds(), invalid value $f, purchase::failed";
}
function incMarkers(){
    //$val must be an unsigned int greater than 0
    global $AO_DB;
    
    $MAX_TOKENS = PHP_INT_MAX;
    $UID = ao::UID;
    $uid = strval(getUID() );
    $users = ao::USERS;
    $t = 'm_markers';

    $rt = user::slctFromEntry($t);

    if($rt){
        $ut = intval($rt->fetch_assoc()[$t]);   //user's current tokens
        $nt = $ut + $val;    //new tokens
        
        if($nt < $MAX_TOKENS){
            $res = user::updateEntry("$t = $nt");

            if($res){
                echo json_encode($nt);
                return;
            }
            //else
            //echo json_encode($ut);
            //output sql errors
            return;
        }
        //else
        echo 'Operation failed, could not purchase more tokens, cap reached!';
        $rt->close();
        echo json_encode($ut);
        return;
    }
    //$f = json_encode($funds);
    //echo "purchase::funds(), invalid value $f, purchase::failed";
}
//if(isset($_GET) ){
    //if(isset($_GET['op']) ){
        //$op = isAlpha($_GET['op']) ? $_GET['op'] : '';
    //}
    //elseif($_GET['']){
        //preform other operations!
    //}
    //else no valid get args!
    //exit();
//}
if(isSetP() ){
    $CID = ao::CID;
    $OP = 'op';
    $DT = 'drivetrain';
    $B = 'body';
    $I = 'interior';
    $D = 'docs';
    $R = 'repairs';

    //eP();
    
    if(isset($_POST['carID'])){
        //
        $carID = isUINT($_POST['carID']) ? intval($_POST['carID']) : exit('_POST at carID invalid value');   //is_int($_POST['carID']) ? intval($_POST['carID']) : 0;
		
		//$carCon = $_POST['repairs']; 
        //validate value, must be an int!
        //echo json_encode($carID);
		//echo $carID;
		//exit();
        //switch the operation besed on value passed in url
        if(isSetG() ){
            //eG();
            //args being passed via the url
            if(isset($_GET[$OP]) ){
                $op = isAlpha($_GET[$OP]) ? $_GET[$OP] : '';
                
                if($op == 'insert'){
                    //inserts a car with carID from the vehicle database into the
                    //logged in user's table in aoUsersDB
                    //returns true if the INSERTion is successful,
                    //false if user has the vehicle already or any other reason the vehicle could not be added
                    $hasCar = hasCar($carID);
                    $hasLostCar = hasLostCar($carID);
                    //echo json_encode(false);
                    //exit();                    
                    if($hasCar || $hasLostCar){
                        //user has already bought this car, exit with false!
                        //echo json_encode(false);
                        if($hasLostCar){
                            echo "You've already lost this auction before.";
                        }
                        exit();
                    }
                    else{
                        //if($AO_DB->query() ){
                        //
                        $P = 'price';
                        $p = isFloat($_POST[$P]) ? round(floatval($_POST[$P]), 2) : exit;
                        //echo $p;
                        $uf = user::getFunds();  //current user funds
                        $nf = user::decFunds($p);
                        $delta = $uf - $nf;
                        
                        //due to floating point (in)percision,
                        //float are not safe to equate directly
                        //instead, check if delta is less than an
                        //epsilon value
                        if($delta > 0.000008){
                            //echo 'bought car';
                            //echo $delta;
                        
                            $tableName = getUserTableName();
                            
                            $dt = Vehicle::getRandStage();
                            $b = Vehicle::getRandStage();
                            $i = Vehicle::getRandStage();
                            $d = Vehicle::getRandStage();
                            $r = Vehicle::getRandRepairs();
                            
                            //echo "dt:$dt, body:$b, interior:$i, documents:$d, repairs:$r";
                            $res = $aoUsersDB->query(
                                "INSERT INTO $tableName
                                    ($CID, $DT, $B, $I, $D, $R)
                                VALUES
                                    ($carID, $dt, $b, $i, $d, $r)"
                                //IF entry EXISTS do nothing
                            );
                            //res contains the result of the operation
                            echo json_encode($res);
                        }
                        else{
                            echo 'insufficient funds to purchase vehicle';
                        }
                    }
                    exit();
                }
                elseif($op == 'update'){
                    //inserts a car with carID from the vehicle database into the
                    //logged in user's table in aoUsersDB
                    $dt = intval($_POST['dt']);     //isUInt8($_POST['dt']) ? intval($_POST['dt']) : 0;
                    $body = intval($_POST[$B]);     //isUInt8($_POST['body']) ? intval($_POST['body']) : 0;
                    $inter = intval($_POST[$I]);
                    $docs = intval($_POST[$D]);
                    
                    $rep = intval($_POST[$R]);
                    
                    $tableName = getUserTableName();    //$_SESSION['userID'];

                    $res = $aoUsersDB->query(
                        "UPDATE $tableName SET
                            $DT=$dt, $B=$body, $I=$inter, $D=$docs, $R=$rep
                        WHERE
                            $CID = $carID"
                    );
                    
                    echo json_encode($res);
                    exit();
                }
                elseif($op == 'iul'){
                    //insert user loss for carID
                    $res = pasUpdate::userLoss($carID);
                    
                    echo json_encode($res);
                    exit();
                }
                elseif($op == 'succ'){
                    //set user current car
                    $res = pasUpdate::userCurrentCar($carID);
                    
                    echo json_encode($res);
                    exit();
                }
                elseif($op == 'pucs'){
					$res = user::postCarSale($carID);
                    echo json_encode($res);
				
                    exit();
                }
				elseif($op == 'cucs'){
                    //$res = 117;
					$res = user::cancelCarSale($carID);
                    echo json_encode($res);
				
                    exit();
                }
				elseif($op == 'psu'){
					//post sale update
					$bid = isFloat($_POST['price']) ? round(floatval($_POST['price']), 2) : exit('_POST at price invalid value');
					$curTime = isFloat($_POST['_time']) ? floatval($_POST['_time']) : exit('_POST at _time invalid value');
					$res = pasUpdate::updateSale($carID, $bid, $curTime);
                    echo json_encode($res);
				
                    exit();
                }
                //else switch to other calls
                echo 'invalid operation ($op) selected, error loading page';
                exit();
            }
            //elseif other GET args
            //else no supported operation!
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
    elseif(isset($_POST['udv'])){
        //user data value, for updating the user's stats
        if(is_numeric($_POST['udv']) ){
            if($gs){
                //args being passed via the url
                if(isset($_GET[$OP]) ){
                    $op = isAlpha($_GET[$OP]) ? $_GET[$OP] : '';
                    //echo json_encode(gettype($_POST['udv'])); //returns a string
                    //exit();
                    if($op == 'puf'){
                        user::incFunds(floatval($_POST['udv']) );
                        exit();
                    }
                    if($op == 'duf'){
                        user::decFunds(floatval($_POST['udv']) );
                        exit();
                    }
                    if($op == 'put'){
                        purchase::tokens(intval($_POST['udv']) );
                        exit();
                    }
                    if($op == 'aup'){
                        //addPrestige(intval($_POST['udv']));
                        exit();
                    }
                    if($op == 'aum'){
                        //addMarkers(intval($_POST['udv'])) ;
                        exit();
                    }
                    //else
                    //invalid operation;
                }
                //elseif other $_GET vars
                //else
                //invalid operation;
            }
            //else
            //no vars set with $_GET, no operation preformed
        }
        else{
            //echo 'invalid $_POST entry';
        }
    }
    //elseif other $_POST entries
    //
    echo 'no valid post entries, executing script did nothing';
    exit();
}
else{
    //no passing any values via POST, return all cars
    //echoUserCars();
    echo 'not passing post vars!';
    exit();
}
/*public static function hasSoldCar($carID){
    //does the user's table in aoCarSalesDB already have an entry with car_id '$id'
    global $aoSoldCarsDB;
    
    $tableName = getUserTableName();    //$_SESSION['userID'];
    $ret = false;
    
    $res = $aoSoldCarsDB->query("SELECT * FROM $tableName WHERE car_id = $id");
    
    if($res){
        //user has sold car, valid entry in db
        $ret = mysqli_num_rows($res) != 0 ? true : false;
    }
    //else{user still owns car, no entry in db}
    mysqli_free_result($res);
    
    return $ret;
}*/

/*public static function getCarFromID($carID){
    //selects a vehicle from the car database,
    //returning it as a JSON object string
    global $AO_DB;
    $aoCars = 'aoCars';
    static $_getCar = $AO_DB->prepare(
        "SELECT * FROM $aoCars WHERE car_id = ?"
    );
    if(_getCar){
        //bind_params
            //execute
    }
    else{
        $res = $AO_DB->query(
            "SELECT * FROM $aoCars WHERE car_id = $carID"
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
            mysqli_free_result($res);
        }
        else{   //The vehicle is already registered
            //return null; //echo "<p class='error'>The email address is not acceptable because it is already registered</p>";
        }
    }
    return null;
}*/
/*function updateSale($sale){
    gloabal $aoCarSalesDB;
    $res = $aoCarSalesDB->query(
        "IF NOT EXISTS entry with saleID
        INSERT ... ELSE
        ON DUPLICATE KEY UPDATE existing sale"
    );
    return $ret;
}*/
/*function updateUser(){
    gloabal $AO_DB;
    $users = 'users';
    $uid = getUserTableName();
    //$cash, $tok, $prest, $markers;
    //static $updateUser = $AO_DB->prepare(
        //"UPDATE $users SET
        //(money = ?, tokens = ?, prestige = ?, m_markers = ?)
        //WHERE user_id = ?"
    //);
    
    $res = $AO_DB->query("UPDATE $users SET (money, tokens, prestige, markers) WHERE user_id = $uid");
    //return;
}*/
?>