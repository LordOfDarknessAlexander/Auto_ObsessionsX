<?php
require_once 'part.php';

class aoDrivetrain
{
	//ints match those in the drivetrain.js TYPE enum
    const
	    ENGINE = 0,
	    TRASMISSION = 1,
	    AXEL = 2,
	    EXHAUST = 3;
    
        
    public static function getDrivetrain($cid){
        global $aoUsersDB;
		
        $DT = 'drivetrain';
        $CID = ao::CID;
        
        $res = $aoUsersDB->query(
            sql::slctAllFromUserTable() . " WHERE $CID = $cid"
        );
        
        if($res){
            $ret = intval($res->fetch_assoc()[$DT]);
            //echo $ret;
            return $ret;
        }
    }
    
    public static function setDrivetrain($cid, $dt){
        global $aoUsersDB;
        
        $TN = getUserTableName();
        $DT = 'drivetrain';
        $CID = ao::CID;
        
        $res = $aoUsersDB->query(
            "UPDATE $TN SET $DT = $dt WHERE $CID = $cid"
        );
        
        if($res){
            //echo json_encode($res);
            return $res;
        }
        return null;
    }
    
    public static function upgradeEngine($cid, $price){	
		//$price = isFloat($_POST[''])? intVal($_POST['']) : 0;
        global $aoUsersDB;
		//echo 'UP';
        $offset = 12;   //number of bits
        
        $dt = aoDrivetrain::getDrivetrain($cid);
        $engine = ($dt & 0xF000) >> $offset;  
        
        if($engine < aoStage::PRO){
            //check if part is already fully upgraded
            //then see if user have enough funds for purchase
            $uf = user::getFunds(); //user funds
            $nf = user::decFunds($price);
            $dif = $uf - $nf;
                
            if($dif > 0.000008){
                //if purchase is successful, $dif > 1
                //$tableName = getUserTableName();
                //
                //mask and shift values here
                $nc = ($dt == 0 ? 1 : $engine << 1);   //new part value
                $shift = $nc << $offset;
                //echo $nc;
                $nb = ($dt & 0x0FFF) | $shift;   //clear last bits, setting new value
                //echo $nb;
                //set new values
                
                //$res = $aoUsersDB->query(
                    //"UPDATE $tableName SET
                        //$dt=$nb
                    //WHERE
                        //$CID = $carID"
                //);
                //
                if(aoDrivetrain::setDrivetrain($cid, $nb) ){
                    $ret = array(
                        'userFunds'=>$nf,
                        'cid'=>$cid,
                        $dt=>$nb
                    );
        
                    echo json_encode($ret);
                    exit();
                }
            }
            //else, new funds and user's funds are the same,
            //purchase not successful
            echo 'could not purchase upgrade, insufficient funds';
            exit();
        }
        echo 'could not upgrade part, already fully upgraded';
        exit();
    }
    
}
//eSG(); //echo superGlobals
//aoDrivetrain::upgradePart(333333, 0);//engine upgrade
if(isSetP() ){
    global $aoUsersDB;
	$P = 'price';
    $DT = 'drivetrain';
	
    $engine = aoDrivetrain::ENGINE;
	$transmission = aoDrivetrain::TRASMISSION;
	$axel = aoDrivetrain::AXEL;
	$exhaust = aoDrivetrain::EXHAUST;
	
	//echo 'butternuts';
	$pt = isUINT($_POST['partType']) ? intval($_POST['partType']) : null; 
	$cid = isUINT($_POST['cid']) ? intval($_POST['cid']) : 0;
	$price = isFloat($_POST[$P]) ? floatval($_POST[$P]) : 0;
	//$carPrice = isFloat($_POST['price']) ? floatval($_POST['price']) : 0;
	
        
    if($cid > 0){
        if($pt == aoDrivetrain::ENGINE){
		//return this.upgrade(eng);
		//echo 'engine';
		
		$res = aoDrivetrain::upgradeEngine($cid, $price);
        //aoDrivetrain::upgradeEngine($cid);
		echo json_encode($res); 
		exit();
	}
	elseif($pt == aoDrivetrain::TRASMISSION){
		//return this.upgrade(tra);
		//echo 'transmission';
		//$res = aoDrivetrain::upgradeEngine($cid);
		echo json_encode($res);    
		exit();
	}
	elseif($pt == aoDrivetrain::AXEL){
		//return this.upgrade(axe);
		//echo 'axel';
	}
	elseif($pt == aoDrivetrain::EXHAUST){
		//return this.upgrade(exh);
		//echo 'exhaust';
	}
	else{
		//console.log('attempting to upgrade unknown type: ' + partType.toString() );
		echo 'attempting to upgrade unknown type: ';
	}
    
        /*$CID = ao::CID;
        $res = $aoUsersDB->query(
            sql::slctAllFromUserTable() . " WHERE $CID = $cid"
        );
            
        if($res){
            $r = $res->fetch_assoc();
            $CID=intval($r[$CID]);
            $dt = intval($r[$DT]);
			//$price = intval($r[$STAGE]);
        }           
        else{
            $aoUsersDB->eErr();
        }*/
		
    }

	/*if($pt == aoDrivetrain::ENGINE){
		//return this.upgrade(eng);
		//echo 'engine';
		
		$res = aoDrivetrain::upgradeEngine($cid);
        //aoDrivetrain::upgradeEngine($cid);
		echo json_encode($res); 
		exit();
	}
	elseif($pt == aoDrivetrain::TRASMISSION){
		//return this.upgrade(tra);
		//echo 'transmission';
		//$res = aoDrivetrain::upgradeEngine($cid);
		echo json_encode($res);    
		exit();
	}
	elseif($pt == aoDrivetrain::AXEL){
		//return this.upgrade(axe);
		//echo 'axel';
	}
	elseif($pt == aoDrivetrain::EXHAUST){
		//return this.upgrade(exh);
		//echo 'exhaust';
	}
	else{
		//console.log('attempting to upgrade unknown type: ' + partType.toString() );
		echo 'attempting to upgrade unknown type: ';
	}*/

}
?>
