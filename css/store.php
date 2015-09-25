<?php
//
require_once 'ui.php';
//
css::header();
//
function ds(){
    ?>div#AddFunds<?php
}
function dsc(){
    //div store cash
    ds();?> div#cash<?php
}
function dst(){
    //div store tokens
    ds();?> div#tokens<?php
}
function dstForm(){
    dst();?> form<?php
}
function dscForm(){
    dsc();?> form<?php
}
function l0(){
    //left, 0%
    css::left('0%');
}
function t0(){
    css::top('0%');
}
//function wh100(){
    //css::size('100%', '100%');
//}
?>
/*
ao Store page styles
*/
canvas{
<?php
    posAbs();
    css::size('100%', '100%');
    l0();
    t0();
?>
    border:none;
    z-index: -1;
}
<?php ds();?>{
<?php
    posAbs();
    css::size('100%', '100%');
    css::defaultTileBG();
    l0();
    t0();
?>
	text-align: center;
	z-index: 1;
}

<?php ds();?> button#allowance{
<?php
    posAbs();
    defaultBtnBG();
    css::left('1%');
    css::top('16%');
    css::size('18%', '10%');
?>
}
<?php ds();?> button#allowance progress{
<?php
    posAbs();
    css::size('100%', '100%');
    l0();
    t0();
?>
}
<?php ds();?> div form{
<?php
    posAbs();
    css::size('100%', '25%');
    css::fontBold();
    css::bgColor(); //default is grey
    css::color();   //default is red
?>    
    text-align:center;
    font-size:1.2vw;
}
<?php ds();?> div form input{
<?php
    css::size('100%', '100%');
?>
}
/*
Token Div
*/
<?php dst();?>{
<?php
    posAbs();
    css::left('1%');
    css::top('28%');
    css::size('18%', '60%');
?>
}
<?php dstForm();?>#t3{
<?php t0();?>
}
<?php dstForm();?>#t5{
    top:25%;
}
<?php dstForm();?>#t10{
    top:50%;
}
<?php dstForm();?>#t20{
    top:75%;
}
/*
Cash Div
*/
<?php dsc();?>{
<?php
    posAbs();
    css::right('1%');
    css::top('28%');
    css::size('18%', '60%');
?>
}
<?php dscForm();?>#c50{
<?php t0();?>
}
<?php dscForm();?>#c200{
    top:25%;
}
<?php dscForm();?>#c500{
    top:50%;
}
<?php dscForm();?>#c1000{
    top:75%;
}