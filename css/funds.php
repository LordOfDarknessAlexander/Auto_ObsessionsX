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
    width:10%;
    text-align:center;
    font-size:1.2vw;
    font-weight:bold;
}
<?php divFunds();?> div#tokens{
<?php
    posAbs();
    css::rm();
?>
    left:2%;
    top:30%;
    height:25%;
}
<?php divFunds();?> form#cash{
<?php css::lm();?>
	top:30%;
}
<?php divFunds();?> div#tokens form{
    position:absolute;
    height:25%;
}
<?php divFunds();?> form#t3{
    top:0%;
}
<?php divFunds();?> form#t5{
    top:25%;
}
<?php divFunds();?> form#t10{
    top:50%;
}
<?php divFunds();?> form#t20{
    top:75%;
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