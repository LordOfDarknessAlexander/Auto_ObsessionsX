function Enemy(bidCap)
{	//enemy class
	return {
		bidCap : bidCap, //The most the enemy will bid
		bidTimer : 0, //Timer for between bids
		bidCooldown : 5, //Time the AI has to wait to bid again
		BID_TIMER_CAP : 100, //Max wait time between bids
		currBid : 0, //The enemy's current bid
		canBid : false, //Flag to determine whether or not the enemy can bid
		leftAuction : false, //Flag to determine whether or not the enemy has left the auction
		winningBid : false, //Flag to determine whether or not the enemy is currently holding the winning bid
		
		reset : function()
		{
			this.bidTimer = 0;
			this.currBid = 0;
			this.bidCooldown = 5;
			this.canBid = false;
			this.leftAuction = false;
		},
		update : function()
		{
			if(this.currBid >= this.bidCap)
			{
				this.leftAuction = true;
			}
			
			//If the enemy can bid and is still active in the auction increment the bid timer
			if(!this.canBid && !this.leftAuction)
			{
				this.bidTimer++;
				//Once the bidTimer has reached the timer cap, allow the enemy to bid again and reset the bid timer
				if(this.bidTimer >= this.BID_TIMER_CAP)
				{
					this.canBid = true;
					this.bidTimer = 0;
				}
			}
		}
	};
}

function price(vehiclePrice)
{
	//console.log(vehiclePrice * (Math.random() * (1.5 - 0.8)) + 0.8)
	return vehiclePrice * Math.random() * (1.5 - 0.8 + 0.5) + 0.8;
}
/*function price(bias, vehiclePrice)
{
	var b = (typeof(bias) == 'undefined' ? 0 : bias);
	function lerp(Min, Max, t){
		if(Min > Max){
			var tmp = Min;
			Min = Max;
			Max = tmp;
		}
		return Min + (Max - Min) * t;
	};
  	return vehiclePrice * lerp(Math.random(0.8, 1.5), bias, Math.random(0.0,1.0));
}*/