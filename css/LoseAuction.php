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
<?php divSold();?> button#garageBtn
{
    position:absolute;
	background: url('../images/homeBtn.png') no-repeat 0 0;
	background-size : 100% 100%;
	width:5%;
	height:5%;
	bottom:5%;
    left:5%;
}
<?php divSold();?> label#info
{
	/*background: url('../images/homeBtn.png') no-repeat 0 0;
	background-size : 100% 100%;*/
    position:absolute;
    left:10%;
	width:80%;
	height:20%;
	top: 30%;
    font-size:2vw;
    text-align:center;
}