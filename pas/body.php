<?php
//
//body.php
//Created by Tyler R. Drury, 01-08-2015
//(C) 8.5:1 Entertainment, All Rights Reserved
//
require_once 'part.php';
//
class aoBody{
    const
        KEY = 'body',
        CHASSIS = 0x1,
        PANELS = 0x2,
        PAINT = 0x3,
        CHROME = 0x4;    
    
    public static function getBody($cid){        
        $B = aoBody::KEY;
        
       $res = user::slctFromCar($cid, $B);
        
        if($res){
            $ret = intval($res[$B]);
            //echo $ret;
            return $ret;
        }
        //exit();
        return 0;
    }
    public static function setBody($cid, $b){        
        $B = aoBody::KEY;
        return user::updateCar($cid, "$B = $b");
    }
    public static function getRepairBits($cid){
        $r = getRepairs($cid);
        $ret = ($r & 0x0F00) >> 8;
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
            $IN = aoBody::KEY;
            $CID = ao::CID;
            
            $r = 0;
            $rm = ($r & 0xF0FF);
            $shift = ($bits << 8);
            //echo $shift;
            $v = $shift | $rm;
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
        
        $b = aoBody::getBody($cid);
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
                if(aoBody::setBody($cid, $nb) ){                    
                    return array(
                        'userFunds'=>$nf,
                        ao::CID=>$cid,
                        aoBody::KEY=>$nb,
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
class aoChassis extends aoBody{
    public static function upgrade(){
        return parent::upgrade(12);
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
class aoPanels extends aoBody{
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
class aoPaint extends aoBody{
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
class aoChrome extends aoBody{
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
$pt = getPartTypeFromPost();

if(isSetP()){
    //echo $pt;    
    if($pt !== null){
        $op = getOpFromGET();
        $ret = null;
        
        if($op == 'update'){
            if($pt == aoBody::CHASSIS){
                $ret = aoChassis::upgrade();
            }
            else if($pt == aoBody::PANELS){
                $ret = aoPanels::upgrade();
            }
            else if($pt == aoBody::PAINT){
                $ret = aoPaint::upgrade();
            }
            else if($pt == aoBody::CHROME){
                $ret = aoChrome::upgrade();
            }
            else{
                exit('attempting to upgrade unknown type: ' . json_encode($pt) . 'could not complete purchase');
            }
        }
        else if($op == 'repair'){
            if($pt == aoBody::CHASSIS){
                $ret = aoChassis::repair();
            }
            else if($pt == aoBody::PANELS){
                $ret = aoPanels::repair();
            }
            else if($pt == aoBody::PAINT){
                $ret = aoPaint::repair();
            }
            else if($pt == aoBody::CHROME){
                $ret = aoChrome::repair();
            }
            else{
                exit('attempting to repair unknown type: ' . json_encode($pt) . ', could not complete purchase');
            }
        }
        else{
            exit("invalid argument supplied for index (op) in GET, could not preform purchase");
        }
        
        if($ret !== null){
            echo json_encode($ret);
            exit();
        }
        exit("invalid value ret:$ret, could not complete purchase");
    }
    exit("invalid value (partType:$pt), could not complete purchase");
}
?>