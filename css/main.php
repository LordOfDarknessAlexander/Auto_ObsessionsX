<?php
//main menu.php, uses php to generate CSS, previously GameMenu.css
//header("Content-type: text/css; charset: UTF-8");
//
require_once 'ui.php';
//
css::header();
//using php require should be faster than css @import
require_once 'AuctionSelect.php';
require_once 'profile.php';
require_once 'repair.php';
//require_once 'garage.php';
//require_once 'carView.php';
//    
function dgm(){
    echo 'div#gameMenu';
}
?>
<?php dgm();?>{
<?php
    posAbs();
    css::size('100%', '100%');
    css::defaultTileBG();
    //background:#000000 url('../images/bgTile.png') repeat 0 0;
?>
    display: none;
	text-align: center;
	padding-top: 92px;
	z-index: 1;
}
<?php dgm();?> li 
{
<?php defaultColor();?>
	padding: 10px 0;
	display:inline;
	margin: 8px;
	margin-top: 8em;
	top: 20%;
}
<?php dgm();?> div{
<?php //rule for all div elements inide Main
    posAbs();
    defaultColor();
?>
    width:15%;
    height:60%;
}
<?php dgm();?> div#menuLeft{
	left:5%;
	bottom:12%;
}
<?php dgm();?> div#menuRight{
	right:5%;
    bottom:12%;

}
<?php dgm();?> div#menuLeft button,
<?php dgm();?> div#menuRight button{
<?php
    posAbs();
    css::size('95%', '48%');
?>
}
<?php dgm();?> div button#myCars{
<?php
    css::defaultBG('../images/garageBtn.png');
    css::bgSize('100%', '100%');
?>
    top:0%;
    left:0%;
}
<?php dgm();?>div#reg-navigation{
 <?php
    defaultBtnBG();
    css::bgSize('100%', '100%');
?>
    position:absolute;
    top:10%;
    right:0%;
}
<?php dgm();?>div#reg-navigation a{
<?php
    defaultBtnBG();
    css::bgSize('100%', '100%');
?>
    display:block;
    color: red;
    font-weight: bold;
    text-decoration: none;
    text-align:center;
	padding : 2%;
    position: relative;
}
/* mouseover */
<?php dgm();?>li a:hover,
<?php dgm();?>div#nav a:hover,
<?php dgm();?>div#reg-navigation a:hover{
	 <?php
    css::defaultBG('../images/defaultBtn2.png');
    css::bgSize('100%', '100%');
?>
  
	color:green;
	padding : 2%;
}
<?php dgm();?> div button#toAuctionBtn
{<?php
    css::defaultBG('../images/auctionBtn.png');
    css::bgSize('100%', '100%');
?>
    top:52%;
    left:0%;
}
<?php dgm();?> div button#profile
{<?php
    css::defaultBG('../images/profileBtn.png');
    css::bgSize('100%', '100%');
?>
    top:0%;
    right:0%;
}
<?php dgm();?> div button#buyUpgradesBtn
{<?php
    css::defaultBG('../images/repairBtn.png');
    css::bgSize('100%', '100%');
?>
	top:52%;
    right:0%;
}