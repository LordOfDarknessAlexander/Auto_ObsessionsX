<?php
//
//drivetrain.phph
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
        global $aoUsersDB;
        
        $B = aoBody::KEY;
        $CID = ao::CID;
        
        $res = $aoUsersDB->query(
            sql::slctAllFromUserTable() . " WHERE $CID = $cid"
        );
        
        if($res){
            $ret = intval($res->fetch_assoc()[$B]);
            //echo $ret;
            return $ret;
        }
        //exit();
        return 0;
    }
    public static function setBody($cid, $b){
        global $aoUsersDB;
        
        $TN = getUserTableName();
        $B = aoBody::KEY;
        $CID = ao::CID;
        
        $res = $aoUsersDB->query(
            "UPDATE $TN SET $B = $b WHERE $CID = $cid"
        );
        //return true;
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
                
            if($dif > 0.000008){
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
    public static function upgradeChassis(){
        return aoBody::upgrade(12);
    }
    public static function upgradePanels(){
       return aoBody::upgrade(8);
    }
    public static function upgradePaint(){
        return aoBody::upgrade(4);
    }
    public static function upgradeChrome(){
        return aoBody::upgrade(0);
    }
}
$pt = getPartTypeFromPost();

if(isSetP()){
    //echo $pt;
    
    if($pt !== null){
        $ret = null;
        
        if($pt == aoBody::CHASSIS){
            $ret = aoBody::upgradeChassis();
        }
        else if($pt == aoBody::PANELS){
            $ret = aoBody::upgradePanels();
        }
        else if($pt == aoBody::PAINT){
            $ret = aoBody::upgradePaint();
        }
        else if($pt == aoBody::CHROME){
            $ret = aoBody::upgradeChrome();
        }
        
        if($ret !== null){
            echo json_encode($ret);
            exit();
        }
        echo "invalid value ret:$ret, could not complete purchase";
        exit();
    }
    echo "invalid value (partType:$pt), could not complete purchase";
}
?>