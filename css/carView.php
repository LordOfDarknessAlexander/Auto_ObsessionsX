<?php
//Car View UI stylings
header("Content-type: text/css; charset: UTF-8");

require_once 'ui.php';

function divCarView(){
    echo 'div#CarView';
}
?>

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
<?php divCarView();?> img#car
{
	position:absolute;
	width:50%;
	height:50%;
	bottom:20%;
	left:25%;
}

<?php divCarView();?> button#selectCarBtn
{
	top:24%;
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
	top:24%;
	height:5%;
    width:10%;
    font-size:2vw;
}
/*
div#CarView button#carViewBackBtn{
	background: url('../images/backBtn.png') no-repeat 0 0;
	
	left:5%;
	bottom:0%;
	width:10%;
	height:10%;
}*/
/*
div#CarView button#homeBtn
{
	background: url('../images/homeBtn.png') no-repeat 0 0;

	right:5%;
	bottom:0%;
	width:10%;
	height:10%;
}*/
<?php divCarView();?> label#carInfo{
	color:black;
	background-color:grey;
	text-align:left;
	position:absolute;
	left:25%;
	bottom:0;
	width:50%;
	height:15%;
}
<?php divCarView();?> h2{
<?php
    posAbs();
?>
	width:20%;
	height:5%;
    font-size:2vw;/*size element relative to viewport width!*/
    font-weight:bold;
    background-color:white;
    /*background:url('../headerBG.jpg');*/
    margin:0%;
    
}
<?php divCarView();?> div{
<?php
    posAbs();
?>
    overflow-y:scroll;
    background: url('../images/defaultBG.jpg') no-repeat 0 0;
    /*background-color:grey;*/
    
    width:20%;
	height:30%;
    
    font-size:1.5vw;
    text-align:left;
}
<?php divCarView();?> div#drivetrain{
	top:20%;
	left:5%;
}
<?php divCarView();?> div#body{    
	top:55%;
	left:5%;
}
<?php divCarView();?> div#interior{    
	top:20%;
	right:5%;
}
<?php divCarView();?> div#docs{    
	top:55%;
	right:5%;
}

<?php divCarView();?> h2#dt{
	top:15%;
	left:5%;
}
<?php divCarView();?> h2#body{
	top:50%;
	left:5%;
}
<?php divCarView();?> h2#interior{
	top:15%;
	right:5%;
}
<?php divCarView();?> h2#docs{
	top:50%;
	right:5%;
}



<?php divCarView();?> div#statBar{
{
    /*background-color:red;*/
	background: url('../images/StatBar.png') no-repeat 0 0;
	background-size : 100%,40%;
	position:absolute;
	top:30%;
	left:6%;
	width:90%;
	height:35%;
	/*child elements inherit values, unless otherwise specified*/
	font-family:"Kozuka Gothic Pro B";
	text-align:left;
	color:white;
	/*font-weight: bold;
	z-index : 6;
	font-size:1.2em;*/
}
div#statBar label{
    position:absolute;
    width:25%;
}
div#statBar label#money{left:0%;top:75%;}
div#statBar label#tokens{left:25%;top:75%;}
div#statBar label#prestige{left:50%;top:75%;}
div#statBar label#m_marker{left:75%;top:75%;}
}
