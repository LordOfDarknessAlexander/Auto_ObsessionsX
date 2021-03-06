<?php
//this script CREATE's Database tables with sql
//used by javascript ajax requests
header('Access-Control-Allow-Origin: *');
//
//require_once '../pasMeta.php';
require_once '../pasMeta.php';
//require_once '../re.php';
//require_once '../vehicles/vehicle.php';
require_once '../dbConnect.php';  //sql database connection
require_once '../secure.php';
//
//secure::loggin();
//
$gs = isset($_GET) && !empty($_GET);
$ps = isset($_POST) && !empty($_POST);

class pasCreate
{
    function userEntry($userID){
        //creates an empty table upon user registration,
        //true on success, false on failure
        global $AO_DB;
        $aoUsers = 'users';
        //get validated and sanitized form data
        //$addUser = $AO_DB->prepare(
           //"INSERT INTO $aoUsers(
                //user_id, uname, title, fname, lname,
                //curCarID, money, m_marker, tokens, prestige, user_level,
                //email, psword,
                //registration_date,
                //confirm
            //)VALUES(
                //?, ?, ?, ?,
                //?, ?,
                //?, NOW(), 0, 
                //50000.00, 0, 0, 0,
                //0
            //)"
        //);
        
        /*$res = $AO_DB->query(
           "INSERT INTO $aoUsers(
                user_id, uname, title, fname, lname,
                curCarID, money, m_marker, tokens, prestige, user_level,
                email, psword,
                registration_date,
                confirm
            )VALUES(
                $uid, $uname, $title, $fname, $lname,
                0, 50000.00, 0, 0, 0, 0,
                $email, $pw,
                NOW(),
                0
            )"
        );
        
        if(!$res){
            //sql error!
            //The vehicle is already registered
            //echo "<p class='error'>The email address is not acceptable because it is already registered</p>";
        }
        return ret;
        */
        return false;
    }
    public static function userTable($userID){
        //creates an empty table in aoUsersDB upon user registration,
        //user id should be 
        global $aoUsersDB;
        //escape and sanitize input string, incase someone tries an sql injection attack
        $tableName = "user$userID";  //getUserTableName();
        $uint = 'int unsigned';
        
        $CID = 'car_id';
        $DT = 'drivetrain';
        $B = 'body';
        $I = 'interior';
        $D = 'docs';
        $R = 'repairs';
        $defaultCharset = 'DEFAULT CHARSET = latin1';
        $defaultEngine = 'ENGINE = InnoDB';
        //table names can not be used as variables(?) in prepared statements,
        //so must use reqular queries
        $res = $aoUsersDB->query(
           "CREATE TABLE IF NOT EXISTS $tableName(
                $CID $uint NOT NULL PRIMARY KEY,
                $DT $uint,
                $B $uint,
                $I $uint,
                $D $uint,
                $R $uint
            )$defaultEngine $defaultCharset"
        );
        
        if(!$res){
            //$erno = $aoUsersDB->con->errno;
            //$err = $aoUsersDB->con->error;
            echo "createUserTable($userID), failed:($erno), reason: $err<br>";
            return false;
        }
        return true;
    }
    public static function userPurchase($userID){
        //creates an empty table in aoUsersDB upon user registration,
        //user id should be 
        global $aoPurchasesDB;
        //escape and sanitize input string, incase someone tries an sql injection attack
        $tableName = "user$userID";  //getUserTableName();
        $PID = 'pid';
        $DT = 'datetime';
        $UINT = 'int unsigned';
        $NN = 'NOT NULL';

        $defaultCharset = 'DEFAULT CHARSET = utf8';
        $defaultEngine = 'ENGINE = InnoDB';
        //table names can not be used as variables(?) in prepared statements,
        //so must use reqular queries
        $res = $aoPurchasesDB->query(
           "CREATE TABLE IF NOT EXISTS $tableName(
                $PID $UINT $NN PRIMARY KEY
            )$defaultEngine $defaultCharset"
            //initDate $DT $NN
            //completeDate $DT
            //confirm bool $NN
            //auto-increment pid
        );
        //$SD $date,
        //$ED $date,
        //$C $B
    
        if(!$res){
            //$erno = $aoUsersDB->con->errno;
            //$err = $aoUsersDB->con->error;
            echo "createUserTable($userID), failed:($erno), reason: $err<br>";
            return false;
        }
        return true;
    }
    public static function carSaleTable($uid){
        //creates an empty table in aoUsersDB upon user registration
        global $aoCarSalesDB;
        $tableName = "user$uid";    //getUserTableName();
        $uint = 'int unsigned';
        $defaultCharset = 'DEFAULT CHARSET = latin1';
        $defaultEngine = 'ENGINE = InnoDB';
        $CID = ao::CID;
        $DT = 'drivetrain';
        $B = 'body';
        $I = 'interior';
        $D = 'docs';
        $P = 'price';
        $T = '_time';
        $S = '_start';
        $E = '_end';
        $NN = 'NOT NULL';
        
        $res = $aoCarSalesDB->query(
           "CREATE TABLE IF NOT EXISTS $tableName(
                $CID $uint $NN PRIMARY KEY,
                $P float $NN,
                $DT $uint $NN,
                $B $uint $NN,
                $I $uint $NN,
                $D $uint $NN,
                $R $uint $NN,
                $T float $NN,
                $S datetime $NN,
                $E datetime
            )$defaultEngine $defaultCharset"
        );
        //bid float,    //the current highest bid until the auction has completed and the user receives the funds, else 0
        //start datetime NOT NULL,
        //end datetime,
        //$T float  //0 if end date is not null, else the time left on the auction
         
        if($res){
            //returns true if execute preformed successfully, false on failure
            return true;
        }
        else{
            $aoCarSalesDB->eErr();
        } false, output error
        //echo "pasCreate::carSalesTable($userID), failed:($erno), reason: $err";
        
        return false;
    }
    public static function auctionLossTable($uid){
        //creates an empty table in aoAuctionLossDB
        global $aoAuctionLossDB;

        $tableName = "user$uid";    //getUserTableName();
        $uint = 'int unsigned';
        $defaultCharset = 'DEFAULT CHARSET = latin1';
        $defaultEngine = 'ENGINE = InnoDB';
        $CID = ao::CID;
        
        $res = $aoAuctionLossDB->query(
           "CREATE TABLE IF NOT EXISTS $tableName(
                $CID $uint NOT NULL PRIMARY KEY
            )$defaultEngine $defaultCharset"
        );
         
        if($res){
            //returns true if execute preformed successfully, false on failure
            return true;
        }
        //else false, output error
        $erno = $aoAuctionLossDB->con->errno;
        $err = $aoCarSalesDB->con->error;
        echo "pasCreate::carSalesTable($uid), failed:($erno), reason: $err. <br> Could not create account.";
        
        return false;
    }
	 public static function achievementsTable($uid){
        //creates an empty table in aoAuctionLossDB
        global $AO_DB;
        $aoAchievements = 'achievements';

        $tableName = "achievements$uid";    //getUserTableName();
        $uint = 'int unsigned';
        $defaultCharset = 'DEFAULT CHARSET = latin1';
        $defaultEngine = 'ENGINE = InnoDB';
        $AID = ao::AID;
        
        $res = $AO_DB->query(
           "CREATE TABLE IF NOT EXISTS $tableName(
                $AID $uint NOT NULL PRIMARY KEY
            )$defaultEngine $defaultCharset"
        );
         
        if($res){
            //returns true if execute preformed successfully, false on failure
            return true;
        }
        //else false, output error
        $erno = $AO_DB->con->errno;

        echo "pasCreate::achievementsTable($uid), failed:($erno), reason: $err. <br> Could not create account.";
        
        return false;
    }
	public static function userAchievementsTable($uid){
        //creates an empty table in aoAuctionLossDB
        global $AO_DB;
        $aoUserAchievements = 'user_achievements';

        $tableName = "users_achievements$uid";    //getUserTableName();
        $uint = 'int unsigned';
        $defaultCharset = 'DEFAULT CHARSET = latin1';
        $defaultEngine = 'ENGINE = InnoDB';
        $AID = ao::AID;
        
        $res = $AO_DB->query(
           "CREATE TABLE IF NOT EXISTS $tableName(
                $AID $uint NOT NULL PRIMARY KEY
            )$defaultEngine $defaultCharset"
        );
         
        if($res){
            //returns true if execute preformed successfully, false on failure
            return true;
        }
        //else false, output error
        $erno = $AO_DB->con->errno;

        echo "pasCreate::user_achievementsTable($uid), failed:($erno), reason: $err. <br> Could not create account.";
        
        return false;
    }
    function userAccount($uid){
        //create entry in finalpost
        if(pasCreate::userEntry($uid) ){
            //get userID from final post for the 
            if(pasCreate::userTable($uid) {
                if(pasCreate::userSalesTable($uid) ){
                    if(pasCreate::auctionLossTable($uid) ){
                        //if(pasCreate::userPurchases($uid)){
                        return true;
                        //}
                        //echo 'Could not create user PayPal Purchase Table';
                    }
                    echo 'Could not create Auction Loss Table';
                }
                echo 'Could not create user sales table';
            }
            echo 'Could not create user table';
        }
        return false;
    }
}

if($ps){
    $cid = 'carID';
    
    if(isset($_POST[$cid])){
        $carID = intval($_POST[$cid]);
        $CID = 'car_id';
        $DT = 'drivetrain';
        $B = 'body';
        $I = 'interior';
        $D = 'docs';
        $R = 'repairs';
        //validate value, must be an int!
        //echo json_encode($carID);

        //switch the operation besed on value passed in url
        if($gs){
            $OP = 'op';
            //args being passed via the url
            if(isset($_GET[$OP]) ){
                //$op = isAlpha($_GET[$OP]) ? $_GET[$OP] : '';
                /*if($op == 'insert'){
                    //inserts a car with carID from the vehicle database into the
                    //logged in user's table in aoUsersDB
                    $hasCar = hasCar($carID);
                    
                    if($hasCar){
                        //user has already bought this car, error!
                    }
                    else{
                        $tableName = getUserTableName();
                        
                        $res = $aoUsersDB->query(
                            "INSERT INTO $tableName
                                ($CID, $DT, $B, $I, $D, $R)
                            VALUES
                                ($carID, 0,0,0,0,0)"
                            //if entry exists
                        );
                        if($res){
                            echo json_encode($res);
                            $res->close();
                            exit();
                        }
                    }
                }
                elseif($op == 'update'){
                    //inserts a car with carID from the vehicle database into the
                    //logged in user's table in aoUsersDB
                    $dt = intval($_POST['dt']);
                    $body = intval($_POST[$B]);
                    $inter = intval($_POST[$I]);
                    $docs = intval($_POST[$D]);
                    
                    $rep = intval($_POST[$R]);
                    
                    $tableName = getUserTableName();
                    
                    $res = $aoUsersDB->query(
                        "UPDATE $tableName SET
                            $DT=$dt, $B=$body, $I=$inter, $D=$docs, $R=$rep
                        WHERE
                            $CID = $carID"
                    );
                    
                    echo json_encode($res);
                    //}
                }*/
                //else switch to other calls
                exit();
            }
        }
        //get not set
    }
    //other post vars
}
else{
    //no passing any values via POST, do nothing
}
?>