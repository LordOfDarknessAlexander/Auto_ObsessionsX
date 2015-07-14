﻿//
//<php if(debug() ){>
jq.Auction.divPB = $('div#Auction div#pbCD');
jq.Auction.cdpbG = $('progress#gcd', jq.Auction.divPB);
jq.Auction.cdpb0 = $('progress#ai0', jq.Auction.divPB);
jq.Auction.cdpb1 = $('progress#ai1', jq.Auction.divPB);
jq.Auction.cdpb2 = $('progress#ai2', jq.Auction.divPB);
jq.Auction.cdpb3 = $('progress#ai3', jq.Auction.divPB);
jq.Auction.pbUser = $('progress#user', jq.Auction.divPB);
jq.Auction.going = $('progress#going', jq.Auction.divPB);
jq.Auction.winning = $('progress#winning', jq.Auction.divPB);

jq.Auction.buyoutBtn = $('button#buyout', jq.Auction.menu);
//<php
//}>
jq.Auction.bidBtn = $('button#bid', jq.Auction.menu);
//
var playerBoughtOut = false; //temporary for our dev button "buyout"

//ao.state.Auction =
var Auction = {
	//manages the state for purchasing cars
	//_enemies:[],
	/*
	//need to use namsespace to allow private vars we could implement and make all auction vars private
	_user : {	//object representing the current human player
		didWin:false,
		startEndBid:false,
		_bidTimer:0,
		_bid:0	//current bid
		//functions
		nextBid : function(){
			this.bid += (this.bid * 1.0);
			return this.bid;
		}
	},*/
	_car : null,	//null;	////current car being sold, private var of Auction
	ai : [],
	currentBid : 0,
	imgX : 10,
	winningImgY : 34,
	playerBid : 0,
	winningTimer : 0.0, //Timer that starts when the highest bid is made, once it elapses the going timer will begin
	WIN_TIMER_CAP : 1000,//100.0, //Max amount of time the winningTimer will run for before activating the going timer
	goingTimer: 0.0, //Timer forcountdown to final sale: going once, going twice, sold
	//enemyBidTimer: 0.0, //Slight delay after the player bids to prevent the AI from spam bidding
    playerBidTimer: 0.0, //Slight delay after the player bids to prevent the player from spam bidding
    bidTimerCap: 50, //Max time the bidTimer can go to
	enemyWinning : false,
	//enemyCanBid: true, //Boolean determining whether anyone can bid again or not
    //playerCanBid: true,
	playerWinning : false,
	playerWon : false, //Whether or not the player won the auction
	raisePerc : 0.08, //How much the AI and player will raise each bid by
	vcondition: 0,
	_ended: false,
	init:function(index){
        //call to start an auction for car		
        //console.log(index);
        //disable/enable sounds before ajax call
        console.log('Auction.init called');
	    if(audioEnabled() ){
	        console.log('audio enabled--Auction');
            var s = assetLoader.sounds;
            s.gameOver.pause();
            s.going.pause();
            s.sold.pause();
            s.bg.currentTime = 0;
            s.bg.loop = true;
            s.bg.play();
        }
        
        appState = GAME_MODE.AUCTION;
        auctionStop = false;
		Auction._ended = false;
		this.playerBid = 0;
		this.resetTimers();
		jq.Auction.goingLabel.text('');
		aoTimer.init();
        
        var funcName = 'Auction.js, Auction::init()';
        
        $.when(
            //jq.post(
                //'pas/query.php',
                //{carID:index}
            //);
            $.ajax({
                type:'POST',
                url:getHostPath() + 'pas/query.php',
                dataType:'json',
                data:{carID:index}
            }).done(function(data){
                //the response string is converted by jquery into a Javascript object!
                if(data === null){
                    alert(funcName + ', Error:ajax response returned null!');
                    return;
                }
                //alert('AuctionSelect::init(), ajax response success!' + JSON.stringify(data) );
                //do stuff                
                Auction._car = Vehicle(data.name, data.make, data.year, data.price, data.id, data.info);
				
                if(Auction._car !== null){
                    //console.log(Auction._car.getFullName());
                    var p = Auction._car.getPrice();
				   //vehiclePrice = Auction._car.getAdjustedConditionPrice();
					//vcondition = Auction._car.getRandCondition();
					vcondition = Auction._car.getRandCondition();
					//vcondition = Auction._car.getSelection();
					
					vehiclePrice = Auction._car.getPrice() * vcondition/100 ;
					//vcondition2 = Auction._car.getCondition();
					//vehiclePrice = Auction._car.getPrice() ;
					//35,200 
				//	vcondition2 = vcondition + vcondition2;
					//Auction._car.getCondition == vcondition2;
					
					Auction.ai = [
                        Enemy(price(p)),
                        Enemy(price(p)),
                        Enemy(price(p)),
                        Enemy(price(p))
                    ];
					//Auction.currentBid = vehiclePrice * 0.1;
                    Auction.currentBid = vehiclePrice * Auction.raisePerc;
                    //jq.Auction.carPrice.text('car value:\n' + Auction._car.getPrice().toFixed(2) );
            
                    context.font = '26px arial, sans-serif';  

                    jq.Auction.menu.show();		//$('#Auction').show();
                    jq.carImg.show();
                    setHomeImg(Auction._car.getFullPath() );
                    
                    Auction.setBidBtnText();
                    
                    //$('div#Auction img#auctionCar').attr('src', Auction._car.getFullPath() );
                   // $('div#Auction label#carName').html(Auction._car.getFullName() + '<br>' + 'value:' + Auction._car.getPriceStr() );
				   //display vehicle current value based on current random condition
				  // $('div#Auction label#carName').html(Auction._car.getFullName() + '<br>' + 'value:' + vehiclePrice.toFixed(0) + '<br>' + 'condition  ' + vcondition.toFixed(0) + 'condition2  ' + vcondition2 );
				    $('div#Auction label#carName').html(Auction._car.getFullName() + '<br>' + 'value:' + vehiclePrice.toFixed(0) + '<br>' + 'condition  ' + vcondition.toFixed(0));
                    $('div#Auction label#carInfo').text(Auction._car.getInfo() );
                    //$('#menu').removeClass('gameMenu');
                    //$('#menu').addClass('Auction');
                    $('.sound').show();
                }
            }).fail(function(jqxhr){
                //call will fthis.ail if result is not properly formated JSON!
                //alert
                jq.setErr(funcName, 'ajax call failed! Reason: ' + jqxhr.responseText);
                //console.log('loading game resources failed, abort!');
                //finished = true;
            })
        ).done(function(){
            //init visuals and display page after state has loaded
            Auction.initialSetup();
        }).fail(function(){
            //alert(
            jq.setErr(funcName, 'calling $.when failed! Reason: ' + jqxhr.responseText);
            //console.log('loading game resources failed, abort!');
        });
        
		//if(index < xdbCars.length){	//make sure index is within bounds to be safe
			//Auction._car = xdbCars[index];	//copy assigned
		//}
		
		//this.setup();
	},
	close : function(){
        //End the auction
	    //closing bidding and clearing local vars
	    //turn off the Auction Audio
	    if (audioEnabled()) {
	        var s = assetLoader.sounds;
	        s.bidder.pause();
	        s.going.pause();
	    }
		console.log('Auction close');
		auctionStop = true;
		//auctionEnded = false;
		endGame = false;
		
		this.playerBid = 0;		
		this.currentBid = 0;
		//this.currentBid = vehiclePrice * 0.1;
		this.resetTimers();
		//BidTImers Booleans
		//this.playerWinning = false;
		//this.enemyWinning = false;
		this.playerWon = false;
		playerBoughtOut = false;
		
		player.reset();
		stop = false;
		Auction._ended = true;
        
        jq.carImg.hide();
		cancelAnimFrame();
		requestAnimFrame(init);
	},
	resetTimers : function(){
		this.goingTimer = 0;
		this.winningTimer = 0;
		jq.Auction.goingLabel.text('');
	},
    getGoingPerc:function(){
        return 0.0;
    },
	getWinningPerc:function(){
        return (this.winningTimer < this.WIN_TIMER_CAP) ? (this.winningTimer / this.WIN_TIMER_CAP) : 1.0;
    },
    canPlayerBid:function(){
        return this.playerBidTimer >= this.bidTimerCap;
    },
    getPlayerTimerPerc:function(){
        return this.playerBidTimer / this.bidTimerCap;
    },
    getRaise:function(){
        //returns the current bid plus and additional increase, based on a percentage
        var b = this.currentBid,
            cv = Auction._car.getPrice();
        
        return b + (cv * this.raisePerc);
    },
	update : function(dt){
		//main update logic, called per frame
		//console.log("Sparta!");
		//console.log(dt);
        var btc = this.bidTimerCap,
			ai = this.ai;
        
        //static call, to update global enemy bid cooldown counter
		Enemy.update(dt);
        
		for(var i = 0; i < ai.length; ++i){
			var e = ai[i];
			
			if(!e.leftauction){
				e.update(dt);
			}
		}
		
		this.enemyBidding();
		//this.currentBidder();
		this.updatePlayer();
		
        //Increment timer if either ai or player is winning
        if(Auction.isPlayerHighestBidder() || Auction.isAIHighestBidder()){//this.playerWinning){
			if(this.winningTimer < this.WIN_TIMER_CAP){
				this.winningTimer += dt;
			}	
        }
		
		this.going(dt);
        // else if(){
			// this.winningTimer++;
            // // for(var i = 0; i < this.ai.length; ++i){
                // // if(this.ai[i].winningBid){
                    // // this.winningTimer++;
                    // // break;
                // // }
            // // }
        // }
        
		//if(auctionEnded){
			// this.close();		
		// }
		// if(endGame){
			// this.close();					
		// }

		if(!this.canPlayerBid()){
		    if(this.playerBidTimer < btc){
		        this.playerBidTimer++;
		    }
		    //else if(this.playerBidTimer >= btc){
		        //this.playerCanBid = true;
		    //}
		}
		
		if(!auctionStop){
		  	Auction.render();
		}
		else{
			//clear drawing when auction stops
			context.clearRect(0, 0, canvas.width, canvas.height);
		}
	  	//Auction.buyOut();
	},
	render : function(){
        //draw scene specific content to canvas
		var imgOffset = 20;
        //The block below can be cleaned up, thinking of how to do it
        var i = 0,
            h = 20,     //height(in pixels) of element
            cb = this.currentBid,
            t0 = 202,    //top, where the upper most element is rendered
            t1 = 190,
            t2 = 220,
            ewinPos = 174,  //enemy win position
            tx = ENEMY_X + 12,  //text x offset
            left = 10,  //left offset to draw the image from
            bid = this.ai[i].currBid,
            str = 'Player Bid : $' + this.playerBid.toFixed(2);
            
		context.drawImage(backgroundImage, 0, 0);
		context.font = '14px arial, sans-serif';
		player.draw();
		
		if(Auction.isPlayerHighestBidder()){//this.playerWinning){
			player.y = 177;
			context.fillText(str, ENEMY_X, 200);
		}
		else{
            player.y = 284;
            context.fillText(str, ENEMY_X, 300);
		}
        //draw enemies
        var i = 0;
        
        function draw(){
            var bid = Auction.ai[i].currBid;
                str = bidders[i] + Auction.ai[i].getBidStr();
            
            if(bid >= cb){
                context.drawImage(curBidImage, left, ewinPos);
                context.fillText(str, tx, t1);		
            }
            else{
                context.drawImage(slimer, left, t0 + (h * i) );
                context.fillText(str, tx, t2 + (h * i) );
            }
            //i++;
        }
        for(; i < Auction.ai.length; i++){
            draw();
        }
//<php
//if(DEBUG){>
        pbSetColor(jq.Auction.cdpbG, Enemy.getTimerPerc() );
        pbSetColor(jq.Auction.cdpb0, this.ai[0].getTimerPerc() );
        pbSetColor(jq.Auction.cdpb1, this.ai[1].getTimerPerc() );
        pbSetColor(jq.Auction.cdpb2, this.ai[2].getTimerPerc() );
        pbSetColor(jq.Auction.cdpb3, this.ai[3].getTimerPerc() );
        pbSetColor(jq.Auction.pbUser, this.getPlayerTimerPerc() );    //player.getTimerPerc() );
		pbSetColor(jq.Auction.winning, this.getWinningPerc() );
        pbSetColor(jq.Auction.going, this.getGoingPerc() );
//<php
//}
//>  
	},
	updatePlayer:function(){
        //
	    player.update();
		
        var PB = this.playerBid;
        
        if( (PB > this.ai[0].currBid) &&
            (PB > this.ai[1].currBid) &&
            (PB > this.ai[2].currBid) &&
            (PB > this.ai[3].currBid) ){
			//this.playerGoing();
			//this.playerWinning = true;
		}
	},
	// bidTimers:function(){
        // //updates this.ai bidding timers	
		// for(var i = 0; i < this.ai.length; ++i){
			// if(!this.ai[i].leftAuction){
				// this.ai[i].update();
			// }
		// }
	// },
	playerBidding:function(){
        //user bidding logic
	    if(!Auction.isPlayerHighestBidder() && this.canPlayerBid()){//this.playerWinning
            //
            var raise = this.getRaise();    //currentBid + this.raisePerc;
            
            if(userStats.money >= raise){
                //only let user bid if they have enough funds to back it up!
                //this.playerWinning = true;
                //this.enemyWinning = false;
                this.playerBidTimer = 0;
                this.resetTimers();
                //Setting the enemy's ability to bid to false so that as soon as the player bids the enemy is unable to
                //this.playerCanBid = false;
                this.playerBid = raise;
                this.currentBid = this.playerBid;
//<php if($DEBUG){>
                console.log('Player bidding ' + this.playerBid + ' currBid now ' + this.currentBid);
//<php}>
            }
            else{
                //else user can't bid, not enough funds
            }
		}
	},
	enemyBidding:function(){
        //iterates over enemies
	    //placing a bid if able to do so
	    if(!this.playerWon){
            //
            //TODO:sort by which enemy has the highest bid Timer,
            //then execute in that order. This approach ensures
            //the first enemy always has bidding preference!            
			for(var i = 0; i < this.ai.length; i++){
                //foreach ai
                //var e = this.ai[i];
                
                //can bid and still participating
                //console.log('ai active');
                if(this.ai[i].currBid < this.currentBid){
                    //is the ai's last bid the current highest?
                    var raise = this.getRaise();    //currentBid + this.raisePerc;
                    //if ai doesn't have enough, no bid
                    if(this.ai[i].bid(raise) ){
//<php if($DEBUG){>
                        console.log('ai ' + i + ' bidding ' + this.ai[i].getBidStr() + ' and cap is ' + this.ai[i].getBidCapStr() );
//<php}>
                        Enemy.resetTimer();
                        
                        this.currentBid = raise;
                        this.resetTimers();
                        //this.enemyWinning = true;
                        //this.playerWinning = false;
                        if (audioEnabled()) {
                            assetLoader.sounds.bidder.play();
                        }
                        Auction.setBidBtnText();
                        break;
                    }
                }
                //else the raise has become more than the ai
                //can afford, so disable
			}
		}
	},
	isAIHighestBidder:function(){
		var ai = Auction.ai;
		
		for(var i = 0; i < ai.length; i++){
			var e = ai[i],
			    delta = Math.abs(Auction.currentBid - e.currBid);
				
			if(delta < 0.000001){
				//console.log('Ai Bidder ' + i.toString() + ' ' + e.getBidStr());
				return true;
			}
			continue;
		}
		return false;
	},
	isPlayerHighestBidder:function(){
		var delta = Math.abs(Auction.currentBid - Auction.playerBid );
		
		if(delta < 0.000001){
			//console.log('Player highest bidder');
			return true;	
		}
		return false;
	},
	going:function(dt){
        //begin sale count down after a wthis.aiting period if no other bids are offered
		//Going crowd roars someone is about to win the bid
		//break out of while if someone outbids current bidder or if player does,
		//breaks out of the while loop and enemyWinning becomes false
		context.font = '20px arial, sans-serif';
		//console.log(dt);
        if(this.winningTimer >= this.WIN_TIMER_CAP){
            //
            var ae = audioEnabled(),
                s = assetLoader.sounds,
				gLabel = jq.Auction.goingLabel,
                t = this.goingTimer,
                f = 32,   //number of frames required to make purchase(32 frames == 1 second)
				//time in miliseconds
                first = 1250.0,	//320, //32 * 5,
                second = 2250.0;	//640; //32 * 7,
				//gLabel.text('Default');
				
			if( ( Auction.isPlayerHighestBidder() || Auction.isAIHighestBidder()) && (t <= second) && (!auctionStop) ){//this.playerWinning
				this.goingTimer += dt;
                t = this.goingTimer;    //reset t after increment!
				//console.log(t.toString());
                if( (t > 0) && (t < first)){
                    var x = ENEMY_X + 715;
					//console.log('Going once');

					gLabel.text('Going Once');
					assetLoader.sounds.going.play();
					
                    if (ae){
                        s.going.play();
                    }
					//break;	
				}
				else if( (t >= first) && (t < second) ){
					//console.log('Going twice');
					gLabel.text('Going Twice');
					//context.fillText('Going Twice', x, 290);
					assetLoader.sounds.going.play();
					
				    if (ae) {
				        s.going.play();
				    }
					//break;		
				}
				else if(t >= second){
                    //a single user has held the top bid the to reuired count,
                    //sell the car
					endGame = true;
					this.goingTimer = 0;
					
					if(Auction.isPlayerHighestBidder()){//this.playerWinning){
						this.playerWon = true;
						//this.buyOut();
						console.log('Player won');
						gLabel.text('Sold to User');
						//context.fillText('Sold to player!', x, 310);
					}
					else if(Auction.isAIHighestBidder()){//this.enemyWinning){
						//this.playerWinning = false;
						this.playerWon = false;
						
                        for(var i = 0; i < this.ai.length; ++i){
							if(this.ai[i].winningBid){
								console.log('AI won');
								gLabel.text('Sold to ai');
								//context.fillText('Sold to ' + this.ai[i], x, 310);
							}
						}	
					}
					//yesterdays issue!!!
					this.sold();
					//$('div#loss label').text(Auction._car.getFullName() );
					//break;
				}
			}
		}
	},	
	buyOut : function(){
//<php
//if($DEBUG){>
        //user 'buys out' the auction, placing the max bid,
		//bidding continues until only 1 bidder remains
		//
		//disable buyout button for remthis.ainder of auction
		//var btn = $('div#Auction button#buyout');
		//btn.click(function(){playerBoughtOut = true;});
		//btn.css('opacity', '0.65');
		
		//if(this.playerWon){
            //
            //if(userStats.money >= this.currentBid){
                //userStats.money = userStats.money - this.currentBid;
                //auctionEnded = true;
                //push vehicle to garage
	    //auctionStop = true;
	    if (audioEnabled()) {
	        var s = assetLoader.sounds;

	        s.bidder.pause();
	        s.sold.play();
	    }
        Auction.playerWon = true;
        Auction.sold();
            //}
            //else{
                //user does not have enough money!
            //}
		//}
		//}
//<php
//}
//>
	},
	setBidBtnText:function(){
        var r = this.getRaise();
		jq.Auction.bidBtn.text('Bid: $' + r.toFixed(2) );
	}
};
//
//Auction jQuery bindings
//
jq.Auction.buyoutBtn.click(
    Auction.buyOut
);

jq.Auction.bidBtn.click(
function(){
	Auction.playerBidding();
	playerDidBid = true;
	//$('#bid').text(
	Auction.setBidBtnText();
});
//$('button#buyout').click(Auction.buyOut);
jq.Auction.backBtn.click(
function(){
	Auction.close();
	//Auction.BackOutofAuction();
	jq.Auction.menu.hide();
	jq.AuctionSelect.menu.show();
    jq.carImg.hide();
    jq.setErr();    //clear error when changing pages	
});

jq.Auction.homeBtn.click(
function(){
	//Auction.cancel();	//stop the auction, aborting the sale
	Auction.close();
	//$('#Auction').hide();
	jq.Auction.menu.hide();
	jq.Game.menu.show();
    jq.carImg.show();
	//jq.Game.menu.children().toggle();	//hides/showns all child elements
	//ajax_post();
    pas.get.user.stats();
    //setStatBar();
	setAdBG();
    setHomeImg();
    jq.setErr();    //clear error when changing pages
	//var car = Garage.getCurrentCar();
	$('#Slots').hide();
	//if(car !== null){
		//jq.Game.homeImg.attr('src', car.getFullPath() );
	//}	
});
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