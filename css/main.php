<?php
//main menu.php, uses php to generate CSS, previously GameMenu.css
//header("Content-type: text/css; charset: UTF-8");
//
require_once 'ui.php';
//using php require should be faster than css @import
require_once 'AuctionSelect.php';
require_once 'repair.php';
require_once 'funds.php';   //move to repair
//require_once 'garage.php';
//    
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
    width:50%;
	margin-bottom: 2%;
}*/
<?php divMain();?> div#menuLeft
{<?php
    posAbs();
    defaultColor();
?>
    //background-color:grey;
	left:2%;
	bottom:12%;
    width:20%;
    height:50%;
	
}
<?php divMain();?> img#homeImg
{<?php
    posAbs();
    css::size('56%', '54%');
?>
	left:22%;
	bottom:12%;
}
<?php divMain();?> div#menuRight
{<?php
    posAbs();
    defaultColor();
?>
   // background-color:grey;
	right:2%;
	/*top:40%;*/
    bottom:12%;
    width:20%;
    height:50%;
}
<?php divMain();?> button#myCars
{<?php
    css::defaultBG('../images/garageBtn.png');
    css::bgSize('100%', '100%');
    //garageBtnBG();
    //defaultColor();
    fontBold();
    //cursorPtr();
    css::size('75%', '50%');
?>
	margin-top : -6%;
	margin-bottom : 6%;
	margin-left: -6%;
}
<?php divMain();?> div button#toAuctionBtn
{<?php
    //auctionBtnBG();
    css::defaultBG('../images/auctionBtn.png');
    css::bgSize('100%', '100%');
    
    //defaultColor();
    fontBold();
    //cursorPtr();
    css::size('75%', '50%');
?>
	margin-left: -6%;
}
<?php divMain();?> div button#profile
{<?php
    css::defaultBG('../images/profileBtn.png');
    css::bgSize('100%', '100%');
    //profileBtnBG();
    //defaultColor();
    fontBold();
    //cursorPtr();
    css::size('75%', '50%');
?>
	margin-top : -6%;
	margin-bottom : 6%;
	margin-left: 6%;
}
<?php divMain();?> div button#buyUpgradesBtn
{<?php
    css::defaultBG('../images/repairBtn.png');
    css::bgSize('100%', '100%');
    //repairBtnBG();
    //defaultColor();
    fontBold();
    //cursorPtr();
    css::size('75%', '50%');
?>
	margin-left: 6%;
}