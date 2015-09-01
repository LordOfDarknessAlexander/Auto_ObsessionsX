<?php
//
require_once 'ui.php';
//
css::header();
//
function ds(){?>div#AddFunds<?php
}
function dsc(){
    //div store cash
    ds();?> div#cash<?php
}
function dst(){
    //div store tokens
    ds();?> div#tokens<?php
}
?>
/*
ao Store page styles
*/
canvas{
    position: absolute;
    top: 0;
    left: 0;
    border:none;
    z-index: 1;
    width: 100%;
    height: 100%;
}
<?php ds();?>
{
<?php
    posAbs();
    css::size('100%', '100%');
    css::defaultTileBG();
?>
    left:0%;
    top:0%;
	text-align: center;
	z-index: 1;
}

<?php ds();?> button#allowance{<?php
    posAbs();
    defaultBtnBG();
?>
	width:16%;
    height:10%;
    left:1%;
    top:16%;
}

<?php ds();?> div form{
<?php
    posAbs();
?>
    height:25%;
    width:100%;
    
    color:red;
    text-align:center;
    font-size:1.2vw;
    font-weight:bold;
    background-color:grey;
}
<?php ds();?> div form input{
    width:100%;
    height:100%;
}
/*
Token Div
*/
<?php dst();?>{
<?php
    posAbs();
?>
    left:1%;
    top:30%;
    height:50%;
    width:18%;
}
<?php dst();?> form#t3{
    top:0%;
}
<?php dst();?> form#t5{
    top:25%;
}
<?php dst();?> form#t10{
    top:50%;
}
<?php dst();?> form#t20{
    top:75%;
}
/*
Cash Div
*/
<?php dsc();?>{
<?php
    posAbs();
?>
    right:1%;
	top:30%;
    height:50%;
    width:18%;
}
<?php dsc();?> form#c50{
    top:0%;
}
<?php dsc();?> form#c200{
    top:25%;
}
<?php dsc();?> form#c500{
    top:50%;
}
<?php dsc();?> form#c1000{
    top:75%;
}