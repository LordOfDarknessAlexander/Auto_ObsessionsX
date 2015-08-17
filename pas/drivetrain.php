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
    public static function getRepairBits($cid){
        //returns the 4 bits representing the Drivetrain's
        //repair state from mySql for a specific vehicle
        $r = getRepairs($cid);
        $ret = ($r & 0xF000) >> 12;
        //echo $ret;
        return 0;   //$ret;
    }
    protected static function setRepairBits($bits){
        global $aoUsersDB;
        
        if(!is_inv($bits) || $bits > 4 || $bits < 0){
            exit("invalid value for bits:$bits, must be between 0x0 and 0x4");
        }
        else{
            $TN = getUserTableName();
            $IN = aoDrivetrain::KEY;
            $CID = ao::CID;
            
            //$r = 0;
            //$rm = ($r & 0x0FFF);
            //$shift = ($bits << 12);
            //echo $shift;
            //$v = $shift | $rm;
            //echo $v;
            
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
}
class aoEngine extends aoDrivetrain{
    public static function upgrade(){
        return parent::upgrade(12);
    }
    public static function repair(){
        $FN = __DIR__ . ', ' . __METHOD__;
        $p = getPriceFromPost();    //price of part to upgrade
        $cid = getCIDFromPost();    //car id to upgrade
        $EPS = 0.01;   //purchase epsilon, to determine change in
        
        if($cid == 0){
            exit("$FN, invalid car ID:$cid, could not complete purchase");
        }
        
        $bits = parent::getRepairBits($cid);
        //echo $bits;
        $m = 0xF000;
        $b = ($bits & $m) >> 12; //masked bits
        //return $bits;
        if(!($b & 0x8) ){
            //part not repaired
            $uf = user::getFunds(); //user funds
            //$nf = user::decFunds($p);
            $dif = 0;// $uf - $nf;
            //return $b;
            if($dif > 0.008){
                $nv = true; //$b | 0x8;
                $nb = 0;  //$nv << 12;
                $nr = ($bits & 0x0FFF) | $nb;   //new repair bits
                //parent::setRepairBits($cid, $nr);
                
                return array(
                    //'userFunds'=>$nf,
                    ao::CID=>$cid,
                    'repair'=>$nb,
                    'value'=>$nv
                );
            }
            exit("$FN, could not complete purchase,\n insufficient funds");
        }
        exit("$FN, could not complete purchase,\n part is already repaired");
    }
}
class aoTransmission extends aoDrivetrain{
    public static function upgrade(){
        return parent::upgrade(8);
    }
    public static function repair(){
        $FN = __DIR__ . ', ' . __METHOD__;
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
class aoAxel extends aoDrivetrain{
    public static function upgrade(){
        return parent::upgrade(4);
    }
    public static function repair(){
        $FN = __DIR__ . ', ' . __METHOD__;
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
class aoExhaust extends aoDrivetrain{
    public static function upgrade(){
        return parent::upgrade(0);
    }
    public static function repair(){
        $FN = __DIR__ . ', ' . __METHOD__;
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
//
$pt = getPartTypeFromPost();

if(isSetP() ){
    //
    if($pt !== null){
        $ret = null;
        $op = getOpFromGET();
        
        if($op == 'update'){
            if($pt == aoDrivetrain::ENGINE){
                $ret = aoEngine::upgrade();
            }
            elseif($pt == aoDrivetrain::TRANSMISSION){
                $ret = aoTransmission::upgrade();
            }
            elseif($pt == aoDrivetrain::AXEL){
                $ret = aoAxel::upgrade();
            }
            elseif($pt == aoDrivetrain::EXHAUST){
                $ret = aoExhaust::upgrade();
            }
            else{
                exit('attempting to upgrade unknown type: ' . json_encode($pt) . 'could not complete purchase');
            }
        }
        else if($op == 'repair'){            
            if($pt == aoDrivetrain::ENGINE){
                $ret = aoEngine::repair();
            }
            elseif($pt == aoDrivetrain::TRANSMISSION){
                $ret = aoTransmission::repair();
            }
            elseif($pt == aoDrivetrain::AXEL){
                $ret = aoAxel::repair();
            }
            elseif($pt == aoDrivetrain::EXHAUST){
                $ret = aoExhaust::repair();
            }
            else{
                exit('attempting to repair unknown type: ' . json_encode($pt) . ', could not complete purchase');
            }
        }
        else{
            exit("invalid argument supplied for index (op) in GET, could not preform purchase");
        }
        echo json_encode($ret);
        exit();
    }
    exit("invalid value(s), (partType:$pt) could not complete purchase");
}
?>
