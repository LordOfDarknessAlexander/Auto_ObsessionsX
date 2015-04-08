<?php
//require_once '../include/security.php'
require_once './include/dbConnect.php';
require_once './vehicles/vehicle.php';
require_once 'AO_UI.php';

function sqlSelectAll($tableName, $callbackStr){
    //$tableName: string name of the table in the database to query
    //$callbackStr: string name of a user defined function to be called!
    //queries the data base, selecting all elements and preforming callback on each
     global $AO_DB;
    $s = 'stage';
    $users = 'users';
    $UID = 'user_id';
    //$id = getUID();
    //get the user's current stage/tier
    //$res = $AO_DB->query(
        //"SELECT $s FROM $users WHERE $UID = $id"
    //);
    
    //if($res){
        $stage = 'muscle';   //$res->fetch_assoc()[$s];
        //select only cars of the type matching the user's stage
        $res = $AO_DB->query(
            "SELECT * FROM $tableName"
            //"SELECT * FROM $tableName WHERE type = '$stage'"
        );
        if($res){
            $index = 0;
            
            while($row = mysqli_fetch_array($res) ){
                call_user_func($callbackStr, array($row, $index) );
                $index++;
            }
            $res->close();
        }
        //$res->close();
    //}
    //else{
        //no result!
    //}
}
function outputCar($args){
    //generates the html for a vehicle entry
    $i = $args[1];
    $istr = strval($i);
    $btnID = 'as' . $istr;
    $liID = 'asli' . $istr;
    $car = Vehicle::fromArray($args[0]);
    //if()
?>
<li id='<?php echo $liID;?>' class='<?php echo $car->getType();?>'> 
    <img src='<?php echo $car->getFullPath();?>'>
    <label id='infoLabel'><?php echo $car->getFullName();?><!---<br><php echo $car->getInfo();?--></label>
    <button id='<?php echo $car->getID();?>'>
        <label id='price'>$<?php echo $car->getPrice();?></label><br>
        Bid Now!<br>
    </button>
</li><br>
<?php
}
?>
<div id='AuctionSelect'>
    <!--view all available auctions-->
    <h1>Auction Select</h1>
<?php backBtn();?>
    <div id='carView'>
        <ul id='auctionCars'>
<?php
//selects all elements from aoCars,
//then preforms outputCar on each of its elements
//sqlSelectAll('aoCars', 'outputCar');
?>
        </ul>
    </div>
</div>

<div id='Auction'>
    <!--User and AI bid on a car-->
    <!--h1>Auction</h1-->
    <label id='carName'>--Name--</label>
<?php
    backBtn();
    homeBtn();
?>
    <button id='bid'>"Bid:money"</button>
    <!--button id='buyout'>Buyout</button-->
    <!--auctionCar will be <img id=userCar'>.
    The code can be streamlined with jQuery in JS-->	
    <!--label id='carPrice'></label-->
    <label id='carInfo'></label>
</div>

<div id='AuctionSell'>
    <!--user sells one of their cars, biding open only to AI-->
    <h1>Auctioned Cars</h1>
<?php
    backBtn();
    homeBtn();
?>
    <div id='carView'>
        <!--ul id='auctionCars'>
            <!--populated by application with format:
            <img><label></><button></>>
        </ul-->
    </div>
</div>