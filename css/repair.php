<?php
header("Content-type: text/css; charset: UTF-8");
//repair page UI stylings
require_once 'ui.php';
    
function divRepair(){
    echo 'div#RepairShop';
}
?>
<?php divRepair();?>
{<?php
    defaultBG();
    posAbs();
    css::size('100%', '100%');
    defaultColor();
?>
	display: none;
	text-align: center;
	padding-top: 92px;
	z-index: 1;
}

<?php divRepair();?> li 
{	/*styles all list items of node with id RepairShop*/
	padding: 5px 0;
}
<?php divRepair();?> h2
{
<?php
    posAbs();
?>
	width:15%;
	height:5%;
    font-size:1.5rem;
    font-weight:bold;
    background-color:white;
}
<?php divRepair();?> div button
{
<?php
    //posAbs();
?>
    width:20%;
    height:15%;
    font-size:0.65rem;
}
<?php divRepair();?> div button.ub
{
    background:url('../images/upgrade.png') no-repeat 0 0;
    background-size:100% 100%;
}
<?php divRepair();?> div button.rb
{
    background:url('../images/repair.jpg') no-repeat 0 0;
    background-size:100% 100%;
}
/*
<?php divRepair();?> div#upgrades
{
<?php
    posAbs();
?>
	width:15%;
	top:30%;
	height:60%;
	left:5%;
}
<?php divRepair();?> div#repairs
{
<?php
    posAbs();
?>
	width:15%;
	height:40%;
	top:30%;
	right:5%;
}*/
<?php divRepair();?> img#userCar
{<?php
    posAbs();
    css::size('50%', '50%');
?>
	left:25%;
	bottom:12%;
}

<?php divRepair();?> div progress
{<?php
    //posAbs();
?>
    width:100%;
    height:10%;
}
<?php divRepair();?> div#drivetrain
{
<?php
    posAbs();
?>
    background-color:grey;
    font-size:1rem;
    text-align:left;
    
	width:15%;
	top:25%;
	height:30%;
	left:5%;
}
<?php divRepair();?> div#body
{
<?php
    posAbs();
?>
    background-color:grey;
    font-size:1rem;
    text-align:left;
    
	width:15%;
	top:60%;
	height:30%;
	left:5%;
}
<?php divRepair();?> div#interior
{
<?php
    posAbs();
?>
    background-color:grey;
    text-align:left;
    font-size:1rem;
    
	width:15%;
	top:25%;
	height:30%;
	right:5%;
}
<?php divRepair();?> div#docs
{
<?php
    posAbs();
?>
    background-color:grey;
    text-align:left;
    font-size:1rem;
    
	width:15%;
	top:60%;
	height:30%;
	right:5%;
}

<?php divRepair();?> h2#dt
{
<?php
    posAbs();
?>
	top:20%;
	left:5%;
}
<?php divRepair();?> h2#body
{
<?php
    posAbs();
?>
	top:55%;
	left:5%;
}
<?php divRepair();?> h2#interior
{
<?php
    posAbs();
?>
	top:20%;
	right:5%;
}
<?php divRepair();?> h2#docs
{
<?php
    posAbs();
?>
	top:55%;
	right:5%;
}