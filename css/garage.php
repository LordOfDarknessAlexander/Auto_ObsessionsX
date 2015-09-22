<?php
//garage UI stylings as php commands
require_once 'ui.php';
//
css::header();
//
//require_once 'carView.php';
// 
//function dug(){
    //user's garage div
    //echo 'div#Garage';
//}
function dG(){
    ?>div#Garage<?php
}
function divCarListView(){
    //div Car List ViewdivGarage
    dG();?> div#carListView<?php
}
function dGUC(){
    //User's current car div
    dG();?> div#userCar<?php
}
function dGSC(){
    //selected car div, for viewing
    dG();?> div#selectedCar<?php
}
function btnCon(){
    //condition image
    dG();?> div button#con<?php
}
function btnW(){
    echo '8.75%';
}
?>
/*
User Garage div Stylings
*/
<?php dG();?>{
<?php
    posAbs();
    //defaultBG();
    css::size();
    //css::size('100%', '100%');
    css::defaultTileBG();
   // background: url('../images/garageBtn.jpg') no-repeat 0 0; 
	//background-size : 100% 100%;
?>
	display: none;
	text-align: center;
	z-index: 1;
}
<?php dG();?> button#viewCar{
<?php
    posAbs();
    css::size('8.75%', '7.5%');
    css::marginBtm();
?>
    left:18.75%;
    
    font-size:1.5vw;
    font-weight:bold;
}
<?php dG();?> button#select{
<?php
    posAbs();
    css::size('8.75%', '7.5%');
    css::marginBtm();
?>
    left:10%;
    
    font-size:1.5vw;
    font-weight:bold;
}
<?php dG();?> button#sales{
<?php
    posAbs();
    css::size('8.75%', '7.5%');
    css::marginBtm();
?>
    left:36.25%;
    
    font-size:1.5vw;
    font-weight:bold;
}
<?php dG();?> button#shop
{<?php
    posAbs();
    css::size('8.75%', '7.5%');
    css::marginBtm();
?>
    left:27.5%;
    
    font-size:1.5vw;
    font-weight:bold;
}
<?php divCarListView();?> ul{
    position:absolute;
    left:0%;
    top:0%;
    margin: 0% 1%;
}
<?php dG();?> li{
	/*styles all list items of node with id RepairShop*/
	margin: 1% 1%;
	display:inline;
}
<?php dG();?> li button{
	/*styling for list items*/
	color: white;
	background-size: 100% 100%;
	position: relative;
	width:80px;
	height:60px;
	cursor:pointer;
}
<?php dG();?> li button:hover{
	/*styling for list items*/
	color: white;
	background-size: 100% 100%;
	position: relative;
	width:80px;
	height:60px;
	cursor:pointer;
    border: 2px red solid;
}
<?php dG();?> li button:focus{
	/*styling for list items*/
	color: white;
	background-size: 100% 100%;
	position: relative;
	width:80px;
	height:60px;
	cursor:pointer;
    border: 2px green solid;
}

<?php dG();?> li button img{
<?php
    posAbs();
    css::size('100%', '100%');
?>
	/*position element in to left corner of parent*/
	top:0%;
	left:0%;
    object-fit:contain;
}
<?php divCarListView();?>{
	background: url('../images/icons/divTile.png') repeat 0 0;
<?php posAbs();
    scrollY();
    css::size('35%', '60.5%');
?>
	top:30%;
    left:10%;
}
/*
current user car stylings
*/
<?php dGUC();?>{
	/*display:inline;*/
	background: url('../images/icons/divTile.png') repeat 0 0;
<?php
    posAbs();
    css::top('30%');
    css::size('26%', '68%');
?>
	text-align::left;

	left:46%;/*2%;*/

	display:inline;
}
<?php dGSC();?>{
	/*display:inline;*/
	background: url('../images/icons/divTile.png') repeat 0 0;
<?php
    posAbs();
    css::top('30%');
    css::size('26%', '68%');
?>
	text-align::left;

	right:1%;

	display:inline;
}
<?php dGUC();?> img#carImg,
<?php dGSC();?> img#carImg{
<?php
    css::size('100%', '25%');
?>
    object-fit:contain;
}
<?php dGUC();?> label,
<?php dGSC();?> label{
	/*overrides elements with specific id's*/
	display:block;
	text-align:left;
}
<?php dGUC();?> label#carName,
<?php dGSC();?> label#carName{
	/*overrides elements with specific id's*/
	margin:2%;
	font-size:0.85em;	/*12px*/
    text-align:center;
}
<?php dGUC();?> label#carInfo,
<?php dGSC();?> label#carInfo{
	/*overrides elements with specific id's*/
	margin:0%;
	font-size:0.6em;	/*12px*/
    height:35%;
<?php
    scrollY();
?>
}

/*list item button labels*/
/*
div#progressBars{
    font-size:0.75em;
    align:left;
}*/

<?php dGUC();?> div#progressBars,
<?php dGSC();?> div#progressBars{
<?php
    posAbs();
?>
    font-size:0.75em;
    text-align:left;
    align:left;
    bottom:0%;
    left:0%;
    width:70%;
    /*height:25%;*/
}
<?php dG();?> div#progressBars progress{	
	/*display:inline-block;*/
	color:grey;
	left:0%;
	width:100%;
}
<?php btnCon();?>{	
	background: url('../images/condition.png') no-repeat 0 0;
	background-size:100% 100%;
<?php
    //css::bg('../images/condition.png');
    posAbs();
    css::size('30%', '25%');
    //css::right('0%');
    //css::bottom('0%');
    //txtAlignCntr();
?>
	right:0%;
    bottom:0%;
    
    text-align:center;
    font-size:2.5vw;
    
    cursor:default;
    boarder:none;
}
<?php btnCon();?>:hover{    
}
<?php btnCon();?>:active{    
}
<?php dG();?> div#pbLabels label{	
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