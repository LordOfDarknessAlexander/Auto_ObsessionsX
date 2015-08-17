<?php
//
//documents.php
//Created by Tyler R. Drury, 01-08-2015
//(C) 8.5:1 Entertainment, All Rights Reserved
//
require_once 'part.php';

class aoDocuments
{
	//ints match those in the interior.js TYPE enum
    const
        KEY = 'docs',
	    OWNERSHIP = 1,
	    BUILD = 2,
	    HISTORY = 3,
	    RESTORATION = 4;
    
    public static function getDocs($cid){		
        $D = aoDocuments::KEY;
        
        $res = user::slctFromCar($cid, $D);
        
        if($res){
            $ret = intval($res[$D]);
            //echo $ret;
            return $ret;
        }
        
        return 0;
    }    
    public static function setDocs($cid, $d){
        $D = aoDocuments::KEY;
        
        return user::updateCar($cid, "$D = $d");
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
        
        $b = aoDocuments::getDocs($cid);
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
                if(aoDocuments::setDocs($cid, $nb) ){                    
                    return array(
                        'userFunds'=>$nf,
                        ao::CID=>$cid,
                        aoDocuments::KEY=>$nb,
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
class aoOwnership extends aoDocuments{
    public static function upgrade(){
        return parent::upgrade(12);
    }
}
class aoBuild extends aoDocuments{
    public static function upgrade(){
        return parent::upgrade(8);
    }
}
class aoHistory extends aoDocuments{
    public static function upgrade(){
        return parent::upgrade(4);
    }
}
class aoRestoration extends aoDocuments{
    public static function upgrade(){
        return parent::upgrade(0);
    }
}
//eSG(); //echo superGlobals
$pt = getPartTypeFromPost();

if(isSetP() ){
    //$echo $pt;
	
    if($pt !== null){
        $ret = null;
        
        if($pt == aoDocuments::OWNERSHIP){
		    $ret = aoOwnership::upgrade();
	    }
	    elseif($pt == aoDocuments::BUILD){
		    $ret = aoBuild::upgrade();
	    }
	    elseif($pt == aoDocuments::HISTORY){
            $ret = aoHistory::upgrade();
	    }
	    elseif($pt == aoDocuments::RESTORATION){
            $ret = aoRestoration::upgrade();
	    }
	    else{
		    //console.log('attempting to upgrade unknown type: ' + partType.toString() );
		    echo 'attempting to upgrade unknown type: '. json_encode($pt);
	    }	
        echo json_encode($ret);
        exit();
    }
    echo "invalid value (partType:$pt), could not complete purchase"; 
}
?>