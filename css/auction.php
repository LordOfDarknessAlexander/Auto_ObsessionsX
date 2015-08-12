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
<?php divAuction();?>
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

<?php divAuction();?> li{
	padding: 5px 0;
}

<?php divAuction();?> button#auctionBackButton{
<?php
    posAbs();
    css::fontBold();
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
    css::fontBold();
    //css::size('12%', '5%');
    //css::left();
    //css::bottom();
?>
	width:18%;
	height:5%;
	left:1%;
	bottom:30%;
}

<?php divAuction();?> button#buyout
{<?php
    defaultBtnBG();
    posAbs();
    css::fontBold();
    //css::size();
    //css::left();
    //css::bottom();
?>
	width:12%;
	height:5%;
	left:5%;
	bottom:23%;
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
<?php divAuction();?> label#carName
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
<?php divAuction();?> div#pbCD{
<?php
    posAbs();
    css::size('18%', '30%');
    css::right('1%');
    css::top('55%');
?>
}
<?php divAuction();?> div#pbCD progress{
    width:100%;
}
<?php divAuction();?> label#going
{<?php
    css::fontBold();
    defaultColor();
    posAbs();
	css::size('20%','5%');
    css::right('0%');
    css::top('35%');
	css::txtAlignCntr();
?>
	background-image:url('../images/checkers.png');
}