<?php
//auction state stylings
require_once 'ui.php';
//
//css::header();
//    
function divAS(){?>div#AuctionSelect<?php
}
function lih(){?>   height:64px;
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
<?php divAS();?> div#carView{
<?php
    posAbs();
    css::size('90%', '70%');
    scrollY();
?>
    bottom:0%;
    left:10%;
}
<?php divAS();?> div#filter
{
    font-size:1.5vw;
<?php
    posAbs();
    css::txtAlignL();
?>
	left:0%;
    top:30%;
	width:10%;
}
/*
Tint divs different colours for different classes
*/
<?php divAS();?> div.classic label#infoLabel{
<?php css::bgColor('yellow');?>
}
<?php divAS();?> div.muscle label#infoLabel{
<?php css::bgColor('black');?>
}
<?php divAS();?> div.custom label#infoLabel{
<?php css::bgColor('blue');?>
}
<?php divAS();?> div.unique label#infoLabel{
<?php css::bgColor('white');?>
}
<?php divAS();?> div.foreign label#infoLabel{
<?php css::bgColor('orange');?>
}

<?php divAS();?> div.lost label#infoLabel{
<?php css::bgColor('red');?>
}
<?php divAS();?> div.isf label#infoLabel{
<?php css::bgColor('grey');?>
}
<?php divAS();?> div.owned label#infoLabel{
<?php css::bgColor('green');?>
}

<?php divAS();?> div#carView div button
{
	background: url('../images/defaultBtn2.png') no-repeat 0 0;
	background-size : 100% 100%;
<?php
    posAbs();
    //rz();
?>
	right:0%;
<?php lih();?>
	width:15%;
	color:red;
    /*z-index:5;*/
}
/**/
<?php divAS();?> div#carView div
{
	/*margin:35px 0% 35px 0%;	*/
	/*top right bottom left   this line should cause the code to break, invalid css*/
	/*padding: 50px 50px;
	display:inline;*/
	/*margin : 2%;*/
    background: url('../images/label.jpg');
<?php lih();?>
}
<?php divAS();?> div#carView div img
{
<?php posAbs();?>
	left:0%;
	width:128px;
<?php lih();?>
}
<?php divAS();?> div#carView div label#infoLabel
{
	opacity:0.70;
	text-align:center;
<?php posAbs();?>
	left:128px;
	width:70%;
<?php lih();?>
}
/*
<php divAS();> ul
{
    /*position:absolute;
    top:0%;
    left:0%;
	margin:0;
	padding:0;
	list-style-type:none;
}
<php divAS();> li{

	/*margin:35px 0% 35px 0%;	
	/*top right bottom left   this line should cause the code to break, invalid css
	/*padding: 50px 50px;
	display:inline;
	/*margin : 2%;
    background: url('../images/label.jpg');
<php lih();>
}
<php divAS();> li img
{
<php posAbs();>
	left:0%;
	width:128px;
<php lih();>
}
<php divAS();> li label#infoLabel
{
	opacity:0.70;
	text-align:center;
<php posAbs();>
	left:128px;
	width:70%;
<php lih();>
}
*/