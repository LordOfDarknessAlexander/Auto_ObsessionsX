<?php
//header("Content-type: text/css; charset: UTF-8");
//repair page UI stylings
require_once 'ui.php';
//
css::header();
//
require_once 'funds.php';
//
function divRepair(){
    echo 'div#RepairShop';
}
?>
<?php divRepair();?>
{<?php
    posAbs();
    //defaultBG();
    css::size('100%', '100%');
    css::defaultTileBG();
    defaultColor();
?>
	display: none;
	text-align: center;
	padding-top: 92px;
	z-index: 1;
}
<?php divRepair();?> p#error{
<?php
    posAbs();
    css::size('100%', '20%');
?>
    left:0%;
    top:0%;
}
<?php divRepair();?> h2
{
<?php
    posAbs();
?>
	width:14%;
	height:5%;
    font-size:1.8vw;/*size element relative to viewport width!*/
    font-weight:bold;
    //background-color:grey;
    background:url('../images/checkers.png');
    margin:0%;
    
}
<?php divRepair();?> button#addFunds
{
<?php
    posAbs();
    css::size('12%', '4%');
?>
    left:45%;
    bottom:72%;
    font-size:1.5vw;
    font-weight:bold;
}
<?php divRepair();?> li 
{	/*styles all list items of node with id RepairShop*/
	padding: 5px 0;
}
<?php divRepair();?> div
{
<?php
    posAbs();
?>
    overflow-y:scroll;
    background:url('../images/defaultBG.jpg') no-repeat 0 0;
    /*background-color:grey;*/
    width:14%;
	height:23%;
    
    font-size:1.25vw;
    text-align:left;
}
<?php divRepair();?> div button
{
<?php
    //posAbs();
?>
    width:45%;
    height:20%;
    font-size:0.65rem;
    font-weight:bold;
}
<?php divRepair();?> div button.ub
{
    background:url('../images/upgrade.png') no-repeat 0 0;
    background-size:100% 100%;
}
<?php divRepair();?> div button.rb
{
    background:url('../images/repair.png') no-repeat 0 0;
    background-size:100% 100%;
}
/*
<?php divRepair();?> img#userCar
{<?php
    posAbs();
    css::size('50%', '50%');
?>
	left:25%;
	bottom:12%;
}
*/
<?php divRepair();?> div progress
{<?php
    //posAbs();
?>
    width:100%;
    height:10%;
}
<?php //left div?>
<?php divRepair();?> h2#dt
{
	top:28%;
	left:5%;
}
<?php divRepair();?> div#drivetrain
{
	top:33%;
	left:5%;
}
<?php divRepair();?> h2#body
{
	top:60%;
	left:5%;
}
<?php divRepair();?> div#body
{    
	top:65%;
	left:5%;
}
<?php //right div?>
<?php divRepair();?> h2#interior
{
	top:28%;
	right:5%;
}
<?php divRepair();?> div#interior
{    
	top:33%;
	right:5%;
}
<?php divRepair();?> h2#docs
{
	top:60%;
	right:5%;
}
<?php divRepair();?> div#docs
{    
	top:65%;
	right:5%;
}