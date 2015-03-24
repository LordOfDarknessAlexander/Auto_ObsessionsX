<?php
//auction state stylings
require_once 'ui.php';
//
css::header();
//    
function divPro(){
    echo 'div#profile';
}
?>
<?php divPro();?>
{
<?php
    posAbs();
    css::size('100%', '100%');
    css::defaultTileBG();
?>
	display: none;
	text-align: center;
	padding-top: 92px;
	z-index: 1;
	width: 100%;
	height: 100%;
    color:red;
}
<?php divPro();?> h2{
    text-align:center;
    font-size:1.5vw;
    font-weight:bold;
}
<?php divPro();?> div{
<?php
    posAbs();	
?>
    display:block;
	text-align:left;
    overflow-y:scroll;
    
	width: 18%;
	height: 60%;
    top:28%;
    
    font-size:1.25vw;
}
<?php divPro();?> div#userStats{
    left:2%;
}
<?php divPro();?> div#salesInfo
{
    right:2%;
}