<?php
//auction state stylings
header("Content-type: text/css; charset: UTF-8");
//    
function divAuction(){
    echo 'div#Auction';
}
require_once 'ui.php';
?>
<?php divAuction();?>
{	/*Auction page stylings*/ 
	/*background: url('../images/defaultBG.jpg') no-repeat 0 0;*/
<?php
    posAbs();
?>
	display: none;
	text-align: center;
	padding-top: 92px;
	z-index: 1;
	width: 900px;
	height: 600px;
}

<?php divAuction();?> li 
{
	padding: 5px 0;
}

<?php divAuction();?> button#auctionBackButton
{<?php
    posAbs();
    fontBold();
    cursorPtr();
    defaultColor();
    defaultBtnBG();
?>
	width:150px;
	height:50px;
	
	bottom:0%;
	left:5%;
}
<?php divAuction();?> #bid
{<?php
    defaultBtnBG();
    posAbs();
    fontBold();
    cursorPtr();
?>
	color: white;

	width:150px;
	height:50px;
	left:10%;
	bottom:30%;
}
<?php divAuction();?> label#carPrice
{<?php
    posAbs();
?>
	background:black;
	color:white;

	width:150px;
	height:50px;

	left:10%;
	bottom:40%;
}

<?php divAuction();?> label#carInfo
{<?php
    fontBold();
    defaultColor();
    posAbs();
?>
	background-image:url('../images/checkers.png');

	width:60%;
	height:20%;

	right:20%;
	bottom:0%;
}
<?php divAuction();?> img#auctionCar
{
<?php
    posAbs();
?>
	width:40%;
	height:40%;
	top:30%;
	left:30%;
}