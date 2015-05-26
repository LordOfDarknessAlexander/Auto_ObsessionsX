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

<?php divFunds();?> div form{
    position:absolute;
    height:25%;
    width:100%;
    
    color:red;
    text-align:center;
    font-size:1.2vw;
    font-weight:bold;
}
<?php divFunds();?> div form input{
    width:100%;
    height:100%;
}
/*
Token Div
*/
<?php divFunds();?> div#tokens{
<?php
    posAbs();
?>
    background-color:grey;
    top:30%;
    height:50%;
    width:20%;
}
<?php divFunds();?> div#tokens form#t3{
    top:0%;
}
<?php divFunds();?> div#tokens form#t5{
    top:25%;
}
<?php divFunds();?> div#tokens form#t10{
    top:50%;
}
<?php divFunds();?> div#tokens form#t20{
    top:75%;
}
/*
Cash Div
*/
<?php divFunds();?> div#cash{
<?php
    posAbs();
?>
    right:0%;
    background-color:grey;
	top:30%;
    height:50%;
    width:20%;
}
<?php divFunds();?> div#cash form#c50{
    top:0%;
}
<?php divFunds();?> div#cash form#c200{
    top:25%;
}
<?php divFunds();?> div#cash form#c500{
    top:50%;
}
<?php divFunds();?> div#cash form#c1000{
    top:75%;
}