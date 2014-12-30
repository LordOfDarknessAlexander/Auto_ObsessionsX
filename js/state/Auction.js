//Global Auction State Object, no caps as object is not const
var PLAYER_WAIT = 200;
var ENEMY_WAIT = 300;
//AI cooldown timer
/*var user = {
	canBid:false,
	didBid:false,
	didWin:false,
	startEndBid:false,
	endBidTimer:0,
	bid:0	//current bid
	//functions
};*/
var bidderCooldown = 0;
var playerCanBid = false;

var playerBid = 0;
//temp
var bidAmount = 200;
var currentBid = 0;
//var asking = upPerc + currentBid;
//var vehiclePrice = [20000,400,858,966666,898989,78787,85888];
//var vehiclePrice = 20000;
var currentBid = vehiclePrice * 0.1;

var enemyBids = [0,0,0,0]; 
var endBidTimers = [0,0,0,0];
var playerDidBid = false;
var enemyCanBid = false;
var playerNextBid = currentBid + (currentBid * 0.1);

//BidTImers Booleans
var startEndBids = [false,false,false,false];
var playerWinning = false;
var playerWon = false;
var goingTimer = 0;
var pGTimer = 0;



var startPlayerEndBid = false;	//player local
var playerEndBidTimer = 0;	//player local
//

function shuffleArray(array) 
{	//sort array items
    var counter = array.length, temp, index;
    // While there are elements in the array
    while (counter > 0) 
    {   // Pick a random index
        index = Math.floor(Math.random() * counter);
        // Decrease counter by 1
        counter--;
        // And swap the last element with it
        temp = array[counter];
        array[counter] = array[index];
        array[index] = temp;
       
    }
    return array;
}
var Auction =
{	//manages the state for purchasing cars
	_car : xdbCars[0],	//null;	////current car being sold, private var of Auction
	init:function(index)
	{	//call to start an auction for car
		//var i = 1;
		//endGame = false;
		appState = GAME_MODE.AUCTION;
		auctionStop = false;

		
		playerBid = 0;
		//auction buddies
		var enemy1; //= enemies[0];
		var enemy2; //= enemies[1];
		var enemy3; //= enemies[2];
		var enemy4; //= enemies[3];
		/*
		enemies[0] == enemyCaps[0];
		enemies[1] == enemyCaps[1];
		enemies[2] == enemyCaps[2];
		enemies[3] == enemyCaps[3];
		*/
	
		
		
		
		
		if(index < xdbCars.length)	//make sure index is within bounds to be safe
			_car = xdbCars[index];	
		
		if(_car !== null)
		{
			vehiclePrice = _car.getPrice();
			currentBid = vehiclePrice * 0.1;
		}
		jq.Auction.carPrice.text('car value:\n' + _car.getPrice().toFixed(2) );
		//initAI();
		//else, no car game breaks...
		this.endAuction();
		//
		shuffleArray(enemyBids);
		shuffleArray(bidders);
		shuffleArray(enemyCaps);
		//		
		context.font = '26px arial, sans-serif';  

		$('#Auction').show();
		
		this.setBidBtnText();
		$('div#Auction img#auctionCar').attr('src', _car.getFullPath() );
		$('div#Auction label#carInfo').text(/*'<h1>' + */_car.getFullName() + '-\n    ' + _car.getInfo() );
		//$('#menu').removeClass('gameMenu');
		//$('#menu').addClass('Auction');
		$('.sound').show();
		
		this.setup();
		
		assetLoader.sounds.gameOver.pause();
		assetLoader.sounds.going.pause();
		assetLoader.sounds.sold.pause();
		assetLoader.sounds.bg.currentTime = 0;
		assetLoader.sounds.bg.loop = true;
		assetLoader.sounds.bg.play();
	},
	restart : function()
	{
		delete sold;
		delete gameOver;	
		console.log("Restarting Auction snaps");
		playerWon = false;
		endGame = false;
		auctionStop = false;
		
		var enemy1; 
		var enemy2; 
		var enemy3; 
		var enemy4;
		player.restart();
		enemyBids = [0,0,0,0];
		endBidTimers = [0,0,0,0];
		enemyCaps = [enemyCap,enemyCap2,enemyCap3,enemyCap4,enemyCap5,enemyCap6];
		
			
		//this.initAI();
		
		this.setup();
		
		$('#GameOver').hide();
	
				
	},
	
	initAI : function()
	{	//initislize an array of AI players	
	
	
		enemies = [new Enemy(price(1.2)),new Enemy(price(0.6)), new Enemy(price(0.8)),new Enemy(price(0.2))];
		for(var i = 0; i < enemies.length; i++)
		{
		  	// enemies.price = enemyCaps;
		  	//enemies.price() = vehiclePrice;
		  	//enemies.price == vehiclePrice * 0.2;
		  	
		  	console.log(i);
		  	break;
		}
	  
	},	
	update : function()
	{
		Auction.bidTimers();
		Auction.enemyBidding();
		Auction.currentBidder();
		Auction.updatePlayer();
		Auction.going();
		Auction.playerGoing();
		
		console.log("Going" + goingTimer);
		
		//price();
		if(playerDidBid)
		{
			bidderCooldown++;
			enemyCanBid = false;
			
		}
	  	for(var i = 0; i < enemies.length; i++)
		{
		  	 //enemies.push(i);
		  	 console.log(i);
		  	 break;
		}

	  	if(bidderCooldown >= ENEMY_WAIT)
	  	{
	  		enemyCanBid = true;
	  		bidderCooldown = 0;
	  	}
	  	if(playerWinning)
	  	{
	  		pGTimer ++;
	  	}
	  	else
	  	{
	  		pGTimer = 0;
	  	}
	  	
	  	console.log("EnemyCaps " + enemyCaps[0]);
	  	Auction.findEndBidder();
	  	Auction.endAuction();
	  	Auction.destroy();
	  	//Auction.restart();
	  	
		if(auctionEnded)
		{
			this.destroy();
					
		}
		if(endGame)
		{
			this.destroy();					
		}

		if(restarted)
		{
			//stop = true;
			//auctionStop = false;
			//endGame = false;
			//auctionEnded = false;
			this.restart();
			
			
		}
		if(!auctionStop)
		{
			
		  	Auction.render();
		  
		}
		else
		{	//clear drawing when auction stops
			context.clearRect(0, 0, canvas.width, canvas.height);
		}
			
	  	Auction.buyOut();
	},
	render : function()
	{
		//if(endGame){
			//context.clearRect(0, 0, canvas.width, canvas.height);
			//return;
		//}
		
		
		context.drawImage(backgroundImage, 0,-10);
		
		
		player.draw();
		if(( playerBid == currentBid)&& (playerDidBid))
		{
			player.y = 10;
			context.fillText('Player Bid :  '   +'$'+ playerBid.toFixed(2)  ,ENEMY_X , 90);
		}
		else
		{
		  player.y = 150;
		  context.fillText('Player Bid :  '   +'$'+ playerBid.toFixed(2)  ,ENEMY_X , 230);
		}
		
		if((playerBid == enemyBids[0]) || (playerBid == enemyBids[1]) || (playerBid == enemyBids[2]) || (playerBid == enemyBids[3]))
		{
			playerBid != currentBid;
			
		}
		
		//ENENMY HUD
		
				
		//Enemy 1
		//draw them depending on current bid
		if(enemyBids[0] >= currentBid)
		{
			enemy1 = context.drawImage(curBidImage,10,34) + context.fillText( bidders[0] + '$'+ enemyBids[0].toFixed(2) ,ENEMY_X , 70);
			
					
		}
		else
		{
			enemy1 = context.drawImage(slimer,10,100) + context.fillText( bidders[0] + '$'+ enemyBids[0].toFixed(2) ,ENEMY_X, 120);
		
			
		}
		//Enemy 2
		if(enemyBids[1] >= currentBid)
		{
			enemy2 = context.drawImage(curBidImage,10,34) + context.fillText( bidders[1] + '$'+ enemyBids[1].toFixed(2) ,ENEMY_X , 70);
			
			
		}
		else
		{
			enemy2 = context.drawImage(slimer,10,130) + context.fillText(bidders[1] + '$'+ enemyBids[1].toFixed(2) ,ENEMY_X, 160);
			
			
		}
		//Enemy3
		if( enemyBids[2] >= currentBid )
		{
			enemy3 = context.drawImage(curBidImage,10,34) + context.fillText( bidders[2] + '$'+ enemyBids[2].toFixed(2) ,ENEMY_X , 70);
			
		}
		else
		{
			 enemy3 = context.drawImage(slimer,10,150) + context.fillText(bidders[2] + '$'+ enemyBids[2].toFixed(2) ,ENEMY_X, 180);
			 
		}
		//Enemy4
		if( enemyBids[3] >= currentBid)
		{
			enemy4 = context.drawImage(curBidImage,10,34) + context.fillText( bidders[3] + '$'+ enemyBids[3].toFixed(2) ,ENEMY_X , 70);
			
		}
		else
		{
			enemy4 =  context.drawImage(slimer,10,170) + context.fillText(bidders[3] + '$'+ enemyBids[3].toFixed(2) ,ENEMY_X, 200);
			
		}
		this.going();
		//call crowd for the player winning
		this.playerGoing();
		
		
		//current bid HUD
		//var gorguts;
		//gorguts = context.drawImage(curBidImage,360,84)+ context.fillText('Current Bid :  ' + '$'+ currentBid.toFixed(2)  ,426, 114);
		

		//these could be HTML elements in the Auction div
		//context.fillText('Vehicle Price :  ' + '$'+ vehiclePrice.toFixed(2)  ,400, 90);
		context.fillText('Money :  ' + '$'+ money.toFixed(2)  , canvas.width - 240, 66);

			
	},
	updatePlayer : function() 
	{
	  player.update();
	  
	  if(playerDidBid &&
			(playerBid > enemyBids[0]) &&
			(playerBid > enemyBids[1]) &&
			(playerBid > enemyBids[2]) &&
			(playerBid > enemyBids[3])  && (playerEndBidTimer >= ENEMY_WAIT + 100) )
		{
			//buyOut();
			this.playerGoing();
			playerWinning = true;
			
			console.log("player Going" + pGTimer);
						
			
		}
	
	},
	bidTimers : function()
	{	//updates AI bidding timers	
		for(var i = 0; i < startEndBids.length; i++)
		{
			if(startEndBids[i] = true){			
				endBidTimers[i]++;
			}
			else{
				endBidTimers[i] = 0;
				 goingTimer = 0;
			}
		}		
		//Player end bid
		if(startPlayerEndBid){
			playerEndBidTimer ++;
		}
		else{
			playerEndBidTimer = 0;
		}	
		
	},
	playerBidding : function() 
	{ 
		//player Cooldown button
		if(	bidderCooldown >= PLAYER_WAIT)
		{
			playerBid = currentBid + playerNextBid;
			playerCanBid = true;
			bidderCooldown = 0;
			startEndBids[0] = false;
			startEndBids[1] = false;
			startEndBids[2] = false;
			startEndBids[3] = false;
			startPlayerEndBid = true;						
		}
		
		if(playerBid <= money)
		{
			playerDidBid = true;
		
		}
		
		//Wins BId	
				
		
		
	},
	enemyBidding : function()
	{
		//upPercentage of vehicle for next bid
		var upPerc =  0.18 * currentBid;
		var startBid = vehiclePrice * 0.02;
		//var upPerc = startBid ;
		if( currentBid >= 0 )
		{	
			for(var i = 0; i < enemyBids.length; i++)
			{						
				enemies.price = 1;

				if(enemyCanBid)
				{//
					if((enemyBids[i] < currentBid) && (enemyBids[i] <  enemyCaps[0]) )
					{//enemies[i].bidCap)
					  enemyBids[i] = currentBid + upPerc;
					  assetLoader.sounds.bidder.play();
					  break;
					}
				}
			}
		 }
		//if the bidders bid is at o or less than the current bid player wins bid
	},	
	bidFinder : function()
	{	//determine bidder
		function checkBid(index)
		{
			//check if the enemy at the current index has a higher bid than the other AI's
			var ret = true;
			for(var i = 0; i < enemyBids.length; i++)
			{
				if(index != i)
				{
					if(enemyBids[index] > enemyBids[i])
					{
						continue;
						
					}
					else
					{
						ret = false;
						break;
					}
				}
			}
			return ret;
		}
		function setBid(index)
		{
			currentBid = enemyBids[index];
			
			for(var i = 0; i < startEndBids.length; i++)
			{
				startEndBids[i] = (i == index ? true : false);
			}
			
			startPlayerEndBid = false;	
		}
		
		if(checkBid(0) )
		{
			setBid(0);
		}
		else if(checkBid(1) )
		{
			setBid(1);
		}
		else if(checkBid(2) )
		{
			setBid(2);
		}
		else if(checkBid(3) )
		{
			setBid(3);
		}
	},
	currentBidder : function()
	{	//Player Bidding Function
		//Player has the current bid
		if( (playerBid > enemyBids[0])&&
			(playerBid > enemyBids[1])&&
			(playerBid > enemyBids[2])&&
			(playerBid > enemyBids[3]) )
		{
		   currentBid = playerBid;
		   startPlayerEndBid = true;
		   goingTimer = 0;
		   
		}
		//Find the player who has the highest bid dirty way enemy bidder 1 if it is not players bid then call func to find thru enemies
		else if((playerBid < enemyBids[0])||(playerBid < enemyBids[1])||(playerBid < enemyBids[2])||(playerBid < enemyBids[3]))
		{
		  this.bidFinder();
		}
	},
	findEndBidder : function()
	{
		for(var i = 0; i < bidders.length; i++)
		{
			if((currentBid == enemyBids[i]) && (endBidTimers[i] >= BID_THRESHOLD))
			{
				//end auction with enemy bidder
				goingTimer ++;
				shuffleArray(enemyCaps);
				
			}
		}
	},
	going : function()
	{
		//Going crowd roars someone is about to win the bid
		if((goingTimer > 300) && (goingTimer < 460))
		{
			//alert("Going Once " );
			context.fillText( "Going Once" ,ENEMY_X + 600 , 270);
			assetLoader.sounds.going.play();
			
		}
		else if((goingTimer > 470) && (goingTimer < 600))
		{
			//alert("Going Twice " );
			context.fillText( "Going Twice" ,ENEMY_X + 600 , 290);
			assetLoader.sounds.going.play();

		}
		else if(goingTimer > 660)
		{
			this.sold();
			//alert("Sold to " + bidders[i]);
			context.fillText( "Sold to " +  bidders[i],ENEMY_X + 600 , 310);
			
			
		}			
	},	
	playerGoing : function()
	{
		//Going crowd roars someone is about to win the bid
		if((pGTimer > 300) && (pGTimer < 460))
		{
			//alert("Going Once " );
			context.fillText( "Going Once" ,ENEMY_X + 600 , 270);
			assetLoader.sounds.going.play();
			
		}
		else if((pGTimer > 470) && (pGTimer < 600))
		{
			//alert("Going Twice " );
			context.fillText( "Going Twice" ,ENEMY_X + 600 , 290);
			assetLoader.sounds.going.play();

		}
		else if(pGTimer > 660)
		{
			playerWon = true;
			context.fillText( "Sold to the Player" ,ENEMY_X + 600 , 310);
			//alert("Sold to the player");
			
		}			

	},
	endAuction : function()
	{
		//if user won save to storage or pass to next state
		 endGame = true;
		 auctionEnded = true;
		 this.gameOver();
		 //this.sold();
		 assetLoader.sounds.bidder.pause();	
		 
		
		 
	},
	buyOut : function()
	{	//user 'buys out' the auction, placing the max bid
		//bidding continues until only 1 bidder remains
		if(playerWon)
		{
			money = money - currentBid;
			auctionEnded = true;
			//endGame == true;
			//push vehicle to garage
			//auctionStop = true;
			Auction.sold();
			assetLoader.sounds.bidder.pause();
			assetLoader.sounds.sold.play();
			
		}
		//auctionOver = true;
			 
	},
	destroy : function()
	{
		delete enemies; 
	    delete enemyBids;
		delete bidders;
		delete enemyCaps;
		delete pGTimer;
		delete goingTimer;
		delete endBidTimers;
		console.log("Destroying Auction snaps");
		delete player;
		endGame = false;
		playerWon = false;
		auctionStop = false;
		auctionEnded = false;
		if(restarted)
		{
			Auction.setUp();
			this.init();
			
		}
			
			
	},
	setBidBtnText : function()
	{
		$('#bid').text("Bid: $" + currentBid.toFixed(2) );
	}
	
};