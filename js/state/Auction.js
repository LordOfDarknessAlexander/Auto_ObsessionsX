//Global Auction State Object, no caps as object is not const
var PLAYER_WAIT = 200;
var ENEMY_WAIT = 300;
//AI cooldown timer

var bidderCooldown = 0;
var playerCanBid = false;

var playerBid = 0;
//temp
var bidAmount = 200;
var currentBid = vehiclePrice * 0.1;	//_car.getPrice() * 0.1; //bidding interval as a percent of total value

var enemyBids = [0,0,0,0]; 
var endBidTimers = [0,0,0,0];
var playerDidBid = false;
var enemyCanBid = false;
var playerNextBid = currentBid + (currentBid * 0.1);

//BidTImers Booleans
var startEndBids = [false,false,false,false];
var playerWinning = false;
var playerWon = false;
//there only needs to be 1 timer to track the closing of the auction
var goingTimer = 0;
var pGTimer = 0;
var startPlayerEndBid = false;	//player local
var playerEndBidTimer = 0;	//player local
var enemyWinning = false;
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
	//_enemies:[],
	/*
	//need to use namsespace to allow private vars we could implement and make all auction vars private
	_user : {	//object representing the current human player
		canBid:false,
		didBid:false,
		didWin:false,
		startEndBid:false,
		endBidTimer:0,
		bid:0	//current bid
		//functions
		nextBid : function(){
			this.bid += (this.bid * 1.0);
			return this.bid;
		}
	},*/
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
	
		if(index < xdbCars.length){	//make sure index is within bounds to be safe
			Auction._car = xdbCars[index];	//copy assigned
		}
		
		if(Auction._car !== null)
		{
			vehiclePrice = Auction._car.getPrice();
			currentBid = vehiclePrice * 0.1;
		}
		jq.Auction.carPrice.text('car value:\n' + Auction._car.getPrice().toFixed(2) );
		//initAI();
		//else, no car game breaks...
		//this.endAuction();
		//
		shuffleArray(enemyBids);
		shuffleArray(bidders);
		shuffleArray(enemyCaps);
		//		
		context.font = '26px arial, sans-serif';  

		jq.Auction.menu.show();		//$('#Auction').show();
		
		this.setBidBtnText();
		
		$('div#Auction img#auctionCar').attr('src', Auction._car.getFullPath() );
		$('div#Auction label#carInfo').text(/*'<h1>' + */Auction._car.getFullName() + '-\n    ' + Auction._car.getInfo() );
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
		 delete buyOut;	
			
		 enemy1; 
		 enemy2; 
		 enemy3; 
		 enemy4;

		 console.log("Restarting Auction snaps");
		 bidderCooldown = 0;
		 playerCanBid = false;
		
		 playerBid = 0;
		//temp
		 bidAmount = 200;
		 currentBid = 0;
		 currentBid = vehiclePrice * 0.1;
		
		 enemyBids = [0,0,0,0]; 
		 endBidTimers = [0,0,0,0];
		 enemyCaps = [enemyCap,enemyCap2,enemyCap3,enemyCap4,enemyCap5,enemyCap6];
		 playerDidBid = false;
		 enemyCanBid = false;
		 playerNextBid = currentBid + (currentBid * 0.1);
		
		//BidTImers Booleans
		 startEndBids = [false,false,false,false];
		 playerWinning = false;
		 playerWon = false;
		 goingTimer = 0;
		 pGTimer = 0;
		 startPlayerEndBid = false;	//player local
		 playerEndBidTimer = 0;	
		 player.reset();
		 
		 this.setup();
		 this.init();	//init requires a car index, this will break		
	},
	
	initAI : function()
	{	//initislize an array of AI players	
		//this._enemies = [];
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
	{	//main update logic, calle dper frame
		Auction.bidTimers();
		Auction.enemyBidding();
		Auction.currentBidder();
		Auction.updatePlayer();
		Auction.going();
		Auction.playerGoing();
		
		if(enemyWinning)
	  	{
	  	    goingTimer ++;
	  	    console.log("enemys winning" + goingTimer);
	  	}
	  	else
	  	{
	  		goingTimer = 0;
	  	}
		
		
		if(playerDidBid)
		{
			bidderCooldown ++;
			enemyCanBid = false;
			enemyWinning = false;			
		}
	  	
	  	if(bidderCooldown >= ENEMY_WAIT)
	  	{	//enemy bid cooldown has refreshed
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
			Auction.render();
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
			
		
		context.drawImage(backgroundImage, 0,-10);
		
		
		player.draw();
		
		if(playerDidBid && (playerBid == currentBid) )
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
		
		//call crowd for the player winning
		this.playerGoing();
		this.going();
		
		//current bid HUD
		//var gorguts;
		//gorguts = context.drawImage(curBidImage,360,84)+ context.fillText('Current Bid :  ' + '$'+ currentBid.toFixed(2)  ,426, 114);
		

		//these could be HTML elements in the Auction div
		//context.fillText('Vehicle Price :  ' + '$'+ vehiclePrice.toFixed(2)  ,400, 90);
		//context.fillText('Money :  ' + '$'+ money.toFixed(2)  , canvas.width - 240, 66);
	},
	updatePlayer : function() 
	{
		player.update();
		
		if(playerDidBid &&
			(playerBid > enemyBids[0]) &&
			(playerBid > enemyBids[1]) &&
			(playerBid > enemyBids[2]) &&
			(playerBid > enemyBids[3]) && (playerEndBidTimer >= ENEMY_WAIT + 100) )
		{
			this.playerGoing();
			playerWinning = true;
			
			console.log("player Going" + pGTimer);	
		}
	},
	bidTimers : function()
	{	//updates AI bidding timers	
		for(var i = 0; i < startEndBids.length; i++)
		{
			if(startEndBids[i] == true){			
				endBidTimers[i]++;
				
			}
			else{
				endBidTimers[i] = 0;
	
			}
		}		
		//Player end bid
		if(startPlayerEndBid)
		{
			playerEndBidTimer++;
		}
		else{
			playerEndBidTimer = 0;
		}
	},
	playerBidding : function() 
	{	//if CD timer has refreshed
		//player Cooldown button
		if(bidderCooldown >= PLAYER_WAIT)
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
		
		if(playerBid <= userStats.money)
		{
			playerDidBid = true;
			
		}
		else
		{
			 this.sold();
			 startPlayerEndBid = false;
		}

		
		//Wins BId
	},
	enemyBidding : function()
	{	//determine 
		//upPercentage of vehicle for next bid
		var upPerc =  0.18 * currentBid;
		var startBid = vehiclePrice * 0.02;
		//var upPerc = startBid ;
		if(!playerWon)
		{	
		
			for(var i = 0; i < enemyCaps.length; i++)
			{						
				//enemies.price = 1;

				if(enemyCanBid)	//global cooldown timer has refreshed, bidding now available
				{//
					if((enemyBids[i] < currentBid) && (enemyBids[i] <  enemyCaps[0]) )
					{//enemies[i].bidCap)
					  if( enemyBids[i]  < 4)
					  {
					  	  shuffleArray(enemyCaps);
					  }
					  enemyCaps[i] == enemyBids[i];					  					  
					  break;	//breaks on first available bidder?
					}
					
				}
			}
			
			for(var i = 0; i < enemyBids.length; i++)
			{						
				//enemies.price = 1;

				if(enemyCanBid)	//global cooldown timer has refreshed, bidding now available
				{//
					if((enemyBids[i] < currentBid) && (enemyBids[i] <  enemyCaps[i]) )
					{//enemies[i].bidCap)
					  enemyBids[i] = currentBid + upPerc;
					  assetLoader.sounds.bidder.play();
					  break;	//breaks on first available bidder?
					}
					
				}
				else
				{
				   enemyWinning = true;
				}
			}
		 }
		//if the bidders bid is at o or less than the current bid player wins bid
	},	
	bidFinder : function()
	{	//determine bidder
		function checkBid(index)
		{	//check if the enemy at the current index has a higher bid than the other AI's
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
		{	//
			currentBid = enemyBids[index];
			
			//iterate over AI, assing the bidder at index as the current bidder,
			//assigning all others to false
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
		else 
		{
			checkBid(3);
			setBid(3);
		}
		
		/*
		 switch (checkBid()) 
         {
            case 1:
            checkBid(0)
               setBid(0);
                break;
            case 2:
             checkBid(1)
               setBid(1);
                break;
            case 3:
             checkBid(2)
               setBid(2); 
               break;
            case 4:
             checkBid(3)
               setBid(3);
                break;             
        }*/

	},
	currentBidder : function()
	{	//determine if player has highest bid
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
		//Find the AI who has the highest bid
		else if((playerBid < enemyBids[0])||(playerBid < enemyBids[1])||(playerBid < enemyBids[2])||(playerBid < enemyBids[3]))
		{
		  this.bidFinder();
		}
	},
	findEndBidder : function()
	{	//determine who holds the bid, incrementing timer
		for(var i = 0; i < bidders.length; i++)
		{
			if((currentBid == enemyBids[i]) && (endBidTimers[i] >= BID_THRESHOLD))
			{	//enemeny is able to place bid
				//end auction with enemy bidder
				enemyWinning = true;
			}
			//shuffleArray(enemyCaps);
		}
	},

	going : function()
	{	//begin sale count down after a waiting period if no other bids are offered
		//Going crowd roars someone is about to win the bid
		//break out of while if someone outbids current bidder or if player does,
		//breaks out of the while loop and enemyWinning becomes false
		while((playerDidBid) && (enemyWinning) && (goingTimer < 660))
		{
			//goingTimer++;
			if((goingTimer > 0) && (goingTimer < 360))
			{
				//alert("Going Once " );
				goingTimer ++
				context.fillText( "Going Once" ,ENEMY_X + 600 , 270);
				assetLoader.sounds.going.play();
				break;
				
			}
			else if((goingTimer > 370) && (goingTimer < 650))
			{
				//alert("Going Twice " );
				context.fillText( "Going Twice" ,ENEMY_X + 600 , 290);
				assetLoader.sounds.going.play();
				break;
	
			}
			else if(goingTimer >= 660)
			{
				//if(playerWon)
					//sell car
				//else
					//lock-out car from further sale
				endGame = true;	
				this.sold();
				enemyWinning = false;
				goingTimer = 0;
				//alert("Sold to " + bidders[i]);
				context.fillText( "Sold to " +  bidders[i],ENEMY_X + 600 , 310);
				break;
			}	
			else
			{
				enemyWinning = false;
			}
	
		}
		
	},	
	playerGoing : function()
	{	//depreicated
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
			this.buyOut();
			context.fillText( "Sold to the Player" ,ENEMY_X + 600 , 310);
			//alert("Sold to the player");
			
		}			

	},
	buyOut : function()
	{	//user 'buys out' the auction, placing the max bid,
		//bidding continues until only 1 bidder remains
		//
		//disable buyout button for remainder of auction
		var btn = $('div#Auction button#buyOut');
		btn.click(function(){});
		btn.css('opacity', '0.65');
		
		if(playerWon)
		{
			userStats.money = userStats.money - currentBid;
			auctionEnded = true;
			//push vehicle to garage
			//auctionStop = true;
			Auction.sold();
			assetLoader.sounds.bidder.pause();
			assetLoader.sounds.sold.play();
		}	 
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
	},
	setBidBtnText : function()
	{
		$('#bid').text("Bid: $" + currentBid.toFixed(2) );
	}	
};