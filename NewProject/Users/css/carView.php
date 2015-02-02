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
	width:40%;
	height:40%;
	bottom:20%;
	left:30%;
}

<?php divCarView();?> button#selectCarBtn
{
	top:34%;
	left:45%;
	height:5%;
}
<?php divCarView();?> button#sellBtn
{
	background: url('../images/defaultBtn.png') no-repeat 0 0;

	left:5%;
	top:35%;
	width:15%;
	height:10%;
}
/*
div#CarView button#carViewBackBtn
{
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
<?php divCarView();?> label#carInfo
{
	color:black;
	background-color:grey;
	text-align:left;
	position:absolute;
	left:25%;
	bottom:0;
	width:50%;
	height:15%;
}