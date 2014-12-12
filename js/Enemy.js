function Enemy(bidCap)
{	//enemy class
	return {
		bidCap : bidCap,
		endBidTimer : 0,
		startEndBid : false,
		//	
		reset : function()
		{
			this.endBidTimer = 0;
			this.startEndBid = false;
		}
	};
}
function price(bias)
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
  	return vehiclePrice * lerp(Math.random(0.4, 1.25), bias, Math.random(0.0,1.0) );
}
//have a single array encapsulating all AI players,
//oppossed to seperate arrays for each property
//as names don't matter they can still be random

var enemies = [
	Enemy(price()),
	Enemy(price()),
	Enemy(price()),
	Enemy(price())
];	//

//result can also be weighted, prefering higher or lower bids