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
    background-size:100% 100%;
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
<?php divFunds();?> #addFundsBackButton
{
	<?php
    posAbs();
?>
	background: url('../images/backBtn.png') no-repeat 0 0;
	width:150px;
	height:50px;
	
}

<?php divFunds();?> #addMinorFundsBtn
{
	background: url('../images/defaultBtn.png') no-repeat 0 0;
	width:150px;
	height:50px;
}
<?php divFunds();?> #addMediumFundsBtn
{
	background: url('../images/defaultBtn.png') no-repeat 0 0;
	width:150px;
	height:50px;
}
<?php divFunds();?> #addMajorFundsBtn
{
	background: url('../images/defaultBtn.png') no-repeat 0 0;
	width:150px;
	height:50px;
}
<?php divFunds();?> #addAllowanceBtn
{
	background: url('../images/defaultBtn.png') no-repeat 0 0;
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
<?php divFunds();?> div#statBar{
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