<?php
//auction state stylings
//header("Content-type: text/css; charset: UTF-8");
require_once 'ui.php';
//
css::header();
//    
function divAS(){
    echo 'div#AuctionSelect';
}
//function dasCV(){
    //echo 'div#AuctionSelect div#carView';
//}
?>
/*Action UI stylings*/
<?php divAS();?>
{	/*Auction page stylings*/ 
<?php
    posAbs();
    defaultBG();
    css::size();
?>
	display: none;
	/*overflow:scroll;*/
	text-align: center;
	padding-top: 92px;
	z-index: 1;
}
<?php divAS();?> ul
{
	margin:0;
	padding:0;
	list-style-type:none;
}
<?php divAS();?> div#carView
{
<?php posAbs();?>
    overflow-y:scroll;
    bottom:0%;
    left:10%;
    width:90%;
    height:70%;
}
<?php divAS();?> li
{
	margin:0 0 5% 0;	
	top right bottom left
	/*padding: 50px 50px;*/
	display:inline;
}
<?php divAS();?> li img
{
<?php posAbs();?>
	left:0%;
	width:15%;
	height:20%;
}
<?php divAS();?> li label#infoLabel
{
	background: url('../images/label.png');
	text-align:center;
<?php posAbs();?>
	left:15%;
	width:70%;
	height:20%;
}
<?php divAS();?> li button
{
	background: url('../images/defaultBtn.png') no-repeat 0 0;
	background-size : 100% 100%;
<?php posAbs();?>
	right:0%;
	height:20%;
	width:15%;
	color:red;
}
<?php divAS();?> li button label
{
	font-size:1.25em;
	/*font-family::;
	display:inline;
	position:absolute;*/
	text-align::center;
	color:red;
}
/*
button#asBackBtn
{
	background: url('../images/backBtn.png') no-repeat 0 0;
    background-size:100% 100%;
	font-weight: bold;
    position:absolute;
	width:16%;
	height:8%;
	cursor:pointer;
    left:42%;
    bottom:66%;
}*/