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
    <!--Root Game Menu, hub for page navigation-->
    <h1>My Home</h1>
    <!--img id='homeImg' src='images\\garageEmpty.png'-->

    <div id='menuLeft'>
        <button id ='myCars'>My Garage</button><br/>
        <button id='toAuctionBtn'>Go to Auction</button><br/>
    </div>
    <div id='menuRight'>
	   <button id='profile'>My Profile</button><br/>
       <button id='buyUpgradesBtn'>Buy Upgrades</button><!--link to another/separate page?-->
         <!-- 
		<button id='partsSupplyBtn'>Select Parts Supply</button><br>
		<button id='myGarageBtn'>My shop</button><br>
        <button id='messages'>My Messages</button><br>
        <button id='rankings'>Rankings</button><br>
        <button id='search'>Search</button><br>
		<button id='FAQ/Tutorial'>FAQ/Tutorial</button><!--link to another/separate page?-->
    <!--    <button id='buyBusiness'>Buy Business</button><br>--->
    </div>
    <!--img id='adBar'-->
</div><!--end Game Menu-->