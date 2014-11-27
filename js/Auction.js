//Auction State



function bidTimers()
{	//updates AI bidding timers

	for(var i = 0; i < startEndBids.length; i++)
	{
		if(startEndBids[i] = true)
		{			
			endBidTimers[i]++;
		}
		else
		{
			endBidTimers[i] = 0;
		}
	}
	
	//Player end bid
	if(startPlayerEndBid)
	{
		playerEndBidTimer ++;
	}
	else
	{
		playerEndBidTimer = 0;
	}	
	
}

//Game HUD
function renderAuction()
{
	var player1;
  	var player2;
  	var player3;
  	var player4;
  	
	if(( playerBid == currentBid)&& (playerDidBid))
  	{
  		player.y = 10;
  		context.fillText('Player Bid :  '   +'$'+ playerBid.toFixed(2)  ,ENEMY_X, 90);
  	}
  	else
  	{
  	  player.y = 150;
  	  context.fillText('Player Bid :  '   +'$'+ playerBid.toFixed(2)  ,ENEMY_X, 230);
  	}
  	
  	if((playerBid == enemyBids[0]) || (playerBid == enemyBids[1]) || (playerBid == enemyBids[2]) || (playerBid == enemyBids[3]))
  	{
		playerBid != currentBid;
		
	}
	
	//ENENMY HUD
	
  	//Enemy 1
	//draw them depending on current bid
  	if((enemyBids[0] >= currentBid))
  	{
  		player1 = context.drawImage(curBidImage,10,34) + context.fillText( bidders[0] + '$'+ enemyBids[0].toFixed(2) ,ENEMY_X , 70);
  		  		
  	}
  	else
  	{
  		player1 = context.drawImage(slimer,10,100) + context.fillText( bidders[0] + '$'+ enemyBids[0].toFixed(2) ,ENEMY_X, 120);
  	  	
  	}
    //Enemy 2
  	if(enemyBids[1] >= currentBid)
  	{
  		player2 = context.drawImage(curBidImage,10,34) + context.fillText( bidders[1] + '$'+ enemyBids[1].toFixed(2) ,ENEMY_X , 70);
  		
  	}
  	else
  	{
  		player2 = context.drawImage(slimer,10,130) + context.fillText(bidders[1] + '$'+ enemyBids[1].toFixed(2) ,ENEMY_X, 160);
  		
  	}
  	//Enemy3
  	if( enemyBids[2] >= currentBid )
  	{
  	    player3 = context.drawImage(curBidImage,10,34) + context.fillText( bidders[2] + '$'+ enemyBids[2].toFixed(2) ,ENEMY_X , 70);
  	 	
  	}
  	else
  	{
  		 player3 = context.drawImage(slimer,10,150) + context.fillText(bidders[2] + '$'+ enemyBids[2].toFixed(2) ,ENEMY_X, 180);
  		 
  	}
  	//Enemy4
  	if( enemyBids[3] >= currentBid)
  	{
  	    player4 = context.drawImage(curBidImage,10,34) + context.fillText( bidders[3] + '$'+ enemyBids[3].toFixed(2) ,ENEMY_X , 70);
  	 	
  	}
	else
	{
		player4 =  context.drawImage(slimer,10,170) + context.fillText(bidders[3] + '$'+ enemyBids[3].toFixed(2) ,ENEMY_X, 200);
		
	}
	
    //current bid HUD
    var gorguts;
    gorguts = context.drawImage(curBidImage,360,84)+ context.fillText('Current Bid :  ' + '$'+ currentBid.toFixed(2)  ,426, 114);
    
	    //current bid
    context.fillText('Vehicle Price :  ' + '$'+ vehiclePrice.toFixed(2)  ,400, 90);
    
    context.fillText('Game Timer :  ' + timer.toFixed(2)  ,200, 400);
      // draw the money HUD
    context.fillText('Money :  ' + '$'+ money.toFixed(2)  , canvas.width - 240, 66);
    //player bid
    
    context.fillText('End Bid Time :  ' + bidders[0] + endBidTimers[0]  ,200, 460);
    context.fillText('End Bid Time2 :  ' + bidders[1] + endBidTimers[1]  ,200, 480);
    context.fillText('End Bid Time3 :  ' + bidders[2] + endBidTimers[2]  ,200, 500);
    context.fillText('End Bid Time4 :  ' + bidders[3] + endBidTimers[3]  ,200, 520);
    context.fillText('End Bid Time Player :  ' + playerEndBidTimer  ,200, 540);
    
    
}


//Player Bidding Function
function playerBidding() 
{ 
	//player Cooldown button
	if(	bidderCooldown >= PLAYER_WAIT)
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
	
	if(playerBid <= money)
	{
		playerDidBid = true;
	
	}
	else
	{
		//cant bid above your cash 
		//call a new function to alert player hes &$#k up
		 gameOver();
		 
		 startPlayerEndBid = false;
	}
	//Wins BId	
	if((enemyBids[0] == 0) && (enemyBids[1] == 0) && (enemyBids[2] == 0) && (enemyBids[3] == 0) && (money >= currentBid))
	{
	  money = money - currentBid;
	}
	
	if(money <= 0)
	{
		money = 0;	//player has no money but doesn't win auction?
		gameOver();	
	}
}
//Player Bidding Function
function currentBidder()
{
	//Player has the current bid
	if((playerBid > enemyBids[0])&&(playerBid > enemyBids[1])&&(playerBid > enemyBids[2])&&(playerBid > enemyBids[3]))
	{
	   currentBid = playerBid;
	   
	}
	//Find the player who has the highest bid dirty way enemy bidder 1 if it is not players bid then call func to find thru enemies
	else if((playerBid < enemyBids[0])||(playerBid < enemyBids[1])||(playerBid < enemyBids[2])||(playerBid < enemyBids[3]))
	{
	  bidFinder();
	}
}

function bidFinder()
{	//determine bidder
	function checkBid(index)
	{
		//check if the enemy at the current index has a higher bid than the other AI's
		var ret = true;
		for(var i = 0; i < enemyBids.length; i++)
		{
			if(index != i){
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
	{
		currentBid = enemyBids[index];
		
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
	else if(checkBid(3) )
	{
		setBid(3);
	}
}

function enemyBidding() 
{
	//upPercentage of vehicle for next bid
	var upPerc =  0.18 * currentBid;
	var startBid = vehiclePrice * 0.02;
	//var upPerc = startBid ;
	if( currentBid >= 0 )
	{	
		for(var i = 0; i < enemyBids.length; i++)
		{
			if(enemyCanBid)
			{
				if((enemyBids[i] < currentBid) && (enemyBids[i] < enemyCap) )
				{
				  enemyBids[i] = currentBid + upPerc;
				 
				  break;
				}
			}
		}
	 }
	
	//if the bidders bid is at o or less than the current bid player wings bid
	/*
     if((playerBid >enemyBids[0]) && (playerBid >enemyBids[1]) && (playerBid >enemyBids[2]) &&(playerBid >enemyBids[3]))
	{
		sold();
		money = money - currentBid;
	}*/
	
}

function findEndBidder()
{
	for(var i = 0; i < bidders.length; i++)
	{
		if((currentBid == enemyBids[i]) && (endBidTimers[i] >= BID_THRESHOLD))
		{
			gameOver();
			alert("Sold to " + bidders[i]);			
		}
	}
}

