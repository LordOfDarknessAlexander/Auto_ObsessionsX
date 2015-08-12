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
function dasCV(){divAS();?> div#carView<?php
}
?>
/*
Action Select UI stylings
*/
<?php divAS();?>
{	/*Auction page stylings*/ 
<?php
    posAbs();
    css::defaultTileBG();
    css::size();
?>
	display: none;
	/*overflow:scroll;*/
	text-align: center;
	padding-top: 92px;
	z-index: 1;
}
<?php dasCV();?>{
<?php
    posAbs();
    css::size('90%', '70%');
    scrollY();
?>
    bottom:0%;
    left:10%;
}
/*
Tint divs different colours for different classes
*/
<?php dasCV();?> div:hover{
    border:2px green solid;
}
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

<?php dasCV();?> div button{
	background: url('../images/defaultBtn2.png') no-repeat 0 0;
	background-size : 100% 100%;
<?php
    posAbs();
    //rz();
    lih();
?>
	right:0%;
	width:15%;
	color:red;
    /*z-index:5;*/
}
/**/
<?php dasCV();?> div{
<?php lih();?>
	/*margin:35px 0% 35px 0%;	*/
	/*top right bottom left   this line should cause the code to break, invalid css*/
	/*padding: 50px 50px;
	display:inline;*/
    background: url('../images/label.jpg');
}
<?php dasCV();?> div img{
<?php
    posAbs();
    lih();
    css::left('0%');
?>
	width:128px;
}
<?php dasCV();?> div label#infoLabel{
<?php
    posAbs();
    lih();
    fontBold();
    css::txtAlignCntr();
    css::width('70%');
    css::left('128px');
    //margin:2.5% 0% 0% 0%;
?>
	opacity:0.70;
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