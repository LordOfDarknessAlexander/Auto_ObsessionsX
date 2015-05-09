<?php
//
require_once 'ui.php';
//
css::header();
//
require_once 'funds.php';
//
function divRepair(){?>
div#RepairShop<?php
}
function cid0(){divRepair();?> div#cid0<?php
}
cmntHeader('Repair Screen Styles');
?>

<?php divRepair();?>{
<?php
    posAbs();
    //defaultBG();
    css::size('100%', '100%');
    css::defaultTileBG();
?>
	display: none;
	text-align: center;
	padding-top: 92px;
	z-index: 1;
}
<?php divRepair();?> p#error{
<?php
    posAbs();
    css::size('100%', '20%');
?>
    left:0%;
    top:0%;
}
<?php divRepair();?> h2{
<?php
    posAbs();
    css::size('14%', '5%');
    css::txtAlignCntr();
?>
    font-size:1.8vw;/*size element relative to viewport width!*/
    /*font-weight:bold;
    background-color:grey;*/
    background:url('../images/label.jpg');
    margin:0%;    
}
<?php divRepair();?> button#addFunds{
<?php
    posAbs();
    css::size('12%', '4%');
    css::left('45%');
?>
    bottom:72%;
    font-size:1.5vw;
    font-weight:bold;
}
<?php divRepair();?> li 
{	/*styles all list items of node with id RepairShop*/
	padding: 5px 0;
}
<?php divRepair();?> div{
<?php
    posAbs();
    css::size('14%', '29%');
    //scrollY();
    css::txtAlignL();
?>
    background:url('../images/defaultBG.jpg') no-repeat 0 0;
    /*background-color:grey;*/
    
    font-size:1.25vw;
}
<?php divRepair();?> div button{
<?php
    //posAbs();
    css::size('49%', '20%');
?>
    font-size:0.65rem;
    /*font-weight:bold;*/
}
<?php divRepair();?> div button.ub{
    background:url('../images/icons/upgrade.png') no-repeat 0 0;
    background-size:100% 100%;
    bottom:10%;
    position:absolute;
    left:0%;
}
<?php divRepair();?> div button.rb{
    background:url('../images/icons/repair.png') no-repeat 0 0;
    background-size:100% 100%;
    bottom:10%;
    position:absolute;
    right:0%;
}
<?php divRepair();?> div progress{
<?php
    //posAbs();
?>
    width:100%;
    height:10%;
}
<?php divRepair();?> div#switch{
<?php
    posAbs();
    css::size('18%', '10%');
    //scrollY();
    css::txtAlignCntr();
?>
    top:15%;
    left:1%;
    background:url('../images/defaultBG.jpg') no-repeat 0 0;
    /*background-color:grey;*/
    display:block;
}
<?php divRepair();?> div#switch button{
<?php
    posAbs();
    css::size('49%', '49%');
?>
    /*border:0%;
    padding:0% 0%;*/
    /*background-color:grey;*/
}
<?php divRepair();?> div#switch button#dt{
	 background:url('../images/drivetrain.png') no-repeat 0 0;
	 background-size:100% 100%;
<?php
    css::left('0%');
    css::top('0%');
?>
}
<?php divRepair();?> div#switch button#body{
	 background:url('../images/body.png') no-repeat 0 0;
	 background-size:100% 100%;
<?php
    css::left('0%');
    css::bottom('0%');
?>
}
<?php divRepair();?> div#switch button#inter{
	 background:url('../images/interior.png') no-repeat 0 0;
	 background-size:100% 100%;
<?php
    css::right('0%');
    css::top('0%');
?>
}
<?php divRepair();?> div#switch button#docs{
	 background:url('../images/documents.png') no-repeat 0 0;
	 background-size:100% 100%;
<?php
    css::right('0%');
    css::bottom('0%');
?>
}
/*
left div
*/
<?php
    //lStatView('dt', '28%', '33%');
    //lStatView('body', '60%', '65%');
?>
<?php divRepair();?> div#cid0{
<?php
    css::lm();
    css::top('28%');
?>
}
<?php divRepair();?> div img{
<?php
    //posAbs();
    css::top('15%');
    css::size('100%', '50%');
    css::bgSize('100%', '100%');
?>
}
<?php divRepair();?> div h2{
<?php
    css::top('0%');
    css::width('100%');
    css::height('1.8vw');
?>
}

<?php divRepair();?> div progress{
<?php
    posAbs();
    css::bottom('0%');
    css::left('0%');
    css::width('100%');
?>
}
<?php divRepair();?> div#cid1 h2{
    <?php
    //css::lm();
    //css::top('60%');
?>
}
<?php divRepair();?> div#cid1{
<?php
    css::lm();
    css::top('59%');
?>
}
/*
right div
*/
<?php
    //rStatView('interior', '28%', '33%');
    //rStatView('docs', '60%', '65%');
?>
<?php divRepair();?> div#cid2 h2{
<?php
    //css::rm();
    //css::top('28%');
?>
}
<?php divRepair();?> div#cid2{
<?php
    css::rm();
    css::top('28%');
?>
}
<?php divRepair();?> div#cid3 h2{
<?php
    //css::rm();
    //css::top('60%');
?>
}
<?php divRepair();?> div#cid3{
<?php
    css::rm();
    css::top('59%');
?>
}