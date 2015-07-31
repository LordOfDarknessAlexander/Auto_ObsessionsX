<?php
//
require_once '../pasMeta.php';
require_once '../re.php';
require_once '../secure.php';
require_once 'user.php';
//
class aoBody{
    //const
        //CHASIS = ,
        //PANELS = ,
        //PAINT = ,
        //CHROME = 0;
    
    
    public static function getBody($cid){
        global $aoUsersDB;
        
        $B = 'body';
        
        $res = $aoUsersDB->query(
            sql::slctAllFromUserTable() . " WHERE $CID = $cid"
        );
        
        if($res){
            $ret = intval($res->fetch_assoc()[$B]);
            //echo $ret;
            return $ret;
        }
        //exit();
    }
    public static function setBody($b){
        // global $aoUsersDB;
        
        // $B = 'body';
        
        // $res = $aoUsersDB->query(
            // "UPDATE $tableName SET
                // $B=$nb
            // WHERE
                // $CID = $carID"
        // );
        // if($res){
            // $ret = intval($res->fetch_assoc()[$B]);
            // //echo $ret;
            // return $ret;
        // }
        //exit();
    }
    public static function upgradeChasis($cid, $price){
        global $aoUsersDB;
        
        $offset = 12;   //number of bits
        $b = aoBody::getBody($cid);
        $chas = ($b & 0xF000) >> $offset;
        $PRO = 4;   //reassing from enum
        
        if($chas < $PRO){
            //check if part is already fully upgraded
            //then see if user have enough funds for purchase
            $uf = user::getFunds(); //user funds
            $nf = user::decFunds($price);
            $dif = $uf - $nf;
                
            if($dif > 0.000008){
                //if purchase is successful, $dif > 1
                $tableName = getUserTableName();
                //
                //mask and shift values here
                $nc = ($b == 0 ? 1 : $chas << 1);   //new chrome value
                $shift = $nc << $offset;
                //echo $nc;
                $nb = ($b & 0x0FFF) | $shift;   //clear last bits, setting new value
                //echo $nb;
                //set new values
                $res = $aoUsersDB->query(
                    "UPDATE $tableName SET
                        $B=$nb
                    WHERE
                        $CID = $carID"
                );
                //
                $ret = array(
                    'userFunds'=>$nf,
                    'cid'=>$cid,
                    $B=>$nb
                );
        
                echo json_encode($ret);
            }
            //else, new funds and user's funds are the same,
            //purchase not succussful
            echo 'could not purchase upgrade, insufficent funds';
        }
        echo 'could not upgrade part, already fully upgraded';
    }
    public static function upgradePanels($cid, $price){
        global $aoUsersDB;
        
        $offset = 8;   //number of bits
        $b = aoBody::getBody($cid);
        $pan = ($b & 0x0F00) >> $offset;
        $PRO = 4;   //reassing from enum
        
        if($pan < $PRO){
            //check if part is already fully upgraded
            //then see if user have enough funds for purchase
            $uf = user::getFunds(); //user funds
            $nf = user::decFunds($price);
            $dif = $uf - $nf;
                
            if($dif > 0.000008){
                //if purchase is successful, $dif > 1
                $tableName = getUserTableName();
                //
                //mask and shift values here
                $np = ($pan == 0 ? 1 : $pan << 1);   //new chrome value
                $shift = $np << $offset;
                //echo $nc;
                $nb = ($b & 0xF0FF) | $shift;   //clear last bits, setting new value
                //echo $nb;
                //set new values
                $res = $aoUsersDB->query(
                    "UPDATE $tableName SET
                        $B=$nb
                    WHERE
                        $CID = $carID"
                );
                //
                $ret = array(
                    'userFunds'=>$nf,
                    'cid'=>$cid,
                    $B=>$nb
                );
        
                echo json_encode($ret);
            }
            echo 'could not purchase upgrade, insufficent funds';
        }
        echo 'could not upgrade part, already fully upgraded';
    }
    public static function upgradePaint($cid, $price){
       global $aoUsersDB;
        
        $offset = 4;   //number of bits
        $b = aoBody::getBody($cid);
        $paint = ($b & 0x00F0) >> $offset;
        $PRO = 4;   //reassing from enum
        
        if($paints < $PRO){
            //check if part is already fully upgraded
            //then see if user have enough funds for purchase
            $uf = user::getFunds(); //user funds
            $nf = user::decFunds($price);
            $dif = $uf - $nf;
                
            if($dif > 0.000008){
                //if purchase is successful, $dif > 1
                $tableName = getUserTableName();
                //
                //mask and shift values here
                $np = ($paint == 0 ? 1 : $paint << 1);   //new chrome value
                $shift = $np << $offset;
                //echo $nc;
                $nb = ($b & 0xFF0F) | $shift;   //clear last bits, setting new value
                //echo $nb;
                //set new values
                $res = $aoUsersDB->query(
                    "UPDATE $tableName SET
                        $B=$nb
                    WHERE
                        $CID = $carID"
                );
                //
                $ret = array(
                    'userFunds'=>$nf,
                    'cid'=>$cid,
                    $B=>$nb
                );
        
                echo json_encode($ret);
            }
            echo 'could not purchase upgrade, insufficent funds';
        }
        echo 'could not upgrade part, already fully upgraded';
    }
    public static function upgradeChrome($cid, $price){
        global $aoUsersDB;
        
        $b = aoBody::getBody($cid);
        $chrome = ($b & 0x000F) >> 0;
        $PRO = 4;   //reassing from enum
        
        if($chrome < 4){
            //check if part is already fully upgraded
            //then see if user have enough funds for purchase
            $uf = user::getFunds(); //user funds
            $nf = user::decFunds($price);
            $dif = $uf - $nf;
                
            if($dif > 0.000008){
                //if purchase is successful, $dif > 1
                $tableName = getUserTableName();
                //
                //mask and shift values here
                $nc = ($chrome == 0 ? 1 : $chrome << 1);   //new chrome value
                //echo $nc;
                $nb = ($b & 0xFFF0) | $nc;   //clear last bits, setting new value
                //echo $nb;
                //set new values
                $res = $aoUsersDB->query(
                    "UPDATE $tableName SET
                        $B=$nb
                    WHERE
                        $CID = $carID"
                );
                //
                $ret = array(
                    'userFunds'=>$nf,
                    'cid'=>$cid,
                    $B=>$nb
                );
        
                echo json_encode($ret);
            }
            //else, new funds and user's funds are the same,
            //purchase not succussful
            echo 'could not purchase upgrade, insufficent funds';
        }
        echo 'could not upgrade part, already fully upgraded';
    }
}
?>