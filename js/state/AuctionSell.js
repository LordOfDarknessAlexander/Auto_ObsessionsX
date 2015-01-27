﻿//Javascript functionality for manage vehicle sales
/*var ENEMY_WAIT = 300;
//AI cooldown timer

var bidderCooldown = 0;
//temp
var bidAmount = 200;
var currentBid = vehiclePrice * 0.1;	//_car.getPrice() * 0.1; //bidding interval as a percent of total value

var enemyBids = [0,0,0,0]; 
var endBidTimers = [0,0,0,0];
var enemyCanBid = false;
//BidTImers Booleans
var startEndBids = [false,false,false,false];
//there only needs to be 1 timer to track the closing of the auction
var goingTimer = 0;
var pGTimer = 0;
var enemyWinning = false;*/
var _vehiclePrice = 20000;
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
function auctionGen()
{
	return {
		_ai:[],
		_car:null,
		//_vehiclePrice : 20000,
		//Javascript functionality for manage vehicle sales
		BID_COOLDOWN : 300,
		//AI cooldown timer

		_bidderCooldown : 0,
		//temp
		_bidAmount : 200,
		_currentBid : _vehiclePrice * 0.1,	//_car.getPrice() * 0.1, //bidding interval as a percent of total value

		//Enemy variables
		_enemyBids : [0,0,0,0], 
		_endBidTimers : [0,0,0,0],
		_startEndBids : [false,false,false,false],
		_enemyCanBid : false,
		//BidTImers Booleans
		
		//there only needs to be 1 timer to track the closing of the auction
		_goingTimer : 0,
		_pGTimer : 0,
		_date:{
			start:Date.now() / 1000.0,
			end:null
		},
		_expired:false,
		_curTime:0.0,
		
		init:function(index)
		{
			this._car = xdbCars[index];
			this._ai = [new Enemy(price(1.2)),new Enemy(price(0.6)), new Enemy(price(0.8)),new Enemy(price(0.2))];
			shuffleArray(this._enemyBids);
			
			//shuffleArray(bidders);
			//shuffleArray(this._enemyCaps);
		},
		close:function()
		{
			this._date.end = Date.now() / 1000.0;
		},
		update:function(dt)
		{
			if(!this._expired)
			{
				this._curTime += dt;
				this.bidTimers();
				//this.assignEnemyBidCaps();
				this.enemyBidding();
				this.currentBidder();
				this.findEndBidder();
				
				if(bidderCooldown >= BID_COOLDOWN)
				{	//enemy bid cooldown has refreshed
					enemyCanBid = true;
					bidderCooldown = 0;
				}
				/*if(auctionEnded)
				{
					this.destroy();		
				}
				if(endGame)
				{
					this.destroy();					
				}*/
			}
		},
		load:function()
		{
			//this._date.end = local.storage[''] !== null ? local.storage[''] : null;
			//this._date.start = local.storage[''];
			//this._expired = this._date.end === null ? false : true;
			//this._car.id = local.storage[''];
			//this._curTime = this._date.end === null ? local.storage[''] : 0.0;
		},
		save:function()
		{
			//this._date.end = Date.now() / 1000.0;
			//this._date.start;
			//this._expired;
			//this._car.id;
			//this._curTime;
		},
		enemyBidding : function()
		{	//determine 
			//upPercentage of vehicle for next bid
			var upPerc =  0.18 * _currentBid;
			var startBid = _vehiclePrice * 0.02;
			//var upPerc = startBid ;
			for(var i = 0; i < _enemyBids.length; i++)
			{						
				//enemies.price = 1;
				if(_enemyCanBid)	//global cooldown timer has refreshed, bidding now available
				{//
					if((_enemyBids[i] < _currentBid) && (_enemyBids[i] <  enemyCaps[i]) )
					{//enemies[i].bidCap)
					  _enemyBids[i] = _currentBid + upPerc;
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
				if(_enemyCanBid)	//global cooldown timer has refreshed, bidding now available
				{//
					if((_enemyBids[i] < _currentBid) && (_enemyBids[i] <  enemyCaps[i]) )
					{
					  if( _enemyBids[i]  < 4)
					  {
						  shuffleArray(enemyCaps);
					  }
					  enemyCaps[i] == _enemyBids[i];					  					  
					  break;	//breaks on first available bidder?
					}				
				}			
			}
		},	
		bidTimers : function()
		{	//updates AI bidding timers	
			for(var i = 0; i < _startEndBids.length; i++)
			{
				if(_startEndBids[i] == true){			
					_endBidTimers[i]++;
				}
				else{
					_endBidTimers[i] = 0;
				}
			}
		},
		enemyBidding : function()
		{	//determine 
			//upPercentage of vehicle for next bid
			var upPerc =  0.18 * _currentBid;
			var startBid = _vehiclePrice * 0.02;
			//var upPerc = startBid ;
			for(var i = 0; i < _enemyBids.length; i++)
			{						
				//enemies.price = 1;
				if(_enemyCanBid)	//global cooldown timer has refreshed, bidding now available
				{//
					if((_enemyBids[i] < _currentBid) && (_enemyBids[i] <  enemyCaps[i]) )
					{//enemies[i].bidCap)
					  _enemyBids[i] = _currentBid + upPerc;
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
				if(_enemyCanBid)	//global cooldown timer has refreshed, bidding now available
				{//
					if((_enemyBids[i] < _currentBid) && (_enemyBids[i] <  enemyCaps[i]) )
					{
					  if( _enemyBids[i]  < 4)
					  {
						  shuffleArray(enemyCaps);
					  }
					  enemyCaps[i] == _enemyBids[i];					  					  
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
				for(var i = 0; i < _enemyBids.length; i++)
				{
					if(index != i)
					{
						if(_enemyBids[index] > _enemyBids[i])
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
				_currentBid = _enemyBids[index];			
				//iterate over AI, assigning the bidder at index as the current bidder,
				//assigning all others to false
				for(var i = 0; i < _startEndBids.length; i++)
				{
					_startEndBids[i] = (i == index ? true : false);
				}
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
			for (var i = 0, sum = 0; i < _endBidTimers.length; sum += _endBidTimers[i++]);
			for(var i = 0; i < bidders.length; i++)
			{
				//if((currentBid == enemyBids[i]) && (_endBidTimers[i] >= BID_THRESHOLD))
				if((_currentBid == _enemyBids[i]) && (sum >= BID_THRESHOLD))				
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
		}
	};
}
var AuctionSell =
{	//manages the state for selling cars
	_state:null,
	_ai:[],
    _cars:[],	//array of vehicles either sold or being sold by the user
	init:function(index)
	{	
		if(index.i !== null)
		{
			//call to start an auction for car
			var i = 1;//index.i;
			AuctionSell._state = auctionGen();
			AuctionSell._state.init(i);
			console.log(i);
			
			//for(var i = 0; i < /*ao.*/soldCars.length; i++)
			if(AuctionSell._state._car !== null)
			{
				var car = AuctionSell._state._car;
				var btnID = "as" + (i).toString(),
					liID = "asli" + (i).toString();
					
				//var car = xdbCars[i];	//Garage._cars[i];
				var li = $('li#' + liID);
				//if(li === null || li === 'undefined')
				{
					var btnStr = "<li id='" + liID + "'>" + 
						"<img src='" + car.getFullPath() + "'>" +
						"<label id='carInfo'>" + car.getFullName() + "-<br>" + car.getInfo() + "</label>" +
						"<button id='" + btnID + "'>" + 
							"Price: $<label id='price'>" + (car.getPrice() ).toString() + "</label><br>" +
							"Auction expires: <label id='expireTime'></label>" +
						"</button>" +
					"</li><br>";
					jq.AuctionSell.carList.append(btnStr);
				}
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
				
				if(soldCar)// || auction.expired())
				{	//display but disable user from entering auction
					var li = $('#' + liID);
					li.css('opacity', '0.45');
					btn.click(this.denyAuction);
				}
				else{
					//if(auction.expired() ){
						//if(auction.paymentRecieved() ){ //user has recieved their money for this auction event
							//btn.click({index:i}, this.denyAuction);
							//btn.css('background-image', "url(\'..\\images\\defaultBtn.jpg");
						//}else{  //user hasn't recieved their money
							//btn.click({index:i}, this.getPayment);
							//btn.css('background-image', "url(\'..\\images\\recieveMoney.jpg");
						//}
					//}else{
						//btn.click({index:i}, this.cancelAuction);
						//btn.css('background-image', "url(\'..\\images\\cancel.jpg");
					//}
				}
			}
		}
		jq.AuctionSell.toggle();
	},
    close:function(){
        //safe close this state
    },
    denyAuction:function(){
        //do nothing, play sound
		//if(assetLoader.sounds.denyAuction is not playing)
			//play deny auction
		//visual alert as well to notify user?
	},
	initAI:function()
	{	//initislize an array of AI players	
		//this._enemies = [];
		AuctionSell._ai = [new Enemy(price(1.2)),new Enemy(price(0.6)), new Enemy(price(0.8)),new Enemy(price(0.2))];
	},
    save:function()
    {
        //m save auction sale events
        //if auction hasn't finished, pause and record time
    },
    load:function()
    {
        //load saved vehicle list
        
        //continue any auctions still in progress
        //TODO:these could be server processes which execute until completion,
        //regardles of the user being logged in
        //for(event in auctions){
            //if(!event.finished()){
                //event.resume();
            //}
        //}
    },
	update : function()
	{	//main update logic, calle dper frame
		AuctionSell.bidTimers();
		//Auction.assignEnemyBidCaps();
		AuctionSell.enemyBidding();
		AuctionSell.currentBidder();
		AuctionSell.going();
		AuctionSell.findEndBidder();
		
        if(enemyWinning){
	  	    //goingTimer++;
	  	    console.log("enemys winning" + goingTimer);
	  	}
	  	else{
	  		goingTimer = 0;
	  	}
	  	
	  	if(bidderCooldown >= ENEMY_WAIT)
	  	{	//enemy bid cooldown has refreshed
	  		enemyCanBid = true;
	  		bidderCooldown = 0;
	  	}
	  	
	  	//console.log("EnemyCaps1 " + enemyCaps[0]);
	  	//console.log("EnemyCaps2 " + enemyCaps[1]);
	  	//console.log("EnemyCaps3 " + enemyCaps[2]);
	  	//console.log("EnemyCaps4 " + enemyCaps[3]);
		
        if(this._end){
			this.close();
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
	/*bidTimers : function()
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
	},*/
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