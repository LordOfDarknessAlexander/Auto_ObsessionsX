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
	carPrice : $('div#SaleView label#carPrice'),
	carInfo : $('div#SaleView label#svCarInfo')
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
			//auctionStop = false;
			this._auction = index;
			
			jq.AuctionSell.menu.hide();
			jq.SaleView.menu.show();
            setHomeImg(index._car.getFullPath() );
            jq.carImg.show();
			this.setCarInfo();
			//Auction.init();
			
		//this.render();
			

        var funcName = 'SaleView.php, Auction::init()';
        console.log('snappers');

        
		
		
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
	setCarInfo : function(){
		var str = this._auction._car !== null ? this._auction._car.getInfo() : '';
		jq.SaleView.carInfo.text(str);
		jq.SaleView.carInfo.show();
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
            bid = this.ai[i].currBid,
           
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
    //echo "Spit";
    console.log ("Spit");
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

