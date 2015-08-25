$(document).ready(function()
{
	//Reels 
	var slot1Canvas = document.getElementById('slot1');
	var slot1Context = slot1Canvas.getContext('2d');
	var slot2Canvas = document.getElementById('slot2');
	var slot2Context = slot2Canvas.getContext('2d');
	var slot3Canvas = document.getElementById('slot3');
	var slot3Context = slot3Canvas.getContext('2d');
	
	//Buttons

	var slotStopButton = document.getElementById('slotStop');
	var spinButton = document.getElementById('spinButton');
	
	//Play data
	var slot1 = [];
	var slot2 = [];
	var slot3 = [];
	var slot1spin = true;
	var slot2spin = true;
	var slot3spin = true;
	var gameFinished = false;
	var slot1curr = currFrame;
	var slot2curr = currFrame;
	var slot3curr = currFrame;
	var randSlot1 = 0; 
	var randSlot2 = 0;
	var randSlot3 = 0;
	var rand = 0;
	var currFrame = 0;
	
	//Values
	var money = 0;
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

	
	function init()
	{
		
		//initialize bank
		//will need accsess to the mamber datbase so that this can be set according to the clients information
		money  = 100;//for testing
		
		//initialize text
		$('div#welcomeTextDiv').text("Welcome to the Auto Obsessions Slots");
		$('div#bankValue').text("You have $" + money);
	
		
		//initialize handlers
		
		slotStopButton.addEventListener("mousedown", stopButtonHandler, false);
		spinButton.addEventListener("mousedown", spinButtonHandler, false);
		document.addEventListener("keyup",keyUpHandler, false);
		turnOffLights();
	}
	function update()
	{
		window.requestAnimationFrame(update, $('canvas#slot1Canvas'));
		
		slot1Context.clearRect ( 0 , 0 , slot1Canvas.width, slot1Canvas.height);
		slot2Context.clearRect ( 0 , 0 , slot2Canvas.width, slot2Canvas.height);
		slot3Context.clearRect ( 0 , 0 , slot3Canvas.width, slot3Canvas.height);
		drawReels();
 		spinReels();
		
		if(gameFinished == true)
		{
			reelsSpinning.pause();
			reelSpinning.loop = false;
			startSpinSound.pause();
			startSpinSound.loop = false;
			stop();
		}
		
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
		
		if(gameFinished == false)
		{
			console.log(slot1curr, slot2curr, slot3curr);
			console.log(slotImage1, slotImage2, slotImage3);
			checkForWin();
		}
		
	}
	function checkForWin()
	{
		if(slot1curr == 1 && slot2curr == 1 && slot3curr == 1)
		{
			winnings = bet * 10;
			$('div#resultsTextDiv').text("Jackpot");
			$('div#wonTextDiv').text("You Won " + winnings);
			//Play sound
			playWinSound();
			startSpinSound();
			//Play Lights
			turnOnLights();
		}
		else if(slot1curr == 2 && slot2curr == 2 && slot3curr == 2)
		{
			
			$('div#resultsTextDiv').text("Congratulations, You win!");
			$('div#wonTextDiv').text("You Won " + winnings);
			//Play sound
			playWinSound();
			//Play Lights
			turnOnLights();	
		}
		else if(slot1curr == 3 && slot2curr == 3 && slot3curr == 3)
		{
			winnings = bet * 5;
			$('div#resultsTextDiv').text("Congratulations, You win!");
			$('div#wonTextDiv').text("You Won " + winnings);
			//Play sound
			playWinSound();
			//Play Lights
			turnOnLights();
		}
		else if(slot1curr == 4 && slot2curr == 4 && slot3curr == 4)
		{
			
			$('div#resultsTextDiv').text("Uhh pinata");
			$('div#wonTextDiv').text("You Won " + winnings);
			//Play sound
			playWinSound();
			//Play Lights
			turnOnLights();
		}
		else if(slot1curr == 5 && slot2curr == 5 && slot3curr == 5)
		{
		
			$('div#resultsTextDiv').text("Congratulations, You win!");
			$('div#wonTextDiv').text("You Won " + winnings);
			//Play sound
			playWinSound();
			//Play Lights
			turnOnLights();
		}
		else if(slot1curr == 5 && slot2curr == 5  || slot1curr == 6 && slot2curr == 6 && slot3curr == 6)
		{
			
			$('div#resultsTextDiv').text("Congratulations, You win!");
			$('div#wonTextDiv').text("You Won " + winnings);
			//Play sound
			playWinSound();
			//Play Lights
			turnOnLights();
		}
		else if(slot1curr == 5 || slot1curr == 6 && slot2curr == 6)
		{
			//winnings = bet * 1.75;
			$('div#resultsTextDiv').text("Congratulations, You win!");
			$('div#wonTextDiv').text("You Won " + winnings);
			//Set volume and play sound
			playWinSound();
			//Play Lights
			turnOnLights();
		}
		else if(slot1curr == 6  || slot2curr == 6 || slot3curr == 6)
		{
			//winnings = bet * 1.5;
			$('div#resultsTextDiv').text("Congratulations, You win!");
			$('div#wonTextDiv').text("You Won " + winnings);
			//Set volume and play sound
			playWinSound();
			//Play Lights
			turnOnLights();

		}
		else //losing spin
		{
			$('div#resultsTextDiv').text("You have lost");
			$('div#wonTextDiv').text("You Won nothing");
			//set volume and play sound
			playLossSound();
		}
		//money += winnings;
			$('div#bankValue').text("You have $" + money);
		console.log(winnings);
	}

	function startSpin()
	{
		
		if(gameFinished == false)
		{
			winnings = 0;
			
			$('div#bankValue').text("You have $" + money);
			$('div#resultsTextDiv').text("");
			$('div#wonTextDiv').text("");
			
			slot1spin = true;
			slot2spin = true;
			slot3spin = true;
			//gameFinished = false;
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
			turnOffLights();
			//playReelSpin();
			startSpin();
			gameFinished = false;
		}
		
	}
	function spinButtonHandler(event)
	{
		if(money < 0)
		{
			winnings = 0;
			turnOffLights();
			//playReelSpin();
			
			$('div#bankValue').text("You have $" + money);
			$('div#resultsTextDiv').text("");
			$('div#wonTextDiv').text("");
			
			slot1spin = true;
			slot2spin = true;
			slot3spin = true;
			//gameFinished = false;
		
		}
		update();
	
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
			slotImage1.src = 'images/ReelImages/carImage.png';
		}
		else if(slot1curr == 2)
		{
			slotImage1.src = 'images/ReelImages/sevenImage.png';
		}
		else if(slot1curr == 3)
		{
			slotImage1.src = 'images/ReelImages/tripleBar.png';
		}
		else if(slot1curr == 4)
		{
			slotImage1.src = 'images/ReelImages/doubleBar.png';
		}
		else if(slot1curr == 5)
		{
			slotImage1.src = 'images/ReelImages/singleBar.png';
		}
		else if(slot1curr == 6)
		{
			slotImage1.src = 'images/ReelImages/cherry.png';
		}
		
		slot1Context.drawImage(slotImage1, 
					  (slot1Canvas.width / 2) - (slotImage1.width / 2), 
					  (slot1Canvas.height / 2) - (slotImage1.height / 2), 
					  slotImage1.width * 1.5, 
					  slotImage1.height * 1.5);

		
		//slot two
		if(slot2curr == 1)
		{
			slotImage2.src = 'images/ReelImages/carImage.png';
		}
		else if(slot2curr == 2)
		{
			slotImage2.src = 'images/ReelImages/sevenImage.png';
		}
		else if(slot2curr == 3)
		{
			slotImage2.src = 'images/ReelImages/tripleBar.png';
		}
		else if(slot2curr == 4)
		{
			slotImage2.src = 'images/ReelImages/doubleBar.png';
		}
		else if(slot2curr == 5)
		{
			slotImage2.src = 'images/ReelImages/singleBar.png';
		}
		else if(slot2curr == 6)
		{
			slotImage2.src = 'images/ReelImages/cherry.png';
		}
		
		slot2Context.drawImage(slotImage2, 
					  (slot2Canvas.width / 2) - (slotImage2.width / 2), 
					  (slot2Canvas.height / 2) - (slotImage2.height / 2), 
					  slotImage2.width * 1.5, 
					  slotImage2.height * 1.5);

		//slot3
		if(slot3curr == 1)
		{
			slotImage3.src = 'images/ReelImages/carImage.png';
		}
		else if(slot3curr == 2)
		{
			slotImage3.src = 'images/ReelImages/sevenImage.png';
		}
		else if(slot3curr == 3)
		{
			slotImage3.src = 'images/ReelImages/tripleBar.png';
		}
		else if(slot3curr == 4)
		{
			slotImage3.src = 'images/ReelImages/doubleBar.png';
		}
		else if(slot3curr == 5)
		{
			slotImage3.src = 'images/ReelImages/singleBar.png';
		}
		else if(slot3curr == 6)
		{
			slotImage3.src = 'images/ReelImages/cherry.png';
		}
		
		slot3Context.drawImage(slotImage3, 
							  (slot3Canvas.width / 2) - (slotImage3.width / 2), 
							  (slot3Canvas.height / 2) - (slotImage3.height / 2), 
							  slotImage3.width * 1.5, 
							  slotImage3.height * 1.5);
	}
	function spinReels()
	{
		
		if(slot1spin == true)
		{
			slot1curr = randomNum();//slot1[randomNum()];
		}
		if(slot2spin == true)
		{
			slot2curr = randomNum();//slot2[randomNum()];
		}
		if(slot3spin == true)
		{
			slot3curr = randomNum();//slot3[randomNum()];
		}
		if((slot1spin == true)&& (slot2spin == true) && (slot3spin == true))
		{
			gameFinished == true;
			
		}
		playReelSpin();
		
	}
	function randomNum()
	{
		rand = Math.floor(Math.random() * 100);
		var num = 0;
		
		if(rand <= 30)
		{
			num = 6;
		}
		else if(rand < 53 && rand > 30)
		{
			num = 5;
		}
		else if(rand < 71 && rand > 52)
		{
			num = 4;
		}
		else if(rand < 85 && rand > 70)
		{
			num = 3;
		}
		else if(rand < 95 && rand > 84)
		{
			num = 2;
		}
		else if(rand <= 100 && rand > 94)
		{
			num = 1;
		}
		return num;
	}
	
	function playWinSound()
	{
		//stop other sounds
		startSpinSound.pause();
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
		
		noWin.pause();
		youWin.pause();
	
		//set volume and play sound
		startSpinSound.currTime = 0.0;
		startSpinSound.volume = 0.5;
		startSpinSound.play();
		
		reelSpinning.currTime == 0.0;
		reelsSpinning.volume = 0.5;
		reelsSpinning.play();
		//reelSpinning.loop = true;
		
	}
	
	function turnOnLights()
	{
		$('div#leftHead').css({'display':'block', 'moz-animation-play-state':'running',
								'-webkit-animation-play-state':'running',
								'-ms-animation-play-state':'running',
								'animation-play-state':'running'});
		
		$('div#upperLeftSmall').css({'display':'block', 'moz-animation-play-state':'running',
								'-webkit-animation-play-state':'running',
								'-ms-animation-play-state':'running',
								'animation-play-state':'running'});

		$('div#lowerLeftSmall').css({'display':'block', 'moz-animation-play-state':'running',
								'-webkit-animation-play-state':'running',
								'-ms-animation-play-state':'running',
								'animation-play-state':'running'});

		$('div#LeftFog').css({'display':'block', 'moz-animation-play-state':'running',
								'-webkit-animation-play-state':'running',
								'-ms-animation-play-state':'running',
								'animation-play-state':'running'});

		$('div#rightHead').css({'display':'block', 'moz-animation-play-state':'running',
								'-webkit-animation-play-state':'running',
								'-ms-animation-play-state':'running',
								'animation-play-state':'running'});
		
		$('div#upperRightSmall').css({'display':'block', 'moz-animation-play-state':'running',
								'-webkit-animation-play-state':'running',
								'-ms-animation-play-state':'running',
								'animation-play-state':'running'});
		
		$('div#lowerRightSmall').css({'display':'block', 'moz-animation-play-state':'running',
								'-webkit-animation-play-state':'running',
								'-ms-animation-play-state':'running',
								'animation-play-state':'running'});

		$('div#RightFog').css({'display':'block', 'moz-animation-play-state':'running',
								'-webkit-animation-play-state':'running',
								'-ms-animation-play-state':'running',
								'animation-play-state':'running'});
	}
	function turnOffLights()
	{	
		$('div#leftHead').css({'display':'none', 'moz-animation-play-state':'paused',
								'-webkit-animation-play-state':'paused',
								'-ms-animation-play-state':'paused',
								'animation-play-state':'paused'});
		
		$('div#upperLeftSmall').css({'moz-animation-play-state':'paused',
								'-webkit-animation-play-state':'paused',
								'-ms-animation-play-state':'paused',
								'animation-play-state':'paused'});

		$('div#lowerLeftSmall').css({'display':'none', 'moz-animation-play-state':'paused',
								'-webkit-animation-play-state':'paused',
								'-ms-animation-play-state':'paused',
								'animation-play-state':'paused'});

		$('div#LeftFog').css({'display':'none', 'moz-animation-play-state':'paused',
								'-webkit-animation-play-state':'paused',
								'-ms-animation-play-state':'paused',
								'animation-play-state':'paused'});

		$('div#rightHead').css({'display':'none', 'moz-animation-play-state':'paused',
								'-webkit-animation-play-state':'paused',
								'-ms-animation-play-state':'paused',
								'animation-play-state':'paused'});
		
		$('div#upperRightSmall').css({'display':'none', 'moz-animation-play-state':'paused',
								'-webkit-animation-play-state':'paused',
								'-ms-animation-play-state':'paused',
								'animation-play-state':'paused'});
		
		$('div#lowerRightSmall').css({'display':'none', 'moz-animation-play-state':'paused',
								'-webkit-animation-play-state':'paused',
								'-ms-animation-play-state':'paused',
								'animation-play-state':'paused'});

		$('div#RightFog').css({'display':'none', 'moz-animation-play-state':'paused',
								'-webkit-animation-play-state':'paused',
								'-ms-animation-play-state':'paused',
								'animation-play-state':'paused'});
	}	

	init();
});