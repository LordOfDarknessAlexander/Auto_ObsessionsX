function Enemy(bidCap){
	//enemy class
    //Math.floor rounds down to the nearest integer,
    //this ensures no ai starts ready to bid,
    //so that there is a gap
    var BCD = 32,
        BID_CAP = BCD * 8.0,
        r = Math.floor(Math.random() * (BID_CAP * 0.65) );
    
	return {
		bidCap : bidCap, //The most the enemy will bid
		_bidTimer : r, //r Timer for between bids
		bidCooldown : BCD * 3.5, //The number of frames the AI has to wait to bid again
		BID_TIMER_CAP : BID_CAP, //Max wait time between bids, in number of frames
		currBid : 0.0, //The enemy's current bid
		leftAuction : false, //Flag to determine whether or not the enemy has left the auction
		winningBid : false, //Flag to determine whether or not the enemy is currently holding the winning bid
		//
        //timer:{
            //_bid:0,
            //CAP:0,
            //getTimerPerc:function(){
            //}
        //},
        getTimerPerc:function(){
            //from [0-BID_CD], return the current percent of completion in range [0.0-1.0]
            //to be displayed with a progress bar
            var p = !this.leftAuction?
                (this._bidTimer < this.BID_TIMER_CAP?
                    this._bidTimer / this.BID_TIMER_CAP
                    : 1.0
                ) : 0.0;
            return p;
        },
        getBidStr:function(){
            return '$' + this.currBid.toFixed(2);
        },
        getBidCapStr:function(){
            return '$' + this.bidCap.toFixed(2);
        },
		reset : function(){
			this._bidTimer = 0;
			this.currBid = 0;
			//this.bidCooldown = 6;
			//this.canBid = false;
			this.leftAuction = false;
		},
        leave:function(){
            this.winningBid = false;
            this.leftAuction = true;
        },
        canBid:function(){
            //has the enemy's personal bid cooldown refreshed
            return Enemy.canBid() && (this._bidTimer >= this.BID_TIMER_CAP) && !this.leftAuction; //&& this._bidTimer >= Enemy.BID_CD
        },
        bid:function(raise){
            //place a bid, setting local state
            if(!this.leftAuction){
                if(raise <= this.bidCap){
                    if(this.canBid() ){
                        this.currBid = raise;
                        this.winningBid = true;
                        this._bidTimer = 0;
                        Enemy.resetTimer();
                        //assetLoader.sounds.bidder.play();
                        //console.log(JSON.stringify(this) + ', bidding: ' + raise.toFixed(2) );
                        return true;
                    }
                    this.winningBid = false;
                    return false;
                }
                //the raised bid is higher than this enemy's cap,
                //no more money, so leave auction
                this.leave();
            }            
            return false;
        },
		update : function(){
            //console.log('update!' + JSON.stringify(this) );
            //if(!this.leftAuction){
            if(!this.leftAuction){
                if(this.currBid >= this.bidCap){
                    this.leftAuction = true;
                    return;
                }			
                //If the enemy can bid and is still active in the auction increment the bid timer
                if(!this.canBid() ){
                    //console.log('update timmer!');
                    this._bidTimer++;
                    //Once the _bidTimer has reached the timer cap, allow the enemy to bid again and reset the bid timer
                    //if(this._bidTimer >= this.BID_TIMER_CAP){
                        //this.canBid = true;
                        //this._bidTimer = 0;
                        //this.bid();
                    //}
                }
            }
		}
	};
}
//static class constants
//individual cooldown,
//Time the AI has to wait to bid again
//modern browser refresh at roughly 32 fps
//32 fps at 16 frames is ~0.5 seconds
Enemy.BID_CD = 32;
//Enemy.BID_TIMER_CAP = (1.0 / 32.0) * 8, //Max wait time between bids, wait 8 frames(at 32fps)
Enemy._bidTimer = 0;

Enemy.canBid = function(){
    //static function regulating global bid cooldown
    //console.log('enemy can bid');
    return Enemy._bidTimer >= Enemy.BID_CD;
}
Enemy.resetTimer = function(){
    Enemy._bidTimer = 0;
}
Enemy.update = function(){
    if(!Enemy.canBid() ){
        Enemy._bidTimer++;
    }
    //console.log('can bid!');
    //_bidTimer is reset when an individual places a bid
}
Enemy.getTimerPerc = function(){
    //from [0-BID_CD], return the current percent of completion in range [0.0-1.0]
    //to be displayed with a progress bar
    return Enemy._bidTimer < Enemy.BID_CD ? Enemy._bidTimer / Enemy.BID_CD : 1.0;
}
function price(vehiclePrice, bias){
    //generates a random vehicle value between,
    //bias is an optional param, if not provided 1.0 is the default value,
    //providing no additional interpolation
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