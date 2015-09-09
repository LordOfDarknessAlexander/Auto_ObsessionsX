$(document).ready(
function(){
    //update to use jQuery
	//Reels 
//slots

	var slot1Canvas = document.getElementById('slot1'),
        slot1Context = slot1Canvas.getContext('2d'),
		//slot1Context = $("slot1").get(0);
        slot2Canvas = document.getElementById('slot2'),
        slot2Context = slot2Canvas.getContext('2d'),
		//slot2Context = $("slot2").get(0);
        slot3Canvas = document.getElementById('slot3'),
		//slot3Context = $("slot3").get(0);
        slot3Context = slot3Canvas.getContext('2d');
	//Buttons

    var spinButton = document.getElementById('spinButton');
	
	var slot1 = [];
	var slot2 = [];
	var slot3 = [];
    //
	var slot1spin = true,
        slot2spin = true,
        slot3spin = true;

	var slot1curr = currFrame,
        slot2curr = currFrame,
        slot3curr = currFrame;
   
	var randSlot1 = 0,
        randSlot2 = 0,
        randSlot3 = 0;
		
	var rand = 0;
	var currFrame = 0;	
	//Values
	var winnings = 0;
	var tokens = 0;
	//Images
	var slotImage1 = new Image(),
        slotImage2 = new Image(),
        slotImage3 = new Image();	
	//Sounds
	var startSpinSound = document.getElementById('startSpin'),
        reelsSpinning = document.getElementById('reelSpinning'),
        noWin = document.getElementById('youLose'),
        youWin = document.getElementById('winSound');
	
	var gameFinished = false;
	var spins = false;
		
	function init(){		
		//initialize bank
		//will need accsess to the mamber datbase so that this can be set according to the clients information
		money  = 1;//for testing
		tokens = 3;
		
		//initialize text
		$('div#welcomeTextDiv').text('Welcome to the Auto Obsessions Slots');
		$('div#bankValue').text('You have ' + tokens + ' tokens');
	
		//initialize handlers
		//slotStopButton.addEventListener('mousedown', stopButtonHandler, false);
		//spinButton.addEventListener('mousedown', spinButtonHandler, false);
		document.addEventListener('keyup',keyUpHandler, false);
		turnOffLights();
	}
	function update(){
		window.requestAnimationFrame(update, $('canvas#slot1Canvas'));
		
		//this.slot1Context.clearRect(0, 0, slot1Canvas.width, slot1Canvas.height);
		//this.slot2Context.clearRect(0, 0, slot2Canvas.width, slot2Canvas.height);
		//this.slot3Context.clearRect(0, 0, slot3Canvas.width, slot3Canvas.height);
		drawReels();
 		spinReels();
		
		if(gameFinished == true){
			reelsSpinning.pause();
			reelSpinning.loop = false;
			startSpinSound.pause();
			startSpinSound.loop = false;
			stop();
		}
		if(spins == true){
			spinTimer --;
			//tokens --;
		}
		if( tokens <= 0)
		{
			gameFinished = true;
		}
	}
	function stop(){
        //stop reel from spinning
		if(slot1spin == true){
			slot1spin = false;
			return;
		}
		if(slot2spin == true && slot1spin == false){
			slot2spin = false;
			return;
		}
		if(slot3spin == true && slot2spin == false && slot1spin == false){
			slot3spin = false;
			gameFinished = true;
			reelsSpinning.pause();
			reelSpinning.currTime == 0.0;
		}
		
		if(gameFinished == false){
			console.log(slot1curr, slot2curr, slot3curr);
			console.log(slotImage1, slotImage2, slotImage3);
			checkForWin();
		}
	}
	function checkForWin(){
        //
        var res = $('div#resultsTextDiv');
        
		if(slot1curr == 1 && slot2curr == 1 && slot3curr == 1){
			//winnings = bet * 10;
			tokens = tokens + 1;
			//res..text('Jackpot');
			$('div#wonTextDiv').text('You Won ' + tokens);
			//Play sound
			playWinSound();
			startSpinSound();
			//Play Lights
			turnOnLights();
		}
		else if(slot1curr == 2 && slot2curr == 2 && slot3curr == 2){
			res.text('Congratulations, You win!');
			$('div#wonTextDiv').text('You Won ' + tokens);
			tokens = tokens + 1;
			//Play sound
			playWinSound();
			//Play Lights
			turnOnLights();	
		}
		else if(slot1curr == 3 && slot2curr == 3 && slot3curr == 3){
			winnings = bet * 5;
			res.text('Congratulations, You win!');
			$('div#wonTextDiv').text('You Won ' + tokens);
			tokens = tokens + 1;
			//Play sound
			playWinSound();
			//Play Lights
			turnOnLights();
		}
		else if(slot1curr == 4 && slot2curr == 4 && slot3curr == 4){
			res.text('Uhh pinata');
			$('div#wonTextDiv').text('You Won ' + tokens);
			tokens = tokens + 1;
			//Play sound
			playWinSound();
			//Play Lights
			turnOnLights();
		}
		else if(slot1curr == 5 && slot2curr == 5 && slot3curr == 5){
			res.text('Congratulations, You win!');
			$('div#wonTextDiv').text('You Won ' + tokens);
			tokens = tokens + 1;
			//Play sound
			playWinSound();
			//Play Lights
			turnOnLights();
		}
		else if( (slot1curr == 5 && slot2curr == 5)  || (slot1curr == 6 && slot2curr == 6 && slot3curr == 6) ){
			res.text('Congratulations, You win!');
			$('div#wonTextDiv').text('You Won ' + tokens);
			tokens = tokens + 1;
			//Play sound
			playWinSound();
			//Play Lights
			turnOnLights();
		}
		else if( (slot1curr == 5 || slot1curr == 6) && slot2curr == 6){
			//winnings = bet * 1.75;
			res.text('Congratulations, You win!');
			$('div#wonTextDiv').text('You Won ' + tokens);
			tokens = tokens + 4;
			//Set volume and play sound
			playWinSound();
			//Play Lights
			turnOnLights();
		}
		else if(slot1curr == 6  || slot2curr == 6 || slot3curr == 6){
			//winnings = bet * 1.5;
			res.text('Congratulations, You win!');
			$('div#wonTextDiv').text('You Won ' + tokens);
			//Set volume and play sound
			tokens = tokens + 1;
			playWinSound();
			//Play Lights
			turnOnLights();
		}
		else{   //losing spin
			res.text('You have lost');
			$('div#wonTextDiv').text('You Won nothing');
			//set volume and play sound
			playLossSound();
		}
		//money += winnings;
        $('div#bankValue').text('You have $' + tokens);
		console.log(winnings);
	}

	function startSpin(){
		if(this.gameFinished == false){
			winnings = 0;
			//tokens = 0;
			
			$('div#bankValue').text('You have $' + tokens);
			$('div#resultsTextDiv').text('');
			$('div#wonTextDiv').text('');
			
			slot1spin = true;
			slot2spin = true;
			slot3spin = true;
			
			
		}
		else{
			stop();
			
		}
		update();
	}
	function keyUpHandler(event){
		var keyPressed = event.keyCode;
		
        if (keyPressed == 32){
			turnOffLights();
			//playReelSpin();
			startSpin();
		}
	}
	
	function spinButtonHandler(event){
		if(gameFinished == false){
			winnings = 0;
			tokens --;
			turnOffLights();
			//playReelSpin();
			
			$('div#bankValue').text('You have ' + tokens);
			$('div#resultsTextDiv').text('');
			$('div#wonTextDiv').text('');
			
			slot1spin = true;
			slot2spin = true;
			slot3spin = true;
			//gameFinished = false;			
		}
		
		update();		
	}	
	
	function stopButtonHandler(event){
        //
		spinTimer = 200;
		spins = true;
		update();
		
		console.log(spinTimer);
		if((slot1spin == true) && (spinTimer < 200)){
			slot1curr = randomNum();//slot1[randomNum()];
			playReelSpin();
			slot1spin = false;
			spins = true;
			//spinTimer --;
			update();
		}
		else if((slot2spin == true) && (spinTimer < 100)){
			slot2curr = randomNum();//slot2[randomNum()];
			playReelSpin();
			slot2spin = false;
			spins = true;
			spinTimer --;
			update();
		}
		else if((slot3spin == true)&& (spinTimer < 50)){
			slot3curr = randomNum();//slot3[randomNum()];
			playReelSpin();
			slot3spin = false;
			spins = true;
			//spinTimer --;
			update();
		}
		
		if(gameFinished == false){
			stop();
			checkForWin();
			slot1spin = false;
			slot2spin = false;
			slot3spin = false; 
		}
		else{
			return;
		}
	}
	function drawReels(){
		//slot 1
        src = 'images/ReelImages/';
        
		if(slot1curr == 1){
			slotImage1.src = src + 'carImage.png';
		}
		else if(slot1curr == 2){
			slotImage1.src = src + 'sevenImage.png';
		}
		else if(slot1curr == 3){
			slotImage1.src = src + 'tripleBar.png';
		}
		else if(slot1curr == 4){
			slotImage1.src = src + 'doubleBar.png';
		}
		else if(slot1curr == 5){
			slotImage1.src = src + 'singleBar.png';
		}
		else if(slot1curr == 6){
			slotImage1.src = src + 'cherry.png';
		}		
		slot1Context.drawImage(
            slotImage1, 
            (slot1Canvas.width / 2) - (slotImage1.width / 2), 
            (slot1Canvas.height / 2) - (slotImage1.height / 2), 
            slotImage1.width * 1.5,
            slotImage1.height * 1.5
        );
		
		//slot two
		if(slot2curr == 1){
			slotImage2.src = src + 'carImage.png';
		}
		else if(slot2curr == 2){
			slotImage2.src = src + 'sevenImage.png';
		}
		else if(slot2curr == 3){
			slotImage2.src = src + 'tripleBar.png';
		}
		else if(slot2curr == 4){
			slotImage2.src = src + 'doubleBar.png';
		}
		else if(slot2curr == 5){
			slotImage2.src = src + 'singleBar.png';
		}
		else if(slot2curr == 6){
			slotImage2.src = src + 'cherry.png';
		}
		
		slot2Context.drawImage(
            slotImage2, 
            (slot2Canvas.width / 2) - (slotImage2.width / 2), 
            (slot2Canvas.height / 2) - (slotImage2.height / 2), 
            slotImage2.width * 1.5, 
            slotImage2.height * 1.5
        );

		//slot3
		if(slot3curr == 1)		{
			slotImage3.src = src + 'carImage.png';
		}
		else if(slot3curr == 2)		{
			slotImage3.src = src + 'sevenImage.png';
		}
		else if(slot3curr == 3)		{
			slotImage3.src = src + 'tripleBar.png';
		}
		else if(slot3curr == 4)		{
			slotImage3.src = src + 'doubleBar.png';
		}
		else if(slot3curr == 5)		{
			slotImage3.src = src + 'singleBar.png';
		}
		else if(slot3curr == 6){
			slotImage3.src = src + 'cherry.png';
		}
		
		slot3Context.drawImage(
            slotImage3, 
            (slot3Canvas.width / 2) - (slotImage3.width / 2), 
            (slot3Canvas.height / 2) - (slotImage3.height / 2), 
            slotImage3.width * 1.5, 
            slotImage3.height * 1.5
        );
	}
	
	function spinReels(){
		
		if(slot1spin == true){
			slot1curr = randomNum();//slot1[randomNum()];
			playReelSpin();			
		}
        
		if(slot2spin == true){
			slot2curr = randomNum();//slot2[randomNum()];
			playReelSpin();
		}
        
		if(slot3spin == true){
			slot3curr = randomNum();//slot3[randomNum()];
			playReelSpin();
		}
		
		if((slot1spin == true)&& (slot2spin == true) && (slot3spin == true)){
			gameFinished == true;
		}
		//tokens = tokens - 1;
	}
	function randomNum(){
		rand = Math.floor(Math.random() * 100);
		var num = 0;
		
		if(rand <= 30){
			num = 6;
		}
		else if(rand < 53 && rand > 30){
			num = 5;
		}
		else if(rand < 71 && rand > 52){
			num = 4;
		}
		else if(rand < 85 && rand > 70){
			num = 3;
		}
		else if(rand < 95 && rand > 84){
			num = 2;
		}
		else if(rand <= 100 && rand > 94){
			num = 1;
		}
		return num;
	}
	
	function playWinSound(){
		//stop other sounds
		startSpinSound.pause();
		reelSpinning.pause();	
		//Set volume and play sound
		youWin.currTime = 0.0;
		youWin.volume = 0.5;
		youWin.play();
	}
	function playLossSound(){
		//stop othe sounds
		startSpinSound .pause();
		reelSpinning.pause();		
		//set volume and play sound
		noWin.currTime = 0.0;
		noWin.volume = 0.5;
		noWin.play();
	}
	function playReelSpin(){
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
	
	function turnOnLights(){
        var state = {
            'display':'block',
            'moz-animation-play-state':'running',
            '-webkit-animation-play-state':'running',
            '-ms-animation-play-state':'running',
            'animation-play-state':'running'
        };
        
		$('div#leftHead').css(state);		
		$('div#upperLeftSmall').css(state);
		$('div#lowerLeftSmall').css(state);
		$('div#LeftFog').css(state);
		$('div#rightHead').css(state);		
		$('div#upperRightSmall').css(state);		
		$('div#lowerRightSmall').css(state);
		$('div#RightFog').css(state);
	}
	function turnOffLights(){
        var state = {
            'display':'none', 'moz-animation-play-state':'paused',
            '-webkit-animation-play-state':'paused',
            '-ms-animation-play-state':'paused',
            'animation-play-state':'paused'
        };
        
		$('div#leftHead').css(state);		
		$('div#upperLeftSmall').css(state);
		$('div#lowerLeftSmall').css(state);
		$('div#LeftFog').css(state);
		$('div#rightHead').css(state);		
		$('div#upperRightSmall').css(state);		
		$('div#lowerRightSmall').css(state);
		$('div#RightFog').css(state);
	}	
	
	$('.spinButton').click(
	function(){
		startSpin();
		if(gameFinished == false){
			winnings = 0;
			tokens --;
			turnOffLights();
			//playReelSpin();
			
			$('div#bankValue').text('You have ' + tokens);
			$('div#resultsTextDiv').text('');
			$('div#wonTextDiv').text('');
			
			slot1spin = true;
			slot2spin = true;
			slot3spin = true;
			//gameFinished = false;			
		}
		
		update();
	});

	init();
});