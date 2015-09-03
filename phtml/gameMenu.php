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
		<div id='slots' style='top: 72%; height: 22%; width: 34%; left: 2%;' >
			<a id ='slots'  href='slots.php'>Slots</a>  
			
		</div> 
    <!--Root Game Menu, hub for page navigation-->
    <!--img id='homeImg' src='images\\garageEmpty.png'-->
	
	
    <div id='menuLeft'>
        <button id ='myCars' title='My Garage is friggin amazing man'>My Garage</button>
        <button id='toAuctionBtn'>Go to Auction</button>		
    </div>
    <div id='menuRight'>
	   <button id='profile'>My Profile</button>
       <button id='buyUpgradesBtn'>Buy Upgrades</button><!--link to another/separate page?-->
    </div>
	
    <!--img id='adBar'-->
</div><!--end Game Menu-->
	