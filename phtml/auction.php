<?php
//require_once '../include/security.php'
require_once './dbConnect.php';
require_once './vehicles/vehicle.php';
require_once 'AO_UI.php';

function sqlSelectAll($tableName, $callbackStr){
    //$tableName: string name of the table in the database to query
    //$callbackStr: string name of a user defined function to be called!
    //queries the data base, selecting all elements and preforming callback on each
     global $AO_DB;
    $s = 'stage';
    $users = ao::USERS;
    $UID = ao::UID;
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
  <!--  <h1>Auction Select</h1>  -->
<?php backBtn();?>
    <div id='filter'><!--action='javascript:void(0)'-->Filters<hr>
        <div id='stage'>stage<br>
            <button id='slctAllF'>All</button><br>
            <button id='slctClassic'>Classic</button><br>
            <button id='slctCustom'>Custom</button><br>
            <button id='slctMuscleF'>Muscle</button><br>
            <button id='slctUnique'>Unique</button><br>
            <button id='slctForeign'>Foreign</button><br>
        </div>
        <!--select id='stage'>
            <option value='All'>All</option>
            <option value='classic'>classic</option>
            <option value='custom'>custom</option>
            <option value='muscle'>muscle</option>
            <option value='foreign'>foreign</option>
            <option value='unique'>unique</option>
        </select-->
        <div id='tier'>tier<br>
            <button id='slctAll'>All</button><br>
            <button id='slctLow'>Low</button><br>
            <button id='slctMid'>Mid</button><br>
            <button id='slctHigh'>High</button><br>
            <button id='slctElite'>Elite</button><br>
            <!--select id='tier'>
            <option value='All'>All</option>
            <option value='low'>low</option>
            <option value='mid'>mid</option>
            <option value='high'>high</option>
            <option value='elite'>elite</option>
        </select-->
        </div>
        <br>
        <!--input id='showDisabled' type='checkbox' value=''>
        display unavailable auctions-->
        <!--input id='submit' type='submit' value='submit'-->
    </div>
    <div id='carView'>
        <!--ul id='auctionCars'-->
<?php
//selects all elements from aoCars,
//then preforms outputCar on each of its elements
//sqlSelectAll('aoCars', 'outputCar');
?>
        <!--/ul-->
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
    <button id='bid'>Bid:money</button>
	<button id='buyout'>Buyout</button> 
    <!--auctionCar will be <img id=userCar'>.
    The code can be streamlined with jQuery in JS-->	
    <!--label id='carPrice'></label-->
	<label id='going'><?php //going once, twice text?></label>
<?php //FOR DEV USE ONLY, not in the final release?>
    <div id='pbCD'>
        <progress id='gcd'><!--global cooldown--></progress>
        <progress id='ai0'></progress>
        <progress id='ai1'></progress>
        <progress id='ai2'></progress>
        <progress id='ai3'></progress>
        <progress id='user'></progress>
		<progress id='winning'></progress>
        <progress id='going'></progress>
    </div> 
	<label id='carInfo'></label>
    <!--div id='bids'>
        <label id='b0'></label>
        <label id='b1'></label>
        <label id='b2'></label>
        <label id='b3'></label>
        <label id='user'></label>
    </div-->
</div>

<div id='AuctionSell'>
    <!--user sells one of their cars, biding open only to AI-->
   <!-- <h1>Auctioned Cars</h1>  -->
<?php
    backBtn();
    homeBtn();
?>
    <div id='carView'>
        <!--ul id='auctionCars'>-->
            <!--populated by application with format:
            <img><label></><button></>>
        </ul-->
    </div>
</div>
<div id='SaleView'>
    <label id='carName'>--Name--</label>
<?php
    backBtn();
    homeBtn();
?>
	<div id='_ai'>
		<div id='ai0' class="first">
			<label id='name'>0</label>
			<label id='bid'>1</label>
		</div>
		<div id='ai1' class="second">
			<label id='name'>1</label>
			<label id='bid'>2</label>
		</div>
		<div id='ai2' class="third">
			<label id='name'>2</label>
			<label id='bid'>3</label>
		</div>
		<div id='ai3' class="fourth">
			<label id='name'>3</label>
			<label id='bid'>4</label>
		</div>
	</div>
	
	<label id='going'><?php //going once, twice text?></label>
	
	<?php //FOR DEV USE ONLY, not in the final release?>
    <div id='pbCD'>
        <progress id='gcd'><!--global cooldown--></progress>
        <progress id='ai0'></progress>
        <progress id='ai1'></progress>
        <progress id='ai2'></progress>
        <progress id='ai3'></progress>
		<progress id='winning'></progress>
        <progress id='going'></progress>
    </div> 
	
    <label id='svCarInfo'></label>  
</div> 