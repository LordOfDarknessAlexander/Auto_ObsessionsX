<?php
require_once 'part.php';

class aoDrivetrain
{
	//ints match those in the drivetrain.js TYPE enum
    const
        KEY = 'drivetrain',
	    ENGINE = 0,
	    TRANSMISSION = 1,
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
        
        return 0;
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
                $nc = ($engine == 0 ? 1 : $engine << 1);   //new part value
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
                    $DT = 'drivetrain';
                    $V = 'value';
                    
                    $ret = array(
                        'userFunds'=>$nf,
                        'cid'=>$cid,
                        $DT=>$nb,
                        $V=>$nc
                    );
        
                    echo json_encode($ret);
                    exit();
                }
            }
            //else, new funds and user's funds are the same,
            //purchase not successful
            //echo 'could not purchase upgrade, insufficient funds';
            //exit();
        }
        //echo 'could not upgrade part, already fully upgraded';
        //exit();
        return null;
    }
    
    public static function upgradeTransmission($cid, $price){	
		//$price = isFloat($_POST[''])? intVal($_POST['']) : 0;
        global $aoUsersDB;
		//echo 'UP';
        $offset = 8;   //number of bits
        
        $dt = aoDrivetrain::getDrivetrain($cid);
        $tranny = ($dt & 0x0F00) >> $offset;  
        
        if($tranny < aoStage::PRO){
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
                $nc = ($tranny == 0 ? 1 : $tranny << 1);   //new part value
                $shift = $nc << $offset;
                //echo $nc;
                $nb = ($dt & 0xF0FF) | $shift;   //clear last bits, setting new value
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
                    $DT = 'drivetrain';
                    $V = 'value';
                    
                    $ret = array(
                        'userFunds'=>$nf,
                        'cid'=>$cid,
                        $DT=>$nb,
                        $V=>$nc
                    );
        
                    echo json_encode($ret);
                    exit();
                }
            }
            //else, new funds and user's funds are the same,
            //purchase not successful
            //echo 'could not purchase upgrade, insufficient funds';
            //exit();
        }
        //echo 'could not upgrade part, already fully upgraded';
        //exit();
        return null;
    }
    
    public static function upgradeAxel($cid, $price){	
		//$price = isFloat($_POST[''])? intVal($_POST['']) : 0;
        global $aoUsersDB;
		//echo 'UP';
        $offset = 4;   //number of bits
        
        $dt = aoDrivetrain::getDrivetrain($cid);
        $axel = ($dt & 0x00F0) >> $offset;  
        
        if($axel < aoStage::PRO){
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
                $nc = ($axel == 0 ? 1 : $axel << 1);   //new part value
                $shift = $nc << $offset;
                //echo $nc;
                $nb = ($dt & 0xFF0F) | $shift;   //clear last bits, setting new value
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
                    $DT = 'drivetrain';
                    $V = 'value';
                    
                    $ret = array(
                        'userFunds'=>$nf,
                        'cid'=>$cid,
                        $DT=>$nb,
                        $V=>$nc
                    );
        
                    echo json_encode($ret);
                    exit();
                }
            }
            //else, new funds and user's funds are the same,
            //purchase not successful
            //echo 'could not purchase upgrade, insufficient funds';
            //exit();
        }
        //echo 'could not upgrade part, already fully upgraded';
        //exit();
        return null;
    }
    
    public static function upgradeExhaust($cid, $price){	
		//$price = isFloat($_POST[''])? intVal($_POST['']) : 0;
        global $aoUsersDB;
		//echo 'UP';
        $offset = 0;   //number of bits
        
        $dt = aoDrivetrain::getDrivetrain($cid);
        $exhaust = ($dt & 0x000F) >> $offset;  
        
        if($exhaust < aoStage::PRO){
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
                $nc = ($exhaust == 0 ? 1 : $exhaust << 1);   //new part value
                $shift = $nc << $offset;
                //echo $nc;
                $nb = ($dt & 0xFFF0) | $shift;   //clear last bits, setting new value
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
                    $DT = 'drivetrain';
                    $V = 'value';
                    
                    $ret = array(
                        'userFunds'=>$nf,
                        'cid'=>$cid,
                        $DT=>$nb,
                        $V=>$nc
                    );
        
                    echo json_encode($ret);
                    exit();
                }
            }
            //else, new funds and user's funds are the same,
            //purchase not successful
            //echo 'could not purchase upgrade, insufficient funds';
            //exit();
        }
        //echo 'could not upgrade part, already fully upgraded';
        //exit();
        return null;
    }
    
}
//eSG(); //echo superGlobals
//aoDrivetrain::upgradePart(333333, 0);//engine upgrade
if(isSetP() ){
	$P = 'price';
    $CID = ao::CID;
    $PT = 'partType';
    $p = isFloat($_POST[$P]) ? round(floatval($_POST[$P]), 2) : 0.0;
		
	//echo 'butternuts';
	$pt = isUINT($_POST[$PT]) ? intval($_POST[$PT]) : null; 
	$cid = isUINT($_POST[$CID]) ? intval($_POST[$CID]) : 0;
	
        
    if($cid != 0 && $p > 1.0 && $pt !== null){
        $ret = null;
        
        if($pt == aoDrivetrain::ENGINE){
		    $ret = aoDrivetrain::upgradeEngine($cid, $p);
		    echo json_encode($ret); 
		    exit();
	    }
	    elseif($pt == aoDrivetrain::TRANSMISSION){
		    $ret = aoDrivetrain::upgradeTransmission($cid, $p);
		    echo json_encode($ret);    
		    exit();
	    }
	    elseif($pt == aoDrivetrain::AXEL){
            $ret = aoDrivetrain::upgradeAxel($cid, $p);
            echo json_encode($ret);    
		    exit();
	    }
	    elseif($pt == aoDrivetrain::EXHAUST){
            $ret = aoDrivetrain::upgradeExhaust($cid, $p);
            echo json_encode($ret);    
		    exit();
	    }
	    else{
		    //console.log('attempting to upgrade unknown type: ' + partType.toString() );
		    echo 'attempting to upgrade unknown type: ';
	    }	
        echo json_encode($ret);
        exit();
    }
    echo "invalid value(s), ($CID:$cid, $P:$p, $PT:$pt) could not complete purchase"; 
}
?>
