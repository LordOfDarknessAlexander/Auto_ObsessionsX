var _vehiclePrice = 20000;
var ai = [];
var currentBid = _vehiclePrice * 0.1;	//_car.getPrice() * 0.1, //bidding interval as a percent of total value

/*function shuffleArray(array) 
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
}*/

function auctionGen()
{
	return {
		
		//_vehiclePrice : 20000,
		//Javascript functionality for manage vehicle sales
		BID_COOLDOWN : 10,
		MAX_AUCTION_TIME : 600,
		//AI cooldown timer
		_car:null,
		_bidderCooldown : 0,
		//temp
		_bidAmount : 200,
		_carIndex : 0,
		//there only needs to be 1 timer to track the closing of the auction
		_goingTimer : 0,
		_pGTimer : 0,
		_date:{
			start:Date.now() * 0.0001,
			end:null
		},
		_expired:false,
		_curTime:0.0,
		
		init:function(index)
		{
			if(index !== null && index !== "undefined")
			{
				this._car = userGarage[index];
				this._carIndex = index;
				
				//Removing the vehicle here because if we wait until the vehicle sells the player can sell
				//the vehicle multiple times without collecting the money
				
				//Find the vehicle for auction in the player's garage
				for(var i = 0; i < userGarage.length; ++i)
				{
					//Once the vehicle has been found, remove it from the array
					if(userGarage[i].getFullName() === this._car.getFullName())
					{
						userGarage.splice(i, 1);
                        break;  //exit loop after removing car
					}
				}
				ai = [Enemy(price(Math.random(0.8, 1.5))), Enemy(price(Math.random(0.8, 1.5))), Enemy(price(Math.random(0.8, 1.5))), Enemy(price(Math.random(0.8, 1.5)))];
			}
		},
		close:function()
		{
			this._expired = true;
			this._date.end = Date.now() * 0.0001;
			this._curTime = 0.0;
			this._bidderCooldown = 0;
			while(ai.length) { ai.pop(); }
		},
		update:function(dt)
		{
			if(!this._expired)
			{
				console.log("Running");
				this._bidderCooldown += dt;
				this._curTime += dt;
				this.bidTimers();
				this.enemyBidding();
				this.currentBidder();
				this.findEndBidder();
				this.checkCurrentWinner();
				
				if(this._bidderCooldown >= this.BID_COOLDOWN)
				{	//enemy bid cooldown has refreshed
					this._enemyCanBid = true;
					this._bidderCooldown = 0;
				}
				
				if(this._curTime >= this.MAX_AUCTION_TIME)
				{
					for(var i = 0; i < ai.length; ++i)
					{
						if(ai[i].winningBid)
						{
							console.log("AI " + i + " has won the bid");
						}
					}
					console.log("Ending auction");
					this.endAuction();
					this.close();
				}
			}
		},
		endAuction:function()
		{
			var i = this._carIndex;
			var btnID = "as" + (i).toString(),
				liID = "asli" + (i).toString();
			var cleanBtn = $('li#' + liID + ' button#' + btnID);
			cleanBtn.text("Sold!");
			cleanBtn.off().click({i:this._carIndex}, this.cleanUpAuction);
			Garage.save();
		},
		cleanUpAuction:function(index)
		{
			//Give the user their money
			userStats.money += Math.round(currentBid);
			currentBid = _vehiclePrice * 0.1;
			
			//Find the element that contains the car information/button
			var i = index.data.i;
			var liID = "asli" + (i).toString();
			var carElement = $('li#' + liID);

			//Remove the element from the page
			carElement.remove();
		},
		load:function()
		{
			//this._date.end = Storage.local[''] !== null ? Storage.local[''] : null;
			//this._date.start = Storage.local[''];
			//this._expired = this._date.end === null ? false : true;
			//this._car.id = Storage.local[''];
			//this._curTime = this._date.end === null ? Storage.local[''] : 0.0;
		},
		save:function()
		{
			//this._date.end = Date.now() * 0.0001;
			//this._date.start;
			//this._expired;
			//this._car.id;
			//this._curTime;
		},
		enemyBidding : function()
		{	//determine 
			//upPercentage of vehicle for next bid
			var upPerc =  0.18 * currentBid;
			var startBid = this._vehiclePrice * 0.02;
			for(var i = 0; i < ai.length; i++)
			{						
				if(ai[i].canBid)	//global cooldown timer has refreshed, bidding now available
				{
					if((ai[i].currBid < currentBid) && (ai[i].currBid < ai[i].bidCap))
					{
						ai[i].currBid = currentBid + upPerc;
						assetLoader.sounds.bidder.play();
						break;	//breaks on first available bidder?
					}
				}
			}
			//if the bidders bid is at o or less than the current bid player wins bid
		},	
		bidTimers : function()
		{	//updates AI bidding timers	
			for(var i = 0; i < ai.length; ++i)
			{
				if(!ai[i].leftAuction)
				{
					ai[i].update();
				}
			}
		},
		bidFinder : function()
		{	//determine bidder
			function checkBid(index)
			{	//check if the enemy at the current index has a higher bid than the other AI's
				var ret = true;
				for(var i = 0; i < ai.length; i++)
				{
					if(index != i)
					{
						if(ai[index].currBid > ai[i].currBid)
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
				if(!ai[index].winningBid)
				{
					currentBid = ai[index].currBid;
				}
				//iterate over AI, assigning the bidder at index as the current bidder,
				//assigning all others to false
				for(var i = 0; i < ai.length; i++)
				{
					ai[i].canBid = (i == index ? true : false);
				}
			}		
			//check the bids of each AI to determine the highest bid,
			//then setting the state;
			for(var i = 0; i < ai.length; ++i)
			{
				if(checkBid(i))
				{
					setBid(i);
				}
			}
		},
		currentBidder : function()
		{	
			this.bidFinder();

		},
		checkCurrentWinner : function()
		{
			for(var i = 0; i < ai.length; ++i)
			{
				ai[i].winningBid = (ai[i].currBid === currentBid ? true : false);
			}
		},
		findEndBidder : function()
		{	//determine who holds the bid, incrementing timer
			for (var i = 0, sum = 0; i < ai.length; sum += ai[i++]);
			for(var i = 0; i < ai.length; i++)
			{
				if((currentBid == ai[i].currBid) && (sum >= BID_THRESHOLD))				
				{	//enemeny is able to place bid
					//end auction with enemy bidder
					console.log("Sum "+ sum + "BidThreshold" + BID_THRESHOLD);
					enemyWinning = true;
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
	ai:[],
    _cars:[],	//array of vehicles either sold or being sold by the user
	init:function(index)
	{
		if(index !== null && index !== "undefined")
		{
			//call to start an auction for car
			var i = index.data.i;
			AuctionSell._state = new auctionGen();
			AuctionSell._state.init(i);
			
			if(AuctionSell._state._car !== null)
			{
				var car = AuctionSell._state._car;
				var btnID = "as" + (i).toString(),
					liID = "asli" + (i).toString();
					
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
			}
		}
		jq.AuctionSell.toggle();
	},
	update : function(dt)
	{	//main update logic, calle dper frame
		if(this._state !== null && this._state !== 'undefined')
		{
			this._state.update(dt);
		}
	},
};