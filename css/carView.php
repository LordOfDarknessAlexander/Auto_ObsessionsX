<?php
//Car View UI stylings
header("Content-type: text/css; charset: UTF-8");

require_once 'ui.php';
function divStatBar(){
    echo 'div#statBar';
}
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
	margin-right:10%;
	margin-left: 5%;
	left:20%;
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
	bottom:2%;
	width:50%;
	height:14%;
}
<?php divCarView();?> h2{
<?php
    posAbs();
?>
	width:18%;
	height:4%;
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
    
    width:16%;
	height:22%;
    
    font-size:1.5vw;
    text-align:left;
}
<?php divCarView();?> div#drivetrain{
	top:30%;
	left:5%;
	
}
<?php divCarView();?> div#body{    
	top:65%;
	left:5%;
	
}
<?php divCarView();?> div#interior{    
	top:30%;
	right:5%;
}
<?php divCarView();?> div#docs{    
	top:65%;
	right:5%;
}

<?php divCarView();?> h2#dt{
	top:25%;
	left:5%;
}
<?php divCarView();?> h2#body{
	top:60%;
	left:5%;
}
<?php divCarView();?> h2#interior{
	top:25%;
	right:5%;
}
<?php divCarView();?> h2#docs{
	top:60%;
	
	right:5%;
}




