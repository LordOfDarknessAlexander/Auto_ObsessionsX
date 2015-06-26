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
	carPrice : $('div#SaleView label#carPrice')
};
var SaleView = {
	_auction : null,
	ai : [],
	imgX : 10,
	currentBid : 0,
	winningImgY : 34,
	winningTimer : 0.0, //Timer that starts when the highest bid is made, once it elapses the going timer will begin
	winningTimerCap : 100.0, //Max amount of time the winningTimer will run for before activating the going timer
	goingTimer: 0.0, //Timer forcountdown to final sale: going once, going twice, sold
    bidTimerCap: 50, //Max time the bidTimer can go to
	enemyWinning : false,
	init:function(index){
        //call to start an auction for car		
        //console.log(index);
        //disable/enable sounds before ajax call
        
        //if(audioEnabled() ){
            //var s = assetLoader.sounds;
            assetLoader.sounds.gameOver.pause();
            assetLoader.sounds.going.pause();
            assetLoader.sounds.sold.pause();
            assetLoader.sounds.bg.currentTime = 0;
            assetLoader.sounds.bg.loop = true;
            assetLoader.sounds.bg.play();
        //}
        auctionStop = false;
			
			jq.AuctionSell.menu.hide();
			jq.SaleView.menu.show();
			Auction.init();
			
		//	this.render();
			
		

  //var funcName = 'Auction.js, Auction::init()';
   var funcName = 'SaleView.php, Auction::init()';
        console.log('snappers');
        $.when(
		

            //jq.post(
                //'pas/query.php',
                //{carID:index}
            //);
            $.ajax({
                type:'POST',
                url:getHostPath() + 'pas/query.php',
                dataType:'json',
                data:{carID:index}
            }).done(function(data){
                //the response string is converted by jquery into a Javascript object!
                if(data === null){
                    alert(funcName + ', Error:ajax response returned null!');
                    return;
                }
                alert('AuctionSelect::init(), ajax response success!' + JSON.stringify(data) );
                //do stuff                
                Auction._car = Vehicle(data.name, data.make, data.year, data.price, data.id, data.info);
				
                if(Auction._car !== null){
                    //console.log(Auction._car.getFullName());
                    var p = Auction._car.getPrice();
				   //vehiclePrice = Auction._car.getAdjustedConditionPrice();
					
					vcondition = Auction._car.getRandCondition();
					vehiclePrice = Auction._car.getPrice() * vcondition/100 ;
					//vcondition2 = Auction._car.getCondition();
					//vehiclePrice = Auction._car.getPrice() ;
					//35,200 
				//	vcondition2 = vcondition + vcondition2;
					//Auction._car.getCondition == vcondition2;
					
					Auction.ai = [
                        Enemy(price(p)),
                        Enemy(price(p)),
                        Enemy(price(p)),
                        Enemy(price(p))
                    ];
					//Auction.currentBid = vehiclePrice * 0.1;
                    Auction.currentBid = vehiclePrice * Auction.raisePerc;
                    //jq.Auction.carPrice.text('car value:\n' + Auction._car.getPrice().toFixed(2) );
            
                    //context.font = '26px arial, sans-serif';  
					jq.AuctionSell.menu.hide();
                    jq.SaleView.menu.show();		//$('#Auction').show();
                    jq.carImg.show();
                    setHomeImg(SaleView._car.getFullPath() );
                   
				    $('div#SaleView label#carName').html(Auction._car.getFullName() + '<br>' + 'value:' + vehiclePrice.toFixed(0) + '<br>' + 'condition  ' + vcondition.toFixed(0));
                    $('div#SaleView label#carInfo').text(Auction._car.getInfo() );
            
                    $('.sound').show();
                }
            }).fail(function(jqxhr){
                //call will fthis.ail if result is not properly formated JSON!
                //alert
                jq.setErr(funcName, 'ajax call failed! Reason: ' + jqxhr.responseText);
                //console.log('loading game resources failed, abort!');
                //finished = true;
            })
        ).done(function(){
            //init visuals and display page after state has loaded
            Auction.setup();
        }).fail(function(){
            //alert(
            jq.setErr(funcName, 'calling $.when failed! Reason: ' + jqxhr.responseText);
            //console.log('loading game resources failed, abort!');
        });
        
		
		
		//this.setup();
	},
	close : function(){
        //End the auction
        //closing bidding and clearing local vars
		auctionStop = true;
		auctionEnded = false;
		endGame = false;
		this.enemyWinning = false;
		stop = false;
        
        jq.carImg.hide();
	},
   
    getRaise:function(){
        //returns the current bid plus and additional increase, based on a percentage
        var b = this.currentBid,
            cv = Auction._car.getPrice();
        
        return b + (cv * this.raisePerc);
    },
	update : function(){
		//main update logic, called per frame
        var btc = this.bidTimerCap;
        
        //static call, to update global enemy bid cooldown counter
		Enemy.update();
		this._auction.update();
        
		this.going();
        
		 if(auctionEnded){
			 this.close();		
		 }
		 if(endGame){
			 this.close();					
		 }
		
		if(!auctionStop){
		  	this.render();
		}
		else{
			//clear drawing when auction stops
			context.clearRect(0, 0, canvas.width, canvas.height);
		}
	  //	Auction.buyOut();
	},
	render : function(){
        //draw scene specific content to canvas
		var imgOffset = 20;
        //The block below can be cleaned up, thinking of how to do it
        var i = 0,
            h = 20,     //height(in pixels) of element
            cb = this._auction._currentBid,
            t0 = 202,    //top, where the upper most element is rendered
            t1 = 190,
            t2 = 220,
			ai = this._auction._ai,
            ewinPos = 174,  //enemy win position
            tx = ENEMY_X + 12,  //text x offset
            left = 10;  //left offset to draw the image from
            //bid = this.ai[i].currBid,
            //str = 'Player Bid : $' + this.playerBid.toFixed(2);
            console.log('drawing bitches');
		context.drawImage(backgroundImage, 0, 0);
		context.font = '14px arial, sans-serif';
		
        //draw enemies
        var i = 0;
        
        function draw(){
            var bid = ai[i]._currentBid;
                str = bidders[i] + '$' + bid.toFixed(2);
            
            if(bid >= cb){
                context.drawImage(curBidImage, left, ewinPos);
                context.fillText(str, tx, t1);		
            }
            else{
                context.drawImage(slimer, left, t0 + (h * i) );
                context.fillText(str, tx, t2 + (h * i) );
            }
            //i++;
        }
        for(; i < ai.length; i++){
            draw();
        }
//<php
//if(DEBUG){>
        // pbSetColor(jq.SaleView.cdpbG, Enemy.getTimerPerc() );
        // pbSetColor(jq.SaleView.cdpb0, ai[0].getTimerPerc() );
        // pbSetColor(jq.SaleView.cdpb1, ai[1].getTimerPerc() );
        // pbSetColor(jq.SaleView.cdpb2, ai[2].getTimerPerc() );
        // pbSetColor(jq.SaleView.cdpb3, ai[3].getTimerPerc() );
        // pbSetColor(jq.SaleView.going, this.getGoingPerc() );
//<php
//}
//>
        //this.going();
	},
	
	// setBidBtnText:function(){
        // var r = this.getRaise();
		// jq.Auction.bidBtn.text('Bid: $' + r.toFixed(2) );
	// }
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
	jq.GameMenu.menu.show();
	setHomeImg();
    jq.setErr();    //clear error when changing pages	
});

