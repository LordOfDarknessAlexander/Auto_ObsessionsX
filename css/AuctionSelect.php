<?php
//auction state stylings
require_once 'ui.php';
//
css::header();
//    
function divAS(){?>div#AuctionSelect
<?php
}
function lih(){?>
    height:64px;
<?php
}
//function dasCV(){
    //echo 'div#AuctionSelect div#carView';
//}
?>
/*
Action Select UI stylings
*/
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
    /*position:absolute;
    top:0%;
    left:0%;*/
	margin:0;
	padding:0;
	list-style-type:none;
}
<?php divAS();?> div#carView{
<?php
    posAbs();
    css::size('90%', '70%');
    scrollY();
?>
    bottom:0%;
    left:10%;
}
<?php divAS();?> li
{
	/*margin:70px 0% 5% 0;	*/
	top right bottom left
	/*padding: 50px 50px;*/
	display:inline;
<?php lih();?>
}
<?php divAS();?> li img
{
<?php posAbs();?>
	left:0%;
	width:128px;
<?php lih();?>
}
<?php divAS();?> li label#infoLabel
{
	background: url('../images/label.png');
	text-align:center;
<?php posAbs();?>
	left:128px;
	width:70%;
<?php lih();?>
}
<?php divAS();?> li button
{
	background: url('../images/defaultBtn.png') no-repeat 0 0;
	background-size : 100% 100%;
<?php
    posAbs();
    //rz();
?>
	right:0%;
<?php lih();?>
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
    cursor:pointer;
}