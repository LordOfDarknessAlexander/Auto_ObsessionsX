//Global Auction State Object, no caps as object is not const
//TODO:move vars into Auction, to remove from global scope
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
var AuctionSell =
{	//manages the state for purchasing cars
	//_ai:[],
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
		//appState = GAME_MODE.AUCTION;
		auctionStop = false;

		//if(index < xdbCars.length){	//make sure index is within bounds to be safe
			//Auction._car = xdbCars[index];	//copy assigned
		//}
		
		//if(Auction._car !== null){
			//vehiclePrice = Auction._car.getPrice();
			//currentBid = vehiclePrice * 0.1;
		//}
		//jq.Auction.carPrice.text('car value:\n' + Auction._car.getPrice().toFixed(2) );
		//
		shuffleArray(enemyBids);
		shuffleArray(bidders);
		shuffleArray(enemyCaps);
		
		//jq.AuctionSell.menu.show();		//$('#Auction').show();
		
		//this.setBidBtnText();
		//this.assignEnemyBidCaps();
		
		//$('div#Auction img#auctionCar').attr('src', Auction._car.getFullPath() );
		//$('div#Auction label#carInfo').text(/*'<h1>' + */Auction._car.getFullName() + '-\n    ' + Auction._car.getInfo() );
		//$('.sound').show();
		
		this.setup();
		
		for(var i = 0; i < /*ao.*/xdbCars.length; i++)
		{
			var btnID = "as" + (i).toString(),
				liID = "asli" + (i).toString(),
				labelID = 'infoLabel';
				
			var car = xdbCars[i];	//ao.xdbCars[i];
			
			var btnStr = "<li id=\'" + liID + "\'>" + 
				"<img src=\'" + car.getFullPath()/*car.getFullPath()*/ + "\'>" +
				"<label id=\'" + labelID + "\'>" + car.getFullName() + "-<br>" + car.getInfo() + "</label>" +
				"<button id=\'" + btnID + "\'>" + 
					"<label id=\'price\'>$" + (car.getPrice() ).toString() + "</label><br>" +
					"Bid Now!<br>" +
					//"<label id=\'expireTime\'>Auction expire time!</label>" +
				"</button>" +
			"</li><br>";
			this.list.append(btnStr);
			//
			var btn = $('#' + btnID);
			
			var soldCar = false;
			//for(var j = 0; j < AuctionSell.soldCars.length; j++)
			//{
				//var gc = AuctionSell.soldCars[j];

				//if(car.getFullName()/*id*/ == gc.getFullName()/*id*/){
					//soldCar = true;
					//break;
				//}
			//}
			
			if(soldCar)
			{	//display but disable user from entering auction
				var li = $('#' + liID);
				li.css('opacity', '0.45');
				btn.click(this.denyAuction);
			}
			else{
				//btn.click({index:i}, this.initAuction);
				//btn.css('background-image', "url(\'..\\images\\vehicle.jpg");	//car.getFullPath());
			}
		}
	},
    denyAuction : function(){
		//if(assetLoader.sounds.denyAuction is not playing)
			//play deny auction
		//visual alert as well to notify user?
	},
	initAI : function()
	{	//initislize an array of AI players	
		//this._enemies = [];
		enemies = [new Enemy(price(1.2)),new Enemy(price(0.6)), new Enemy(price(0.8)),new Enemy(price(0.2))];
	},	
	update : function()
	{	//main update logic, calle dper frame
		Auction.bidTimers();
		//Auction.assignEnemyBidCaps();
		Auction.enemyBidding();
		Auction.currentBidder();
		Auction.updatePlayer();
		Auction.going();
		Auction.playerGoing();
		Auction.findEndBidder();
		Auction.sellCarEndAuction();
		
        if(enemyWinning){
	  	    //goingTimer ++;
	  	    console.log("enemys winning" + goingTimer);
	  	}
	  	else{
	  		goingTimer = 0;
	  	}
		console.log("enemys winning" + endBidTimers);
	  	
	  	if(bidderCooldown >= ENEMY_WAIT)
	  	{	//enemy bid cooldown has refreshed
	  		enemyCanBid = true;
	  		bidderCooldown = 0;
	  	}
	  	
	  	//console.log("EnemyCaps1 " + enemyCaps[0]);
	  	//console.log("EnemyCaps2 " + enemyCaps[1]);
	  	//console.log("EnemyCaps3 " + enemyCaps[2]);
	  	//console.log("EnemyCaps4 " + enemyCaps[3]);
	
		if(auctionEnded)
		{
			this.destroy();		
		}
		if(endGame)
		{
			this.destroy();					
		}

		//if(!auctionStop)
		//{
		  	//Auction.render();
		//}
		//else
		//{	//clear drawing when auction stops
			//context.clearRect(0, 0, canvas.width, canvas.height);
		//}
	},
	render : function()
	{
		/*context.drawImage(backgroundImage, 0,-10);

		player.draw();
		
		if(playerDidBid && (playerBid == currentBid) )
		{
			player.y = 10;
			context.fillText('Player Bid :  ' + '$' + playerBid.toFixed(2)  ,ENEMY_X , 90);
		}
		else
		{
		  player.y = 150;
		  context.fillText('Player Bid :  ' + '$'+ playerBid.toFixed(2)  ,ENEMY_X , 230);
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
        */
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
	},
	enemyBidding : function()
	{	//determine 
		//upPercentage of vehicle for next bid
		var upPerc =  0.18 * currentBid;
		var startBid = vehiclePrice * 0.02;
		//var upPerc = startBid ;
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
        }
		//if the bidders bid is at o or less than the current bid player wins bid
	},	
	assignEnemyBidCaps : function()
	{
		for(var i = 0; i < enemyCaps.length; i++)
		{						
			//enemies.price = 1;
			if(enemyCanBid)	//global cooldown timer has refreshed, bidding now available
			{//
				if((enemyBids[i] < currentBid) && (enemyBids[i] <  enemyCaps[i]) )
				{
				  if( enemyBids[i]  < 4)
				  {
				  	  shuffleArray(enemyCaps);
				  }
				  enemyCaps[i] == enemyBids[i];					  					  
				  break;	//breaks on first available bidder?
				}				
			}			
		}
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
			//iterate over AI, assigning the bidder at index as the current bidder,
			//assigning all others to false
			for(var i = 0; i < startEndBids.length; i++)
			{
				startEndBids[i] = (i == index ? true : false);
			}
			
			startPlayerEndBid = false;	
		}		
        //check the bids of each AI to determine the highest bid,
        //then setting the state;
		if(checkBid(0) ){
			setBid(0);
		}
		else if(checkBid(1) ){
			setBid(1);
		}
		else if(checkBid(2) ){
			setBid(2);
		}
		else if(checkBid(3) ){
			setBid(3);
		}
	},
	currentBidder : function()
	{	
        this.bidFinder();

	},
	findEndBidder : function()
	{	//determine who holds the bid, incrementing timer
		for (var i = 0, sum = 0; i < endBidTimers.length; sum += endBidTimers[i++]);
		for(var i = 0; i < bidders.length; i++)
		{
			//if((currentBid == enemyBids[i]) && (endBidTimers[i] >= BID_THRESHOLD))
			if((currentBid == enemyBids[i]) && (sum >= BID_THRESHOLD))				
			{	//enemeny is able to place bid
				//end auction with enemy bidder
				console.log("Sum "+ sum + "BidThreshold" + BID_THRESHOLD);
				enemyWinning = true;
				//this.going();
			}
			else if(sum >= BID_THRESHOLD)
			{
				enemyWinning = true;
			}
		}
	},
	going : function()
	{	//begin sale count down after a waiting period if no other bids are offered
		//Going crowd roars someone is about to win the bid
		//break out of while if someone outbids current bidder or if player does,
		//breaks out of the while loop and enemyWinning becomes false
		/*while((playerDidBid) && (enemyWinning) && (goingTimer < 660))
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
		}*/
	}
};