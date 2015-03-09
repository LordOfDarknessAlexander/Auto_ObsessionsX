<?php
//Car View UI stylings
//header("Content-type: text/css; charset: UTF-8");
require_once 'ui.php';
css::header();
//
function divCarView(){
    echo 'div#CarView';
}
?>
/*Car View Screen*/
<?php divCarView();?>
{<?php
    defaultBG();
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
<?php divCarView();?> button
{<?php
	//rule for all button in CarView div
	defaultColor();
    fontBold();
    cursorPtr();
    posAbs();
?>
}
<?php divCarView();?> button#selectCarBtn
{
	bottom:72%;
	left:40%;
	height:5%;
    width:10%;
    font-size:2vw;
}
<?php divCarView();?> button#sellBtn
{
	background: url('../images/defaultBtn.png') no-repeat 0 0;
	background-size: 100% 100%;
	left:50%;
	bottom:72%;
	height:5%;
    width:10%;
    font-size:2vw;
}
<?php divCarView();?> label#carInfo{
	color:black;
	background-color:grey;
	text-align:left;
	position:absolute;
	left:20%;
	bottom:2%;
	width:60%;
	height:10%;
    font-size:1.0vw;
}
<?php divCarView();?> h2{
<?php
    posAbs();
?>
	width:14%;
	height:5%;
    font-size:2vw;/*size element relative to viewport width!*/
    font-weight:bold;
    background-color:grey;
    /*background:url('../headerBG.jpg');*/
    margin:0%;    
}
<?php divCarView();?> div{
<?php
    posAbs();
    scrollY();
?>
    background: url('../images/defaultBG.jpg') no-repeat 0 0;
    /*background-color:grey;*/
    
    width:14%;
	height:23%;
    
    font-size:1.5vw;
    text-align:left;
}
/*Car View left div*/
<?php divCarView();?> h2#dt{
	top:28%;
	left:5%;
}
<?php divCarView();?> div#drivetrain{
	top:33%;
	left:5%;	
}
<?php divCarView();?> h2#body{
	top:60%;
	left:5%;
}
<?php divCarView();?> div#body{    
	top:65%;
	left:5%;
}
/*Car View right div*/
<?php divCarView();?> h2#interior{
	top:28%;
	right:5%;
}
<?php divCarView();?> div#interior{    
	top:33%;
	right:5%;
}
<?php divCarView();?> div#docs{    
	top:65%;
	right:5%;
}
<?php divCarView();?> h2#docs{
	top:60%;	
	right:5%;
}