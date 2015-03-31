<?php
//auction state stylings
require_once 'ui.php';
//
css::header();
//    
function divPro(){?>div#profile<?php
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
	padding-top: 92px;
	z-index: 1;
}
<?php divPro();?> h2{
    text-align:center;
    font-size:1.5vw;
    font-weight:bold;
}
<?php divPro();?> div{
<?php
    posAbs();	
    css::size('18%', '60%');
    scrollY();
?>
    display:block;
	text-align:left;

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