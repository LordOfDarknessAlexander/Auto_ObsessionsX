<?php
if(!headers_sent() ){
    header('Content-type: application/javascript; charset: UTF-8');
}
//SaleView State Object
//require_once '../../dbConnect.php';
//require_once '../../vehicles/vehicle.php';
//require_once '../pasMeta.php';
//
$userID = getUID();
$tableName =  getUserTableName();
//
$fileName = 'js/state/slots.php';//__FILE__;
$funcName = '';
//
function ds(){?>div#Slots<?php
}
?>

jq.Slots = {
	menu : $('div#Slots'),
	backBtn : $('div#Slots button#backBtn'),
	homeBtn : $('div#Slots button#homeBtn')
	
	
};

	var slot1Canvas = document.getElementById('slot1'),
	slot1Context = slot1Canvas.getContext('2d'),
	
	//slot1Context = $("slot1").get(0);
	slot2Canvas = document.getElementById('slot2'),
	slot2Context = slot2Canvas.getContext('2d'),
	//slot2Context = $("slot2").get(0);
	slot3Canvas = document.getElementById('slot3'),
	//slot3Context = $("slot3").get(0);
	slot3Context = slot3Canvas.getContext('2d');
		
		
$(document).ready(
function(){
		

		
		var spinButton = document.getElementById('spinButton');
	
		var slot1 = [];
		var slot2 = [];
		var slot3 = [];
		//var jq;
		//
		var userStats = [];
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
		var val = 0;
		
var Slots = {
	_slots : null,
	
	
	
	
	init:function(index){
        //call to start an auction for car		
        //console.log(index);
        //disable/enable sounds before ajax call
        
        if(audioEnabled() ){
            console.log('audio enabled-Slots');
            var s = assetLoader.sounds;
            s.gameOver.pause();
            //s.going.pause();
            s.sold.pause();
            //s.bg.currentTime = 0;
            //s.bg.loop = true;
            //s.bg.play();
        }
		//dt = aoTimer.getDT();
		tokens = 3;
		
		//initialize text
		$('div#welcomeTextDiv').text('Welcome to the Auto Obsessions Slots');
		$('div#bankValue').text('You have ' + tokens + ' tokens');
	
		document.addEventListener('keyup',keyUpHandler, false);
		turnOffLights();
		
		jq.Slots.menu.hide();
		jq.Slots.menu.show();
		

        var funcName = 'Slots.php, Auction::init()';
		appState = GAME_MODE.Slots;
		
	},
	
	close : function(){
        jq.carImg.hide();
	},
	stop : function(){
		
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
	},
	checkForWin : function(){
		
		 var res = $('div#resultsTextDiv');
        
		if(slot1curr == 1 && slot2curr == 1 && slot3curr == 1){
			tokens ++;
			//tokens ++;
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
			tokens ++;
			
			//Play sound
			playWinSound();
			//Play Lights
			turnOnLights();	
		}
		else if(slot1curr == 3 && slot2curr == 3 && slot3curr == 3){
			//winnings = bet * 5;
			res.text('Congratulations, You win!');
			$('div#wonTextDiv').text('You Won ' + tokens + ' tokens');
			//tokens = tokens + 1;
			tokens ++;
			//Play sound
			playWinSound();
			//Play Lights
			turnOnLights();
		}
		else if(slot1curr == 4 && slot2curr == 4 && slot3curr == 4){
			res.text('Uhh pinata');
			$('div#wonTextDiv').text('You Won ' + tokens + ' tokens');
			//tokens = tokens + 1;
			tokens ++;
			//Play sound
			playWinSound();
			//Play Lights
			turnOnLights();
		}
		else if(slot1curr == 5 && slot2curr == 5 && slot3curr == 5){
			res.text('Congratulations, You win!');
			$('div#wonTextDiv').text('You Won ' + tokens + ' tokens');
			//tokens = tokens + 1;
			tokens ++;
			//Play sound
			playWinSound();
			//Play Lights
			turnOnLights();
		}
		else if( (slot1curr == 5 && slot2curr == 5)  || (slot1curr == 6 && slot2curr == 6 && slot3curr == 6) ){
			res.text('Congratulations, You win!');
			$('div#wonTextDiv').text('You Won ' + tokens + ' tokens');
			//tokens = tokens + 1;
			tokens ++;
			//Play sound
			playWinSound();
			//Play Lights
			turnOnLights();
		}
		else if( (slot1curr == 5 || slot1curr == 6) && slot2curr == 6){
			res.text('Congratulations, You win!');
			$('div#wonTextDiv').text('You Won ' + tokens + ' tokens');
			//tokens = tokens + 1;
			tokens ++;
			//Set volume and play sound
			playWinSound();
			//Play Lights
			turnOnLights();
		}
		else if(slot1curr == 6  || slot2curr == 6 || slot3curr == 6){
			//winnings = bet * 1.5;
			res.text('Congratulations, You win!');
			$('div#wonTextDiv').text('You Won ' + tokens + ' tokens');
			//Set volume and play sound
			//tokens = tokens + 1;
			tokens ++;
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
		
        $('div#bankValue').text('You have ' + tokens + ' tokens');
		console.log(tokens);
	},
	startSpin: function(){
		if(this.gameFinished == false){
			//winnings = 0;
			//tokens = 0;
			
			$('div#bankValue').text('You have ' + tokens + ' tokens');
			$('div#resultsTextDiv').text('');
			$('div#wonTextDiv').text('');
			
			slot1spin = true;
			slot2spin = true;
			slot3spin = true;
		
		}
		else{
			this.stop();
			
		}
		this.update();
	},
	keyUpHandler: function(event){
		var keyPressed = event.keyCode;
		
        if (keyPressed == 32){
			turnOffLights();
			//playReelSpin();
			this.startSpin();
		}
	},
	spinReels: function(){
		if(slot1spin == true){
			slot1curr = this.randomNum();//slot1[randomNum()];
			this.playReelSpin();			
		}
        
		if(slot2spin == true){
			slot2curr = this.randomNum();//slot2[randomNum()];
			this.playReelSpin();
		}
        
		if(slot3spin == true){
			slot3curr = this.randomNum();//slot3[randomNum()];
			this.playReelSpin();
		}
		
		if((slot1spin == true)&& (slot2spin == true) && (slot3spin == true)){
			this.gameFinished == true;
		}
	},
	playWinSound: function(){
		//stop other sounds
		startSpinSound.pause();
		reelSpinning.pause();	
		//Set volume and play sound
		youWin.currTime = 0.0;
		youWin.volume = 0.5;
		youWin.play();
	},
	playLossSound: function(){
		//stop othe sounds
		startSpinSound .pause();
		reelSpinning.pause();		
		//set volume and play sound
		noWin.currTime = 0.0;
		noWin.volume = 0.5;
		noWin.play();
	},
	playReelSpin: function(){
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
	},
	
	randomNum: function(){
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
	},
	update : function(){
		window.requestAnimationFrame(update, $('canvas#slot1Canvas'));
		slot1Context.clearRect(0, 0, slot1Canvas.width, slot1Canvas.height);
		slot2Context.clearRect(0, 0, slot2Canvas.width, slot2Canvas.height);
		slot3Context.clearRect(0, 0, slot3Canvas.width, slot3Canvas.height);
		this.drawReels();
 		this.spinReels();
		tokens == val;
		if(gameFinished == true){
			reelsSpinning.pause();
			reelSpinning.loop = false;
			startSpinSound.pause();
			startSpinSound.loop = false;
			this.stop();
		}
		if(spins == true){
			this.spinTimer --;
		}
		if( tokens <= 0)
		{
			this.gameFinished = true;
		}
	},
	drawReels : function(){
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
	},
	turnOnLights: function(){
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
	},
	turnOffLights: function(){
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
	},
	setTokens : function(){
		//<php
//if(DEBUG){>
		if(val !== null &&
			val !== undefined &&
			val >= 0 &&
			val != userStats.tokens
		){
			userStats.tokens = val;  //if an argument is passed, assign value to money
		}
		$('div#statBar label#tokens').text('Tokens: ' + userStats.tokens.toString() );
		
		if(userStats.tokens == 0){
			//jq.Msg('No more tokens, go to the store to purchase more!')
			console.log('No more tokens , go to the store to purchase more');
		}
//<php
//}
//>  
	}
	
};
//
//Slots jQuery bindings

$('.spinButton').click(
function(){
	Slots.startSpin();
	if(gameFinished == false){
		tokens --;
		Slots.turnOffLights();
		Slots.setTokens(val);
		//playReelSpin();
		
		$('div#bankValue').text('You have ' + tokens);
		$('div#resultsTextDiv').text('');
		$('div#wonTextDiv').text('');
		
		slot1spin = true;
		slot2spin = true;
		slot3spin = true;
		//gameFinished = false;			
	}
	
	Slots.update();
});
//
$('.slotStop').click(
	function(){
		
		Slots.spinTimer = 200;
		Slots.spins = true;
		Slots.update();
		Slots.setTokens(val);
		console.log(Slots.spinTimer);
		if((Slots.slot1spin == true) && (Slots.spinTimer < 200)){
			Slots.slot1curr = randomNum();//slot1[randomNum()];
			Slots.playReelSpin();
			Slots.slot1spin = false;
			Slots.spins = true;
			//spinTimer --;
			Slots.update();
		}
		else if((Slots.slot2spin == true) && (Slots.spinTimer < 100)){
			slot2curr = Slots.randomNum();//slot2[randomNum()];
			Slots.playReelSpin();
			Slots.slot2spin = false;
			Slots.spins = true;
			Slots.spinTimer --;
			Slots.update();
		}
		else if((Slots.slot3spin == true)&& (Slots.spinTimer < 50)){
			Slots.slot3curr = Slots.randomNum();//slot3[randomNum()];
			Slots.playReelSpin();
			Slots.slot3spin = false;
			Slots.spins = true;
			//spinTimer --;
			Slots.update();
		}
		
		if(Slots.gameFinished == false){
			Slots.stop();
			Slots.checkForWin();
			Slots.slot1spin = false;
			Slots.slot2spin = false;
			Slots.slot3spin = false; 
		}
		else{
			return;
		}
	
	Slots.stop();
});


init();
});
