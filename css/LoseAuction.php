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
	background-size : 100% 100%;
	display: none;
	text-align: center;
	padding-top: 92px;
	z-index: 1;
	width: 100%;
	height: 100%;
	position: absolute;
	top:0%;
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