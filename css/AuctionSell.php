<?php
//auction sale state stylings
header("Content-type: text/css; charset: UTF-8");
//    
require_once 'ui.php';
//
function divAS(){
    echo 'div#AuctionSell';
}
function dcv(){
    echo 'div#AuctionSell div#carView';
}
?>
<?php divAS();?>
{
<?php posAbs();?>
	background: url('../images/defaultBG.jpg') no-repeat 0 0; 
	background-size : 100% 100%;
	display: none;
	/*overflow:scroll;*/
	text-align: center;
	z-index: 1;
	width: 100%;
	height: 100%;
    	color:red;
}
<?php divAS();?> ul
{
	margin:0;
	padding:0;
	list-style-type:none;
}
<?php divAS();?> div#carView div
{
	margin:0 0 0% 0;	/*top right bottom left*/
	/*padding: 50px 50px;
	display:inline;*/
    height:15%;
    background-color:grey;
    display:block;
}
<?php divAS();?> div#carView div label#carInfo
{
	/*background-color:green;*/
	text-align:center;
<?php posAbs();?>
	left:15%;
	width:50%;
	height:15%;
    font-weight:bold;
    font-size:1.8vw;
}
<?php divAS();?> div#carView div label
{
	/*background: url('../images/defaultBtn.png') no-repeat 0 0;*/
	background-size : 100% 100%;
    /*background-color:blue;*/
<?php posAbs();?>
	height:15%;
	width:25%;
    left:65%;
    text-align:left;
    font-size:1.5vw;
    display:block;
}
<?php divAS();?> div#carView div button#view
{
    background: url('../images/view.png') no-repeat 0 0;
    background-size:100% 100%;
    position:absolute;
    top:5%;
    right:4%;
    width:4%;
    height:8%;
    padding:0% 0%;
}
<?php divAS();?> div#carView div button#cc
{
    background: url('../images/cancel.jpg') no-repeat 0 0;
    background-size:100% 100%;
    position:absolute;
    top:5%;
    right:0%;
    width:4%;
    height:8%;
    padding:0% 0%;
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
<?php divAS();?> div#carView div img
{
<?php posAbs();?>
	left:0%;
	width:15%;
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