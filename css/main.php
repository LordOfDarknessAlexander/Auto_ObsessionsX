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
	left:5%;
	bottom:12%;
    width:15%;
    height:60%;
	
}
<?php divMain();?> div#menuRight
{<?php
    posAbs();
    defaultColor();
?>
	right:5%;
    bottom:12%;
    width:15%;
    height:60%;
}
<?php divMain();?> button#myCars
{<?php
    posAbs();
    css::defaultBG('../images/garageBtn.png');
    css::bgSize('100%', '100%');
    //garageBtnBG();
    //defaultColor();
    fontBold();
    //cursorPtr();
    css::size('95%', '48%');
?>
    top:0%;
    left:0%;
}
<?php divMain();?> div button#toAuctionBtn
{<?php
    posAbs();
    //auctionBtnBG();
    css::defaultBG('../images/auctionBtn.png');
    css::bgSize('100%', '100%');
    
    //defaultColor();
    fontBold();
    //cursorPtr();
    css::size('95%', '48%');
?>
    top:52%;
    left:0%;
}
<?php divMain();?> div button#profile
{<?php
    posAbs();
    css::defaultBG('../images/profileBtn.png');
    css::bgSize('100%', '100%');
    //profileBtnBG();
    //defaultColor();
    fontBold();
    //cursorPtr();
    css::size('95%', '48%');
?>
    top:0%;
    right:0%;
}
<?php divMain();?> div button#buyUpgradesBtn
{<?php
    posAbs();
    css::defaultBG('../images/repairBtn.png');
    css::bgSize('100%', '100%');
    //repairBtnBG();
    //defaultColor();
    fontBold();
    //cursorPtr();
    css::size('95%', '48%');
?>
	top:52%;
    right:0%;
}