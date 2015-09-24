<?php
if(!headers_sent() ){
    header('Content-type: application/javascript; charset: UTF-8');
}
//SaleView State Object
require_once '../../dbConnect.php';
require_once '../../vehicles/vehicle.php';
require_once '../../pasMeta.php';
//
$userID = getUID();
$tableName =  getUserTableName();
//
$fileName = 'js/state/slots.php';//__FILE__;
$funcName = '';
//
function ds(){?>div#Slots<?php
}
?>

jq.Slots = {
	menu : $('div#Slots'),
	backBtn : $('div#Slots button#backBtn'),
	homeBtn : $('div#Slots button#homeBtn')
	
	
};
var slot1Canvas = document.getElementById('slot1'),
        slot1Context = slot1Canvas.getContext('2d'),
		
		//slot1Context = $("slot1").get(0);
        slot2Canvas = document.getElementById('slot2'),
        slot2Context = slot2Canvas.getContext('2d'),
		//slot2Context = $("slot2").get(0);
        slot3Canvas = document.getElementById('slot3'),
		//slot3Context = $("slot3").get(0);
        slot3Context = slot3Canvas.getContext('2d');
		
var Slots = {
	_slots : null,

	init:function(index){
        //call to start an auction for car		
        //console.log(index);
        //disable/enable sounds before ajax call
        
        if(audioEnabled() ){
            console.log('audio enabled-Slots');
            var s = assetLoader.sounds;
            s.gameOver.pause();
            //s.going.pause();
            s.sold.pause();
            //s.bg.currentTime = 0;
            //s.bg.loop = true;
            //s.bg.play();
        }
		
		
		jq.Slots.menu.hide();
		jq.Slots.menu.show();
		
		
		
		

        var funcName = 'Slots.php, Auction::init()';
		appState = GAME_MODE.Slots;
		
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
				cb =  this._auction._currentBid,
				AI = this._auction._ai;
			
			var c0 = 'first',
				c1 = 'second',
				c2 = 'third',
				c3 = 'fourth';
				
			
			var tmpBid = 0.0,
				i = 0,
                l = 0;  //left counter
				
			function _sortLeftAI(jqo){
				//console.log('sortaileft');
				var jqAI = jq.SaleView._ai,
					label = $('label#bid', jqo),
					txt = label.text(),
					bid = txt != '' ? parseFloat(txt) : null,
					cls = jqo.attr('class');					
				// if(bid === null ){
					// return;
				// }
				//label.text('');
				
				var lf = $('div.leftFirst', jqAI.div); //leftfirst
				
				if(lf.length){
					var ls = $('div.leftSecond', jqAI.div); // leftsecond
					if(ls.length){
						var lt = $('div.leftThird', jqAI.div); // leftthird
						if(lt.length){
							//jqo.removeClass().addClass('leftFourth');
							//console.log('leftFourth');
							return;
						}
						else{
							
							if(cls == c0){
								var s = $('div.second', ai.div),
									t = $('div.third', ai.div),
									f = $('div.fourth', ai.div);
							
								s.removeClass().addClass(c0);	//move second to first
								t.removeClass().addClass(c1);	//move third to second
								f.removeClass().addClass(c2);	//move fourth to third
							}
							// else if(cls == c1){
								// var t = $('div.third', ai.div),
									// f = $('div.fourth', ai.div);	
							
								// t.removeClass().addClass(c1);	//move third to second
								// f.removeClass().addClass(c2);	//move fourth to third
							// }
							// else if(cls == c2){
								// var f = $('div.third', ai.div);
				
									// f.removeClass().addClass(c1);	//move thrid to second
							// }
							// else if(cls == c3){
								// var	f = $('div.fourth', ai.div);	
							
									// f.removeClass().addClass(c2);	//move fourth to third
							// }
							//console.log('leftThird');
							//jqo.removeClass().addClass('leftThird');
							return;
						}	
					}
					else{
						
						if(cls == c0){
							var s = $('div.second', ai.div),
								t = $('div.third', ai.div),
								f = $('div.fourth', ai.div);
							
							s.removeClass().addClass(c0);	//move second to first
							t.removeClass().addClass(c1);	//move third to second
							f.removeClass().addClass(c2);	//move fourth to third
						}
						else if(cls == c1){
							var t = $('div.third', ai.div),
								f = $('div.fourth', ai.div);	
								
							t.removeClass().addClass(c1);	//move third to second
							f.removeClass().addClass(c2);	//move fourth to third
							}
						// else if(cls == c2){
							// var t = $('div.third', ai.div);
							   
							// t.removeClass().addClass(c1);	//move thrid to second
						// }
						else if(cls == c3){
							var s = $('div.second', ai.div),
								t = $('div.third', ai.div),
								f = $('div.fourth', ai.div);
							
							s.removeClass().addClass(c0);	//move second to first
							t.removeClass().addClass(c1);	//move thrid to second
							f.removeClass().addClass(c2);	//move fourth to third
						}
						//console.log('leftSecond');
						//jqo.removeClass().addClass('leftSecond');
						return;
					}
				}
				else{
					if(cls == c0){
						var s = $('div.second', ai.div),
							t = $('div.third', ai.div),
							f = $('div.fourth', ai.div);
							
						s.removeClass().addClass(c0);	//move second to first
						t.removeClass().addClass(c1);	//move third to second
						f.removeClass().addClass(c2);	//move fourth to third
					}
					else if(cls == c1){
						var t = $('div.third', ai.div),
							f = $('div.fourth', ai.div);	
							
						t.removeClass().addClass(c1);	//move third to second
						f.removeClass().addClass(c2);	//move fourth to third
						
					}
					else if(cls == c2){
						var t = $('div.third', ai.div);
				
						t.removeClass().addClass(c1);	//move thrid to second
					}
					jqo.removeClass().addClass('leftFirst');
					//console.log('leftFirst');
					return;
				}
			}
			var pai = $('div.first', ai.div),		
				pid = pai.attr('id');
		
			for(var e = 0; e < child.length; e++)
			{
				var c = child.eq(e),
					label = $('label#bid', c),
					txt = label.text(),
					bid = (txt != '' ? parseFloat(txt) : null);
					
				
					
				if(bid !== null){
					if(bid >= cb){
						tmpBid = bid;
						i = e;
					}
					else{
						//current bid is not higher highest bid so no need to sort
						continue;
					}						
				}
				else{
					_sortLeftAI(c);
					continue;
				}
			}
			
			
			var cai = child.eq(i),
				cid = cai.attr('id');
					
			if(pid == cid){
				return;
			}
						
			var ccls = cai.attr('class');
			
			if(ccls == c1){
				// pai.removeClass().addClass(c1);	//move first to second
				// cai.removeClass().addClass(c0);	//move bidder to first
				if(bid !== null){
					var s = $('div.second', ai.div),
						t = $('div.third', ai.div),
						f = $('div.fourth', ai.div);
					
					s.removeClass().addClass(c1);
					t.removeClass().addClass(c2);	//move third to second
					f.removeClass().addClass(c3);	//move fourth to third
						
					//_sortLeftAI(cai);
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
					
					//_sortLeftAI(cai);
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
					
					//_sortLeftAI(cai);
				}
			}
			if(bid !== null){
				pai.removeClass().addClass(c1);	//move first to second
				cai.removeClass().addClass(c0);	//move bidder to first
			}
		}	
	},
	resetElements: function(){
		var ai = this._auction._ai,
		    jqAI = jq.SaleView._ai,
			child = jqAI.div.children();
			
		for(var i = 0; i < ai.length; i++){
			
			div = $('div#ai' + i.toString(), jqAI.div );
			div.removeClass();
		}
		
		for(var e = 0; e < child.length; e++)
		{	
			var c0 = child.eq(0),
				c1 = child.eq(1),
				c2 = child.eq(2),
				c3 = child.eq(3);
			
			c0.addClass('first');
			c1.addClass('second');
			c2.addClass('third');
			c3.addClass('fourth');
		}
		
		// jqAI.div.addClass('first');
		// jqAI.div.addClass('second');
		// jqAI.div.addClass('third');
		// jqAI.div.addClass('fourth');
	},
	cleanUpAuction: function(){
		if(SaleView._auction !== null){
			SaleView.resetElements();
			SaleView._auction = null;
		}
	},
	update : function(){
		if(SaleView._auction !== null && !this._auction.isExpired()){
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
			
		if(SaleView._auction !== null && !this._auction.isExpired()){
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
	//SaleView.resetElements();
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

