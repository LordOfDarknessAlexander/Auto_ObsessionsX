<?php
require_once 'part.php';

class aoInterior
{
	//ints match those in the interior.js TYPE enum
    const
        KEY = 'interior',
	    SEATS = 0,
	    CARPET = 1,
	    DASH = 2,
	    PANELS = 3;
    
        
    public static function getInterior($cid){
        global $aoUsersDB;
		
        $IN = 'interior';
        $CID = ao::CID;
        
        $res = $aoUsersDB->query(
            sql::slctAllFromUserTable() . " WHERE $CID = $cid"
        );
        
        if($res){
            $ret = intval($res->fetch_assoc()[$IN]);
            //echo $ret;
            return $ret;
        }
        
        return 0;
    }
    
    public static function setInterior($cid, $in){
        global $aoUsersDB;
        
        $TN = getUserTableName();
        $IN = aoInterior::KEY;
        $CID = ao::CID;
        
        $res = $aoUsersDB->query(
            "UPDATE $TN SET $IN = $in WHERE $CID = $cid"
        );
        
        if($res){
            //echo json_encode($res);
            return $res;
        }
        return null;
    }
    
    public static function upgradeSeats($cid, $price){	
		//$price = isFloat($_POST[''])? intVal($_POST['']) : 0;
        global $aoUsersDB;
		//echo 'UP';
        $offset = 12;   //number of bits
        
        $in = aoInterior::getInterior($cid);
        $seats = ($in & 0xF000) >> $offset;  
        
        if($seats < aoStage::PRO){
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
                $nc = ($seats == 0 ? 1 : $seats << 1);   //new part value
                $shift = $nc << $offset;
                //echo $nc;
                $nb = ($in & 0x0FFF) | $shift;   //clear last bits, setting new value
                //echo $nb;
                //set new values
                
                //$res = $aoUsersDB->query(
                    //"UPDATE $tableName SET
                        //$in=$nb
                    //WHERE
                        //$CID = $carID"
                //);
                //
                if(aoInterior::setInterior($cid, $nb) ){
                    $IN = aoInterior::KEY;
                    $V = 'value';
                    
                    $ret = array(
                        'userFunds'=>$nf,
                        'cid'=>$cid,
                        $IN=>$nb,
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
    
    public static function upgradeCarpet($cid, $price){	
		//$price = isFloat($_POST[''])? intVal($_POST['']) : 0;
        global $aoUsersDB;
		//echo 'UP';
        $offset = 8;   //number of bits
        
        $in = aoInterior::getInterior($cid);
        $carpet = ($in & 0x0F00) >> $offset;  
        
        if($carpet < aoStage::PRO){
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
                $nc = ($carpet == 0 ? 1 : $carpet << 1);   //new part value
                $shift = $nc << $offset;
                //echo $nc;
                $nb = ($in & 0xF0FF) | $shift;   //clear last bits, setting new value
                //echo $nb;
                //set new values
                
                //$res = $aoUsersDB->query(
                    //"UPDATE $tableName SET
                        //$in=$nb
                    //WHERE
                        //$CID = $carID"
                //);
                //
                if(aoInterior::setInterior($cid, $nb) ){
                    $IN = aoInterior::KEY;
                    $V = 'value';
                    
                   return array(
                        'userFunds'=>$nf,
                        'cid'=>$cid,
                        $IN=>$nb,
                        $V=>$nc
                    );
        
                    //echo json_encode($ret);
                    //exit();
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
    
    public static function upgradeDash($cid, $price){	
		//$price = isFloat($_POST[''])? intVal($_POST['']) : 0;
        global $aoUsersDB;
		//echo 'UP';
        $offset = 4;   //number of bits
        
        $in = aoInterior::getInterior($cid);
        $dash = ($in & 0x00F0) >> $offset;  
        
        if($dash < aoStage::PRO){
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
                $nc = ($dash == 0 ? 1 : $dash << 1);   //new part value
                $shift = $nc << $offset;
                //echo $nc;
                $nb = ($in & 0xFF0F) | $shift;   //clear last bits, setting new value
                //echo $nb;
                //set new values
                
                //$res = $aoUsersDB->query(
                    //"UPDATE $tableName SET
                        //$in=$nb
                    //WHERE
                        //$CID = $carID"
                //);
                //
                if(aoInterior::setInterior($cid, $nb) ){
                    $IN = aoInterior::KEY;
                    $V = 'value';
                    
                    return array(
                        'userFunds'=>$nf,
                        'cid'=>$cid,
                        $IN=>$nb,
                        $V=>$nc
                    );
        
                    //echo json_encode($ret);
                    //exit();
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
    
    public static function upgradePanels($cid, $price){	
		//$price = isFloat($_POST[''])? intVal($_POST['']) : 0;
        global $aoUsersDB;
		//echo 'UP';
        $offset = 0;   //number of bits
        
        $in = aoInterior::getInterior($cid);
        $panels = ($in & 0x000F) >> $offset;  
        
        if($panels < aoStage::PRO){
            //check if part is already fully upgraded
            //then see if user have enough funds for purchase
            $uf = user::getFunds(); //user funds
            $nf = user::decFunds($price);
            $dif = $uf - $nf;
                
            if($dif > 0.000008){
                //if purchase is successful, $dif > 1
                //
                //mask and shift values here
                $nc = ($panels == 0 ? 1 : $panels << 1);   //new part value
                $shift = $nc << $offset;
                //echo $nc;
                $nb = ($in & 0xFFF0) | $shift;   //clear last bits, setting new value
                //echo $nb;
                //set new values           
                //
                if(aoInterior::setInterior($cid, $nb) ){
                    $IN = aoInterior::KEY;
                    $V = 'value';
                    
                    return array(
                        'userFunds'=>$nf,
                        'cid'=>$cid,
                        $IN=>$nb,
                        $V=>$nc
                    );
        
                    //echo json_encode($ret);
                    //exit();
                }
            }
            //else, new funds and user's funds are the same,
            //purchase not successful
            //echo 'could not purchase upgrade, insufficient funds';
        }
        //echo 'could not upgrade part, already fully upgraded';
        return null;
    }
    
}
//eSG(); //echo superGlobals
//aoInterior::upgradePart(333333, 0);//seats upgrade
if(isSetP() ){
	$P = 'price';
    $CID = ao::CID;
    $PT = 'partType';
    
    $p = getPriceFromPost();
    $cid = getCIDFromPost();
	$pt = isUINT($_POST[$PT]) ? intval($_POST[$PT]) : null;
    //echo $pt;
        
    if( ($cid != 0) && ($p > 1.0) && ($pt !== null) ){
        $ret = null;
        
        if($pt == aoInterior::SEATS){
		    $ret = aoInterior::upgradeSeats($cid, $p);
	    }
	    elseif($pt == aoInterior::CARPET){
		    $ret = aoInterior::upgradeCarpet($cid, $p);
	    }
	    elseif($pt == aoInterior::DASH){
            $ret = aoInterior::upgradeDash($cid, $p);
	    }
	    elseif($pt == aoInterior::PANELS){
            $ret = aoInterior::upgradePanels($cid, $p);
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
