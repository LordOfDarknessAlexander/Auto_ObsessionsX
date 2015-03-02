<?php
//require_once '../include/security.php'
require_once './include/dbConnect.php';
require_once './vehicles/vehicle.php';

function sqlSelectAll($tableName, $callbackStr){
    //$tableName: string name of the table in the database to query
    //$callbackStr: string name of a user defined function to be called!
    //queries the data base, selecting all elements and preforming callback on each
    global $AO_DB;
    $res = $AO_DB->query('SELECT * FROM ' . $tableName);

    if($res){
        $index = 0;
        while($row = mysqli_fetch_array($res) ){
            call_user_func($callbackStr, array($row, $index) );
            $index++;
        }
        mysqli_free_result($res);
    }
    else{
        //no result!
    }
}
function outputCar($args){
    $i = $args[1];
    $istr = strval($i);
    $btnID = 'as' . $istr;
    $liID = 'asli' . $istr;
    $car = Vehicle::fromArray($args[0]);
?>
<li id='<?php echo $liID;?>'> 
    <img src='<?php echo $car->getFullPath();?>'>
    <label id='infoLabel'><?php echo $car->getFullName();?>-<br><?php echo $car->getInfo();?></label>
    <button id='<?php echo $car->getID();?>'>
        <label id='price'>$<?php echo $car->getPrice();?></label><br>
        Bid Now!<br>
    </button>
</li><br>
<?php
}
?>
<div id='AuctionSelect'>
    <h1>Auction Select</h1>
    <!--<backBtn();>select which car to bid for-->
    <button id='asBackBtn'>Back</button>
    <div id='carView'>
        <ul id='auctionCars'>
<?php
    sqlSelectAll('aoCars', 'outputCar');
?>
        </ul>
    </div>
</div>

<div id='Auction'>
    <h1>Auction</h1>    
    <div style="margin-top:-6em;margin-left:26em">	   
    </div> 
    <!--label id='myCash'>money</label>
    <label id='carPrice'>price</label-->
    <button id='bid'>"Bid:money"</button>
	<button id='buyout'>"Buyout"</button>
    <button id='backBtn'>Back</button>
    <!--<
    backBtn();
    carInfoLabel();
    homeBtn();>-->
    <img id='auctionCar'>
	
    <label id='carPrice'></label>
    <label id='carInfo'></label>
    <button id='homeBtn'>Home</button>	
</div>

<div id='AuctionSell'>
    <h1>Auctioned Cars</h1>
    <!--<backBtn();>select which car to bid for-->
    <button id='backBtn'>Back</button>
    <button id='homeBtn'>Home</button>
    <div id='carView'>
        <ul id='auctionCars'>
            <!--populated by application with format:
            <img><label></><button></>-->
        </ul>
    </div>
</div>