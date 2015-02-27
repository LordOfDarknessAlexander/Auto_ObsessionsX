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
<?php divAuction();?> #bid
{<?php
    defaultBtnBG();
    posAbs();
    fontBold();
    //css::size('12%', '5%');
?>
	width:12%;
	height:5%;
	left:85%;
	bottom:60%;
}

<?php divAuction();?> button#buyout
{<?php
    defaultBtnBG();
    posAbs();
    fontBold();
?>
	width:12%;
	height:5%;
	left:85%;
	bottom:56%;
}
<?php divAuction();?> label#carPrice
{<?php
    posAbs();
?>
	background:black;
	color:white;

	width:12%;
	height:5%;

	left:85%;
	bottom:40%;
}

<?php divAuction();?> label#carInfo
{<?php
    fontBold();
    defaultColor();
    posAbs();
?>
	background-image:url('../images/checkers.png');

	width:100%;
	height:20%;

	left:5%;
	bottom:0%;
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
<?php divAuction();?> div#statBar{
{
    /*background-color:red;*/
	background: url('../images/StatBar.png') no-repeat 0 0;
	background-size : 100%,40%;
	position:absolute;
	top:30%;
	left:6%;
	width:90%;
	height:35%;
	/*child elements inherit values, unless otherwise specified*/
	font-family:"Kozuka Gothic Pro B";
	text-align:left;
	color:white;
	/*font-weight: bold;
	z-index : 6;
	font-size:1.2em;*/
}
div#statBar label{
    position:absolute;
    width:25%;
}
div#statBar label#money{left:0%;top:75%;}
div#statBar label#tokens{left:25%;top:75%;}
div#statBar label#prestige{left:50%;top:75%;}
div#statBar label#m_marker{left:75%;top:75%;}
}