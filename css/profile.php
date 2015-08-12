<?php
require_once 'ui.php';
//
//css::header();
//    
function divPro(){?>div#profile<?php
}
function dpus(){divPro();?> div#userStats<?php
}
function dpsi(){divPro();?> div#salesInfo<?php
}
?>
/*
User Profile Screen Styles
*/
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
<?php
    css::txtAlignCntr();
    css::fontBold();
?>
    font-size:1.5vw;
}
<?php divPro();?> div{
<?php
    posAbs();	
    css::size('18%', '60%');
    scrollY();
    css::txtAlignL();
?>
    display:block;

    top:28%;
    
    font-size:1.25vw;
}
/*
Profile DIV User Stats
*/
<?php dpus();?>{
    left:1%;
    background: url('../images/icons/divTile.png') repeat 0 0;
}
/*
Profile DIV Sales info
*/
<?php dpsi();?>{
    right:1%;
    background: url('../images/icons/divTile.png') repeat 0 0;
}