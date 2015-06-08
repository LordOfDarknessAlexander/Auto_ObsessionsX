﻿//<php
//function loggedIn(){
    //return true;
//}
//?>
var AuctionSell = {
	//manages the state for selling cars
	//_state:null,    //array, contains Auctions
    //_cars:[],	//array of vehicles either sold or being sold by the user
	init:function(index){
        //AuctionSell.load();
        //foreach active auction in userSales,
        //start them and begin updates
        jq.carImg.hide();
        
		if(index !== null && index !== undefined){
			//call to start an auction for car
			var i = index.data.i;
                //Garage.getCarByIndex(i);
            
            //jq.AuctionSell.carView.clear();

            var as = auctionGen();  //do not user new, function which returns a brand new object for you
			as.init(i);
            
			if(as._car !== null){
                as.addButton();
                as.toggleCC();
                
                userSales.push(as);
				var TOM = 0;
                //console.log(JSON.stringify(userSales) );
                AuctionSell.save();
            }
            jq.AuctionSell.toggle();
            return;
        }
        //entering the state without posting a new car
        jq.AuctionSell.menu.toggle();
	},
	update : function(dt){
		var i = 0,
            len = userSales.length;
        
		if(len > 0){            
			for(; i < len; i++){
				//if(!userSales[i]._expired){
                userSales[i].update(dt);
                var b = userSales[i].isExpired() && !userSales[i]._closed;
                if(b){  //this._curTime >= this.MAX_AUCTION_TIME){
                    //continue to update until time runs out
					for(var j = 0; j < userSales[i]._ai.length; ++j){
						if(userSales[i]._ai[j].winningBid){
							console.log('AI ' + j.toString() + ' at auction ' + i.toString() + ' has won the bid for the ' + this._car.getFullName() + ' for (' + Math.round(this._ai[j].currBid) + '), Original Price (' + this._car.getPrice() + ')');
						}
					}
					console.log('Ending auction');
					userSales[i].endAuction();
					userSales[i].close();
				}
				//}
				//else{
					//userSales.splice(i, 1);
				//}
			}
		}
	},
    load:function(data){
        if(data === null || data === undefined){
            //playing as guest, use local storage?>
            //for now, add code here
            var k = 'AuctionSell';
            
            if(Storage.local !== null && k in Storage.local){
                var sd = JSON.parse(Storage.local[k]),
                    len = sd.length;
                
                if(len != 0){
                    userSales = [];
                    
                    for(var i = 0; i < len; i++){
                        var ad = sd[i], //auction data
                            na = auctionGen(ad);    //new auction
                    
							na.addButton();
//                        na.restart(); 
							na.toggleCC();
                        
						userSales.push(na);//push new auction
						var TIM = 0;
                    }
                }
            }
        }
        else{
            var len = data.length;
            
            if(len != 0){
                userSales = [];
                
                for(var i = 0; i < len; i++){
                    var ad = data[i],   //auction data
                        na = auctionGen(ad);  //new auction
                
                    //na.restart(); 
                    na.toggleCC();
                    
                    //userSales.push(na);
                }
            }
        }
    },
    save:function(){
//<php if(loggedIn() ){?>
        //jq.post(
            //'pas/update.php?op=usls',
            //function(data){
                //if(data === null){
                    //error
                //}
                //alert('success!' + JSON.stringify(data));
                //continue with game!
            //},
            //function(jqxhr){
                //alert(''bad stuff happened!');
            //},
            //JSON.stringify(userSales)
        //);
//<php
//}
//else{
    //playing as guest, use local storage?>
        //for now, add code here
        var k = 'AuctionSell';
        
        if(Storage.local !== null){
//<php if(DEBUG){?>
            //var jstr = JSON.stringify(userSales);
            //console.log(jstr);
            //Storage.local[k] = jstr;
//<php
//}
//else{?>
            Storage.local[k] = JSON.stringify(userSales);
//}
//?>   
        }
    }
};
jq.AuctionSell.homeBtn.click(
function(){
    //AuctionSell.close();
    jq.AuctionSell.menu.toggle();
    jq.Game.menu.toggle();
    setHomeImg();
    jq.carImg.show();
    jq.setErr();    //clear error when changing pages
    //appState = GAME_MODE.MAIN;
});