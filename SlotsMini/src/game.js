$(document).ready(function()
{
	//var canvas = $('canvas#myCanvas');
	//var context = canvas.getContext('2d');
	
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
	var stopButton = document.getElementById('slotStop');
	var spinButton = document.getElementById('spinButton');
	
	//lights
	//var lights = document.getElementById('lights');
	
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
	//var slotImage = new Image('../images/SpriteSheets/spritesheet1.png');
	//var lights = new Image('../images/SpriteSheets/lights_SpriteSheet.png');
	
	//SpriteSheets
	//var CarSheet = new SpriteSheet(slotImage, width = 278, height = 158);
	//var LightsSheet = new SpriteSheet(lights, width = 1426, height = 136);
	
	//Animations
	//var slotAnim = new Animation(CarSheet, 1, 0, 5);
	//var lightAnim = new Animation(LightsSheet, 1, 0, 1);
	
	//Sounds
	var startSpin = document.getElementById('startSpin');
	var reelsSpinning = document.getElementById('reelSpinning');
	var noWin = document.getElementById('youLose');
	var youWin = document.getElementById('winSound');
	var betting = document.getElementById('betSound');
	
	function init()
	{
		//initialize bank
		money  = 1000;
		
		//initialize text
		$('div#welcomeTextDiv').text("Welcome to the Slots Pandamonium.");
		$('div#bankValue').text("You have $" + money);
		$('div#betValue').text(bet);
		$('div#placeBetText').text("Place Bet");
	
		//initialize handlers
		raiseBetButton.addEventListener("mousedown", raiseBetButtonHandler, false);
		lowerBetButton.addEventListener("mousedown", lowerBetButtonHandler, false);
		maxBetButton.addEventListener("mousedown", maxBetHandler, false);
		minBetButton.addEventListener("mousedown", minBetButtonHandler, false);
		stopButton.addEventListener("mousedown", stopButtonHandler, false);
		spinButton.addEventListener("mousedown", spinButtonHandler, false);
		document.addEventListener("keyup",keyUpHandler, false);
		
		//initialize the first slot
		//slot1.push(CarSheet);
		slot1.push(1);
		slot1.push(2);
		slot1.push(2);
		slot1.push(3);
		slot1.push(3);
		slot1.push(3);
		slot1.push(4);
		slot1.push(4);
		slot1.push(4);
		slot1.push(4);
		slot1.push(5);
		slot1.push(5);
		slot1.push(5);
		slot1.push(5);
		slot1.push(6);
		slot1.push(6);
		slot1.push(6);
		slot1.push(6);
		slot1.push(6);
		slot1.push(6);
		//initialize the second slot
		//slot2.push(CarSheet);
		slot2.push(1);
		slot2.push(2);
		slot2.push(2);
		slot2.push(3);
		slot2.push(3);
		slot2.push(3);
		slot2.push(4);
		slot2.push(4);
		slot2.push(4);
		slot2.push(4);
		slot2.push(5);
		slot2.push(5);
		slot2.push(5);
		slot2.push(5);
		slot2.push(6);
		slot2.push(6);
		slot2.push(6);
		slot2.push(6);
		slot2.push(6);
		slot2.push(6);
		//initialize third slot
		//slot3.push(CarSheet);
		slot3.push(1);
		slot3.push(2);
		slot3.push(2);
		slot3.push(3);
		slot3.push(3);
		slot3.push(3);
		slot3.push(4);
		slot3.push(4);
		slot3.push(4);
		slot3.push(4);
		slot3.push(5);
		slot3.push(5);
		slot3.push(5);
		slot3.push(5);
		slot3.push(6);
		slot3.push(6);
		slot3.push(6);
		slot3.push(6);
		slot3.push(6);
		slot3.push(6);
		
		//startGame();
	}
	function update()
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
		
		
		if(slot1spin == true)
		{
			//spinReels();
			randSlot1 = Math.floor(Math.random() * slot1.length);
			slot1curr = slot1[randSlot1];
		}
		if(slot2spin == true)
		{
			//spinReels();
			randSlot2 = Math.floor(Math.random() * slot2.length);
			slot2curr = slot2[randSlot2];
		}
		if(slot3spin == true)
		{
			//spinReels();
			randSlot3 = Math.floor(Math.random() * slot3.length);
			slot3curr = slot3[randSlot3];
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
			$('div#resultsDiv').text("Jackpot");
						$('div#wonDiv').text("You Won " + winnings);
						//Play sound
						playWinSound();
						//Play Animation
						//lightAnim;
		}
		else if(slot1curr == 2 && slot2curr == 2 && slot3curr == 2)
		{
			winnings = bet * 4.75;
			$('div#resultsDiv').text("Almost jackpot");
						$('div#wonDiv').text("You Won " + winnings);
						//Play sound
						playWinSound();
						//Play Animation
						//lightAnim;
		}
		else if(slot1curr == 3 && slot2curr == 3 && slot3curr == 3)
		{
			winnings = bet * 3.75;
			$('div#resultsDiv').text("Uhh pinapple");
						$('div#wonDiv').text("You Won " + winnings);
						//Play sound
						playWinSound();
						//Play Animation
						//lightAnim;
		}
		else if(slot1curr == 4 && slot2curr == 4 && slot3curr == 4)
		{
			winnings = bet * 2.75;
			$('div#resultsDiv').text("Uhh pinata");
						$('div#wonDiv').text("You Won " + winnings);
						//Play sound
						playWinSound();
						//Play Animation
						//lightAnim;
		}
		else if(slot1curr == 5 && slot2curr == 5 && slot3curr == 5)
		{
			winnings = bet * 2;
			$('div#resultsDiv').text("Not the best in fact not even close");
						$('div#wonDiv').text("You Won " + winnings);
						//Play sound
						playWinSound();
						//Play Animation
						//lightAnim;
		}
		else if(slot1curr == 6 && slot2curr == 6 && slot3curr == 6)
		{
			winnings = bet * 1.75;
			$('div#resultsDiv').text("All cherries. best part of a fruit salad");
						$('div#wonDiv').text("You Won " + winnings);
						//Play sound
						playWinSound();
						//Play Animation
						//lightAnim;
		}
		else if(slot1curr == 6 && slot2curr == 6 || slot2curr == 6 && slot3curr == 6)
		{
			winnings = bet * 1.5;
			$('div#resultsDiv').text("2 cherries, not very good");
						$('div#wonDiv').text("You Won " + winnings);
						//Set volume and play sound
						//youWin.currTime = 0.0;
						//youWin.volume = 0.5;
						//youWin.play();
						playWinSound();
						//Play Animation
						//lightAnim;
		}
		else //losing spin
		{
			$('div#resultsDiv').text("You have lost");
						$('div#wonDiv').text("You Won nothing");
						//set volume and play sound
						noWin.currTime = 0.0;
						//noWin.volume = 0.1;
						//noWin.play();
						playLossSound();
		}
		money += winnings;
			$('div#bankValue').text("You have $" + money);
	}
	function startGame()
	{
		if(gameFinished == true)
		{
			winnings = 0;
			
			money -= bet;
				$('div#bankValue').text("You have $" + money);
			
			slot1spin = true;
			slot2spin = true;
			slot3spin = true;
			gameFinished = false;
		}
		else
		{
			stop();
		}
		gameLoop();
	}
	function keyUpHandler(event)
	{
		var keyPressed = event.keyCode;
		
		if (keyPressed == 32)
		{
			if(money >= bet)
			{
				playReelSpin();
	
				startGame();
			}
		}
	}
	function spinButtonHandler(event)
	{
		//startGame();
		if(money >= bet)
		{
			if(gameFinished == true)
			{
				winnings = 0;
				
				playReelSpin();
				
				money -= bet;
					$('div#bankValue').text("You have $" + money);
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
		gameLoop();
	
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
		/*slot1Context.drawImage(CarSheet[0], 0, 0);
		slot2Context.drawImage(CarSheet[0], 0, 0);
		slot3Context.drawImage(CarSheet[0], 0, 0);*/
	}
	function spinReels()
	{
		//Animation(CarSheet, 1, 0, 5);
		slot1Context.drawImage(slotImage1, 0, 0);
		slot2Context.drawImage(slotImage2, 0, 0);
		slot3Context.drawImage(slotImage3, 0, 0);
	}
	function gameLoop() 
	{
		window.requestAnimationFrame(gameLoop, $('canvas#myCanvas'));
	
		update();
		spinReels();
	}
	function playWinSound()
	{
		//stop other sounds
		startSpin.pause();
		reelSpinning.pause();
	
		//Set volume and play sound
		youWin.currTime = 0.0;
		youWin.volume = 0.5;
		youWin.play();
	}
	function playLossSound()
	{
		//stop othe sounds
		startSpin.pause();
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
		startSpin.currTime = 0.0;
		startSpin.volume = 0.5;
		startSpin.play();
		
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
	function animateLights()
	{
		
	}
		init();
});