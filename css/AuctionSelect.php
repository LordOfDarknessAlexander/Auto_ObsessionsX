<?php
//auction state stylings
header("Content-type: text/css; charset: UTF-8");
//    
function divAS(){
    echo 'div#AuctionSelect';
}
require_once 'ui.php';
?>
/*Action UI stylings*/
<?php divAS();?>
{	/*Auction page stylings*/ 
<?php
    posAbs();
    defaultBG();
    css::size();
?>
	display: none;
	/*overflow:scroll;*/
	text-align: center;
	padding-top: 92px;
	z-index: 1;
}
<?php divAS();?> ul
{
	margin:0;
	padding:0;
	list-style-type:none;
}
<?php divAS();?> li
{
	margin:0 0 5% 0;	/*top right bottom left*/
	/*padding: 50px 50px;
	display:inline;*/
}
<?php divAS();?> li label#infoLabel
{
	background-color:grey;
	text-align:center;
<?php posAbs();?>
	left:20%;
	width:60%;
	height:20%;
}
<?php divAS();?> li button
{
	background: url('../images/defaultBtn.png') no-repeat 0 0;
<?php posAbs();?>
	right: 5%;
	height:20%;
	width:15%;
	color:red;
}
<?php divAS();?> li button label
{
	font-size:1.25em;
	/*font-family::;
	display:inline;
	position:absolute;*/
	text-align::center;
	color:red;
}
<?php divAS();?> li img
{
<?php posAbs();?>
	left:5%;
	width:15%;
	height:20%;
}

#asBackButton
{
	background: url('../images/backBtn.png') no-repeat 0 0;
	color: white;
	font-weight: bold;
	width:150px;
	height:50px;
	cursor:pointer;
}
<?php divAS();?> div#carView
{
<?php posAbs();?>
    overflow-y:scroll;
    bottom:0%;
    left:0%;
    width:100%;
    height:60%;
}