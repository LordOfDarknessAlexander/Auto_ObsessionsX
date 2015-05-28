<?php
require_once 'include/html.php';
require_once 'include/dbConnect.php';
html::doctype();
?>
<html lang=en>
<head>
<?php
html::title('Slots');
html::charset();
?>
<link rel='stylesheet' type='text/css' href='Users/includes.css'>
<link rel='stylesheet' type='text/css' href='css/auto.php'>
<link rel = 'stylesheet' href = 'Slots/gameStyles/gameStyleSheet.css'>
<script type='text/javascript' src='//code.jquery.com/jquery-2.1.0.min.js'></script>
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
</head>
<body>
<div id='container'>
<?php
//require 'include/header.php';

?>
	<div id='Slots'><!-- Start of the page-specific content. -->
        <h2>Slots</h2>
		
		
		<body>
						
		<!--The Sound files-->
		<audio id = 'youLose' src = 'sounds/car_skid_and_crash.mp3'></audio>
		<audio id = 'reelSpinning' src = 'sounds/single_race_car_passing_by_1.mp3'></audio>
		<audio id = 'startSpin' src = 'sounds/auto_car_pull_away_squealing_tyres.mp3'></audio>
		<audio id = 'betSound'	src = 'sounds/coin_drop.mp3'></audio>
		<audio id = 'winSound' src = 'sounds/gold_coins.mp3'></audio>
		
		<!--Main Canvas-->
		<div id = 'maindiv'>
			
		<canvas id="backgroundImage"></canvas> 			
		
		<!--Text Divs-->
					<div id = 'welcomeTextDiv'></div>
					<div id = 'resultsTextDiv'></div>
					<div id = 'bankValue'></div>
					<div id = 'wonTextDiv'></div>
					<div id = 'betText'></div>
					<div id = 'betValue'></div>
					<div id = 'placeBetText'></div>
					
		<!--Buttons-->
					<button id = 'slotStop'></button>
					<button id = 'spinButton'></button>
					<button id = 'raiseBetButton'></button>
					<button id = 'lowerBetButton'></button>
					<button id = 'maxBetButton'></button>
					<button id = 'minBetButton'></button>
					<button id = 'payPalButton'></button>
					
		<!--Slot Windows-->
		<canvas id = 'slot1'></canvas>
		<canvas id = 'slot2'></canvas>
		<canvas id = 'slot3'></canvas>
					
		<!--Lights-->
					
		<!--left-->
					<div id="leftHead"></div>
					<div id="upperLeftSmall"></div>
					<div id="lowerLeftSmall"></div>
					<div id="LeftFog"></div>
					
		<!--right-->
					<div id="rightHead"></div>
					<div id="upperRightSmall"></div>
					<div id="lowerRightSmall"></div>
					<div id="RightFog"></div>
					
		</div>
				
		<script type='text/javascript' src='Slots/src/miniSlots.js'></script>				
	</body>
		
		
		
		
		
		
		<li><a href='index.php' title='Home Page'>Home</a><br></li>
        <!-- End of the page-specific content. -->
    </div>
</div>	
<?php
require 'phtml/legal.php';
html::footer();
?>