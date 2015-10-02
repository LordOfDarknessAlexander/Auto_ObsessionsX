<?php
//require_once 'secure.php';
//$scripts = array(
	//'garage',
    //'auction',
    //'profile',
    //'repair',
    
    //messages
    //ranks
    //search
    //business
    //faq
    //'register'
//);
//scripts will be included in the order declared, ORDER MATTERS!
//foreach($scripts as $val){
    //require will look in the absolute path, then relative,
    //then finally the local folder which THIS script is located
    //require_once($val.'.php');
//}

?>

<div id='gameMenu'>
<?php  
/*
if($isSlots)
{
	echo "<div id='Slots' style='margin-top: -66%; height: 30%; width: 60%;' > 
	</div>";
}*/

?>
 
<!--
		<div id='slots' title='Big Jims Crazy Slots' style='top: 72%; height: 22%; width: 34%; left: 2%;' >
			<!--<a id ='slots'  href='slots.php'>Slots</a> -->
			
	<!--	</div>  -->
	
	<!--
	<div id='toSlotsBtn' title='Big Jims Crazy Slots' style='top: 56%; height: 42%; width: 34%; left: 2%;' >
	<!--<button id='toSlotsBtn' title='Slots'>Crazy Slots</button>	-->
	<!--<a id ='toSlotsBtn' class='button playSlots'  ></a>
	</div> -->
    <!--Root Game Menu, hub for page navigation-->
    <!--img id='homeImg' src='images\\garageEmpty.png'-->
	
	
    <div id='menuLeft'>
        <button id ='myCars' title='My Garage'>My Garage</button>
        <button id='toAuctionBtn'  title='Live Auctions'>Go to Auction</button>		
		<button id = 'toSlotsBtn' class='button playSlots' style='bottom: -17%; height: 14%; ' title='Jims Crazy Slots'>Slots</button>
		
    </div>
    <div id='menuRight'>
	   <button id='profile' title='My Profile'>My Profile</button>
       <button id='buyUpgradesBtn'  title='Upgrade your vehicle'>Buy Upgrades</button><!--link to another/separate page?-->
    </div>
	
    <!--img id='adBar'-->
</div><!--end Game Menu-->
	