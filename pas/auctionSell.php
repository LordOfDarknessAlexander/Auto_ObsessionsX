<?php
//this script INSERTs or UPDATEs Database values with sql
//used by javascript ajax requests
header('Access-Control-Allow-Origin: *');
//
require_once '../pasMeta.php';
require_once 'update.php';
require_once 'query.php';
require_once 'remove.php';
require_once '..secure.php';
//
//secure::loggin();
//
/*function getCarFromID($carID){
    //selects a vehicle from the car database,
    //returning it as a JSON object string
    global $AO_DB;
    $aoCars = 'aoCars';
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
    return null;
}*/
function payUser($value){
    global $aoUsersDB;
    global $aoCarSalesDB;
    $aoUsers = 'aoUsers';
    //$UID = ao::UID;
    $M = 'money';
    $CI = 'cashedIn';
    $EX = 'expired';
    $ret = 0;   //new funds after transaction
    
    //$rm = $aoUsersDB->query(
        //"SELECT $M FROM $aoUsers WHERE $UID = $uid"
    //);
    //$rs = $aoSales->query(
        //"SELECT $CI, $EX FROM $ut WHERE $UID = $uid"
    //);
    
    //if($rm && $rs){
        //$um = (float)$rm->fetch_assoc()[$M];
        //$ci = (bool)$rs->fetch_assoc()[$CI];
        //$ex = (bool)$rs->fetch_assoc()[$EX];
        //        
        //if(!$ci && $ex){
            //user has not received payment for this sale
            //$nf = $um + $value;
            
            //$ret = $nf < MAX_FLOAT ? $nt : $um;
            //}
        //}
        //else{
            //$ret = $um;
        //}
    //}
    
    //else not valid car ID, do nothing
    //return json_encode($ret);
}
function setUserCar($carID){
    global $AO_DB;
    //$aoUsers = 'aoUSers';
    if($carID == 0){
        //$res = $AO_DB->query("UPDATE car_id FROM aousers WHERE user_id = '$uid'");
        //return json_encode($res ? true : false);
    }
    elseif(hasCar($carID)){
        //$res = $AO_DB->con->prepare("UPDATE car_id FROM $aoUsers WHERE user_id = ?");
        //if($res){
            //if($res->bind_params('i', $uid)){
                //$res->execute()
                //return json_encode();
            //}
        //}
        //else{
            //$res = $AO_DB->query("UPDATE car_id FROM aousers WHERE user_id = '$uid'");
        //}
        //return json_encode($res ? $carID : false);
    }
    //else not valid car ID, do nothing
    //return json_encode(false);
}
/*function echoUserCars(){
    //selects all vehicles the user owns, returning it as a JSON array
    global $aoUsersDB;
    
    $userID = 'user' . strval(0);   //$_SESSION['userID'];
    $res = $aoUsersDB->query(
        "SELECT * FROM $userID"
    );
    
    if($res){
        $cars = array();
        
        while($row = mysqli_fetch_array($res) ){
            $cars[] = array(
                'carID' => intval($row['car_id']),
                'drivetrain' => intval($row['drivetrain']),
                'body' => intval($row['body']),
                'interior' => intval($row['interior']),
                'docs' => intval($row['docs']),
                'repairs' => intval($row['repairs'])
            );
        }
        mysqli_free_result($res);
        echo json_encode($cars);
    }
    else{   //The vehicle is already registered
        //echo "<p class='error'>User: has no entries in database</p>";
        echo '{"cars":[]}';
    }
}
*/
$q = '';

/*if(isset($_GET) && !empty($_GET) ){
    //args being passed vai the url
    if(isset($_GET['op']) && $_GET['op'] == 'asc'){
        getAuctionCars();
        exit();
    }
}*/
if(isset($_POST) && !empty($_POST) ){
    if(isset($_POST['carID'])){
        $carID = $_POST['carID'];   //intval(trim($_POST['carID']));
        //validate value, must be an int!
        //echo json_encode($carID);

        //switch the operation besed on value passed in url
        if(isset($_GET) && !empty($_GET) ){
            //args being passed via the url
            if(isset($_GET['op']) ){
                if($_GET['op'] == 'insert'){
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
                        $tableName = 'user' . strval(0);    //$_SESSION['userID'];
                        $res = false;
                       
                        $res = $aoUsersDB->query(
                            "INSERT INTO $tableName
                                (car_id, drivetrain, body, interior, docs, repairs)
                            VALUES
                                ($carID, 0,0,0,0,0)"
                            //IF entry EXISTS do nothing
                        );
                        echo json_encode($res);
                    }
                    exit();
                }
                elseif($_GET['op'] == 'update'){
                    //inserts a car with carID from the vehicle database into the
                    //logged in user's table in aoUsersDB
                    $dt = intval($_POST['dt']);
                    $body = intval($_POST['body']);
                    $inter = intval($_POST['interior']);
                    $docs = intval($_POST['docs']);
                    
                    $rep = intval($_POST['repairs']);
                    
                    $tableName = 'user' . strval(0);    //$_SESSION['userID'];
                    
                    $res = $aoUsersDB->query(
                        "UPDATE $tableName SET drivetrain=$dt, body=$body, interior=$inter, docs=$docs, repairs=$rep WHERE car_id = $carID"
                    );
                    echo json_encode($res);
                }
                //else switch to other calls
                exit();
            }
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
    //other post vars
}
else{
    //no passing any values via POST, return all cars
    //echoUserCars();
}
?>