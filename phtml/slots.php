<?php
require_once './html.php';
require_once './ao.php';
require_once './user.php';
require_once './js/state/slots.php';

?>
<html lang=en>
<head>
<?php

html::slotStyles();
html::simpleHead('Auto-Obsessions Slots');

?>
<script type='text/javascript' src='//code.jquery.com/jquery-2.1.0.min.js'></script>
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>

</head>
<div id='container'>

	<div id='Slots'><!-- Start of the page-specific content. -->
      
		<body>	
		 <h2>Slots</h2>
            <!--The Sound files-->
            <audio id = 'youLose' src = 'sounds/car_skid_and_crash.mp3'></audio>
            <audio id = 'reelSpinning' src = 'sounds/single_race_car_passing_by_1.mp3'></audio>
            <audio id = 'startSpin' src = 'sounds/auto_car_pull_away_squealing_tyres.mp3'></audio>
            <audio id = 'winSound' src = 'sounds/gold_coins.mp3'></audio>
            
            <!--Main Canvas-->
            <div id = 'maindiv'>			
                <canvas id="backgroundImage"></canvas>		
                <!--Text Divs-->
                <div id = 'welcomeTextDiv'></div>
                <div id = 'resultsTextDiv'></div>
                <div id = 'bankValue'></div>
                <div id = 'wonTextDiv'></div>
                <!--Buttons-->
		
				<button id = 'slotStop' class='button slotStop' ><?php user::addTokens(); ?></button>
				<button id = 'spinButton' class='button spinButton'></button>
				</div>
                <!--<button id = 'spinButton'></button> -->
               
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
					
          <!-- <script type='text/javascript' src='js/miniSlots.js'></script>	-->	
        </body>		
        <!-- End of the page-specific content. -->
    </div>
</div>	<!-- End of the slots container content. -->
<?php
//require './legal.php';
//require_once './js/state/slots.php';
?>
	