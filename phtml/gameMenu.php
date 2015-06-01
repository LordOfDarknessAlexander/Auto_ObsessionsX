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
		<div id='slots' style='margin-top: 32%; height: 22%; width: 30%; left: 2%;' >
		<!--	<a id ='slots' style='margin-top: -26%; height: 18%; width: 40%;' href='Slots/index.html' target="_blank">Slots</a><br/>  -->
		<!--	<a id ='slots' style='margin-top: -26%; height: 18%; width: 40%;' class='button playSlots'>Slots</a><br/>  --->
			<a id ='slots'  href='slots.php' target="_blank">Slots</a>
			
		</div>
    <!--Root Game Menu, hub for page navigation-->
    <!--img id='homeImg' src='images\\garageEmpty.png'-->
	
	
    <div id='menuLeft'>
        <button id ='myCars'>My Garage</button><br/>
        <button id='toAuctionBtn'>Go to Auction</button><br/>
		
    </div>
    <div id='menuRight'>
	   <button id='profile'>My Profile</button><br/>
       <button id='buyUpgradesBtn'>Buy Upgrades</button><!--link to another/separate page?-->
    </div>
	
    <!--img id='adBar'-->
</div><!--end Game Menu-->
	