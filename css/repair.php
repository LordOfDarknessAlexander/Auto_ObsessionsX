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
}
<?php divRepair();?> img#userCar
{
<?php
    posAbs();
?>
	width: 50%;
	height: 50%;
	left:25%;
	top:40%;
}
<?php divRepair();?> div#drivetrain
{
<?php
    posAbs();
?>
	width:20%;
	top:30%;
	height:35%;
	left:5%;
}
<?php divRepair();?> div#body
{
<?php
    posAbs();
?>
	width:20%;
	top:65%;
	height:35%;
	left:5%;
}
<?php divRepair();?> div#interior
{
<?php
    posAbs();
?>
	width:20%;
	top:30%;
	height:35%;
	right:5%;
}
<?php divRepair();?> div#docs
{
<?php
    posAbs();
?>
	width:20%;
	top:65%;
	height:35%;
	right:5%;
}