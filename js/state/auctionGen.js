//line 99 Car is null

//<php
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
        var car = userSales[i]._car,
            exists = (car !== null && car !== undefined);
        
        if(exists && car.id == carID){
            return true;
        }
    }
    return false;
}

function auctionGen(args){
    //
    //Javascript functionality to manage vehicle sales
    //
    //pass in a valid object (with proper fields),
    //or leave function call empty for default construction
    var isValid = (args === null || args === undefined) ? false : true;
    
    var car = isValid ? Garage.getCarByID(args.id) : null,
        bid = isValid ? args.bid : 0,
        s = isValid ? args._start : strFromCurrentDate(),
		//st = isValid ? args._startTime : +new Date(), //temp
        e = isValid ? args._end : null,
        ci = isValid ? args._cashedIn : false,
        ct = isValid ? args._time : 0.0;
    
	console.log('creating auction with vars: ' + JSON.stringify(args) );
    
	return {
		//_vehiclePrice : 20000,
		MAX_AUCTION_TIME : (1000 * 60) * 0.75, //450000
		//AI cooldown timer
		_timer : auctionCountdownTimer(),
		_car:car,
		//_carIndex : 0,
		_currentBid:bid,
		_ai:[],
		_date:{
			start:s,
			end:e
		},
		//_expired:false,
		_closed:false,
        _cashedIn:ci,    //has user received cash for this sale
		_curTime:ct,
        RAISE_PERC : 0.08,   //percentage of vehicle price the next bid is raised by
		BID_GCD: 500.0, //in miliseconds
		//Enemy.BID_TIMER_CAP = (1.0 / 32.0) * 8, //Max wait time between bids, wait 8 frames(at 32fps)
		_bidTimer: 0.0,
		_hasLeft: 0.0,
		_time: Date.now(),
		
		//
		init:function(index){
			this._timer.reset();
			
			if(index !== null && index !== undefined){
			    //               
			    var car = Garage.getCarByID(index);
                
			    if(car !== null){
			        if(!hasSoldCar(car.id)){
			            //this car has not been previously sold!
			            this._car = car;
			            //this._carIndex = index;
			            this._currentBid = this._car.getPrice() * this.RAISE_PERC;
			        }
			        
                    this._initAI();
                    AuctionSell.save();
                }
			}
			else{
				this._initAI();
			}
            //else entry sell screen without posting an auction
            //jq.AuctionSell.show();
		},
		initWithData: function (data) {//if vehicle is null
		    //no carID to access
		    //create new car
		    //this car has not been previously sold!
		    //console.log(data);
		    this._timer.reset();
			
            if(data !== null || typeof data !== 'undefined'){
		        if(this._car === null){
		            // var tData = data.car;
                    
		            this._car = Vehicle(data._car.name, data._car.make, data._car.year, data._car._price, data._car.id, ''/*, parts, repairs*/);
		            this._currentBid = data.bid;
                    //this._curTime = data._time;
                    
		            this._initAI(data);
		            AuctionSell.save();
		        }
		    }
		},
        _initAI:function(data){
			//pass enemy bids into this
			var p = this._car !== null ? this._car.getPrice() : 0.0;
			
			if(p > 0.000001){
			
				this._ai = [
					Enemy(price(p)),
					Enemy(price(p)),
					Enemy(price(p)),
					Enemy(price(p))
				];
				
				if(data !== null && typeof data !== 'undefined'){
					this._ai[0].currBid = data._bid0;
					this._ai[1].currBid = data._bid1;
					this._ai[2].currBid = data._bid2;
					this._ai[3].currBid = data._bid3;
				}
				
				for(var i = 0; i < this._ai.length; ++i){
					console.log(i + ' bid cap = ' + this._ai[i].bidCap);	
				}
			}
        },
		
		canBid:function(){
			//static function regulating global bid cooldown
			//console.log('enemy can bid');
			return this._bidTimer >= this.BID_GCD;
		},
		resetTimer: function(){
			this._bidTimer = 0.0;
		},
		updateTimers: function(dt){
			if(!this.canBid() ){
				this._bidTimer += dt;
				
				if(this._bidTimer > this.BID_GCD){
					this._bidTimer = this.BID_GCD;
				}
			}
			//console.log('can bid!');
			//_bidTimer is reset when an individual places a bid
		},
		getTimerPerc: function(){
			//from [0-BID_CD], return the current percent of completion in range [0.0-1.0]
			//to be displayed with a progress bar
			return this._bidTimer < this.BID_GCD ? this._bidTimer / this.BID_GCD : 1.0;
		},
        isExpired:function(){
            //auction expires when timer cap is reached
            return this._curTime >= this.MAX_AUCTION_TIME;
        },
        getRaise:function(){
            //returns the current bid plus and additional increase, based on a percentage
            if(this._car !== null){
                var b = this._currentBid,
                    cv = this._car.getPrice();
                
                return b + (cv * this.RAISE_PERC);
            }
            return 0.0;
        },
		getExpiredPerc: function(){
			return this.isExpired() ? 1.0 :  this._curTime / this.MAX_AUCTION_TIME;
		},
		getGoingPerc:function(){
			return 0.0;
		},
		going:function(dt){
			context.font = '20px arial, sans-serif';
			//console.log(dt);
			if(this._timer.isWinning()){
				//
				var ae = audioEnabled(),
					s = assetLoader.sounds,
					gLabel = jq.SaleView.goingLabel,
					t = this._timer.going,
					f = 32,   //number of frames required to make purchase(32 frames == 1 second)
					//time in miliseconds
					first = this._timer.GOING_FIRST,	//320, //32 * 5,
					second = this._timer.GOING_SECOND;	//640; //32 * 7,
				//gLabel.css({color: 'green'}).text('Default');
					
				if(t <= second){//this.playerWinning
					this._timer.going += dt;
					t = this._timer.going;    //reset t after increment!
					//console.log(t.toString());
					if( (t > 0) && (t < first)){
						//var x = ENEMY_X + 715;
						//console.log('Going once');

						//style.verticalAlign = "top"
						gLabel.css({color:'red'}).text('Going Once');
						
						if (ae){
							//s.going.play();
						}
						//break;	
					}
					else if((t >= first) && (t < second) ){
						//console.log('Going twice');
						gLabel.css({color:'green'}).text('Going Twice');
						//context.fillText('Going Twice', x, 290);
						
						if (ae) {
							//s.going.play();
						}
						//break;		
					}
					else if(t >= second){		
						for(var i = 0; i < this._ai.length; ++i){
							var ai = this._ai;
							
							if(ai[i].winningBid){
								console.log('AI won');
								gLabel.css({ color:'blue'}).text('Sold to ai');
								//ai.splice(0, ai.length);
								//context.fillText('Sold to ' + this.ai[i], x, 310);
							}
						}	
					}
				}
			}
		},	
        addButton:function(){
            //add this auction entry to the div
            if(this._car === null){
                //user has already sold this car,
                //or setup has failed for another reason
                console.log('could not set up html button for car');
            }
            else{
                var car = this._car;

                if (car !== null) {
                    var cidStr = (car.id).toString(),
                        btnID = 'as' + cidStr,
                        liID = 'asd' + cidStr;

                    var btnStr = "<div id='" + liID + "'>" +
                        "<img src='" + car.getFullPath() + "'>" +
                        "<label id='carInfo'>" + car.getFullName() + "</label>" +
						//"<progress id='endTime'></progress>" + 
                        "<progress id='time'></progress>" +
                        "<label id='" + btnID + "'>" +
                            "<label id='price'>Price: $" + (car.getPrice()).toString() + "</label><br>" +
                        "</label>" +
                        "<div id='btns'>" +
                            "<button id='view'></button>" +
                            "<button id='cc'></button>" +
                        "</div>" +
                        "</div>";

                    jq.AuctionSell.carView.append(btnStr);
                }

                if (this.isExpired() && this._cashedIn) {
                    this.disable();
                }
				
				var prog =  $('div#' + liID + ' progress#time',  jq.AuctionSell.carView);
				pbSetColor(prog, this.getExpiredPerc());
				
            }
        },
        disable:function(){
            //disable the div
            if(this._car === null){
                var car = this._car,
                    cidStr = (car.id).toString(),
                    //btnID = 'as' + cidStr,
                    liID = 'div#asd' + cidStr,
                    div = $(liID, jq.AuctionSell.carView);
                    ccBtn = $('div#btns button#cc', div),
                    viewBtn = $('div#btns button#view', div);

                div.css({'opacity':'0.45'});
                ccBtn.off().css({'cursor':'default'});
                viewBtn.off().css({'cursor':'default'});
//if(loggedIn() ){>
            //jq.post('pas/sales.php?op=rus',
                //function(){},
                //function(){},
                //{cid:car.id, price:}
            //);
//<php
//}
//else{>
            //AuctionSell.save();
//<php
//}
//>
            }
        },
		close:function(){
            //auction end
			//this._expired = true;
            this.toggleCC();
			this.bindViewBtn();
			this._date.end = Date.now() * 0.0001;
			this._closed = true;
			this._timer.reset();
			
			// var funcName = 'js/auctionGen.js close()';
				// jq.post(
					// "pas/update.php?op=psu", 
					// function(data){
						// if(data === null || data === undefined){
							// jq.setErr(funcName, 'Error:ajax response returned null!');
							// return;
						// }	
					// }, 
					// function(jqxhr){ 
						// jq.setErr(funcName, 'error happened: ' + jqxhr.responseText);
					// }, 
					// {_end:this._date.end}
				// );
			//this._curTime = 0.0;
            //while loops are bad practice, prone to misuse and infinite loops.
            //using array.pop() method is bad, is slow as the array must be
            //reallocated when the array is resized and can cause memory fragmentation issues!
            //use this._ai = [], or delete _ai to reset or delete the memory, respectfully
			//while(this._ai.length) { this._ai.pop(); }
            
//if(loggedIn() ){>
            //jq.post('pas/sales.php?op=sua',
                //function(){},
                //function(){},
                //{}
            //);
//<php
//}
//else{>
            AuctionSell.save();
//<php
//}>
		},
		update:function(dt){
            //
			if(!this.isExpired()){
				var ai = this._ai;
				//console.log('Running');
				//console.log(this._currentBid);
				this._curTime += dt;
				
				this.updateTimers(dt);
				//this.bidTimers();
				for(var i = 0; i < ai.length; ++i){
					if(!ai[i].leftAuction){
						ai[i].update(dt);
					}
				}
				this.enemyBidding();
				this._timer.updateWinning(dt);
				this.currentBidder();
				this.checkCurrentWinner();
				this.going(dt);
				this.render();
				
                var b = this.isExpired() && !this._closed;
                
                if(b){
                    //continue to update until time runs out
					for(var j = 0; j < ai.length; ++j){
						if(ai[j].winningBid){
							console.log('AI ' + j.toString() + ' has won the bid for the ' + this._car.getFullName() + ' for (' + Math.round(ai[j].getCurBid()) + '), Original Price (' + this._car.getPrice() + ')');
						}
					}
					console.log('Ending auction');
					this.endAuction();
					this.close();
					return;
				}	
			}	
		},
		updateServerSales:function(){
			
			//console.log('updateServerSales called ');
			//<php if(loggedIn() ){>
				var funcName = 'js/auctionGen.js update()';
				jq.post(
					"pas/update.php?op=psu", 
					function(data){
						if(data === null || data === undefined){
							jq.setErr(funcName, 'Error:ajax response returned null!');
							return;
						}	
					}, 
					function(jqxhr){ 
						jq.setErr(funcName, 'error happened: ' + jqxhr.responseText);
					}, 
					{carID:this._car.id, bid:this._currentBid, _time:this._curTime}
				);
			//<?php
		},
		endAuction:function(){
            //auction has ended updates garage and _sales
            if(this._car !== null){
                var i = this._car.id,
                    btnID = 'as' + (i).toString(),
                    liID = 'div#asd' + (this._car.id).toString(),
                    cleanBtn = $(liID + ' button#' + btnID),
                    moneyBtn = $(liID + ' div#btns button#cc');
                    
                cleanBtn.text('Sold!');
                //cleanBtn.off().click({i:this._carIndex, amt:this._currentBid}, this.cleanUpAuction);
                //this._currentBid = 0;
                //AuctionSell.save();
                Garage.save();
            }
		},
		cleanUpAuction:function(index){
            //
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
		load:function(){
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
           	
			var prevTime = data._time, //time auction was started in miliseconds
				currDate = Date.now(), //currentTime at restart execution
				timeElapsed = currDate - prevTime; //time that has passed since the auction was paused
							
			//if(timeElapsed <= this.MAX_AUCTION_TIME){
				//if the auction has not expired set the auction timer and continue ai bidding
				this._curTime = timeElapsed;
				
				var ai0 = this._ai[0],
					ai1 = this._ai[1],
					ai2 = this._ai[2],
					ai3 = this._ai[3]
				
				ai0.currBid = data._bid0;
				ai1.currBid = data._bid1;
				ai2.currBid = data._bid2;
				ai3.currBid = data._bid3;
				
				//console.log(ai0.leftAuction, ai1.leftAuction, ai2.leftAuction, ai3.leftAuction);
				
				ai0.bidCap = data._bidcap0;
				ai1.bidCap = data._bidcap1;
				ai2.bidCap = data._bidcap2;
				ai3.bidCap = data._bidcap3;
				
				// if(ai0.currBid >= ai0.bidCap){
					// ai0.leave();
				// }
				// if(ai1.currBid >= ai1.bidCap){
					// ai1.leave();
				// }
				// if(ai2.currBid >= ai2.bidCap){
					// ai2.leave();
				// }
				// if(ai3.currBid >= ai3.bidCap){
					// ai3.leave();
				// }
				AuctionSell.save();
				//SaleView.sortAI();
			//}
			
        },
		toJSON : function(){
            //called by JSON.stringify to conver this object into a json string,
			//this is called by JSON.stringify and will be serialized
			return {
                id:this._car !== null ? this._car.id : 0,
                bid:this._currentBid,   //current highest bid
                _time:this._time, //time remaining on auction, 0 if expired
				_start:this._date.start,
				_end:this._date.end,
                //date:this._date   //start and end dates,
                //expired:this.isExpired(),
                _cashedIn: this._cashedIn,
                _car: this._car,
				_bid0: this._ai[0].currBid,
				_bid1: this._ai[1].currBid,
				_bid2: this._ai[2].currBid,
				_bid3: this._ai[3].currBid,
				_bidcap0: this._ai[0].bidCap,
				_bidcap1: this._ai[1].bidCap,
				_bidcap2: this._ai[2].bidCap,
				_bidcap3: this._ai[3].bidCap
				
			};
		},
		enemyBidding : function(){
            //determine 
			//upPercentage of vehicle for next bid
			if(this.canBid()){
				var ai = this._ai,
				    raise = this.getRaise();
	//            var cb = this._currentBid;
					//upPerc =  0.06 * cb;
				
				for(var i = 0; i < ai.length; i++){
					var e = ai[i];
					
					if(!e.winningBid){ //global cooldown timer has refreshed, bidding now available
						var b = e.currBid;
						
						if(e.bid(raise)){
							b = e.currBid;
							console.log('auctionGen enemybidding ' + e.getBidStr());
							this._currentBid = raise;
							this._timer.reset();
							jq.SaleView.goingLabel.text('');
							this.resetTimer();
							var l = $('div#ai' + i.toString() + ' label#bid', jq.SaleView._ai.div);
							l.text(e.currBid.toFixed(2));
							AuctionSell.save();
							this.updateServerSales();
							//SaleView.sortAI();
							break;
						}
						if(b !== null && e.currBid === null){
							
							var aid = jq.SaleView._ai.div,
								div = $('div#ai' + i.toString(), aid ),
								l = $('label#bid', div),
								cls = div.attr('class');

							var c0 = 'first',
								c1 = 'second',
								c2 = 'third',
								c3 = 'fourth';
								
							l.text('');
							
							div.removeClass();
							if(cls == c0){
								var s = $('div.second', aid),
									t = $('div.third', aid),
									f = $('div.fourth', aid);
									
								if(s.length == 1){
									s.removeClass().addClass(c0);	//move second to first
								}
								else{
									
								}
								
								if(t.length == 1){
									t.removeClass().addClass(c1);	//move third to second
								}
								else{
									
								}
								
								if(f.length == 1){
									f.removeClass().addClass(c2);	//move fourth to third
								}
								else{
									
								}
								//where to check what other elements have left
							}
							else if(cls == c1){
								var	t = $('div.third', aid),
									f = $('div.fourth', aid);
									
								if(t.length == 1){
									t.removeClass().addClass(c1);	//move third to second
								}
								
								if(f.length == 1){
									f.removeClass().addClass(c2);	//move fourth to third
								}
							}
							else if(cls == c2){
								var	t = $('div.third', aid),
									f = $('div.fourth', aid);
									
								if(t.length == 1){
									t.removeClass().addClass(c3);	//move third to second
								}
								
								if(f.length == 1){
									f.removeClass().addClass(c2);	//move fourth to third
								}
							}
							else if(cls == c3){
								//fuck the shit
							}
							
							var lf = $('div.leftFirst', aid); //leftfirst
				
							if(lf.length == 1){
								var ls = $('div.leftSecond', aid); //leftSecond
								
								if(ls.length == 1){
									var lt = $('div.leftThird', aid); //leftThird
									
									if(lt.length == 1){
										var lfor = $('div.leftFourth', aid); //leftThird
										
										if(lfor.length == 1){
											div.addClass('leftFourth');
										}
									}
									else{
										div.addClass('leftThird');
									}
								}
								else{
									div.addClass('leftSecond');
								}
							}
							else{
								div.addClass('leftFirst');
							}
							
							// this._timer.reset();
							// this.resetTimer();
							// var jqAI = jq.SaleView._ai,
								// child = jqAI.div.children();
				
							// for(var e = 0; e < child.length; e++)
							// {
								// var c = child[e],
									// label = $('label#bid', c),
									// txt = label.text(),
									// bid = txt != '' ? parseFloat(txt) : null;
									
								// if(bid === null ){
									// continue;
								// }
								
								// var dif = Math.abs(b - bid);
								// if(dif <= 0.01){
									// label.text('');
									
									// var lf = $('div.leftFirst', jqAI.div); //leftfirst
									
									// if(lf.length){
										// var ls = $('div.leftSecond', jqAI.div); // leftsecond
										// if(ls.length){
											// var lt = $('div.leftThird', jqAI.div); // leftthird
											// if(lt.length){
												// //c.removeClass().addClass('leftFourth');
												// console.log('leftFourth');
												// break;
											// }
											// else{
												// console.log('leftThird');
												// //c.removeClass().addClass('leftThird');
												// break;
											// }	
										// }
										// else{
											// console.log('leftSecond');
											// //c.removeClass().addClass('leftSecond');
											// break;
										// }
									// }
									// else{
										// //c.removeClass().addClass('leftFirst');
										// console.log('leftFirst');
										// break;
									// }
									
								// }	
							// }
							
						}
						else if(b === null && e.currBid === null){
							continue;
						}
						//if AI can bid and is not currently the top bidder
						//if( (this._ai[i].currBid < cb) && (!this._ai[i].leftAuction) ){
							//this._ai[i].currBid = cb + upPerc;
							//this._ai[i].winningBid = true;
							//break;
						//}
						//else{
							//this._ai[i].winningBid = false;
						//}
					}
				}
			}
			//if the bidders bid is at o or less than the current bid player wins bid
		},	
		bidTimers : function(){
            //updates this._ai bidding timers	
			
		},
		bidFinder : function(){
			//determine bidder
			//check the bids of each this._ai to determine the highest bid,
			//then setting the state;
            //var raise = this.raise();
            
			for(var i = 0; i < this._ai.length; ++i){
				if(this.checkBid(i)){
					this.setBid(i);
                    //this._ai[i].bid(raise);
				}
			}
		},
		checkBid : function(index){
            //check if the enemy at the current index has a higher bid than the other this._ai's            
            var ai = this._ai;
            
			for(var i = 0; i < ai.length; i++){
				if(index != i){
                    //don't check against self
                    bid0 = ai[index].getCurBid(),
                    bid1 = ai[i].getCurBid();
					
                    if( (bid0 !== null) && (bid1 !== null) ){
                        if(bid1 > bid0){
                            return true;
                        }
                    }
                    continue;
				}
			}
			return false;
		},
		setBid : function(index){
            var ai = this._ai[index];   //temporary val is useful when not setting object values
			
            if(!ai.leftAuction){
				if(!ai.winningBid){
					//this._currentBid = ai.currBid;
					//console.log(this._currentBid);
				}			
				//iterate over this._ai, assigning the bidder at index as the current bidder,
				//assigning all others to false
				//for(var i = 0; i < this._ai.length; i++){
                    //must index into the array diretly if we want to set values!
					//this._ai[i].canBid = (i == index ? true : false);
				//}
			}
		},	
		currentBidder : function(){	
			this.bidFinder();
		},
		checkCurrentWinner : function(){
            //determine which ai has the highest bid
            var ai = this._ai;
            
			for(var i = 0; i < ai.length; ++i){
                var e = ai[i],
                    bid = e.getCurBid();
                
                if(bid !== null){
                    e.winningBid = (bid == this._currentBid ? true : false);
                }
			}
		},
        toggleCC:function(){
            //toggles the cancel/cash button
            var t = this;   //owning object, not this function
            
            if(t._car !== null){
                var divID = 'div#asd' + (t._car.id).toString(),
                    btnID = divID + ' div#btns button#cc',
                    btn = $(btnID);
                    
					if(t.isExpired() ){
						//set cash button, for user to recieve funds
						var data = {
							caller:t,
							cid:this._car.id,
							price:this._currentBid
						};
						btn.css({
						   'background':"url('images/icons/money.png') no-repeat 0 0",
						   'background-size':"100% 100%",
						});
						btn.off().click(data, this.payUser);
					}
					else{
                    //auction still active, allow user the chance to cancel
                    var data = {
                        caller:t,
                        cid:this._car.id,
                        price:this._currentBid
                    };
                    btn.css({
                        'background':"url('images/icons/cancel.png') no-repeat 0 0",
                        'background-size':"100% 100%",
                    });
                    btn.off().click(data, this.cancelAuction);
                }
			
            }
        },
		bindViewBtn:function(){
			//toggles the cancel/cash button
            var t = this;   //owning object, not this function
            
            if(t._car !== null){
                var divID = 'div#asd' + (t._car.id).toString(),
                    btnID = divID + ' div#btns button#view',
                    btn = $(btnID);
                    
				if(!t.isExpired() ){
					//set cash button, for user to recieve funds
					var data = {
						caller:t
						//cid:this._car.id,
						//price:this._currentBid
					};
					//btn.css({
					   //'background':"url('images/icons/money.png') no-repeat 0 0",
					   //'background-size':"100% 100%",
					//});
					btn.off().click(data, this.viewAuction);
				}
				else{
					jq.disableBtn(btn);
				}
            }
		},
        viewAuction:function(obj){
            //view an auction while it is still active!
            SaleView.init(obj.data.caller);	
        },
        cancelAuction:function(obj){
            //user has decided to not sell car, removing it from userSales
            //user pays a penalty
            //alert('To cancel this auction the House will require a cancelation fee of ...');
            var t = obj.data.caller,     //alias of this(auction object), since using this inside the current function refrences the jq object, button#cc
                id = obj.data.cid; //car id
                //p = obj.price;    //sale price of car
            if(!t.isExpired() ){
				//uncomment and call pas function cancelcarSales
//<php if(loggedIn() ){
                //make ajax call to pasRemove>
                var funcName = 'js/state auctionGen.js, auctionGen.cancelAuction(obj)';
                //jq.post('pas/remove.php?op=ucs',    //user cancel sale
				 jq.post('pas/update.php?op=cucs',    //user cancel sale
                    function(data){
                        //refresh AuctionSell div
                        if(data === null || data === undefined){
                            jq.setErr(funcName, 'Error:ajax response returned null!');
                            return;
                        }
						console.log(JSON.stringify(data));
						t.removeSale(t._car.id);
						SaleView.cleanUpAuction();
                    },
                    function(jqxhr){
                        jq.setErr(funcName, 'Ajax call failed, Reason: ' + jqxhr.responseText);
                    },
                    {carID:id}
                );
				Garage.load();         
//<php
//}
//else{>
                //this.renoveSale(t._car.id);
//<php
//}
//?>
            }
            //else
            //can not cancel auction for which the user has already been paid
                
        },
		removeSale:function(cid){
			var k = 'AuctionSell';
			if((Storage.local !== null) && (k in Storage.local)){
			//console.log(userSales);
			var us = userSales;//k in Storage.local ? JSON.parse(Storage.local[k]) : null;
			//console.log(us);
				if(us !== null){
				
					var len = us.length;
						
					if(len == 0){
						console.log('user sales has length of 0, can not remove sale');
						return;
					}
					
					var i = 0;
					
					for(; i < len; i++){
						var id = us[i]._car.id;
						
						if(id == cid){
							console.log('cancel auction!');
							
							var cidStr = (id).toString(),
								liID = 'div#asd' + cidStr,
								div = $(liID, jq.AuctionSell.carView);
							
							console.log("Cancel Hit");
							
							div.remove();   //from element from DOM
							//remove car from array
							//remove sales;
							us.splice(i, 1);  //returns items removed from array
							Storage.local[k] = JSON.stringify(us);
							console.log(us);
							AuctionSell.save();
						//place car back in user garage!
//<php if(loggedIn() ){>
						//userGarage.push(car(rm));
//<php					
	//}>
							break;
						}
					}
				}
			}
		},
        payUser:function(obj){
            var val = obj.data.price;
                t = obj.data.caller;
            
            console.log('won auction! user gets (' + val.toFixed(2) + ') funds!');
            
            if(t.isExpired() && t._closed && !t._cashedIn){
                if( (userStats.money + val) <= Number.MAX_VALUE){
//<php if(loggedIn() ){>
                //call pasUpdate!
                //jq.post('pas/sale.php',
                    //function(data){
                        //userStats.money = data;
                        //t.disable();  //user received funds, disable div
                        t._cashedIn = true;
                        //setStatBar();
                        //AuctionSell.save();
                    //},
                    //function(jqxhr){
                        
                    //},
                    //{price:val}
                //);
//<php
//}
//else{>
                userStats.money += val;
                setMoney();
                t.disable();  //user received funds, disable div
                //save user!
                //t.toggleCC();
                AuctionSell.save();
//<php
//}>
                }
            }
            else{
                jq.setErr('', 'Maximum funds reached');
            }
        },
		render:function(){
			//pbSetColor(jq.AuctionSell.carView.append(btnStr),  this.getExpiredPerc());
			var cidStr = (this._car.id).toString(),
				liID = 'asd' + cidStr,
				prog = $('div#' + liID + ' progress#time',  jq.AuctionSell.carView);
				pbSetColor(prog, this.getExpiredPerc());
		}
	};
}