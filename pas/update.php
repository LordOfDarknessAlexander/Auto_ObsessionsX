<?php
//this script INSERTs or UPDATEs Database values with sql
//used by javascript ajax requests
require_once '../pasMeta.php';
require_once '../re.php';
//require_once '../include/secure.php';
//
//secure::loggin();
//
class pasUpdate{
    public static function soldCar($carID, $price){
        //$res = $aoUsersDB->query(
            //if entry does not exist add it, else update
            //"UPDATE $tableName SET drivetrain=$dt, body=$body, interior=$inter, docs=$docs, repairs=$rep WHERE car_id = $carID"
        //);
        
        //echo json_encode($res);
    }
    public static function userLoss($carID){
        global $aoAuctionLossDB;
        $table = getUserTableName();
        $ret = false;
        
        $res = $aoAuctionLossDB->query(
            //if entry does not exist add it, else update
            "INSERT INTO $table (car_id) VALUES ($carID)"
        );
        
        if($res){
            $ret = true;
        }
        return $ret;
    }
    public static function userCurrentCar($carID){
        global $AO_DB;
        $users = 'users';
        $uid = 2; //$_SESSION['user_id'];
        return hasCar($carID) ? ($AO_DB->query(
            "UPDATE $users SET car_id=$carID WHERE user_id = $uid"
        ) ? $carID : 0) : 0;
    }
}
/*public static function hasSoldCar($carID){
    //does the user's table in aoCarSalesDB already have an entry with car_id '$id'
    global $aoSoldCarsDB;
    
    $tableName = getUserTableName();    //$_SESSION['userID'];
    $ret = false;
    
    $res = $aoSoldCarsDB->query("SELECT * FROM $tableName WHERE car_id = $id");
    
    if($res){
        //user has sold car, valid entry in db
        $ret = mysqli_num_rows($res) != 0 ? true : false;
    }
    //else{user still owns car, no entry in db}
    mysqli_free_result($res);
    
    return $ret;
}*/

/*public static function getCarFromID($carID){
    //selects a vehicle from the car database,
    //returning it as a JSON object string
    global $AO_DB;
    $aoCars = 'aoCars';
    static $_getCar = $AO_DB->prepare(
        "SELECT * FROM $aoCars WHERE car_id = ?"
    );
    if(_getCar){
        //bind_params
            //execute
    }
    else{
        $res = $AO_DB->query(
            "SELECT * FROM $aoCars WHERE car_id = $carID"
        );
        if($res){
            if(mysqli_num_rows($res) != 0){
                //$q = "INSERT INTO vehicles (car_id, make, model, year, info) VALUES (' ', '$make', '$model', '$year', '$info')";		
                $data = $res->fetch_assoc();//@mysqli_query($CARS.$con, $q); // Run the query
                $car = Vehicle::fromArray($data);
                //echo '{"data":"this is data!"}';
                return $car;
                //echo Vehicle::fromArray($result->fetch_assoc() )->toJSON();
            } 
            else{
                //$er = sqlError($AO_DB);
                //echo "<h2>System Error</h2>
                //<p class='error'>Vehicle could not be registered due to a system error. Please try again later</p>";
                //echo '<p>'.mysqli_error($CARS.$con).'<br><br>Query: '.$q.'</p>';
            } 
            mysqli_free_result($res);
        }
        else{   //The vehicle is already registered
            //return null; //echo "<p class='error'>The email address is not acceptable because it is already registered</p>";
        }
    }
    return null;
}*/
/*function updateSale($sale){
    gloabal $aoCarSalesDB;
    $res = $aoCarSalesDB->query(
        "IF NOT EXISTS entry with saleID
        INSERT ... ELSE
        ON DUPLICATE KEY UPDATE existing sale"
    );
    return $ret;
}*/
/*function updateUser(){
    gloabal $AO_DB;
    $users = 'users';
    $uid = getUserTableName();
    //$cash, $tok, $prest, $markers;
    //static $updateUser = $AO_DB->prepare(
        //"UPDATE $users SET
        //(money = ?, tokens = ?, prestige = ?, m_markers = ?)
        //WHERE user_id = ?"
    //);
    
    $res = $AO_DB->query("UPDATE $users SET (money, tokens, presteige, markers) WHERE user_id = $uid");
    //return;
}

/*if(isset($_GET) && !empty($_GET) ){
    //args being passed vai the url
    if(isset($_GET['op']) && $_GET['op'] == 'asc'){
        getAuctionCars();
        exit();
    }
}*/
class purchase{
    //private
    //const FAILED = 'Could not complete purchase!';
    static public function funds($funds){
        global $AO_DB;
        $MAX_FUNDS = PHP_INT_MAX;
        
        if(is_float($funds) && $funds > 0.0){
            $f = round($funds, 2);  //round currency to 2 decimal places
            $uid = strval(getUID() );
            $users = 'users';
            $m = 'money';
            $rm = $AO_DB->query(
                "SELECT $m FROM $users WHERE user_id = $uid"
            );
            
            if($rm){
                $uf = floatval($rm->fetch_assoc()[$m]);  //user funds
                $nf = $uf + $f;   //new funds
                
                if($nf < $MAX_FUNDS){
                    $res = $AO_DB->query(
                        "UPDATE $users SET $m = $nf WHERE user_id = $uid"
                    );
                    if($res){
                        echo json_encode($nf);
                        return;
                    }
                    //else
                    //output sql errors
                }
                //else
                echo 'Operation failed, could not purchase more funds, cap reached!';
                $rm->close();
                echo json_encode($nf);
            }
            //else
            //echo 'sql error, select query failed!';
            //return;
        }
        //$f = json_encode($funds);
        //echo "purchase::funds(), invalid value $f, purchase::failed";
    }
    static public function tokens($val){
        //adds $val number of tokens to user's account,
        //$val must be an unsigned int greater than 0
        global $AO_DB;
        $MAX_TOKENS = PHP_INT_MAX;
        
        if(is_int($val) && $val > 0){
            $uid = strval(getUID() );
            $users = 'users';
            $t = 'tokens';
            $rt = $AO_DB->query(
                "SELECT $t FROM $users WHERE user_id = $uid"
            );
            
            if($rt){
                $ut = intval($rt->fetch_assoc()[$t]);   //user's current tokens
                $nt = $ut + $val;    //new tokens
                
                if($nt < $MAX_TOKENS){
                    $res = $AO_DB->query(
                        "UPDATE $users SET $t=$nt WHERE user_id = $uid"
                    );
                    
                    if($res){
                        echo json_encode($nt);
                        return;
                    }
                    //else
                    //echo json_encode($ut);
                    //output sql errors
                    return;
                }
                //else
                echo 'Operation failed, could not purchase more tokens, cap reached!';
                $rt->close();
                echo json_encode($ut);
                return;
            }
            //else
            //echo 'sql error, select query failed!';
            //return;
        }
        //$f = json_encode($funds);
        //echo "purchase::funds(), invalid value $f, purchase::failed";
    }
}
function addPrestige($val){
    //$val must be an unsigned int greater than 0
    global $AO_DB;
    
    if(is_int($val) AND $val > 0){
        //$uid = //getUID();
        $user = 'users';
        //$p = 'prestige';
        //$rp = $AO_DB->query(
            //"SELECT prestige FROM $users WHERE user_id = $uid"
        //)
        //if($rp){
            //$np = intval($rt->fetch_assoc()['tokens']) + $val;    //new prestige
            //if(t < $MAX_PRESTIGE){
                //$res = $AO_DB->query(
                    //"UPDATE $users SET prestige=$t WHERE user_id = $uid"
                //);
            //}
            //else{
                //'Operation failed, could not grant more prestige, cap reached!';
            //}
        //}
    }
    else{
        //$t = json_encode($funds);
        //echo "purchase::tokens(), invalid value $t, purchase::failed";
    }
}
function  addMarkers($val){
    //$val must be an unsigned int greater than 0
    global $AO_DB;
    
    if(is_int($val) AND $val > 0){
        //$uid = //getUID();
        $user = 'users';
        //$m = 'm_markers';
        //$res = $AO_DB->query(
            //"UPDATE $users SET tokens=$val WHERE user_id = $uid"
        //);
    }
    else{
        //$t = json_encode($funds);
        //echo "purchase::tokens(), invalid value $t, purchase::failed";
    }
}
//if(isset($_GET) ){
    //if(isset($_GET['op']) ){
        //$op = isAlpha($_GET['op']) ? $_GET['op'] : '';
    //}
    //elseif($_GET['']){
        //preform other operations!
    //}
    //else no valid get args!
    //exit();
//}
if(isset($_POST) && !empty($_POST) ){
    if(isset($_POST['carID'])){
        //
        $carID = $_POST['carID'];   //is_int($_POST['carID']) ? $_POST['carID'] : ;
        //validate value, must be an int!
        //echo json_encode($carID);

        //switch the operation besed on value passed in url
        if(isset($_GET) && !empty($_GET) ){
            //args being passed via the url
            if(isset($_GET['op']) ){
                $op = isAlpha($_GET['op']) ? $_GET['op'] : '';
                    
                if($op == 'insert'){
                    //inserts a car with carID from the vehicle database into the
                    //logged in user's table in aoUsersDB
                    //returns true if the INSERTion is successful,
                    //false if user has the vehicle already or any other reason the vehicle could not be added
                    $hasCar = hasCar($carID);
                    
                    if($hasCar){
                        //user has already bought this car, exit with false!
                        //echo json_encode(false);
                        exit();
                    }
                    else{
                        $tableName = getUserTableName();   //$_SESSION['userID'];
                        
                        $res = $aoUsersDB->query(
                            "INSERT INTO $tableName (car_id, drivetrain, body, interior, docs, repairs) VALUES ($carID, 0,0,0,0,0)"
                            //IF entry EXISTS do nothing
                        );
                        echo json_encode($res);
                    }
                    exit();
                }
                elseif($op == 'update'){
                    //inserts a car with carID from the vehicle database into the
                    //logged in user's table in aoUsersDB
                    $dt = intval($_POST['dt']);
                    $body = intval($_POST['body']);
                    $inter = intval($_POST['interior']);
                    $docs = intval($_POST['docs']);
                    
                    $rep = intval($_POST['repairs']);
                    
                    $tableName = getUserTableName();    //$_SESSION['userID'];

                    $res = $aoUsersDB->query(
                        "UPDATE $tableName SET drivetrain=$dt, body=$body, interior=$inter, docs=$docs, repairs=$rep WHERE car_id = $carID"
                    );
                    
                    echo json_encode($res);
                    exit();
                }
                elseif($op == 'iul'){
                    //insert user loss for carID
                    $res = pasUpdate::userLoss($carID);
                    
                    echo json_encode($res);
                    exit();
                }
                elseif($op == 'succ'){
                    //set user current car
                    $res = pasUpdate::userCurrentCar($carID);
                    
                    echo json_encode($res);
                    exit();
                }
                //else switch to other calls
                echo 'invalid operation ($op) selected, error loading page';
                exit();
            }
            //elseif other GET args
            //else no supported operation!
        }
        //else no GET args, simply return data of car with id
        
        //echo '{"data":' . strval($carID) . '}';
        //select an individual element with car_id $carID
        //$car = getCarFromID($carID);
        
        //if($car != null){
            //echo $car->toJSON();
        //}
        //else{
            //echo '{}';  //return emtpy object
        //}
    }
    elseif(isset($_POST['udv'])){
        //user data value, for updating the user's stats
        if(is_numeric($_POST['udv']) ){
            if(isset($_GET) && !empty($_GET) ){
                //args being passed via the url
                if(isset($_GET['op']) ){
                    $op = isAlpha($_GET['op']) ? $_GET['op'] : '';
                    //echo json_encode(gettype($_POST['udv'])); //returns a string
                    //exit();
                    if($op == 'puf'){
                        purchase::funds(floatval($_POST['udv']) );
                        exit();
                    }
                    if($op == 'put'){
                        purchase::tokens(intval($_POST['udv']) );
                        exit();
                    }
                    if($op == 'aup'){
                        //addPrestige(intval($_POST['udv']));
                        exit();
                    }
                    if($op == 'aum'){
                        //addMarkers(intval($_POST['udv'])) ;
                        exit();
                    }
                    //else
                    //invalid operation;
                }
                //elseif other $_GET vars
                //else
                //invalid operation;
            }
            //else
            //no vars set with $_GET, no operation preformed
        }
        else{
            //echo 'invalid $_POST entry';
        }
    }
    //elseif other $_POST entries
    //
    echo 'no valid post entries, executing script did nothing';
    exit();
}
else{
    //no passing any values via POST, return all cars
    //echoUserCars();
    echo 'not passing post vars!';
    exit();
}
?>