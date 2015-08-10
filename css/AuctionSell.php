<?php
//auction sale state stylings
//header("Content-type: text/css; charset: UTF-8");
//    
require_once 'ui.php';
//
css::header();
//
function divAS(){?>div#AuctionSell<?php
}
function dcv(){divAS();?> div#carView<?php
}
?>
/*
Auction Select Screen
*/
<?php divAS();?>{
<?php
    posAbs();
    css::size('100%', '100%');
    css::defaultTileBG();
    //background: url('../images/defaultBG.jpg') no-repeat 0 0; 
	//background-size : 100% 100%;
?>
	display: none;
	/*overflow:scroll;*/
	text-align: center;
	z-index: 1;
}
<?php divAS();?> ul
{
	margin:0;
	padding:0;
	list-style-type:none;
}
/*
Auction Select Car View
*/
<?php dcv();?>
{
<?php posAbs();?>
    overflow-y:scroll;
    bottom:0%;
    left:10%;
    width:80%;
    height:70%;
}
<?php dcv();?> div{
	margin:0 0 0% 0;	/*top right bottom left*/
	/*padding: 50px 50px;
	display:inline;*/
    height:15%;
   // background-color:grey;
   background:url('../images/label.jpg');
    display:block;
}
<?php dcv();?> div div#btns{
    position:absolute;
    width:10%;
    right:0%;
    height:15%;
    display:block;
}
<?php dcv();?> div label#carInfo{
	/*background-color:green;*/
	text-align:center;
<?php
    posAbs();
    css::size();
?>
	left:15%;
	width:50%;
	height:15%;
    font-weight:bold;
    font-size:1.8vw;
}
<?php dcv();?> div label{
	/*background: url('../images/defaultBtn.png') no-repeat 0 0;*/
	background-size : 100% 100%;
    /*background-color:blue;*/
<?php
    posAbs();
    css::txtAlignL();
?>
	height:15%;
	width:25%;
    left:65%;

    font-size:1.5vw;
    display:block;
}
<?php dcv();?> div label#price{
<?php
    css::txtAlignL();
    css::size('100%', '50%');
?>
    left:0%;
    font-size:1.25vw;
    display:block;
}
<?php dcv();?> div label#expireTime{
<?php
    css::size('100%', '50%');
    css::txtAlignL();
?>
    left:0%;
    font-size:1.25vw;
    display:block;
}
<?php dcv();?> div progress#time{
<?php
    posAbs();
    css::size('50%','5%');
    css::left('15%');
    //css::top('0%');
?>
}
<?php dcv();?> div progress#endTime{
<?php
    posAbs();
    css::size('70%','5%');
?>
	left:15%;
	top:25%;
}
<?php dcv();?> div#btns button#view{
    background: url('../images/icons/view.png') no-repeat 0 0;
    background-size:100% 100%;
    position:absolute;
    top:25%;
    right:50%;
    width:50%;
    height:50%;
    padding:0% 0%;
}
<?php dcv();?> div#btns button#cc{
    background: url('../images/icons/cancel.png') no-repeat 0 0;
    background-size:100% 100%;
    position:absolute;
    top:25%;
    right:0%;
    width:50%;
    height:50%;
    padding:0% 0%;
}
<?php divAS();?> div button label{
	font-size:1.25em;
	background-size: 100% 100%;
	/*font-family::;
	display:inline;
	position:absolute;*/
	text-align::center;
	color:red;
}
<?php dcv();?> div img{
<?php posAbs();?>
	left:0%;
	width:15%;
	height:15%;
}