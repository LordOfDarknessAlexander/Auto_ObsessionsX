<?php
//auction sale state stylings
header("Content-type: text/css; charset: UTF-8");
//    
require_once 'ui.php';
//
function divAS(){
    echo 'div#AuctionSell';
}
?>
<?php divAS();?>
{
	background: url('../images/defaultBG.jpg') no-repeat 0 0; 
	display: none;
	/*overflow:scroll;*/
	text-align: center;
	padding-top: 92px;
	z-index: 1;
	width: 100%;
	height: 100%;
<?php posAbs();?>
}
<?php divAS();?> ul
{
	margin:0;
	padding:0;
	list-style-type:none;
}
<?php divAS();?> li
{
	margin:0 0 5% 0;	/*top right bottom left*/
	/*padding: 50px 50px;
	display:inline;*/
}
<?php divAS();?> li label#carInfo
{
	background-color:grey;
	text-align:center;
<?php posAbs();?>
	left:20%;
	width:60%;
	height:20%;
}
<?php divAS();?> li button
{
	background: url('../images/defaultBtn.png') no-repeat 0 0;
<?php posAbs();?>
	right: 5%;
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
<?php divAS();?> li img
{
<?php posAbs();?>
	left:5%;
	width:15%;
	height:20%;
}
<?php divAS();?> div#carView
{
<?php posAbs();?>
    overflow-y:scroll;
    bottom:0%;
    left:15%;
    width:70%;
    height:60%;
}