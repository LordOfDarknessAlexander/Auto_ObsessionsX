<?php
//member page stylings
//header("Content-type: text/css; charset: UTF-8");
//    
require_once 'ui.php';
//
css::header();
//
function divMembers(){?>div#Members<?php
}
?>
/*
members pages 
*/
<?php divMembers();?>
{	/*Auction page stylings*/ 
/*	background: url('../images/defaultBG.jpg') no-repeat 0 0;*/
<?php
    posAbs();
	css::defaultTileBG();
    //css::size('100%, '100%');
?>
	display: none;
	text-align: center;
	padding-top: 92px;
	z-index: 1;
	width: 100%;
	height: 100%;
}

<?php divMembers();?> li 
{
	padding: 5px 0;
}

<?php divMembers();?>div#nav {
<?php
    posAbs();
    css::fontBold();
    defaultBtnBG();
?>
	width:150px;
	height:50px;
	bottom:0%;
	left:5%;
}

<?php divMembers();?>div#nav ul{
<?php
    posAbs();
    css::fontBold();
    defaultBtnBG();
?>
	width:150px;
	height:50px;
	bottom:0%;
	left:5%;
}
<?php divMembers();?>div#reg-navigation{
<?php
    posAbs();
    defaultBtnBG();
    css::txtAlignCntr();
?>
    right:0%;
    z-index:3;
	top : 19%;
	
}

<?php divMembers();?>div#reg-navigation a{
<?php
    defaultBtnBG();
    //css::bgSize('100%', '100%');
?>
    color: red;
    font-weight: bold;
    text-decoration: none;
	padding : 2%;
	top : 19%;
}
<?php divMembers();?>div#reg-navigation a:hover{
<?php
    //mouse over
    css::defaultBG('../images/defaultBtn2.png');
    css::bgSize('100%', '100%');
?>  
	color:green;
	padding : 2%;
	top : 19%;
}
<?php divMembers();?>div#playerData{
	
	top:0%;
    left:10%;
    color:red;
    width:90%;
    height:10%;
    text-align:left;
    position:absolute;
}



