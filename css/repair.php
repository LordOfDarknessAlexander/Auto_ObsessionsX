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
	width:20%;
	height:5%;
    font-size:1.25rem;
    font-weight: bold;
}
<?php divRepair();?> div button
{
<?php
    //posAbs();
?>
    width:10%;
    height:10%;
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
{
<?php
    posAbs();
?>
	width: 50%;
	height: 50%;
	left:25%;
	top:25%;
}

<?php divRepair();?> div progress
{
    width:80%;
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
    
	width:20%;
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
    
	width:20%;
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
    
	width:20%;
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
    
	width:20%;
	top:60%;
	height:30%;
	right:5%;
}

<?php divRepair();?> h2#dt
{
<?php
    posAbs();
?>
	width:20%;
	top:20%;
	height:5%;
	left:5%;
}
<?php divRepair();?> h2#body
{
<?php
    posAbs();
?>
	width:20%;
	top:55%;
	height:5%;
	left:5%;
}
<?php divRepair();?> h2#interior
{
<?php
    posAbs();
?>
	width:20%;
	top:20%;
	height:5%;
	right:5%;
}
<?php divRepair();?> h2#docs
{
<?php
    posAbs();
?>
	width:20%;
	top:55%;
	height:5%;
	right:5%;
}