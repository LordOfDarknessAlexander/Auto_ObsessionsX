<?php
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
?>
	text-align: center;
	z-index: 1;
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
    background-color:grey;
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