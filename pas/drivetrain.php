<?php

require_once '../pasMeta.php';
require_once '../dbConnect.php';  //sql database connection
require_once '../secure.php';
require_once '../re.php';

class aoDrivetrain
{
	//ints match those in the drivetrain.js TYPE enum
    const
	    ENGINE = 0,
	    TRASMISSION = 1,
	    AXEL = 2,
	    EXHAUST = 3;

    static function upgradeEngine($cID){	
		//$price = isFloat($_POST[''])? intVal($_POST['']) : 0;
        return $cID;       
    }
}
//eSG(); //echo superGlobals
//aoDrivetrain::upgradePart(333333, 0);//engine upgrade

if(isSetP() ){
    global $aoUsersDB;
    $DT = 'drivetrain';
    
	//echo 'butternuts';
	$pt = isUINT($_POST['partType']) ? intVal($_POST['partType']) : 0; 
	$_cid = isUINT($_POST['cid']) ? intVal($_POST['cid']) : 0;
        
    if($_cid > 0){
        $CID = ao::CID;
        $res = $aoUsersDB->query(
            sql::slctAllFromUserTable() . " WHERE $CID = $_cid"
        );
        
        if($res){
            $r = $res->fetch_assoc();
            $CID = intval($r[$CID]);
            $dt = intval($r[$DT]);
			//$price = intval($r[$STAGE]);
        }           
        else{
            $aoUsersDB->eErr();
        }
		
    }

	if($pt == aoDrivetrain::ENGINE){
		//return this.upgrade(eng);
		//echo 'engine';
		
		$res = aoDrivetrain::upgradeEngine($_cid);
        //aoDrivetrain::upgradeEngine($_cid);
		echo json_encode($res); 
		exit();
	}
	elseif($pt == aoDrivetrain::TRASMISSION){
		//return this.upgrade(tra);
		//echo 'transmission';
		//$res = aoDrivetrain::upgradeEngine($_cid);
		echo json_encode($res);    
		exit();
	}
	elseif($pt == aoDrivetrain::AXEL){
		//return this.upgrade(axe);
		//echo 'axel';
	}
	elseif($pt == aoDrivetrain::EXHAUST){
		//return this.upgrade(exh);
		//echo 'exhaust';
	}
	else{
		//console.log('attempting to upgrade unknown type: ' + partType.toString() );
		echo 'attempting to upgrade unknown type: ';
	}

}

?>
