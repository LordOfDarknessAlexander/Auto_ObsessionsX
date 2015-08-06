<?php
//
require_once 'part.php';
//
class aoDocs{
    const
        CHASSIS = 0x1,
        PANELS = 0x2,
        PAINT = 0x3,
        CHROME = 0x4;    
    
    public static function getDocs($cid){
        global $aoUsersDB;
        
        $B = 'docs';
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
    public static function setDocs($cid, $b){
        global $aoUsersDB;
        
        $TN = getUserTableName();
        $B = 'docs';
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
    public static function upgradeChassis($cid, $price){
        global $aoUsersDB;
        
        $offset = 12;   //number of bits
        $b = aoDocs::getDocs($cid);
        $chas = ($b & 0xF000) >> $offset;
        //echo $chas;
        
        if($chas < aoStage::PRO){
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
                $nc = ($b == 0 ? 1 : $chas << 1);   //new chrome value
                $shift = $nc << $offset;
                //echo $nc;
                $nb = ($b & 0x0FFF) | $shift;   //clear last bits, setting new value
                //echo $nb;
                //set new values
                
                //$res = $aoUsersDB->query(
                    //"UPDATE $tableName SET
                        //$B=$nb
                    //WHERE
                        //$CID = $carID"
                //);
                //
                if(aoDocs::setDocs($cid, $nb) ){
                    $B = 'body';
                    $V = 'value';
                    
                    return array(
                        'userFunds'=>$nf,
                        'cid'=>$cid,
                        $B=>$nb,
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
        global $aoUsersDB;
        
        $offset = 8;   //number of bits
        $b = aoDocs::getDocs($cid);
        $pan = ($b & 0x0F00) >> $offset;
        $PRO = 4;   //reassing from enum
        
        if($pan < aoStage::PRO){
            //check if part is already fully upgraded
            //then see if user have enough funds for purchase
            $uf = user::getFunds(); //user funds
            $nf = user::decFunds($price);
            $dif = $uf - $nf;
                
            if($dif > 0.000008){
                //if purchase is successful, $dif > 1
                //
                //mask and shift values here
                $np = ($pan == 0 ? 1 : $pan << 1);   //new chrome value
                $shift = $np << $offset;
                //echo $nc;
                $nb = ($b & 0xF0FF) | $shift;   //clear last bits, setting new value
                //echo $nb;
                //set new values
                if(aoDocs::setDocs($cid, $nb) ){
                    $B = 'val';
                    $V = 'value';
                    
                    return array(
                        'userFunds'=>$nf,
                        'cid'=>$cid,
                        $B=>$nb,
                        $V=>$np
                    );
        
                    //echo json_encode($ret);
                    //exit();
                }
            }
            echo 'could not purchase upgrade, insufficient funds';
            return null;
        }
        echo 'could not upgrade part, already fully upgraded';
        return null;
    }
    public static function upgradePaint($cid, $price){
        //
        $offset = 4;   //number of bits
        $b = aoDocs::getDocs($cid);
        $paint = ($b & 0x00F0) >> $offset;
        
        if($paint < aoStage::PRO){
            //check if part is already fully upgraded
            //then see if user have enough funds for purchase
            $uf = user::getFunds(); //user funds
            $nf = user::decFunds($price);
            $dif = $uf - $nf;
            
            if($dif > 0.000008){
                //if purchase is successful, $dif > 1
                //
                //mask and shift values here
                $np = ($paint == 0 ? 1 : $paint << 1);   //new chrome value
                $shift = $np << $offset;
                //echo $nc;
                $nb = ($b & 0xFF0F) | $shift;   //clear last bits, setting new value
                //echo $nb;
                //set new values
                if(aoDocs::setDocs($cid, $nb) ){
                    $B = 'body';
                    $V = 'value';
                        
                    return array(
                        'userFunds'=>$nf,
                        'cid'=>$cid,
                        $B=>$nb,
                        $V=>$np
                    );
        
                    //echo json_encode($ret);
                    //exit();
                }
            }
            echo 'could not purchase upgrade, insufficient funds';
            return null;
        }
        echo 'could not upgrade part, already fully upgraded';
        return null;
    }
    public static function upgradeChrome($cid, $price){
        //
        $b = aoDocs::getDocs($cid);
        $chrome = ($b & 0x000F) >> 0;
        
        if($chrome < aoStage::PRO){
            //check if part is already fully upgraded
            //then see if user have enough funds for purchase
            $uf = user::getFunds(); //user funds
            $nf = user::decFunds($price);
            $dif = $uf - $nf;
                
            if($dif > 0.000008){
                //if purchase is successful, $dif > 1
                //
                //mask and shift values here
                $nc = ($chrome == 0 ? 1 : $chrome << 1);   //new chrome value
                //echo $nc;
                $nb = ($b & 0xFFF0) | $nc;   //clear last bits, setting new value
                //echo $nb;
                //set new values
                if(aoDocs::setDocs($cid, $nb) ){
                    $B = 'body';
                    $V = 'value';
                    
                    return array(
                        'userFunds'=>$nf,
                        'cid'=>$cid,
                        $B=>$nb,
                        $V=>$nc
                    );
        
                    //echo json_encode($ret);
                    //exit();
                }
            }
            //else, new funds and user's funds are the same,
            //purchase not successful
            echo 'could not purchase upgrade, insufficient funds';
            return null;
        }
        echo 'could not upgrade part, already fully upgraded';
        return null;
    }
}
// if(isSetP()){
    // //echo 'blah';
    // $P = 'price';
    // $CID = ao::CID;
    // $PT = 'partType';
    
    // $p = isFloat($_POST[$P]) ? round(floatval($_POST[$P]), 2) : 0.0;
    // //echo $p;
    // $cid = isUINT($_POST[$CID]) ? intval($_POST[$CID]) : 0;
    // //echo $cid;
    // $pt = isUINT($_POST[$PT]) ? intval($_POST[$PT]) : null;
    // //echo $pt;
    
    // if($cid != 0 && $p > 1.0 && $pt !== null){
        // $ret = null;
        
        // if($pt == aoDocs::CHASSIS){
            // $ret = aoDocs::upgradeChassis($cid, $p);
        // }
        // else if($pt == aoDocs::PANELS){
            // $ret = aoDocs::upgradePanels($cid, $p);
        // }
        // else if($pt == aoDocs::PAINT){
            // $ret = aoDocs::upgradePaint($cid, $p);
        // }
        // else if($pt == aoDocs::CHROME){
            // $ret = aoDocs::upgradeChrome($cid, $p);
        // }
        // if($ret !== null){
            // echo json_encode($ret);
            // exit();
        // }
        // echo "invalid value ret:$ret, could not complete purchase";
        // exit();
    // }
    // echo "invalid value(s), ($CID:$cid, $P:$p, $PT:$pt) could not complete purchase";
// }
?>