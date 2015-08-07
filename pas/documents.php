<?php
require_once 'part.php';

class aoDocuments
{
	//ints match those in the interior.js TYPE enum
    const
	    OWNERSHIP = 0,
	    BUILD = 1,
	    HISTORY = 2,
	    RESTORATION = 3;
    
        
    public static function getDocuments($cid){
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
    
    public static function setDocuments($cid, $in){
        global $aoUsersDB;
        
        $TN = getUserTableName();
        $IN = 'interior';
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
    
    public static function upgradeOwnership($cid, $price){	
		//$price = isFloat($_POST[''])? intVal($_POST['']) : 0;
        global $aoUsersDB;
		//echo 'UP';
        $offset = 12;   //number of bits
        
        $in = aoDocuments::getDocuments($cid);
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
                if(aoDocuments::setDocuments($cid, $nb) ){
                    $IN = 'drivetrian';
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
    
    public static function upgradeBuild($cid, $price){	
		//$price = isFloat($_POST[''])? intVal($_POST['']) : 0;
        global $aoUsersDB;
		//echo 'UP';
        $offset = 8;   //number of bits
        
        $in = aoDocuments::getDocuments($cid);
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
                if(aoDocuments::setDocuments($cid, $nb) ){
                    $IN = 'drivetrian';
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
    
    public static function upgradeHistory($cid, $price){	
		//$price = isFloat($_POST[''])? intVal($_POST['']) : 0;
        global $aoUsersDB;
		//echo 'UP';
        $offset = 4;   //number of bits
        
        $in = aoDocuments::getDocuments($cid);
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
                if(aoDocuments::setDocuments($cid, $nb) ){
                    $IN = 'drivetrian';
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
    
    public static function upgradeRestoration($cid, $price){	
		//$price = isFloat($_POST[''])? intVal($_POST['']) : 0;
        global $aoUsersDB;
		//echo 'UP';
        $offset = 0;   //number of bits
        
        $in = aoDocuments::getDocuments($cid);
        $exhaust = ($in & 0x000F) >> $offset;  
        
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
                $nb = ($in & 0xFFF0) | $shift;   //clear last bits, setting new value
                //echo $nb;
                //set new values
                
                //$res = $aoUsersDB->query(
                    //"UPDATE $tableName SET
                        //$in=$nb
                    //WHERE
                        //$CID = $carID"
                //);
                //
                if(aoDocuments::setDocuments($cid, $nb) ){
                    $IN = 'drivetrian';
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
    
}
//eSG(); //echo superGlobals
//aoDocuments::upgradePart(333333, 0);//seats upgrade
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
        
        if($pt == aoDocuments::OWNERSHIP){
		    $ret = aoDocuments::upgradeOwnership($cid, $p);
		    echo json_encode($ret); 
		    exit();
	    }
	    elseif($pt == aoDocuments::BUILD){
		    $ret = aoDocuments::upgradeBuild($cid, $p);
		    echo json_encode($ret);    
		    exit();
	    }
	    elseif($pt == aoDocuments::HISTORY){
            $ret = aoDocuments::upgradeHistory($cid, $p);
            echo json_encode($ret);    
		    exit();
	    }
	    elseif($pt == aoDocuments::RESTORATION){
            $ret = aoDocuments::upgradeRestoration($cid, $p);
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
