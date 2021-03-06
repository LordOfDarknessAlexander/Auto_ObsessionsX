<?php
//core/meta ui element stylings,
//which apply to all elements across the page
//this css is included in
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
function btn(){
    //
    ?>button<?php
}
?>
*, *:before, *:after {
    box-sizing: border-box;
}

body{
    font-family: arial, sans-serif;
    font-size: 16px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    cursor: default;
    color: #751ec3;
}

canvas{
    position: absolute;
    top: 0;
    left: 0;
    border: 1px solid black;
    z-index: 1;
    width: 100%;
    height: 100%;
}

<?php //default element stylings for the entire page?>
/* Auctions America Banner  */
div#aAmerica{
	/*height : 200px;*/
	font-weight: bold;
	margin-left : 28%;
	color: #FF2E00;
	margin-top : 2%;
	text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
}
ul{
    list-style: none;
    padding: 0;
   /* margin: 0;*/
	margin: 2%;
	display:inline;
	margin-bottom : 2%;
	margin-top: -2%;
	
}
li{
    /*padding: 10px 0;*/
	display:inline;
	margin: 2%;
	/*margin-bottom : 2%;*/
	margin-top: 2%;
	border-box : yellow;
}
li:hover{
    /*padding: 10px 0;*/
	display:inline;
	margin: 2%;
	/*margin-bottom : 2%;*/
	margin-top: 2%;
	
	
}

a{
<?php //styling for all anchor elements on page?>
    text-decoration: none;
    color:blue;
    text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
}
p#legal{
    font-size:0.65em;
    color:white;
    
    position:absolute;
    bottom:0%;
    left:0%;
}
textarea#comment-form{
    resize: none;
}
/*
Proress bar styles
*/
progress{
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
<?php css::bgColor('red');?>
}
progress.high::-webkit-progress-value{
<?php css::bgColor('green');?>
}
progress.med::-webkit-progress-value{
<?php css::bgColor('yellow');?>
}
<?php //Firefox pb stylings?>
progress::-moz-progress-bar{
<?php css::bgColor('red');?>
}
progress.high::-moz-progress-bar{
<?php css::bgColor('green');?>
}
progress.med::-moz-progress-bar{
<?php css::bgColor('yellow');?>
}
<?php //EI pb stylings?>
/*
Forms
*/
div#loginfields{
	font-size:0.75em;
    color:white;
    position:absolute;
    top:32%;
    right:30%;
	/*margin-left :60%;
	margin-top: 4%;*/
}
#progress{
  height: 12%;
  margin: auto;
  position: absolute;
  top: 0; left: 0; bottom: 0; right: 0;
}

#percent{
  color: white;
  font-weight: bold;
  text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
}

#progress-bar{
  width: 200px;
}
/*
Button styles
*/
<?php btn();?>{
    /*all button elements will share this background (and other properties) unless otherwise specified*/
	background: url('../images/defaultBtn.png') no-repeat 0 0;
    background-size:100% 100%;
	color:red;
    cursor:pointer;	
}
<?php btn();?>:hover {
    /*mouse over*/
	background: url('../images/defaultBtn2.png') no-repeat 0 0;
	background-size:100% 100%;
    color:yellow;
    border: 2px yellow solid;
}
<?php btn();?>.select{
    /*mouse clicked and active*/
	background: url('../images/icons/btnSelect.png') no-repeat 0 0;
	background-size:100% 100%;
    color:green;
}
<?php btn();?>:active {
    /*mouse pressed*/
    color:yellow;
}
<?php btn();?>#backBtn{
    /*sets properties for all button tags with id backBtn*/
<?php
    posAbs();
    css::size('5%', '7.5%');
    //lm();
    css::marginBtm();
?>
	background: url('../images/backBtn.png') no-repeat 0 0;
	background-size : 100% 100%;

	left:5%;
}
<?php btn();?>#homeBtn{
<?php
    posAbs();
    css::size('5%', '7.5%');
    //rm();
?>
	background: url('../images/homeBtn.png') no-repeat 0 0;
    background-size : 100% 100%;
    
	right:5%;
<?php css::marginBtm();?>
    margin:0%;
    
    /*font-weight: bold;*/
}

/*
pre styles(preformated text)
*/
pre#info{
<?php
    posAbs();
    css::left('20%');
    css::size('60%', '11%');
    css::bgColor('grey');
    css::txtAlignCntr();
    scrollY();
?>
    bottom:72%;
    font-size:1vw;
    z-index:2;
    /*opacity:50%;*/
}
/*
Divs
*/
div#filter{
    font-size:1.5vw;
<?php
    posAbs();
    css::txtAlignL();
?>
	left:1%;
    top:30%;
	width:8%;
}
div#filter div button{
    width:100%;
<?php css::txtAlignCntr();?>
}
/*
Document root
*/
.wrapper{
<?php
    posAbs();
    css::left('0%');
    css::top('0%');
    css::size('100%', '100%');
?>
    /*z-index:1;*/
    color:red;
}
/*
img styles
*/
img#aoLogo{
    position:absolute;
    left:12%;
    bottom:5%;
    width:80%;
    object-fit:contain;
}
img#adBar{
<?php
    posAbs();
    css::left('20%');
    css::size('60%', '8%');
    css::marginBtm();
?>
    z-index:3;
    /*background:url('../images/logos/AutoZone.png') no-repeat 0 0;*/
}
<?php //Game Screen/State stylings?>
#Register{
  background-image: url('../images/Splash.png')no-repeat 0 0;
  color: white;
  background-size : 100% 100%;
  width: 100%;
  height: 100%;
  z-index: 20;
}

#splash{
  background-image: url('../images/logo.png')no-repeat 0 0;
  background-size : 100% 100%;
  width: 100%;
  height: 100%;
  z-index: 20;
}
<?php //Stat Bar Game HUD?>
div#statBar{
<?php
    posAbs();
    css::top('0%');
    css::left('0%');
    css::size('100%', '15%');
    css::txtAlignL();
?>
	background: url('../images/statBarTile.png');	
	/*child elements inherit values, unless otherwise specified*/
	font-family:"Kozuka Gothic Pro B";
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
div#statBar label#markers{left:75%;top:75%;}
/*
*/
div#achievement{
<?php
    posAbs();
    css::size('100%', '15%');
    css::txtAlignL();
?>
	background: url('../images/stop.png');
	top:0%;
	left:0%;
	
	/*child elements inherit values, unless otherwise specified*/
	font-family:"Kozuka Gothic Pro B";
	color:red;
	font-weight: bold;
	z-index : 2;
	font-size:2.0vw;
}
img#mainCar{
<?php
    posAbs();
    css::size('60%', '60%');
?>
	left:20%;
	bottom:12%;
    z-index:2;
    /*object-fit:contain;*/
}
/*
nav bar
*/
div#reg-navigation{
<?php
    posAbs();
    defaultBtnBG();
    css::txtAlignCntr();
?>
    right:1%;
    /*width:18%;*/
    height:10%;
    z-index:3;
	top : 16%;
}

div#reg-navigation a{
<?php
    defaultBtnBG();
    //css::bgSize('100%', '100%');
?>
    color: red;
    font-weight: bold;
    text-decoration: none;
	padding : 2%;
	top : 19%;
}
div#reg-navigation a:hover{
<?php
    //mouse over
    css::defaultBG('../images/defaultBtn2.png');
    css::bgSize('100%', '100%');
?>  
	color:yellow;
	padding : 2%;
	top : 19%;
	border: 2px solid yellow;
}
div#navigation{
<?php
    posAbs();
    defaultBtnBG();
    css::txtAlignCntr();
?>
    left:1%;
    /*width:18%;*/
    height:10%;
    z-index:3;
	top : 16%;
}

div#navigation a{
<?php
    defaultBtnBG();
    //css::bgSize('100%', '100%');
?>
    color: red;
    font-weight: bold;
    text-decoration: none;
	padding : 2%;
	top : 19%;
}
div#navigation a:hover{
<?php
    //mouse over
    css::defaultBG('../images/defaultBtn2.png');
    css::bgSize('100%', '100%');
?>  
	color:yellow;
	padding : 2%;
	top : 19%;
	border: 2px solid yellow;
}


/* visited link */
#div#main a:visited {
    color: #00FFFF;
}
/* mouse over link */
div#main a:hover {
<?php
    //mouse over
    css::defaultBG('../images/defaultBtn2.png');
    css::bgSize('100%', '100%');
?>  
    color:green;
}
/*Root site menu*/
div#menu{
<?php
    css::bgColor('black');
    css::txtAlignCntr();
    css::size('100%', '100%');
?>
    /*background-image:url('../images/AbsuMenu.png');
    background-size : 100% 100%;*/
    position: absolute;
    border: 1px solid black;
	display: inline;
    z-index: 2;
}
div#main{
<?php
    css::size('100%', '100%');
	posAbs();
?>
	top: 0; 
	left: 0;
}
div#main img#drapes{
<?php
    css::size('100%', '100%');
    css::defaultBG('../images/drapes.png');
    css::bgSize('100%', '100%');
	posAbs();
?>
	top: 0; 
	left: 0;
}
/*
credits page UI stylings
*/
#credits{
    display: none;
    line-height: 30px;
    margin: auto;
    position: absolute;
    top: 0; left: 0; bottom: 0; right: 0;
}

#credits li{	/*styling for all li(list item) in div element with id credits*/
    padding: 5px 0;
	display:navigation;
}

.artwork,
.music,
.developer{
    text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
}

.artwork{
    color: #fa8526;
}
.developer{
    color: #13eb8a;
}

.sound{
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
.sound-on{
    background-image: url('../images/soundOn.png');
    background-repeat: no-repeat;
}

.sound-off{
    background-image: url('../images/soundOff.png');
    background-repeat: no-repeat;
}

#enemyBid{
    color:aqua;
}

#main h1{
    color: #AFCAAF;
    text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
    font-size : 100%;
    margin-bottom : 5%;
}

.button{
  	background: url('../images/defaultBtn.png') no-repeat 0 0;
	color:red;
    cursor:pointer;
	background-size: 100% 100%;
	height:4%;
	width:46%;
	position :relative;
	padding: 0.5%;
	margin-top : 1%;
	display: inline;
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

.music{
    color: #e6e71f;
}

.back,
.back:hover{
    margin-top: 10px;
}

div#sold{
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
div#sold label{
    top: 40%;
    left: 0%;
    text-align: center;
    //padding-top: 92px;
    z-index: 1;
    width: 100%;
    height: 100%;
    position: absolute;
}

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

/*
a[title]:hover{
    color:grey;
}
a.tooltip{outline:none; }
a.tooltip strong{line-height:30px;}
a.tooltip:hover{text-decoration:none;} 
a.tooltip span{
    z-index:10;
    display:none;
    /*padding:14px 20px;
    margin-top:50%;
    margin-left:-160px;
    /*width:300px;
    line-height:12px;
}
a.tooltip:hover span{
    display:inline;
    position:absolute; 
    border:2px solid #FFF;
    color:#EEE;
    background:#333; /*url(cssttp/css-tooltip-gradient-bg.png) repeat-x 0 0;
}
.callout{
    z-index:20;
    position:absolute;
    border:0;
    top:-14px;
    left:120px;
}
*/
/*
additionals for CSS3
*/
/*
a.tooltip span
{
    border-radius:2px;        
    box-shadow: 0px 0px 8px 4px #666;
    opacity: 0.8;
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