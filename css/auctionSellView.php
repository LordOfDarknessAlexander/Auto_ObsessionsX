<?php
//auction state stylings
//header("Content-type: text/css; charset: UTF-8");
//    
require_once 'ui.php';
//
css::header();
//
function divAuction(){?>div#Auction<?php
}
?>
/*
Auction Screen
*/
<?php divAuctionSellView();?>
{	/*Auction page stylings*/ 
	/*background: url('../images/defaultBG.jpg') no-repeat 0 0;*/
<?php
    posAbs();
    //css::size('100%, '100%');
?>
	display: none;
	text-align: center;
	padding-top: 92px;
	z-index: 10;
	width: 100%;
	height: 100%;
}

<?php divAuctionSellView();?> li 
{
	padding: 5px 0;
}

<?php divAuctionSellView();?> button#auctionBackButton
{<?php
    posAbs();
    css::fontBold();
    defaultBtnBG();
?>
	width:150px;
	height:50px;
	
	bottom:0%;
	left:5%;
}



/*<php divAuctionSellView();> label#carPrice
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

<?php divAuctionSellView();?> label#carInfo
{<?php
    css::fontBold();
    defaultColor();
    posAbs();
    scrollY();
    //css::size();
?>
    display:block;
	background-image:url('../images/checkers.png');

	width:60%;
	height:12%;

	left:20%;
	bottom:0%;
}
<?php divAuctionSellView();?> label#carName
{<?php
    css::fontBold();
    defaultColor();
    posAbs();
    //css::size();
?>
	background-image:url('../images/checkers.png');

	width:60%;
	height:10%;

	left:20%;
	top:18%;
    font-size:2vw;
}
