<?php
//main menu.php, uses php to generate CSS, previously GameMenu.css
//header("Content-type: text/css; charset: UTF-8");
//
require_once 'ui.php';
//using php require should be faster than css @import
require_once 'AuctionSelect.php';
require_once 'repair.php';
require_once 'funds.php';
require_once 'Garage.php';

    
function divMain(){
    echo 'div#gameMenu';
}
function divStatBar(){
    echo 'div#statBar';
}
?>

<?php divMain();?>
{
<?php
    defaultBG();
    posAbs();
    css::size('100%', '100%');
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
}/*
< divMain();?> div
{php
    //rule for all div elements inide Main
    posAbs();
    defaultColor();
?>
    background-color:grey;
	top:40%;
    width:
}*/
<?php divMain();?> div#menuLeft
{<?php
    posAbs();
    defaultColor();
?>
    background-color:grey;
	left:5%;
	top:40%;
    width:20%;
    height:50%;
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
    background-color:grey;
	right:5%;
	top:40%;
    width:20%;
    height:50%;
}
<?php divMain();?> div button
{<?php
    defaultBtnBG();
    defaultColor();
    fontBold();
    cursorPtr();
    css::size('100%', '50%');
?>
}
/* Stat Bar Game HUD */
<?php divStatBar();?>
{<?php
    posAbs();
    css::size('96%', '20px');   //height needs to be hard coded, or funky effects happen with the text
?>
    background-color:red;
	top:20%;
	left:2%;
	
	/*child elements inherit values, unless otherwise specified*/
	font-family:"Kozuka Gothic Pro B";
	text-align:left;

	color:white;
	/*font-weight: bold;
	font-size:1rem;*/
}
<?php divStatBar();?> label
{<?php
    posAbs();
?>
    width:25%;
    font-size:1em;
}
<?php divStatBar();?> label#money{left:0%;}
<?php divStatBar();?> label#tokens{left:20%;}
<?php divStatBar();?> label#prestige{left:40%;}
<?php divStatBar();?> label#m_marker{left:60%;}
<?php divStatBar();?> label#fname{left:80%;}
/*game menu navigation buttons*/

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