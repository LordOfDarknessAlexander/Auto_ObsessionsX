<?php
//Lose Auction UI stylings
header("Content-type: text/css; charset: UTF-8");
//
require_once 'ui.php';
//
function divSold(){
    echo 'div#sold';
}
?>
<?php divSold();?>
{	/*Auction page stylings*/ 
	background: url('../images/inventoryMenu.png') no-repeat 0 0;
	display: none;
	text-align: center;
	padding-top: 92px;
	z-index: 1;
	width: 900px;
	height: 600px;
	position: absolute;
	top:-60%;
}
<?php divSold();?> button
{
	background: url('../images/defaultBtn.png') no-repeat 0 0;
	color: white;
	font-weight: bold;
	width:150px;
	height:50px;
	cursor:pointer;
}