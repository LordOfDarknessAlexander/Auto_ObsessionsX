<?php
//core/meta ui element stylings,
//which apply to all elements across the page
require_once 'ui.php';
//as long as the required file does not output anything this is fine,
//normally header() should be first line in file, after comments
css::header();
//
//imports relative to this document, or an absolute url.
//makes maintainability easier, allowing structured includes of css sheets
//but prevents asynchronous parsing of files, as if they were included as
//<linl> tags in the html source
//function divStatBar(){
    //echo 'div#statBar';
//}
//@import url("menu.css");
//@import url("credits.css");
?>
*, *:before, *:after {
    box-sizing: border-box;
}

body 
{
    font-family: arial, sans-serif;
    font-size: 18px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    cursor: default;
    color: #751ec3;
}

canvas 
{
    position: absolute;
    top: 0;
    left: 0;
    border: 1px solid black;
    z-index: 1;
    width: 100%;
    height: 100%;
}

<?php //default element stylings for the entire page?>
ul{
    list-style: none;
    padding: 0;
    margin: 0;
}
li{
    /*padding: 10px 0;*/
}

a{
    <?php //styling for all anchor elements on page?>
    text-decoration: none;
    color:blue;
    text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
}
p#legal
{
    font-size:0.65em;
    color:white;
    
    position:absolute;
    bottom:0%;
    left:0%;
}
progress
{
    /*display:none;
    appearance:none;*/
    -moz-appearance:none;
    -webkit-appearance:none;
}
<?php
//google/safari/opera pb stylings?>
progress::-webkit-progress-bar{
    background:grey;
}
progress::-webkit-progress-value{
    background-color:red;
}
progress.high::-webkit-progress-value{
    background-color:green;
}
progress.med::-webkit-progress-value{
    background-color:yellow;
}
<?php //Firefox pb stylings?>
progress::-moz-progress-bar{
    background-color:red;
}
progress.high::-moz-progress-bar{
    background-color:green;
}
progress.med::-moz-progress-bar{
    background-color:yellow;
}
<?php //EI pb stylings?>
#loginfields
{
	font-size:0.75em;
    color:white;
    position:relative;
    bottom:40%;
    right:30%;
	margin-left :10%;
}
#progress 
{
  height: 12%;
  margin: auto;
  position: absolute;
  top: 0; left: 0; bottom: 0; right: 0;
}
#percent 
{
  color: white;
  font-weight: bold;
  text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
}
#progress-bar 
{
  width: 200px;
}
button
{	/*all button elements will share this background (and other properties) unless otherwise specified*/
	background: url('../images/defaultBtn.png') no-repeat 0 0;
    background-size:100% 100%;
	color:red;
    cursor:pointer;	
}
button:hover {
    /*mouse over*/
    color:green;
}
button:active {
    /*mouse pressed*/
    color:blue;
}
button#backBtn
{   /*sets properties for all button tags with id backBtn*/
<?php
    posAbs();
    css::size('5%', '7.5%');
    //lm();
?>
	background: url('../images/backBtn.png') no-repeat 0 0;
	background-size : 100% 100%;

	left:5%;
	bottom:2%;
}
button#homeBtn{
<?php
    posAbs();
    css::size('5%', '7.5%');
    //rm();
?>
	background: url('../images/homeBtn.png') no-repeat 0 0;
    background-size : 100% 100%;
    
	right:5%;
	bottom:2%;
    margin:0%;
    
    /*font-weight: bold;*/
}
pre#info{
<?php //rm();?>
    background-color:grey;
    color:red;
    position:absolute;
    height:10%;
    width:90%;
    bottom:72%;
    left:5%;
    font-size:1vw;
    text-align:center;
    z-index:2;
}
.wrapper 
{
    height:100%;
    width: 100%;
    position: absolute;
    top: 0%;
    left: 0%;
}
img#adBar
{
	/*background:url('../images/logos/AutoZone.png') no-repeat 0 0;*/
	position:absolute;
	width:60%;
	height:8%;
	left:20%;
	bottom:2%;
    z-index:3;
}
<?php //Game Screen/State stylings?>
#Register
{
  background-image: url('../images/Splash.png')no-repeat 0 0;
  color: white;
  background-size : 100% 100%;
  width: 100%;
  height: 100%;
  z-index: 20;
}
/*#login
{
	position: absolute;
	float: left;
	top : 20%;
	
}*/

#splash
{
  background-image: url('../images/Splash.png')no-repeat 0 0;
  background-size : 100% 100%;
  width: 100%;
  height: 100%;
  z-index: 20;

}
<?php //Stat Bar Game HUD?>
div#statBar{
<?php
    posAbs();
    css::size('100%', '15%');
?>
    /*background-color:red;*/
	background: url('../images/StatBar.png') no-repeat 0 0;
	background-size : 100%,40%;
	top:0%;
	left:0%;
	
	/*child elements inherit values, unless otherwise specified*/
	font-family:"Kozuka Gothic Pro B";
	text-align:left;
	color:red;
	font-weight: bold;
	z-index : 2;
	font-size:2.0vw;
}
div#statBar label{
    position:absolute;
    width:25%;
}
div#statBar label#money{left:0%;top:75%;}
div#statBar label#tokens{left:25%;top:75%;}
div#statBar label#prestige{left:50%;top:75%;}
div#statBar label#m_marker{left:75%;top:75%;}

img#mainCar{
<?php
    posAbs();
    css::size('60%', '60%');
?>
	left:20%;
	bottom:12%;
    z-index:2;
}
/*
nav bar
*/
div#reg-navigation{
<?php
    posAbs();
    defaultBtnBG();
?>
    top:0%;
    right:0%;
    z-index:3;

}
div#reg-navigation a{
<?php
    defaultBtnBG();
    //css::bgSize('100%', '100%');
?>
    color: red;
    font-weight: bold;
    text-decoration: none;
    text-align:center;
	padding : 2%;
}
div#reg-navigation a:hover{
<?php
    //mouse over
    css::defaultBG('../images/defaultBtn2.png');
    css::bgSize('100%', '100%');
?>  
	color:green;
	padding : 2%;
}
/* visited link */
#div#main a:visited {
    color: #00FFFF;
}
/* mouse over link */
div#main a:hover {
    color:purple;
}
/*Root site menu*/
div#menu
{
    background-image:url('../images/AbsuMenu.png');
    background-size : 100% 100%;
    position: absolute;
    width: 100%;
    height: 100%;
    border: 1px solid black;
    z-index: 2;
    text-align: center;
    background-color: black;
}
/*
credits page UI stylings
*/
#credits 
{
    display: none;
    line-height: 30px;
    margin: auto;
    position: absolute;
    top: 0; left: 0; bottom: 0; right: 0;
}
#credits li 
{	/*styling for all li(list item) in div element with id credits*/
    padding: 5px 0;
}

.artwork, .music, .developer 
{
    text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
}

.artwork 
{
    color: #fa8526;
}
.developer 
{
    color: #13eb8a;
}

.sound 
{
    background-size:100% 100%;
    display: none;
    position: absolute;
    bottom:5%;
    left:0%;
    width: 5%;
    height:5%;
    cursor: pointer;
    z-index: 3;
}
.sound-on 
{
  background-image: url('../images/soundOn.png');
  background-repeat: no-repeat;
}

.sound-off 
{
  background-image: url('../images/soundOff.png');
  background-repeat: no-repeat;
}

#enemyBid
{
 color:aqua;	
}

#main h1 
{
  color: #AFCAAF;
  text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
}

.button 
{
  	background: url('../images/defaultBtn.png') no-repeat 0 0;
	color:red;
    cursor:pointer;
	background-size: 100% 100%;
	height:4%;
	width:46%;
	position :relative;
	padding: 0.5%;
	margin-top : 1%;
	margin-bottom : 1%;
    line-height: 40px;
    border: 1px solid #AA2666;
    font-weight: bold;
   text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
   border-radius: 3px;
}

.button:hover 
{
	background: url('../images/defaultBtn2.png') no-repeat 0 0;
    color:green;
    cursor:pointer;
	background-size: 100% 100%;
	height:4%;
	width:46%;
	margin-top : 1%;
	margin-bottom : 1%;
	position :relative;
	padding: 0.5%;
    line-height: 40px;
    border: 1px solid #AA2666;
    font-weight: bold;
   text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
   border-radius: 3px;;
}

.music 
{
  color: #e6e71f;
}

.back, .back:hover 
{
  margin-top: 10px;
}

#sold 
{
 /* background-image: url('../images/logo.png');*/
  display: none;
  text-align: center;
  margin-top: 0em;
  padding-top: 92px;
  z-index: 1;
  width: 100%;
  height: 100%;
  position: absolute;
}
#sold label
{
  top: 40%;
  left: 0%;
  text-align: center;
  //padding-top: 92px;
  z-index: 1;
  width: 100%;
  height: 100%;
  position: absolute;
}
/*div#profile
{
    background: url('../images//defaultBG.jpg') no-repeat 0 0;
	background-size : 100% 100%;
    display: none;
    text-align: center;
    width: 100%;
    height: 100%;
    position: absolute;
    top:0%;
    left:0%;
    z-index:1;
}*/
/*
div#messages
{
    background: url('../images/defaultBG.jpg') no-repeat 0 0;
	background-size : 100% 100%;
    display: none;
    text-align: center;
    width: 100%;
    height: 100%;
    position: absolute;
    top:0%;
    left:0%;
    z-index:1;
}
div#ranks
{
    background: url('../images/defaultBG.jpg') no-repeat 0 0;
    display: none;
    text-align: center;
    width: 100%;
   height: 100%;
    position: absolute;
    top:0%;
    left:0%;
    z-index:1;
}
div#search
{
    background: url('../images/defaultBG.jpg') no-repeat 0 0;
    display: none;
    text-align: center;
    width: 100%;
    height: 100%;
    position: absolute;
    top:0%;
    left:0%;
    z-index:1;
}
div#business
{
    background: url('../images/defaultBG.jpg') no-repeat 0 0;
    display: none;
    text-align: center;
    width: 100%;
    height: 100%;
    position: absolute;
    top:0%;
    left:0%;
    z-index:1;
}*/
<?php
//require_once 'main.php';    //main game menu stylings, must be added at end, else bugs
//require_once 'phone.php';   //mobile phone, iPhone, Android, WIndows, BB, etc
//require_once 'tablet.php';  //tablets, iPads, etc
//require_once 'laptop.php';  //laptop and other large mobile devices
?>

/* Smartphones (portrait) ----------- */
@media only screen and (max-width : 320px) 
{
/* Styles */
	

}

/* iPads (portrait and landscape) ----------- */
@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) 
{
/* Styles */
}

/* iPads (landscape) ----------- */
@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : landscape) 
{
/* Styles */
	


}

/* iPads (portrait) ----------- */
@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : portrait) 
{
/* Styles */
}
/**********
iPad 3
**********/
@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : landscape) and (-webkit-min-device-pixel-ratio : 2) 
{
/* Styles */
}

@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : portrait) and (-webkit-min-device-pixel-ratio : 2) 
{
/* Styles */
}
/* Desktops and laptops ----------- */
@media only screen  and (min-width : 1224px) 
{
/* Styles */