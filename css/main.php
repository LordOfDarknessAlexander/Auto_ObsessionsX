<?php
//main menu.php, uses php to generate CSS, previously GameMenu.css
//header("Content-type: text/css; charset: UTF-8");
//
require_once 'ui.php';
//
css::header();
//using php require should be faster than css @import
require_once 'AuctionSelect.php';
require_once 'profile.php';
require_once 'repair.php';
require_once 'garage.php';
require_once 'carView.php';
require_once 'profile.php';
//    
function dgm(){?>div#gameMenu<?php
}
function dml(){dgm();?> div#menuLeft<?php
}
function dmr(){dgm();?> div#menuRight<?php
}
function top($str){?>
top:<?php echo $str;?>;
<?php
}
function right($str){?>
right:<?php echo $str;?>;
<?php
}
function left($str){?>
left:<?php echo $str;?>;
<?php
}
function bottom($str){?>
bottom:<?php echo $str;?>;
<?php
}
function lz(){
    css::left('0%');
}
function rz(){
    css::right('0%');
}
/*
function tz(){
    top('0%');
}*/
//function btm(){
    //bottom('2%');
//}
//function btm(){
    //bottom('12%');
//}
/*function rz(){
    right('0%');
}
function rm(){  //right margin
    right('5%');
}
function lm(){  //left margin
    left('5%');
}*/
?>
/*
Main Game Menu Styles
*/
<?php dgm();?>{
<?php
    posAbs();
    css::size('100%', '100%');
    css::defaultTileBG();
    //background:#000000 url('../images/bgTile.png') repeat 0 0;
    css::txtAlignCntr();
    displayNone();
?>
	padding-top: 92px;
	z-index: 1;
}
<?php dgm();?> div#slots a
{
<?php
    posAbs();
    css::defaultBG('../images/body.png');
    css::bgSize('100%', '100%');
    css::txtAlignCntr();
	css::bottom('82%');
?>
	width: 40%;
	color:red;
    left:10%;
    z-index:2;
	
}
<?php dgm();?> div#slots a:hover
{
<?php
    posAbs();
    css::defaultBG('../images/logo.png');
    css::bgSize('100%', '100%');
    css::txtAlignCntr();
	css::bottom('82%');
?>
	width: 40%;
	color:green;
    left:10%;
    z-index:2;

}

<?php dgm();?> li{
<?php defaultColor();?>
	padding: 10px 0;
	display:inline;
	margin: 8px;
	margin-top: 8em;
	/*margin : 12px;
	margin-top : 12em;*/
	/*top: 20%;*/
}
<?php dgm();?> div{
<?php
    //rule for all div elements inside Main
    posAbs();
    defaultColor();
    css::size('15%', '60%');
?>
}
<?php dml();?>{
<?php
    css::lm();
    css::bottom('12%');
?>
}
<?php dmr();?>{
<?php
    css::rm();
    css::bottom('12%');
?>
}
<?php dml();?> button,
<?php dmr();?> button{
<?php
    posAbs();
    css::size('95%', '49%');
    //css::bgSize('100%', '100%');
?>
}
<?php dml();?> button#myCars{
<?php
    css::defaultBG('../images/garageBtn.jpg');
    css::bgSize('100%', '100%');
    lz();
    css::top('0%');
?>
}
<?php dml();?> button#toAuctionBtn{
<?php
    css::defaultBG('../images/auctionBtn.jpg');
    css::bgSize('100%', '100%');
    lz();
    css::top('51%');
?>
}

<?php dmr();?> button#profile{
<?php
    css::defaultBG('../images/profileBtn.jpg');
    css::bgSize('100%', '100%');
    rz();
    css::top('0%');
?>
}
<?php dmr();?> button#buyUpgradesBtn
{<?php
    css::defaultBG('../images/repairBtn.jpg');
    css::bgSize('100%', '100%');
    rz();
    css::top('51%');
?>
}
