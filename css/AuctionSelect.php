<?php
//auction state stylings
require_once 'ui.php';
//
css::header();
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
	top right bottom left   /*this line should cause the code to break, invalid css*/
	/*padding: 50px 50px;*/
	display:inline;
    background: url('../images/label.jpg');
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
	opacity:0.70;
	text-align:center;
<?php posAbs();?>
	left:128px;
	width:70%;
<?php lih();?>
}
<?php divAS();?> form#filter
{
	text-align:left;
    font-size:1.5vw;
<?php posAbs();?>
	left:0%;
    top:30%;
	width:10%;
}
/*
Tint divs diffrent colours for diffrent classes
*/
<?php divAS();?> li.classic label#infoLabel{
	background-color:yellow;
}
<?php divAS();?> li.muscle label#infoLabel{
	background-color:green;
}
<?php divAS();?> li.custom label#infoLabel{
	background-color:blue;
}
<?php divAS();?> li.unique label#infoLabel{
	background-color:white;
}
<?php divAS();?> li.foreign label#infoLabel{
	background-color:black;
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
    /*z-index:5;*/
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