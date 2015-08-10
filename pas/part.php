<?php
//
require_once '../pasMeta.php';
require_once '../re.php';
require_once 'user.php';
//
function getPriceFromPost(){
    //return the parameter at $P, converting to a float
    $P = 'price';
    
    if(isSetP() ){
        $ret = isFloat($_POST[$P])?
            round(floatval($_POST[$P]), 2)
            :
            exit("execution terminating. Invalid value of POST at $P, expecting a float");
        //echo $ret;
        return $ret;
    }
    exit("execution terminating. POST not set, can not return value at index $P");
}
function getCIDFromPost(){
    $CID = ao::CID;
    
    if(isSetP() ){
        //eP();
        $ret = isUINT($_POST[$CID])?
            intval($_POST[$CID])
            :
            exit("execution terminating. Invalid value of POST at $CID, script expecting an unsigned integer");
        //echo $ret;
        return $ret;
    }
    exit("execution terminating. POST not set, can not return value at index $CID");
}
function getPartTypeFromPost(){
    $PT = 'partTyle';
    
    if(isSetP() ){
        //$ret = isUINT($_POST[$CID])?
            //intval($_POST[$CID])
            //:
            //exit("execution terminating. Invalid value of POST at $PT, script expecting an unsigned integer");
        //echo $ret;
        //return $ret;
    }
    //exit("execution terminating. POST not set, can not return value at index $PT");
}
class aoStage{
    const
        STOCK = 0x0,      //0000
        AMATEUR = 0x1,    //0001
        SPORT = 0x2,      //0010
        RACING = 0x4,     //0100
        PRO = 0x8;        //1000
}
?>