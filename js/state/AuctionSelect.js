//Action Select State Object
var AuctionSelect =
{	//object representing
	list : $('div#AuctionSelect div#carView ul#auctionCars'),
	init : function()
	{	//init buttons base on cars in xml database
		//appState = GAME_MODE.AUCTION_SElECT;
        //if(guest)
            //this.list.empty();
		//
//<?php
    //if(loggedIn){
        //auction cars never change, so load only once to
        //save on calls to server and bandwidth
        //if(auctionCars not loaded){
            //
        //}
    //}
    //else{?>
        //playing locally as guest, call JS
    //<?php
    //}?>
		for(var i = 0; i < /*ao.*/xdbCars.length; i++)
		{
			var btnID = "as" + (i).toString(),
				liID = "asli" + (i).toString(),
				labelID = 'infoLabel';
				
			var car = xdbCars[i];	//ao.xdbCars[i];
			
            //if(guest){}
                /*var btnStr = "<li id=\'" + liID + "\'>" + 
                    "<img src=\'" + car.getFullPath() + "\'>" +
                    "<label id=\'" + labelID + "\'>" + car.getFullName() + "-<br>" + car.getInfo() + "</label>" +
                    "<button id=\'" + btnID + "\'>" + 
                        "<label id=\'price\'>$" + (car.getPrice() ).toString() + "</label><br>" +
                        "Bid Now!<br>" +
                        //"<label id=\'expireTime\'>Auction expire time!</label>" +
                    "</button>" +
                "</li><br>";
                this.list.append(btnStr);*/
            //}
			var btn = $('#' + btnID);
			
			var hasCar = false;
			for(var j = 0; j < userGarage.length; j++)
			{
				var gc = userGarage[j];

				if(car.getFullName()/*id*/ == gc.getFullName()/*id*/){
					hasCar = true;
					break;
				}
			}
			
			if(hasCar)
			{	//display but disable user from entering auction
				var li = $('#' + liID);
				li.css('opacity', '0.45');
				btn.click(this.denyAuction);
			}
			else
			{
				btn.click({index:i}, this.initAuction);
				//btn.css('background-image', "url(\'..\\images\\vehicle.jpg");	//car.getFullPath());
			}
		}
	},
	initAuction : function(obj)
	{
		var i = obj.data.index;
		jq.AuctionSelect.menu.toggle();
		jq.Auction.menu.toggle();
		//Auction.setup();
		Auction.init(i);
		//Auction.setup();
	},
	denyAuction : function()
	{
		//if(assetLoader.sounds.denyAuction is not playing)
			//play deny auction
		//visual alert as well to notify user?
	},
	update : function()
	{
	},
	render : function()
	{	//render additional, not html elements
	}
};