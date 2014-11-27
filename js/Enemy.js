function Enemy(bidCap)
{	//enemy class
	this.bidCap = bidCap;
	this.endBidTimer = 0;
	this.startEndBid = false;
	
	this.reset = function()
	{
		endBidTimer = 0;
		startEndBid = false;
	}
}
//have a single array encapsulating all AI players,
//oppossed to seperate arrays for each property
//as names don't matter they can still be random
var enemies = [
	new Enemy(price()),
	new Enemey(price()),
	new Enemy(price()),
	new Enemy(price())
];	//
//result can also be weighted, prefering higher or lower bids

function price(bias)
{
  return (lerp(Math.random(0.2, 1.25), bias, Math.random(0.0,1.0) ) * vehiclePrice);
}	
