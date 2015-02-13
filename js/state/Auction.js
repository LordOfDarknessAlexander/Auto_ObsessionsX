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

var playerDidBid = false;
var enemyCanBid = false;
var playerNextBid = currentBid + (currentBid * 0.1);

var enemy1, enemy2, enemy3, enemy4;

//BidTImers Booleans
var playerWon = false;
var playerBoughtOut = false;
//there only needs to be 1 timer to track the closing of the auction
var goingTimer = 0;
var pGTimer = 0;
var startPlayerEndBid = false;	//player local
var playerEndBidTimer = 0;	//player local

var ai = [];
var imgPosY = [100, 130, 160, 190];
var currentBid = vehiclePrice * 0.1;	//_car.getPrice() * 0.1, //bidding interval as a percent of total value
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
	imgX : 10,
	winningImgY : 34,
	_car : xdbCars[0],	//null;	////current car being sold, private var of Auction
	winningTimer : 0.0, //Timer that starts when the highest bid is made, once it elapses the going timer will begin
	winningTimerCap : 25.0, //Max amount of time the winningTimer will run for before activating the going timer
	enemyWinning : false,
	playerWinning : false,
	
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
		playerBid = 0;
        
        $.when(
            $.ajax({
                type:'POST',
                url:getHostPath() + 'pas/query.php',
                dataType:'json',
                data:{carID:index}
            }).done(function(data){
                //the response string is converted by jquery into a Javascript object!
                if(data === null){
                    alert('Auction::init(), Error:ajax response returned null!');
                    //finished = true;
                    return;
                }
                //alert('AuctionSelect::init(), ajax response success!' + JSON.stringify(data) );
                //do stuff                
                Auction._car = Vehicle(data.name, data.make, data.year, data.price, data.id, data.info);
                ai = [Enemy(price(Math.random(0.8, 1.5))), Enemy(price(Math.random(0.8, 1.5))), Enemy(price(Math.random(0.8, 1.5))), Enemy(price(Math.random(0.8, 1.5)))];

                if(Auction._car !== null)
                {
                    console.log(Auction._car.getFullName());
                    vehiclePrice = Auction._car.getPrice();
                    currentBid = vehiclePrice * 0.1;
                    jq.Auction.carPrice.text('car value:\n' + Auction._car.getPrice().toFixed(2) );
            
                    context.font = '26px arial, sans-serif';  

                    jq.Auction.menu.show();		//$('#Auction').show();
                    
                    Auction.setBidBtnText();
                    
                    $('div#Auction img#auctionCar').attr('src', Auction._car.getFullPath() );
                    $('div#Auction label#carInfo').text(/*'<h1>' + */Auction._car.getFullName() + '-\n    ' + Auction._car.getInfo() );
                    //$('#menu').removeClass('gameMenu');
                    //$('#menu').addClass('Auction');
                    $('.sound').show();
                }
            }).fail(function(jqxhr){
                //call will fail if result is not properly formated JSON!
                alert('Auction::init(), ajax call failed! Reason: ' + jqxhr.responseText);
                console.log('loading game resources failed, abort!');
                //finished = true;
            })
        ).done(function(){
            //init visuals and display page after state has loaded
            Auction.setup();
        }).fail(function(){
            alert('Auction::init(), calling $.when failed! Reason: ' + jqxhr.responseText);    
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

		//console.log("Restarting Auction snaps");
		bidderCooldown = 0;
		playerCanBid = false;
		playerBid = 0;
		
		//temp
		bidAmount = 200;
		currentBid = 0;
		currentBid = vehiclePrice * 0.1;
		
		playerDidBid = false;
		enemyCanBid = false;
		playerNextBid = currentBid + (currentBid * 0.1);
		
		//BidTImers Booleans
		this.playerWinning = false;
		this.enemyWinning = false;
		playerWon = false;
		playerBoughtOut = false;
		goingTimer = 0;
		winningTimer = 0;
		pGTimer = 0;
		startPlayerEndBid = false;	//player local
		playerEndBidTimer = 0;	
		player.reset();
		stop = false;
	},
	update : function()
	{	//main update logic, calle dper frame
		Auction.bidTimers();
		//Auction.assignEnemyBidCaps();
		Auction.enemyBidding();
		Auction.currentBidder();
		Auction.updatePlayer();
		Auction.going();
		//Auction.playerGoing();
		Auction.findEndBidder();
		Auction.sellCarEndAuction();
		
		if(playerDidBid)
		{
			bidderCooldown ++;
			enemyCanBid = false;
			this.enemyWinning = false;			
		}
	  	
	  	if(bidderCooldown >= ENEMY_WAIT)
	  	{	//enemy bid cooldown has refreshed
	  		enemyCanBid = true;
	  		bidderCooldown = 0;
	  	}	  	
	  	
		for(var i = 0; i < ai.length; ++i)
		{
			if(this.playerWinning || ai[i].winningBid)
			{
				goingTimer++;
			}
		}
	
		if(auctionEnded)
		{
			this.close();		
		}
		if(endGame)
		{
			this.close();					
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
		var imgOffset = 20;
		context.drawImage(backgroundImage, 0,-10);

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
		
		for(var i = 0; i < ai.length; ++i)
		{
			if(playerBid == ai[i].currentBid)
			{
				playerBid != currentBid;    //this does nothing!?
			}
		}
		
		if(ai[0].currBid >= currentBid)
		{
			enemy1 = context.drawImage(curBidImage,10,34) + context.fillText( bidders[0] + '$'+ ai[0].currBid.toFixed(2) ,ENEMY_X , 70);
		}
		else
		{
			enemy1 = context.drawImage(slimer,10,100) + context.fillText( bidders[0] + '$'+ ai[0].currBid.toFixed(2) ,ENEMY_X, 120);
		}
		//Enemy 2
		if(ai[1].currBid >= currentBid)
		{
			enemy2 = context.drawImage(curBidImage,10,34) + context.fillText( bidders[1] + '$'+ ai[1].currBid.toFixed(2) ,ENEMY_X , 70);		
		}
		else
		{
			enemy2 = context.drawImage(slimer,10,130) + context.fillText(bidders[1] + '$'+ ai[1].currBid.toFixed(2) ,ENEMY_X, 160);
		}
		//Enemy3
		if( ai[2].currBid >= currentBid )
		{
			enemy3 = context.drawImage(curBidImage,10,34) + context.fillText( bidders[2] + '$'+ ai[2].currBid.toFixed(2) ,ENEMY_X , 70);
		}
		else
		{
			enemy3 = context.drawImage(slimer,10,150) + context.fillText(bidders[2] + '$'+ ai[2].currBid.toFixed(2) ,ENEMY_X, 180);
		}
		//Enemy4
		if( ai[3].currBid >= currentBid)
		{
			enemy4 = context.drawImage(curBidImage,10,34) + context.fillText( bidders[3] + '$'+ ai[3].currBid.toFixed(2) ,ENEMY_X , 70);
		}
		else
		{
			enemy4 =  context.drawImage(slimer,10,170) + context.fillText(bidders[3] + '$'+ ai[3].currBid.toFixed(2) ,ENEMY_X, 200);
		}
		//call crowd for the player winning
		//this.playerGoing();
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
			(playerBid > ai[0]) &&
			(playerBid > ai[1]) &&
			(playerBid > ai[2]) &&
			(playerBid > ai[3]) && (playerEndBidTimer >= ENEMY_WAIT + 100) )
		{
			this.playerGoing();
			this.playerWinning = true;
			
			//console.log("player Going" + pGTimer);	
		}
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
		
		if(!playerWon)
		{	
			for(var i = 0; i < ai.length; i++)
			{						
				if(ai[i].canBid)	//global cooldown timer has refreshed, bidding now available
				{
					if((ai[i].currBid < currentBid) && (ai[i].currBid < ai[i].bidCap))
					{
						ai[i].currBid = currentBid + upPerc;
						winningTimer = 0;
						this.enemyWinning = true;
						assetLoader.sounds.bidder.play();
						break;	//breaks on first available bidder?
					}
				}
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
		{	//
			currentBid = ai[index].currBid;	
			ai[index].winningBid = true;
			goingTimer = 0;
			//iterate over AI, assigning the bidder at index as the current bidder,
			//assigning all others to false
			for(var i = 0; i < ai.length; i++)
			{
				ai[i].canBid = (i == index ? true : false);
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
	{	//determine if player has highest bid
		//Player has the current bid
		for(var i = 0; i < ai.length; ++i)
		{
			if(playerBid > ai[i].currBid)
			{
				currentBid = playerBid;
				startPlayerEndBid = true;
				goingTimer = 0;
			}
			else if(playerBid < ai[i].currBid)
			{
				if(!ai[i].leftAuction)
				{
					this.bidFinder();
				}
			}
		}
	},
	findEndBidder : function()
	{	//determine who holds the bid, incrementing timer
    
        //ai is not an array of ints! FIX this bug
		for (var i = 0, sum = 0; i < ai.length; sum += ai[i++]);
		
        for(var i = 0; i < ai.length; i++)
		{
			if((currentBid == ai[i].currBid) && (sum >= BID_THRESHOLD))				
			{	//enemeny is able to place bid
				//end auction with enemy bidder
				console.log("Sum "+ sum + "BidThreshold" + BID_THRESHOLD);
				this.enemyWinning = true;
			}
			else if(sum >= BID_THRESHOLD)
			{
				this.enemyWinning = true;
			}
		}
	},
	sellCarEndAuction : function()
	{
	//if sale countdown > AuctionThreshold
	//sell the call to the current Bidder
	},
	going : function()
	{	//begin sale count down after a waiting period if no other bids are offered
		//Going crowd roars someone is about to win the bid
		//break out of while if someone outbids current bidder or if player does,
		//breaks out of the while loop and enemyWinning becomes false
		while((this.playerWinning) || (this.enemyWinning) && (goingTimer < 660))
		{
			goingTimer++;
			
            if((goingTimer > 0) && (goingTimer < 360))
			{
				goingTimer ++
				context.fillText( "Going Once" ,ENEMY_X + 600 , 270);
				assetLoader.sounds.going.play();
				break;
				
			}
			else if((goingTimer > 370) && (goingTimer < 650))
			{
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
				goingTimer = 0;
				
                if(this.playerWinning)
				{
					console.log("Player won");
					context.fillText( "Sold to player!" ,ENEMY_X + 600 , 310);
				}
				else if(this.enemyWinning)
				{
					for(var i = 0; i < ai.length; ++i)
					{
						if(ai[i].winningBid)
						{
							console.log("AI won");
							context.fillText("Sold to " + ai[i], ENEMY_X + 600, 310);
						}
					}
				}
				this.sold();
				break;
			}
		}
	},	
	/*playerGoing : function()
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
	},*/
	buyOut : function()
	{	//user 'buys out' the auction, placing the max bid,
		//bidding continues until only 1 bidder remains
		//
		//disable buyout button for remainder of auction
		var btn = $('div#Auction button#buyout');
		btn.click(function(){playerBoughtOut = true;});
		btn.css('opacity', '0.65');
		
		if(playerWon)
		{
			userStats.money = userStats.money - currentBid;
			auctionEnded = true;
			//push vehicle to garage
			//auctionStop = true;
			this.sold();
			assetLoader.sounds.bidder.pause();
			assetLoader.sounds.sold.play();
		}
		else if(playerBoughtOut)
		{
			userStats.money = userStats.money - vehiclePrice;
			auctionEnded = true;
			playerWon = true;
			//push vehicle to garage
			//auctionStop = true;
			this.sold();
			assetLoader.sounds.bidder.pause();
			assetLoader.sounds.sold.play();
		}
	},
	setBidBtnText : function()
	{
		$('#bid').text("Bid: $" + currentBid.toFixed(2) );
	}	
};