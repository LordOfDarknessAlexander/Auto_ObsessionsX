<?php
//Car View UI stylings
//header("Content-type: text/css; charset: UTF-8");
require_once 'ui.php';
//
css::header();
//
$fs = '1.5vw';  //font size
$btnW = '8.75%';
$btnH = '7.5%';
//
function dCV(){?>div#CarView<?php
}
function rStatView($id, $hTop, $dTop){
    dCV(); echo "h2#$id";?>{<?php
    css::rm();
    css::top($hTop);
?>
}
<?php
    dCV(); echo "div#$id";?>{<?php
    css::rm();
    css::top($dTop);
?>
}<?php
}

function lStatView($id, $hTop, $dTop){
    dCV(); echo "h2#$id";?>{<?php
    css::lm();
    css::top($hTop);
?>
}
<?php
    dCV(); echo "div#$id";?>{<?php
    css::rm();
    css::top($dTop);
?>
}<?php
}
?>
/*
Car View Screen
*/
<?php dCV();?>
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
<?php dCV();?> progress{
    width:100%;
}
<?php dCV();?> button{<?php
	//rule for all button in CarView div
	defaultColor();
    css::fontBold();
    cursorPtr();
    posAbs();
?>
}
<?php dCV();?> button#select{
<?php
    posAbs();
    css::marginBtm();
    css::size($btnW, $btnH);
    css::left('10%');
?>	
    font-size:1.5vw;
}
<?php dCV();?> button#sell{
<?php
    css::marginBtm();
    css::size($btnW, $btnH);
    css::right('10%');
    posAbs();
?>
	background: url('../images/defaultBtn.png') no-repeat 0 0;
	background-size: 100% 100%;

    font-size:1.5vw;
}
<?php dCV();?> label
{<?php
    defaultColor();
    posAbs();
    css::size('60%', '10%');
    css::bgColor('grey');
?>
	/*background-image:url('../images/checkers.png');*/

	left:20%;
}
<?php dCV();?> label#carName
{<?php
    css::fontBold();
    //css::top('20%');
?>
	background-image:url('../images/checkers.png');

	top:18%;

    font-size:2vw;
    /*align text to middle of label
    line-height:10%;
    
    display:inline-block;
    vertical-align: middle;*/
    
}
<?php dCV();?> label#carInfo{
<?php
    css::marginBtm();
    css::txtAlignL();
    scrollY();
?>
    font-size:1.5vw;
    display:block;
}
<?php dCV();?> img{
<?php
    posAbs();
    css::size('14%', '5%');
    //css::bgColor('grey');
?>
    /*font-size:1.85vw;/*size element relative to viewport width!*/
    background:url('../headerBG.jpg');*/
    margin:0%;  
}
<?php dCV();?> div{
<?php
    posAbs();
    scrollY();
    css::size('14%', '24%');
    css::txtAlignL();
    css::bgColor('grey');
?>
    background: url('../images/icons/divTile.png') repeat 0 0;
    
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
<?php dCV();?> img#dt{<?php
    css::lm();
    css::top('28%');
    //css::defaultBG('../images/drivetrain.png');
    //css::bgSize('100%', '100%');
?>
}
<?php dCV();?> div#drivetrain{<?php
    css::lm();
    css::top('33%');
?>	
}
<?php dCV();?> img#body{<?php
    css::lm();
    css::top('59%');
   // css::defaultBG('../images/body.png');
    //css::bgSize('100%', '100%');
?>
}
<?php dCV();?> div#body{<?php
    css::lm();
    css::top('64%');
?>
}
/*
Car View right div
*/
<?php dCV();?> img#interior{<?php
    css::rm();
    css::top('28%');
    //css::defaultBG('../images/interior.png');
    //css::bgSize('100%', '100%');
?>
}
<?php dCV();?> div#interior{<?php
    css::rm();
    css::top('33%');
?>
}
<?php dCV();?> img#docs{<?php
    css::rm();
    css::top('59%');
    //css::defaultBG('../images/documents.png');
    //css::bgSize('100%', '100%');
?>;
}
<?php dCV();?> div#docs{<?php
    css::rm();
    css::top('64%');
?>
}