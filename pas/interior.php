<?php
//
//drivetrain.phph
//Created by Tyler R. Drury, 01-08-2015
//(C) 8.5:1 Entertainment, All Rights Reserved
//
require_once 'part.php';

class aoInterior
{
	//ints match those in the interior.js TYPE enum
    const
        KEY = 'interior',
	    SEATS = 1,
	    CARPET = 2,
	    DASH = 3,
	    PANELS = 4;
    
        
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
    public static function getRepairBits($cid){
        //returns the 4 bits representing the Interior's
        //repair state from mySql for a specific vehicle
        global $aoUsersDB;
		
        $R = 'repair';
        $CID = ao::CID;
        
        $res = $aoUsersDB->query(
            sql::slctFromUserTable($R) . " WHERE $CID = $cid"
        );
        
        if($res){
            $rStr = $res->fetch_assoc()[$R];
            //double check the type is correct and someone didn't hack into database
            //to change values to an inappropriate type
            $bits = isUINT($rStr) ? intval($rStr) : 0;
            $ret = ($bits & 0x00F0) >> 4;
            //echo $ret;
            return $ret;
        }        
        return 0;
    }
    protected static function upgrade($bitOffset){
         //echo 'UP';
        $FN = __DIR__ . ', ' . __METHOD__;
        $p = getPriceFromPost();    //price of part to upgrade
        $cid = getCIDFromPost();    //car id to upgrade
        
        if($cid == 0){
            exit("$FN, invalid car ID:$cid");
        }
        if($p < 1.0){
            exit("$FN, invalid part price:$p");
        }        
        if(!is_int($bitOffset) || ($bitOffset > 12 || $bitOffset < 0) ){
            exit("$FN, passing invalid value $bitOffset, must in range [0,12]");
        }
        
        $b = aoInterior::getInterior($cid);
        //mask and shift to occupy 4 left most bits(bits 1-8)
        $mask = 0x000F << $bitOffset;
        $bits = ($b & $mask) >> $bitOffset;  
        
        if($bits < aoStage::PRO){
            //check if part is already fully upgraded
            //then see if user have enough funds for purchase
            $uf = user::getFunds(); //user funds
            $nf = user::decFunds($p);
            $dif = $uf - $nf;
                
            if($dif > 0.000008){
                $nv = ($bits == 0 ? 1 : $bits << 1);   //new part value
                //echo $nv;
                $shift = $nv << $bitOffset;    //shift back
                //echo $shift;
                $im = !$mask;   //bitwise inverse
                //echo $im;
                $nb = ($b & $im) | $shift;   //clear bits, setting new value
                //echo $nb;
                if(aoInterior::setInterior($cid, $nb) ){                    
                    return array(
                        'userFunds'=>$nf,
                        ao::CID=>$cid,
                        aoInterior::KEY=>$nb,
                        'value'=>$nv
                    );
                }
            }
            //echo 'could not purchase upgrade, insufficient funds';
            return null;
        }
        //echo 'could not upgrade part, already fully upgraded';
        return null;
    }
    //protected static function repair($bits){
        //
    //}
    // public static function upgradeSeats(){	
		// return aoInterior::upgrade(12);
    // }    
    // public static function upgradeCarpet(){	
		// return aoInterior::upgrade(8);
    // }    
    // public static function upgradeDash(){	
		// return aoInterior::upgrade(4);
    // }    
    // public static function upgradePanels(){	
		// return aoInterior::upgrade(0);
    // }    
}
class aoSeats extends aoInterior{
    public static function upgrade(){
        return parent::upgrade(12);
    }
    public static function repair(){
        $bits = parent::getRepairBits();
        //echo $bits;
        return;
    }
}
class aoCarpet extends aoInterior{
    public static function upgrade(){
        return parent::upgrade(8);
    }
    public static function repair(){
        $bits = parent::getRepairBits();
        //echo $bits;
        return;
    }
}
class aoDash extends aoInterior{
    public static function upgrade(){
        return parent::upgrade(4);
    }
    public static function repair(){
        $bits = parent::getRepairBits();
        //echo $bits;
        return;
    }
}
class aoPanels extends aoInterior{
    public static function upgrade(){
        return parent::upgrade(0);
    }
    public static function repair(){
        $bits = parent::getRepairBits();
        //echo $bits;
        return;
    }
}
//eSG(); //echo superGlobals
//aoInterior::upgradePart(333333, 0);//seats upgrade
$pt = getPartTypeFromPost();

if(isSetP() ){    
    //echo $pt;
        
    if($pt !== null){
        $ret = null;
        
        if($pt == aoInterior::SEATS){
		    $ret = aoSeats::upgrade();
	    }
	    elseif($pt == aoInterior::CARPET){
		    $ret = aoCarpet::upgrade();
	    }
	    elseif($pt == aoInterior::DASH){
            $ret = aoDash::upgrade();
	    }
	    elseif($pt == aoInterior::PANELS){
            $ret = aoPanels::upgrade();
	    }
	    else{
		    //console.log('attempting to upgrade unknown type: ' + partType.toString() );
		    echo 'attempting to upgrade unknown type: ';
	    }
        echo json_encode($ret);
        exit();
    }
    echo "invalid value(s), (partType:$pt) could not complete purchase"; 
}
?>
