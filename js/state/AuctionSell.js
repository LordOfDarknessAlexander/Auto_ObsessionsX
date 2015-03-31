//<php
//js::header();
//function loggedIn(){
    //return true;
//}
//?>
var userSales = [];

function hasSoldCar(carID){
    //has the user already auctioned a car with carID
    var len = userSales.length;
    
    if(len == 0){
        return false;
    }
    
    for(var i = 0; i < len; i++){
        if(userSales[i]._car.id == carID){
            return true;
        }
    }
    return false;
}

function auctionGen()
{
	return {
		//_vehiclePrice : 20000,
		//Javascript functionality for manage vehicle sales
		MAX_AUCTION_TIME : 1000,    //how many units of time is thins?
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
			if(index !== null && index !== undefined)
			{
                var car = userGarage[index];
                
                if(car !== null && !hasSoldCar(car.id)){
                    //this car has not been previously sold!
                    this._car = car;
                    this._carIndex = index;
                    this._currentBid = this._car.getPrice() * 0.05;
                    
                    this._initAI();
                }
                else{
                    console.log('user has already sold car with id (' + car.id.toString() + ')');
                }
			}
            //else entry sell screen without posting an auction
            //jq.AuctionSell.show();
		},
        _initAI:function(){
            var p = this._car.getPrice();
            
            this._ai = [
                Enemy(price(p)),
                Enemy(price(p)),
                Enemy(price(p)),
                Enemy(price(p))
            ];

            for(var i = 0; i < this._ai.length; ++i){
                console.log(i + ' bid cap = ' + this._ai[i].bidCap);
            }
        },
        addButton:function(){
            if(this._car === null){
                //user has already sold this car,
                //or setup has failed for another reason
                console.log('could not set up html button for car');
            }else{
                var car = this._car,
                    btnID = 'as' + (car.id).toString(),
                    liID = 'asd' + (car.id).toString();
                    
                var btnStr = "<div id='" + liID + "'>" + 
                    "<img src='" + car.getFullPath() + "'>" +
                    "<label id='carInfo'>" + car.getFullName() + "</label>" +
                    "<label id='" + btnID + "'>" + 
                        "<label id='price'>Price: $" + (car.getPrice() ).toString() + "</label><br>" +
                        "<label id='expireTime'>Auction expires: </label>" +
                    "</label>" +
                    "<div id='btns'>" +
                        "<button id='view'></button>" +
                        "<button id='cc'></button>" +
                    "</div>" +
                "</div><br>";
                
                jq.AuctionSell.carView.append(btnStr);
            }
        },
		close:function()
		{
			this._expired = true;
            this.toggleCC();
			this._date.end = Date.now() * 0.0001;
			this._curTime = 0.0;
            //while loops are bad practice, prone to misuse and infinite loops.
            //using array.pop() method is bad, is slow as the array must be
            //reallocated when the array is resized and can cause memory fragmentation issues!
            //use this._ai = [], or delete _ai to reset or delete the memory, respectfully
			while(this._ai.length) { this._ai.pop(); }
            
            //AuctionSell.save();
		},
		update:function(dt)
		{
			if(!this._expired){
				//console.log('Running');
				//console.log(this._currentBid);
				this._curTime += dt;
				this.bidTimers();
				this.enemyBidding();
				this.currentBidder();
				this.checkCurrentWinner();
				
				if(this._curTime >= this.MAX_AUCTION_TIME){
                    //continue to update until time runs out
					for(var i = 0; i < this._ai.length; ++i){
						if(this._ai[i].winningBid){
							console.log('AI ' + i + ' has won the bid for ' + Math.round(this._ai[i].currBid) + ' Original Price: ' + this._car.getPrice());
						}
					}
					console.log('Ending auction');
					this.endAuction();
					this.close();
				}
                //close auction here!
                //console.log('Ending auction');
                //this.endAuction();
                //this.close();
			}
		},
		endAuction:function()
		{
			var i = this._carIndex,
                btnID = 'as' + (i).toString(),
				liID = 'div#asd' + (this._car.id).toString(),
                cleanBtn = $(liID + ' button#' + btnID),
                moneyBtn = $(liID + ' div#btns button#cc');
                
			cleanBtn.text('Sold!');
			//cleanBtn.off().click({i:this._carIndex, amt:this._currentBid}, this.cleanUpAuction);
            //this._currentBid = 0;
			//AucionSell.save();
            Garage.save();
		},
		cleanUpAuction:function(index)
		{
			var cash = index.data.amt;
			//Give the user their money
			userStats.money += Math.round(cash);
			console.log('Adding ' + Math.round(cash));
			
			//Find the element that contains the car information/button
			var i = index.data.i;
			//var carElement = $('div#asd' + (this._car.id).toString() );

			userGarage.splice(i, 1);
			//Remove the element from the page
			//carElement.remove();
            //carElement.css('opacity','0.45');
            //
		},
		load:function()
		{
			//this._date.end = Storage.local[''] !== null ? Storage.local[''] : null;
			//this._date.start = Storage.local[''];
			//this._expired = this._date.end === null ? false : true;
			//this._car.id = Storage.local[''];
			//this._curTime = this._date.end === null ? Storage.local[''] : 0.0;
//<php
//if(loggedIn() ){>
            //load stored userSales from sql database, using pas
//<php
//}
//else{ //playing as guest>
            //load from local storage
//<php
//}
//>
		},
        restart:function(data){
            this._car = Garage.getCarByID(data.id);
            this._currentBid = data.bid;
            //this._date = data.date;
            
            //if(this._date.end === null){
                //this._expired = false,
                //_curTime:0.0;
                //this._initAI();
            //}
            //else{
                this._expired = true;
                //this._curTime = this._date.end - this._date.start;
            //}
            this.addButton();
            
            if(this._expired){
                //this.disableButton();
            }
        },
		toJSON : function()
		{	//called by JSON.stringify to conver this object into a json string,
			//this is called by JSON.stringify and will be serialized
			return {
                id:this._car.id,
                bid:this._currentBid,   //current highest bid
                time:this._curTime, //time remaining on auction, 0 if expired
                //date:this._date   //start and end dates
			};
		},
		enemyBidding : function()
		{	//determine 
			//upPercentage of vehicle for next bid
            var cb = this._currentBid;
                upPerc =  0.06 * cb;
			
            for(var i = 0; i < this._ai.length; i++){					
				if(this._ai[i].canBid && !this._ai[i].winningBid){	//global cooldown timer has refreshed, bidding now available
                    //if AI can bid and is not currently the top bidder
                    if((this._ai[i].currBid < cb) && (!this._ai[i].leftAuction)){
						this._ai[i].currBid = cb + upPerc;
						this._ai[i].winningBid = true;
						break;
					}
				}
			}
			//if the bidders bid is at o or less than the current bid player wins bid
		},	
		bidTimers : function()
		{	//updates this._ai bidding timers	
			for(var i = 0; i < this._ai.length; ++i){
				if(!this._ai[i].leftAuction){
					this._ai[i].update();
				}
			}
		},
		bidFinder : function()
		{	//determine bidder
			//check the bids of each this._ai to determine the highest bid,
			//then setting the state;
			for(var i = 0; i < this._ai.length; ++i){
				if(this.checkBid(i)){
					this.setBid(i);
				}
			}
		},
		checkBid : function(index)
		{	//check if the enemy at the current index has a higher bid than the other this._ai's
			var ret = true;
            
			for(var i = 0; i < this._ai.length; i++){
				if(index != i){
					if(this._ai[index].currBid > this._ai[i].currBid){
						continue;
					}
					else{
						ret = false;
						break;
					}
				}
			}
			return ret;
		},
		setBid : function(index){
            var ai = this._ai[index];   //temporary val is useful when not setting object values
			
            if(!ai.leftAuction){
				if(!ai.winningBid){
					this._currentBid = ai.currBid;
					//console.log(this._currentBid);
				}			
				//iterate over this._ai, assigning the bidder at index as the current bidder,
				//assigning all others to false
				for(var i = 0; i < this._ai.length; i++){
                    //must index into the array diretly if we want to set values!
					this._ai[i].canBid = (i == index ? true : false);
				}
			}
		},	
		currentBidder : function(){	
			this.bidFinder();
		},
		checkCurrentWinner : function(){
            //determine which ai has the highest bid
			for(var i = 0; i < this._ai.length; ++i){
				this._ai[i].winningBid = (this._ai[i].currBid === this._currentBid ? true : false);
			}
		},
        toggleCC:function(){
            //toggles the cancel/cash button
            if(this._car !== null){
                var divID = 'div#asd' + (this._car.id).toString(),
                    btnID = divID + ' div#btns button#cc',
                    btn = $(btnID);
                    
                if(this._expired){
                    btn.css({
                        'background':"url('images/money.jpg') no-repeat 0 0",
                        'background-size':"100% 100%",
                    });
                    //btn.off().click({cid:this._car.id, price:this._currentBid}, this.payUser);
                }
                else{
                    btn.css({
                        'background':"url('images/cancel.jpg') no-repeat 0 0",
                        'background-size':"100% 100%",
                    });
                    //btn.off().click({cid:this._car.id, price:this._currentBid}, this.cancelAuction);
                }
			
            }
        },
        viewAuction:function(carID){
            //view an auction while it is active!
            //Auction.init(carID);
        },
        cancelAuction:function(){
            //user has decided to not sell car, removing it from userSales
            //user pays a penalty
            //alert('To cancel this auction the House will require a cancelation fee of ...');
            if(!this.expired){
//<php if(loggedIn() ){>
                //make ajax call to pasRemove
//<php
//}
//else{>
                console.log('cancel auction!');
                var len = userSales.length;
                
                if(len != 0){
                    var i = 0;
                    
                    for(; i < len; i++){
                        if(userSales[i]._car.id == this._car.id){
                            break;
                        }
                    }
                    //remove auction[i];
                }
//<php
//}
//?>
            }
            //else, can not cancel auction which the user has been paid
            
            //AucionSell.save();
        },
        payUser:function(obj){
            var val = obj.data.price; 
            console.log('won auction! user gets (' + val.toFixed(2) + ') funds!');
            
            if( (userStats.money + val) <= Number.MAX_VALUE){
//<php if(loggedIn() ){>
                //call pasUpdate!
//<php
//}
//else{>
                userStats.money += val;
                //save user!
//<php
//}>
            }
            //var divID = 'div#asd' + this._car.id.toString(),
                //div = $(divID),
                //cc = $(divID + ' button#cc');
            //cc.off();
            //div.css({"opacity":"0.45", "cursor":"default"});
            
            //AucionSell.save();
        }
	};
}
var AuctionSell =
{	//manages the state for selling cars
	//_state:null,    //array, contains Auctions
    //_cars:[],	//array of vehicles either sold or being sold by the user
	init:function(index)
	{
        //AuctionSell.load();
        //foreach active auction in userSales,
        //start them and begin updates
        jq.carImg.hide();
        
		if(index !== null && index !== undefined){
			//call to start an auction for car
			var i = index.data.i;
                //Garage.getCarByIndex(i);
            
            //jq.AuctionSell.carView.clear();

            var as = auctionGen();  //do not user new, function which returns a brand new object for you
			as.init(i);
            
			if(as._car !== null){
                as.addButton();
                
                as.toggleCC();
                
                userSales.push(as);
                
                AuctionSell.save();
            }
            jq.AuctionSell.toggle();
            return;
        }
        //entering the state without posting a new car
        jq.AuctionSell.menu.toggle();
	},
	update : function(dt){
		var i;
        
		if(userSales.length > 0){
			i = 0;
            
			while(i < userSales.length){
				if(!userSales[i]._expired){
					userSales[i].update(dt);
					++i;
				}
				else{
					userSales.splice(i, 1);
				}
			}
		}
	},
    load:function(data){
        if(data === null || data === undefined){
            //playing as guest, use local storage?>
            //for now, add code here
            var k = 'AuctionSell';
            
            if(Storage.local !== null && k in Storage.local){
                var sd = JSON.parse(Storage.local[k]),
                    len = sd.length;
                
                if(len != 0){
                    userSales = [];
                    
                    for(var i = 0; i < len; i++){
                        var data = sd[i],
                            na = auctionGen();
                    
                        //na.restart(data); 
                        na.toggleCC();
                        
                        userSales.push(na);
                    }
                }
            }
        }
        else{
            var len = data.length;
            
            if(len != 0){
                userSales = [];
                
                for(var i = 0; i < len; i++){
                    var ad = data[i],   //auction data
                        na = auctionGen();  //new auction
                
                    //na.restart(ad); 
                    na.toggleCC();
                    
                    //userSales.push(na);
                }
            }
        }
    },
    save:function(){
//<php if(loggedIn() ){?>
        //jq.post(
            //'pas/update.php?op=usls',
            //function(data){
                //if(data === null){
                    //error
                //}
                //alert('success!' + JSON.stringify(data));
                //continue with game!
            //},
            //function(jqxhr){
                //alert(''bad stuff happened!');
            //},
            //JSON.stringify(userSales)
        //);
//<php
//}
//else{
    //playing as guest, use local storage?>
        //for now, add code here
        var k = 'AuctionSell';
        
        if(Storage.local !== null && k in Storage.local){
//<php if(DEBUG){?>
            //var jstr = JSON.stringify(userSales);
            //console.log(jstr);
            //Storage.local['AuctionSell'] = jstr;
//<php
//}
//else{?>
            Storage.local[k] = JSON.stringify(userSales);
//}
//?>   
        }
    }
};
jq.AuctionSell.homeBtn.click(
function(){
    //AuctionSell.close();
    jq.AuctionSell.menu.toggle();
    jq.Game.menu.toggle();
    setHomeImg();
    jq.carImg.show();
    jq.setErr();    //clear error when changing pages
    //appState = GAME_MODE.MAIN;
});