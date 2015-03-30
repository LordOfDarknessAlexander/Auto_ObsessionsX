<?php
//header("Content-type: text/css; charset: UTF-8");
//
require_once 'ui.php';
//
css::header();
//
function divFunds(){?>
div#AddFunds<?php
}
require_once 'ui.php';
?>
/*
funds page styles
*/
<?php divFunds();?>
{
<?php
    posAbs();
    css::size('100%', '100%');
    css::defaultTileBG();
    //background: url('../images/defaultBG.jpg') no-repeat 0 0; 
	//background-size : 100% 100%;
?>
	display: none;
	text-align: center;
	padding-top: 92px;
	z-index: 1;
}

<?php divFunds();?> li 
{
	padding: 10px 0;
	display:inline;
	margin: 8px;
	margin-top: 8em;
}
<?php divFunds();?> label#userCash{<?php
    posAbs();
    defaultBtnBG();
?>
	color:white;
	text-align:center;
	bottom:0px;
	left:0px;
	width: 150px;
	height:2em;
}
<?php /*divFunds();> #addFundsBackButton
{
	<php
    posAbs();
>
	background: url('../images/backBtn.png') no-repeat 0 0;
	width:150px;
	height:50px;
	
}*/?>

<?php divFunds();?> #addMinorFundsBtn{<?php
    defaultBtnBG();
?>
	width:150px;
	height:50px;
}
<?php divFunds();?> #addMediumFundsBtn{<?php
    defaultBtnBG();
?>
	width:150px;
	height:50px;
}
<?php divFunds();?> #addMajorFundsBtn{<?php
    defaultBtnBG();
?>
	width:150px;
	height:50px;
}
<?php divFunds();?> #addAllowanceBtn{<?php
    defaultBtnBG();
?>
	width:150px;
	height:50px;	
}
<?php divFunds();?> form{
	position:absolute;
	color:red;
	top:30%;
}
<?php divFunds();?> form input{
	background: url('../images/defaultBtn.png') no-repeat 0 0;
	color: red;
	width:150px;
	height:50px;
<?php
    cursorPtr();
    fontBold();
?>
}
<?php divFunds();?> form#tokens{
	right:5%;
}
<?php divFunds();?> form#cash{
	left:5%;
}
