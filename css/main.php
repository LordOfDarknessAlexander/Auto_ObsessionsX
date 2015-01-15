<?php
//main menu.php, uses php to generate CSS, previously GameMenu.css
header("Content-type: text/css; charset: UTF-8");
//
require_once 'ui.php';
//require_once('AuctionSelect.php');
//require_once('repair.php');
//require_once('funds.php');
//require_once('Garage.php');
    
function divMain(){
    echo 'div#gameMenu';
}
function divStatBar(){
    echo 'div#statBar';
}
?>
@import url("AuctionSelect.css");
@import url("repair.css");
@import url("funds.css");
@import url("garage.css");
/*vehicles.css");
projects.css");
garage.css");
partsSupply.css");
repair.css");
 */
<?php divMain();?>
{
<?php
    defaultBG();
    posAbs();
    css::size('900px', '600px');
?>
    display: none;
	text-align: center;
	padding-top: 92px;
	z-index: 1;
}
<?php divMain();?> li 
{
<?php defaultColor();?>
	padding: 10px 0;
	display:inline;
	margin: 8px;

	margin-top: 8em;
	top: 20%;
}
<?php divMain();?> div#menuLeft
{<?php
    posAbs();
    defaultColor();
?>
	left:5%;
	top:40%;
}
<?php divMain();?> img#homeImg
{<?php
    posAbs();
    css::size('50%', '50%');
?>
	left:25%;
	bottom:12%;
}
<?php divMain();?> div#menuRight
{<?php
    posAbs();
    defaultColor();
?>
	right:5%;
	top:40%;
}
<?php divMain();?> div button
{<?php
    defaultBtnBG();
    defaultColor();
    fontBold();
    cursorPtr();
    css::size('150px', '50px');
?>
}
/* Stat Bar Game HUD */
<?php divStatBar();?>
{<?php
    posAbs();
    css::size('100%', '5%');
?>
	top:30%;
	left:2%;
	
	/*child elements inherit values, unless otherwise specified*/
	font-family:"Kozuka Gothic Pro B";
	text-align:left;

	color:white;
	/*font-weight: bold;
	font-size:1.2em;*/
}
<?php divStatBar();?> label
{<?php
    posAbs();
?>
    width:25%;
}
<?php divStatBar();?> label#money{left:0%;}
<?php divStatBar();?> label#tokens{left:25%;}
<?php divStatBar();?> label#prestige{left:50%;}
<?php divStatBar();?> label#mileMarker{left:75%;}

/*game menu navigation buttons*/
#auction
{
	background: url('../images/auctionButton.png') no-repeat 0 0;
	color: white;
	font-weight: bold;
	font-size: 1em;
	width:150px;
	height:50px; 
	cursor:pointer;
	
}
#repair
{
	background: url('../images/repairButton.png') no-repeat 0 0;
	color:red;
	font-weight: bold;
	width:150px;
	height:50px;
	cursor:pointer;
}
#addFunds
{<?php
	defaultBtnBG();
    fontBold();
    cursorPtr();
    css::size('10%', '10%');
?>
	color:white;
}
#myCars
{
	background: url('../images/inventoryButton.png') no-repeat 0 0;
	color:  white;
	font-weight: bold;
	width:150px;
	height:50px;
	cursor:pointer; 
}