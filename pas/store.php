<?php
//
//store.php
//Created by Tyler R. Drury, 19-09-2015
//(C) 8.5:1 Entertainment, All Rights Reserved
//
require_once '../pasMeta.php';
//
if(isSetG() ){
    //eC();
	$op = getOpFromGET();
    $tn = getUserTableName();

    if(isSetP() ){
        $V = 'val';
        $PID = 'pid';
        $str = $_POST[$V];
        $val = isUINT($str) ? intval($str)) : 0;
        
        if($op == 'pc'){
            // //user initializes cash purchase before being renavigated to paypal store
            //$res = $aoPurchases->query(
                //"UPDATE $tn
                    //$PID='',
                    //op=$op,
                   // $V=$val,
                    //startDate=DATE(),
                    //comfirmDate=null,
                    //expireDate=null"
            //);
            
            if($res){
                //$pid = "FROM $tn SELECT $PID";
                //exit(json_encode($res) );
            }
            //exit('could not initializes currency purchase request');
        }
        else if($op == 'pt'){
            // //user initializes token purchase before being renavigated to paypal store
            //$res = $aoPurchases->query(
                //"UPDATE $tn
                //op=$op,
               // $V=$val,
                //startDate=DATE(),
                //comfirmDate=null,
                //expireDate=null"
            //);
            if($res){
                //$pid = "FROM $tn SELECT $PID"
                //exit(json_encode($res) );
            }
            //exit('could not initializes token purchase request');
        }
    }
}
?>