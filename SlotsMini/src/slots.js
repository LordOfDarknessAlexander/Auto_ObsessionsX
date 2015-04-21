(document).ready(function()
{
	//Reels 
	var slot1Canvas = document.getElementById('slot1');
	var slot1Context = slot1Canvas.getContext('2d');
	var slot2Canvas = document.getElementById('slot2');
	var slot2Context = slot2Canvas.getContext('2d');
	var slot3Canvas = document.getElementById('slot3');
	var slot3Context = slot3Canvas.getContext('2d');
	
	//Buttons
	var lowerBetButton = document.getElementById('lowerBetButton');
	var raiseBetButton = document.getElementById('raiseBetButton');
	var maxBetButton = document.getElementById('maxBetButton');
	var minBetButton = document.getElementById('minBetButton');
	var slotStopButton = document.getElementById('slotStop');
	var spinButton = document.getElementById('spinButton');
	
	//lights
	var rightSignalLight = document.getElementById('rightSignal');
	var rightUpHeadLight = document.getElementById('upperRightHead');
	var rightLowerHeadLight = document.getElementById('lowerRightHead');
	var rightUpRunningLight = document.getElementById('upperRightRunning');
	var rightLowerRunningLight = document.getElementById('lowerRightRunning');
	
	var leftSignalLight = document.getElementById('leftSignal');
	var leftUpHeadLight = document.getElementById('upperLeftHead');
	var leftLowerHeadLight = document.getElementById('lowerRightHead');
	var leftUpRunningLight = document.getElementById('upperLeftRunning');
	var leftLowerRunningLight = document.getElementById('lowerLeftRunning');
	
	//Play data
	var slot1 = [];
	var slot2 = [];
	var slot3 = [];
	var slot1spin = true;
	var slot2spin = true;
	var slot3spin = true;
	var gameFinished = true;
	var slot1curr = currFrame;
	var slot2curr = currFrame;
	var slot3curr = currFrame;
	var randSlot1 = 0; 
	var randSlot2 = 0;
	var randSlot3 = 0;
	var currFrame = 0;
	
	//Values
	var money = 0;
	var bet = 10;
	var betVal = 10;
	var minBet = 10;
	var maxBet = 100;
	var winnings = 0;
	
	//Images
	var slotImage1 = new Image();
	var slotImage2 = new Image();
	var slotImage3 = new Image();
	
	//Sounds
	var startSpinSound = document.getElementById('startSpin');
	var reelsSpinning = document.getElementById('reelSpinning');
	var noWin = document.getElementById('youLose');
	var youWin = document.getElementById('winSound');
	var betting = document.getElementById('betSound');
	
	
	
	function init()
	{
		//LoadAssets();
		
		//initialize bank
		money  = 1000;
		
		//initialize text
		$('div#welcomeTextDiv').text("Welcome to the Slots Pandamonium.");
		$('div#bankValue').text("You have $" + money);
		$('div#betValue').text(bet);
		
		//initialize handlers
		raiseBetButton.addEventListener("mousedown", raiseBetButtonHandler, false);
		lowerBetButton.addEventListener("mousedown", lowerBetButtonHandler, false);
		maxBetButton.addEventListener("mousedown", maxBetHandler, false);
		minBetButton.addEventListener("mousedown", minBetButtonHandler, false);
		slotStopButton.addEventListener("mousedown", stopButtonHandler, false);
		spinButton.addEventListener("mousedown", spinButtonHandler, false);
		document.addEventListener("keyup",keyUpHandler, false);
		
		//initialize the first slot
		slot1.push(1);
		slot1.push(2);
		slot1.push(3);
		slot1.push(4);
		slot1.push(5);
		slot1.push(6);
		slot1.push(6);
		//initialize the second slot
		slot2.push(1);
		slot2.push(2);
		slot2.push(3);
		slot2.push(4);
		slot2.push(5);
		slot2.push(6);
		slot2.push(6);
		//initialize third slot
		slot3.push(1);
		slot3.push(2);
		slot3.push(3);
		slot3.push(4);
		slot3.push(5);
		slot3.push(5);
		slot3.push(6);
		
		//turnOffLights();
	}
	function update()
	{
		window.requestAnimationFrame(update, $('canvas#myCanvas'));
		
		drawReels();
 		spinReels();
	}
	function stop()
	{
		if(slot1spin == true)
		{
			slot1spin = false;
			return;
		}
		if(slot2spin == true && slot1spin == false)
		{
			slot2spin = false;
			return;
		}
		if(slot3spin == true && slot2spin == false && slot1spin == false)
		{
			slot3spin = false;
			gameFinished = true;
			reelsSpinning.pause();
			reelSpinning.currTeime == 0.0;
		}
		
		if(gameFinished == true)
		{
			checkForWin();
		}
	}
	function checkForWin()
	{
		if(slot1curr == 1 && slot2curr == 1 && slot3curr == 1)
		{
			winnings = bet * 7;
			$('div#resultsTextDiv').text("Jackpot");
			$('div#wonTextDiv').text("You Won " + winnings);
			//Play sound
			playWinSound();
			//Play Animation
			turnOnLights();
		}
		else if(slot1curr == 2 && slot2curr == 2 && slot3curr == 2)
		{
			winnings = bet * 4.75;
			$('div#resultsTextDiv').text("Almost jackpot");
			$('div#wonTextDiv').text("You Won " + winnings);
			//Play sound
			playWinSound();
			//Play Animation
			turnOnLights();	
		}
		else if(slot1curr == 3 && slot2curr == 3 && slot3curr == 3)
		{
			winnings = bet * 3.75;
			$('div#resultsTextDiv').text("Uhh pinapple");
			$('div#wonTextDiv').text("You Won " + winnings);
			//Play sound
			playWinSound();
			//Play Animation
			turnOnLights();
		}
		else if(slot1curr == 4 && slot2curr == 4 && slot3curr == 4)
		{
			winnings = bet * 2.75;
			$('div#resultsTextDiv').text("Uhh pinata");
			$('div#wonTextDiv').text("You Won " + winnings);
			//Play sound
			playWinSound();
			//Play Animation
			turnOnLights();
		}
		else if(slot1curr == 5 && slot2curr == 5 && slot3curr == 5)
		{
			winnings = bet * 2;
			$('div#resultsTextDiv').text("Not the best in fact not even close");
			$('div#wonTextDiv').text("You Won " + winnings);
			//Play sound
			playWinSound();
			//Play Animation
			turnOnLights();
		}
		else if(slot1curr == 6 && slot2curr == 6 && slot3curr == 6)
		{
			winnings = bet * 1.75;
			$('div#resultsTextDiv').text("All cherries. best part of a fruit salad");
			$('div#wonTextDiv').text("You Won " + winnings);
			//Play sound
			playWinSound();
			//Play Animation
			turnOnLights();
		}
		else if(slot1curr == 6 && slot2curr == 6 || slot2curr == 6 && slot3curr == 6)
		{
			winnings = bet * 1.5;
			$('div#resultsTextDiv').text("2 cherries, not very good");
			$('div#wonTextDiv').text("You Won " + winnings);
			//Set volume and play sound
			playWinSound();
			//Play Animation
			turnOnLights();
		}
		else //losing spin
		{
			$('div#resultsTextDiv').text("You have lost");
			$('div#wonTextDiv').text("You Won nothing");
			//set volume and play sound
			playLossSound();
		}
		money += winnings;
			$('div#bankValue').text("You have $" + money);
	}
	function startSpin()
	{
		if(gameFinished == true)
		{
			winnings = 0;
			
			money -= bet;
				$('div#bankValue').text("You have $" + money);
			$('div#resultsTextDiv').text("");
			$('div#wonTextDiv').text("");
				
			
			slot1spin = true;
			slot2spin = true;
			slot3spin = true;
			gameFinished = false;
		}
		else
		{
			stop();
		}
		update();
	}
	function keyUpHandler(event)
	{
		var keyPressed = event.keyCode;
		
		if (keyPressed == 32)
		{
			if(money >= bet)
			{
				turnOffLights();
				
				playReelSpin();
	
				startSpin();
			}
		}
	}
	function spinButtonHandler(event)
	{
		if(money >= bet)
		{
			if(gameFinished == true)
			{
				winnings = 0;
				
				turnOffLights();

				playReelSpin();
				
				money -= bet;
					$('div#bankValue').text("You have $" + money);
				$('div#resultsTextDiv').text("");
				$('div#wonTextDiv').text("");
				
				slot1spin = true;
				slot2spin = true;
				slot3spin = true;
				gameFinished = false;
			}
			else
			{
				return;
			}
		}
		update();
	
	}
	function raiseBetButtonHandler(event)
	{
		if(bet < maxBet)
		{
			bet += betVal;
			$('div#betValue').text(bet);
			playBetSound();		
		}
	}
	function lowerBetButtonHandler(event)
	{
		if(gameFinished == true)
		{
			if(bet > minBet)
			{
				bet -= betVal;
				$('div#betValue').text(bet);	
			}
		}
		else
		{
			return;
		}
	}
	function maxBetHandler(event)
	{
		if(gameFinished == true)
		{
			bet = maxBet;
			$('div#betValue').text(bet);
			playBetSound();
		}
		else
		{
			return;
		}
	}
	function minBetButtonHandler(event)
	{
		if(gameFinished == true)
		{
			bet = minBet;
			$('div#betValue').text(bet);
		}
		else
		{
			return;
		}
	}
	
	function stopButtonHandler(event)
	{
		if(gameFinished == false)
		{
			stop();
		}
		else
		{
			return;
		}
	}
	function drawReels()
	{
		//slot 1
		if(slot1curr == 1)
		{
			slotImage1.src = 'images/ReelImages/lilredexpress.png';
		}
		else if(slot1curr == 2)
		{
			slotImage1.src = 'images/ReelImages/38coupe.png';
		}
		else if(slot1curr == 3)
		{
			slotImage1.src = 'images/ReelImages/baracuda.png';
		}
		else if(slot1curr == 4)
		{
			slotImage1.src = 'images/ReelImages/charger.png';
		}
		else if(slot1curr == 5)
		{
			slotImage1.src = 'images/ReelImages/cobra.png';
		}
		else if(slot1curr == 6)
		{
			slotImage1.src = 'images/ReelImages/judgeGTO.png';
		}
		
		//slot two
		if(slot2curr == 1)
		{
			slotImage2.src = 'images/ReelImages/lilredexpress.png';
		}
		else if(slot2curr == 2)
		{
			slotImage2.src = 'images/ReelImages/38coupe.png';
		}
		else if(slot2curr == 3)
		{
			slotImage2.src = 'images/ReelImages/baracuda.png';
		}
		else if(slot2curr == 4)
		{
			slotImage2.src = 'images/ReelImages/charger.png';
		}
		else if(slot2curr == 5)
		{
			slotImage2.src = 'images/ReelImages/cobra.png';
		}
		else if(slot2curr == 6)
		{
			slotImage2.src = 'images/ReelImages/judgeGTO.png';
		}
		
		//slot3
		if(slot3curr == 1)
		{
			slotImage3.src = 'images/ReelImages/lilredexpress.png';
		}
		else if(slot3curr == 2)
		{
			slotImage3.src = 'images/ReelImages/38coupe.png';
		}
		else if(slot3curr == 3)
		{
			slotImage3.src = 'images/ReelImages/baracuda.png';
		}
		else if(slot3curr == 4)
		{
			slotImage3.src = 'images/ReelImages/charger.png';
		}
		else if(slot3curr == 5)
		{
			slotImage3.src = 'images/ReelImages/cobra.png';
		}
		else if(slot3curr == 6)
		{
			slotImage3.src = 'images/ReelImages/judgeGTO.png';
		}
		
		slot1Context.drawImage(slotImage1, 0, 0);
		slot2Context.drawImage(slotImage2, 0, 0);
		slot3Context.drawImage(slotImage3, 0, 0);
	
	}
	function spinReels()
	{
		if(slot1spin == true)
		{
			randSlot1 = Math.floor(Math.random() * slot1.length);
			slot1curr = slot1[randSlot1];
		}
		if(slot2spin == true)
		{
			randSlot2 = Math.floor(Math.random() * slot2.length);
			slot2curr = slot2[randSlot2];
		}
		if(slot3spin == true)
		{
			randSlot3 = Math.floor(Math.random() * slot3.length);
			slot3curr = slot3[randSlot3];
		}
		
		slot1Context.drawImage(slotImage1, 0, 0);
		slot2Context.drawImage(slotImage2, 0, 0);
		slot3Context.drawImage(slotImage3, 0, 0);
	
	}
	function playWinSound()
	{
		//stop other sounds
		startSpinSound .pause();
		reelSpinning.pause();
	
		//Set volume and play sound
		youWin.currTime = 0.0;
		youWin.volume = 0.5;
		youWin.play();
	}
	function playLossSound()
	{
		//stop othe sounds
		startSpinSound .pause();
		reelSpinning.pause();
		
		//set volume and play sound
		noWin.currTime = 0.0;
		noWin.volume = 0.5;
		noWin.play();
	}
	function playReelSpin()
	{
		//stop all other sound
		betting.pause();
		betting.currTime == 0.0;
		noWin.pause();
		noWin.currTime == 0.0;
		youWin.pause();
		youWin.currTime = 0.0;
	
		//set volume and play sound
		startSpinSound .currTime = 0.0;
		startSpinSound .volume = 0.5;
		startSpinSound .play();
		
		reelSpinning.currTime == 0.0;
		reelsSpinning.volume = 0.5;
		reelsSpinning.play();
		reelSpinning.loop = true;
	}
	function playBetSound()
	{
		//set volume and play sound
		betting.currTime = 0.0;
		betting.volume = 1.0;
		betting.play();
	}
	function turnOnLights()
	{
		$('div#rightSignal').css({'moz-animation-play-state':'running',
								'-webkit-animation-play-state':'running',
								'-ms-animation-play-state':'running',
								'animation-play-state':'running'});
		
		$('div#upperRightHead').css({'moz-animation-play-state':'running',
								'-webkit-animation-play-state':'running',
								'-ms-animation-play-state':'running',
								'animation-play-state':'running'});

		$('div#lowerRightHead').css({'moz-animation-play-state':'running',
								'-webkit-animation-play-state':'running',
								'-ms-animation-play-state':'running',
								'animation-play-state':'running'});

		$('div#upperRightRunning').css({'moz-animation-play-state':'running',
								'-webkit-animation-play-state':'running',
								'-ms-animation-play-state':'running',
								'animation-play-state':'running'});

		$('div#lowerRightRunning').css({'moz-animation-play-state':'running',
								'-webkit-animation-play-state':'running',
								'-ms-animation-play-state':'running',
								'animation-play-state':'running'});
		
		$('div#leftSignal').css({'moz-animation-play-state':'running',
								'-webkit-animation-play-state':'running',
								'-ms-animation-play-state':'running',
								'animation-play-state':'running'});
		
		$('div#upperLeftHead').css({'moz-animation-play-state':'running',
								'-webkit-animation-play-state':'running',
								'-ms-animation-play-state':'running',
								'animation-play-state':'running'});

		$('div#lowerLeftHead').css({'moz-animation-play-state':'running',
								'-webkit-animation-play-state':'running',
								'-ms-animation-play-state':'running',
								'animation-play-state':'running'});

		$('div#upperLeftRunning').css({'moz-animation-play-state':'running',
								'-webkit-animation-play-state':'running',
								'-ms-animation-play-state':'running',
								'animation-play-state':'running'});

		$('div#lowerLeftRunning').css({'moz-animation-play-state':'running',
								'-webkit-animation-play-state':'running',
								'-ms-animation-play-state':'running',
								'animation-play-state':'running'});
	}
	function turnOffLights()
	{	
		$('div#rightSignal').css({'moz-animation-play-state':'running',
								'-webkit-animation-play-state':'paused',
								'-ms-animation-play-state':'paused',
								'animation-play-state':'paused'});
		
		$('div#upperRightHead').css({'moz-animation-play-state':'paused',
								'-webkit-animation-play-state':'paused',
								'-ms-animation-play-state':'paused',
								'animation-play-state':'paused'});

		$('div#lowerRightHead').css({'moz-animation-play-state':'paused',
								'-webkit-animation-play-state':'paused',
								'-ms-animation-play-state':'paused',
								'animation-play-state':'paused'});

		$('div#upperRightRunning').css({'moz-animation-play-state':'paused',
								'-webkit-animation-play-state':'paused',
								'-ms-animation-play-state':'paused',
								'animation-play-state':'paused'});

		$('div#lowerRightRunning').css({'moz-animation-play-state':'paused',
								'-webkit-animation-play-state':'paused',
								'-ms-animation-play-state':'paused',
								'animation-play-state':'paused'});
		
		$('div#leftSignal').css({'moz-animation-play-state':'paused',
								'-webkit-animation-play-state':'paused',
								'-ms-animation-play-state':'paused',
								'animation-play-state':'paused'});
		
		$('div#upperLeftHead').css({'moz-animation-play-state':'paused',
								'-webkit-animation-play-state':'paused',
								'-ms-animation-play-state':'paused',
								'animation-play-state':'paused'});

		$('div#lowerLeftHead').css({'moz-animation-play-state':'paused',
								'-webkit-animation-play-state':'paused',
								'-ms-animation-play-state':'paused',
								'animation-play-state':'paused'});

		$('div#upperLeftRunning').css({'moz-animation-play-state':'paused',
								'-webkit-animation-play-state':'paused',
								'-ms-animation-play-state':'paused',
								'animation-play-state':'paused'});

		$('div#lowerLeftRunning').css({'moz-animation-play-state':'paused',
								'-webkit-animation-play-state':'paused',
								'-ms-animation-play-state':'paused',
								'animation-play-state':'paused'});
	}	

	init();
});