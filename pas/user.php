<?php
//
require_once '../pasMeta.php';
require_once '../re.php';
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
        MM = 'm_markers';
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
        return $q == '' ? null : $AO_DB->query($q . " WHERE $UID = $uid");
    }
    public static function updateEntry($values){
        //updates the user's entry in database 'AO_DB' in table 'users'
        //$values is a comma seperated list of assignment expressions
        global $AO_DB;
        
        if(is_string($values) ){
            $U = 'users';
            $UID = ao::UID;
            $uid = strval(getUID() );
            $v = mysqli_real_escape_string($AO_DB->con, $values);
            $q = "UPDATE $U SET $v WHERE $UID = $uid";
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
    public static function getFunds(){
        $M = 'money';
        $ret = user::slctFromEntry($M);
        
        if($ret){
            $f = round(floatval($res->fetch_assoc()[$M]), 2);
            return $f;    //json_encode($f);
        }
        return 0.0;
    }
    static public function incFunds($funds){
        //increment funds to loggedin user's account
        //$funds:float, value to increment user's current funds
        if(is_float($funds) && $funds > 0.0){
            $f = round($funds, 2);  //round currency to 2 decimal places
            $M = 'money';            
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
            $rm->close();
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
            $M = 'money';            
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
                    return $nf;
                }
            }
            //echo 'Operation failed, not enough funds!';
            $rm->close();
            return $uf;
        }
        //echo "purchase::funds(), invalid value $f, purchase::failed";
        return user::getFunds();
    }
    public static function getStats(){
        $CID = ao::CID;
        $M = user::M;
        $T = user::T;
        $P = user::P;
        $MM = user::MM;
        $ret = user::slctFromEntry("$M, $T, $P, $MM, $CID");
        
        if($ret){
            $a = $res->fetch_assoc();
            $f = round(floatval($a[$M]), 2);
            $t = intval($a[$T]);
            $p = intval($a[$P]);
            $mm = intval($a[$MM]);
            $cid = intval($a[$CID]);
            
            return array(
                $M=>$m,
                $T=>$t,
                $P=>$p,
                $MM=>$mm,
                $CID=>$cid
            );
        }
        return null;
    }
    public static function getTokens(){
        $T = 'tokens';
        $ret = user::slctFromEntry($T);
        
        if($ret){
            $t = intval($res->fetch_assoc()[$T]);
            return $t;
        }
        return 0;
    }
    public static function setFunds($val){
        $M = 'money';
        //$uf = user::getFunds();
        //$nf = $uf + $val;
        
        //if($nf < $MF && $nf >= 0){
            
            //return json_encode($ret);
        //}
        //return json_encode($uf);
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
		$P = 'price';
		$p = 0.0;
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
					pasUpdate::userCurrentCar();
				}

				//else vehicles are different, no change
				$temp = $aoCarSalesDB->query(
					"INSERT INTO $ut
						($CID, $P, $DT, $B, $I, $D, $R)
					VALUES
						($carID, $p, $dt, $b, $i, $d, $r)"
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