<?php
//auction state stylings
//header("Content-type: text/css; charset: UTF-8");
//    
require_once 'ui.php';
//
css::header();
//
function divAuction(){
    echo 'div#Auction';
}
?>
/*Auction Screen*/
<?php divAuction();?>
{	/*Auction page stylings*/ 
	/*background: url('../images/defaultBG.jpg') no-repeat 0 0;*/
<?php
    posAbs();
	
?>
	display: none;
	text-align: center;
	padding-top: 92px;
	z-index: 10;
	width: 100%;
	height: 100%;
}

<?php divAuction();?> li 
{
	padding: 5px 0;
}

<?php divAuction();?> button#auctionBackButton
{<?php
    posAbs();
    fontBold();
    defaultBtnBG();
?>
	width:150px;
	height:50px;
	
	bottom:0%;
	left:5%;
}
<?php divAuction();?> button#bid
{<?php
    defaultBtnBG();
    posAbs();
    fontBold();
    //css::size('12%', '5%');
?>
	width:19%;
	height:5%;
	left:1%;
	bottom:30%;
}

<?php divAuction();?> button#buyout
{<?php
    defaultBtnBG();
    posAbs();
    fontBold();
?>
	width:12%;
	height:5%;
	left:5%;
	bottom:56%;
}
/*<php divAuction();> label#carPrice
{<php
    posAbs();
>
	background:black;
	color:white;

	width:20%;
	height:5%;

	left:0%;
	top:20%;
}*/

<?php divAuction();?> label#carInfo
{<?php
    fontBold();
    defaultColor();
    posAbs();
?>
	background-image:url('../images/checkers.png');

	width:60%;
	height:12%;

	left:20%;
	bottom:0%;
}
<?php divAuction();?> label#carName
{<?php
    fontBold();
    defaultColor();
    posAbs();
?>
	background-image:url('../images/checkers.png');

	width:60%;
	height:10%;

	left:20%;
	top:18%;
    font-size:2vw;
}
<?php divAuction();?> img#auctionCar
{
<?php
    posAbs();
?>
	width:50%;
	height:50%;
	top:25%;
	left:25%;
}