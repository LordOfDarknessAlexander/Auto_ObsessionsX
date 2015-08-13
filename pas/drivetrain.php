<?php
//
//drivetrain.phph
//Created by Tyler R. Drury, 01-08-2015
//(C) 8.5:1 Entertainment, All Rights Reserved
//
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
		
        $DT = aoDrivetrain::KEY;
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
    protected static function setDrivetrain($cid, $dt){
        global $aoUsersDB;
        
        $TN = getUserTableName();
        $DT = aoDrivetrain::KEY;
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
    protected static function upgrade($bitOffset){
        //echo 'UP';
        $FN = __DIR__ . ', ' . __METHOD__;
        $p = getPriceFromPost();    //price of part to upgrade
        $cid = getCIDFromPost();    //car id to upgrade
        
        if($cid == 0){
            exit("$FN, invalid car ID:$cid");
        }
        
        if(!is_int($bitOffset) && ($bitOffset > 12 || $bitOffset < 0) ){
            exit("$FN, passing invalid value $bitOffset, must in range [0,12]");
        }
        
        $dt = aoDrivetrain::getDrivetrain($cid);
        //mask and shift to occupy 4 left most bits(bits 1-8)
        $mask = 0x000F << $bitOffset;
        $bits = ($dt & $mask) >> $bitOffset;  
        
        if($bits < aoStage::PRO){
            //check if part is already fully upgraded
            //then see if user have enough funds for purchase
            $uf = user::getFunds(); //user funds
            $nf = user::decFunds($p);
            $dif = $uf - $nf;
                
            if($dif > 0.000008){
                //if purchase is successful, $dif > 1
                //
                //mask and shift values here
                $nv = ($bits == 0 ? 1 : $bits << 1);   //new part value
                $shift = $nv << $bitOffset;    //shift back
                $im = !$mask;   //bitwise inverse
                //echo $im;
                //echo $nc;
                $nb = ($dt & $im) | $shift;   //clear bits, setting new value
                //echo $nb;
                //set new values
                if(aoDrivetrain::setDrivetrain($cid, $nb) ){                    
                    return array(
                        'userFunds'=>$nf,
                        ao::CID=>$cid,
                        aoDrivetrain::KEY=>$nb,
                        'value'=>$nv
                    );
                }
            }
            //else, new funds and user's funds are the same,
            //purchase not successful
            //echo 'could not purchase upgrade, insufficient funds';
            return null;
        }
        //echo 'could not upgrade part, already fully upgraded';
        return null;
    }
    public static function upgradeEngine(){	
		//$price = isFloat($_POST[''])? intVal($_POST['']) : 0;
		//echo 'UP';
        //$offset = 12;   //number of bits
        return aoDrivetrain::upgrade(12);
    }    
    public static function upgradeTransmission(){	
		return aoDrivetrain::upgrade(8);
    }    
    public static function upgradeAxel(){	
		return aoDrivetrain::upgrade(4);
    }    
    public static function upgradeExhaust(){	
		return aoDrivetrain::upgrade(0);
    }    
}
//
$pt = getPartTypeFromPost();

if(isSetP() ){
    //
    if($pt !== null){
        $ret = null;
        
        if($pt == aoDrivetrain::ENGINE){
		    $ret = aoDrivetrain::upgradeEngine();
	    }
	    elseif($pt == aoDrivetrain::TRANSMISSION){
		    $ret = aoDrivetrain::upgradeTransmission();
	    }
	    elseif($pt == aoDrivetrain::AXEL){
            $ret = aoDrivetrain::upgradeAxel();
	    }
	    elseif($pt == aoDrivetrain::EXHAUST){
            $ret = aoDrivetrain::upgradeExhaust();
	    }
	    else{
		    //console.log('attempting to upgrade unknown type: ' + partType.toString() );
		    echo 'attempting to upgrade unknown type: ' . json_encode($pt);
            exit();
	    }	
        echo json_encode($ret);
        exit();
    }
    echo "invalid value(s), (partType:$pt) could not complete purchase"; 
}
?>
