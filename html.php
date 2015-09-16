<?php
$PAGE_TITLE = 'Auto Obsessions';
class html
{   //static class representing common html document fragments
    public static function docType(){?>
<!DOCTYPE html>
<?php
    }
    public static function charset(){?>
<meta charset='UTF-8'>
<?php
    }
    public static function keywords($str){
        //injects keywords meta-tag at call site,
        //pass in a comma separated list of keywords as a string?>
        <meta name='keywords' content='<?php echo $str;?>'>
<?php
    }
    public static function title($str){
        //injects html title tag at call site?>
        <title><?php echo $str;?></title>
<?php
    }
    public static function header(){
        global $PAGE_TITLE;
        //default header for application, can be changed in derived classes
        html::docType();
?>
<html>
<head>
    <meta name='viewport' content='width=device-width, initial-scale=1,user-scalable=no,orientation=portrait'>
<?php
    html::charset();
    //html::keywords('Car, Auction, upgrades, hotrods, muscle cars');
    html::title($PAGE_TITLE);
    require_once 'meta.php';    //if no CSS, JS or additional scripts are needed leave file empty
?>
</head>
<body>
<?php
    //devs can customize <body>'s content for each app,
    //without having to reapeat the code bloat,
    //additionally, the paths are conditional on the files being hosted by server in ROOT_DIR,
    //devs may change the contents of these file stubs to suit their needs-->
    }
    public static function footer(){
        //Generic html document footer, nothing special, primarily contains end tags-->
?>
</body>
</html>
<?php
    }
    public static function br(){
        //line break?>
<br>
<?php
    }
    public static function hr(){
        //thematic change?>
<hr>
<?php
    }
    public static function incCSS($str){
        //the html within this function will be injected at the call site?>
<link rel='stylesheet' href='<?php echo "css/".$str.".css";?>' type='text/css' media='screen'>
<?php
    }
    public static function incPHPCSS($str){
        //links a style sheet embedded in php?>
<link rel='stylesheet' href='<?php echo "css/".$str.".php";?>' type='text/css' media='screen'>
<?php
    }
    public static function incJS($str){
    //this script generates the <script> tags to be included in the <head> of the page's html document?>
    <script type='text/javascript' src='<?php echo "js/".$str.".js";?>'></script>
<?php
    }
    public static function simpleHead($title){
        //outputs default, non-secure page header
        html::docType();
?>
<html>
<head>
<?php
        html::charset();
        html::title($title);		
?>
    <style>
        body{
            background:#000000 url('./images/bgTile.png') repeat 0 0;
            font-family:Arial, Helvetica, sans-serif;
            font-size:13px;
            color: red;
        }
        li,h1 {color: white;}
        td{
            font-family:Arial, Helvetica, sans-serif;
            font-size:1em;
            color:black;
        }
        hr{ color:#3333cc; width:300; text-align:left;}
        a{ color:darkmagenta; }
    </style>
</head>
<body>
<?php
        //devs add page content after this call
    }
    public static function escape($str){
        return htmlspecialchars($str);
    }
    public static function ep($str){
        //safely echos the entry in $_POST
        if(isset($_POST) && isset($_POST[$str])){
            //trim removes access whitespace around start and end of entry,
            $t = trim($_POST[$str]);
            echo html::escape($t);
        }
    }
	public static function memberStyles(){
               //outputs members pages styles
        html::docType();
?>
<html>
<head>
<?php
        html::charset();
        
?>
    <style>
	 *, *:before, *:after {
	  box-sizing: border-box;
	}
	body{
		font-family: arial, sans-serif;
		font-size: 100%;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
		cursor: default;
		color:white;
		width:100%;
		height: 100%;
		position:absolute;
		margin:0%;
	}

	/*Headers*/
	h1 {
		color: white;
		text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
		left: 4%;
		top: -18%;
		position: absolute;
		
	}
	h2 {
		font-size:150%;
		color:red;
		text-align:left;
		top:10%;
		left:60%;
		position: abosolute;
	}
	h3 {
		font-size:110%;
		color:white;
		text-align:center;
		top:60%;
		left:30%;
		position: abosolute;
	}
	table {
		width:800px;
		border:1px white solid;
		border-collapse:collapse;
		margin-left: -5%;
		margin-top: 5%;
		position: relative;
	}
	td {
		border:1px white solid;
		padding:1px 0 1px 4px;
		text-align:left;
		position: relative;
	}
	form {
		margin-left:-1%;
		margin-top: 0%;
		width:100%;
		position: relative;
	}
	ul {
		position:abosolute;
		top:70%;
		left:58%;
		color:#52005C;
		text-align:center;
		margin:0;
		 width:100%;
		height:100%;
	}
	/* set general side button styles */

	li {
		width:100%;
		height:100%;
		list-style-type :none;
		/*margin-bottom: 1px;*/
		text-align: center;
		position: abosolute;
	}

	div#container {
		position:absolute; 
		margin:auto;
		text-align:left; 
		background: url('images/Splash.png') no-repeat 0 0;
		background-size : 100% 100%;
		height: 60%;
		width: 80%;
		top:20%;
		left:10%;
		z-index : 1%;
	}
	div#loginfields{
		position:absolute;
		top:25%;
		left:25%;
		width:50%;
		height:50%;
		text-align:center;
	}
	form#reg{
		position:absolute;
		left:0%;
	}
	div#nav{
		position:absolute;
		top:8%;
		left:0%;
		z-index : 10%;
		
	}
	div#nav : hover{
		position:absolute;
		top:8%;
		left:0%;
		z-index : 10%;
		border: 2px solid yellow;
	}
	/*Page Content*/
	div#content{
		position:abosolute;
		top: 40%;
		left: 40%;
	}
	div#content h2{
		position:relative;
		left:25%;
		top: 40%;
	}
	#midcol{
		width:80%;
		margin:auto;
		position: abosolute;
		top: 70%;
		margin-top: 40%;
	}
	#midcol2{
		width:80%;
		margin:auto;
		position:absolute;
		top:22%;
		left:12%;
		padding : 2%;
	}
	#mid-left-col{
		width:36%;
		left : 30%;
		text-align:left;
		position:absolute;
		top:70%;
		padding : 2%;
	}
	#mid-right-col{
		width:16%;
		right: 30%;
		text-align:left;
		position:absolute;
		right:0%;
		top:20%;
		padding : 2%;
	}
	#info-col 
	{ 
		position:abosolute;
		bottom:28%;
		margin-top : 25%;
		right:33%;
		color:navy;
		width:100%;
		text-align:center;
		margin:5px 5px 0 0;
	}
	div#playerData
	{
		top:10%;
		left:10%;
		color:red;
		width:60%;
		height:10%;
		text-align:left;
		position:absolute;
	}
	div#imog 
	{
		background: url('images/polo.png') no-repeat 0 0;
		background-size:100% 100%;
		width : 280px;
		height : 207px;
		left: -60%;
		position : relative;
	}

	/* setting anchor styles */
	div#reg-navigation{
		position:absolute;
		top:8%;
		right:0%;
		z-index:5;
		/*background-color:grey;*/
	}
	li a,
	div#nav a,
	div#reg-navigation a{
		display:block;
		color: red;
		font-weight: bold;
		text-decoration: none;
		text-align:center;
		background: url('images/defaultBtn.png') no-repeat 0 0;
		background-size:100% 100%;
		position: abosolute;
	}
	/* mouseover */
	li a:hover,
	div#nav a:hover,
	div#reg-navigation a:hover{
		background: url('images/defaultBtn2.png') no-repeat 0 0;
		background-size:100% 100%;
		color:yellow;
		border: 2px solid yellow;
	}
	/* onmousedown */
	li a:active,
	div#nav a:active,
	div#reg-navigation a:active {
		background:#aecbff;
		border: 4px inset yellow;
		color: blue;
	}

	p.error {
		color:red;
		font-size:75%;
		font-weight:bold;
		text-align:left;
		position:relative;
		right:0%;
		height:70%;
		width:50%;
	}
	.label {
		float:left;
		width:210px;
		text-align:left;
		clear:left;
		margin-right:5px;
		position: relative;
	}
	span.left {
		text-align:left;position: relative;
	}
	p#legal
	{
		font-size:0.65em;
		color:white;
		position:absolute;
		bottom:0%;
		left:0%;
	}
    </style>
</head>
<body>
<?php
        //devs add page content after this call
    }
	public static function slotStyles(){
               //outputs members pages styles
        html::docType();
?>
<html>
<head>
<?php
        html::charset();
        
?>
    <style>

	/*Canvas*/
	div#maindiv
	{
		position:absolute;
		/*left:21%;
		top:24%;*/
		left:0%;
		top:0%;
		width:100%;
		height:100%;
		max-width:100%;
		max-height:100%;
		background-position:center center;
		
		background-size:100% 100%;
		overflow:hidden;
	}

	canvas#backgroundImage
	{
		position:absolute;
		left:0%;
		top:0%;
		width:100%;
		height:100%;
		background-image:url('images/SlotMachine.png');
		background-repeat:no-repeat;
		/*background-position:center center;*/
		background-color:black;
		background-size:100% 100%;
		margin:0%;
		z-index:0;
	}

	/*SoltCanvases*/
	canvas#slot1
	{
		position:absolute;
		left:26.7%;
		top:30%;
		width:10%;
		height:15%;
		background-color:antiquewhite;
		z-index: 3;
	}

	canvas#slot2
	{
		position:absolute;
		left:45%;
		top:30%;
		width:10%;
		height:15%;
		background-color:antiquewhite;
		z-index: 3;
	}

	canvas#slot3
	{
		position:absolute;
		left:63.3%;
		top:30%;
		width:10%;
		height:15%;
		background-color:antiquewhite;
		z-index: 3;
	}

	/*Text Divs*/
	div#welcomeTextDiv
	{
		position:absolute;
		left:0%;
		top: 0%;
		width:100%;
		height:2%;
		font-family:Digifit;
		font-size:medium;
		text-align:center;
		color:red;
		z-index: 3;
	}

	div#resultsTextDiv
	{
		position:absolute;
		left:20%;
		top:15%;
		width:60%;
		height:2%;
		font-family:Digifit;
		font-size:medium;
		text-align:center;	
		color:teal;
		z-index: 3;
	}

	div#wonTextDiv
	{
		position:absolute;
		left:25%;
		top:45%;
		width:50%;
		height:3%;
		font-family:Digifit;
		font-size:medium;
		text-align:center;
		color:darkviolet;
		z-index: 3;
	}

	div#bankValue
	{
		position:absolute;
		left:0%;
		top:5%;
		width:20%;
		height:5%;
		font-family:Georgia, "Times New Roman", Times, serif;
		font-size:large;
		text-align:center;
		color:silver;
		z-index: 3;
	}

	/*Buttons*/
	button#spinButton
	{
		position:absolute;
		left:7%;
		top:65%;
		width:16%;
		height:9%;
		background-image:url('images/SpinButton.png');
		background-repeat:no-repeat;
		background-position:center;
		background-size:100% 100%;
		z-index: 3;
	}

	button#slotStop
	{
		position:absolute;
		left:71%;
		top:65%;
		width:21%;
		height:12.5%;
		background-image:url('images/stopButton.png');
		/*background-position:center;*/
		background-repeat:no-repeat;
		background-size:100% 100%;
		z-index: 3;
	}
	button#payPalButton
	{
		position:absolute;
		left:0%;
		top:20%;
		width:17.3%;
		height:7.6%;
		background-image:url('images/TempPayPalButton.png');
		background-repeat:no-repeat;
		background-size:100% 100%;
		z-index: 3;

	}


	/*Light Anim*/
	/*Right*/
	div#rightHead
	{
		position:absolute;
		width:8%;
		height:11.5%;
		left:85.83%;
		top:33.5%;
		
		-moz-transition:all 0.25s ease-in-out;
		-webkit-transition:all 0.25s ease-in-out;
		-o-transition:all 0.25s ease-in-out;
		-ms-transition:all 0.25s ease-in-out;
		transition:all 0.25s ease-in-out;
		
		/* order: name, direction, duration, iteration-count, timing-function */
		-moz-animation:blink normal .5s infinite ease-in-out; /* Firefox */
		-webkit-animation:blink normal .5s infinite ease-in-out; /* Webkit */
		-ms-animation:blink normal .5s infinite ease-in-out; /* IE */
		animation:blink normal .5s infinite ease-in-out; /* Opera */
		
		-moz-animation-play-state:paused;
		-webkit-animation-play-state:paused;
		-ms-animation-play-state:paused;
		animation-play-state:paused;

		background-image:url('images/Lights/HeadLight.png');
		background-repeat:no-repeat;
		background-size:100% 100%;
		z-index:1;
	}
	div#upperRightSmall
	{
		position:absolute;
		width:3.5%;
		height:5%;
		left:80%;
		top:37.5%;
		
		-moz-transition:all 0.25s ease-in-out;
		-webkit-transition:all 0.25s ease-in-out;
		-o-transition:all 0.25s ease-in-out;
		-ms-transition:all 0.25s ease-in-out;
		transition:all 0.25s ease-in-out;
		
		/* order: name, direction, duration, iteration-count, timing-function */  
		-moz-animation:blink normal .5s infinite ease-in-out; /* Firefox */
		-webkit-animation:blink normal .5s infinite ease-in-out; /* Webkit */
		-ms-animation:blink normal .5s infinite ease-in-out; /* IE */
		animation:blink normal .5s infinite ease-in-out; /* Opera */
		
		-moz-animation-play-state:paused;
		-webkit-animation-play-state:paused;
		-ms-animation-play-state:paused;
		animation-play-state:paused;
		
		background-image:url('images/Lights/SmallLight.png');
		background-repeat:no-repeat;
		background-size:100% 100%;
		z-index:1;
	}
	div#lowerRightSmall
	{
		position:absolute;
		width:3.5%;
		height:5%;
		left:75%;
		top:57.5%;

		-moz-transition:all 0.25s ease-in-out;
		-webkit-transition:all 0.25s ease-in-out;
		-o-transition:all 0.25s ease-in-out;
		-ms-transition:all 0.25s ease-in-out;
		transition:all 0.25s ease-in-out;
		
		/* order: name, direction, duration, iteration-count, timing-function */  
		-moz-animation:blink normal .5s infinite ease-in-out; /* Firefox */
		-webkit-animation:blink normal .5s infinite ease-in-out; /* Webkit */
		-ms-animation:blink normal .5s infinite ease-in-out; /* IE */
		animation:blink normal .5s infinite ease-in-out; /* Opera */

		-moz-animation-play-state:paused;
		-webkit-animation-play-state:paused;
		-ms-animation-play-state:paused;
		animation-play-state:paused;
		
		background-image:url('images/Lights/SmallLight.png');
		background-repeat:no-repeat;
		background-size:100% 100%;
		z-index:1;
	}
	div#RightFog
	{
		position:absolute;
		width:8%;
		height:11.75%;
		left:52.5%;
		top:56%;

		-moz-transition:all 0.25s ease-in-out;
		-webkit-transition:all 0.25s ease-in-out;
		-o-transition:all 0.25s ease-in-out;
		-ms-transition:all 0.25s ease-in-out;
		transition:all 0.25s ease-in-out;
		
		/* order: name, direction, duration, iteration-count, timing-function */  
		-moz-animation:blink normal .5s infinite ease-in-out; /* Firefox */
		-webkit-animation:blink normal .5s infinite ease-in-out; /* Webkit */
		-ms-animation:blink normal .5s infinite ease-in-out; /* IE */
		animation:blink normal .5s infinite ease-in-out; /* Opera */

		-moz-animation-play-state:paused;
		-webkit-animation-play-state:paused;
		-ms-animation-play-state:paused;
		animation-play-state:paused;
		
		background-image:url('images/Lights/FogLight.png');
		background-repeat:no-repeat;
		background-size:100% 100%;
		z-index:1;
	}

	/*Left*/
	div#leftHead
	{
		position:absolute;
		width:8%;
		height:11.5%;
		left:5%;
		top:33.5%;

		-moz-transition:all 0.25s ease-in-out;
		-webkit-transition:all 0.25s ease-in-out;
		-o-transition:all 0.25s ease-in-out;
		-ms-transition:all 0.25s ease-in-out;
		transition:all 0.25s ease-in-out;
		
		/* order: name, direction, duration, iteration-count, timing-function */  
		-moz-animation:blink normal .5s infinite ease-in-out; /* Firefox */
		-webkit-animation:blink normal .5s infinite ease-in-out; /* Webkit */
		-ms-animation:blink normal .5s infinite ease-in-out; /* IE */
		animation:blink normal .5s infinite ease-in-out; /* Opera */

		-moz-animation-play-state:paused;
		-webkit-animation-play-state:paused;
		-ms-animation-play-state:paused;
		animation-play-state:paused;
		
		background-image:url('images/Lights/HeadLight.png');
		background-repeat:no-repeat;
		background-size:100% 100%;
		z-index:1;
	}
	div#upperLeftSmall
	{
		position:absolute;
		width:3.5%;
		height:5%;
		left:15.8%;
		top:37.5%;

		-moz-transition:all 0.25s ease-in-out;
		-webkit-transition:all 0.25s ease-in-out;
		-o-transition:all 0.25s ease-in-out;
		-ms-transition:all 0.25s ease-in-out;
		transition:all 0.25s ease-in-out;
		
		/* order: name, direction, duration, iteration-count, timing-function */  
		-moz-animation:blink normal .5s infinite ease-in-out; /* Firefox */
		-webkit-animation:blink normal .5s infinite ease-in-out; /* Webkit */
		-ms-animation:blink normal .5s infinite ease-in-out; /* IE */
		animation:blink normal .5s infinite ease-in-out; /* Opera */

		-moz-animation-play-state:paused;
		-webkit-animation-play-state:paused;
		-ms-animation-play-state:paused;
		animation-play-state:paused;
		
		background-image:url('images/Lights/SmallLight.png');
		background-repeat:no-repeat;
		background-size:100% 100%;
		z-index:1;
	}
	div#lowerLeftSmall
	{
		position:absolute;
		width:3.5%;
		height:5%;
		left:21.5%;
		top:57.5%;

		-moz-transition:all 0.25s ease-in-out;
		-webkit-transition:all 0.25s ease-in-out;
		-o-transition:all 0.25s ease-in-out;
		-ms-transition:all 0.25s ease-in-out;
		transition:all 0.25s ease-in-out;
		
		/* order: name, direction, duration, iteration-count, timing-function */  
		-moz-animation:blink normal .5s infinite ease-in-out; /* Firefox */
		-webkit-animation:blink normal .5s infinite ease-in-out; /* Webkit */
		-ms-animation:blink normal .5s infinite ease-in-out; /* IE */
		animation:blink normal .5s infinite ease-in-out; /* Opera */

		-moz-animation-play-state:paused;
		-webkit-animation-play-state:paused;
		-ms-animation-play-state:paused;
		animation-play-state:paused;
		
		background-image:url('images/Lights/SmallLight.png');
		background-repeat:no-repeat;
		background-size:100% 100%;
		z-index:1;
	}
	div#LeftFog
	{
		position:absolute;
		width:8%;
		height:11.75%;
		left:39.3%;
		top:56%;

		-moz-transition:all 0.25s ease-in-out;
		-webkit-transition:all 0.25s ease-in-out;
		-o-transition:all 0.25s ease-in-out;
		-ms-transition:all 0.25s ease-in-out;
		transition:all 0.25s ease-in-out;
		
		/* order: name, direction, duration, iteration-count, timing-function */  
		-moz-animation:blink normal .5s infinite ease-in-out; /* Firefox */
		-webkit-animation:blink normal .5s infinite ease-in-out; /* Webkit */
		-ms-animation:blink normal .5s infinite ease-in-out; /* IE */
		animation:blink normal .5s infinite ease-in-out; /* Opera */

		-moz-animation-play-state:paused;
		-webkit-animation-play-state:paused;
		-ms-animation-play-state:paused;
		animation-play-state:paused;
		
		background-image:url('images/Lights/FogLight.png');
		background-repeat:no-repeat;
		background-size:100% 100%;
		z-index:1;
	}

	@-moz-keyframes blink {0%{opacity:1;} 50%{opacity:0;} 100%{opacity:1;}} /* Firefox */
	@-webkit-keyframes blink {0%{opacity:1;} 50%{opacity:0;} 100%{opacity:1;}} /* Webkit */
	@-ms-keyframes blink {0%{opacity:1;} 50%{opacity:0;} 100%{opacity:1;}} /* IE */
	@keyframes blink {0%{opacity:1;} 50%{opacity:0;} 100%{opacity:1;}} /* Opera */
   </style>
</head>
<body>
<?php
        //devs add page content after this call
    }
	
	
	
	
	
}
?>