<?php
//main menu.php, uses php to generate CSS
header("Content-type: text/css; charset: UTF-8");
//
//require_once('AuctionSelect.php');
//require_once('repair.php');
//require_once('funds.php');
//require_once('Garage.php');
    
function divMain(){
    echo 'div#gameMenu';
}
function defaultBG(){
    echo "background:url('../images/defaultBG.jpg') no-repeat 0 0;";
}
function defaultBtnBG(){
    echo "background:url('../images/defaultBtn.png') no-repeat 0 0;";
}
function defaultColor(){
    echo 'color:red;';
}
function fontBold(){
    echo 'font-weight:bold;';
}
function posAbs(){
    echo 'position:absolute;';
}
function cursorPtr(){
    echo 'cursor:pointer;';
}
?>
@import url("AuctionSelect.css");
/*@import url("repair.css");*/
@import url("funds.css");
@import url("garage.css");
/*vehicles.css");
projects.css");
garage.css");
partsSupply.css");
repair.css");

div#gameMenu */
<?php divMain();?>
{
<?php
    defaultBG();
    posAbs();
?>
    display: none;
	text-align: center;
	padding-top: 92px;
	z-index: 1;
	width: 900px;
	height: 600px;
}
<?php divMain();?> li 
{
	padding: 10px 0;
	display:inline;
	margin: 8px;
<?php defaultColor();?>
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
?>
	height:50%;
	width:50%;
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
?>
	width:150px;
	height:50px; 
}
/* Stat Bar Game HUD */

div#statBar
{<?php
    posAbs();
?>
	top:30%;
	left:2%;
	width:100%;
	height:5%;
	/*child elements inherit values, unless otherwise specified*/
	font-family:"Kozuka Gothic Pro B";
	text-align:left;

	color:white;
	/*font-weight: bold;
	font-size:1.2em;*/
}
div#statBar label
{<?php
    posAbs();
?>
    width:25%;
}
div#statBar label#money{left:0%;}
div#statBar label#tokens{left:25%;}
div#statBar label#prestige{left:50%;}
div#statBar label#mileMarker{left:75%;}

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
?>
	color:  white;
	
	width:150px;
	height:50px;
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