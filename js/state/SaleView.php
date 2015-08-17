<?php //header('Content-type: application/javascript; charset: UTF-8');
//SaleView State Object
require_once '../../dbConnect.php';
require_once '../../vehicles/vehicle.php';
require_once '../../pasMeta.php';
//
$userID = getUID();
$tableName =  getUserTableName();
//
$fileName = 'js/state/SaleView.php';//__FILE__;
$funcName = '';
//
function dsv(){?>div#SaleView<?php
}
?>

jq.SaleView = {
	menu : $('div#SaleView'),
	backBtn : $('div#SaleView button#backBtn'),
	homeBtn : $('div#SaleView button#homeBtn'),
	carName : $('div#SaleView label#carName'),
	carInfo : $('div#SaleView label#svCarInfo'),
	goingLabel : $('div#SaleView label#going'),
	_ai : {
		div : $('div#SaleView div#_ai'),
		_0 : $('div#SaleView div#_ai div#ai0'),
		_1 : $('div#SaleView div#_ai div#ai1'),
		_2 : $('div#SaleView div#_ai div#ai2'),
		_3 : $('div#SaleView div#_ai div#ai3')	
	},
	timers : {
		div : $('div#SaleView div#pbCD'),
		cdpbG : $('div#SaleView div#pbCD progress#gcd'),
		cdpb0 : $('div#SaleView div#pbCD progress#ai0'),
		cdpb1 : $('div#SaleView div#pbCD progress#ai1'),
		cdpb2 : $('div#SaleView div#pbCD progress#ai2'),
		cdpb3 : $('div#SaleView div#pbCD progress#ai3'),
		going : $('div#SaleView div#pbCD progress#going'),
		winning : $('div#SaleView div#pbCD progress#winning'),
		endTime : $('div#SaleView div#pbCD progress#endTime')
	}
};
var SaleView = {
	_auction : null,

	init:function(index){
        //call to start an auction for car		
        //console.log(index);
        //disable/enable sounds before ajax call
        
        if(audioEnabled() ){
            console.log('audio enabled-Saleview');
            var s = assetLoader.sounds;
            s.gameOver.pause();
            //s.going.pause();
            s.sold.pause();
            //s.bg.currentTime = 0;
            //s.bg.loop = true;
            //s.bg.play();
        }
		this._auction = index;
		
		jq.AuctionSell.menu.hide();
		jq.SaleView.menu.show();
		setHomeImg(index._car.getFullPath() );
		jq.carImg.show();
		this.setCarInfo();
		var ai = this._auction._ai,
			divAI = jq.SaleView._ai,
			child = divAI.div.children();
		
		
		for(var i = 0; i < ai.length; i++)
		{
			var c = child[i],
				label = $('label#bid', c),
				bid = ai[i].getCurBid();
				
            label.text(bid !== null ? bid.toString() : '');
		}
		jq.SaleView.goingLabel.text('');
		this.sortAI();
		//this.resetAIbidDiv();
			
		//this.render();

        var funcName = 'SaleView.php, Auction::init()';
		appState = GAME_MODE.SALE_VIEW;
		
	},
	resetAIbidDiv : function(){
		var ai = jq.SaleView._ai,
			child = ai.div.children();
		
		for(var e = 0; e < child.length; e++)
		{
			var c = child[e],
				label = $('label#bid', c);
				
			label.text('0.00');
		}		
	},
	close : function(){
        jq.carImg.hide();
	},
	setCarInfo : function(){
		if(this._auction !== null){
			var info = this._auction._car !== null ? this._auction._car.getInfo() : '',
				name = this._auction._car !== null ? this._auction._car.getFullName() : '';
				
			jq.SaleView.carInfo.text(info);
			jq.SaleView.carName.text(name);
			jq.SaleView.carInfo.show();
		}
	},
	sortAI : function(){
		
		if(SaleView._auction !== null){	
			var ai = jq.SaleView._ai,
				child = ai.div.children(),
				ai0 = ai._0,
				ai3 = ai._3,
				cb =  this._auction._currentBid;
			
			var c0 = 'first',
				c1 = 'second',
				c2 = 'third',
				c3 = 'fourth';
				
			
			var tmpBid = 0.0,
				i = 0,
                l = 0;  //left counter
			
			for(var e = 0; e < child.length; e++)
			{
				var c = child[e],
				    label = $('label#bid', c),
                    txt = label.text(),
					bid = txt != '' ? parseFloat(txt) : null;
				
                if(bid !== null){
                    if(bid >= cb){
                        tmpBid = bid;
                        i = e;
                    }	
                }
                //else{
					//console.log('my crap');
                    //draw ai which have left in reverse order
					// var pai = $('div.leftFirst', ai.div),
					    // cai = child.eq(i),
						// ccls = cai.attr('class');
						
					// if(pai === null || typeof pai == 'undefined'){
						// cai.removeClass().addClass('leftFirst');
					// }
					// else{
						
						// // if(ccls == c1){
							// // var s = $('div.first', ai.div);
							// // s.removeClass().addClass(c0);	
						// // }
						// // else if(ccls == c2){
							// // var s = $('div.second', ai.div);
							// // s.removeClass().addClass(c1);	
						// // }
						// // else if(ccls == c3){
							// // var s = $('div.second', ai.div),
								// // t = $('div.third', ai.div);
						
							// // s.removeClass().addClass(c1);	
							// // t.removeClass().addClass(c2);
						// // }
						// // pai.removeClass().addClass(c0);	
						// // //cai.removeClass().addClass(c);
					// }					
					
                    // l++;
                    // continue;
                //}
			}		
			
			var pai = $('div.first', ai.div),
				cai = child.eq(i);
				
			var	pid = pai.attr('id');
			
			var	cid = cai.attr('id');
			
			if(pid == cid){
				return;
			}
			var ccls = cai.attr('class');
			
			if(ccls == c1){
				// pai.removeClass().addClass(c1);	//move first to second
				// cai.removeClass().addClass(c0);	//move bidder to first
				if(bid === null){
					var s = $('div.second', ai.div),
						t = $('div.third', ai.div),
						f = $('div.fourth', ai.div);
					
					s.removeClass().addClass(c1);
					t.removeClass().addClass(c2);	//move third to second
					f.removeClass().addClass(c3);	//move fourth to third
						
					cai.removeClass().addClass('leftFirst');
					$('label#bid', cai).text('');
				}
			}
			else if(ccls == c2){
				if(bid !== null){
					var s = $('div.second', ai.div);
					s.removeClass().addClass(c2);
				}
				else{
					var f = $('div.fourth', ai.div),
						t = $('div.third', ai.div);
						
					t.removeClass().addClass(c2);	//move third to second
					f.removeClass().addClass(c3);	//move fourth to third
					
					cai.removeClass().addClass('leftFirst');
					$('label#bid', cai).text('');
				}
			}
			else if(ccls == c3){
				if(bid !== null){
					var s = $('div.second', ai.div),
						t = $('div.third', ai.div);
						
					s.removeClass().addClass(c2);	//move second to third
					t.removeClass().addClass(c3);	//move third to fourth
				}
				else{
					var f = $('div.fourth', ai.div);
						
					f.removeClass().addClass(c3);	//move fourth to third
					
					cai.removeClass().addClass('leftFirst');
					$('label#bid', cai).text('');
				}
			}
			if(bid !== null){
				pai.removeClass().addClass(c1);	//move first to second
				cai.removeClass().addClass(c0);	//move bidder to first
			}
		}	
	},
	update : function(){
		if(!this._auction.isExpired()){
			this.sortAI(); 
			this.endAuction();
			this.render();
		}		
	},
	endAuction : function(){
		context.font = '20px arial, sans-serif';
		
		if(this._auction.isExpired()){
			jq.SaleView.goingLabel.text('Sold!');
		}
	},
	render : function(){
		//<php
//if(DEBUG){>
		var ai = this._auction._ai,
			timers = jq.SaleView.timers;
			
		if(!this._auction.isExpired()){
			pbSetColor(timers.cdpbG, this._auction.getTimerPerc() );
			pbSetColor(timers.cdpb0, ai[0].getTimerPerc() );
			pbSetColor(timers.cdpb1, ai[1].getTimerPerc() );
			pbSetColor(timers.cdpb2, ai[2].getTimerPerc() );
			pbSetColor(timers.cdpb3, ai[3].getTimerPerc() );
			pbSetColor(timers.winning, this._auction._timer.getWinningPerc() );
			pbSetColor(timers.going, this._auction.getGoingPerc() );
			pbSetColor(timers.endTime,  this._auction.getExpiredPerc());
		}
//<php
//}
//>  
	}
	
};
//
//Auction jQuery bindings
//

jq.SaleView.backBtn.click(
function(){
	//Auction.close();
	jq.SaleView.menu.hide();
	jq.AuctionSell.menu.show();
    jq.carImg.hide();
    jq.setErr();    //clear error when changing pages	
});

jq.SaleView.homeBtn.click(
function(){
	//Auction.close();
	jq.SaleView.menu.hide();
	jq.Game.menu.show();
	setHomeImg();
    jq.setErr();    //clear error when changing pages	
});

