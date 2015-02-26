<?php
header("Content-type: text/css; charset: UTF-8");
//garage UI stylings as php commands
require_once 'ui.php';
require_once 'carView.php';
    
function divGarage(){
    echo 'div#Garage';
}
function scrollY(){
    //enable y scrolling
    echo 'overflow-y:scroll;';
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
?>
/*@import("CarView.css")*/
<?php divGarage();?>
{
<?php
    posAbs();
    defaultBG();
    css::size();
?>
	display: none;
	text-align: center;
	padding-top: 92px;
	z-index: 1;
}
<?php divGarage();?> button#backBtn
{<?php
    posAbs();
?>
    bottom:70%;
    left:10%;
    width:5%;
    height:5%;
}
<?php divGarage();?> button#viewCar
{<?php
    posAbs();
?>
    bottom:70%;
    left:30%;
    width:5%;
    height:5%;
}
<?php divGarage();?> button#select
{<?php
    posAbs();
?>
    bottom:70%;
    left:20%;
    width:5%;
    height:5%;
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
	height:70%;
	top:30%;
    left:5%;
    width:35%;
}
/*current user car stylings*/
<?php divUserCar();?>
{	/*styling for list items*/
	/*display:inline;*/
	color: white;
	/*background: url('../images/defaultBtn.png') no-repeat 0 0;*/
<?php posAbs();?>
	text-align::left;
	top:30%;
	left:42%;/*2%;*/
	width:25%;
	height:60%;
	display:inline;
}
<?php divSelectedCar();?>
{	/*styling for list items*/
	/*display:inline;*/
	color:red;
	/*background: url('../images/defaultBtn.png') no-repeat 0 0;*/
<?php posAbs();?>
	text-align::left;
	top:30%;
	right:2%;
	width:25%;
	height:60%;
	display:inline;
}
<?php divUserCar();?> img,
<?php divSelectedCar();?> img
{
	width:100%;
	height:50%;
}
<?php divUserCar();?> label,
<?php divSelectedCar();?> label
{	/*overrides elements with specific id's*/
	display:block;
	color: white;
	margin: 8px;
	text-align:left;
	font-size:0.75em;	/*12px*/
}
/*selected car div stylings*/

/*list item button labels*/
/*
div#progressBars{
    font-size:0.75em;
    align:left;
}*/
div#userCar div#progressBars
{
    font-size:0.75em;
    text-align:left;
    align:left;
}
div#selectedCar div#progressBars
{
    font-size:0.75em;
    text-align:right;
    align:left;
    color:white;
}
<?php divGarage();?> div#progressBars progress
{	
	/*display:inline-block;
	backgorund-color:rgb(127,127,127);*/
	/*color:grey;*/
	right:0%;
	width:50%;
}
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