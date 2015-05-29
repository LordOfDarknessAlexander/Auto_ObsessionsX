function Enemy(bidCap){
	//enemy class
    //Math.floor rounds down to the nearest integer,
    //this ensures no ai starts ready to bid,
    //so that there is a gap
    var r = Math.floor( (Math.random() * 16) );
    
	return {
		bidCap : bidCap, //The most the enemy will bid
		bidTimer : r, //r Timer for between bids
		bidCooldown : 32 * 1, //The number of frames the AI has to wait to bid again
		BID_TIMER_CAP : 100, //Max wait time between bids, in number of frames
		currBid : 0.0, //The enemy's current bid
		//canBid : false, //Flag to determine whether or not the enemy can bid
		leftAuction : false, //Flag to determine whether or not the enemy has left the auction
		winningBid : false, //Flag to determine whether or not the enemy is currently holding the winning bid
		
		reset : function(){
			this.bidTimer = 0;
			this.currBid = 0;
			//this.bidCooldown = 6;
			//this.canBid = false;
			this.leftAuction = false;
		},
        canBid:function(){
            //has the enemy's personal bid cooldown refreshed
            return this.bidTimer >= this.BID_TIMER_CAP; //&& this.bidTimer >= Enemy.BID_CD)
        },
        bid:function(raise){
            //place a bid, setting local state
            if(this.canBid() && raise <= this.bidCap){
                this.currBid = raise;
                this.winningBid = true;
                this.bidTimer = 0;
                //assetLoader.sounds.bidder.play();
                console.log(JSON.stringify(this) + ', bidding: ' + raise.toFixed(2) );
                return;
            }
            this.winningBid = false;
        },
		update : function(){
            //console.log('update!' + JSON.stringify(this) );
            //if(!this.leftAuction){
			if(this.currBid >= this.bidCap){
				this.leftAuction = true;
			}			
			//If the enemy can bid and is still active in the auction increment the bid timer
			if(!this.canBid() && !this.leftAuction){
                //console.log('update timmer!');
				this.bidTimer++;
				//Once the bidTimer has reached the timer cap, allow the enemy to bid again and reset the bid timer
				if(this.bidTimer >= this.BID_TIMER_CAP){
					//this.canBid = true;
					//this.bidTimer = 0;
                    //this.bid();
				}
			}
		}
	};
}
//static class constants
//Enemy.BID_CD = 5.0; //individual cooldown, Time the AI has to wait to bid again
//Enemy.BID_TIMER_CAP = (1.0 / 32.0) * 8, //Max wait time between bids, wait 8 frames(at 32fps)
//Enemy.canBid = function(){
    //static function regulating global bid cooldown
    //return Enemy.timmer >= Enemy.BID_CD;
//}
function price(vehiclePrice, bias){
    //
	var b = (typeof(bias) === 'undefined' || bias === null) ? 1.0 : bias;
	
    function lerp(Min, Max, t){
		if(Min > Max){
			var tmp = Min;
			Min = Max;
			Max = tmp;
		}
        //var ret = Min + (Max - Min) * t;
        //console.log(ret);
		return Min + (Max - Min) * t;
	};
    var l = lerp(Math.random(0.85, 1.85), b, Math.random(0.0,1.0));
    //console.log('lerp:' + l.toString() );
  	return vehiclePrice * l;
}