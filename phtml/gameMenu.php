<div id='gameMenu'>
<script type="text/javascript" src="//code.jquery.com/jquery-2.1.0.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!--Root Game Menu, hub for page navigation-->
    <h1>My Home</h1>
    <!--HUD ---->
<!--	<div id="fname" ></div>-->
<?php require_once 'include/statBar.php';?>  
<?php require_once 'secure.php';?>
<?php
session_start();
echo '<h2>Welcome to Auto-Obsessions\' Page ';
if (isset($_SESSION['fname']))
{
	echo "{$_SESSION['fname']}";
}
echo '</h2>';
?>

    <img id='homeImg' src='images\\garageEmpty.png'>
    <div id='menuLeft'>
        <button id='myCars'>My Garage</button><br>
        <button id='toAuctionBtn'>Go to Auction</button><br>
    </div>
	 <div id='menuRight'>
	   <button id='profile'>My Profile</button><br>
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
    <img id='adBar'>
</div><!--end Game Menu-->