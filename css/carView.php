<?php
//Car View UI stylings
//header("Content-type: text/css; charset: UTF-8");
require_once 'ui.php';
//css::header();
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
}
<?php divCarView();?> progress
{
    width:100%;
}
<?php divCarView();?> button{<?php
	//rule for all button in CarView div
	defaultColor();
    css::fontBold();
    cursorPtr();
    posAbs();
?>
}
<?php divCarView();?> button#select
{
    position:absolute;
<?php css::marginBtm();?>
	left:10%;
	height:7.5%;
    width:10%;
    font-size:1.5vw;
}
<?php divCarView();?> button#sell
{
    position:absolute;
	background: url('../images/defaultBtn.png') no-repeat 0 0;
	background-size: 100% 100%;
	right:10%;
<?php css::marginBtm();?>
	height:7.5%;
    width:10%;
    font-size:1.5vw;
}
<?php divCarView();?> label
{<?php
    defaultColor();
    posAbs();
    css::size('60%', '10%');
    css::bgColor('grey');
?>
	/*background-image:url('../images/checkers.png');*/

	left:20%;
}
<?php divCarView();?> label#carName
{<?php
    css::fontBold();
    //css::top('20%');
?>
	background-image:url('../images/checkers.png');

	top:20%;
    
    font-size:2vw;
}
<?php divCarView();?> label#carInfo{
<?php
    css::marginBtm();
    css::txtAlignL();
?>
    font-size:1.5vw;
}
<?php divCarView();?> h2{
<?php
    posAbs();
    css::size('14%', '5%');
    css::bgColor('grey');
?>
    font-size:2vw;/*size element relative to viewport width!*/
    /*background:url('../headerBG.jpg');*/
    margin:0%;    
}
<?php divCarView();?> div{
<?php
    posAbs();
    scrollY();
    css::size('14%', '23%');
    css::txtAlignL();
    css::bgColor('grey');
?>
    background: url('../images/defaultBG.jpg') no-repeat 0 0;
    
    font-size:1.5vw;
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