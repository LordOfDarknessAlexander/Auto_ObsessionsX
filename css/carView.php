<?php
//Car View UI stylings
//header("Content-type: text/css; charset: UTF-8");
require_once 'ui.php';
css::header();
//
function divCarView(){?>div#CarView<?php
}
function rStatView($id, $hTop, $dTop){
    divCarView(); echo "h2#$id";?>{<?php
    css::rm();
    css::top($hTop);
?>
}
<?php
    divCarView(); echo "div#$id";?>{<?php
    css::rm();
    css::top($dTop);
?>
}<?php
}
function lStatView($id, $hTop, $dTop){
    divCarView(); echo "h2#$id";?>{<?php
    css::lm();
    css::top($hTop);
?>
}
<?php
    divCarView(); echo "div#$id";?>{<?php
    css::rm();
    css::top($dTop);
?>
}<?php
}
?>
/*
Car View Screen
*/
<?php divCarView();?>
{<?php
    //defaultBG();
    css::size('100%', '100%');
    css::defaultTileBG();
    posAbs();
?>
	display: none;
	text-align: center;
/*	padding-top: 92px;*/
	z-index: 1;
	width: 100%;
	height: 100%;
    color:red;
}
<?php divCarView();?> progress
{
    width:100%;
}
<?php divCarView();?> button{<?php
	//rule for all button in CarView div
	defaultColor();
    fontBold();
    cursorPtr();
    posAbs();
?>
}
<?php divCarView();?> button#selectCarBtn
{
    position:absolute;
	bottom:2%;
	left:10%;
	height:7.5%;
    width:10%;
    font-size:1.5vw;
}
<?php divCarView();?> button#sellBtn
{
    position:absolute;
	background: url('../images/defaultBtn.png') no-repeat 0 0;
	background-size: 100% 100%;
	right:10%;
	bottom:2%;
	height:7.5%;
    width:10%;
    font-size:1.5vw;
}
<?php divCarView();?> label
{<?php
    defaultColor();
    posAbs();
    //css::size('60%', '10%');
?>
    background-color:grey;
	/*background-image:url('../images/checkers.png');*/

	width:60%;
	height:10%;

	left:20%;
}
<?php divCarView();?> label#carName
{<?php
    fontBold();
    //css::top('20%');
?>
	background-image:url('../images/checkers.png');

	top:20%;
    
    font-size:2vw;
}
<?php divCarView();?> label#carInfo{
	text-align:left;
	bottom:2%;
    font-size:1.5vw;
}
<?php divCarView();?> h2{
<?php
    posAbs();
    css::size('14%', '5%');
?>
    font-size:2vw;/*size element relative to viewport width!*/
    background-color:grey;
    /*background:url('../headerBG.jpg');*/
    margin:0%;    
}
<?php divCarView();?> div{
<?php
    posAbs();
    scrollY();
    css::size('14%', '23%');
?>
    background: url('../images/defaultBG.jpg') no-repeat 0 0;
    /*background-color:grey;*/
    
    font-size:1.5vw;
    text-align:left;
}
/*
Car View left div
*/
<?php
    //lStatView('dt', '28%', '33%');
    //lStatView('body', '60%', '65%');
    //
    //rStatView('interior', '28%', '33%');
    //rStatView('docs', '60%', '65%');
?>
<?php divCarView();?> h2#dt{<?php
    css::lm();
    css::top('28%');
?>
}
<?php divCarView();?> div#drivetrain{<?php
    css::lm();
    css::top('33%');
?>	
}
<?php divCarView();?> h2#body{<?php
    css::lm();
    css::top('60%');
?>
}
<?php divCarView();?> div#body{<?php
    css::lm();
    css::top('65%');
?>
}
/*
Car View right div
*/
<?php divCarView();?> h2#interior{<?php
    css::rm();
    css::top('28%');
?>
}
<?php divCarView();?> div#interior{<?php
    css::rm();
    css::top('33%');
?>
}
<?php divCarView();?> h2#docs{<?php
    css::rm();
    css::top('60%');
?>;
}
<?php divCarView();?> div#docs{<?php
    css::rm();
    css::top('65%');
?>
}