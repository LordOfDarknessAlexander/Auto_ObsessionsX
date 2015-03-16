﻿var enemy1, enemy2, enemy3, enemy4;

var playerBoughtOut = false; //temporary for our dev button "buyout"

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
//ao.state.Auction =
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
	_car : null,	//null;	////current car being sold, private var of Auction
	ai : [],
	currentBid : 0,
	imgX : 10,
	winningImgY : 34,
	playerBid : 0,
	winningTimer : 0.0, //Timer that starts when the highest bid is made, once it elapses the going timer will begin
	winningTimerCap : 100.0, //Max amount of time the winningTimer will run for before activating the going timer
	goingTimer: 0.0, //Timer for going once, going twice, sold
	enemyBidTimer: 0.0, //Slight delay after the player bids to prevent the AI from spam bidding
    playerBidTimer: 0.0, //Slight delay after the player bids to prevent the player from spam bidding
    bidTimerCap: 50, //Max time the bidTimer can go to
	enemyWinning : false,
	enemyCanBid: true, //Boolean determining whether anyone can bid again or not
    playerCanBid: true,
	playerWinning : false,
	playerWon : false, //Whether or not the player won the auction
	raisePerc : 0, //How much the AI and player will raise each bid by
	
	init:function(index)
	{	//call to start an auction for car		
        console.log(index);
        //disable/enable sounds before ajax call
        assetLoader.sounds.gameOver.pause();
        assetLoader.sounds.going.pause();
        assetLoader.sounds.sold.pause();
        assetLoader.sounds.bg.currentTime = 0;
        assetLoader.sounds.bg.loop = true;
        assetLoader.sounds.bg.play();
        
        auctionStop = false;
		this.playerBid = 0;
        
        var funcName = 'Auction.js, Auction::init()';
        
        $.when(
            $.ajax({
                type:'POST',
                url:getHostPath() + 'pas/query.php',
                dataType:'json',
                data:{carID:index}
            }).done(function(data){
                //the response string is converted by jquery into a Javascript object!
                if(data === null){
                    alert(funcName + ', Error:ajax response returned null!');
                    //finished = true;
                    return;
                }
                //alert('AuctionSelect::init(), ajax response success!' + JSON.stringify(data) );
                //do stuff                
                Auction._car = Vehicle(data.name, data.make, data.year, data.price, data.id, data.info);
				
                if(Auction._car !== null)
                {
                    console.log(Auction._car.getFullName());
                    vehiclePrice = Auction._car.getPrice();
					
					Auction.ai = [Enemy(price(Auction._car.getPrice())), Enemy(price(Auction._car.getPrice())), Enemy(price(Auction._car.getPrice())), Enemy(price(Auction._car.getPrice()))];
					
                    Auction.currentBid = vehiclePrice * 0.1;
                    jq.Auction.carPrice.text('car value:\n' + Auction._car.getPrice().toFixed(2) );
            
                    context.font = '26px arial, sans-serif';  

                    jq.Auction.menu.show();		//$('#Auction').show();
                    jq.carImg.show();
                    setHomeImg(Auction._car.getFullPath() );
                    
                    Auction.setBidBtnText();
                    
                    //$('div#Auction img#auctionCar').attr('src', Auction._car.getFullPath() );
                    $('div#Auction label#carName').text(Auction._car.getFullName() );
                    $('div#Auction label#carInfo').text(Auction._car.getInfo() );
                    //$('#menu').removeClass('gameMenu');
                    //$('#menu').addClass('Auction');
                    $('.sound').show();
                }
            }).fail(function(jqxhr){
                //call will fthis.ail if result is not properly formated JSON!
                alert(funcName + ', ajax call failed! Reason: ' + jqxhr.responseText);
                console.log('loading game resources failed, abort!');
                //finished = true;
            })
        ).done(function(){
            //init visuals and display page after state has loaded
            Auction.setup();
        }).fail(function(){
            alert(funcName + ', calling $.when failed! Reason: ' + jqxhr.responseText);    
            console.log('loading game resources failed, abort!');
        });
		
        appState = GAME_MODE.AUCTION;
        
		//if(index < xdbCars.length){	//make sure index is within bounds to be safe
			//Auction._car = xdbCars[index];	//copy assigned
		//}
		
		//this.setup();
		
		//assetLoader.sounds.gameOver.pause();
		//assetLoader.sounds.going.pause();
		//assetLoader.sounds.sold.pause();
		//assetLoader.sounds.bg.currentTime = 0;
		//assetLoader.sounds.bg.loop = true;
		//assetLoader.sounds.bg.play();
	},
	close : function()
	{
		auctionStop = true;
		auctionEnded = false;
		endGame = false;
		//delete sold;
		//delete buyOut;	
		
		enemy1 = null;
		enemy2 = null;
		enemy3 = null;
		enemy4 = null;

		this.playerBid = 0;
		
		this.currentBid = 0;
		this.currentBid = vehiclePrice * 0.1;
		
		//BidTImers Booleans
		this.playerWinning = false;
		this.enemyWinning = false;
		this.playerWon = false;
		playerBoughtOut = false;
		this.goingTimer = 0;
		this.winningTimer = 0;
		player.reset();
		stop = false;
        
        jq.carImg.hide();
	},
	update : function()
	{	//main update logic, called per frame
		this.bidTimers();
		this.enemyBidding();
		//this.currentBidder();
		this.updatePlayer();
		this.going();
		
		this.raisePerc = this.currentBid * 0.18;

		for(var i = 0; i < this.ai.length; ++i){
			if(this.playerWinning || this.ai[i].winningBid){
				this.winningTimer++;
			}
		}
	
		if(auctionEnded){
			this.close();		
		}
		if(endGame){
			this.close();					
		}

		if(!this.playerCanBid){
		    if(this.playerBidTimer < this.bidTimerCap){
		        this.playerBidTimer++;
		    }
		    else if(this.playerBidTimer >= this.bidTimerCap){
		        this.playerCanBid = true;
		    }
		}

		if(!this.enemyCanBid){
		    if(this.enemyBidTimer < this.bidTimerCap){
		        this.enemyBidTimer++;
		    }
		    else if(this.enemyBidTimer >= this.bidTimerCap){
		        this.enemyCanBid = true;
		    }
		}
		
		if(!auctionStop){
		  	Auction.render();
		}
		else{
			//clear drawing when auction stops
			context.clearRect(0, 0, canvas.width, canvas.height);
		}
			
	  //	Auction.buyOut();
	},
	render : function()
	{
		var imgOffset = 20;
		context.drawImage(backgroundImage, 0,-10);
		context.font = '14px arial, sans-serif';
		player.draw();
		
		if(this.playerWinning){
			player.y = 177;
			context.fillText('Player Bid :  ' + '$' + this.currentBid.toFixed(2), ENEMY_X, 200);
		}
		else{
		  player.y = 284;
		  context.fillText('Player Bid :  ' + '$' + this.playerBid.toFixed(2), ENEMY_X, 300);
		}

        //The block below can be cleaned up, thinking of how to do it
		var ewinPos = 174,
            tx = ENEMY_X + 12,
            left = 10;  //left offset to draw the image from
            
        /*var highestBid = this.currentBid,
            bids = [],
            hi = 0; //highest index
        
        for(var i = 0; i < this.ai.length; i++){
            var bid = this.ai[i].currBid;
            if(bid > highestBid){
                highestBid = bid;
                hi = i;
            }
        }
        bids.push({bid:highestBid, index:hi});
        //set second highest bidder
        var sb = 0, //second highest bid
            si = 0; //second highest index
        
        for(var i = 0; i < this.ai.length; i++){
            if(i != hi){
                var bid = this.ai[i].currBid;
                if(bid < highestBid && bid > sb){
                    sb = bid;
                    si = i;
                }
            }
        }
        bids.push({bid:sb, index:si});
        //set third highest
        var tb = 0, //second highest bid
            ti = 0; //second highest index
        
        for(var i = 0; i < this.ai.length; i++){
            if(i != hi && i != si){
                var bid = this.ai[i].currBid;
                if(bid < sb && bid > tb){
                    tb = bid;
                    ti = i;
                }
            }
        }
        bids.push({bid:tb, index:ti});
        
        var lb = 0,
            li = 0;
            
        for(var i = 0; i < this.ai.length; i++){
            if(i != hi && i != si && i != ti){
                lb = this.ai[i].currBid;
                li = i;
                break;
            }
        }
        bids.push({bid:lb, index:li});

        var top = 190;
        for(var i = 0; i < bids.length; i++){
            var index = bids[i].index,
                e = this.ai[index];
                
            if(e.currBid >= highestBid){
                context.drawImage(curBidImage,left,ewinPos) + '/n' + context.fillText( bidders[index] + '$'+ e.currBid.toFixed(2), tx, top);
            }
            else{
                context.drawImage(slimer,left, 202 + (20 * i) ) + context.fillText(bidders[index] + '$' + e.currBid.toFixed(2), tx, top + 30 + (20 * i) );
            }
        }
        */
		//var aL1 = ;
		if(this.ai[0].currBid >= this.currentBid){
			enemy1 = context.drawImage(curBidImage,left,ewinPos) + '/n' + context.fillText( bidders[0] + '$'+ this.ai[0].currBid.toFixed(2), tx, 190);
		}
		else{
			enemy1 = context.drawImage(slimer,left,202) + context.fillText( bidders[0] + '$'+ this.ai[0].currBid.toFixed(2), tx, 220);
		}
		//Enemy 2
		if(this.ai[1].currBid >= this.currentBid){
			enemy2 = context.drawImage(curBidImage,left,ewinPos) + context.fillText( bidders[1] + '$'+ this.ai[1].currBid.toFixed(2), tx, 190);		
		}
		else{
			enemy2 = context.drawImage(slimer,left,222) + context.fillText(bidders[1] + '$'+ this.ai[1].currBid.toFixed(2), tx, 240);
		}
		//Enemy3
		if(this.ai[2].currBid >= this.currentBid){
			enemy3 = context.drawImage(curBidImage,left,ewinPos) + context.fillText( bidders[2] + '$'+ this.ai[2].currBid.toFixed(2), tx, 190);
		}
		else{
			enemy3 = context.drawImage(slimer,left,242) + context.fillText(bidders[2] + '$'+ this.ai[2].currBid.toFixed(2), tx, 260);
		}
		//Enemy4
		if(this.ai[3].currBid >= this.currentBid){
			enemy4 = context.drawImage(curBidImage,left,ewinPos) + context.fillText( bidders[3] + '$'+ this.ai[3].currBid.toFixed(2), tx, 190);
		}
		else{
			enemy4 =  context.drawImage(slimer,left,262) + context.fillText(bidders[3] + '$'+ this.ai[3].currBid.toFixed(2), tx, 280);
		}
		//call crowd for the player winning
		//this.playerGoing();
		
		this.going();
		//current bid HUD
		//var gorguts;
		//gorguts = context.drawImage(curBidImage,360,84)+ context.fillText('Current Bid :  ' + '$'+ this.currentBid.toFixed(2)  ,426, 114);
		
		//these could be HTML elements in the Auction div
		//context.fillText('Vehicle Price :  ' + '$'+ vehiclePrice.toFixed(2)  ,400, 90);
		//context.fillText('Money :  ' + '$'+ money.toFixed(2)  , canvas.width - 240, 66);
	},
	updatePlayer : function() 
	{
	    player.update();
		
        if((this.playerBid > this.ai[0].currBid) &&
            (this.playerBid > this.ai[1].currBid) &&
            (this.playerBid > this.ai[2].currBid) &&
            (this.playerBid > this.ai[3].currBid)){
			//this.playerGoing();
			this.playerWinning = true;
		}
	},
	bidTimers : function()
	{	//updates this.ai bidding timers	
		for(var i = 0; i < this.ai.length; ++i){
			if(!this.ai[i].leftAuction){
				this.ai[i].update();
			}
		}
	},
	playerBidding : function() 
	{
	    if(!this.playerWinning && this.playerCanBid)
		{
            if(userStats.money >= (this.currentBid + this.raisePerc))
			{
                this.playerWinning = true;
                this.enemyWinning = false;
                this.playerBidTimer = 0;
                this.goingTimer = 0;
                //Setting the enemy's ability to bid to false so that as soon as the player bids the enemy is unable to
                this.playerCanBid = false;
                this.playerBid = this.currentBid + this.raisePerc;
                this.currentBid = this.playerBid;
                console.log("Player bidding " + this.playerBid + " currBid now " + this.currentBid);
            }
            else{
                //else user can't bid
            }
		}
	},
	enemyBidding : function()
	{
	    if(!this.playerWon && this.enemyCanBid)
		{	
			for(var i = 0; i < this.ai.length; i++)
			{						
				if(this.ai[i].canBid && !this.ai[i].leftAuction)
				{
					if(this.ai[i].currBid < this.currentBid)
					{
					    this.ai[i].currBid = this.currentBid + this.raisePerc;
					    
                        if(this.ai[i].currBid == this.currentBid){
					        break;
					    }
					    this.ai[i].winningBid = true;
					    this.ai[i].canBid = false;
					    this.currentBid = this.ai[i].currBid;
					    
						console.log("ai " + i + " bidding " + this.ai[i].currBid + " and cap is " + this.ai[i].bidCap);
						this.winningTimer = 0;
						this.enemyCanBid = false;
						this.enemyBidTimer = 0;
						this.goingTimer = 0;
						this.enemyWinning = true;
						this.playerWinning = false;
						assetLoader.sounds.bidder.play();
						break;
					}
				}
			}
		 }
	},
	/*bidFinder : function()
	{	//determine bidder
		//check the bids of each this.ai to determine the highest bid,
		//then setting the state;
		for(var i = 0; i < this.ai.length; ++i)
		{
			if(this.checkBid(i))
			{
				this.setBid(i);
			}
		}
	},
	checkBid : function(index)
	{	//check if the enemy at the current index has a higher bid than the other ai's or player
		var ret = true;
		for(var i = 0; i < this.ai.length; i++)
		{
			if(index != i)
			{
				if(this.ai[index].currBid > this.ai[i].currBid)
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
		if(!this.ai[index].leftAuction)
		{
			if(!this.ai[index].winningBid)
			{
			    this.currentBid = this.ai[index].currBid;
			    console.log("Setting currentBid to AI " + index + "'s bid of " + this.ai[index].currBid);
			    this.playerWinning = false;
			    this.goingTimer = 0;
			}
		
			//iterate over this.ai, assigning the bidder at index as the current bidder,
			//assigning all others to false
			for(var i = 0; i < this.ai.length; i++)
			{
				this.ai[i].winningBid = (this.ai[i].currBid == this.currentBid ? true : false);
				this.ai[i].canBid = (i == index ? true : false);
			}
		}
	},	*/
	/*currentBidder : function()
	{	//determine if player has highest bid
		//Player has the current bid
		for(var i = 0; i < this.ai.length; ++i)
		{
			if(this.playerBid > this.ai[i].currBid)
			{
			    this.currentBid = this.playerBid;
				this.playerWinning = true;
				this.enemyWinning = false;
				this.ai[i].winningBid = false;
			}
			//else if(this.playerBid < this.ai[i].currBid)
			//{
				/*if(!this.ai[i].leftAuction)
				{
					this.bidFinder();
				}
			//}
		}
	},*/
	going : function()
	{	//begin sale count down after a wthis.aiting period if no other bids are offered
		//Going crowd roars someone is about to win the bid
		//break out of while if someone outbids current bidder or if player does,
		//breaks out of the while loop and enemyWinning becomes false
		context.font = '20px arial, sans-serif';
		
        if(this.winningTimer >= this.winningTimerCap)
		{
			while((this.playerWinning || this.enemyWinning) && (this.goingTimer < 660) && (!auctionStop))
			{
				this.goingTimer++;
				
                if((this.goingTimer > 0) && (this.goingTimer < 360))
				{
					this.goingTimer++
					//console.log("Going once");
					context.fillText( "Going Once" ,ENEMY_X + 715 , 270);
					assetLoader.sounds.going.play();
					break;
					
				}
				else if((this.goingTimer > 370) && (this.goingTimer < 650))
				{
					//console.log("Going twice");
					context.fillText( "Going Twice" ,ENEMY_X + 715 , 290);
					assetLoader.sounds.going.play();
					break;
		
				}
				else if(this.goingTimer >= 660)
				{
					endGame = true;
					this.goingTimer = 0;
					
					if(this.playerWinning)
					{
						this.playerWon = true;
						this.buyOut();
						console.log("Player won");
						context.fillText( "Sold to player!" ,ENEMY_X + 715 , 310);
					}
					else if(this.enemyWinning)
					{
						this.playerWinning = false;
						this.playerWon = false;
						
                        for(var i = 0; i < this.ai.length; ++i)
						{
							if(this.ai[i].winningBid)
							{
								console.log("AI won");
								context.fillText("Sold to " + this.ai[i], ENEMY_X + 715, 310);
								
							}
						}
					}
					this.sold();
					//$('div#loss label').text(Auction._car.getFullName() );
					break;
				}
			}
		}
	},	
	buyOut : function()
	{	//user 'buys out' the auction, placing the max bid,
		//bidding continues until only 1 bidder remains
		//
		//disable buyout button for remthis.ainder of auction
		var btn = $('div#Auction button#buyout');
		btn.click(function(){playerBoughtOut = true;});
		btn.css('opacity', '0.65');
		
		if(this.playerWon)
		{
            if(userStats.money >= this.currentBid){
                userStats.money = userStats.money - this.currentBid;
                auctionEnded = true;
                //push vehicle to garage
                //auctionStop = true;
                this.sold();
                assetLoader.sounds.bidder.pause();
                assetLoader.sounds.sold.play();
            }
            else{
                //user does not have enough money!
            }
		}
		else if(playerBoughtOut)
		{
            if(userStats.money >= vehiclePrice){
                console.log("Enemy winning " + this.enemyWinning);
                userStats.money = vehiclePrice;
                auctionEnded = true;
                this.playerWon = true;
                console.log("Player won " + this.playerWon);
                //push vehicle to garage
                //auctionStop = true;
                this.sold();
                assetLoader.sounds.bidder.pause();
                assetLoader.sounds.sold.play();
            }
            else{
                //not enought money, play fail sound
            }
		}
	},
	setBidBtnText : function(){
		$('#bid').text("Bid: $" + this.currentBid.toFixed(2) );
	}
};
//Auction jQuery bindings
$('#bid').click(function()
{
	Auction.playerBidding();
	playerDidBid = true;
	//$('#bid').text(
	Auction.setBidBtnText();
});
jq.Auction.backBtn.click(
function(){
	Auction.close();
	jq.Auction.menu.hide();
	jq.AuctionSelect.menu.show();
    jq.carImg.hide();	
});