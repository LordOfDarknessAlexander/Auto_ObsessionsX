<?php
//
require_once 'ui.php';
//
css::header();
//
require_once 'funds.php';
//
function divRepair(){?>
div#RepairShop<?php
}
?>
/*
Repair Screen Styles
*/
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
<?php divRepair();?> h2{
<?php
    posAbs();
    css::height('5%');
    //css:width('14%');
?>
	width:14%;
    font-size:1.8vw;/*size element relative to viewport width!*/
    /*font-weight:bold;
    background-color:grey;*/
    background:url('../images/checkers.png');
    margin:0%;    
}
<?php divRepair();?> button#addFunds{
<?php
    posAbs();
    css::size('12%', '4%');
    css::left('45%');
?>
    bottom:72%;
    font-size:1.5vw;
    font-weight:bold;
}
<?php divRepair();?> li 
{	/*styles all list items of node with id RepairShop*/
	padding: 5px 0;
}
<?php divRepair();?> div{
<?php
    posAbs();
    css::size('14%', '23%');
    scrollY();
?>
    background:url('../images/defaultBG.jpg') no-repeat 0 0;
    /*background-color:grey;*/
    
    font-size:1.25vw;
    text-align:left;
}
<?php divRepair();?> div button{
<?php
    //posAbs();
?>
    width:45%;
    height:20%;
    font-size:0.65rem;
    /*font-weight:bold;*/
}
<?php divRepair();?> div button.ub{
    background:url('../images/upgrade.png') no-repeat 0 0;
    background-size:100% 100%;
}
<?php divRepair();?> div button.rb{
    background:url('../images/repair.png') no-repeat 0 0;
    background-size:100% 100%;
}
<?php divRepair();?> div progress{<?php
    //posAbs();
?>
    width:100%;
    height:10%;
}
/*
left div
*/
<?php divRepair();?> h2#dt{<?php
    css::lm();
    css::top('28%');
?>
}
<?php divRepair();?> div#drivetrain{<?php
    css::lm();
    css::top('33%');
?>
}
<?php divRepair();?> h2#body{<?php
    css::lm();
    css::top('60%');
?>
}
<?php divRepair();?> div#body{<?php
    css::lm();
    css::top('65%');
?>
}
/*
right div
*/
<?php divRepair();?> h2#interior{<?php
    css::rm();
    css::top('28%');
?>
}
<?php divRepair();?> div#interior{<?php
    css::rm();
    css::top('33%');
?>
}
<?php divRepair();?> h2#docs{<?php
    css::rm();
    css::top('60%');
?>
}
<?php divRepair();?> div#docs{<?php
    css::rm();
    css::top('65%');
?>
}