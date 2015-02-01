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

#purchaseButton
{<?php
    fontBold();
    cursorPtr();
?>
	background: url('../images/bidButton.png') no-repeat 0 0;
	color: white;
	width:150px;
	height:50px;
}
#repairBackButton
{
<?php
    posAbs();
    fontBold();
    cursorPtr();
?>
	background: url('../images/repairBackButton.png') no-repeat 0 0;
	color: white;
	width:150px;
	height:50px;
	left:5%;
	bottom:0%;	
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
	width: 40%;
	height: 40%;
	left:30%;
	top:40%;
}