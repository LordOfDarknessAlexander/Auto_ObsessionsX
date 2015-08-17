<?php
//
require_once '../pasMeta.php';
require_once '../re.php';
require_once '../secure.php';
//
//secure::loggin();
//
function carDataFromArray($a){
    $CID = ao::CID;
    $DT = 'drivetrain';
    $B = 'body';
    $I = 'interior';
    $D = 'docs';
    $R = 'repairs';
  
    return array(
        $CID=>intval($a[$CID]),
        $DT=>intval($a[$DT]),
        $B=>intval($a[$B]),
        $I=>intval($a[$I]),
        $D=>intval($a[$D]),
        $R=>intval($a[$R])
    );
}
class user{
    //
    const
        M = 'money',
        T = 'tokens',
        P = 'prestige',
        MM = 'm_marker';
        //
        //
        // DT = 'drivetrain',
        // B = 'body',
        // I = 'interior',
        // D = 'docs',
        // R = 'repairs',
		// P = 'price';
        
    public static function slctFromEntry($fields){
        //select column(s) from a user's row entry in database 'AO_DB' in table 'users'
        global $AO_DB;
        //$fields is a comma seperated list of row names
        $uid = strval(getUID() );
        $UID = ao::UID;
        $q = sql::slctFrom($fields, ao::USERS);
        //echo $q;
        if($q != ''){
            //echo $q . PHP_EOL;
            $res = $AO_DB->query("$q WHERE $UID = $uid");
            //echo json_encode($res);
            
            if($res){
                return $res;
            }
            else{
                $AO_DB->eErr();
            }
        }
        return null;
    }
    public static function updateEntry($values){
        //updates the user's entry in database 'AO_DB' in table 'users'
        //$values is a comma seperated list of assignment expressions
        global $AO_DB;
        
        if(is_string($values) ){
            $U = 'users';
            $UID = ao::UID;
            $uid = strval(getUID() );
            //$v = mysqli_real_escape_string($AO_DB->con, $values);
            $q = sql::update($U, $values) . " WHERE $UID = $uid";
            //echo $q;
            return $AO_DB->query($q);
            //$ret = $AO_DB->query($q);
            //if($ret){
                //return $ret;
            //}
            //$AO_DB->eErr();
        }
        return null;
    }
    public static function slctFromCar($fields){
        global $aoUsersDB;
        
        //$aoUsersDB->query()
        return null;
    }
    public static function getFunds(){
        $M = user::M;
        $res = user::slctFromEntry($M);
        
        if($res){
            $f = round(floatval($res->fetch_assoc()[$M]), 2);
            $res->close();
            return $f;    //json_encode($f);
        }
        return 0.0;
    }
    static public function incFunds($funds){
        //increment funds to loggedin user's account
        //$funds:float, value to increment user's current funds
        if(is_float($funds) && $funds > 0.0){
            $f = round($funds, 2);  //round currency to 2 decimal places
            $M = user::M;            
            $uf = user::slctFromEntry($m);  //previous user funds

            $MF = PHP_INT_MAX;
            $nf = $uf + $f;   //new funds
            //echo $nf;
            if($nf < $MF){
                //echo $nf;
                $res = user::updateEntry("$M = $nf");
                //echo json_encode($res);
                if($res){
                    $res->close();
                    echo json_encode($nf);
                    return;
                }
            }
            echo 'Operation failed, could not purchase more funds, cap reached!';
            echo json_encode($uf);
        }
        //echo "purchase::funds(), invalid value $f, purchase::failed";
        return user::getFunds();
    }
    static public function decFunds($funds){
        //decrement funds to loggedin user's account
        //$funds:float, value to decrement user's current funds
        if(is_float($funds) && $funds > 0.0){
            $f = round($funds, 2);  //round currency to 2 decimal places
            $M = user::M;            
            $uf = user::getFunds();  //previous user funds

            //$MF = PHP_INT_MAX;
            $nf = $uf - $f;   //new funds
            //echo $nf;
            if($nf >= 0){
                //echo $nf;
                $res = user::updateEntry("$M = $nf");
                //echo json_encode($res);
                if($res){
                    return $nf;
                }
            }
            //echo 'Operation failed, not enough funds!';
            //$rm->close();
            return $uf;
        }
        //echo "purchase::funds(), invalid value $f, purchase::failed";
        return user::getFunds();
    }
   
    public static function getStats(){
        global $AO_DB;
        $CID = ao::CID;
        $M = user::M;
        $T = user::T;
        $P = user::P;
        $MM = user::MM;
        $ret = user::slctFromEntry("$M, $T, $P, $MM, $CID");
        //echo json_encode($ret);
        if($ret){
            $a = $ret->fetch_assoc();
            $f = round(floatval($a[$M]), 2);
            $t = intval($a[$T]);
            $p = intval($a[$P]);
            $mm = intval($a[$MM]);
            $cid = intval($a[$CID]);
            
            return array(
                $M=>$f,
                $T=>$t,
                $P=>$p,
                $MM=>$mm,
                $CID=>$cid
            );
        }
        else{
            $AO_DB->eErr();
        }
        return null;
    }
    public static function getTokens(){
        $T = user::T;
        $ret = user::slctFromEntry($T);
        
        if($ret){
            $t = intval($res->fetch_assoc()[$T]);
            return $t;
        }
        return 0;
    }
    public static function getMarkers(){
        $MM = user::MM;
        $ret = user::slctFromEntry($MM);
        
        if($ret){
            $mm = intval($res->fetch_assoc()[$MM]);
            return $mm;
        }
        return 0;
    }
    public static function setFunds($val){
        $M = user::M;
        //$uf = user::getFunds();
        //$nf = $uf + $val;
        
        //if($nf < $MF && $nf >= 0){
            
            //return json_encode($ret);
        //}
        //return json_encode($uf);
    }
    public static function getCurCarID(){
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
    public static function getCurCar(){
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
    public static function setCurrentCar($carID = 0){
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
    }
    public static function getCarByID($id){
        //returns a user's upgraded vehicle
        global $aoUsersDB;
        
        if(intval($id) && $id > 0){
            $CID = ao::CID;
            //$DT = 'drivetrain';
            //$B = 'body';
            //$I = 'interior';
            //$D = 'docs';
            //$R = 'repairs';
            
            $res = $aoUsersDB->query(
                sql::slctAllFromUserTable() . " WHERE $CID = $id"
            );
            
            if($res){
                $r = $res->fetch_assoc();
                
                return carDataFromArray($r);
                    // array(
                    // $CID=>intval($r[$CID]),
                    // $DT=>intval($r[$DT]),
                    // $B=>intval($r[$B]),
                    // $I=>intval($r[$I]),
                    // $D=>intval($r[$D]),
                    // $R=>intval($r[$R])
                // );
            }
            else{
                $aoUsersDB->eErr();
            }
        }
        return null;
    }
        public static function getSales(){
        //returns the user's total active and expired actions
        global $aoCarSalesDB;
        
        $sales = array();

        $res = $aoCarSalesDB->query(
            sql::slctAllFromUserTable()
        );
        
        if($res){
            $CID = ao::CID;
            $T = '_time';
            $S = '_start';
            $E = '_end';
            $P = 'price';
            
            while($a = $res->fetch_assoc() ){
                //mysqli retuns values as strings, so convert them
                //to proper types, for faster transfer back to server!
                $sales[] = array(
                    'id'=>intval($a[$CID]),
                    'bid'=>floatval($a[$P]),
                    $T=>floatval($a[$T]),
                    $S=>$a[$S],
                    $E=>$a[$E]
                );
            }
            $res->close();
        }
        //else{user has no entries in table, count is 0;}
        return $sales;
    }
    public static function getSalesCount(){
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
    public static function getCarSaleByID($id){
        //returns a user's upgraded vehicle
        global $aoCarSalesDB;
        
        $i = is_int($id) ? $id : intval($id);
        
        if($i > 0){
            $CID = ao::CID;
            $DT = 'drivetrain';
            $B = 'body';
            $I = 'interior';
            $D = 'docs';
            $R = 'repairs';
            
            $res = $aoCarSalesDB->query(
                sql::slctAllFromUserTable() . " WHERE $CID = $i"
            );
            
            if($res){
                $r = $res->fetch_assoc();
                
                return carDataFromArray($r);    //array(
                    //$CID=>intval($r[$CID]),
                    //$DT=>intval($r[$DT]),
                    //$B=>intval($r[$B]),
                    //$I=>intval($r[$I]),
                    //$D=>intval($r[$D]),
                    //$R=>intval($r[$R])
                //);
            }
            else{
                $aoCarSalesDB->eErr();
            }
        }
        return null;
    }
    public static function getCarCount(){
        //returns the number of entries in user's database(garage)
        global $aoUsersDB;
        $uid = getUserTableName();
        $CID = ao::CID;
        //$count is initialized when this is called for the first time
        $count = 0;
        //this should only execute once
        $res = $aoUsersDB->query(
            "SELECT $CID FROM $uid"
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
    public static function getTotalCarCount(){
        return user::getCarCount() + user::getSalesCount();
    }
    public static function getGameCompletion(){
        //percentage of cars bought and sold by the user
        $acCount = pasGet::auctionCarsCount();
        
        return $acCount != 0 ? user::getTotalCarCount() / $acCount : 0.0;
    }	
    public static function removeCarByID($id){
        //
        global $aoUsersDB;
        
        $i = is_int($id) ? $id : intval($id);
        //echo $id;
        if($i > 0){
            //echo $id;
            $CID = ao::CID;
            $car = user::getCarByID($i);
            //if($car !== null){
            $ut = getUserTableName();
            $cid = $car[$CID];
            
            $res = $aoUsersDB->query(
                "DELETE FROM $ut WHERE $CID = $cid"
            );
            
            if($res){
                return true;
            }
        }
        return false;
    }
	public static function removeCarSaleByID($id){
        //
        global $aoCarSalesDB;
		//return $id;
        $i = is_int($id) ? $id : intval($id);
        
        if($i > 0){
            //echo $i;
            $CID = ao::CID;
            $car = user::getCarSaleByID($i);
            //if($car !== null){
            $ut = getUserTableName();
            $cid = $car[$CID];
            
            $res = $aoCarSalesDB->query(
                "DELETE FROM $ut WHERE $CID = $cid"
            );
            
            if($res){
                return true;
            }
        }
        return false;
    }
    public static function postCarSale($carID){
        //
        global $aoCarSalesDB;
        //echo "var argument carID ($carID)";
        $ut = getUserTableName();
        $car = user::getCarByID($carID);
        $CID = ao::CID;
		$P = 'price';
        $DT = 'drivetrain';
        $B = 'body';
        $I = 'interior';
        $D = 'docs';
        $R = 'repairs';
        $T = '_time';
        $S = '_start';
        $E = '_end';
		$p = 0.0;
		$t = 0.0;
        //return 0;
		//returns current user card id in an array       
		$res = user::slctFromEntry("$CID");
		
		if($res){
			//
			$a = $res->fetch_assoc();
			$cid = intval($a[$CID]);
			//echo json_encode($a);
			//echo "var argument cid ($cid)";
			
			if(user::removeCarByID($carID) ){
				//return true;
				$dt = $car[$DT];
				$b = $car[$B];
				$i = $car[$I];
				$d = $car[$D];
				$r = $car[$R];

				if($cid == $carID){
					//pasUpdate::userCurrentCar();
					//user::getCarByID($CID);
				//	return $cid;
					//echo "user car";
				}

				//else vehicles are different, no change
				$temp = $aoCarSalesDB->query(
					"INSERT INTO $ut
						($CID, $P, $DT, $B, $I, $D, $R, $T, $S, $E)
					VALUES
						($carID, $p, $dt, $b, $i, $d, $r, $t, NOW(), NULL)"
				);
				
				//echo json_encode($temp);
				
				if($temp){
					return array(
						$CID=>$carID,
						$DT=>$dt,
						$B=>$b,
						$I=>$i,
						$D=>$d,
						$R=>$r
					);
				}
				else{
					$aoCarSalesDB->eErr();
				}
			}
            //else{
                
            //}
        }
        return null;
    }
    public static function cancelCarSale($carID){
        //
        global $aoUsersDB;
        
        $ut = getUserTableName();
        $car = user::getCarSaleByID($carID);
        $CID = ao::CID;
        $DT = 'drivetrain';
        $B = 'body';
        $I = 'interior';
        $D = 'docs';
        $R = 'repairs';
		$s = 0; //$sale[$S];    //start
        $e = 0; //$sale[$E];    //end
        //$delta = $e - $s;
        //$AT = //auction max time
        
        //if($delta < $AT){
			//return true;
			//return $carID;
            if(user::removeCarSaleByID($carID) ){
				//return true;
                $cid = $car[$CID];
                $dt = $car[$DT];
                $b = $car[$B];
                $i = $car[$I];
                $d = $car[$D];
                $r = $car[$R];
                //$s = $car[$S];  //start
                //$e = $car[$E];  //end
                
                //echo $cid;
                
                //else vehicles are different, no change
                $temp = $aoUsersDB->query(
                    "INSERT INTO $ut
                        ($CID, $DT, $B, $I, $D, $R)
                    VALUES
                        ($carID, $dt, $b, $i, $d, $r)"
                );
                
                //echo json_encode($temp);
                if($temp){
					//return true;
                    return array(
                        $CID => $carID
                        //$DT,
                        //$B,
                        //$I,
                        //$D,
                        //$R
                    );
                }
                else{
                    $aoUsersDB->eErr();
                }
            }
        //}
        return null;
    }
}