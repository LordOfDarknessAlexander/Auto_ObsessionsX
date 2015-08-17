<?php
//auction state stylings
//header("Content-type: text/css; charset: UTF-8");
//    
require_once 'ui.php';
//
css::header();
//
function divSaleView(){?>div#SaleView<?php
}
?>
/*
Auction Screen
*/
<?php divSaleView();?>
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

<?php divSaleView();?> li 
{
	padding: 5px 0;
}

<?php divSaleView();?> button#SaleViewButton
{<?php
    posAbs();
    css::fontBold();
    defaultBtnBG();
?>
	width:150px;
	height:50px;
	
	bottom:0%;
	left:5%;
}

/*<php divSaleView();> label#carPrice
{<php
    posAbs();
>
	background:black;
	color:white;

	width:20%;
	height:5%;

	left:0%;
	top:20%;
}*/


<?php divSaleView();?> label#carName
{<?php
    css::fontBold();
    defaultColor();
    posAbs();
    //css::size();
?>
	background-image:url('../images/checkers.png');

	width:60%;
	height:10%;

	left:20%;
	top:18%;
    font-size:2vw;
}

<?php divSaleView();?> label#svCarInfo
{<?php
    css::fontBold();
    defaultColor();
    posAbs();
    scrollY();
    //css::size();
?>
    display:block;
	background-image:url('../images/checkers.png');

	width:60%;
	height:12%;

	left:20%;
	bottom:0%;
}

<?php divSaleView();?> div#_ai
{<?php
    posAbs();
    css::size('18%','12%');
    css::left('1%');
    css::top('35%');
?>
    background-image:url('../images/slime.png');
}

<?php divSaleView();?> div#_ai div{
	width:100%;
	height:25%;
	position:absolute;
}

<?php divSaleView();?> div#_ai div.first{
	top:0%;
}

<?php divSaleView();?> div#_ai div.second{
	top:25%;
}

<?php divSaleView();?> div#_ai div.third{
	top:50%;
}

<?php divSaleView();?> div#_ai div.fourth{
	top:75%;
}
<?php divSaleView();?> div#_ai div.leftFirst{
	top:75%;
	opacity: 0.5;
	background-color:red;
}

<?php divSaleView();?> div#_ai div.leftSecond{
	top:50%;
	opacity: 0.5;
}

<?php divSaleView();?> div#_ai div.leftThird{
	top:25%;
	opacity: 0.5;
}

<?php divSaleView();?> div#_ai div.leftFourth{
	top:0%;
	opacity: 0.5;
}

<?php divSaleView();?> div#_ai div label{
	width:50%;
	text-align:center;
}

<?php divSaleView();?> div#_ai div label#name{
	left:0%;
}

<?php divSaleView();?> div#_ai div label#bid{
	right:0%;
}

<?php divSaleView();?> div#pbCD{
<?php
    posAbs();
    css::size('18%','30%');
    css::right('1%');
    css::top('45%');
?>
}
<?php divSaleView();?> div#pbCD progress{
    width:100%;
}

<?php divSaleView();?> label#going
{<?php
    css::fontBold();
    defaultColor();
    posAbs();
	css::size('18%','5%');
    css::right('1%');
    css::top('35%');
	css::txtAlignCntr();
?>
	background-image:url('../images/checkers.png');
}

