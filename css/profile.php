<?php
//auction state stylings
header("Content-type: text/css; charset: UTF-8");
//    

function divPro(){
    echo 'div#profile';
}
require_once 'ui.php';
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
<?php divPro();?> div#userStats
{
<?php
    posAbs();	
?>
    display:block;
	text-align:left;
    overflow-y:scroll;
    
	width:18%;
	height:60%;
    top:28%;
    left:2%;
    
    font-size:1.25vw;
}
<?php divPro();?> div#salesInfo
{
<?php
    posAbs();	
?>
    display:block;
	text-align:left;
    overflow-y:scroll;
    
	width: 18%;
	height: 60%;
    top:28%;
    right:2%;
    
    font-size:1.25vw;
}