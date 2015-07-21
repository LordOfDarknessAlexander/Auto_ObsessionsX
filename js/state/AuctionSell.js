//<php
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
        
		if(index !== null && index !== undefined ){ //&& typeof index === 'number'
			//call to start an auction for car            
			var i = Math.floor(typeof index === 'number' ? index : parseInt(index) );//parseInt(index);  //.data.i;
                //Garage.getCarByIndex(i);
            
            //jq.AuctionSell.carView.clear();

            var as = auctionGen();  //do not user new, function which returns a brand new object for you
			as.init(i);
            
			if(as._car !== null){
                as.addButton();
                as.toggleCC();
                as.bindViewBtn();
                //
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
    initCB:function(obj){
        //call this when initializing the state from a button.click callback!     
		if(obj !== null && obj !== undefined){            
			var i = obj.data.i;
            
            AuctionSell.init(i);
			//AuctionSell.render();
        }
	},
	update : function(dt){
		//console.log('AuctionSell.update called');
		var i = 0,
            len = userSales.length;
        
		if(len > 0){            
			for(; i < len; i++){
				//if(!userSales[i]._expired){
                userSales[i].update(dt);
                //var b = userSales[i].isExpired() && !userSales[i]._closed;
                //if(b){  //this._curTime >= this.MAX_AUCTION_TIME){
                    //continue to update until time runs out
					//for(var j = 0; j < userSales[i]._ai.length; ++j){
						//if(userSales[i]._ai[j].winningBid){
							//console.log('AI ' + j.toString() + ' at auction ' + i.toString() + ' has won the bid for the ' + this._car.getFullName() + ' for (' + Math.round(this._ai[j].currBid) + '), Original Price (' + this._car.getPrice() + ')');
						//}
					//}
					//console.log('Ending auction');
					//userSales[i].endAuction();
					//userSales[i].close();
				//}
				//}
				//else{
					//userSales.splice(i, 1);
				//}
			}
		}
	},
    //addVehicleFromDB:function(obj){
//<php
        //var funcName = 'AuctionSell.js pas::VehicleFromDB()';
//?>
        //return jq.post(
            //'pas/query.php',
            //function(data){
                //the response string is converted by jquery into a Javascript object!
                //if(data === null){
                    //alert(funcName + ', Error:ajax response returned null!');
                    //return;
                //}
//<php
//if(DEBUG){?>
                //alert('VehicleFromDB():ajax response recieved: ' + JSON.stringify(obj) + ' ' + JSON.stringify(data) );
                //var car = Vehicle.fromDB(data, obj);
                //var na = AuctionGen();
                //na.init(car);
//<php
//}
//else{?>
                //userSales.push(na);   //Vehicle.fromDB(data, obj);
//<php}>
            //},
            //function(jqxhr){
                //call will fail if result is not properly formated JSON!
                //jq.Err(funcName, 'ajax call failed! Reason: ' + jqxhr.responseText);
            //},
            //{carID:obj.carID}
        //);
    //},
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
                    
                    for (var i = 0; i < len; i++) {

                        var ad = sd[i], //auction data
                            na = auctionGen();    //new auction
                            
                        na.initWithData(ad);
                        na.addButton();
//                      na.restart(); 
					    na.toggleCC();
                        na.bindViewBtn();
						
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
                    na.bindViewBtn();
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