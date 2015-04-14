<?php
//header("Content-type: text/css; charset: UTF-8");
//
require_once 'ui.php';
//
css::header();
//
function divFunds(){?>div#AddFunds<?php
}
?>
/*
ao Store page styles
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
	padding: 0 0;
	display:inline;
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

<?php divFunds();?> #addMinorFundsBtn{<?php
    defaultBtnBG();
?>
	height:50px;
}
<?php divFunds();?> #addMediumFundsBtn{<?php
    defaultBtnBG();
?>
	height:50px;
}
<?php divFunds();?> #addMajorFundsBtn{<?php
    defaultBtnBG();
?>
	height:50px;
}
<?php divFunds();?> #addAllowanceBtn{<?php
    defaultBtnBG();
?>
	height:50px;	
}
<?php divFunds();?> form{
	position:absolute;
	color:red;
	top:30%;
    width:10%;
    text-align:center;
    font-size:1.2vw;
    font-weight:bold;
}
<?php divFunds();?> form#tokens{
<?php css::rm();?>
}
<?php divFunds();?> form#cash{
<?php css::lm();?>
}
<?php divFunds();?> form input{
	background: url('../images/defaultBtn.png') no-repeat 0 0;
	color: red;
	width:100%;
	height:50px;
<?php
    cursorPtr();
    css::fontBold();
?>
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