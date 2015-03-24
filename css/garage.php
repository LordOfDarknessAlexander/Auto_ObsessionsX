<?php
//header("Content-type: text/css; charset: UTF-8");
//garage UI stylings as php commands
require_once 'ui.php';
//
css::header();
//
require_once 'carView.php';
// 
//function dug(){
    //user's garage div
    //echo 'div#Garage';
//}
function divGarage(){
    echo 'div#Garage';
}
function divCarListView(){
    echo 'div#Garage div#carListView';
}
function divUserCar(){
    echo 'div#Garage div#userCar';
}
function divSelectedCar(){
    echo 'div#Garage div#selectedCar';
}
function btnW(){
    echo '8.75%';
}
?>
/*User Garage div Stylings*/
<?php divGarage();?>
{
<?php
    posAbs();
    //defaultBG();
    css::size();
    css::size('100%', '100%');
    css::defaultTileBG();
    //background: url('../images/defaultBG.jpg') no-repeat 0 0; 
	//background-size : 100% 100%;
?>
	display: none;
	text-align: center;
	z-index: 1;
    color:red;
}
/*<php divGarage();?> button#backBtn
{<php
    posAbs();
>
    bottom:70%;
    left:10%;
    width:5%;
    height:7.5%;
    font-size:1.25vw;
}*/
<?php divGarage();?> button#viewCar
{<?php
    posAbs();
?>
    bottom:2%;
    left:27.5%;
    width:8.75%;
    height:7.5%;
    font-size:1.5vw;
    font-weight:bold;
}
<?php divGarage();?> button#select
{<?php
    posAbs();
?>
    bottom:2%;
    left:18.75%;
    width:8.75%;
    height:7.5%;
    font-size:1.5vw;
    font-weight:bold;
}
<?php divGarage();?> button#sales
{<?php
    posAbs();
?>
    bottom:2%;
    left:36.25%;
    width:8.75%;
    height:7.5%;
    font-size:1.5vw;
    font-weight:bold;
}
<?php divGarage();?> button#shop
{<?php
    posAbs();
?>
    bottom:2%;
    left:10%;
    width:8.75%;
    height:7.5%;
    font-size:1.5vw;
    font-weight:bold;
}
<?php divGarage();?> li 
{	/*styles all list items of node with id RepairShop*/
	/*margin: 6% 2%;*/
	display:inline;
}
<?php divGarage();?> li button
{	/*styling for list items*/
	color: white;
	margin: 2% 2%;
	background-size: 100% 100%;
	/*background: url('../images/defaultBtn.png') no-repeat 0 0;*/
	position: relative;
	width:80px;
	height:60px;
	cursor:pointer;
}
<?php divGarage();?> li button img
{	position:absolute;
	/*position element in to left corner of parent*/
	top:0%;
	left:0%;
	width:100%;
	height:100%;
}
<?php divCarListView();?>
{
	background: url('../images/defaultBG.jpg') no-repeat 0 0;
	overflow-y:scroll;
<?php posAbs();?>
	height:60.5%;
	top:30%;
    left:10%;
    width:35%;
}
/*current user car stylings*/
<?php divUserCar();?>
{	/*styling for list items*/
	/*display:inline;*/
	/*background: url('../images/defaultBtn.png') no-repeat 0 0;*/
<?php posAbs();?>
	text-align::left;
	top:30%;
	left:45%;/*2%;*/
	width:25%;
	height:68%;
	display:inline;
}
<?php divSelectedCar();?>
{	/*styling for list items*/
	/*display:inline;*/
	/*background: url('../images/defaultBtn.png') no-repeat 0 0;*/
<?php posAbs();?>
	text-align::left;
	top:30%;
	right:2%;
	width:25%;
	height:68%;
	display:inline;
}
<?php divUserCar();?> img#carImg,
<?php divSelectedCar();?> img#carImg
{
	width:100%;
	height:25%;
}
<?php divUserCar();?> label,
<?php divSelectedCar();?> label
{	/*overrides elements with specific id's*/
	display:block;
	text-align:left;
}
<?php divUserCar();?> label#carName,
<?php divSelectedCar();?> label#carName
{	/*overrides elements with specific id's*/
	margin:2%;
	font-size:0.85em;	/*12px*/
    text-align:center;
}
<?php divUserCar();?> label#carInfo,
<?php divSelectedCar();?> label#carInfo
{	/*overrides elements with specific id's*/
	margin:0%;
	font-size:0.6em;	/*12px*/
    height:35%;
}
/*selected car div stylings*/

/*list item button labels*/
/*
div#progressBars{
    font-size:0.75em;
    align:left;
}*/

div#userCar div#progressBars,
div#selectedCar div#progressBars
{
    font-size:0.75em;
    text-align:left;
    align:left;
    position:absolute;
    bottom:0%;
    left:0%;
    width:70%;
}
<?php divGarage();?> div#progressBars progress
{	
	/*display:inline-block;*/
	/*color:grey;*/
	left:0%;
	width:100%;
}
<?php divGarage();?> div button#con
{	
	background: url('../images/condition.png') no-repeat 0 0;
	background-size:100% 100%;
    position:absolute;
	right:0%;
	height:25%;
    width:30%;
    bottom:0%;
    text-align:center;
    font-size:2.5vw;
    cursor:default;
    boarder:none;
}
<?php divGarage();?> div button#con:hover{}
<?php divGarage();?> div button#con:active{}
<?php divGarage();?> div#pbLabels label
{	
	display:block;
	color: white;
	margin: 8px;
	font-size:0.75em;	/*12px*/
	right:0;
	top:0;
}
/*
div#carListView ul li{
}
div#carListView ul li button{
}
div#carListView ul li img{
}
*/
/*#Garage li img
{
	width:40%;
	height:40%;
}*/
/*#Garage li button label
{	overrides elements with specific id's
	display:block;
	color: white;
	margin: 8px;
	text-align:left;
}*/