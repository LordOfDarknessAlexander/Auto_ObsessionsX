var auctions = [];

function auctionGen()
{
	return {
		
		//_vehiclePrice : 20000,
		//Javascript functionality for manage vehicle sales
		MAX_AUCTION_TIME : 1000,
		//AI cooldown timer
		_car:null,
		_carIndex : 0,
		_currentBid : 0,
		_ai : [],
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
				this._currentBid = this._car._price * 0.1;
				
				//Removing the vehicle here because if we wait until the vehicle sells the player can sell
				//the vehicle multiple times without collecting the money
				
				
				this._ai = [Enemy(price(this._car._price)), Enemy(price(this._car._price)), Enemy(price(this._car._price)), Enemy(price(this._car._price))];
				for(var i = 0; i < this._ai.length; ++i)
				{
					console.log(i + " bid cap = " + this._ai[i].bidCap);
				}
			}
		},
		close:function()
		{
			this._expired = true;
			this._date.end = Date.now() * 0.0001;
			this._curTime = 0.0;
			while(this._ai.length) { this._ai.pop(); }
		},
		update:function(dt)
		{
			if(!this._expired)
			{
				//console.log("Running");
				//console.log(this._currentBid);
				this._curTime += dt;
				this.bidTimers();
				this.enemyBidding();
				this.currentBidder();
				this.checkCurrentWinner();
				
				if(this._curTime >= this.MAX_AUCTION_TIME)
				{
					for(var i = 0; i < this._ai.length; ++i)
					{
						if(this._ai[i].winningBid)
						{
							console.log("AI " + i + " has won the bid for " + Math.round(this._ai[i].currBid) + " Original Price: " + this._car._price);
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
			cleanBtn.off().click({i:this._carIndex, amt:this._currentBid}, this.cleanUpAuction);
			this._currentBid = 0;
			Garage.save();
		},
		cleanUpAuction:function(index)
		{
			var cash = index.data.amt;
			//Give the user their money
			userStats.money += Math.round(cash);
			console.log("Adding " + Math.round(cash));
			
			//Find the element that contains the car information/button
			var i = index.data.i;
			var liID = "asli" + (i).toString();
			var carElement = $('li#' + liID);

			userGarage.splice(i, 1);
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
			var upPerc =  0.18 * this._currentBid;
			for(var i = 0; i < this._ai.length; i++)
			{						
				if(this._ai[i].canBid && !this._ai[i].winningBid)	//global cooldown timer has refreshed, bidding now avthis._ailable
				{
					if((this._ai[i].currBid < this._currentBid) && (!this._ai[i].leftAuction))
					{
						this._ai[i].currBid = this._currentBid + upPerc;
						this._ai[i].winningBid = true;
						break;
					}
				}
			}
			//if the bidders bid is at o or less than the current bid player wins bid
		},	
		bidTimers : function()
		{	//updates this._ai bidding timers	
			for(var i = 0; i < this._ai.length; ++i)
			{
				if(!this._ai[i].leftAuction)
				{
					this._ai[i].update();
				}
			}
		},
		bidFinder : function()
		{	//determine bidder
			//check the bids of each this._ai to determine the highest bid,
			//then setting the state;
			for(var i = 0; i < this._ai.length; ++i)
			{
				if(this.checkBid(i))
				{
					this.setBid(i);
				}
			}
		},
		checkBid : function(index)
		{	//check if the enemy at the current index has a higher bid than the other this._ai's
			var ret = true;
			for(var i = 0; i < this._ai.length; i++)
			{
				if(index != i)
				{
					if(this._ai[index].currBid > this._ai[i].currBid)
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
		},
		setBid : function(index)
		{
			if(!this._ai[index].leftAuction)
			{
				if(!this._ai[index].winningBid)
				{
					this._currentBid = this._ai[index].currBid;
					//console.log(this._currentBid);
				}
			
				//iterate over this._ai, assigning the bidder at index as the current bidder,
				//assigning all others to false
				for(var i = 0; i < this._ai.length; i++)
				{
					this._ai[i].canBid = (i == index ? true : false);
				}
			}
		},	
		currentBidder : function()
		{	
			this.bidFinder();

		},
		checkCurrentWinner : function()
		{
			for(var i = 0; i < this._ai.length; ++i)
			{
				this._ai[i].winningBid = (this._ai[i].currBid === this._currentBid ? true : false);
			}
		},
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
			auctions.push(AuctionSell._state);
			
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
	{
		var i;
		if(auctions.length > 0)
		{
			i = 0;
			while(i < auctions.length)
			{
				if(!auctions[i]._expired)
				{
					auctions[i].update(dt);
					++i;
				}
				else
				{
					auctions.splice(i, 1);
				}
			}
		}
	},
};