<?php
header("Content-type: text/css; charset: UTF-8");
//
require_once 'ui.php';
    
function divFunds(){
    echo 'div#AddFunds';
}
require_once 'ui.php';
?>
/*funds page UI stylings*/
<?php divFunds();?>
{
<?php
    posAbs();
?>
	background: url('../images/defaultBG.jpg') no-repeat 0 0;
	/*background-image: url('../images/logo.png');*/
	display: none;
	text-align: center;
	padding-top: 92px;
	z-index: 1;
	width: 100%;
	height: 100%;
}

<?php divFunds();?>  li 
{
	padding: 10px 0;
	display:inline;
	margin: 8px;
	margin-top: 8em;
}
<?php divFunds();?> label#userCash
{
	color:white;
	text-align:center;
	position:absolute;
	bottom:0px;
	left:0px;
	width: 150px;
	height:2em;
	background: url('../images/defaultBtn.png') no-repeat 0 0;
}
<?php divFunds();?> button
{
	background: url('../images/backBtn.png') no-repeat 0 0;
<?php
    defaultColor();
	fontBold();
	cursorPtr();
?>	
}
<?php divFunds();?> #addFundsBackButton
{
	background: url('../images/backBtn.png') no-repeat 0 0;
	color: white;
	width:150px;
	height:50px;
}

<?php divFunds();?> #addMinorFundsBtn
{
	background: url('../images/defaultBtn.png') no-repeat 0 0;
	color: white;
	width:150px;
	height:50px;
}
<?php divFunds();?> #addMediumFundsBtn
{
	background: url('../images/defaultBtn.png') no-repeat 0 0;
	color: white;
	width:150px;
	height:50px;
}
<?php divFunds();?> #addMajorFundsBtn
{
	background: url('../images/defaultBtn.png') no-repeat 0 0;
	color: white;
	width:150px;
	height:50px;
}
<?php divFunds();?> #addAllowanceBtn
{
	background: url('../images/defaultBtn.png') no-repeat 0 0;
	color: white;
	width:150px;
	height:50px;	
}
<?php divFunds();?> form input
{
	background: url('../images/defaultBtn.png') no-repeat 0 0;
	color: red;
	width:150px;
	height:50px;
<?php
    cursorPtr();
    fontBold();
?>
}
<?php divFunds();?> form#tokens
{
	position:absolute;
	color:red;
	right:5%;
	top:30%;
}
<?php divFunds();?> form#cash
{
	position:absolute;
	color:red;
	left:5%;
	top:30%;
}