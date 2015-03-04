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
	background-size : 100% 100%;
	display: none;
	/*overflow:scroll;*/
	text-align: center;
	/*padding-top: 92px;*/
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
<?php divAS();?> div
{
	margin:0 0 0% 0;	/*top right bottom left*/
	/*padding: 50px 50px;
	display:inline;*/
    height:15%;
}
<?php divAS();?> div label#carInfo
{
	background-color:grey;
	text-align:center;
<?php posAbs();?>
	left:20%;
	width:50%;
	height:15%;
}
<?php divAS();?> div button
{
	background: url('../images/defaultBtn.png') no-repeat 0 0;
	background-size : 100% 100%;
<?php posAbs();?>
	height:15%;
	width:10%;
	color:red;
    right:20%;
}
<?php divAS();?> div button#view
{
    background: url('../images/view.png') no-repeat 0 0;
    background-size:100% 100%;
    right:10%;
}
<?php divAS();?> div button#cc
{
    background: url('../images/cancel.jpg') no-repeat 0 0;
    background-size:100% 100%;
    right:0%;
}
<?php divAS();?> div button label
{
	font-size:1.25em;
	background-size: 100% 100%;
	/*font-family::;
	display:inline;
	position:absolute;*/
	text-align::center;
	color:red;
}
<?php divAS();?> div img
{
<?php posAbs();?>
	left:0%;
	width:20%;
	height:15%;
}
<?php divAS();?> div#carView
{
<?php posAbs();?>
    overflow-y:scroll;
    bottom:0%;
    left:10%;
    width:80%;
    height:70%;
}