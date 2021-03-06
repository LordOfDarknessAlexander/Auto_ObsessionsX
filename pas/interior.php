<?php
//
//interior.php
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
        $IN = 'interior';
        
        $res = user::slctFromCar($cid, $IN);
        
        if($res){
            $ret = intval($res[$IN]);
            //echo $ret;
            return $ret;
        }
        
        return 0;
    }    
    protected static function setInterior($cid, $in){
        $IN = aoInterior::KEY;
        
        return user::updateCar($cid, "$IN = $in");
    }
    public static function getRepairBits($cid){
        //returns the 4 bits representing the Interior's
        //repair state from mySql for a specific vehicle
        $r = getRepairs($cid);
        //$ret = ($r & 0x000F) >> 0;
        //echo $ret;
        return 0;   //$ret;
    }
    protected static function setRepairBits($bits){
        global $aoUsersDB;
        
        if($bits >= 0 && $bits <= 4){
            $TN = getUserTableName();
            $IN = aoInterior::KEY;
            $CID = ao::CID;
            
            $r = 0;
            $rm = ($r & 0xFF0F);
            $v = ($bits << 4) | $rm;
        
            //$res = $aoUsersDB->query(
                //"UPDATE $TN SET $IN = $in WHERE $CID = $cid"
            //);
            
            //if($res){
                //return $v;
            //}
        }
    }
    protected static function upgrade($bitOffset){
         //echo 'UP';
        $FN = __DIR__ . ', ' . __METHOD__;
        $EPS = 0.01;
        
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
                
            if($dif > $EPS){
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
}
class aoSeats extends aoInterior{
    public static function upgrade(){
        return parent::upgrade(12);
    }
    public static function repair(){
        $FN = __DIR__ . ', ' . __METHOD__;
        $EPS = 0.01;
        
        $p = getPriceFromPost();    //price of part to upgrade
        $cid = getCIDFromPost();    //car id to upgrade
        
        if($cid == 0){
            exit("$FN, invalid car ID:$cid");
        }
        
        $bits = parent::getRepairBits($cid);
        //echo $bits;
        //parent::setRepairBits($bits);
        return;
    }
}
class aoCarpet extends aoInterior{
    public static function upgrade(){
        return parent::upgrade(8);
    }
    public static function repair(){
        $FN = __DIR__ . ', ' . __METHOD__;
        $EPS = 0.01;
        
        $p = getPriceFromPost();    //price of part to upgrade
        $cid = getCIDFromPost();    //car id to upgrade
        
        if($cid == 0){
            exit("$FN, invalid car ID:$cid");
        }
        
        $bits = parent::getRepairBits($cid);
        //echo $bits;
        //parent::setRepairBits($bits);
        return;
    }
}
class aoDash extends aoInterior{
    public static function upgrade(){
        return parent::upgrade(4);
    }
    public static function repair(){
        $FN = __DIR__ . ', ' . __METHOD__;
        $EPS = 0.01;
        
        $p = getPriceFromPost();    //price of part to upgrade
        $cid = getCIDFromPost();    //car id to upgrade
        
        if($cid == 0){
            exit("$FN, invalid car ID:$cid");
        }
        
        $bits = parent::getRepairBits($cid);
        //echo $bits;
        //parent::setRepairBits($bits);
        return;
    }
}
class aoPanels extends aoInterior{
    public static function upgrade(){
        return parent::upgrade(0);
    }
    public static function repair(){
        $FN = __DIR__ . ', ' . __METHOD__;
        $EPS = 0.01;
        
        $p = getPriceFromPost();    //price of part to upgrade
        $cid = getCIDFromPost();    //car id to upgrade
        
        if($cid == 0){
            exit("$FN, invalid car ID:$cid");
        }
        
        $bits = parent::getRepairBits($cid);
        //echo $bits;
        //parent::setRepairBits($bits);
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
        //if(isSetG() ){
        $op = getOpFromGET();
        //echo $op;
        
        if($op == 'update'){
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
        }
        else if($op == 'repair'){
            if($pt == aoInterior::SEATS){
                $ret = aoSeats::repair();
            }
            elseif($pt == aoInterior::CARPET){
                $ret = aoCarpet::repair();
            }
            elseif($pt == aoInterior::DASH){
                $ret = aoDash::repair();
            }
            elseif($pt == aoInterior::PANELS){
                $ret = aoPanels::repair();
            }
        }
        else{
            exit("invalid argument supplied for index (op) in GET, could not preform purchase");
        }
        echo json_encode($ret);
        exit();
    }
    exit("invalid value, (partType:$pt) could not complete purchase");
}
?>
